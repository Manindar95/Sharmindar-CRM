<?php

namespace Company\Core\Notification\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class InvoiceGeneratedNotification extends BaseNotification
{
    public $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;

        // Channels: Email and In-App (Database)
        $this->channels = ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Invoice Generated: #' . $this->invoice['number'])
            ->line('A new invoice has been generated in the system.')
            ->action('View Invoice', url('/admin/invoices/view/' . $this->invoice['id']));
    }

    /**
     * Get the database (in-app) representation.
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => 'invoice_generated',
            'title' => 'Invoice Created',
            'message' => 'Invoice #' . $this->invoice['number'] . ' was generated.',
            'action_url' => url('/admin/invoices/view/' . $this->invoice['id']),
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
        return [];
    }
}
