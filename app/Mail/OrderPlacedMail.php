<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $isSuperAdmin;

    public function __construct(Order $order, bool $isSuperAdmin = false)
    {
        $this->order = $order;
        $this->isSuperAdmin = $isSuperAdmin;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->isSuperAdmin
                ? 'New Order Received - #'.$this->order->id
                : 'Order Placed Successfully - #'.$this->order->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-placed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
