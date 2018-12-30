<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TareaTerminada extends Mailable
{
    use Queueable, SerializesModels;
    public $nombretarea;
    public $nombreproyecto;
    public $fecha;
    public $nombreactividad;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nt, $np, $na, $f)
    {
        //
        $this->nombretarea = $nt;
        $this->nombreproyecto = $np;
        $this->nombreactividad = $na;
        $this->fecha = $f;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.TareaTerminada');
    }
}
