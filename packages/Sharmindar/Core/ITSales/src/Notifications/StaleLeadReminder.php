<?php

namespace Sharmindar\Core\ITSales\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Webkul\Lead\Models\Lead;

class StaleLeadReminder extends Notification
{
    use Queueable;

    public function __construct(protected
        Lead $lead, protected
        string $currentStatus, protected
        int $hoursStale,
        )
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("⏰ Stale Lead Reminder: {$this->lead->title}")
            ->greeting('Lead Needs Attention')
            ->line("**{$this->lead->title}** has been in **{$this->currentStatus}** for over **{$this->hoursStale} hours** without any update.")
            ->action('Update Lead', url("/admin/leads/view/{$this->lead->id}"))
            ->line('Please review and progress this lead.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'stale_lead_reminder',
            'lead_id' => $this->lead->id,
            'lead_title' => $this->lead->title,
            'current_status' => $this->currentStatus,
            'hours_stale' => $this->hoursStale,
        ];
    }
}
