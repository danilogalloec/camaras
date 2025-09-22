<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteReporteController extends Controller
{
    public function index()
    {
        $cliente = Auth::user();

        $equipos = $cliente->equipos; // Relación definida en Cliente.php
        $visitasPendientes = $cliente->visitas()->where('atendida', 0)->count();
        $visitasAtendidas = $cliente->visitas()->where('atendida', 1)->count();

        // Reporte de visitas agrupadas por mes
        $visitasPorMes = $cliente->visitas()
            ->select(
                DB::raw("DATE_FORMAT(fecha_visita, '%Y-%m') as mes"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->pluck('total', 'mes');

        // Calcular fecha de fin de garantía
        $fechaFinGarantia = $cliente->fecha_instalacion->copy()->addMonths($cliente->tiempo_garantia_meses);

        return view('cliente.reportes.index', compact(
            'cliente',
            'equipos',
            'visitasPendientes',
            'visitasAtendidas',
            'visitasPorMes',
            'fechaFinGarantia'
        ));
    }
}

