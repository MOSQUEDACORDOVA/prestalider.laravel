@extends('layouts.app')

@section('content')
<br>
<div class="role-view-container">
    <div class="view-header">
        <div class="header-content">
            <div class="title-section">
                <h2 class="view-title">Detalles del Rol</h2>
                <p class="view-subtitle">Información completa y permisos asignados</p>
            </div>
            <div class="actions-section">
                <a href="{{ route('roles.index') }}" class="btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
                @can('role-edit')
                <a href="{{ route('roles.edit', $role->id) }}" class="btn-primary">
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
                <h3 class="card-title">Información del Rol</h3>
                <div class="role-badge">ID: {{ $role->id }}</div>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Nombre del Rol</div>
                        <div class="info-value">{{ $role->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Fecha de Creación</div>
                        <div class="info-value">{{ $role->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Última Actualización</div>
                        <div class="info-value">{{ $role->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Total de Permisos</div>
                        <div class="info-value">{{ count($rolePermissions) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="view-card permissions-card">
            <div class="card-header">
                <h3 class="card-title">Permisos Asignados</h3>
                <div class="card-actions">
                    <div class="search-wrapper">
                        <i class="bi bi-search"></i>
                        <input type="text" id="searchPermissions" placeholder="Buscar permisos...">
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($rolePermissions) > 0)
                    @if(!empty($permissionGroups))
                        <div class="permission-groups-container">
                            @foreach($permissionGroups as $group => $permissions)
                                @if(count($permissions) > 0)
                                    <div class="permission-group">
                                        <div class="group-header">
                                            <h4 class="group-title">{{ ucfirst($group) }}</h4>
                                            <div class="permission-count">{{ count($permissions) }}</div>
                                        </div>
                                        <div class="permissions-grid">
                                            @foreach($permissions as $permission)
                                                <div class="permission-item">
                                                    <div class="permission-badge">
                                                        <i class="bi bi-shield-check"></i>
                                                        <span>{{ $permission->name }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="permissions-grid">
                            @foreach($rolePermissions as $permission)
                                <div class="permission-item">
                                    <div class="permission-badge">
                                        <i class="bi bi-shield-check"></i>
                                        <span>{{ $permission->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="no-permissions">
                        <i class="bi bi-exclamation-circle"></i>
                        <p>Este rol no tiene permisos asignados.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="view-card users-card">
            <div class="card-header">
                <h3 class="card-title">Usuarios con este Rol</h3>
            </div>
            <div class="card-body">
                @if(count($roleUsers) > 0)
                    <div class="users-grid">
                        @foreach($roleUsers as $user)
                            <div class="user-item">
                                <div class="user-avatar">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="user-info">
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-users">
                        <i class="bi bi-people"></i>
                        <p>No hay usuarios asignados a este rol.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="view-actions">
            <a href="{{ route('roles.index') }}" class="btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Volver
            </a>
            @can('role-edit')
            <a href="{{ route('roles.edit', $role->id) }}" class="btn-primary">
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

.role-view-container {
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
    background-color: var(--primary);
    color: var(--white);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    font-size: 13px;
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 3px 6px rgba(189, 109, 255, 0.25);
    color: var(--white);
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

.role-badge {
    background-color: var(--primary-light);
    color: var(--primary-dark);
    padding: 4px 10px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 500;
}

.card-actions {
    display: flex;
    gap: 10px;
}

.search-wrapper {
    position: relative;
}

.search-wrapper i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    font-size: 12px;
}

.search-wrapper input {
    padding: 6px 10px 6px 30px;
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    font-size: 13px;
    transition: var(--transition);
    width: 180px;
}

.search-wrapper input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(189, 109, 255, 0.15);
    width: 200px;
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

.permission-groups-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.permission-group {
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: var(--border-radius);
    overflow: hidden;
}

.group-header {
    background-color: var(--light);
    padding: 10px 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.group-title {
    font-size: 14px;
    font-weight: 600;
    margin: 0;
}

.permission-count {
    background-color: var(--primary);
    color: var(--white);
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 10px;
    padding: 12px;
}

.permission-item {
    position: relative;
}

.permission-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 10px;
    background-color: var(--primary-light);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.permission-badge i {
    color: var(--primary);
    font-size: 14px;
}

.permission-badge span {
    font-size: 13px;
    font-weight: 500;
    color: var(--primary-dark);
}

.no-permissions, .no-users {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px 0;
    color: var(--secondary);
}

.no-permissions i, .no-users i {
    font-size: 36px;
    margin-bottom: 12px;
    opacity: 0.5;
}

.no-permissions p, .no-users p {
    font-size: 14px;
    margin: 0;
}

.users-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 12px;
}

.user-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: var(--border-radius);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: var(--transition);
}

.user-item:hover {
    background-color: var(--primary-light);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.user-avatar {
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

.user-info {
    flex: 1;
}

.user-name {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 2px;
}

.user-email {
    font-size: 12px;
    color: var(--secondary);
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

    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .permissions-grid {
        grid-template-columns: 1fr;
    }

    .users-grid {
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Búsqueda de permisos
    const searchInput = document.getElementById('searchPermissions');
    if (searchInput) {
        const permissionItems = document.querySelectorAll('.permission-item');
        const permissionGroups = document.querySelectorAll('.permission-group');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            permissionItems.forEach(item => {
                const permissionName = item.querySelector('.permission-badge span').textContent.toLowerCase();

                if (permissionName.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });

            // Mostrar/ocultar grupos según si tienen permisos visibles
            permissionGroups.forEach(group => {
                const visibleItems = Array.from(group.querySelectorAll('.permission-item')).filter(item => item.style.display !== 'none').length;

                if (visibleItems === 0) {
                    group.style.display = 'none';
                } else {
                    group.style.display = '';
                }
            });
        });
    }
});
</script>
@endsection
