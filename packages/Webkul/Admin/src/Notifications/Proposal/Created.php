<?php

namespace Webkul\Admin\Notifications\Proposal;

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
            'id'      => $this->data['proposal']['id'],
            'title'   => trans('admin::app.notifications.proposal-created-title'),
            'message' => trans('admin::app.notifications.proposal-created-message', [
                'name' => $this->data['proposal']['proposal_id'],
            ]),
            'type'    => 'proposal',
        ];
    }
}
