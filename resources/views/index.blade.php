@extends('layout.app')

@section('title', 'Panel IoT - Monitoreo & Registros')

@push('css')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .stats-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .module-card {
        border: none;
        border-radius: 15px;
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        min-height: 180px;
    }

    .module-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .status-online {
        color: #28a745;
    }

    .status-pending {
        color: #ffc107;
    }

    .nav-pills .nav-link {
        border-radius: 20px;
        margin-right: 10px;
    }

    .nav-pills .nav-link.active {
        background-color: #007bff;
    }

    .breadcrumb-custom {
        background: none;
        padding: 0;
        margin-bottom: 1rem;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: #6c757d;
        text-decoration: none;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: #495057;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ESP32</a></li>
            <li class="breadcrumb-item"><a href="#">LTE (SIM7670G)</a></li>
            <li class="breadcrumb-item"><a href="#">PostgreSQL</a></li>
            <li class="breadcrumb-item active" aria-current="page">Panel demo • Formulario & Tabla</li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-2">Panel IoT — Monitoreo & Registros</h2>
                    <p class="text-muted mb-0">Captura datos (contactos/actores del proyecto), visualizalos en tabla y prepara el entorno para conectar SENSORES de dispositivos IoT</p>
                </div>
                <div>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tabla</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Formulario</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <button class="btn btn-primary me-2">
                <a href="{{ route('Registro') }}" class="btn btn-outline-secondary">
                <i class="fas fa-plus"></i> Registrar dato
                </a>
            </button>
            <button class="btn btn-outline-secondary">
                <a href="{{ route('tabla') }}" class="btn btn-outline-secondary">
                <i class="fas fa-table"></i> Ver tabla
                </a>
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-success bg-opacity-10 text-success mx-auto">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3 class="card-title mb-1">3</h3>
                    <p class="card-text text-muted mb-0">Sensores en línea</p>
                    <small class="text-success">Demo [modo] • Ajustable</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-info bg-opacity-10 text-info mx-auto">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="card-title mb-1">hace 2 min</h3>
                    <p class="card-text text-muted mb-0">Última sincronización</p>
                    <small class="text-muted">Simulada para la demo</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary mx-auto">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="card-title mb-1">MYSQL</h3>
                    <p class="card-text text-muted mb-0">Base de datos</p>
                    <small class="text-success">Conectado vía MYSQL</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Modules Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Módulos</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card module-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="icon-circle bg-secondary bg-opacity-10 text-secondary me-3">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title">Gestión de registros</h5>
                            <p class="card-text text-muted">Crea y lista registros (base para actores, pacientes o dispositivos).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card module-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="icon-circle bg-warning bg-opacity-10 text-warning me-3">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title">Dispositivos IoT</h5>
                            <p class="card-text text-muted">Registro de dispositivos ESP32/SIM7670G, asignación y estado (pendiente).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card module-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="icon-circle bg-info bg-opacity-10 text-info me-3">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title">Panel tiempo real</h5>
                            <p class="card-text text-muted">Gráficas de telemetría (SpO2, pulso, temperatura) con WebSockets (pendiente).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
