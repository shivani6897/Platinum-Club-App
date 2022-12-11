<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userToken)
    {
        $this->userToken = $userToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user_password')->with('userToken',$this->userToken);
    }
}

//    public function envelope()
//    {
//        return new Envelope(
//            subject: 'Customer Password Email',
//        );
//    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
//    public function content()
//    {
//        return new Content(
//            view: 'emails.user_password',
//        );
//    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
//    public function attachments()
//    {
//        return [];
//    }
//}
