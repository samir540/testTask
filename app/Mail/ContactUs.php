<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
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
        return $this->from($this->details['email'])
            // ->to('it.sp.3122@gmail.com')
            // ->to(env('MAIL_ADMIN_ADDRESS'))
            ->to(config('app.adminMail'))
            ->cc($this->details['email'])
            ->markdown('emails.contact_us')
            ->with('details', $this->details);
    }
}
