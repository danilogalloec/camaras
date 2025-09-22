@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">Agregar Nuevo Cliente</h1>

    <div class="bg-white shadow-md rounded-xl p-8">
        <form action="{{ route('admin.clientes.crear') }}" method="POST" class="form-grid gap-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Cédula</label>
                <input type="text" name="cedula" class="form-control" placeholder="Ej: 1712345678" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="telefono" class="form-control" placeholder="0999999999" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" class="form-control" placeholder="correo@ejemplo.com" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" class="form-control" placeholder="Dirección" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha de instalación</label>
                <input type="text" name="fecha_instalacion" class="form-control datepicker" placeholder="Selecciona la fecha" required>
            </div>

            <div class="md:col-span-2 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 transition">
                    Guardar Cliente
                </button>
            </div>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded shadow hover:bg-gray-700">
            ← Volver al Dashboard
        </a>
    </div>

</div>
@endsection
