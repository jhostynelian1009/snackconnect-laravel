@extends('layouts.auth')

@section('title', 'Registrarse')

@section('content')
<h1 class="text-2xl font-semibold tracking-tight text-[var(--color-text-primary)] mb-2" style="font-family: 'Instrument Sans', sans-serif;">
    Crea tu cuenta de administrador
</h1>
<p class="text-sm text-[var(--color-text-secondary)] mb-6">
    Completa el formulario para registrarte y empezar a gestionar tu tienda.
</p>

<form action="{{ route('register') }}" method="POST" class="flex flex-col gap-4">
    @csrf

    <!-- Campo Name -->
    <div class="flex flex-col">
        <label for="name" class="input-label">
            Nombre completo <span class="required">*</span>
        </label>
        <input type="text" name="name" id="name" 
               class="input-field @error('name') error @enderror" 
               placeholder="Nombre y Apellido" 
               value="{{ old('name') }}" 
               required autocomplete="name" autofocus>
        @error('name')
            <span class="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                {{ $message }}
            </span>
        @enderror
    </div>

    <!-- Campo Email -->
    <div class="flex flex-col">
        <label for="email" class="input-label">
            Correo electrónico <span class="required">*</span>
        </label>
        <input type="email" name="email" id="email" 
               class="input-field @error('email') error @enderror" 
               placeholder="ejemplo@correo.com" 
               value="{{ old('email') }}" 
               required autocomplete="username">
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
               placeholder="Mínimo 8 caracteres" 
               required autocomplete="new-password">
        @error('password')
            <span class="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                {{ $message }}
            </span>
        @enderror
    </div>

    <!-- Campo Password Confirmation -->
    <div class="flex flex-col">
        <label for="password_confirmation" class="input-label">
            Confirmar contraseña <span class="required">*</span>
        </label>
        <input type="password" name="password_confirmation" id="password_confirmation" 
               class="input-field" 
               placeholder="Repite la contraseña" 
               required autocomplete="new-password">
    </div>

    <!-- Botón -->
    <button type="submit" class="btn-primary w-full h-[44px] mt-4 flex items-center justify-center">
        Crear cuenta
    </button>
</form>

<div class="mt-6 text-center text-sm text-[var(--color-text-secondary)] border-t border-[var(--color-border-default)] pt-6">
    ¿Ya tienes una cuenta? 
    <a href="{{ route('login') }}" class="font-medium text-[var(--color-brand-primary)] hover:underline">
        Inicia sesión aquí
    </a>
</div>
@endsection
