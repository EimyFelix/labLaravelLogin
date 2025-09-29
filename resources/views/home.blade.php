@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <!-- Header del Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="dashboard-title">
                            <i class="fas fa-tachometer-alt me-3"></i>
                            ¡Bienvenido, {{ Auth::user()->name }}!
                        </h1>
                        <p class="dashboard-subtitle mb-0">
                            <i class="fas fa-calendar-day me-2"></i>
                            {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                            <span class="ms-3">
                                <i class="fas fa-clock me-1"></i>
                                <span id="currentTime"></span>
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="user-status">
                            <span class="status-badge online">
                                <i class="fas fa-circle me-1"></i>
                                En línea
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas de sesión -->
    @if (session('status'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>¡Éxito!</strong> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Tarjetas de estadísticas -->
    <div class="row mb-4">
        <!-- Sesiones Activas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="stat-title">Sesiones Activas</h5>
                            <div class="stat-number">1</div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tiempo en Línea -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="stat-title">Tiempo en Línea</h5>
                            <div class="stat-number" id="onlineTime">0m</div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Último Acceso -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="stat-title">Último Acceso</h5>
                            <div class="stat-number small">
                                @if(Auth::user()->updated_at)
                                    {{ Auth::user()->updated_at->diffForHumans() }}
                                @else
                                    Primera vez
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estado del Sistema -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="stat-title">Sistema</h5>
                            <div class="stat-number">
                                <span class="badge bg-success">Activo</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon">
                                <i class="fas fa-server"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="row">
        <!-- Panel de información del usuario -->
        <div class="col-lg-4 mb-4">
            <div class="card info-card h-100">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title text-white mb-0">
                        <i class="fas fa-user-circle me-2"></i>
                        Mi Perfil
                    </h5>
                </div>
                <div class="card-body">
                    <div class="profile-section">
                        <div class="text-center mb-4">
                            <div class="profile-avatar">
                                <i class="fas fa-user-circle fa-5x text-primary"></i>
                            </div>
                            <h4 class="mt-3 mb-1">{{ Auth::user()->name }}</h4>
                            <p class="text-muted mb-2">{{ Auth::user()->email }}</p>
                            <span class="badge bg-primary">Estudiante UTP</span>
                        </div>
                        
                        <div class="profile-stats">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="profile-stat">
                                        <h5 class="mb-1">{{ Auth::user()->created_at->diffInDays() }}</h5>
                                        <small class="text-muted">Días registrado</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="profile-stat">
                                        <h5 class="mb-1">100%</h5>
                                        <small class="text-muted">Completado</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="profile-stat">
                                        <h5 class="mb-1">A+</h5>
                                        <small class="text-muted">Calificación</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary w-100 mb-2" onclick="editProfile()">
                                <i class="fas fa-edit me-2"></i>Editar Perfil
                            </button>
                            <button class="btn btn-outline-secondary w-100" onclick="changePassword()">
                                <i class="fas fa-key me-2"></i>Cambiar Contraseña
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel de actividades recientes -->
        <div class="col-lg-8 mb-4">
            <div class="card activity-card h-100">
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title text-white mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Panel de Control del Laboratorio
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Información del Laboratorio -->
                        <div class="col-md-6 mb-4">
                            <div class="lab-info">
                                <h6 class="text-primary">
                                    <i class="fas fa-flask me-2"></i>
                                    Laboratorio #1
                                </h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <strong>Login:</strong> Implementado
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <strong>Registro:</strong> Funcional
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <strong>Dashboard:</strong> Activo
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <strong>Base de Datos:</strong> Conectada
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Acciones Rápidas -->
                        <div class="col-md-6 mb-4">
                            <h6 class="text-success">
                                <i class="fas fa-bolt me-2"></i>
                                Acciones Rápidas
                            </h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary btn-sm" onclick="testLogin()">
                                    <i class="fas fa-vial me-2"></i>Probar Login
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="testRegister()">
                                    <i class="fas fa-user-plus me-2"></i>Probar Registro
                                </button>
                                <button class="btn btn-outline-info btn-sm" onclick="viewDatabase()">
                                    <i class="fas fa-database me-2"></i>Ver Base de Datos
                                </button>
                                <button class="btn btn-outline-warning btn-sm" onclick="generateReport()">
                                    <i class="fas fa-file-pdf me-2"></i>Generar Reporte
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Progreso del Laboratorio -->
                    <div class="progress-section mt-4">
                        <h6 class="mb-3">
                            <i class="fas fa-tasks me-2 text-info"></i>
                            Progreso del Laboratorio
                        </h6>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-gradient-success progress-bar-striped progress-bar-animated" 
                                 role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Completado</small>
                            <small class="text-success fw-bold">100%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlaces útiles y recursos -->
    <div class="row">
        <div class="col-12">
            <div class="card resources-card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title text-white mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Recursos del Curso - Ingeniería Web UTP
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div class="resource-item">
                                <a href="https://laravel.com/docs" target="_blank" class="btn btn-outline-danger btn-lg mb-2">
                                    <i class="fab fa-laravel fa-2x"></i>
                                </a>
                                <h6>Laravel Docs</h6>
                                <p class="small text-muted">Documentación oficial</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="resource-item">
                                <a href="https://getbootstrap.com" target="_blank" class="btn btn-outline-purple btn-lg mb-2">
                                    <i class="fab fa-bootstrap fa-2x"></i>
                                </a>
                                <h6>Bootstrap</h6>
                                <p class="small text-muted">Framework CSS</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="resource-item">
                                <a href="https://github.com" target="_blank" class="btn btn-outline-dark btn-lg mb-2">
                                    <i class="fab fa-github fa-2x"></i>
                                </a>
                                <h6>GitHub</h6>
                                <p class="small text-muted">Control de versiones</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="resource-item">
                                <a href="https://www.utp.ac.pa" target="_blank" class="btn btn-outline-primary btn-lg mb-2">
                                    <i class="fas fa-university fa-2x"></i>
                                </a>
                                <h6>UTP</h6>
                                <p class="small text-muted">Universidad</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar perfil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProfileModalLabel">
                    <i class="fas fa-user-edit me-2"></i>Editar Perfil
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Esta funcionalidad estará disponible en futuras versiones del sistema.
                </div>
                <form>
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editName" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" value="{{ Auth::user()->email }}" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" disabled>Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Estilos personalizados para el dashboard */
    .dashboard-header {
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        border-radius: 15px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        margin: 0;
    }

    .dashboard-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 1.1rem;
    }

    .status-badge.online {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 500;
    }

    /* Tarjetas de estadísticas */
    .stat-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        background: white;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .stat-card-body {
        padding: 1.5rem;
    }

    .stat-title {
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-card-primary { border-left: 4px solid #007bff; }
    .stat-card-primary .stat-title { color: #007bff; }
    .stat-card-primary .stat-icon { background: rgba(0,123,255,0.1); color: #007bff; }

    .stat-card-success { border-left: 4px solid #28a745; }
    .stat-card-success .stat-title { color: #28a745; }
    .stat-card-success .stat-icon { background: rgba(40,167,69,0.1); color: #28a745; }

    .stat-card-warning { border-left: 4px solid #ffc107; }
    .stat-card-warning .stat-title { color: #ffc107; }
    .stat-card-warning .stat-icon { background: rgba(255,193,7,0.1); color: #ffc107; }

    .stat-card-info { border-left: 4px solid #17a2b8; }
    .stat-card-info .stat-title { color: #17a2b8; }
    .stat-card-info .stat-icon { background: rgba(23,162,184,0.1); color: #17a2b8; }

    /* Tarjetas de información */
    .info-card, .activity-card, .resources-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #138496);
    }

    .profile-avatar {
        position: relative;
    }

    .profile-stat h5 {
        color: #495057;
        font-weight: 700;
    }

    .lab-info ul li {
        padding: 0.25rem 0;
    }

    .progress-section .progress-bar {
        background: linear-gradient(90deg, #28a745, #20c997);
    }

    .resource-item {
        padding: 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .resource-item:hover {
        background: rgba(0,0,0,0.05);
        transform: translateY(-3px);
    }

    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: white;
    }

    .custom-alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 20px rgba(40,167,69,0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
        }
        
        .stat-card {
            margin-bottom: 1rem;
        }
        
        .dashboard-header {
            padding: 1.5rem;
        }
    }

    /* Animaciones */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card, .info-card, .activity-card, .resources-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
</style>
@endpush

@push('scripts')
<script>
    let startTime = new Date();
    
    // Actualizar reloj y tiempo en línea
    function updateDashboard() {
        // Actualizar reloj
        const now = new Date();
        const timeString = now.toLocaleTimeString('es-PA', { 
            hour: '2-digit', 
            minute: '2-digit',
            second: '2-digit',
            hour12: true 
        });
        
        const clockElement = document.getElementById('currentTime');
        if (clockElement) {
            clockElement.textContent = timeString;
        }

        // Actualizar tiempo en línea
        const onlineTimeElement = document.getElementById('onlineTime');
        if (onlineTimeElement) {
            const diff = Math.floor((now - startTime) / 1000 / 60);
            onlineTimeElement.textContent = diff + 'm';
        }
    }

    // Funciones para las acciones del dashboard
    function editProfile() {
        const modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
        modal.show();
    }

    function changePassword() {
        showToast('Funcionalidad de cambio de contraseña en desarrollo', 'info');
    }

    function testLogin() {
        showToast('Redirigiendo a página de login...', 'info');
        setTimeout(() => {
            window.location.href = '{{ route("login") }}';
        }, 1500);
    }

    function testRegister() {
        showToast('Redirigiendo a página de registro...', 'info');
        setTimeout(() => {
            window.location.href = '{{ route("register") }}';
        }, 1500);
    }

    function viewDatabase() {
        showToast('Información de base de datos: MySQL - laravel_login_db', 'info');
        
        // Simular información de la BD
        setTimeout(() => {
            showToast('Tablas: users, password_resets, sessions, migrations', 'success');
        }, 2000);
    }

    function generateReport() {
        showToast('Generando reporte del laboratorio...', 'warning');
        
        // Simular generación de reporte
        setTimeout(() => {
            showToast('Reporte generado exitosamente (simulado)', 'success');
        }, 3000);
    }

    // Inicializar dashboard
    document.addEventListener('DOMContentLoaded', function() {
        // Actualizar cada segundo
        updateDashboard();
        setInterval(updateDashboard, 1000);
        
        // Toast de bienvenida personalizado
        setTimeout(() => {
            showToast('¡Dashboard cargado exitosamente! Laboratorio #1 - Laravel Auth', 'success');
        }, 1000);

        // Efecto de conteo animado para las estadísticas
        animateCounters();
    });

    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent) || 0;
            let current = 0;
            const increment = target / 20;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                
                if (counter.textContent.includes('m')) {
                    counter.textContent = Math.floor(current) + 'm';
                } else if (!isNaN(target)) {
                    counter.textContent = Math.floor(current);
                }
            }, 50);
        });
    }
</script>
@endpush