<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userdetails, $user,$customer,$products,$productData, $product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoiceData,$userdetails, $user,$customer,$products,$productData)
    {
//        $this->data = $data;
        $this->invoiceData = $invoiceData;
        $this->customer = $customer;
        $this->userdetails = $userdetails;
        $this->user = $user;
        $this->products = $products;
        $this->productData = $productData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
//            replyTo: [
//                'address' => $user->email,
//            ],
            subject: 'Invoice Mail',
        );
//        $booking->user->email
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.invoice_email',
            with: [
                'invoiceData' => $this->invoiceData,
                'customer' => $this->customer,
                'userdetails' => $this->userdetails,
                'user' => $this->user,
                'products' => $this->products,
                'product' => $this->product,
                'productData' => $this->productData,
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
