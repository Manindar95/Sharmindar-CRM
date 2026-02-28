<?php

namespace Company\Core\Notification\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Company\Core\Notification\Channels\WhatsAppChannel;
use Company\Core\Notification\Channels\PushChannel;

abstract class BaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Determines which channels the notification should be sent on.
     * Expected array items: 'mail', 'database', WhatsAppChannel::class, PushChannel::class
     */
    protected array $channels = [];

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return empty($this->channels) ? ['database'] : $this->channels;
    }

    /**
     * Ensure children implement how to send via email.
     */
    abstract public function toMail($notifiable): MailMessage;

    /**
     * Ensure children implement how to store in database (in-app).
     */
    abstract public function toArray($notifiable): array;

    /**
     * Ensure children implement how to format for WhatsApp.
     */
    abstract public function toWhatsApp($notifiable): array;

    /**
     * Ensure children implement how to format for Push notifications.
     */
    abstract public function toPush($notifiable): array;
}
