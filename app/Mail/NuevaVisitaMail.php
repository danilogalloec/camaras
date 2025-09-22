<?php

namespace App\Mail;

use App\Models\Visita;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevaVisitaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visita;

    public function __construct(Visita $visita)
    {
        $this->visita = $visita;
    }

    public function build()
    {
        return $this->subject('Nueva visita técnica agendada')
            ->view('emails.nueva_visita');
    }
}
