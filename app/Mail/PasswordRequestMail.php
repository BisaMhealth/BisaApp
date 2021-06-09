<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'info@amazingtechnologies.com.gh';
        $subject = "Bisa Password Reset";
        $name = 'Bisa ';

        return $this->view('email_templates.password_reset')
                    ->from($address, $name)
                    //->cc($address, $name)
                    //->bcc($address, $name)
                    //->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'username' => $this->data['username'], 'text' => $this->data['text'] ]);
    }
}
