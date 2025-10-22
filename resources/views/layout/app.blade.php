<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema IoT - Universidad Cesmag')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #96bbbb;
            --accent-color: #f5576c;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e3a5f 100%) !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 2px;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.15) !important;
            color: white !important;
            transform: translateY(-1px);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .dropdown-item {
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: var(--primary-color);
            color: white;
            transform: translateX(5px);
        }

        footer {
            background: var(--dark-color);
            color: white;
            margin-top: auto;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3a7bd5 100%);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 90, 160, 0.4);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }
    </style>
    @stack('css')
</head>
<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-satellite-dish me-2"></i>IoT Cesmag
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('tabla') ? 'active' : '' }}" href="{{ route('tabla') }}">
                            <i class="fas fa-table me-1"></i>Tabla de Datos
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-microchip me-1"></i>Dispositivos
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item {{ Request::routeIs('stations.*') ? 'active' : '' }}" href="{{ route('stations.index') }}">
                                    <i class="fas fa-broadcast-tower me-2"></i>Estaciones
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ Request::routeIs('sensors.*') ? 'active' : '' }}" href="{{ route('sensors.index') }}">
                                    <i class="fas fa-thermometer-half me-2"></i>Sensores
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('Registro') ? 'active' : '' }}" href="{{ route('Registro') }}">
                            <i class="fas fa-plus-circle me-1"></i>Nuevo Registro
                        </a>
                    </li>
                </ul>
                <form class="d-flex">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Buscar..." aria-label="Search">
                        <button class="btn btn-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <main class="container-fluid py-4 flex-grow-1">
        @yield('content')
    </main>

    <footer class="py-3 mt-5">
        <div class="container text-center">
            <small>
                <i class="fas fa-graduation-cap me-1"></i>
                Sistema de Monitoreo IoT - Universidad Cesmag 
                <span class="mx-2">|</span>
                <i class="fas fa-code me-1"></i>
                Programación Estadística
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>