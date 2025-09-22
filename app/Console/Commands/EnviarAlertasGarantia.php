<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cliente;
use App\Mail\AlertaGarantiaMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EnviarAlertasGarantia extends Command
{
    protected $signature = 'alertas:garantia';
    protected $description = 'Enviar correos de alerta a los clientes cuando su garantía está por vencer';

    public function handle()
    {
        $hoy = Carbon::today();

        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            $fecha_fin = Carbon::parse($cliente->fecha_instalacion)->addMonths($cliente->tiempo_garantia_meses);
            $dias_restantes = $hoy->diffInDays($fecha_fin, false);

            if (in_array($dias_restantes, [90, 30, 7, 5, 1])) {
                Mail::to($cliente->correo)->send(new AlertaGarantiaMail($cliente, $fecha_fin, $dias_restantes));
                $this->info("Alerta enviada a {$cliente->correo} - faltan {$dias_restantes} días.");
            }
        }

        return Command::SUCCESS;
    }
}
