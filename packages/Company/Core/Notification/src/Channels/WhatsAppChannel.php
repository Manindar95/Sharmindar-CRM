<?php

namespace Company\Core\Notification\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class WhatsAppChannel
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
        if (!method_exists($notification, 'toWhatsApp')) {
            return;
        }

        $message = $notification->toWhatsApp($notifiable);

        // Here we would implement the actual API call to Twilio or Meta WhatsApp API.
        // For now, we simulate sending the notification by logging it.
        $phoneNumber = $notifiable->phone ?? 'Unknown Number';
        Log::info("WhatsApp Message simulated for sending to [{$phoneNumber}]: " . json_encode($message));
    }
}
