<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalEquipos = Equipo::count();
        $totalVisitas = Visita::count();
        $visitasPendientes = Visita::where('atendida', 0)->count();
        $visitasAtendidas = Visita::where('atendida', 1)->count();

        // Instalaciones de equipos agrupadas por mes
        $instalacionesPorMes = Equipo::select(
            DB::raw("DATE_FORMAT(fecha_instalacion, '%Y-%m') as mes"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy('mes')
        ->orderBy('mes', 'asc')
        ->pluck('total', 'mes');

        return view('admin.reportes.index', compact(
            'totalClientes',
            'totalEquipos',
            'totalVisitas',
            'visitasPendientes',
            'visitasAtendidas',
            'instalacionesPorMes'
        ));
    }
}
