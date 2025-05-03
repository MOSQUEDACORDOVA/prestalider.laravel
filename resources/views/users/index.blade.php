@extends('layouts.app')

@section('content') <br>
<div class="users-container">
    <div class="page-header">
        <div class="header-content">
            <div class="title-section">
                <h2 class="page-title">Gestión de Usuarios</h2>
                <p class="page-subtitle">Administra los usuarios del sistema</p>
            </div>
            <div class="actions-section">
                @can('user-create')
                <a href="{{ route('users.create') }}" class="btn-primary">
                    <i class="bi bi-person-plus"></i>
                    Nuevo Usuario
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="page-content">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="filters-section">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" id="searchUsers" placeholder="Buscar usuarios...">
            </div>
            <div class="filter-actions">
                <div class="dropdown-filter">
                    <button class="btn-filter" id="roleFilterBtn">
                        <i class="bi bi-funnel"></i>
                        Filtrar por Rol
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="dropdown-content" id="roleFilterDropdown">
                        <div class="dropdown-item">
                            <label class="filter-checkbox">
                                <input type="checkbox" value="all" checked>
                                <span class="checkmark"></span>
                                <span>Todos los roles</span>
                            </label>
                        </div>
                        @foreach($roles as $id => $name)
                        <div class="dropdown-item">
                            <label class="filter-checkbox">
                                <input type="checkbox" value="{{ $name }}" class="role-filter">
                                <span class="checkmark"></span>
                                <span>{{ $name }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="users-table-wrapper">
            <table class="users-table">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="150">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="user-row" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-roles="{{ implode(',', $user->getRoleNames()->toArray()) }}">
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <span>{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div class="user-name">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="user-roles">
                                @foreach($user->getRoleNames() as $role)
                                <span class="role-badge">{{ $role }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="actions-cell">
                            <div class="table-actions">
                                <a href="{{ route('users.show', $user->id) }}" class="btn-action btn-view" title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @can('user-edit')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @endcan
                                @can('user-delete')
                                @if(auth()->id() != $user->id)
                                <button type="button" class="btn-action btn-delete" title="Eliminar" onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                    <h4 class="delete-title">¿Estás seguro de eliminar este usuario?</h4>
                    <div class="delete-info">
                        <div class="role-info-item">
                            <span class="role-label">Nombre:</span>
                            <span class="role-value" id="deleteUserName"></span>
                        </div>
                        <div class="role-info-item">
                            <span class="role-label">Email:</span>
                            <span class="role-value" id="deleteUserEmail"></span>
                        </div>
                        <div class="role-info-item">
                            <span class="role-label">Consecuencias:</span>
                            <span class="role-value">El usuario perderá acceso al sistema y todos sus roles asignados.</span>
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
                    Eliminar usuario
                </button>
            </div>
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

.users-container {
    font-family: var(--font-family);
    color: var(--dark);
    margin-bottom: 40px;
    font-size: 14px;
}

.page-header {
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

.page-title {
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 6px 0;
}

.page-subtitle {
    font-size: 14px;
    opacity: 0.9;
    margin: 0;
}

.actions-section {
    display: flex;
    gap: 10px;
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

.page-content {
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

.alert-success {
    background-color: rgba(40, 167, 69, 0.1);
    border-left: 3px solid var(--success);
    color: var(--success);
}

.alert-danger {
    background-color: rgba(220, 53, 69, 0.1);
    border-left: 3px solid var(--danger);
    color: var(--danger);
}

.alert p {
    margin: 0;
}

.filters-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
}

.search-wrapper {
    position: relative;
    flex: 1;
    max-width: 300px;
}

.search-wrapper i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    font-size: 12px;
}

.search-wrapper input {
    width: 100%;
    padding: 8px 12px 8px 32px;
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    font-size: 13px;
    transition: var(--transition);
}

.search-wrapper input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(189, 109, 255, 0.15);
}

.filter-actions {
    display: flex;
    gap: 10px;
}

.dropdown-filter {
    position: relative;
}

.btn-filter {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 20px;
    background-color: var(--light);
    color: var(--dark);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    border: 1px solid rgba(0, 0, 0, 0.05);
    cursor: pointer;
    font-size: 13px;
}

.btn-filter:hover {
    background-color: rgba(0, 0, 0, 0.03);
}

.dropdown-content {
    position: absolute;
    right: 0;
    top: 100%;
    margin-top: 5px;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    min-width: 200px;
    z-index: 10;
    display: none;
}

.dropdown-content.show {
    display: block;
}

.dropdown-item {
    padding: 8px 12px;
    transition: var(--transition);
}

.dropdown-item:hover {
    background-color: var(--light);
}

.filter-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.filter-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.filter-checkbox .checkmark {
    position: relative;
    height: 16px;
    width: 16px;
    background-color: var(--white);
    border: 2px solid rgba(0, 0, 0, 0.2);
    border-radius: 3px;
    margin-right: 10px;
    transition: var(--transition);
}

.filter-checkbox:hover input ~ .checkmark {
    border-color: var(--primary);
}

.filter-checkbox input:checked ~ .checkmark {
    background-color: var(--primary);
    border-color: var(--primary);
}

.filter-checkbox .checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.filter-checkbox input:checked ~ .checkmark:after {
    display: block;
}

.filter-checkbox .checkmark:after {
    left: 4px;
    top: 1px;
    width: 4px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.users-table-wrapper {
    overflow-x: auto;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
}

.users-table th {
    text-align: left;
    padding: 12px 16px;
    font-weight: 600;
    font-size: 13px;
    color: var(--secondary);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.users-table td {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    font-size: 13px;
}

.users-table tr:last-child td {
    border-bottom: none;
}

.users-table tr:hover {
    background-color: var(--primary-light);
}

.user-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: var(--primary);
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.user-name {
    font-weight: 500;
}

.user-roles {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.role-badge {
    background-color: var(--primary-light);
    color: var(--primary-dark);
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
}

.actions-cell {
    text-align: right;
}

.table-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
}

.btn-action {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    color: var(--white);
    text-decoration: none;
}

.btn-view {
    background-color: var(--info);
}

.btn-view:hover {
    background-color: #138496;
    transform: translateY(-1px);
}

.btn-edit {
    background-color: var(--primary);
}

.btn-edit:hover {
    background-color: var(--primary-dark);
    transform: translateY(-1px);
}

.btn-delete {
    background-color: var(--danger);
}

.btn-delete:hover {
    background-color: #c82333;
    transform: translateY(-1px);
}

.delete-form {
    margin: 0;
    padding: 0;
}

/* Estilos para el modal de confirmación */
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
    position: relative; /* Añadido para posicionamiento absoluto del icono */
}

.delete-icon i {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute; /* Posicionamiento absoluto para control preciso */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Centrado perfecto */
    width: 56px; /* Ancho fijo para el icono */
    height: 56px; /* Altura fija para el icono */
    line-height: 1; /* Asegura que la línea base no afecte el centrado */
    margin: 0; /* Elimina cualquier margen */
    padding: 0; /* Elimina cualquier padding */
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

@media (max-width: 768px) {
    .page-header {
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

    .page-content {
        padding: 14px;
    }

    .filters-section {
        flex-direction: column;
        align-items: flex-start;
    }

    .search-wrapper {
        width: 100%;
        max-width: none;
    }

    .filter-actions {
        width: 100%;
    }

    .dropdown-filter {
        width: 100%;
    }

    .btn-filter {
        width: 100%;
        justify-content: space-between;
    }

    .dropdown-content {
        width: 100%;
    }

    .users-table th:nth-child(3),
    .users-table td:nth-child(3) {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown para filtros
    const roleFilterBtn = document.getElementById('roleFilterBtn');
    const roleFilterDropdown = document.getElementById('roleFilterDropdown');

    roleFilterBtn.addEventListener('click', function() {
        roleFilterDropdown.classList.toggle('show');
    });

    // Cerrar dropdown al hacer clic fuera
    window.addEventListener('click', function(event) {
        if (!event.target.matches('.btn-filter') && !event.target.closest('.dropdown-content')) {
            roleFilterDropdown.classList.remove('show');
        }
    });

    // Filtrar por rol
    const allRolesCheckbox = roleFilterDropdown.querySelector('input[value="all"]');
    const roleCheckboxes = roleFilterDropdown.querySelectorAll('.role-filter');
    const userRows = document.querySelectorAll('.user-row');

    allRolesCheckbox.addEventListener('change', function() {
        if (this.checked) {
            roleCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            userRows.forEach(row => {
                row.style.display = '';
            });
        }
    });

    roleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            allRolesCheckbox.checked = false;

            const selectedRoles = Array.from(roleCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            if (selectedRoles.length === 0) {
                allRolesCheckbox.checked = true;
                userRows.forEach(row => {
                    row.style.display = '';
                });
            } else {
                userRows.forEach(row => {
                    const userRoles = row.getAttribute('data-roles').split(',');
                    const hasRole = selectedRoles.some(role => userRoles.includes(role));

                    if (hasRole) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    });

    // Búsqueda de usuarios
    const searchInput = document.getElementById('searchUsers');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        userRows.forEach(row => {
            const userName = row.getAttribute('data-name').toLowerCase();
            const userEmail = row.getAttribute('data-email').toLowerCase();

            if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Manejar confirmación de eliminación
    window.confirmDelete = function(userId, userName, userEmail) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.getElementById('deleteUserName').textContent = userName;
        document.getElementById('deleteUserEmail').textContent = userEmail;

        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.onclick = function() {
            document.getElementById(`delete-form-${userId}`).submit();
        };

        deleteModal.show();
    };
});
</script>
@endsection
