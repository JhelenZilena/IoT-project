@extends('layout.app')

@section('title', 'Dashboard IoT - Monitoreo en Tiempo Real')

@push('css')
<style>
    .gradient-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, #3a7bd5 100%);
    }

    .gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }

    .gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
    }

    .gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    }

    .stats-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        color: white;
        position: relative;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: rgba(255,255,255,0.3);
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
    }

    .module-card {
        border: none;
        border-radius: 15px;
        background: white;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary-color);
    }

    .module-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        border-left: 4px solid var(--accent-color);
    }

    .module-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, #3a7bd5 100%);
        color: white;
    }

    .welcome-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        color: white;
        padding: 3rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        transform: rotate(30deg);
    }

    .quick-actions .btn {
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin: 0.25rem;
    }

    .quick-actions .btn:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">

    <!-- Welcome Section -->
    <div class="welcome-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="fas fa-satellite me-3"></i>Panel de Control IoT
                </h1>
                <p class="lead mb-4 opacity-90">
                    Sistema de monitoreo en tiempo real para dispositivos IoT. 
                    Visualiza datos de sensores, gestiona estaciones y analiza telemetría.
                </p>
                <div class="quick-actions">
                    <a href="{{ route('Registro') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Registro
                    </a>
                    <a href="{{ route('stations.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-broadcast-tower me-2"></i>Estaciones
                    </a>
                    <a href="{{ route('sensors.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-microchip me-2"></i>Sensores
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="stats-icon mx-auto mb-3">
                    <i class="fas fa-brain"></i>
                </div>
                <h4>Sistema Activo</h4>
                <p class="mb-0 opacity-90">Monitoreo en tiempo real</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card gradient-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="fas fa-broadcast-tower"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="card-title mb-1">{{ $stations->count() ?? 0 }}</h3>
                            <p class="card-text mb-0 opacity-90">Estaciones Activas</p>
                            <small class="opacity-75">Total registradas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card gradient-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="card-title mb-1">{{ $sensorsOnline ?? 0 }}</h3>
                            <p class="card-text mb-0 opacity-90">Sensores Online</p>
                            <small class="opacity-75">Conectados ahora</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card gradient-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="card-title mb-1">
                                @if($lastSync)
                                {{ \Carbon\Carbon::parse($lastSync)->diffForHumans() }}
                                @else
                                Sin datos
                                @endif
                            </h3>
                            <p class="card-text mb-0 opacity-90">Última Sincronización</p>
                            <small class="opacity-75">
                                @if($lastSync)
                                {{ \Carbon\Carbon::parse($lastSync)->format('d/m/Y H:i') }}
                                @else
                                Esperando datos
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card gradient-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="card-title mb-1">{{ $dbDriver ?? 'PGSQL' }}</h3>
                            <p class="card-text mb-0 opacity-90">Base de Datos</p>
                            <small class="opacity-75">Conectado vía Supabase</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modules Section -->
    <div class="row">
        <div class="col-12 mb-4">
            <h3 class="fw-bold text-dark mb-4">
                <i class="fas fa-th-large me-2"></i>Módulos del Sistema
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="module-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3">
                        <div class="module-icon me-3">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title fw-bold text-dark">Gestión de Datos</h5>
                            <p class="card-text text-muted">
                                Consulta y administra todos los registros del sistema. 
                                Filtra, exporta y analiza la información recopilada.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('tabla') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-right me-1"></i>Acceder al Módulo
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="module-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3">
                        <div class="module-icon me-3" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="fas fa-broadcast-tower"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title fw-bold text-dark">Estaciones IoT</h5>
                            <p class="card-text text-muted">
                                Gestiona las estaciones de monitoreo. Configura ubicaciones, 
                                estados y parámetros de conexión.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('stations.index') }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-broadcast-tower me-1"></i>Gestionar Estaciones
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="module-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3">
                        <div class="module-icon me-3" style="background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title fw-bold text-dark">Monitoreo en Tiempo Real</h5>
                            <p class="card-text text-muted">
                                Visualiza gráficas interactivas de telemetría. 
                                Monitorea temperatura, humedad y otros parámetros.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('sensors.index') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-chart-line me-1"></i>Ver Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection