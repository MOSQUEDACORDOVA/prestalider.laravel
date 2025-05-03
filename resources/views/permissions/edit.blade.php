@extends('layouts.app')

@section('content')<br>
<div class="permission-form-container">
    <div class="form-header">
        <div class="header-content">
            <div class="title-section">
                <h2 class="form-title">Editar Permiso</h2>
                <p class="form-subtitle">Modifica la información del permiso</p>
            </div>
            <div class="actions-section">
                <a href="{{ route('permissions.index') }}" class="btn-secondary">
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

        <form action="{{ route('permissions.update', $permission->id) }}" method="POST" id="permissionForm">
            @csrf
            @method('PATCH')
            <div class="form-card">
                <div class="card-header">
                    <h3 class="card-title">Información del Permiso</h3>
                    <div class="permission-badge">ID: {{ $permission->id }}</div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="module">Módulo <span class="required">*</span></label>
                            <div class="input-group">
                                <select name="module" id="module" class="form-control" required>
                                    <option value="">Seleccionar módulo</option>
                                    @foreach($modules as $mod)
                                    <option value="{{ $mod }}" {{ $module == $mod ? 'selected' : '' }}>{{ ucfirst($mod) }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn-addon" id="newModuleBtn">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">Selecciona o crea un nuevo módulo para agrupar permisos</small>
                        </div>

                        <div class="form-group">
                            <label for="action">Acción <span class="required">*</span></label>
                            <input type="text" name="action" id="action" class="form-control" value="{{ $action }}" required>
                            <small class="form-text text-muted">Define la acción que permite este permiso (ej: list, create, edit, delete)</small>
                        </div>
                    </div>

                    <div class="form-group" id="newModuleGroup" style="display: none;">
                        <label for="newModule">Nuevo Módulo <span class="required">*</span></label>
                        <input type="text" id="newModule" class="form-control" placeholder="Nombre del nuevo módulo">
                        <small class="form-text text-muted">Ingresa un nombre para el nuevo módulo (solo letras minúsculas y guiones)</small>
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" readonly>
                        <small class="form-text text-muted">El nombre se genera automáticamente combinando el módulo y la acción</small>
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ $permission->description }}</textarea>
                        <small class="form-text text-muted">Proporciona una descripción clara de lo que permite este permiso</small>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="window.location.href='{{ route('permissions.index') }}'">
                    <i class="bi bi-x"></i>
                    Cancelar
                </button>
                <button type="submit" class="btn-primary">
                    <i class="bi bi-check-lg"></i>
                    Actualizar Permiso
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

.permission-form-container {
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

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
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

.form-control[readonly] {
    background-color: var(--light);
    cursor: not-allowed;
}

.form-text {
    font-size: 12px;
    margin-top: 4px;
    display: block;
    color: var(--secondary);
}

.input-group {
    display: flex;
    align-items: center;
}

.input-group .form-control {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    flex: 1;
}

.btn-addon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 0 var(--border-radius) var(--border-radius) 0;
    background-color: var(--primary);
    color: var(--white);
    border: none;
    cursor: pointer;
    transition: var(--transition);
}

.btn-addon:hover {
    background-color: var(--primary-dark);
}

textarea.form-control {
    resize: vertical;
    min-height: 80px;
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

    .form-row {
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
    const moduleSelect = document.getElementById('module');
    const actionInput = document.getElementById('action');
    const nameInput = document.getElementById('name');
    const newModuleBtn = document.getElementById('newModuleBtn');
    const newModuleGroup = document.getElementById('newModuleGroup');
    const newModuleInput = document.getElementById('newModule');

    // Generar nombre completo del permiso
    function updatePermissionName() {
        const module = moduleSelect.value;
        const action = actionInput.value;

        if (module && action) {
            nameInput.value = `${module}-${action}`;
        } else {
            nameInput.value = '';
        }
    }

    moduleSelect.addEventListener('change', updatePermissionName);
    actionInput.addEventListener('input', updatePermissionName);

    // Mostrar/ocultar campo para nuevo módulo
    newModuleBtn.addEventListener('click', function() {
        newModuleGroup.style.display = 'block';
        newModuleInput.focus();
    });

    // Agregar nuevo módulo al selector
    newModuleInput.addEventListener('blur', function() {
        const newModule = newModuleInput.value.trim().toLowerCase();

        if (newModule) {
            // Validar que solo contenga letras minúsculas y guiones
            if (/^[a-z-]+$/.test(newModule)) {
                // Verificar si ya existe
                let exists = false;

                for (let i = 0; i < moduleSelect.options.length; i++) {
                    if (moduleSelect.options[i].value === newModule) {
                        exists = true;
                        break;
                    }
                }

                if (!exists) {
                    const option = document.createElement('option');
                    option.value = newModule;
                    option.textContent = newModule.charAt(0).toUpperCase() + newModule.slice(1);
                    moduleSelect.appendChild(option);
                }

                moduleSelect.value = newModule;
                newModuleGroup.style.display = 'none';
                newModuleInput.value = '';
                updatePermissionName();
            } else {
                alert('El nombre del módulo solo puede contener letras minúsculas y guiones.');
            }
        }
    });

    // Validación del formulario
    const permissionForm = document.getElementById('permissionForm');

    permissionForm.addEventListener('submit', function(e) {
        const module = moduleSelect.value;
        const action = actionInput.value;

        if (!module) {
            e.preventDefault();
            alert('Por favor, seleccione un módulo.');
            moduleSelect.focus();
            return;
        }

        if (!action) {
            e.preventDefault();
            alert('Por favor, ingrese una acción.');
            actionInput.focus();
            return;
        }
    });
});
</script>
@endsection
