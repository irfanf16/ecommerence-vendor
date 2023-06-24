<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendOrderStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    // ORDER DETAILS
    public  $package_details;

    // Create a new message instance.
    public function __construct($package_details)
    {
        $this->package_details = $package_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($address = 'no-reply@storak.qa', $name = 'Storak.qa')
                    ->subject('Review Your Order Status - Storak.qa')
                    ->view('email.order_status');
    }
}