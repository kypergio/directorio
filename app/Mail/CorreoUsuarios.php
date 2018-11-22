<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorreoUsuarios extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $doctor;
    public function __construct($doctor, $cliente)
    {
        $this->doctor = $doctor;
        $this->cliente = $cliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[Solicitud] ¡Gracias por solicitar información sobre Ultherapy!')
                    ->markdown('email.user', ["cliente" => $this->cliente, "doctor" => $this->doctor]);
    }
}
