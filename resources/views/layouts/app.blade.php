<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Sistema de Autenticación Laravel - Universidad Tecnológica de Panamá">
    <meta name="keywords" content="Laravel, UTP, Sistema, Login, Registro, Ingeniería Web">
    <meta name="author" content="Universidad Tecnológica de Panamá">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Sistema UTP')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Bootstrap Icons (como alternativa) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- Styles adicionales -->
    @stack('styles')
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --navbar-height: 70px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
        }

        /* Navbar personalizada */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            min-height: var(--navbar-height);
            border-bottom: 3px solid var(--primary-color);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand:hover {
            color: var(--success-color) !important;
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .nav-link {
            font-weight: 500;
            padding: 0.8rem 1rem !important;
            border-radius: 8px;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(0, 123, 255, 0.1);
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: var(--primary-color);
            color: white !important;
        }

        /* Dropdown mejorado */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            padding: 0.5rem 0;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--primary-color), var(--info-color));
            color: white;
            transform: translateX(5px);
        }

        .dropdown-item.logout-item:hover {
            background: linear-gradient(135deg, var(--danger-color), #e74c3c);
        }

        /* Badge para usuarios */
        .user-badge {
            background: linear-gradient(135deg, var(--success-color), var(--info-color));
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            margin-left: 0.5rem;
        }

        /* Contenedor principal */
        .main-content {
            min-height: calc(100vh - var(--navbar-height));
            padding-top: 0;
        }

        /* Footer */
        .footer {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 1rem 0;
            margin-top: auto;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        /* Responsive navbar */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 12px;
                margin-top: 1rem;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }
        }

        /* Loading overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Toast notifications */
        .toast-container {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 1050;
        }

        /* Scroll to top button */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--primary-color);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: none;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .scroll-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
        }
    </style>
</head>
<body>
    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <div id="app">
        <!-- Navbar mejorada -->
        <nav class="navbar navbar-expand-md navbar-custom fixed-top">
            <div class="container">
                <!-- Brand con logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-graduation-cap"></i>
                    {{ config('app.name', 'Sistema UTP') }}
                    <span class="badge bg-primary ms-2">v1.0</span>
                </a>

                <!-- Toggle button para móvil -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                    <i class="fas fa-home me-1"></i>
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="showToast('Funcionalidad en desarrollo', 'info')">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    {{ __('Reportes') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="showToast('Próximamente disponible', 'warning')">
                                    <i class="fas fa-cog me-1"></i>
                                    {{ __('Configuración') }}
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Información del sistema -->
                        <li class="nav-item d-none d-md-block">
                            <span class="navbar-text me-3">
                                <i class="fas fa-clock me-1"></i>
                                <span id="currentTime"></span>
                            </span>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>
                                        {{ __('Iniciar Sesión') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>
                                        {{ __('Registrarse') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <!-- Notificaciones (simuladas) -->
                            <li class="nav-item">
                                <a class="nav-link position-relative" href="#" onclick="showToast('No hay nuevas notificaciones', 'info')">
                                    <i class="fas fa-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                        3
                                    </span>
                                </a>
                            </li>

                            <!-- Usuario dropdown -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="user-avatar me-2">
                                        <i class="fas fa-user-circle fa-lg"></i>
                                    </div>
                                    <div class="user-info d-none d-md-block">
                                        <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                    <span class="user-badge d-none d-lg-inline">Online</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-header">
                                        <i class="fas fa-user me-2"></i>
                                        Mi Cuenta
                                    </div>
                                    
                                    <a class="dropdown-item" href="#" onclick="showToast('Perfil en desarrollo', 'info')">
                                        <i class="fas fa-user-edit"></i>
                                        {{ __('Editar Perfil') }}
                                    </a>
                                    
                                    <a class="dropdown-item" href="#" onclick="showToast('Configuración próximamente', 'warning')">
                                        <i class="fas fa-cogs"></i>
                                        {{ __('Configuración') }}
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    
                                    <a class="dropdown-item" href="#" onclick="showToast('Ayuda disponible', 'success')">
                                        <i class="fas fa-question-circle"></i>
                                        {{ __('Ayuda') }}
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    
                                    <a class="dropdown-item logout-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); confirmLogout();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="main-content fade-in" style="margin-top: var(--navbar-height);">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer mt-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            <i class="fas fa-graduation-cap me-2"></i>
                            <strong>Universidad Tecnológica de Panamá</strong>
                        </p>
                        <small class="text-muted">Sistema de Autenticación Laravel - Laboratorio #1</small>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">
                            <i class="fas fa-code me-1"></i>
                            Desarrollado con 
                            <i class="fas fa-heart text-danger mx-1"></i>
                            por estudiante UTP
                        </p>
                        <small class="text-muted">
                            © {{ date('Y') }} - Ingeniería Web
                        </small>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scroll to top button -->
    <div class="scroll-to-top" id="scrollToTop" onclick="scrollToTop()">
        <i class="fas fa-chevron-up"></i>
    </div>

    <!-- Toast container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Scripts adicionales -->
    @stack('scripts')

    <script>
        // DOM Ready
        document.addEventListener('DOMContentLoaded', function() {
            // Ocultar loading overlay
            hideLoading();
            
            // Inicializar reloj
            updateClock();
            setInterval(updateClock, 1000);
            
            // Inicializar scroll to top
            initScrollToTop();
            
            // Mostrar toast de bienvenida para usuarios autenticados
            @auth
                setTimeout(() => {
                    showToast('¡Bienvenido, {{ Auth::user()->name }}!', 'success');
                }, 1000);
            @endauth
        });

        // Función para mostrar loading
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        // Función para ocultar loading
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Función para actualizar reloj
        function updateClock() {
            const clockElement = document.getElementById('currentTime');
            if (clockElement) {
                const now = new Date();
                const timeString = now.toLocaleTimeString('es-PA', { 
                    hour: '2-digit', 
                    minute: '2-digit',
                    hour12: true 
                });
                clockElement.textContent = timeString;
            }
        }

        // Función para scroll to top
        function initScrollToTop() {
            const scrollBtn = document.getElementById('scrollToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollBtn.style.display = 'flex';
                } else {
                    scrollBtn.style.display = 'none';
                }
            });
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Función para mostrar toasts
        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast_' + Date.now();
            
            const toastTypes = {
                success: { icon: 'fas fa-check-circle', class: 'text-bg-success' },
                error: { icon: 'fas fa-exclamation-triangle', class: 'text-bg-danger' },
                warning: { icon: 'fas fa-exclamation-circle', class: 'text-bg-warning' },
                info: { icon: 'fas fa-info-circle', class: 'text-bg-info' }
            };

            const toast = toastTypes[type] || toastTypes.info;

            const toastHTML = `
                <div class="toast ${toast.class}" role="alert" aria-live="assertive" aria-atomic="true" id="${toastId}">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="${toast.icon} me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;

            toastContainer.insertAdjacentHTML('beforeend', toastHTML);
            const toastElement = document.getElementById(toastId);
            const bsToast = new bootstrap.Toast(toastElement, { delay: 4000 });
            bsToast.show();

            // Limpiar toast después de que se oculte
            toastElement.addEventListener('hidden.bs.toast', function() {
                toastElement.remove();
            });
        }

        // Función para confirmar logout
        function confirmLogout() {
            if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                showLoading();
                document.getElementById('logout-form').submit();
            }
        }

        // Interceptar enlaces para mostrar loading
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href]');
            if (link && !link.hasAttribute('onclick') && !link.classList.contains('dropdown-item')) {
                const href = link.getAttribute('href');
                if (href && href !== '#' && !href.startsWith('mailto:') && !href.startsWith('tel:')) {
                    showLoading();
                }
            }
        });

        // Interceptar formularios para mostrar loading
        document.addEventListener('submit', function(e) {
            showLoading();
        });
    </script>
</body>
</html>