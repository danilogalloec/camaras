@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Listado de Cotizaciones</h1>
        <a href="{{ route('admin.cotizaciones.create') }}"
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
            + Nueva Cotización
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">NÚMERO</th>
                        <th class="px-4 py-2 text-left">CLIENTE</th>
                        <th class="px-4 py-2 text-left">FECHA</th>
                        <th class="px-4 py-2 text-right">TOTAL</th>
                        <th class="px-2 py-2 text-center w-10"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($cotizaciones as $cotizacion)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 font-semibold text-blue-600">
                                <a href="{{ route('admin.cotizaciones.show', $cotizacion) }}"
                                   class="hover:underline">
                                    {{ $cotizacion->numero_cotizacion }}
                                </a>
                            </td>
                            <td class="px-4 py-2">{{ $cotizacion->nombre }}</td>
                            <td class="px-4 py-2">{{ $cotizacion->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 text-right">
                                ${{ number_format($cotizacion->total, 2) }}
                            </td>
                            <td class="px-2 py-2 text-center">
                                <form action="{{ route('admin.cotizaciones.destroy', $cotizacion) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar esta cotización?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-700 transition"
                                            title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-5 h-5 inline-block"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
