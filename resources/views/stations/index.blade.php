@extends('layout.app')

@section('title', 'Estaciones IoT')

@push('css')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                    <i class="fas fa-broadcast-tower me-2"></i>
                    Estaciones IoT
                </h1>
                <p class="mb-0 opacity-75">Gestiona las estaciones de monitoreo y sus ubicaciones</p>
            </div>
            <a href="{{ route('stations.create') }}" class="btn btn-light btn-lg">
                <i class="fas fa-plus me-2"></i>Nueva Estación
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
                        <th><i class="fas fa-city me-1"></i>Ciudad</th>
                        <th><i class="fas fa-map-marked-alt me-1"></i>Departamento</th>
                        <th><i class="fas fa-globe-americas me-1"></i>País</th>
                        <th><i class="fas fa-toggle-on me-1"></i>Estado</th>
                        <th><i class="fas fa-calendar me-1"></i>Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stations as $station)
                        <tr>
                            <td><strong>{{ $station->id }}</strong></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-2">
                                        <i class="fas fa-broadcast-tower"></i>
                                    </div>
                                    <strong>{{ $station->name }}</strong>
                                </div>
                            </td>
                            <td><code class="text-muted">{{ $station->code ?? 'N/A' }}</code></td>
                            <td>{{ $station->city?->name ?? 'N/A' }}</td>
                            <td>{{ $station->city?->Departaments?->name ?? 'N/A' }}</td>
                            <td>{{ $station->city?->Departaments?->country?->name ?? 'N/A' }}</td>
                            <td>
                                @if($station->status)
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
                                {{ $station->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">No hay estaciones registradas</p>
                                <a href="{{ route('stations.create') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus me-2"></i>Crear primera estación
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($stations->hasPages())
            <div class="mt-3">
                {{ $stations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection