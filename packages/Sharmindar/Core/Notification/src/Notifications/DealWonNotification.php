<?php

namespace Sharmindar\Core\Notification\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Sharmindar\Core\Notification\Channels\WhatsAppChannel;

class DealWonNotification extends BaseNotification
{
    public $deal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deal)
    {
        $this->deal = $deal;

        // Channels: Email, Database, and WhatsApp
        $this->channels = ['mail', 'database', WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Congratulations! Deal Won: ' . $this->deal['title'])
            ->line('A deal was successfully marked as won!')
            ->line('Value: ' . ($this->deal['amount'] ?? 'N/A'))
            ->action('View Deal', url('/admin/quotes/view/' . $this->deal['id']));
    }

    /**
     * Get the database (in-app) representation.
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => 'deal_won',
            'title' => 'Deal Won 🏆',
            'message' => 'Deal Won: ' . $this->deal['title'],
            'action_url' => url('/admin/quotes/view/' . $this->deal['id']),
        ];
    }

    /**
     * Get the WhatsApp representation.
     */
    public function toWhatsApp($notifiable): array
    {
        return [
            'body' => "🏆 *Deal Won!* \nWe just closed: " . $this->deal['title'] . "\nCheck the CRM for details."
        ];
    }

    /**
     * Get the Push representation.
     */
    public function toPush($notifiable): array
    {
        return [];
    }
}
