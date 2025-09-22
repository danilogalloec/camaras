@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ===== FICHA DEL CLIENTE ===== --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Ficha del Cliente</h1>

    <div class="bg-white shadow-md rounded-xl p-8 mb-12 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p><strong>Cédula:</strong> {{ $cliente->cedula }}</p>
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
        </div>
        <div>
            <p><strong>Correo:</strong> {{ $cliente->correo }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            <p><strong>Fecha de instalación:</strong> {{ $cliente->fecha_instalacion }}</p>
        </div>
    </div>

    {{-- ===== EQUIPOS INSTALADOS ===== --}}
    <div class="bg-white shadow-md rounded-xl p-8 mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Equipos Instalados</h2>
            <a href="{{ route('admin.clientes.equipos.create', $cliente->id) }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow hover:bg-blue-700">
                + Agregar Equipo
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marca</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Modelo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Número de Serie</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Garantía (meses)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Observaciones</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($cliente->equipos as $equipo)
                        <tr>
                            <td class="px-6 py-4">{{ $equipo->tipo }}</td>
                            <td class="px-6 py-4">{{ $equipo->marca }}</td>
                            <td class="px-6 py-4">{{ $equipo->modelo }}</td>
                            <td class="px-6 py-4">{{ $equipo->numero_serie }}</td>
                            <td class="px-6 py-4">{{ $equipo->garantia_meses }}</td>
                            <td class="px-6 py-4">{{ $equipo->observaciones }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.clientes.equipos.edit', [$cliente->id, $equipo->id]) }}"
                                   class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                    Editar
                                </a>
                                <form action="{{ route('admin.clientes.equipos.destroy', [$cliente->id, $equipo->id]) }}"
                                      method="POST" onsubmit="return confirm('¿Eliminar este equipo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700 transition">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No hay equipos registrados para este cliente.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===== VISITAS AGENDADAS ===== --}}
    <div class="bg-white shadow-md rounded-xl p-8 mt-12">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Visitas agendadas</h2>
        </div>

        @if ($cliente->visitas->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Comentario</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cliente->visitas as $visita)
                            <tr>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($visita->fecha_visita)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ $visita->comentario }}</td>
                                <td class="px-6 py-4">
                                    @if($visita->atendida)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Atendida</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pendiente</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No hay visitas agendadas para este cliente.</p>
        @endif
    </div>

    <div class="mt-8">
        <a href="{{ route('admin.clientes') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded shadow hover:bg-gray-700">
            ← Volver a la lista de clientes
        </a>
    </div>
</div>
@endsection
