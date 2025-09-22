<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    // === Editar un equipo ===
    public function edit(Cliente $cliente, Equipo $equipo)
    {
        return view('admin.equipos.edit', compact('cliente', 'equipo'));
    }

    // === Actualizar equipo ===
    public function update(Request $request, Cliente $cliente, Equipo $equipo)
    {
        $equipo->update($request->validate([
            'tipo' => 'required',
            'marca' => 'nullable',
            'modelo' => 'nullable',
            'numero_serie' => 'required',
            'fecha_instalacion' => 'required|date',
            'garantia_meses' => 'required|integer',
            'observaciones' => 'nullable',
        ]));

        return redirect()
            ->route('admin.clientes.show', $cliente->id)
            ->with('success', 'Equipo actualizado');
    }

    // === Eliminar equipo ===
    public function destroy(Cliente $cliente, Equipo $equipo)
    {
        $equipo->delete();

        return redirect()
            ->route('admin.clientes.show', $cliente->id)
            ->with('success', 'Equipo eliminado');
    }
}
