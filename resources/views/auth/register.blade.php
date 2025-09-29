@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>
                        {{ __('Crear Nueva Cuenta') }}
                    </h3>
                    <p class="mb-0 mt-2 opacity-75">Únete a nuestro sistema</p>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}" novalidate id="registerForm">
                        @csrf

                        <!-- Campo Nombre -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-user me-2 text-success"></i>
                                {{ __('Nombre Completo') }}
                            </label>
                            <input id="name" 
                                   type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autocomplete="name" 
                                   autofocus
                                   placeholder="Ingresa tu nombre completo"
                                   minlength="2">
                            
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Mínimo 2 caracteres
                            </div>
                        </div>

                        <!-- Campo Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2 text-success"></i>
                                {{ __('Correo Electrónico') }}
                            </label>
                            <input id="email" 
                                   type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email"
                                   placeholder="ejemplo@correo.com">
                            
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Usa tu correo institucional @estudiantes.utp.ac.pa
                            </div>
                        </div>

                        <!-- Campo Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-success"></i>
                                {{ __('Contraseña') }}
                            </label>
                            <div class="input-group">
                                <input id="password" 
                                       type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="••••••••"
                                       minlength="8">
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
                            
                            <!-- Indicador de fortaleza de contraseña -->
                            <div class="password-strength mt-2">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" id="passwordStrengthBar" style="width: 0%"></div>
                                </div>
                                <small id="passwordStrengthText" class="form-text">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Mínimo 8 caracteres, incluye mayúsculas, números y símbolos
                                </small>
                            </div>
                        </div>

                        <!-- Confirmar Password -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold">
                                <i class="fas fa-lock-open me-2 text-success"></i>
                                {{ __('Confirmar Contraseña') }}
                            </label>
                            <div class="input-group">
                                <input id="password-confirm" 
                                       type="password" 
                                       class="form-control form-control-lg" 
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="••••••••">
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                    <i class="fas fa-eye" id="toggleIconConfirm"></i>
                                </button>
                            </div>
                            <div id="passwordMatch" class="form-text mt-2"></div>
                        </div>

                        <!-- Términos y Condiciones -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input form-check-input-lg" 
                                       type="checkbox" 
                                       name="terms" 
                                       id="terms" 
                                       required>
                                <label class="form-check-label" for="terms">
                                    <i class="fas fa-check-circle me-1 text-success"></i>
                                    Acepto los 
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal" class="text-decoration-none">
                                        términos y condiciones
                                    </a> 
                                    del sistema
                                </label>
                            </div>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="d-grid gap-3 mb-4">
                            <button type="submit" class="btn btn-success btn-lg py-3" id="submitBtn">
                                <i class="fas fa-user-plus me-2"></i>
                                {{ __('Crear Mi Cuenta') }}
                            </button>
                        </div>

                        <!-- Enlaces Adicionales -->
                        <div class="text-center">
                            <div class="border-top pt-3">
                                <p class="text-muted mb-2">¿Ya tienes una cuenta?</p>
                                <a href="{{ route('login') }}" class="btn btn-outline-success">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    {{ __('Iniciar Sesión') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Footer de la Card -->
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">
                        <i class="fas fa-graduation-cap me-1"></i>
                        Sistema de Registro - Universidad Tecnológica de Panamá
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Términos y Condiciones -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="termsModalLabel">
                    <i class="fas fa-file-contract me-2"></i>
                    Términos y Condiciones
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6><i class="fas fa-info-circle me-2 text-primary"></i>Uso del Sistema</h6>
                <p>Este sistema está destinado exclusivamente para estudiantes de la Universidad Tecnológica de Panamá (UTP).</p>
                
                <h6><i class="fas fa-shield-alt me-2 text-warning"></i>Privacidad</h6>
                <p>Tus datos personales serán protegidos conforme a las políticas de privacidad de la UTP.</p>
                
                <h6><i class="fas fa-users me-2 text-success"></i>Responsabilidades</h6>
                <ul>
                    <li>Mantener la confidencialidad de tu cuenta</li>
                    <li>Usar el sistema de manera ética</li>
                    <li>Reportar cualquier problema de seguridad</li>
                </ul>
                
                <h6><i class="fas fa-graduation-cap me-2 text-info"></i>Propósito Académico</h6>
                <p>Este sistema forma parte del Laboratorio #1 del curso de Ingeniería Web.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cerrar
                </button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="acceptTerms()">
                    <i class="fas fa-check me-2"></i>Acepto los Términos
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para funcionalidades avanzadas -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    setupPasswordToggle('password', 'togglePassword', 'toggleIcon');
    setupPasswordToggle('password-confirm', 'togglePasswordConfirm', 'toggleIconConfirm');
    
    // Password strength checker
    setupPasswordStrength();
    
    // Password confirmation checker
    setupPasswordConfirmation();
    
    // Form validation
    setupFormValidation();
});

function setupPasswordToggle(inputId, buttonId, iconId) {
    const toggleButton = document.getElementById(buttonId);
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);

    if (toggleButton && passwordInput && toggleIcon) {
        toggleButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    }
}

function setupPasswordStrength() {
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');
    
    if (passwordInput && strengthBar && strengthText) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            
            strengthBar.style.width = strength.percentage + '%';
            strengthBar.className = 'progress-bar ' + strength.class;
            strengthText.innerHTML = '<i class="fas fa-shield-alt me-1"></i>' + strength.text;
        });
    }
}

function calculatePasswordStrength(password) {
    let score = 0;
    let feedback = [];
    
    if (password.length >= 8) score += 25;
    else feedback.push('mínimo 8 caracteres');
    
    if (/[a-z]/.test(password)) score += 25;
    else feedback.push('minúsculas');
    
    if (/[A-Z]/.test(password)) score += 25;
    else feedback.push('mayúsculas');
    
    if (/\d/.test(password)) score += 12.5;
    else feedback.push('números');
    
    if (/[^a-zA-Z\d]/.test(password)) score += 12.5;
    else feedback.push('símbolos');
    
    let result = {
        percentage: score,
        class: score < 25 ? 'bg-danger' : score < 50 ? 'bg-warning' : score < 75 ? 'bg-info' : 'bg-success',
        text: score < 25 ? 'Muy débil - Necesita: ' + feedback.join(', ') : 
              score < 50 ? 'Débil - Agregar: ' + feedback.join(', ') : 
              score < 75 ? 'Buena - Casi perfecta' : 
              'Excelente - Contraseña segura'
    };
    
    return result;
}

function setupPasswordConfirmation() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password-confirm');
    const matchDiv = document.getElementById('passwordMatch');
    
    if (passwordInput && confirmInput && matchDiv) {
        function checkMatch() {
            if (confirmInput.value === '') {
                matchDiv.innerHTML = '';
                return;
            }
            
            if (passwordInput.value === confirmInput.value) {
                matchDiv.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i><span class="text-success">Las contraseñas coinciden</span>';
                confirmInput.classList.remove('is-invalid');
                confirmInput.classList.add('is-valid');
            } else {
                matchDiv.innerHTML = '<i class="fas fa-times-circle text-danger me-1"></i><span class="text-danger">Las contraseñas no coinciden</span>';
                confirmInput.classList.remove('is-valid');
                confirmInput.classList.add('is-invalid');
            }
        }
        
        passwordInput.addEventListener('input', checkMatch);
        confirmInput.addEventListener('input', checkMatch);
    }
}

function setupFormValidation() {
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Add loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creando cuenta...';
            submitBtn.disabled = true;
            
            // Re-enable if validation fails
            setTimeout(() => {
                if (!form.checkValidity()) {
                    submitBtn.innerHTML = '<i class="fas fa-user-plus me-2"></i>Crear Mi Cuenta';
                    submitBtn.disabled = false;
                }
            }, 100);
        });
    }
}

function acceptTerms() {
    document.getElementById('terms').checked = true;
}
</script>

<style>
/* Estilos personalizados para el registro */
.min-vh-100 {
    min-height: 100vh;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
}

.form-control-lg {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    transform: translateY(-2px);
}

.form-control-lg.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='m2.3 6.73.6.6 2.8-2.8-.6-.6-2.2 2.2-1.2-1.2-.6.6 1.2 1.2z'/%3e%3c/svg%3e");
}

.form-control-lg.is-invalid {
    border-color: #dc3545;
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
}

.btn-outline-success {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
}

.invalid-feedback {
    border-radius: 5px;
    padding: 8px 12px;
    background-color: #f8d7da;
    border-left: 4px solid #dc3545;
    margin-top: 8px;
}

.form-text {
    font-size: 0.875rem;
}

.password-strength .progress {
    border-radius: 3px;
}

/* Modal personalizado */
.modal-content {
    border-radius: 15px;
    border: none;
}

.modal-header {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

/* Animación para la card */
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
    
    .modal-dialog {
        margin: 1rem;
    }
}

/* Loading button effect */
.btn:disabled {
    cursor: not-allowed;
    opacity: 0.7;
}
</style>
@endsection