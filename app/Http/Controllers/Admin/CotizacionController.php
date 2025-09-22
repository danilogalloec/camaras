<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    /**
     * Muestra el listado de cotizaciones
     */
    public function index()
    {
        $cotizaciones = Cotizacion::orderBy('created_at', 'desc')->get();
        return view('admin.cotizaciones.index', compact('cotizaciones'));
    }

    /**
     * Muestra el formulario de creación
     */
    public function create()
    {
        return view('admin.cotizaciones.create');
    }

    /**
     * Guarda una nueva cotización y sus items
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_cotizacion' => 'required|unique:cotizaciones',
            'nombre'            => 'required|string',
            'cedula'            => 'required|string',
            'direccion'         => 'required|string',
            'correo'            => 'required|email',
            'celular'           => 'required|string',
            'validez_oferta'    => 'required|integer|min:1',
            'subtotal'          => 'required|numeric',
            'impuesto'          => 'required|numeric',
            'total'             => 'required|numeric',
            'items'             => 'required|array'
        ]);

        DB::transaction(function () use ($validated, $request) {
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
                'estado'            => 'pendiente',
                'notas'             => $request->notas,
                'condiciones'       => $request->condiciones,
            ]);

            foreach ($validated['items'] as $item) {
                $cotizacion->items()->create($item);
            }
        });

        return redirect()->route('admin.cotizaciones.index')
            ->with('success', 'Cotización creada correctamente.');
    }

    /**
     * Muestra el detalle de una cotización
     */
    public function show(Cotizacion $cotizacion)
    {
        $cotizacion->load('items');
        return view('admin.cotizaciones.show', compact('cotizacion'));
    }

    /**
     * Formulario de edición
     */
    public function edit(Cotizacion $cotizacion)
    {
        $cotizacion->load('items');
        return view('admin.cotizaciones.edit', compact('cotizacion'));
    }

    /**
     * Actualiza una cotización
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        $validated = $request->validate([
            'nombre'         => 'required|string',
            'cedula'         => 'required|string',
            'direccion'      => 'required|string',
            'correo'         => 'required|email',
            'celular'        => 'required|string',
            'validez_oferta' => 'required|integer|min:1',
            'subtotal'       => 'required|numeric',
            'impuesto'       => 'required|numeric',
            'total'          => 'required|numeric',
            'items'          => 'required|array'
        ]);

        DB::transaction(function () use ($validated, $request, $cotizacion) {
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
                'notas'          => $request->notas,
                'condiciones'    => $request->condiciones,
            ]);

            // limpiar e insertar de nuevo los items
            $cotizacion->items()->delete();
            foreach ($validated['items'] as $item) {
                $cotizacion->items()->create($item);
            }
        });

        return redirect()->route('admin.cotizaciones.show', $cotizacion)
            ->with('success', 'Cotización actualizada correctamente.');
    }

    /**
     * Aprueba una cotización y crea el cliente si no existe
     */
    public function aprobar(Cotizacion $cotizacion)
    {
        DB::transaction(function () use ($cotizacion) {

            // ✅ Buscar cliente por cédula
            $cliente = Cliente::where('cedula', $cotizacion->cedula)->first();

            // ✅ Si no existe, crear
            if (! $cliente) {
                $cliente = Cliente::create([
                    'cedula'                => $cotizacion->cedula,
                    'nombre'                => $cotizacion->nombre,
                    'telefono'              => $cotizacion->celular,
                    'correo'                => $cotizacion->correo,
                    'direccion'             => $cotizacion->direccion,
                    'fecha_instalacion'     => now(),
                    'num_equipos'           => $cotizacion->items->count(),
                    'tiempo_garantia_meses' => 12,
                    'password'              => bcrypt(substr($cotizacion->cedula, -5)),
                    'primer_login'          => true,
                ]);
            }

            // ✅ Actualiza cotización y la asocia al cliente existente o nuevo
            $cotizacion->update([
                'estado'     => 'aprobada',
                'cliente_id' => $cliente->id,
            ]);
        });

        return redirect()->route('admin.cotizaciones.show', $cotizacion)
            ->with('success', 'Cotización aprobada y cliente creado o vinculado.');
    }

    /**
     * Elimina una cotización
     */
    public function destroy(Cotizacion $cotizacion)
    {
        DB::transaction(function () use ($cotizacion) {
            $cotizacion->items()->delete();
            $cotizacion->delete();
        });

        return redirect()->route('admin.cotizaciones.index')
            ->with('success', 'Cotización eliminada.');
    }

    /**
     * Genera el PDF de una cotización
     */
    public function exportPdf(Cotizacion $cotizacion)
    {
        $cotizacion->load('items');

        $pdf = Pdf::loadView('pdf.cotizacion', compact('cotizacion'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('cotizacion-' . $cotizacion->numero_cotizacion . '.pdf');
    }
}
