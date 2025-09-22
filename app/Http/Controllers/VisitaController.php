<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaVisitaMail;

class VisitaController extends Controller
{
    public function index()
    {
        $visitas = Visita::with('cliente')->latest()->get();
        return view('admin.visitas.index', compact('visitas'));
    }

    public function create()
    {
        return view('cliente.agendar_visita');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_visita' => 'required|date|after:today',
            'comentario'   => 'required|string|max:500',
        ]);

        $cliente = Auth::user();

        $visita = Visita::create([
            'cliente_id'   => $cliente->id,
            'fecha_visita' => $request->fecha_visita,
            'comentario'   => $request->comentario,
            'atendida'     => false,
        ]);

        Mail::to('admin@camaras.daganet.net')->send(new NuevaVisitaMail($visita));

        return redirect()->route('cliente.dashboard')
                         ->with('success', 'Visita agendada correctamente y notificada al administrador.');
    }
}
