<?php

namespace Webkul\Admin\Notifications\Lead;

use Webkul\Admin\Notifications\BaseNotification;

class Created extends BaseNotification
{
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id'      => $this->data['lead']['id'],
            'title'   => trans('admin::app.notifications.lead-created-title'),
            'message' => trans('admin::app.notifications.lead-created-message', [
                'name' => $this->data['lead']['title'],
            ]),
            'type'    => 'lead',
        ];
    }
}
