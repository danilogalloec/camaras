<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar que se envíen usuario (cedula/email) y contraseña
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Puede ser cédula de cliente o email de admin
        $input = $request->email;
        $password = $request->password;

        // === Intentar login como Cliente por cédula ===
        $cliente = Cliente::where('cedula', $input)->first();
        if ($cliente && Hash::check($password, $cliente->password)) {
            Auth::login($cliente);

            // Si es primer login del cliente, obligar a cambiar contraseña
            if ($cliente->primer_login) {
                return redirect()->route('cliente.change_password');
            }

            return redirect()->route('cliente.dashboard');
        }

        // === Intentar login como Admin por email ===
        $admin = User::where('email', $input)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::login($admin);
            return redirect()->route('admin.clientes');
        }

        // Si las credenciales no son correctas
        return back()->withInput()->withErrors([
            'login' => 'Credenciales incorrectas. Verifique sus datos.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
