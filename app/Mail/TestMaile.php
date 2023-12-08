<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMaile extends Mailable
{
    use Queueable, SerializesModels;

    public $time_attendees;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($time_attendees)
    {
        $this->time_attendees = $time_attendees;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('تحديد موعد حضورك إلى مصلحة الأحوال المدنية')
                    ->view('mail.mailtest')
                    ->with([
                        'time_attendees' => $this->time_attendees,
                    ]);
    }
}