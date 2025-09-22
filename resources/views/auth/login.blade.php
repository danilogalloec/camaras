@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        {{-- Encabezado --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Acceso al Sistema</h1>
            <p class="text-gray-500">Cédula (cliente) o Email (admin)</p>
        </div>

        {{-- Mensaje de error general --}}
        @if($errors->has('login'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm text-center">
                {{ $errors->first('login') }}
            </div>
        @endif

        {{-- Formulario --}}
        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Usuario --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Usuario
                </label>
                <input type="text"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Ej: 1712345678 o admin@dominio.com"
                       required
                       class="form-control">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contraseña --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Contraseña
                </label>
                <input type="password"
                       id="password"
                       name="password"
                       placeholder="••••••••"
                       required
                       class="form-control">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botón --}}
            <div>
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow transition">
                    Ingresar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
