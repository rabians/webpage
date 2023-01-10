<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMailable extends Mailable
{
    use Queueable, SerializesModels;
     public $contact_data;

    public function __construct($contact_data)
    {
        $this->contact_data = $contact_data;
    }
    public function build()
    {
        $from_name = "Motorcart";
        $from_email = "rabiakhalilpk@gmail.com";
        $subject = $this->contact_data['subject'];
            return $this->from($from_email, $from_name)
             ->to($this->contact_data['email_address'], $this->contact_data['full_name'])
             ->cc('rabiakhalilpk@gmail.com')
            ->view('mails.order-mail')
            ->subject($subject)
        ;
    }
}

