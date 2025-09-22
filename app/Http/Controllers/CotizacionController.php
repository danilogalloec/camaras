<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    // === Listado de cotizaciones ===
    public function index()
    {
        $cotizaciones = Cotizacion::latest()->paginate(20);
        return view('admin.cotizaciones.index', compact('cotizaciones'));
    }

    // === Formulario de creación ===
    public function create()
    {
        $numero = 'COT-' . Str::upper(Str::random(6));
        return view('admin.cotizaciones.create', compact('numero'));
    }

    // === Guardar una nueva cotización ===
    public function store(Request $request)
    {
        // ✅ Validación corregida
        $validated = $request->validate([
            'numero_cotizacion' => 'required|unique:cotizaciones',
            'nombre'           => 'required|string',
            'cedula'           => 'required|string',
            'direccion'        => 'required|string',
            'correo'           => 'required|email',
            'celular'          => 'required|string',
            'validez_oferta'   => 'required|integer|min:1',
            'impuesto'         => 'required|numeric',
            'subtotal'         => 'required|numeric',
            'total'            => 'required|numeric',
            'items'            => 'required|array|min:1',
            'items.*.item'     => 'nullable|string',
            'items.*.cantidad' => 'nullable|numeric',
            'items.*.precio'   => 'nullable|numeric',
            'items.*.descuento'=> 'nullable|numeric',
            'items.*.total'    => 'nullable|numeric',
        ]);

        DB::transaction(function () use ($request, $validated) {
            $cotizacion = Cotizacion::create([
                'numero_cotizacion' => $validated['numero_cotizacion'],
                'nombre'            => $validated['nombre'],
                'cedula'            => $validated['cedula'],
                'direccion'         => $validated['direccion'],
                'correo'            => $validated['correo'],
                'celular'           => $validated['celular'],
                'validez_oferta'    => $validated['validez_oferta'],
                'subtotal'          => $validated['subtotal'],
                'impuesto'          => $validated['impuesto'],
                'total'             => $validated['total'],
                'notas'             => $request->notas ?? '',
                'condiciones'       => $request->condiciones ?? '',
                'estado'            => 'pendiente',
            ]);

            // Guardar items si existen
            foreach ($validated['items'] as $item) {
                $cotizacion->items()->create([
                    'item'      => $item['item'] ?? '',
                    'cantidad'  => $item['cantidad'] ?? 0,
                    'precio'    => $item['precio'] ?? 0,
                    'descuento' => $item['descuento'] ?? 0,
                    'total'     => $item['total'] ?? 0,
                ]);
            }
        });

        return redirect()->route('admin.cotizaciones.index')
            ->with('success', 'Cotización creada correctamente.');
    }

    // === Ver detalle de una cotización ===
    public function show(Cotizacion $cotizacion)
    {
        $cotizacion->load('items');
        return view('admin.cotizaciones.show', compact('cotizacion'));
    }

    // === Editar una cotización ===
    public function edit(Cotizacion $cotizacion)
    {
        $cotizacion->load('items');
        return view('admin.cotizaciones.edit', compact('cotizacion'));
    }

    // === Actualizar una cotización ===
    public function update(Request $request, Cotizacion $cotizacion)
    {
        // ✅ Validación igual a la de store
        $validated = $request->validate([
            'nombre'           => 'required|string',
            'cedula'           => 'required|string',
            'direccion'        => 'required|string',
            'correo'           => 'required|email',
            'celular'          => 'required|string',
            'validez_oferta'   => 'required|integer|min:1',
            'impuesto'         => 'required|numeric',
            'subtotal'         => 'required|numeric',
            'total'            => 'required|numeric',
            'items'            => 'required|array|min:1',
            'items.*.item'     => 'nullable|string',
            'items.*.cantidad' => 'nullable|numeric',
            'items.*.precio'   => 'nullable|numeric',
            'items.*.descuento'=> 'nullable|numeric',
            'items.*.total'    => 'nullable|numeric',
        ]);

        DB::transaction(function () use ($request, $validated, $cotizacion) {
            $cotizacion->update([
                'nombre'         => $validated['nombre'],
                'cedula'         => $validated['cedula'],
                'direccion'      => $validated['direccion'],
                'correo'         => $validated['correo'],
                'celular'        => $validated['celular'],
                'validez_oferta' => $validated['validez_oferta'],
                'subtotal'       => $validated['subtotal'],
                'impuesto'       => $validated['impuesto'],
                'total'          => $validated['total'],
                'notas'          => $request->notas ?? '',
                'condiciones'    => $request->condiciones ?? '',
            ]);

            // Limpiar items anteriores
            $cotizacion->items()->delete();

            // Guardar items nuevos
            foreach ($validated['items'] as $item) {
                $cotizacion->items()->create([
                    'item'      => $item['item'] ?? '',
                    'cantidad'  => $item['cantidad'] ?? 0,
                    'precio'    => $item['precio'] ?? 0,
                    'descuento' => $item['descuento'] ?? 0,
                    'total'     => $item['total'] ?? 0,
                ]);
            }
        });

        return redirect()->route('admin.cotizaciones.show', $cotizacion->id)
            ->with('success', 'Cotización actualizada correctamente.');
    }

    // === Aprobar y crear cliente ===
    public function aprobar(Cotizacion $cotizacion)
    {
        if ($cotizacion->estado === 'aprobada') {
            return back()->with('info', 'La cotización ya está aprobada.');
        }

        $cliente = Cliente::create([
            'nombre'               => $cotizacion->nombre,
            'cedula'               => $cotizacion->cedula,
            'direccion'            => $cotizacion->direccion,
            'correo'               => $cotizacion->correo,
            'telefono'             => $cotizacion->celular,
            'fecha_instalacion'    => now(),
            'num_equipos'          => 0,
            'tiempo_garantia_meses'=> 12,
            'password'             => bcrypt(substr($cotizacion->cedula, -5)),
            'primer_login'         => 1,
        ]);

        $cotizacion->update([
            'estado'     => 'aprobada',
            'cliente_id' => $cliente->id,
        ]);

        return redirect()
            ->route('admin.clientes.show', $cliente->id)
            ->with('success', 'La cotización fue aprobada y convertida en cliente.');
    }

    // === Eliminar una cotización ===
    public function destroy(Cotizacion $cotizacion)
    {
        DB::transaction(function () use ($cotizacion) {
            $cotizacion->items()->delete();
            $cotizacion->delete();
        });

        return redirect()->route('admin.cotizaciones.index')
            ->with('success', 'Cotización eliminada correctamente');
    }
}
