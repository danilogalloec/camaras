<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos Artisan propios de la aplicación.
     *
     * @var array<int, class-string>
     */
    protected $commands = [
        // Registrar comandos aquí si los creas manualmente
    ];

    /**
     * Define la programación de las tareas (cron jobs).
     */
    protected function schedule(Schedule $schedule): void
    {
        // Ejecutar todos los días a las 08:00 AM la tarea de alertas de garantía
        $schedule->command('alertas:garantia')->dailyAt('08:00');
    }

    /**
     * Registrar los comandos para Artisan.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
