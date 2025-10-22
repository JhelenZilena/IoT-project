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
                            <td>{{ $sensor->Departaments?->name ?? 'N/A' }}</td>
                            <td>{{ $sensor->Departaments?->country?->name ?? 'N/A' }}</td>
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
@endsection