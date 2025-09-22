@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Nueva Cotización</h1>

    <div class="bg-white rounded-xl shadow p-6">
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.cotizaciones.store') }}" method="POST">
            @csrf

            <input type="hidden" name="numero_cotizacion"
                   value="COT-{{ strtoupper(Str::random(5)) }}">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">Datos del Cliente</h2>

            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Cédula</label>
                    <input type="text" name="cedula" value="{{ old('cedula') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Correo</label>
                    <input type="email" name="correo" value="{{ old('correo') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Celular</label>
                    <input type="text" name="celular" value="{{ old('celular') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Validez de la oferta (en días)</label>
                    <input type="number" name="validez_oferta" value="{{ old('validez_oferta') }}"
                           placeholder="Ej: 30"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500">
                </div>
            </div>

            {{-- === Items === --}}
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Items</h2>
            <div class="overflow-x-auto mb-6">
                <table class="min-w-full table-fixed divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left w-[40%]">Item</th>
                            <th class="px-3 py-2 text-left w-[12%]">Cantidad</th>
                            <th class="px-3 py-2 text-left w-[16%]">Precio</th>
                            <th class="px-3 py-2 text-left w-[12%]">Desc.%</th>
                            <th class="px-3 py-2 text-left w-[16%]">Total</th>
                            <th class="px-2 py-2 w-[4%]"></th>
                        </tr>
                    </thead>
                    <tbody id="items-table" class="divide-y divide-gray-200"></tbody>
                </table>
            </div>

            <button type="button" id="add-item"
                    class="mb-6 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
                + Agregar Item
            </button>

            <div class="text-right mb-6">
                <p><strong>Subtotal:</strong> $<span id="subtotal">0.00</span></p>
                <p><strong>Impuesto:</strong>
                    <input type="number" name="impuesto" value="{{ old('impuesto', 15) }}"
                           class="inline-block w-20 text-right border border-gray-300 rounded-lg bg-gray-50 px-2 py-1 shadow-sm focus:ring-1 focus:ring-blue-500"> %
                </p>
                <p class="text-lg font-bold"><strong>Total:</strong> $<span id="total">0.00</span></p>
            </div>

            <input type="hidden" name="subtotal" id="subtotal-input">
            <input type="hidden" name="total" id="total-input">

            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium">Notas</label>
                    <textarea name="notas" rows="4"
                              class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500">{{ old('notas') }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Condiciones</label>
                    <textarea name="condiciones" rows="4"
                              class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500">{{ old('condiciones') }}</textarea>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.cotizaciones.index') }}"
                   class="text-blue-600 hover:underline">&larr; Volver al listado</a>

                <button type="submit"
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition">
                    Guardar Cotización
                </button>
            </div>
        </form>
    </div>
</div>

{{-- === Script dinámico === --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addItem = document.getElementById('add-item');
    const itemsTable = document.getElementById('items-table');
    const subtotalSpan = document.getElementById('subtotal');
    const totalSpan = document.getElementById('total');
    const impuestoInput = document.querySelector('input[name="impuesto"]');
    const subtotalInput = document.getElementById('subtotal-input');
    const totalInput = document.getElementById('total-input');

    function updateTotals() {
        let subtotal = 0;
        itemsTable.querySelectorAll('tr').forEach(tr => {
            const total = parseFloat(tr.querySelector('.item-total').value) || 0;
            subtotal += total;
        });
        subtotalSpan.textContent = subtotal.toFixed(2);
        const impuesto = parseFloat(impuestoInput.value) || 0;
        totalSpan.textContent = (subtotal * (1 + impuesto / 100)).toFixed(2);
    }

    function newRow() {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="px-3 py-2">
                <input name="items[][item]" class="w-full border border-gray-300 rounded-lg bg-gray-50 px-2 py-1 shadow-sm">
            </td>
            <td class="px-3 py-2">
                <input name="items[][cantidad]" type="number" min="1"
                       class="w-full border border-gray-300 rounded-lg bg-gray-50 px-2 py-1 shadow-sm text-right item-cantidad">
            </td>
            <td class="px-3 py-2">
                <input name="items[][precio]" type="number" step="0.01"
                       class="w-full border border-gray-300 rounded-lg bg-gray-50 px-2 py-1 shadow-sm text-right item-precio">
            </td>
            <td class="px-3 py-2">
                <input name="items[][descuento]" type="number" step="0.01" value="0"
                       class="w-full border border-gray-300 rounded-lg bg-gray-50 px-2 py-1 shadow-sm text-right item-descuento">
            </td>
            <td class="px-3 py-2">
                <input name="items[][total]" type="number" step="0.01" readonly
                       class="w-full border border-gray-300 rounded-lg bg-gray-50 px-2 py-1 shadow-sm text-right item-total">
            </td>
            <td class="px-2 py-2 text-center">
                <button type="button" class="text-red-500 hover:text-red-700 remove-row" title="Eliminar">✖</button>
            </td>
        `;
        return tr;
    }

    addItem.addEventListener('click', () => {
        itemsTable.appendChild(newRow());
    });

    itemsTable.addEventListener('input', e => {
        const tr = e.target.closest('tr');
        if (!tr) return;
        const cantidad = parseFloat(tr.querySelector('.item-cantidad').value) || 0;
        const precio   = parseFloat(tr.querySelector('.item-precio').value) || 0;
        const desc     = parseFloat(tr.querySelector('.item-descuento').value) || 0;
        const total    = cantidad * precio * (1 - desc / 100);
        tr.querySelector('.item-total').value = total.toFixed(2);
        updateTotals();
    });

    itemsTable.addEventListener('click', e => {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
            updateTotals();
        }
    });

    impuestoInput.addEventListener('input', updateTotals);

    // Antes de enviar, guardar totales en hidden
    document.querySelector('form').addEventListener('submit', function(){
        subtotalInput.value = subtotalSpan.textContent;
        totalInput.value = totalSpan.textContent;
    });

    // === Autocompletar cliente por cédula ===
    const cedulaInput = document.querySelector('input[name="cedula"]');
    cedulaInput.addEventListener('blur', function () {
        const cedula = cedulaInput.value.trim();
        if (!cedula) return;

        fetch(`/admin/clientes/buscar/${cedula}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.querySelector('input[name="nombre"]').value    = data.cliente.nombre;
                    document.querySelector('input[name="direccion"]').value = data.cliente.direccion;
                    document.querySelector('input[name="correo"]').value    = data.cliente.correo;
                    document.querySelector('input[name="celular"]').value   = data.cliente.celular;
                }
            })
            .catch(err => console.error('Error buscando cliente', err));
    });
});
</script>
@endsection
