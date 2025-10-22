@extends('layout.app')

@section('title', 'Nueva Estación IoT')

@push('css')
<style>
    .form-container {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }
    
    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="form-container">
        <!-- Header -->
        <div class="form-header text-center">
            <h1 class="h3 mb-2">
                <i class="fas fa-broadcast-tower me-2"></i>
                Nueva Estación IoT
            </h1>
            <p class="mb-0 opacity-75">Registra una nueva estación de monitoreo</p>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="fas fa-home me-1"></i>Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('stations.index') }}">Estaciones</a>
                </li>
                <li class="breadcrumb-item active">Nueva</li>
            </ol>
        </nav>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Errores en el formulario:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('stations.store') }}">
            @csrf

            <div class="row">
                <!-- Nombre -->
                <div class="col-md-12 mb-3">
                    <label for="name" class="form-label">
                        <i class="fas fa-tag text-primary me-1"></i>
                        Nombre de la Estación *
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name') }}"
                        placeholder="Ej: Estación Central - Universidad de Nariño"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Código -->
                <div class="col-md-6 mb-3">
                    <label for="code" class="form-label">
                        <i class="fas fa-barcode text-info me-1"></i>
                        Código Identificador
                    </label>
                    <input 
                        type="text" 
                        name="code" 
                        id="code" 
                        class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code') }}"
                        placeholder="Ej: EST-001"
                    >
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Código único opcional para identificar la estación</small>
                </div>

                <!-- Ciudad -->
                <div class="col-md-6 mb-3">
                    <label for="id_city" class="form-label">
                        <i class="fas fa-city text-warning me-1"></i>
                        Ciudad *
                    </label>
                    <select 
                        name="id_city" 
                        id="id_city" 
                        class="form-select @error('id_city') is-invalid @enderror"
                        required
                    >
                        <option value="">Seleccionar ciudad...</option>
                        @foreach($cities as $city)
                            <option 
                                value="{{ $city->id }}" 
                                {{ old('id_city') == $city->id ? 'selected' : '' }}
                            >
                                {{ $city->name }} - {{ $city->Departaments?->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="col-12 mb-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="status" 
                                    id="status" 
                                    {{ old('status', true) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="status">
                                    <i class="fas fa-toggle-on text-success me-1"></i>
                                    <strong>Estación Activa</strong>
                                    <br>
                                    <small class="text-muted">La estación estará disponible para monitoreo</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="{{ route('stations.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Cancelar
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Guardar Estación
                </button>
            </div>
        </form>
    </div>
</div>
@endsection