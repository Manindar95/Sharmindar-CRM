<?php

namespace App\Listeners;

use App\Notifications\LeadStatusChangedNotification;
use Sharmindar\Core\Lead\Models\Lead;
use Illuminate\Support\Facades\Log;

class LeadStatusChangeListener
{
    /**
     * Handle the event.
     */
    public function handle(Lead $lead): void
    {
        // Check if lead_pipeline_stage_id was changed
        if ($lead->wasChanged('lead_pipeline_stage_id')) {
            $user = $lead->user;
            if ($user) {
                $user->notify(new LeadStatusChangedNotification($lead));
            }
            else {
                Log::warning("Lead {$lead->id} status changed but has no assigned user to notify.");
            }
        }
    }
}
