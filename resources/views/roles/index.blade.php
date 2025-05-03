@extends('layouts.app')

@section('content')

<br>
<div class="roles-dashboard">
    <!-- Encabezado con estadísticas -->
    <div class="dashboard-header">
        <div class="header-content">
            <div class="title-section">
                <h2 class="dashboard-title">Gestión de Roles</h2>
                <p class="dashboard-subtitle">Administra los roles y permisos del sistema</p>
            </div>
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-value">{{ count($roles) }}</h3>
                        <p class="stat-label">Roles totales</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-value" id="totalPermissions">0</h3>
                        <p class="stat-label">Permisos asignados</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-value" id="totalUsers">0</h3>
                        <p class="stat-label">Usuarios con roles</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel principal -->
    <div class="main-panel">
        <!-- Barra de herramientas -->
        <div class="toolbar">
            <div class="search-tools">
                <div class="search-wrapper">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Buscar roles...">
                    <button class="search-clear" id="clearSearch">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
            <div class="action-tools">
                <div class="view-toggle">
                    <button class="view-button active" data-view="table">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                    </button>
                    <button class="view-button" data-view="cards">
                        <i class="bi bi-grid-fill"></i>
                    </button>
                </div>
                <div class="action-dropdown">
                    <button class="action-button">
                        <i class="bi bi-download"></i>
                        <span>Exportar</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="action-menu">
                        <a href="#" class="action-item" id="exportExcel">
                            <i class="bi bi-file-earmark-excel"></i>
                            <span>Exportar a Excel</span>
                        </a>
                        <a href="#" class="action-item" id="exportPDF">
                            <i class="bi bi-file-earmark-pdf"></i>
                            <span>Exportar a PDF</span>
                        </a>
                        <a href="#" class="action-item" id="exportCSV">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Exportar a CSV</span>
                        </a>
                    </div>
                </div>
                @can('role-create')
                <a href="{{ route('roles.create') }}" class="create-button">
                    <i class="bi bi-plus"></i>
                    <span>Crear rol</span>
                </a>
                @endcan
            </div>
        </div>

        <!-- Notificaciones -->
        @if ($message = Session::get('success'))
        <div class="notification success" id="notification">
            <div class="notification-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="notification-content">
                <h4>¡Operación exitosa!</h4>
                <p>{{ $message }}</p>
            </div>
            <button class="notification-close" onclick="closeNotification()">
                <i class="bi bi-x"></i>
            </button>
        </div>
        @endif

        <!-- Vista de tabla -->
        <div class="data-view table-view active" id="tableView">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="sortable" data-sort="id">ID <i class="bi bi-arrow-down-up"></i></th>
                            <th class="sortable" data-sort="name">Nombre <i class="bi bi-arrow-down-up"></i></th>
                            <th>Permisos</th>
                            <th class="sortable" data-sort="date">Fecha creación <i class="bi bi-arrow-down-up"></i></th>
                            <th class="actions-column">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse ($roles as $key => $role)
                        <tr class="data-row {{ count($role->permissions) > 0 ? 'has-permissions' : 'no-permissions' }}"
                            data-id="{{ $role->id }}"
                            data-name="{{ $role->name }}"
                            data-date="{{ $role->created_at ? $role->created_at->format('Y-m-d') : '' }}"
                            data-created="{{ $role->created_at ? $role->created_at->format('d/m/Y') : 'N/A' }}">
                            <td class="id-column" data-label="ID">{{ ++$i }}</td>
                            <td class="name-column" data-label="Nombre">
                                <div class="role-name">{{ $role->name }}</div>
                                <div class="role-users">{{ rand(0, 10) }} usuarios</div>
                            </td>
                            <td class="permissions-column" data-label="Permisos">
                                @php
                                    $permissions = $role->permissions;
                                    $totalPermissions = count($permissions);
                                    $displayLimit = 3;
                                @endphp

                                <div class="permissions-wrapper">
                                    @if($totalPermissions > 0)
                                        <div class="permissions-badges">
                                            @foreach($permissions->take($displayLimit) as $permission)
                                                <span class="permission-badge">{{ $permission->name }}</span>
                                            @endforeach

                                            @if($totalPermissions > $displayLimit)
                                                <span class="permission-badge more" data-bs-toggle="tooltip" data-bs-html="true"
                                                      title="<div class='tooltip-permissions'>{{ $permissions->skip($displayLimit)->pluck('name')->implode('<br>') }}</div>">
                                                    +{{ $totalPermissions - $displayLimit }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="permission-bar">
                                            <div class="permission-progress" style="width: {{ min(100, $totalPermissions * 5) }}%"></div>
                                        </div>
                                    @else
                                        <div class="no-permissions-label">Sin permisos asignados</div>
                                    @endif
                                </div>
                            </td>
                            <td class="date-column" data-label="Fecha">{{ $role->created_at ? $role->created_at->format('d/m/Y') : 'N/A' }}</td>
                            <td class="actions-column" data-label="Acciones">
                                <div class="action-buttons">
                                    <a href="{{ route('roles.show', $role->id) }}" class="action-btn view-btn" data-bs-toggle="tooltip" title="Ver detalles">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    @can('role-edit')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="action-btn edit-btn" data-bs-toggle="tooltip" title="Editar rol">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @endcan
                                    @can('role-delete')
                                    <button type="button" class="action-btn delete-btn" data-bs-toggle="tooltip" title="Eliminar rol"
                                            onclick="confirmDelete('{{ $role->id }}', '{{ $role->name }}')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <!-- No se muestra nada aquí porque usaremos el empty-state abajo -->
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Mostrando <span class="current-range">1-{{ min(count($roles), 10) }}</span> de <span class="total-items">{{ count($roles) }}</span> roles
                </div>
                <div class="pagination-controls">
                    {!! $roles->render() !!}
                </div>
            </div>
        </div>

        <!-- Vista de tarjetas -->
        <div class="data-view cards-view" id="cardsView">
            <div class="cards-container">
                @forelse ($roles as $key => $role)
                <div class="role-card {{ count($role->permissions) > 0 ? 'has-permissions' : 'no-permissions' }}"
                     data-id="{{ $role->id }}"
                     data-name="{{ $role->name }}"
                     data-date="{{ $role->created_at ? $role->created_at->format('Y-m-d') : '' }}">
                    <div class="card-header">
                        <div class="card-title">{{ $role->name }}</div>
                        <div class="card-actions">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="cardMenu{{ $role->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="cardMenu{{ $role->id }}">
                                    <li><a class="dropdown-item" href="{{ route('roles.show', $role->id) }}">
                                        <i class="bi bi-eye-fill"></i> Ver detalles
                                    </a></li>
                                    @can('role-edit')
                                    <li><a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a></li>
                                    @endcan
                                    @can('role-delete')
                                    <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete('{{ $role->id }}', '{{ $role->name }}')">
                                        <i class="bi bi-trash-fill"></i> Eliminar
                                    </a></li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-info">
                            <div class="info-item">
                                <span class="info-label">ID:</span>
                                <span class="info-value">{{ $role->id }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Fecha:</span>
                                <span class="info-value">{{ $role->created_at ? $role->created_at->format('d/m/Y') : 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Usuarios:</span>
                                <span class="info-value">{{ rand(0, 10) }}</span>
                            </div>
                        </div>
                        <div class="card-permissions">
                            <div class="permissions-header">
                                <span class="permissions-title">Permisos</span>
                                <span class="permissions-count">{{ count($role->permissions) }}</span>
                            </div>
                            @if(count($role->permissions) > 0)
                                <div class="permissions-list">
                                    @foreach($role->permissions->take(5) as $permission)
                                        <span class="permission-pill">{{ $permission->name }}</span>
                                    @endforeach
                                    @if(count($role->permissions) > 5)
                                        <span class="permission-pill more">+{{ count($role->permissions) - 5 }} más</span>
                                    @endif
                                </div>
                            @else
                                <div class="no-permissions">Sin permisos asignados</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('roles.show', $role->id) }}" class="card-btn primary">
                            <i class="bi bi-eye-fill"></i> Ver detalles
                        </a>
                        @can('role-edit')
                        <a href="{{ route('roles.edit', $role->id) }}" class="card-btn secondary">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        @endcan
                    </div>
                </div>
                @empty
                <!-- No se muestra nada aquí porque usaremos el empty-state abajo -->
                @endforelse
            </div>
        </div>

        <!-- Estado vacío -->
        @if(count($roles) == 0)
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-person-lock"></i>
            </div>
            <h3 class="empty-title">No hay roles registrados</h3>
            <p class="empty-description">Los roles te permiten asignar permisos específicos a los usuarios del sistema.</p>
            @can('role-create')
            <a href="{{ route('roles.create') }}" class="empty-action">
                <i class="bi bi-plus"></i>
                Crear primer rol
            </a>
            @endcan
        </div>
        @endif
    </div>
</div>

<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Confirmar eliminación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="delete-confirmation">
                    <div class="delete-icon">
                        <i class="bi bi-trash-fill"></i>
                    </div>
                    <h4 class="delete-title">¿Estás seguro de eliminar este rol?</h4>
                    <div class="delete-info">
                        <div class="role-info-item">
                            <span class="role-label">Nombre:</span>
                            <span class="role-value" id="deleteRoleName"></span>
                        </div>
                        <div class="role-info-item">
                            <span class="role-label">Consecuencias:</span>
                            <span class="role-value">Los usuarios con este rol perderán los permisos asociados.</span>
                        </div>
                    </div>
                    <div class="delete-warning">
                        <i class="bi bi-info-circle-fill"></i>
                        <p>Esta acción no se puede deshacer.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x me-1"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="bi bi-trash-fill me-1"></i>
                    Eliminar rol
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Botón flotante para agregar -->
@can('role-create')
<a href="{{ route('roles.create') }}" class="floating-action-button" data-bs-toggle="tooltip" title="Crear nuevo rol">
    <i class="bi bi-plus"></i>
</a>
@endcan

<style>
:root {
    --primary: #BD6DFF;
    --primary-light: rgba(189, 109, 255, 0.1);
    --primary-dark: #a85ae0;
    --secondary: #6c757d;
    --success: #28a745;
    --danger: #dc3545;
    --warning: #ffc107;
    --info: #17a2b8;
    --light: #f8f9fa;
    --dark: #343a40;
    --white: #ffffff;
    --border-radius: 8px;
    --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
    --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

/* Estilos generales */
.roles-dashboard {
    font-family: var(--font-family);
    color: var(--dark);
    margin-bottom: 60px;
}

/* Estilos para los iconos de Bootstrap */
.bi {
    line-height: 1;
    vertical-align: middle;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Encabezado con estadísticas */
.dashboard-header {
    margin-bottom: 24px;
    background: linear-gradient(135deg, var(--primary) 0%, #9d4ddb 100%);
    border-radius: var(--border-radius);
    padding: 24px;
    color: var(--white);
    box-shadow: 0 4px 12px rgba(189, 109, 255, 0.2);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.title-section {
    flex: 1;
    min-width: 250px;
}

.dashboard-title {
    font-size: 28px;
    font-weight: 700;
    margin: 0 0 8px 0;
}

.dashboard-subtitle {
    font-size: 16px;
    opacity: 0.9;
    margin: 0;
}

.stats-cards {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.stat-card {
    background-color: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: var(--border-radius);
    padding: 16px;
    min-width: 160px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: var(--transition);
}

.stat-card:hover {
    background-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-3px);
}

.stat-icon {
    background-color: rgba(255, 255, 255, 0.2);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.stat-info {
    flex: 1;
}

.stat-value {
    font-size: 24px;
    font-weight: 700;
    margin: 0;
    line-height: 1.2;
}

.stat-label {
    font-size: 14px;
    opacity: 0.9;
    margin: 0;
}

/* Panel principal */
.main-panel {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    overflow: hidden;
}

/* Barra de herramientas */
.toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    flex-wrap: wrap;
    gap: 16px;
}

.search-tools {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
    min-width: 250px;
}

.search-wrapper {
    position: relative;
    flex: 1;
    max-width: 400px;
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    font-size: 16px;
}

.search-input {
    width: 100%;
    padding: 10px 36px;
    border-radius: 30px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    font-size: 14px;
    transition: var(--transition);
}

.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(189, 109, 255, 0.15);
}

.search-clear {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--secondary);
    cursor: pointer;
    font-size: 14px;
    display: none;
}

.search-input:not(:placeholder-shown) + .search-clear {
    display: block;
}

.action-tools {
    display: flex;
    align-items: center;
    gap: 12px;
}

.view-toggle {
    display: flex;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 30px;
    overflow: hidden;
}

.view-button {
    background: none;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.view-button.active {
    background-color: var(--primary);
    color: var(--white);
}

.action-dropdown {
    position: relative;
}

.action-button {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    border-radius: 30px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    background-color: var(--white);
    cursor: pointer;
    font-size: 14px;
    transition: var(--transition);
}

.action-button:hover {
    background-color: var(--light);
}

.action-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 8px;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    width: 200px;
    z-index: 100;
    display: none;
}

.action-menu.show {
    display: block;
    animation: fadeInDown 0.3s ease;
}

.action-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    color: var(--dark);
    text-decoration: none;
    transition: var(--transition);
}

.action-item:hover {
    background-color: var(--light);
}

.create-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 16px;
    border-radius: 30px;
    background-color: var(--primary);
    color: var(--white);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    border: none;
}

.create-button:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(189, 109, 255, 0.25);
    color: var(--white);
}

/* Notificaciones */
.notification {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 16px 24px;
    margin: 16px 24px;
    border-radius: var(--border-radius);
    animation: slideInDown 0.5s ease;
}

.notification.success {
    background-color: rgba(40, 167, 69, 0.1);
    border-left: 4px solid var(--success);
}

.notification-icon {
    color: var(--success);
    font-size: 24px;
    margin-top: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification-content {
    flex: 1;
}

.notification-content h4 {
    margin: 0 0 4px 0;
    font-size: 16px;
    font-weight: 600;
}

.notification-content p {
    margin: 0;
    font-size: 14px;
}

.notification-close {
    background: none;
    border: none;
    color: var(--secondary);
    cursor: pointer;
    font-size: 16px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Vista de tabla */
.data-view {
    display: none;
    padding: 0 24px 24px;
}

.data-view.active {
    display: block;
}

.table-container {
    overflow-x: auto;
    border-radius: var(--border-radius);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.data-table thead tr {
    background-color: var(--light);
}

.data-table th {
    padding: 16px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    color: var(--secondary);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.data-table th.sortable {
    cursor: pointer;
}

.data-table th.sortable i {
    margin-left: 4px;
    font-size: 12px;
    opacity: 0.5;
    transition: var(--transition);
}

.data-table th.sortable:hover i {
    opacity: 1;
}

.data-table th.sorted-asc i, .data-table th.sorted-desc i {
    opacity: 1;
}

.data-table th.sorted-asc i {
    transform: rotate(180deg);
}

.data-table td {
    padding: 16px;
    font-size: 14px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.data-row {
    transition: var(--transition);
}

.data-row:hover {
    background-color: var(--primary-light);
}

.id-column {
    width: 60px;
    color: var(--secondary);
    font-weight: 500;
}

.name-column {
    min-width: 200px;
}

.role-name {
    font-weight: 600;
    margin-bottom: 4px;
}

.role-users {
    font-size: 12px;
    color: var(--secondary);
}

.permissions-column {
    min-width: 250px;
}

.permissions-wrapper {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.permissions-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
}

.permission-badge {
    background-color: var(--primary-light);
    color: var(--primary-dark);
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.permission-badge.more {
    background-color: var(--light);
    color: var(--secondary);
    cursor: pointer;
}

.permission-bar {
    height: 4px;
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 2px;
    overflow: hidden;
}

.permission-progress {
    height: 100%;
    background-color: var(--primary);
    border-radius: 2px;
}

.no-permissions-label {
    color: var(--secondary);
    font-size: 13px;
    font-style: italic;
}

.date-column {
    width: 120px;
    color: var(--secondary);
}

.actions-column {
    width: 120px;
}

.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.action-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    color: var(--white);
    text-decoration: none;
}

.view-btn {
    background-color: var(--info);
}

.edit-btn {
    background-color: var(--warning);
}

.delete-btn {
    background-color: var(--danger);
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

/* Vista de tarjetas */
.cards-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    margin-top: 16px;
}

.role-card {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.role-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.card-header {
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.card-title {
    font-size: 18px;
    font-weight: 600;
}

.dropdown-toggle {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--secondary);
    font-size: 16px;
    padding: 4px;
    border-radius: 4px;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.dropdown-toggle:hover {
    background-color: var(--light);
}

.dropdown-menu {
    min-width: 180px;
    padding: 8px 0;
    border: none;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    border-radius: var(--border-radius);
}

.dropdown-item {
    padding: 8px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
}

.dropdown-item i {
    font-size: 16px;
}

.card-body {
    padding: 16px;
}

.card-info {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 16px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.info-label {
    font-size: 12px;
    color: var(--secondary);
}

.info-value {
    font-size: 14px;
    font-weight: 500;
}

.card-permissions {
    background-color: var(--light);
    border-radius: var(--border-radius);
    padding: 12px;
}

.permissions-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.permissions-title {
    font-size: 14px;
    font-weight: 500;
}

.permissions-count {
    background-color: var(--primary);
    color: var(--white);
    font-size: 12px;
    font-weight: 500;
    padding: 2px 8px;
    border-radius: 10px;
}

.permissions-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.permission-pill {
    background-color: var(--white);
    color: var(--dark);
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 12px;
}

.permission-pill.more {
    background-color: var(--secondary);
    color: var(--white);
    cursor: pointer;
}

.no-permissions {
    color: var(--secondary);
    font-size: 13px;
    font-style: italic;
    text-align: center;
    padding: 8px 0;
}

.card-footer {
    padding: 16px;
    display: flex;
    gap: 8px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.card-btn {
    flex: 1;
    padding: 8px;
    border-radius: var(--border-radius);
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.card-btn.primary {
    background-color: var(--primary);
    color: var(--white);
}

.card-btn.primary:hover {
    background-color: var(--primary-dark);
    color: var(--white);
}

.card-btn.secondary {
    background-color: var(--light);
    color: var(--dark);
}

.card-btn:hover {
    transform: translateY(-2px);
}

/* Paginación */
.pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    flex-wrap: wrap;
    gap: 16px;
}

.pagination-info {
    font-size: 14px;
    color: var(--secondary);
}

.pagination-controls {
    display: flex;
    gap: 8px;
}

.pagination-controls .page-link {
    border-radius: var(--border-radius);
    color: var(--dark);
    transition: var(--transition);
}

.pagination-controls .page-item.active .page-link {
    background-color: var(--primary);
    border-color: var(--primary);
}

/* Estado vacío */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 24px;
    text-align: center;
}

.empty-icon {
    font-size: 64px;
    color: var(--secondary);
    opacity: 0.3;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-title {
    font-size: 24px;
    font-weight: 600;
    margin: 0 0 12px 0;
}

.empty-description {
    font-size: 16px;
    color: var(--secondary);
    max-width: 400px;
    margin: 0 0 24px 0;
}

.empty-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    background-color: var(--primary);
    color: var(--white);
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.empty-action:hover {
    background-color: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(189, 109, 255, 0.25);
    color: var(--white);
}

/* Modal de confirmación */
.modal-content {
    border: none;
    border-radius: var(--border-radius);
    overflow: hidden;
}

.modal-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    padding: 16px 24px;
}

.modal-title {
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.modal-body {
    padding: 24px;
    text-align: center;
}

.delete-icon {
    font-size: 48px;
    color: var(--warning);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.delete-title {
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 12px 0;
}

.delete-message {
    font-size: 14px;
    color: var(--secondary);
    margin: 0;
}

.modal-footer {
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    padding: 16px 24px;
}

/* Botón flotante */
.floating-action-button {
    position: fixed;
    bottom: 32px;
    right: 32px;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background-color: var(--primary);
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 4px 12px rgba(189, 109, 255, 0.3);
    transition: var(--transition);
    z-index: 1000;
    text-decoration: none;
}

.floating-action-button:hover {
    background-color: var(--primary-dark);
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 6px 16px rgba(189, 109, 255, 0.4);
    color: var(--white);
}

.floating-action-button i {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

/* Tooltip personalizado */
.tooltip-permissions {
    text-align: left;
    font-size: 12px;
    max-height: 200px;
    overflow-y: auto;
}

/* Animaciones */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 991px) {
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .stats-cards {
        width: 100%;
        justify-content: space-between;
        overflow-x: auto;
        padding-bottom: 8px;
    }

    .stat-card {
        min-width: 160px;
    }

    .toolbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .search-tools {
        width: 100%;
    }

    .action-tools {
        width: 100%;
        justify-content: space-between;
    }
}

/* Transformación de tabla a tarjetas en móvil */
@media (max-width: 767px) {
    /* Ocultar cabecera de tabla en móvil */
    .data-table thead {
        display: none;
    }

    /* Convertir filas en tarjetas */
    .data-table,
    .data-table tbody,
    .data-table tr {
        display: block;
        width: 100%;
    }

    .data-table tr {
        margin-bottom: 16px;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .data-table td {
        display: flex;
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .data-table td:before {
        content: attr(data-label);
        font-weight: 600;
        width: 40%;
        margin-right: 16px;
    }

    .data-table td.actions-column {
        justify-content: center;
        padding: 16px;
        border-bottom: none;
    }

    .data-table td.actions-column:before {
        display: none;
    }

    /* Ajustes específicos para columnas */
    .id-column, .name-column, .permissions-column, .date-column {
        width: 100%;
    }

    .permissions-wrapper {
        flex: 1;
    }

    /* Ajustes para la paginación */
    .pagination-wrapper {
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }

    .pagination-info {
        text-align: center;
    }

    /* Ajustes para las tarjetas */
    .cards-container {
        grid-template-columns: 1fr;
    }

    /* Botón flotante */
    .floating-action-button {
        bottom: 16px;
        right: 16px;
        width: 50px;
        height: 50px;
        font-size: 20px;
    }

    /* Ajustes para el dashboard header */
    .dashboard-header {
        padding: 16px;
    }

    .dashboard-title {
        font-size: 24px;
    }

    .dashboard-subtitle {
        font-size: 14px;
    }
}

/* Estilos adicionales para la vista móvil */
@media (max-width: 767px) {
    /* Estilo para fila seleccionada en móvil */
    .data-row.selected-row {
        background-color: var(--primary-light);
        border-left: 3px solid var(--primary);
    }

    /* Mejorar la visualización de los badges en móvil */
    .permissions-badges {
        flex-wrap: wrap;
        max-width: 100%;
    }

    .permission-badge {
        margin-bottom: 4px;
    }

    /* Mejorar el espaciado en la vista de tarjetas */
    .role-card {
        margin-bottom: 16px;
    }

    /* Hacer que los botones de acción sean más grandes en móvil para facilitar el toque */
    .action-btn {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }

    /* Mejorar la visualización del modal en móvil */
    .modal-dialog {
        margin: 10px;
    }

    .delete-icon {
        font-size: 40px;
    }

    /* Mejorar la visualización de las estadísticas */
    .stats-cards {
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 8px;
        -webkit-overflow-scrolling: touch;
        scroll-snap-type: x mandatory;
    }

    .stat-card {
        scroll-snap-align: start;
        flex: 0 0 auto;
        width: 80%;
        max-width: 200px;
    }
}

/* Modal de confirmación mejorado */
.delete-confirmation {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 10px 0;
}

.delete-icon {
    font-size: 56px;
    color: var(--danger);
    margin-bottom: 20px;
    background-color: rgba(220, 53, 69, 0.1);
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.delete-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--dark);
}

.delete-info {
    background-color: var(--light);
    border-radius: var(--border-radius);
    padding: 16px;
    width: 100%;
    margin-bottom: 20px;
    text-align: left;
}

.role-info-item {
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
}

.role-info-item:last-child {
    margin-bottom: 0;
}

.role-label {
    font-weight: 600;
    font-size: 14px;
    color: var(--secondary);
    margin-bottom: 4px;
}

.role-value {
    font-size: 15px;
}

.delete-warning {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--warning);
    font-size: 14px;
    width: 100%;
    background-color: rgba(255, 193, 7, 0.1);
    padding: 10px 16px;
    border-radius: var(--border-radius);
}

.delete-warning i {
    font-size: 18px;
}

.delete-warning p {
    margin: 0;
}

.modal-header.bg-danger .btn-close-white {
    filter: brightness(0) invert(1);
}

/* Notificación de exportación */
.export-notification {
    position: fixed;
    bottom: 30px;
    left: 30px;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 16px;
    z-index: 1050;
    max-width: 350px;
    transform: translateY(100px);
    opacity: 0;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.export-notification.show {
    transform: translateY(0);
    opacity: 1;
}

.export-notification-icon {
    color: var(--success);
    font-size: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.export-notification-content h4 {
    margin: 0 0 4px 0;
    font-size: 16px;
    font-weight: 600;
}

.export-notification-content p {
    margin: 0;
    font-size: 14px;
    color: var(--secondary);
}

@media (max-width: 767px) {
    .export-notification {
        left: 16px;
        right: 16px;
        max-width: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            html: true
        });
    });

    // Calcular estadísticas
    calculateStats();

    // Manejar cambio de vista
    const viewButtons = document.querySelectorAll('.view-button');
    const dataViews = document.querySelectorAll('.data-view');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const viewType = this.getAttribute('data-view');

            // Actualizar botones
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Actualizar vistas
            dataViews.forEach(view => {
                if (view.id === viewType + 'View') {
                    view.classList.add('active');
                } else {
                    view.classList.remove('active');
                }
            });

            // Guardar preferencia en localStorage
            localStorage.setItem('rolesViewPreference', viewType);
        });
    });

    // Restaurar preferencia de vista
    const savedViewPreference = localStorage.getItem('rolesViewPreference');
    if (savedViewPreference) {
        const preferredViewButton = document.querySelector(`.view-button[data-view="${savedViewPreference}"]`);
        if (preferredViewButton) {
            preferredViewButton.click();
        }
    }

    // Manejar dropdown de acciones
    const actionButton = document.querySelector('.action-button');
    const actionMenu = document.querySelector('.action-menu');

    if (actionButton && actionMenu) {
        actionButton.addEventListener('click', function() {
            actionMenu.classList.toggle('show');
        });

        document.addEventListener('click', function(event) {
            if (!actionButton.contains(event.target) && !actionMenu.contains(event.target)) {
                actionMenu.classList.remove('show');
            }
        });
    }

    // Funcionalidad de exportación
    document.getElementById('exportExcel').addEventListener('click', function(e) {
        e.preventDefault();
        exportToExcel();
    });

    document.getElementById('exportPDF').addEventListener('click', function(e) {
        e.preventDefault();
        exportToPDF();
    });

    document.getElementById('exportCSV').addEventListener('click', function(e) {
        e.preventDefault();
        exportToCSV();
    });

    // Función para exportar a Excel
    function exportToExcel() {
        // Crear un nuevo libro de Excel
        const wb = XLSX.utils.book_new();

        // Preparar los datos
        const data = [];

        // Encabezados
        const headers = ['ID', 'Nombre', 'Permisos', 'Fecha de creación'];
        data.push(headers);

        // Obtener datos de las filas
        document.querySelectorAll('.data-row').forEach(row => {
            const id = row.querySelector('.id-column').textContent.trim();
            const name = row.getAttribute('data-name');

            // Obtener permisos
            let permissions = '';
            const permissionBadges = row.querySelectorAll('.permission-badge');
            if (permissionBadges.length > 0) {
                const permissionTexts = [];
                permissionBadges.forEach(badge => {
                    if (!badge.classList.contains('more')) {
                        permissionTexts.push(badge.textContent.trim());
                    }
                });
                permissions = permissionTexts.join(', ');
            } else {
                permissions = 'Sin permisos';
            }

            const date = row.getAttribute('data-created');

            data.push([id, name, permissions, date]);
        });

        // Crear hoja de cálculo
        const ws = XLSX.utils.aoa_to_sheet(data);

        // Añadir la hoja al libro
        XLSX.utils.book_append_sheet(wb, ws, 'Roles');

        // Guardar el archivo
        XLSX.writeFile(wb, 'roles.xlsx');

        // Mostrar notificación
        showExportNotification('Excel');
    }

    // Función para exportar a PDF
    function exportToPDF() {
        // Crear documento PDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Título
        doc.setFontSize(18);
        doc.text('Listado de Roles', 14, 22);

        // Fecha de generación
        doc.setFontSize(11);
        doc.setTextColor(100);
        doc.text(`Generado el: ${new Date().toLocaleDateString()}`, 14, 30);

        // Preparar datos para la tabla
        const tableColumn = ['ID', 'Nombre', 'Permisos', 'Fecha'];
        const tableRows = [];

        // Obtener datos de las filas
        document.querySelectorAll('.data-row').forEach(row => {
            const id = row.querySelector('.id-column').textContent.trim();
            const name = row.getAttribute('data-name');

            // Obtener permisos
            let permissions = '';
            const permissionBadges = row.querySelectorAll('.permission-badge');
            if (permissionBadges.length > 0) {
                const permissionTexts = [];
                permissionBadges.forEach(badge => {
                    if (!badge.classList.contains('more')) {
                        permissionTexts.push(badge.textContent.trim());
                    }
                });
                permissions = permissionTexts.join(', ');
            } else {
                permissions = 'Sin permisos';
            }

            const date = row.getAttribute('data-created');

            tableRows.push([id, name, permissions, date]);
        });

        // Generar tabla
        doc.autoTable({
            head: [tableColumn],
            body: tableRows,
            startY: 40,
            styles: {
                fontSize: 10,
                cellPadding: 3,
                lineColor: [200, 200, 200]
            },
            headStyles: {
                fillColor: [189, 109, 255],
                textColor: [255, 255, 255],
                fontStyle: 'bold'
            },
            alternateRowStyles: {
                fillColor: [240, 240, 240]
            }
        });

        // Guardar el archivo
        doc.save('roles.pdf');

        // Mostrar notificación
        showExportNotification('PDF');
    }

    // Función para exportar a CSV
    function exportToCSV() {
        // Preparar los datos
        let csvContent = "data:text/csv;charset=utf-8,";

        // Encabezados
        csvContent += "ID,Nombre,Permisos,Fecha de creación\r\n";

        // Obtener datos de las filas
        document.querySelectorAll('.data-row').forEach(row => {
            const id = row.querySelector('.id-column').textContent.trim();
            const name = row.getAttribute('data-name');

            // Obtener permisos
            let permissions = '';
            const permissionBadges = row.querySelectorAll('.permission-badge');
            if (permissionBadges.length > 0) {
                const permissionTexts = [];
                permissionBadges.forEach(badge => {
                    if (!badge.classList.contains('more')) {
                        permissionTexts.push(badge.textContent.trim());
                    }
                });
                permissions = permissionTexts.join(', ');
            } else {
                permissions = 'Sin permisos';
            }

            const date = row.getAttribute('data-created');

            // Escapar comas en los campos
            const escapedName = name.includes(',') ? `"${name}"` : name;
            const escapedPermissions = permissions.includes(',') ? `"${permissions}"` : permissions;

            csvContent += `${id},${escapedName},${escapedPermissions},${date}\r\n`;
        });

        // Crear enlace de descarga
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "roles.csv");
        document.body.appendChild(link);

        // Descargar
        link.click();
        document.body.removeChild(link);

        // Mostrar notificación
        showExportNotification('CSV');
    }

    // Función para mostrar notificación de exportación
    function showExportNotification(format) {
        // Crear elemento de notificación
        const notification = document.createElement('div');
        notification.className = 'export-notification';
        notification.innerHTML = `
            <div class="export-notification-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="export-notification-content">
                <h4>Exportación completada</h4>
                <p>El archivo se ha exportado correctamente en formato ${format}.</p>
            </div>
        `;

        // Añadir al DOM
        document.body.appendChild(notification);

        // Mostrar con animación
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        // Ocultar después de 3 segundos
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Manejar búsqueda
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const tableRows = document.querySelectorAll('.data-row');
    const roleCards = document.querySelectorAll('.role-card');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        // Filtrar filas de tabla
        tableRows.forEach(row => {
            const name = row.getAttribute('data-name').toLowerCase();

            if (name.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Filtrar tarjetas
        roleCards.forEach(card => {
            const name = card.getAttribute('data-name').toLowerCase();

            if (name.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });

    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
    });

    // Manejar ordenamiento de tabla
    const sortableHeaders = document.querySelectorAll('th.sortable');

    sortableHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const sortBy = this.getAttribute('data-sort');
            const isAscending = !this.classList.contains('sorted-asc');

            // Actualizar clases de ordenamiento
            sortableHeaders.forEach(h => {
                h.classList.remove('sorted-asc', 'sorted-desc');
            });

            this.classList.add(isAscending ? 'sorted-asc' : 'sorted-desc');

            // Ordenar filas
            sortRows(sortBy, isAscending);
        });
    });

    // Función para ordenar filas
    function sortRows(sortBy, isAscending) {
        const tbody = document.querySelector('.data-table tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        rows.sort((a, b) => {
            let valueA, valueB;

            if (sortBy === 'id') {
                valueA = parseInt(a.querySelector('.id-column').textContent);
                valueB = parseInt(b.querySelector('.id-column').textContent);
            } else if (sortBy === 'name') {
                valueA = a.getAttribute('data-name');
                valueB = b.getAttribute('data-name');
            } else if (sortBy === 'date') {
                valueA = a.getAttribute('data-date') || '0';
                valueB = b.getAttribute('data-date') || '0';
            }

            if (isAscending) {
                return valueA > valueB ? 1 : -1;
            } else {
                return valueA < valueB ? 1 : -1;
            }
        });

        // Reordenar DOM
        rows.forEach(row => {
            tbody.appendChild(row);
        });
    }

    // Manejar confirmación de eliminación
    window.confirmDelete = function(roleId, roleName) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.getElementById('deleteRoleName').textContent = roleName;

        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.onclick = function() {
            document.getElementById(`delete-form-${roleId}`).submit();
        };

        deleteModal.show();
    };

    // Cerrar notificación
    window.closeNotification = function() {
        const notification = document.getElementById('notification');
        if (notification) {
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 300);
        }
    };

    // Auto-cerrar notificación después de 5 segundos
    setTimeout(closeNotification, 5000);

    // Calcular estadísticas
    function calculateStats() {
        let totalPermissions = 0;
        let totalUsers = 0;

        document.querySelectorAll('.data-row').forEach(row => {
            const permissionsText = row.querySelector('.permissions-column').textContent;
            const match = permissionsText.match(/\+(\d+)/);

            if (match) {
                totalPermissions += parseInt(match[1]) + 3; // +3 por los que se muestran
            } else {
                const badges = row.querySelectorAll('.permission-badge').length;
                if (badges > 0) {
                    totalPermissions += badges;
                }
            }

            const usersText = row.querySelector('.role-users').textContent;
            const usersMatch = usersText.match(/(\d+)/);
            if (usersMatch) {
                totalUsers += parseInt(usersMatch[1]);
            }
        });

        document.getElementById('totalPermissions').textContent = totalPermissions;
        document.getElementById('totalUsers').textContent = totalUsers;
    }

    // Animación de entrada para las filas
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';

        setTimeout(() => {
            row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, 50 * index);
    });

    // Animación de entrada para las tarjetas
    roleCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 50 * index);
    });

    // Agregar este código para mejorar la experiencia en móviles
    function setupMobileView() {
        // Detectar si estamos en móvil
        const isMobile = window.innerWidth < 768;

        if (isMobile) {
            // Si estamos en vista de tabla en móvil, cambiar automáticamente a vista de tarjetas
            const tableViewButton = document.querySelector('.view-button[data-view="table"]');
            const cardsViewButton = document.querySelector('.view-button[data-view="cards"]');

            if (tableViewButton && tableViewButton.classList.contains('active')) {
                // Solo cambiamos si no está ya en vista de tarjetas
                if (cardsViewButton) {
                    cardsViewButton.click();
                }
            }

            // Mejorar la interacción con las tarjetas en la vista de tabla
            document.querySelectorAll('.data-row').forEach(row => {
                row.addEventListener('click', function(e) {
                    // No activar si se hizo clic en un botón de acción
                    if (e.target.closest('.action-btn') || e.target.closest('form')) {
                        return;
                    }

                    // Alternar clase para destacar la fila seleccionada
                    this.classList.toggle('selected-row');
                });
            });
        }
    }

    // Ejecutar al cargar y al cambiar el tamaño de la ventana
    window.addEventListener('load', setupMobileView);
    window.addEventListener('resize', setupMobileView);
});
</script>

<!-- Bibliotecas para exportación -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
@endsection
