@extends('layouts.app')

@section('content')
<div class="role-form-container">
    <div class="form-header">
        <div class="header-content">
            <div class="title-section">
                <h2 class="form-title">Editar Rol</h2>
                <p class="form-subtitle">Modifica el rol y sus permisos asignados</p>
            </div>
            <div class="actions-section">
                <a href="{{ route('roles.index') }}" class="btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>

    <div class="form-content">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>¡Ups!</strong> Hay algunos problemas con tu entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('roles.update', $role->id) }}" method="POST" id="roleForm">
            @csrf
            @method('PATCH')
            <div class="form-card">
                <div class="card-header">
                    <h3 class="card-title">Información del Rol</h3>
                    <div class="role-badge">ID: {{ $role->id }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre del Rol <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
                        <small class="form-text text-muted">El nombre debe ser único y descriptivo (ej: "Administrador", "Editor")</small>
                    </div>
                </div>
            </div>

            <div class="form-card permissions-card">
                <div class="card-header">
                    <h3 class="card-title">Asignar Permisos</h3>
                    <div class="card-actions">
                        <button type="button" class="btn-text" id="selectAll">Seleccionar todos</button>
                        <button type="button" class="btn-text" id="deselectAll">Deseleccionar todos</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="search-permissions">
                        <i class="bi bi-search"></i>
                        <input type="text" id="searchPermissions" placeholder="Buscar permisos...">
                    </div>

                    <div class="permissions-container">
                        @if(!empty($permissionGroups))
                            @foreach($permissionGroups as $group => $permissions)
                                <div class="permission-group">
                                    <div class="group-header">
                                        <h4 class="group-title">{{ ucfirst($group) }}</h4>
                                        <div class="group-actions">
                                            <button type="button" class="btn-text select-group" data-group="{{ $group }}">
                                                Seleccionar grupo
                                            </button>
                                        </div>
                                    </div>
                                    <div class="permissions-grid">
                                        @foreach($permissions as $permission)
                                            <div class="permission-item">
                                                <label class="permission-checkbox">
                                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="permission-name">{{ $permission->name }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($permission as $value)
                                <div class="permission-item">
                                    <label class="permission-checkbox">
                                        <input type="checkbox" name="permission[]" value="{{ $value->id }}"
                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                        <span class="permission-name">{{ $value->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="window.location.href='{{ route('roles.index') }}'">
                    <i class="bi bi-x"></i>
                    Cancelar
                </button>
                <button type="submit" class="btn-primary">
                    <i class="bi bi-check-lg"></i>
                    Actualizar Rol
                </button>
            </div>
        </form>
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

.role-form-container {
    font-family: var(--font-family);
    color: var(--dark);
    margin-bottom: 40px;
    font-size: 14px;
}

.form-header {
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

.form-title {
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 6px 0;
}

.form-subtitle {
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

.form-content {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    padding: 20px;
}

.alert {
    padding: 12px 16px;
    border-radius: var(--border-radius);
    margin-bottom: 20px;
    font-size: 13px;
}

.alert-danger {
    background-color: rgba(220, 53, 69, 0.1);
    border-left: 3px solid var(--danger);
    color: var(--danger);
}

.alert ul {
    margin-bottom: 0;
    padding-left: 20px;
}

.form-card {
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

.btn-text {
    background: none;
    border: none;
    color: var(--primary);
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    padding: 4px 8px;
    font-size: 13px;
}

.btn-text:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.card-body {
    padding: 16px;
}

.form-group {
    margin-bottom: 16px;
}

.form-group:last-child {
    margin-bottom: 0;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    font-size: 14px;
}

.required {
    color: var(--danger);
}

.form-control {
    width: 100%;
    padding: 8px 12px;
    border-radius: var(--border-radius);
    border: 1px solid rgba(0, 0, 0, 0.1);
    font-size: 14px;
    transition: var(--transition);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(189, 109, 255, 0.15);
}

.form-text {
    font-size: 12px;
    margin-top: 4px;
    display: block;
    color: var(--secondary);
}

.search-permissions {
    position: relative;
    margin-bottom: 16px;
}

.search-permissions i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    font-size: 12px;
}

.search-permissions input {
    width: 100%;
    padding: 8px 12px 8px 32px;
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    font-size: 13px;
    transition: var(--transition);
}

.search-permissions input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(189, 109, 255, 0.15);
}

.permissions-container {
    max-height: 400px;
    overflow-y: auto;
    padding-right: 8px;
}

.permissions-container::-webkit-scrollbar {
    width: 5px;
}

.permissions-container::-webkit-scrollbar-thumb {
    background: rgba(128, 128, 128, 0.5);
    border-radius: 5px;
}

.permissions-container::-webkit-scrollbar-track {
    background: rgba(200, 200, 200, 0.3);
    border-radius: 5px;
}

.permission-group {
    margin-bottom: 16px;
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

.group-actions {
    display: flex;
    gap: 8px;
}

.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 8px;
    padding: 12px;
}

.permission-item {
    position: relative;
}

.permission-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 6px 10px;
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.permission-checkbox:hover {
    background-color: var(--primary-light);
}

.permission-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: relative;
    height: 16px;
    width: 16px;
    background-color: var(--white);
    border: 2px solid rgba(0, 0, 0, 0.2);
    border-radius: 3px;
    margin-right: 10px;
    transition: var(--transition);
}

.permission-checkbox:hover input ~ .checkmark {
    border-color: var(--primary);
}

.permission-checkbox input:checked ~ .checkmark {
    background-color: var(--primary);
    border-color: var(--primary);
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.permission-checkbox input:checked ~ .checkmark:after {
    display: block;
}

.permission-checkbox .checkmark:after {
    left: 4px;
    top: 1px;
    width: 4px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.permission-name {
    font-size: 13px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 20px;
}

.btn-primary {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
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
}

@media (max-width: 768px) {
    .form-header {
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

    .form-content {
        padding: 14px;
    }

    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .card-actions {
        width: 100%;
        justify-content: flex-start;
    }

    .permissions-grid {
        grid-template-columns: 1fr;
    }

    .form-actions {
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
    // Seleccionar/Deseleccionar todos los permisos
    const selectAllBtn = document.getElementById('selectAll');
    const deselectAllBtn = document.getElementById('deselectAll');
    const checkboxes = document.querySelectorAll('input[name="permission[]"]');

    selectAllBtn.addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    });

    deselectAllBtn.addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    });

    // Seleccionar grupo de permisos
    const selectGroupBtns = document.querySelectorAll('.select-group');

    selectGroupBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const group = this.getAttribute('data-group');
            const groupContainer = this.closest('.permission-group');
            const groupCheckboxes = groupContainer.querySelectorAll('input[name="permission[]"]');

            groupCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        });
    });

    // Búsqueda de permisos
    const searchInput = document.getElementById('searchPermissions');
    const permissionItems = document.querySelectorAll('.permission-item');
    const permissionGroups = document.querySelectorAll('.permission-group');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        permissionItems.forEach(item => {
            const permissionName = item.querySelector('.permission-name').textContent.toLowerCase();

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

    // Validación del formulario
    const roleForm = document.getElementById('roleForm');

    roleForm.addEventListener('submit', function(e) {
        const nameInput = document.getElementById('name');
        const checkedPermissions = document.querySelectorAll('input[name="permission[]"]:checked');

        if (nameInput.value.trim() === '') {
            e.preventDefault();
            alert('Por favor, ingrese un nombre para el rol.');
            nameInput.focus();
            return;
        }

        if (checkedPermissions.length === 0) {
            if (!confirm('¿Está seguro de guardar un rol sin permisos asignados?')) {
                e.preventDefault();
                return;
            }
        }
    });
});
</script>
@endsection
