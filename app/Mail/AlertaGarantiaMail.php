<?php

namespace App\Mail;

use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class AlertaGarantiaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;
    public $fecha_fin;
    public $dias_restantes;

    public function __construct(Cliente $cliente, Carbon $fecha_fin, int $dias_restantes)
    {
        $this->cliente = $cliente;
        $this->fecha_fin = $fecha_fin;
        $this->dias_restantes = $dias_restantes;
    }

    public function build()
    {
        return $this->subject('⚠️ Alerta de Garantía Próxima a Vencer')
            ->view('emails.alerta_garantia');
    }
}
