<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsAuth extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->details['profile'] = auth('sanctum')->user()->role->value;
        return $this->from($this->details['email'])
            ->to(config('app.adminMail'))
            ->cc($this->details['email'])
            ->markdown('emails.contact_us_auth')
            ->with('details', $this->details);

    }
}
