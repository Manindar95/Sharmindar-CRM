<?php

namespace Company\Core\Notification\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Company\Core\Notification\Channels\PushChannel;

class LeadCreatedNotification extends BaseNotification
{
    public $lead;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($lead)
    {
        $this->lead = $lead;

        // Channels: Email, In-App (Database), and Push
        $this->channels = ['mail', 'database', PushChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Lead Created: ' . $this->lead['title'])
            ->line('A new lead has entered the system.')
            ->action('View Lead', url('/admin/leads/view/' . $this->lead['id']));
    }

    /**
     * Get the database (in-app) representation.
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => 'lead_created',
            'title' => 'New Lead',
            'message' => 'A new lead was created: ' . $this->lead['title'],
            'action_url' => url('/admin/leads/view/' . $this->lead['id']),
            'lead_id' => $this->lead['id'],
        ];
    }

    /**
     * Get the WhatsApp representation.
     */
    public function toWhatsApp($notifiable): array
    {
        return [];
    }

    /**
     * Get the Push representation.
     */
    public function toPush($notifiable): array
    {
        return [
            'title' => 'New Lead Alert',
            'body' => 'Lead Created: ' . $this->lead['title'],
            'click_action' => url('/admin/leads/view/' . $this->lead['id'])
        ];
    }
}
