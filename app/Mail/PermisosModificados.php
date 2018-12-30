<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class PermisosModificados extends Mailable
{
    use Queueable, SerializesModels;
    public $nombreactividad;
    public $nombreusuario;
    public $mensaje;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreusuario, $nombreactividad, $mensaje)
    {
        //
        $this->nombreactividad = $nombreactividad;
        $this->nombreusuario = $nombreusuario;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.PermisosModificados');
    }
}
