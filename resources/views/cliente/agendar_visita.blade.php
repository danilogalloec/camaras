@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
        Agendar Visita Técnica
    </h1>

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Errores --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-md shadow">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-xl p-8">
        <form action="{{ route('cliente.agendar_visita.store') }}" method="POST" class="form-grid gap-y-6">
            @csrf

            {{-- Fecha de la visita --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha de la visita</label>
                <input type="text"
                       name="fecha_visita"
                       class="form-control datepicker"
                       placeholder="Selecciona la fecha"
                       required>
            </div>

            {{-- Comentario --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Comentario (problema técnico)</label>
                <textarea name="comentario"
                          rows="4"
                          class="form-control"
                          placeholder="Describe el problema o motivo de la visita"
                          required></textarea>
            </div>

            {{-- Botón --}}
            <div class="md:col-span-2 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 transition">
                    Agendar Visita
                </button>
            </div>
        </form>
    </div>

    {{-- Volver --}}
    <div class="mt-8 text-center">
        <a href="{{ route('cliente.dashboard') }}"
           class="text-blue-600 hover:underline text-sm">
            ⬅ Volver al Dashboard
        </a>
    </div>
</div>
@endsection
