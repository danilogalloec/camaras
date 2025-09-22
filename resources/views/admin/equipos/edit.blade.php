@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
        Editar Equipo de {{ $cliente->nombre }}
    </h1>

    <div class="bg-white shadow-md rounded-lg p-8">
        <form action="{{ route('admin.clientes.equipos.update', [$cliente->id, $equipo->id]) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo</label>
                    <input type="text" name="tipo" required class="form-control"
                           value="{{ old('tipo',$equipo->tipo) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Marca</label>
                    <input type="text" name="marca" class="form-control"
                           value="{{ old('marca',$equipo->marca) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Modelo</label>
                    <input type="text" name="modelo" class="form-control"
                           value="{{ old('modelo',$equipo->modelo) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Número de Serie</label>
                    <input type="text" name="numero_serie" required class="form-control"
                           value="{{ old('numero_serie',$equipo->numero_serie) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Instalación</label>
                    <input type="text" name="fecha_instalacion" required
                           class="form-control datepicker"
                           value="{{ old('fecha_instalacion',$equipo->fecha_instalacion) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Garantía (meses)</label>
                    <input type="number" name="garantia_meses" required class="form-control"
                           value="{{ old('garantia_meses',$equipo->garantia_meses) }}">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Observaciones</label>
                <textarea name="observaciones" class="form-control">{{ old('observaciones',$equipo->observaciones) }}</textarea>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('admin.clientes.show', $cliente->id) }}"
                   class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                    ← Volver al cliente
                </a>
                <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-blue-600 text-white text-lg font-bold rounded-md shadow hover:bg-blue-700 transition">
                    Actualizar Equipo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
