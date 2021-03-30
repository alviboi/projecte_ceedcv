<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarMissatge extends Mailable
{
    use Queueable, SerializesModels;
    public $subject="MISSATGE DEL CEFIRE VALENCIA";

    public $dat=array();
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        //
        $this->dat=$datos;
        $this->subject=$datos['Cap']." de ".$datos['De'];

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.missatge');
    }
}
