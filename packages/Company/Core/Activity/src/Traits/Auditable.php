<?php

namespace Company\Core\Activity\Traits;

use App\Models\User; // Standard usage or Webkul\User\Models\User
use Company\Core\Activity\Models\AuditTrail;
use Illuminate\Support\Arr;

trait Auditable
{
    /**
     * Boot the Auditable trait for the model.
     */
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->auditEvent('created');
        });

        static::updated(function ($model) {
            $model->auditEvent('updated');
        });

        static::deleted(function ($model) {
            $model->auditEvent('deleted');
        });
    }

    /**
     * Audit an event.
     *
     * @param  string  $event
     * @return void
     */
    protected function auditEvent($event)
    {
        // Get old and new attributes depending on the event
        $oldValues = [];
        $newValues = [];

        if ($event === 'created') {
            $newValues = $this->attributesToArray();
        }
        elseif ($event === 'updated') {
            $oldValues = Arr::only($this->getOriginal(), array_keys($this->getDirty()));
            $newValues = $this->getDirty();
        }
        elseif ($event === 'deleted') {
            $oldValues = $this->attributesToArray();
        }

        // Avoid creating an audit trail if there are no changes on update
        if ($event === 'updated' && empty($oldValues)) {
            return;
        }

        AuditTrail::create([
            'user_id' => auth()->id() ?? null,
            'auditable_type' => get_class($this),
            'auditable_id' => $this->getKey(),
            'event' => $event,
            'old_values' => empty($oldValues) ? null : $oldValues,
            'new_values' => empty($newValues) ? null : $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
