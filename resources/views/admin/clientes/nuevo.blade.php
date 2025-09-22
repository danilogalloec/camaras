@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Nuevo Cliente</h1>

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

        <form action="{{ route('admin.clientes.store') }}" method="POST">
            @csrf

            <h2 class="text-lg font-semibold text-gray-800 mb-4">Datos del Cliente</h2>

            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500"
                           placeholder="Nombre completo" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Cédula</label>
                    <input type="text" name="cedula" value="{{ old('cedula') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500"
                           placeholder="Ej: 1712345678" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500"
                           placeholder="Calle, número, referencia" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Correo</label>
                    <input type="email" name="correo" value="{{ old('correo') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500"
                           placeholder="correo@dominio.com" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Celular</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500"
                           placeholder="0999999999" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Fecha de instalación</label>
                    <input type="date" name="fecha_instalacion" value="{{ old('fecha_instalacion') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-50 px-3 py-2 shadow-sm focus:ring-1 focus:ring-blue-500"
                           required>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.clientes') }}"
                   class="text-blue-600 hover:underline">&larr; Volver al listado</a>

                <button type="submit"
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition">
                    Guardar Cliente
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
