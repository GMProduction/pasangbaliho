<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class sendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $path;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        //
        $this->path = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.exampleMail')->attachFromStorage($this->path)->with(['test' => $this->path]);
        // return $this->view('admin.exampleMail')->attach('file.pdf');
    }
}
