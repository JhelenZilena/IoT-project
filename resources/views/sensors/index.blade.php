@extends('layout.app')

@section('title', 'Sensores IoT')

@push('css')
<style>
    .page-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }
    
    .table-container {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .sensor-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .status-badge {
        padding: 0.35em 0.65em;
        border-radius: 10rem;
        font-size: 0.875rem;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-2">
                    <i class="fas fa-microchip me-2"></i>
                    Sensores IoT
                </h1>
                <p class="mb-0 opacity-75">Gestiona los sensores de temperatura, humedad y otros dispositivos</p>
            </div>
            <a href="{{ route('sensors.create') }}" class="btn btn-light btn-lg">
                <i class="fas fa-plus me-2"></i>Nuevo Sensor
            </a>
        </div>
    </div>

    @if(session('ok'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('ok') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th><i class="fas fa-hashtag me-1"></i>ID</th>
                        <th><i class="fas fa-tag me-1"></i>Nombre</th>
                        <th><i class="fas fa-barcode me-1"></i>Código</th>
                        <th><i class="fas fa-font me-1"></i>Abreviatura</th>
                        <th><i class="fas fa-map-marked-alt me-1"></i>Departamento</th>
                        <th><i class="fas fa-globe-americas me-1"></i>País</th>
                        <th><i class="fas fa-toggle-on me-1"></i>Estado</th>
                        <th><i class="fas fa-calendar me-1"></i>Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sensors as $sensor)
                        <tr>
                            <td><strong>{{ $sensor->id }}</strong></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="sensor-icon bg-info bg-opacity-10 text-info me-2">
                                        <i class="fas fa-thermometer-half"></i>
                                    </div>
                                    <strong>{{ $sensor->name }}</strong>
                                </div>
                            </td>
                            <td><code class="text-primary">{{ $sensor->code }}</code></td>
                            <td>
                                <span class="badge bg-secondary">{{ $sensor->abbrev ?? 'N/A' }}</span>
                            </td>
                            <td>{{ $sensor->department->name }}</td>
                            <td>{{ $sensor->department->country->name }}</td>
                            <td>
                                @if($sensor->status)
                                    <span class="badge bg-success status-badge">
                                        <i class="fas fa-check-circle me-1"></i>Activo
                                    </span>
                                @else
                                    <span class="badge bg-secondary status-badge">
                                        <i class="fas fa-times-circle me-1"></i>Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ $sensor->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="fas fa-microchip fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">No hay sensores registrados</p>
                                <a href="{{ route('sensors.create') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus me-2"></i>Crear primer sensor
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($sensors->hasPages())
            <div class="mt-3">
                {{ $sensors->links() }}
            </div>
        @endif
    </div>
</div>
<!-- Sección de Telemetría con Gráfica -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0; padding: 1.5rem;">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>
                    Telemetría en Tiempo Real - Temperatura y Humedad
                </h5>
            </div>
            <div class="card-body p-4">
                <!-- Filtros -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-broadcast-tower me-1 text-primary"></i>Estación
                        </label>
                        <select id="station_id" class="form-select">
                            @forelse($sensors as $sensor)
                                <option value="{{ $station->id }}" {{ $loop->first ? 'selected' : '' }}>
                                    {{ $sensor->name }}
                                </option>
                            @empty
                                <option value="">No hay estaciones</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar me-1 text-info"></i>Desde
                        </label>
                        <input type="datetime-local" id="from" class="form-control" value="{{ now()->subDay()->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar-check me-1 text-success"></i>Hasta
                        </label>
                        <input type="datetime-local" id="to" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-layer-group me-1 text-warning"></i>Agrupar
                        </label>
                        <select id="group" class="form-select">
                            <option value="minute">Por minuto</option>
                            <option value="hour" selected>Por hora</option>
                            <option value="day">Por día</option>
                        </select>
                    </div>
                </div>
                
                <!-- Mensaje sin datos -->
                <div id="noDataMessage" class="text-center py-5 d-none">
                    <i class="fas fa-chart-line fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                    <p class="text-muted">No hay datos disponibles para el rango seleccionado</p>
                    <small class="text-muted">Intenta cambiar los filtros o crear datos de prueba</small>
                </div>
                
                <!-- Gráfica -->
                <canvas id="chart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection