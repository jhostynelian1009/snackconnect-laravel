@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
<h1 class="text-2xl font-semibold tracking-tight text-[var(--color-text-primary)] mb-2" style="font-family: 'Instrument Sans', sans-serif;">
    Ingresa a tu cuenta
</h1>
<p class="text-sm text-[var(--color-text-secondary)] mb-6">
    Inicia sesión para gestionar tus productos y categorías.
</p>

<!-- Alerta de sesión/error general -->
@if(session('status'))
    <div class="mb-4 p-4 rounded-md bg-green-50 border-l-4 border-green-500 text-green-700 text-sm">
        {{ session('status') }}
    </div>
@endif

<form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4">
    @csrf

    <!-- Campo Email -->
    <div class="flex flex-col">
        <label for="email" class="input-label">
            Correo electrónico <span class="required">*</span>
        </label>
        <input type="email" name="email" id="email" 
               class="input-field @error('email') error @enderror" 
               placeholder="ejemplo@correo.com" 
               value="{{ old('email') }}" 
               required autofocus autocomplete="username">
        @error('email')
            <span class="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                {{ $message }}
            </span>
        @enderror
    </div>

    <!-- Campo Password -->
    <div class="flex flex-col">
        <label for="password" class="input-label">
            Contraseña <span class="required">*</span>
        </label>
        <input type="password" name="password" id="password" 
               class="input-field @error('password') error @enderror" 
               placeholder="••••••••" 
               required autocomplete="current-password">
        @error('password')
            <span class="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                {{ $message }}
            </span>
        @enderror
    </div>

    <!-- Recordarme -->
    <div class="flex items-center justify-between mt-1">
        <label class="flex items-center gap-2 text-sm text-[var(--color-text-secondary)] select-none">
            <input type="checkbox" name="remember" class="w-4 h-4 accent-[var(--color-brand-primary)] border-[var(--color-border-default)] rounded-[var(--radius-sm)]">
            <span>Recordarme</span>
        </label>
    </div>

    <!-- Botón -->
    <button type="submit" class="btn-primary w-full h-[44px] mt-4 flex items-center justify-center">
        Iniciar Sesión
    </button>
</form>

<div class="mt-6 text-center text-sm text-[var(--color-text-secondary)] border-t border-[var(--color-border-default)] pt-6">
    ¿No tienes una cuenta de administrador? 
    <a href="{{ route('register') }}" class="font-medium text-[var(--color-brand-primary)] hover:underline">
        Regístrate aquí
    </a>
</div>
@endsection
