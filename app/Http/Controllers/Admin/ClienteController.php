<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    // ... tus métodos existentes (index, create, store, show, etc.)

    /**
     * ✅ Busca un cliente por cédula (para autocompletar en cotizaciones)
     */
    public function buscarPorCedula($cedula)
    {
        $cliente = Cliente::where('cedula', $cedula)->first();

        if ($cliente) {
            return response()->json([
                'success' => true,
                'cliente' => [
                    'nombre'    => $cliente->nombre,
                    'direccion' => $cliente->direccion,
                    'correo'    => $cliente->correo,
                    'celular'   => $cliente->telefono,
                ],
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
