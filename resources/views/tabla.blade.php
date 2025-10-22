@extends('layout.app')

@section('title', 'Tabla de Registros - Panel IoT')

@push('css')
<style>
    .main-container {
        max-width: 1600px;
        margin: 0 auto;
        padding: 2rem;
    }

    .header-section {
        margin-bottom: 3rem;
        text-align: center;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
        font-size: 0.9rem;
    }

    .breadcrumb-nav a {
        color: #6c757d;
        text-decoration: none;
        transition: color 0.3s ease;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        background: rgba(255,255,255,0.8);
        border: 1px solid rgba(0,0,0,0.1);
    }

    .breadcrumb-nav a:hover {
        color: #495057;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .breadcrumb-nav .active {
        color: #495057;
        font-weight: 600;
        background: white;
    }

    .breadcrumb-nav .separator {
        color: #adb5bd;
    }

    /* Statistics Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-left: 4px solid;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .stat-card.total { border-left-color: #667eea; }
    .stat-card.active { border-left-color: #28a745; }
    .stat-card.offline { border-left-color: #dc3545; }
    .stat-card.maintenance { border-left-color: #ffc107; }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: white;
    }

    .stat-card.total .stat-icon { background: #667eea; }
    .stat-card.active .stat-icon { background: #28a745; }
    .stat-card.offline .stat-icon { background: #dc3545; }
    .stat-card.maintenance .stat-icon { background: #ffc107; }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        display: block;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Table Container */
    .table-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .table-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .table-header::before {
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

    .table-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .table-subtitle {
        opacity: 0.9;
        margin: 0.5rem 0 0 0;
        font-size: 0.95rem;
        position: relative;
        z-index: 1;
    }

    /* Table Actions */
    .table-actions {
        display: flex;
        gap: 1rem;
        padding: 1.5rem 2rem;
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        flex-wrap: wrap;
        align-items: center;
    }

    .btn-new {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        color: white;
    }

    .btn-export {
        background: white;
        border: 2px solid #667eea;
        color: #667eea;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-export:hover {
        background: #667eea;
        color: white;
        transform: translateY(-1px);
    }

    .search-box {
        flex: 1;
        max-width: 400px;
        margin-left: auto;
    }

    .search-input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 0.95rem;
        background: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .search-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 2;
    }

    /* Table Styling */
    .table-responsive {
        margin: 0;
    }

    .data-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        padding: 1.25rem 1.5rem;
        border: none;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e9ecef;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .data-table td {
        padding: 1.25rem 1.5rem;
        border: none;
        border-bottom: 1px solid #f8f9fa;
        vertical-align: middle;
        color: #495057;
        transition: all 0.3s ease;
    }

    .data-table tbody tr {
        transition: all 0.3s ease;
        background: white;
    }

    .data-table tbody tr:hover {
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        transform: scale(1.002);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* Status Badges */
    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-online {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border: 1px solid rgba(40, 167, 69, 0.2);
    }

    .status-offline {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }

    .status-maintenance {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
        border: 1px solid rgba(255, 193, 7, 0.2);
    }

    /* Device Icons */
    .device-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .device-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        color: white;
        flex-shrink: 0;
    }

    .device-esp32 {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    }

    .device-sensor {
        background: linear-gradient(135deg, #4ecdc4, #00b894);
    }

    .device-gateway {
        background: linear-gradient(135deg, #a55eea, #8854d0);
    }

    .device-details h6 {
        margin: 0;
        font-weight: 600;
        color: #2c3e50;
    }

    .device-details small {
        color: #6c757d;
        font-size: 0.8rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .btn-edit {
        background: linear-gradient(135deg, #17a2b8, #6f42c1);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .btn-config {
        background: linear-gradient(135deg, #ffc107, #fd7e14);
        color: white;
    }

    .btn-config:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        opacity: 0.3;
        color: #667eea;
    }

    .empty-message {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: #495057;
        font-weight: 600;
    }

    .empty-description {
        font-size: 1rem;
        color: #6c757d;
        max-width: 400px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .pagination-info {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .pagination {
        margin: 0;
    }

    .page-link {
        border: none;
        border-radius: 8px;
        margin: 0 2px;
        color: #495057;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: #667eea;
        color: white;
        transform: translateY(-1px);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-container {
            padding: 1rem;
        }
        
        .table-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-box {
            max-width: none;
            margin-left: 0;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .data-table {
            font-size: 0.8rem;
        }
    }
</style>
@endpush

@section('content')
<div class="main-container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <a href="#"><i class="fas fa-microchip me-1"></i>ESP32</a>
        <span class="separator">›</span>
        <a href="#"><i class="fas fa-wifi me-1"></i>LTE (SIM7670G)</a>
        <span class="separator">›</span>
        <a href="#"><i class="fas fa-database me-1"></i>PostgreSQL</a>
        <span class="separator">›</span>
        <a href="#"><i class="fas fa-tachometer-alt me-1"></i>Panel demo</a>
        <span class="separator">›</span>
        <span class="active"><i class="fas fa-table me-1"></i>Tabla de Registros</span>
    </nav>

    <!-- Header Section -->
    <div class="header-section">
        <h1 class="page-title">Dashboard de Dispositivos IoT</h1>
        <p class="page-subtitle">
            Monitorea y gestiona todos tus dispositivos conectados en tiempo real desde una interfaz unificada
        </p>
    </div>

    <!-- Statistics Grid -->
    <div class="stats-grid">
        <div class="stat-card total">
            <div class="stat-icon">
                <i class="fas fa-microchip"></i>
            </div>
            <span class="stat-number">12</span>
            <div class="stat-label">Total Dispositivos</div>
        </div>
        <div class="stat-card active">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <span class="stat-number">8</span>
            <div class="stat-label">En Línea</div>
        </div>
        <div class="stat-card offline">
            <div class="stat-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <span class="stat-number">2</span>
            <div class="stat-label">Offline</div>
        </div>
        <div class="stat-card maintenance">
            <div class="stat-icon">
                <i class="fas fa-tools"></i>
            </div>
            <span class="stat-number">2</span>
            <div class="stat-label">Mantenimiento</div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">
                <i class="fas fa-list-alt me-2"></i>
                Registro de Dispositivos Conectados
            </h2>
            <p class="table-subtitle">Gestiona y monitorea el estado de todos los dispositivos IoT en tu red</p>
        </div>

        <!-- Table Actions -->
        <div class="table-actions">
            <button class="btn btn-new" onclick="showNewDeviceModal()">
                <i class="fas fa-plus-circle"></i>
                Nuevo Dispositivo
            </button>
            <button class="btn btn-export">
                <i class="fas fa-file-export"></i>
                Exportar CSV
            </button>
            <div class="search-box position-relative">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Buscar por nombre, ID o ubicación...">
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>Dispositivo</th>
                        <th>Tipo</th>
                        <th>ID Único</th>
                        <th>Estado</th>
                        <th>Ubicación</th>
                        <th>Última Actividad</th>
                        <th>Batería</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data Row 1 -->
                    <tr>
                        <td>
                            <div class="device-info">
                                <div class="device-icon device-esp32">
                                    <i class="fas fa-microchip"></i>
                                </div>
                                <div class="device-details">
                                    <h6>ESP32-Temp-001</h6>
                                    <small>Sensor Principal</small>
                                </div>
                            </div>
                        </td>
                        <td><strong>ESP32</strong></td>
                        <td><code>ESP32-001-2024</code></td>
                        <td>
                            <span class="status-badge status-online">
                                <i class="fas fa-circle"></i>
                                En Línea
                            </span>
                        </td>
                        <td>Laboratorio A - Piso 2</td>
                        <td>hace 2 min</td>
                        <td>
                            <div class="progress" style="height: 6px; width: 80px;">
                                <div class="progress-bar bg-success" style="width: 85%"></div>
                            </div>
                            <small>85%</small>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-edit" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-config" title="Configurar">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Sample Data Row 2 -->
                    <tr>
                        <td>
                            <div class="device-info">
                                <div class="device-icon device-sensor">
                                    <i class="fas fa-thermometer-half"></i>
                                </div>
                                <div class="device-details">
                                    <h6>Sensor-Presion-02</h6>
                                    <small>Monitor de Presión</small>
                                </div>
                            </div>
                        </td>
                        <td><strong>Sensor</strong></td>
                        <td><code>SENS-002-2024</code></td>
                        <td>
                            <span class="status-badge status-offline">
                                <i class="fas fa-circle"></i>
                                Offline
                            </span>
                        </td>
                        <td>Almacén - Zona B</td>
                        <td>hace 1 hora</td>
                        <td>
                            <div class="progress" style="height: 6px; width: 80px;">
                                <div class="progress-bar bg-warning" style="width: 45%"></div>
                            </div>
                            <small>45%</small>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-edit" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-config" title="Configurar">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Sample Data Row 3 -->
                    <tr>
                        <td>
                            <div class="device-info">
                                <div class="device-icon device-gateway">
                                    <i class="fas fa-broadcast-tower"></i>
                                </div>
                                <div class="device-details">
                                    <h6>Gateway-Central</h6>
                                    <small>Gateway Principal</small>
                                </div>
                            </div>
                        </td>
                        <td><strong>Gateway</strong></td>
                        <td><code>GW-001-2024</code></td>
                        <td>
                            <span class="status-badge status-maintenance">
                                <i class="fas fa-circle"></i>
                                Mantenimiento
                            </span>
                        </td>
                        <td>Sala de Servidores</td>
                        <td>hace 30 min</td>
                        <td>
                            <span class="text-success">
                                <i class="fas fa-plug"></i> Conectado
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-edit" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-config" title="Configurar">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="pagination-info">
                Mostrando 3 de 12 dispositivos
            </div>
            <nav aria-label="Paginación">
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fas fa-chevron-right"></i>
                        </a>
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
    function showNewDeviceModal() {
        new bootstrap.Modal(document.getElementById('newDeviceModal')).show();
    }

    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.search-input');
        const tableRows = document.querySelectorAll('.data-table tbody tr');
        
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush