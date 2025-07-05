<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckoutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $content;

    /**
     * Create a new message instance.
     */
     public function __construct($details, $content)
    {
        $this->details = $details;
        $this->content = $content;
    }

    public function build()
    {
       // dd('Yes');
        return $this->subject($this->details['subject'])
            ->view('Merchant.emails.checkout')
            ->with([
                'details' => $this->details,
                'content' => $this->content,
            ]);
    }
}
