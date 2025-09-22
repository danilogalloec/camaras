<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Visita;
use App\Models\Equipo;

class AdminController extends Controller
{
    /* =========================
     * Dashboard
     * ========================= */
    public function dashboard()
    {
        $totalClientes     = Cliente::count();
        $totalVisitas      = Visita::count();
        $visitasPendientes = Visita::where('atendida', false)->count();
        $visitasAtendidas  = Visita::where('atendida', true)->count();

        return view('admin.dashboard', [
            'admin'             => auth('admin')->user(),
            'totalClientes'     => $totalClientes,
            'totalVisitas'      => $totalVisitas,
            'visitasPendientes' => $visitasPendientes,
            'visitasAtendidas'  => $visitasAtendidas,
        ]);
    }

    /* =========================
     * Clientes (Listado / Búsqueda)
     * ========================= */
    public function clientes(Request $request)
    {
        // búsqueda opcional por cédula
        $query = Cliente::withCount('equipos');

        if ($request->filled('cedula')) {
            $query->where('cedula', 'like', '%' . $request->cedula . '%');
        }

        $clientes = $query->orderBy('nombre')->get();

        return view('admin.clientes', compact('clientes'));
    }

    /* =========================
     * Formulario: Nuevo cliente (GET)
     * Ruta: admin.clientes.nuevo
     * ========================= */
    public function nuevoCliente()
    {
        return view('admin.clientes.nuevo');
    }

    /* =========================
     * Guardar cliente (POST)
     * Ruta: admin.clientes.store
     * ========================= */
    public function crearCliente(Request $request)
    {
        $validated = $request->validate([
            'cedula'            => 'required|unique:clientes,cedula',
            'nombre'            => 'required|string',
            'telefono'          => 'required|string',
            'correo'            => 'required|email',
            'direccion'         => 'required|string',
            'fecha_instalacion' => 'required|date',
            // Eliminado: num_equipos / tiempo_garantia_meses
        ]);

        // Contraseña = últimos 5 dígitos de la cédula (solo números)
        $soloDigitos = preg_replace('/\D/', '', $validated['cedula']);
        $validated['password']     = bcrypt(substr($soloDigitos, -5));
        $validated['primer_login'] = 1;

        Cliente::create($validated);

        return redirect()->route('admin.clientes')
                         ->with('success', 'Cliente creado correctamente.');
    }

    /* =========================
     * Ver ficha de cliente (GET)
     * Ruta: admin.clientes.show
     * ========================= */
    public function showCliente($id)
    {
        $cliente = Cliente::with(['equipos', 'visitas'])->findOrFail($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /* =========================
     * Editar cliente (GET)
     * Ruta: admin.clientes.editar
     * ========================= */
    public function editarCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        // Mantengo el nombre de vista que ya usabas
        return view('admin.editar_cliente', compact('cliente'));
    }

    /* =========================
     * Actualizar cliente (PUT)
     * Ruta: admin.clientes.actualizar
     * ========================= */
    public function actualizarCliente(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'cedula'            => 'required|unique:clientes,cedula,' . $cliente->id,
            'nombre'            => 'required|string',
            'telefono'          => 'required|string',
            'correo'            => 'required|email',
            'direccion'         => 'required|string',
            'fecha_instalacion' => 'required|date',
            // Eliminado: num_equipos / tiempo_garantia_meses
        ]);

        $cliente->update($validated);

        return redirect()->route('admin.clientes')
                         ->with('success', 'Cliente actualizado correctamente.');
    }

    /* =========================
     * Eliminar cliente (DELETE)
     * Ruta: admin.clientes.eliminar
     * ========================= */
    public function eliminarCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('admin.clientes')
                         ->with('success', 'Cliente eliminado.');
    }

    /* =========================
     * Equipos de un cliente
     * Rutas:
     *  - GET  admin.clientes.{cliente}.equipos.crear  -> crearEquipo
     *  - POST admin.clientes.{cliente}.equipos        -> guardarEquipo
     *  - (Opcional) listado: admin.equipos.index de un cliente
     * ========================= */
    public function crearEquipo($clienteId)
    {
        $cliente = Cliente::findOrFail($clienteId);
        return view('admin.equipos.create', compact('cliente'));
    }

    public function guardarEquipo(Request $request, $clienteId)
    {
        $cliente = Cliente::findOrFail($clienteId);

        $validated = $request->validate([
            'tipo'              => 'required|string|max:255',
            'marca'             => 'nullable|string|max:255',
            'modelo'            => 'nullable|string|max:255',
            'numero_serie'      => 'required|string|max:255|unique:equipos,numero_serie',
            'fecha_instalacion' => 'required|date',
            'garantia_meses'    => 'required|integer',
            'observaciones'     => 'nullable|string',
        ]);

        $validated['cliente_id'] = $cliente->id;

        Equipo::create($validated);

        return redirect()->route('admin.clientes.show', $cliente->id)
                         ->with('success', 'Equipo agregado correctamente.');
    }

    public function equiposCliente(Cliente $cliente)
    {
        $equipos = $cliente->equipos()->latest()->get();
        return view('admin.equipos.index', compact('cliente', 'equipos'));
    }
}
