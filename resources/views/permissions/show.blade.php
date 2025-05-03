@extends('layouts.app')

@section('content')<br>
<div class="permission-view-container">
    <div class="view-header">
        <div class="header-content">
            <div class="title-section">
                <h2 class="view-title">Detalles del Permiso</h2>
                <p class="view-subtitle">Información completa del permiso</p>
            </div>
            <div class="actions-section">
                <a href="{{ route('permissions.index') }}" class="btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
                @can('permission-edit')
                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn-primary">
                    <i class="bi bi-pencil-square"></i>
                    Editar
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="view-content">
        <div class="view-card">
            <div class="card-header">
                <h3 class="card-title">Información del Permiso</h3>
                <div class="permission-badge">ID: {{ $permission->id }}</div>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Nombre del Permiso</div>
                        <div class="info-value">{{ $permission->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Módulo</div>
                        <div class="info-value">{{ ucfirst($module) }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Acción</div>
                        <div class="info-value">{{ $action }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Guard Name</div>
                        <div class="info-value">{{ $permission->guard_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Descripción</div>
                        <div class="info-value">{{ $permission->description ?? 'Sin descripción' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Fecha de Creación</div>
                        <div class="info-value">{{ $permission->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Última Actualización</div>
                        <div class="info-value">{{ $permission->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="view-card roles-card">
            <div class="card-header">
                <h3 class="card-title">Roles con este Permiso</h3>
            </div>
            <div class="card-body">
                @if(count($permissionRoles) > 0)
                    <div class="roles-grid">
                        @foreach($permissionRoles as $role)
                            <div class="role-item">
                                <div class="role-icon">
                                    <i class="bi bi-shield"></i>
                                </div>
                                <div class="role-info">
                                    <div class="role-name">{{ $role->name }}</div>
                                    <div class="role-meta">ID: {{ $role->id }}</div>
                                </div>
                                <a href="{{ route('roles.show', $role->id) }}" class="role-link">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-roles">
                        <i class="bi bi-shield-x"></i>
                        <p>Este permiso no está asignado a ningún rol.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="view-actions">
            <a href="{{ route('permissions.index') }}" class="btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Volver
            </a>
            @can('permission-edit')
            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn-primary">
                <i class="bi bi-pencil-square"></i>
                Editar
            </a>
            @endcan
        </div>
    </div>
</div>

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
    --border-radius: 6px;
    --card-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    --transition: all 0.2s ease;
    --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.permission-view-container {
    font-family: var(--font-family);
    color: var(--dark);
    margin-bottom: 40px;
    font-size: 14px;
}

.view-header {
    margin-bottom: 20px;
    background: linear-gradient(135deg, var(--primary) 0%, #9d4ddb 100%);
    border-radius: var(--border-radius);
    padding: 16px 20px;
    color: var(--white);
    box-shadow: 0 3px 10px rgba(189, 109, 255, 0.2);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.title-section {
    flex: 1;
    min-width: 200px;
}

.view-title {
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 6px 0;
}

.view-subtitle {
    font-size: 14px;
    opacity: 0.9;
    margin: 0;
}

.actions-section {
    display: flex;
    gap: 10px;
}

.btn-secondary {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 20px;
    background-color: rgba(255, 255, 255, 0.2);
    color: var(--white);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    font-size: 13px;
}

.btn-secondary:hover {
    background-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-1px);
    color: var(--white);
}

.btn-primary {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 20px;
    background-color: var(--white);
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    font-size: 13px;
}

.btn-primary:hover {
    background-color: rgba(255, 255, 255, 0.9);
    transform: translateY(-1px);
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
}

.view-content {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    padding: 20px;
}

.view-card {
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: var(--border-radius);
    margin-bottom: 20px;
    overflow: hidden;
}

.card-header {
    background-color: var(--light);
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}

.permission-badge {
    background-color: var(--primary-light);
    color: var(--primary-dark);
    padding: 4px 10px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 500;
}

.card-body {
    padding: 16px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.info-label {
    font-size: 13px;
    color: var(--secondary);
    font-weight: 500;
}

.info-value {
    font-size: 14px;
    font-weight: 600;
}

.roles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 12px;
}

.role-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: var(--border-radius);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: var(--transition);
}

.role-item:hover {
    background-color: var(--primary-light);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.role-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 18px;
}

.role-info {
    flex: 1;
}

.role-name {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 2px;
}

.role-meta {
    font-size: 12px;
    color: var(--secondary);
}

.role-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: var(--primary-light);
    color: var(--primary);
    text-decoration: none;
    transition: var(--transition);
}

.role-link:hover {
    background-color: var(--primary);
    color: var(--white);
    transform: translateX(2px);
}

.no-roles {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px 0;
    color: var(--secondary);
}

.no-roles i {
    font-size: 36px;
    margin-bottom: 12px;
    opacity: 0.5;
}

.no-roles p {
    font-size: 14px;
    margin: 0;
}

.view-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 20px;
}

@media (max-width: 768px) {
    .view-header {
        padding: 14px;
    }

    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .actions-section {
        width: 100%;
        justify-content: flex-start;
    }

    .view-content {
        padding: 14px;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .roles-grid {
        grid-template-columns: 1fr;
    }

    .view-actions {
        flex-direction: column;
    }

    .btn-secondary, .btn-primary {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
