@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ===== Encabezado y Buscador ===== --}}
    <div class="flex flex-col items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Lista de Clientes</h1>
        <form method="GET" action="{{ route('admin.clientes') }}" class="w-full sm:w-1/2 lg:w-1/3">
            <input type="text"
                   name="cedula"
                   value="{{ request('cedula') }}"
                   placeholder="Escribe la cédula y presiona Enter"
                   class="form-control text-center"
                   autofocus>
        </form>
    </div>

    {{-- ===== Tabla de clientes ===== --}}
    <div class="bg-white shadow-md rounded-xl overflow-hidden mb-12">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cédula</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teléfono</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Equipos</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($clientes as $cliente)
                    <tr>
                        <td class="px-6 py-4">{{ $cliente->cedula }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.clientes.show', $cliente->id) }}"
                               class="text-blue-600 hover:underline font-medium">
                               {{ $cliente->nombre }}
                            </a>
                        </td>
                        <td class="px-6 py-4">{{ $cliente->telefono }}</td>
                        <td class="px-6 py-4">{{ $cliente->correo }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.clientes.show', $cliente->id) }}"
                               class="px-3 py-1 bg-indigo-600 text-white text-xs font-semibold rounded hover:bg-indigo-700 transition">
                               {{ $cliente->equipos_count }} Ver
                            </a>
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.clientes.editar', $cliente->id) }}"
                               class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                Editar
                            </a>
                            <form action="{{ route('admin.clientes.eliminar', $cliente->id) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar este cliente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700 transition">
                                    Eliminar
                                </button>
                            </form>
                            <a href="{{ route('admin.clientes.equipos.create', $cliente->id) }}"
                               class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded hover:bg-green-700 transition">
                                + Equipo
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No hay clientes registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
