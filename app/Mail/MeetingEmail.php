<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MeetingEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $emailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Meeting Detail')
                    ->view('admin.meetings_remainders.meetings.mail.meeting_email')
                    ->with([
                        'emailData' => $this->emailData,
                    ]);
    }
}
