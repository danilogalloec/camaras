@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">Editar Cliente</h1>

    <div class="bg-white shadow-md rounded-xl p-8">
        <form action="{{ route('admin.clientes.actualizar', $cliente->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Cédula</label>
                <input type="text" name="cedula" value="{{ $cliente->cedula }}" class="form-control" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" value="{{ $cliente->nombre }}" class="form-control" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="form-control" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" value="{{ $cliente->correo }}" class="form-control" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" value="{{ $cliente->direccion }}" class="form-control" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha de instalación</label>
                <input type="date" name="fecha_instalacion" value="{{ $cliente->fecha_instalacion }}" class="form-control" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.clientes') }}"
                   class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-md shadow hover:bg-gray-600 transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 transition">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
