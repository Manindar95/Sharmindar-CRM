<?php

namespace Sharmindar\Core\Notification\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class TaskAssignedNotification extends BaseNotification
{
    public $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;

        // Channels: Email and In-App (Database)
        $this->channels = ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Task Assigned: ' . $this->task['title'])
            ->line('You have been assigned a new task.')
            ->action('View Task', url('/admin/tasks/view/' . $this->task['id']))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the database (in-app) representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => 'task_assigned',
            'title' => 'New Task Assigned',
            'message' => 'You were assigned to: ' . $this->task['title'],
            'action_url' => url('/admin/tasks/view/' . $this->task['id']),
            'task_id' => $this->task['id'],
        ];
    }

    /**
     * Get the WhatsApp representation.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toWhatsApp($notifiable): array
    {
        return []; // Not sending via WhatsApp
    }

    /**
     * Get the Push representation.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toPush($notifiable): array
    {
        return []; // Not sending via Push
    }
}
