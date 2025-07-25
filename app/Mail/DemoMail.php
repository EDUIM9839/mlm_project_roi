<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
   
    /**
     * Create a new message instance.
     */
     
     
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
      
    }
  
     
 
    public function build()
    {
        return $this->view('emails.password');
                   
    }

   
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'forget password',
        );
    }

    
    public function content(): Content
    {
        return new Content(
            view: 'emails.forget-password',
        );
    }

   
    public function attachments(): array
    {
        return [];
    }
    
       public function email_setting(): Content
    {
        return new Content(
            view: '',
        );
    }
    
}
