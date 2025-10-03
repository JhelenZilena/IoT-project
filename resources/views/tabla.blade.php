@extends('layout.app')

@section('title', 'Tabla de Registros - Panel IoT')

@push('css')
<style>
    body {

        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        min-height: 100vh;
    }

    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .header-section {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: 300;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        font-size: 1rem;
        color: #546e7a;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .breadcrumb-nav {
        background: none;
        padding: 0;
        margin-bottom: 2rem;
        font-size: 0.9rem;
    }

    .breadcrumb-nav a {
        color: #546e7a;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-nav a:hover {
        color: #2c3e50;
    }

    .breadcrumb-nav .active {
        color: #2c3e50;
        font-weight: 500;
    }

    .table-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 0;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .table-header {
        background: linear-gradient(135deg, #2196f3, #21cbf3);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 16px 16px 0 0;
    }

    .table-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin: 0;
    }

    .table-actions {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 1.5rem 2rem 0;
    }

    .btn-new {
        background: #4caf50;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-new:hover {
        background: #45a049;
        transform: translateY(-1px);
        color: white;
    }

    .btn-export {
        background: white;
        border: 1px solid #e0e0e0;
        color: #546e7a;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-export:hover {
        background: #f5f5f5;
        color: #2c3e50;
    }

    .search-box {
        flex: 1;
        max-width: 300px;
        margin-left: auto;
    }

    .search-input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 1px solid #e0e0e0;
        border-radius: 25px;
        font-size: 0.9rem;
        background: white;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #2196f3;
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9e9e9e;
    }

    .table-responsive {
        margin: 0;
    }

    .data-table {
        width: 100%;
        margin: 0;
        background: transparent;
    }

    .data-table th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
        padding: 1rem 1.5rem;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e9ecef;
    }

    .data-table td {
        padding: 1rem 1.5rem;
        border: none;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
        color: #546e7a;
    }

    .data-table tbody tr {
        transition: all 0.3s ease;
    }

    .data-table tbody tr:hover {
        background: rgba(33, 150, 243, 0.05);
        transform: scale(1.01);
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-block;
    }

    .status-online {
        background: #e8f5e8;
        color: #2e7d32;
    }

    .status-offline {
        background: #ffebee;
        color: #c62828;
    }

    .status-maintenance {
        background: #fff3e0;
        color: #ef6c00;
    }

    .device-icon {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: white;
        margin-right: 10px;
    }

    .device-esp32 {
        background: linear-gradient(135deg, #ff5722, #ff7043);
    }

    .device-sensor {
        background: linear-gradient(135deg, #2196f3, #42a5f5);
    }

    .device-gateway {
        background: linear-gradient(135deg, #4caf50, #66bb6a);
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background: #e3f2fd;
        color: #1976d2;
    }

    .btn-edit:hover {
        background: #1976d2;
        color: white;
    }

    .btn-delete {
        background: #ffebee;
        color: #d32f2f;
    }

    .btn-delete:hover {
        background: #d32f2f;
        color: white;
    }

    .btn-config {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .btn-config:hover {
        background: #7b1fa2;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #9e9e9e;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .empty-message {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .empty-description {
        font-size: 0.9rem;
        color: #bdbdbd;
    }

    .pagination-container {
        display: flex;
        justify-content: between;
        align-items: center;
        padding: 1.5rem 2rem;
        border-top: 1px solid #f0f0f0;
    }

    .pagination-info {
        color: #9e9e9e;
        font-size: 0.9rem;
    }

    .stats-row {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .stat-card-small {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        flex: 1;
        text-align: center;
    }

    .stat-number-small {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        display: block;
        margin-bottom: 0.3rem;
    }

    .stat-label-small {
        font-size: 0.9rem;
        color: #546e7a;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="main-container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <a href="#">ESP32</a>
        <span class="mx-2">•</span>
        <a href="#">LTE (SIM7670G)</a>
        <span class="mx-2">•</span>
        <a href="#">PostgreSQL</a>
        <span class="mx-2">•</span>
        <a href="#">Panel demo</a>
        <span class="mx-2">•</span>
        <span class="active">Tabla de Registros</span>
    </nav>

    <!-- Header Section -->
    <div class="header-section">
        <h1 class="page-title">Tabla de Registros IoT</h1>
        <p class="page-subtitle">
            Visualiza y gestiona todos los dispositivos IoT, sensores y sus datos de telemetría en tiempo real
        </p>
    </div>

    <!-- Statistics Row -->
    <div class="stats-row">
        <div class="stat-card-small">
            <span class="stat-number-small">0</span>
            <div class="stat-label-small">Total Dispositivos</div>
        </div>
        <div class="stat-card-small">
            <span class="stat-number-small">0</span>
            <div class="stat-label-small">Activos</div>
        </div>
        <div class="stat-card-small">
            <span class="stat-number-small">0</span>
            <div class="stat-label-small">Offline</div>
        </div>
        <div class="stat-card-small">
            <span class="stat-number-small">0</span>
            <div class="stat-label-small">Mantenimiento</div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">
                <i class="fas fa-microchip me-2"></i>
                Dispositivos y Sensores IoT
            </h2>
        </div>

        <!-- Table Actions -->
        <div class="table-actions">
            <button class="btn btn-new">
                <i class="fas fa-plus"></i>
                Nuevo Dispositivo
            </button>
            <button class="btn btn-export">
                <i class="fas fa-download"></i>
                Exportar
            </button>
            <div class="search-box position-relative">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Buscar dispositivos...">
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Dispositivo</th>
                        <th>Tipo</th>
                        <th>ID Único</th>
                        <th>Estado</th>
                        <th>Ubicación</th>
                        <th>Última Actividad</th>
                        <th>Sensores</th>
                        <th>Batería</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Empty State -->
                    <tr>
                        <td colspan="9" class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-microchip"></i>
                            </div>
                            <div class="empty-message">No hay dispositivos registrados</div>
                            <div class="empty-description">Comienza agregando tu primer dispositivo IoT para comenzar a monitorear datos</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="pagination-info">
                Mostrando 0 de 0 dispositivos
            </div>
            <nav aria-label="Paginación">
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item disabled">
                        <span class="page-link">Siguiente</span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal para agregar nuevo dispositivo -->
<div class="modal fade" id="newDeviceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>
                    Agregar Nuevo Dispositivo IoT
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre del Dispositivo</label>
                            <input type="text" class="form-control" placeholder="ESP32-Sensor-01">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Dispositivo</label>
                            <select class="form-select">
                                <option>Seleccionar tipo</option>
                                <option>ESP32</option>
                                <option>Sensor de Temperatura</option>
                                <option>Sensor de Humedad</option>
                                <option>Gateway IoT</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ID Único</label>
                            <input type="text" class="form-control" placeholder="Ej: ESP32-001-2024">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ubicación</label>
                            <input type="text" class="form-control" placeholder="Ej: Laboratorio A - Piso 2">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" rows="3" placeholder="Descripción del dispositivo y su función..."></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    Guardar Dispositivo
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Ejemplo de datos para cuando haya registros
    const sampleData = [
        {
            name: "ESP32-Temp-001",
            type: "ESP32",
            id: "ESP32-001-2024",
            status: "online",
            location: "Laboratorio A - Piso 2",
            lastActivity: "hace 2 min",
            sensors: "Temp, Humedad",
            battery: "85%"
        },
        {
            name: "Sensor-Presion-02",
            type: "Sensor",
            id: "SENS-002-2024",
            status: "offline",
            location: "Almacén - Zona B",
            lastActivity: "hace 1 hora",
            sensors: "Presión",
            battery: "45%"
        },
        {
            name: "Gateway-Central",
            type: "Gateway",
            id: "GW-001-2024",
            status: "maintenance",
            location: "Sala de Servidores",
            lastActivity: "hace 30 min",
            sensors: "N/A",
            battery: "Conectado"
        }
    ];

    // Función para mostrar modal de nuevo dispositivo
    function showNewDeviceModal() {
        new bootstrap.Modal(document.getElementById('newDeviceModal')).show();
    }

    // Event listener para el botón de nuevo dispositivo
    document.addEventListener('DOMContentLoaded', function() {
        const newDeviceBtn = document.querySelector('.btn-new');
        if (newDeviceBtn) {
            newDeviceBtn.addEventListener('click', showNewDeviceModal);
        }
    });
</script>
@endpush
