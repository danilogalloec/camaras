@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">
        Equipos de {{ $cliente->nombre }}
    </h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marca</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Modelo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Serie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Garantía (meses)</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($equipos as $equipo)
                <tr>
                    <td class="px-6 py-4">{{ $equipo->tipo }}</td>
                    <td class="px-6 py-4">{{ $equipo->marca }}</td>
                    <td class="px-6 py-4">{{ $equipo->modelo }}</td>
                    <td class="px-6 py-4">{{ $equipo->numero_serie }}</td>
                    <td class="px-6 py-4">{{ $equipo->garantia_meses }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.clientes') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow hover:bg-blue-700">
           ← Volver a la lista de clientes
        </a>
    </div>
</div>
@endsection
