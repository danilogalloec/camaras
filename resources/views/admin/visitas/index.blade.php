@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ===== Encabezado ===== --}}
    <div class="flex flex-col items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Administración de Visitas Técnicas</h1>
    </div>

    {{-- ===== Tabla de visitas ===== --}}
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Comentario</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($visitas as $visita)
                    <tr>
                        <td class="px-6 py-4">{{ $visita->cliente->nombre }}</td>
                        <td class="px-6 py-4">{{ $visita->fecha_visita }}</td>
                        <td class="px-6 py-4">{{ $visita->comentario }}</td>
                        <td class="px-6 py-4">
                            @if($visita->atendida)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                    ✅ Atendida
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                    ⏳ Pendiente
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            @if(!$visita->atendida)
                                <form method="POST" action="{{ route('admin.visitas.atendida', $visita->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                        Marcar como atendida
                                    </button>
                                </form>
                            @endif

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('admin.visitas.eliminar', $visita->id) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar esta visita?')">
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
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No hay visitas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
