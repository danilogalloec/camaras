@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
        Bienvenido, {{ $cliente->nombre }}
    </h1>

    {{-- Datos del Cliente --}}
    <div class="bg-white shadow-md rounded-xl p-8 mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
<div>
    <p><strong>Cédula:</strong> {{ $cliente->cedula }}</p>
    <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
    <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
    <p><strong>Correo:</strong> {{ $cliente->correo }}</p>
</div>
        <div>
            <p><strong>Fecha instalación:</strong> {{ $cliente->fecha_instalacion }}</p>
        </div>
    </div>

    {{-- Equipos Instalados --}}
    <div class="bg-white shadow-md rounded-xl p-8 mb-8">
        <h2 class="text-2xl font-bold mb-4">Equipos Instalados</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tipo</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Marca</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Modelo</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">N° Serie</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Fecha Instalación</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Garantía (meses)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Observaciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($cliente->equipos as $equipo)
                    <tr>
                        <td class="px-4 py-2">{{ $equipo->tipo }}</td>
                        <td class="px-4 py-2">{{ $equipo->marca ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $equipo->modelo ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $equipo->numero_serie }}</td>
                        <td class="px-4 py-2">{{ $equipo->fecha_instalacion }}</td>
                        <td class="px-4 py-2">{{ $equipo->garantia_meses ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $equipo->observaciones ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">
                            No hay equipos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Botones en una sola fila --}}
    <div class="flex justify-center space-x-4 mb-8">
        <a href="{{ route('cliente.agendar_visita') }}"
           class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded shadow-md transition">
            📅 Agendar Visita Técnica
        </a>
        <button onclick="document.getElementById('perfil-form').classList.toggle('hidden')"
                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded shadow-md transition">
            ✏️ Actualizar Perfil
        </button>
    </div>

    {{-- Formulario de actualización de perfil --}}
    <div id="perfil-form" class="bg-white shadow-md rounded-xl p-8 hidden">
        <form action="{{ route('cliente.update_profile') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="form-control" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" value="{{ $cliente->correo }}" class="form-control" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" value="{{ $cliente->direccion }}" class="form-control" required>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
