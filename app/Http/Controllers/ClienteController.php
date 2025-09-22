<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
public function dashboard(Request $request)
{
    // Cargar también la relación de equipos
    $cliente = $request->user()->load('equipos');

    // Ya no calculamos fecha de fin de garantía
    return view('cliente.dashboard', compact('cliente'));
}

    public function updateProfile(Request $request)
    {
        $cliente = $request->user();

        $request->validate([
            'telefono' => 'nullable|string|max:20',
            'correo'   => 'nullable|email',
            'direccion'=> 'nullable|string|max:255',
        ]);

        $cliente->update($request->only('telefono', 'correo', 'direccion'));

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function changePasswordForm()
    {
        return view('cliente.change_password');
    }

    public function changePassword(Request $request)
    {
        $cliente = $request->user();

        $request->validate([
            'password' => 'required|string|confirmed|min:6',
        ]);

        $cliente->password = Hash::make($request->password);
        $cliente->primer_login = 0;
        $cliente->save();

        return redirect()->route('cliente.dashboard')->with('success', 'Contraseña cambiada con éxito.');
    }
}
