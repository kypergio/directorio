<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorreoDoctores extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $doctor;
    protected $cliente;
    public function __construct($cliente,$doctor)
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
        return $this->subject('[Solicitud] Un cliente potencial solicita información sobre Ultherapy')
            ->markdown('email.doctor', ["cliente" => $this->cliente, "doctor" => $this->doctor]);
    }
}
