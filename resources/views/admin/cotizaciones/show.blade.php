@extends('layouts.app')

@section('content')
<div class="py-10"> {{-- ✅ margen superior igual que en otras vistas --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-md p-8 print-area">

            {{-- Título --}}
            <h1 class="text-2xl font-bold mb-8 text-gray-800">
                Cotización {{ $cotizacion->numero_cotizacion }}
            </h1>

            {{-- Datos del cliente --}}
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div>
                    <p><strong>Cliente:</strong> {{ $cotizacion->nombre }}</p>
                    <p><strong>Cédula:</strong> {{ $cotizacion->cedula }}</p>
                    <p><strong>Correo:</strong> {{ $cotizacion->correo }}</p>
                    <p><strong>Celular:</strong> {{ $cotizacion->celular }}</p>
                </div>
                <div>
                    <p><strong>Dirección:</strong> {{ $cotizacion->direccion }}</p>
                    <p><strong>Validez de la oferta:</strong> {{ $cotizacion->validez_oferta }} días</p>
                    <p>
                        <strong>Estado:</strong>
                        <span class="px-2 py-1 rounded text-white
                            {{ $cotizacion->estado === 'aprobada' ? 'bg-green-600' : 'bg-yellow-500' }}">
                            {{ ucfirst($cotizacion->estado) }}
                        </span>
                    </p>
                </div>
            </div>

            {{-- Tabla de items --}}
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Items</h2>
            <div class="overflow-x-auto mb-8">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Item</th>
                            <th class="px-4 py-2 text-left">Cantidad</th>
                            <th class="px-4 py-2 text-left">Precio</th>
                            <th class="px-4 py-2 text-left">Desc.%</th>
                            <th class="px-4 py-2 text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($cotizacion->items as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->item }}</td>
                            <td class="px-4 py-2">{{ $item->cantidad }}</td>
                            <td class="px-4 py-2">${{ number_format($item->precio, 2) }}</td>
                            <td class="px-4 py-2">{{ $item->descuento }}%</td>
                            <td class="px-4 py-2">${{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Totales --}}
            <div class="text-right mb-8">
                <p><strong>Subtotal:</strong> ${{ number_format($cotizacion->subtotal, 2) }}</p>
                <p><strong>Impuesto:</strong> {{ $cotizacion->impuesto }} %</p>
                <p class="text-lg font-bold"><strong>Total:</strong> ${{ number_format($cotizacion->total, 2) }}</p>
            </div>

            {{-- Notas y condiciones --}}
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="font-semibold text-gray-800">Notas</h3>
                    <p class="text-gray-700">{{ $cotizacion->notas ?: 'Nada' }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Condiciones</h3>
                    <p class="text-gray-700">{{ $cotizacion->condiciones ?: 'Nada' }}</p>
                </div>
            </div>

            {{-- Botones de acción (no se imprimen) --}}
            <div class="flex flex-wrap gap-4 mt-10 no-print">
                @if($cotizacion->estado === 'pendiente')
                    <form method="POST" action="{{ route('admin.cotizaciones.aprobar', $cotizacion) }}">
                        @csrf
                        <button
                            class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition">
                            Aprobar y crear cliente
                        </button>
                    </form>
                @else
                    <div class="p-4 bg-green-100 text-green-800 rounded-lg">
                        Esta cotización ya fue aprobada y convertida en cliente.
                    </div>
                @endif

                <a href="{{ route('admin.cotizaciones.edit', $cotizacion->id) }}"
                   class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
                    ✏️ Editar Cotización
                </a>

<a href="javascript:window.print()"
   class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition no-print inline-flex items-center gap-2">
    🖨️ Imprimir / Guardar PDF
</a>
            </div>

            {{-- Volver --}}
            <div class="mt-8 no-print">
                <a href="{{ route('admin.cotizaciones.index') }}"
                   class="text-blue-600 hover:underline">&larr; Volver al listado</a>
            </div>
        </div>
    </div>
</div>
@endsection
