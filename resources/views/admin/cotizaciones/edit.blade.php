@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Editar Cotización {{ $cotizacion->numero_cotizacion }}
        </h1>
        <a href="{{ route('admin.cotizaciones.show', $cotizacion->id) }}"
           class="text-blue-600 hover:underline">← Volver a detalle</a>
    </div>

    <form method="POST" action="{{ route('admin.cotizaciones.update', $cotizacion->id) }}"
          id="form-cotizacion"
          class="space-y-8 bg-white p-6 rounded-xl shadow-md">
        @csrf
        @method('PUT')

        {{-- Datos del cliente --}}
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Datos del Cliente</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Nombre</label>
                    <input name="nombre" class="form-control w-full"
                           value="{{ old('nombre', $cotizacion->nombre) }}" required />
                </div>
                <div>
                    <label class="block font-medium mb-1">Cédula</label>
                    <input name="cedula" class="form-control w-full"
                           value="{{ old('cedula', $cotizacion->cedula) }}" required />
                </div>
                <div>
                    <label class="block font-medium mb-1">Dirección</label>
                    <input name="direccion" class="form-control w-full"
                           value="{{ old('direccion', $cotizacion->direccion) }}" required />
                </div>
                <div>
                    <label class="block font-medium mb-1">Correo</label>
                    <input type="email" name="correo" class="form-control w-full"
                           value="{{ old('correo', $cotizacion->correo) }}" required />
                </div>
                <div>
                    <label class="block font-medium mb-1">Celular</label>
                    <input name="celular" class="form-control w-full"
                           value="{{ old('celular', $cotizacion->celular) }}" required />
                </div>
                <div>
                    <label class="block font-medium mb-1">Validez de la oferta (en días)</label>
                    {{-- ✅ CORREGIDO: type="number" para que siempre sea un entero --}}
                    <input type="number"
                           name="validez_oferta"
                           value="{{ old('validez_oferta', $cotizacion->validez_oferta) }}"
                           class="form-control w-full"
                           placeholder="Ej: 30"
                           min="1"
                           required />
                </div>
            </div>
        </div>

        {{-- Ítems --}}
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Items</h2>
            <div class="overflow-x-auto">
                <table id="tabla-items" class="min-w-full border divide-y divide-gray-200 text-sm mb-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Item</th>
                            <th class="px-4 py-2 text-left">Cantidad</th>
                            <th class="px-4 py-2 text-left">Precio</th>
                            <th class="px-4 py-2 text-left">Desc.%</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cotizacion->items as $i => $item)
                        <tr>
                            <td class="px-2 py-1">
                                <input name="items[{{ $i }}][item]" class="form-control w-full"
                                       value="{{ $item->item }}" required>
                            </td>
                            <td class="px-2 py-1">
                                <input name="items[{{ $i }}][cantidad]" type="number"
                                       class="form-control cantidad w-full"
                                       value="{{ $item->cantidad }}" required>
                            </td>
                            <td class="px-2 py-1">
                                <input name="items[{{ $i }}][precio]" type="number" step="0.01"
                                       class="form-control precio w-full"
                                       value="{{ $item->precio }}" required>
                            </td>
                            <td class="px-2 py-1">
                                <input name="items[{{ $i }}][descuento]" type="number" step="0.01"
                                       class="form-control descuento w-full"
                                       value="{{ $item->descuento }}">
                            </td>
                            <td class="px-2 py-1">
                                <input name="items[{{ $i }}][total]" type="number" step="0.01"
                                       class="form-control total-item w-full"
                                       value="{{ $item->total }}" readonly>
                            </td>
                            <td class="px-2 py-1 text-center">
                                <button type="button" class="text-red-600 remove">✕</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="button" id="add-item"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow">
                + Añadir artículo
            </button>
        </div>

        {{-- Notas y condiciones --}}
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Notas y Condiciones</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Notas</label>
                    <textarea name="notas" rows="4" class="form-control w-full">{{ old('notas', $cotizacion->notas) }}</textarea>
                </div>
                <div>
                    <label class="block font-medium mb-1">Condiciones</label>
                    <textarea name="condiciones" rows="4" class="form-control w-full">{{ old('condiciones', $cotizacion->condiciones) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Totales --}}
        <div class="bg-gray-50 p-4 rounded-xl grid md:grid-cols-3 gap-4">
            <div>
                <label class="block font-medium mb-1">Subtotal</label>
                <input name="subtotal" id="subtotal"
                       class="form-control w-full text-right"
                       value="{{ old('subtotal', $cotizacion->subtotal) }}" readonly />
            </div>
            <div>
                <label class="block font-medium mb-1">Impuesto %</label>
                <input name="impuesto" id="impuesto"
                       class="form-control w-full text-right"
                       value="{{ old('impuesto', $cotizacion->impuesto) }}" />
            </div>
            <div>
                <label class="block font-medium mb-1">Total</label>
                <input name="total" id="total"
                       class="form-control w-full text-right font-bold"
                       value="{{ old('total', $cotizacion->total) }}" readonly />
            </div>
        </div>

        <div class="flex justify-end">
            <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

<script>
const tabla = document.querySelector('#tabla-items tbody');
let itemIndex = {{ count($cotizacion->items) }};

document.querySelector('#add-item').addEventListener('click', () => {
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td class="px-2 py-1"><input name="items[${itemIndex}][item]" class="form-control w-full" required></td>
    <td class="px-2 py-1"><input name="items[${itemIndex}][cantidad]" type="number" class="form-control cantidad w-full" required></td>
    <td class="px-2 py-1"><input name="items[${itemIndex}][precio]" type="number" step="0.01" class="form-control precio w-full" required></td>
    <td class="px-2 py-1"><input name="items[${itemIndex}][descuento]" type="number" step="0.01" value="0" class="form-control descuento w-full"></td>
    <td class="px-2 py-1"><input name="items[${itemIndex}][total]" type="number" step="0.01" class="form-control total-item w-full" readonly></td>
    <td class="px-2 py-1 text-center"><button type="button" class="text-red-600 remove">✕</button></td>`;
  tabla.appendChild(tr);
  itemIndex++;
  tabla.dispatchEvent(new Event('input'));
});

tabla.addEventListener('input', () => {
  let subtotal = 0;
  tabla.querySelectorAll('tr').forEach(tr => {
    const cantidad = parseFloat(tr.querySelector('.cantidad')?.value || 0);
    const precio   = parseFloat(tr.querySelector('.precio')?.value || 0);
    const desc     = parseFloat(tr.querySelector('.descuento')?.value || 0);
    const total    = cantidad * precio * (1 - desc / 100);
    tr.querySelector('.total-item').value = total.toFixed(2);
    subtotal += total;
  });
  document.getElementById('subtotal').value = subtotal.toFixed(2);
  const iva = parseFloat(document.getElementById('impuesto').value || 0);
  document.getElementById('total').value = (subtotal * (1 + iva / 100)).toFixed(2);
});

tabla.addEventListener('click', e => {
  if (e.target.classList.contains('remove')) {
    e.target.closest('tr').remove();
    tabla.dispatchEvent(new Event('input'));
  }
});

document.getElementById('impuesto').addEventListener('input', () =>
  tabla.dispatchEvent(new Event('input'))
);
</script>
@endsection
