<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LandingInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userdetails, $user,$customer,$productData, $products,$subtotal,$emi,$tax,$due;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoiceData,$userdetails, $user,$customer,$products,$productData,$subtotal,$tax,$due)
//    public function __construct($invoiceData,$userdetails, $user,$customer,$products,$productData,$subtotal,$emi,$tax,$due)
    {
        $this->invoiceData = $invoiceData;
        $this->customer = $customer;
        $this->userdetails = $userdetails;
        $this->user = $user;
        $this->products = $products;
        $this->productData = $productData;
        $this->subtotal = $subtotal;
//        $this->emi = $emi;
        $this->tax = $tax;
        $this->due = $due;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Invoice Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.landing_invoice',
            with: [
                'invoiceData' => $this->invoiceData,
                'customer' => $this->customer,
                'userdetails' => $this->userdetails,
                'user' => $this->user,
                'products' => $this->products,
                'productData' => $this->productData,
                'subtotal' => $this->subtotal,
//                'emi' => $this->emi,
                'tax' => $this->tax,
                'due' => $this->due,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
