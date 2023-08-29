<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user, $order, $orderItem;

    public function __construct($user, $order, $orderItem)
    {
        $this->user = $user;
        $this->order = $order;
        $this->orderItem = $orderItem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $order = $this->order;
        $orderItem = $this->orderItem;
        return $this->view('emails.order_confirmation', compact("user", "order", "orderItem"))
        ->subject('Order Confirmation');
    }
}