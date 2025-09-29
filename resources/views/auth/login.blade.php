@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        {{ __('Iniciar Sesión') }}
                    </h3>
                    <p class="mb-0 mt-2 opacity-75">Accede a tu cuenta</p>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf

                        <!-- Campo Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                {{ __('Correo Electrónico') }}
                            </label>
                            <input id="email" 
                                   type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   autofocus
                                   placeholder="ejemplo@correo.com">
                            
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Campo Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-primary"></i>
                                {{ __('Contraseña') }}
                            </label>
                            <div class="input-group">
                                <input id="password" 
                                       type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       placeholder="••••••••">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Recordar Sesión -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input form-check-input-lg" 
                                       type="checkbox" 
                                       name="remember" 
                                       id="remember" 
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    <i class="fas fa-heart me-1 text-danger"></i>
                                    {{ __('Recordar mi sesión') }}
                                </label>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-grid gap-3 mb-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                {{ __('Iniciar Sesión') }}
                            </button>
                        </div>

                        <!-- Enlaces Adicionales -->
                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <div class="mb-3">
                                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                                        <i class="fas fa-key me-1"></i>
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                </div>
                            @endif
                            
                            @if (Route::has('register'))
                                <div class="border-top pt-3">
                                    <p class="text-muted mb-2">¿No tienes una cuenta?</p>
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-user-plus me-2"></i>
                                        {{ __('Crear Nueva Cuenta') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
                
                <!-- Footer de la Card -->
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">
                        <i class="fas fa-shield-alt me-1"></i>
                        Sistema de Autenticación Laravel - UTP
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseña -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (togglePassword && passwordInput && toggleIcon) {
        togglePassword.addEventListener('click', function() {
            // Toggle del tipo de input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle del icono
            if (type === 'text') {
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    }
});
</script>

<style>
/* Estilos personalizados para el login */
.min-vh-100 {
    min-height: 100vh;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
}

.form-control-lg {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    transform: translateY(-2px);
}

.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.btn-outline-primary {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.text-decoration-none:hover {
    text-decoration: underline !important;
}

.invalid-feedback {
    border-radius: 5px;
    padding: 8px 12px;
    background-color: #f8d7da;
    border-left: 4px solid #dc3545;
    margin-top: 8px;
}

/* Animación sutil para la card */
@keyframes slideInUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.card {
    animation: slideInUp 0.6s ease-out;
}

/* Responsive */
@media (max-width: 768px) {
    .card-body {
        padding: 2rem !important;
    }
    
    .container {
        padding: 1rem;
    }
}
</style>
@endsection