<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $count;
    public $ten;
    public $romstotal;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($count,$ten, $romstotal)
    {
        $this->count = $count;
        $this->ten = $ten;
        $this->romstotal = $romstotal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->view('emails.registeredcount');
        //return $this->view('emails.daily');
    }
}
