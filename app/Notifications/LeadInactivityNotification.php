<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Sharmindar\Core\Lead\Models\Lead;

class LeadInactivityNotification extends Notification
{
    use Queueable;

    public $lead;

    /**
     * Create a new notification instance.
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Reminder: Lead '{$this->lead->title}' has had no activity for 10 days.",
            'lead_id' => $this->lead->id,
        ];
    }
}
