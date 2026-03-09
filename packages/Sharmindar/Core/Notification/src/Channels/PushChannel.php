<?php

namespace Sharmindar\Core\Notification\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PushChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toPush')) {
            return;
        }

        $message = $notification->toPush($notifiable);

        // Here we would implement the actual API call to Firebase Cloud Messaging (FCM) or Pusher.
        // For now, we simulate sending the notification by logging it.
        $deviceToken = $notifiable->device_token ?? 'Unknown Token';
        Log::info("Push Notification simulated for sending to [{$deviceToken}]: " . json_encode($message));
    }
}
