<?php

namespace App\Mail;

use App\Models\Order; // Import the Order model
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShippingStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // Declare a public property to hold the order data

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order; // Assign the order to the public property
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipping Status Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.shipping_status_updated', // Update with your actual view name
            with: [
                'order' => $this->order, // Pass the order to the view
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
