@extends('layouts.app')

@section('content')
<div class="user-form-container">
    <div class="form-header">
        <div class="header-content">
            <div class="title-section">
                <h2 class="form-title">Crear Nuevo Usuario</h2>
                <p class="form-subtitle">Crea un nuevo usuario y asigna roles</p>
            </div>
            <div class="actions-section">
                <a href="{{ route('users.index') }}" class="btn-secondary">
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

        <form action="{{ route('users.store') }}" method="POST" id="userForm">
            @csrf
            <div class="form-card">
                <div class="card-header">
                    <h3 class="card-title">Información del Usuario</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre completo" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="correo@ejemplo.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Contraseña <span class="required">*</span></label>
                            <div class="password-input">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                                <button type="button" class="toggle-password" tabindex="-1">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">La contraseña debe tener al menos 8 caracteres</small>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña <span class="required">*</span></label>
                            <div class="password-input">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
                                <button type="button" class="toggle-password" tabindex="-1">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="card-header">
                    <h3 class="card-title">Asignar Roles</h3>
                </div>
                <div class="card-body">
                    <div class="roles-grid">
                        @foreach($roles as $id => $name)
                        <div class="role-item">
                            <label class="role-checkbox">
                                <input type="checkbox" name="roles[]" value="{{ $id }}" {{ is_array(old('roles')) && in_array($id, old('roles')) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                <span class="role-name">{{ $name }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="window.location.href='{{ route('users.index') }}'">
                    <i class="bi bi-x"></i>
                    Cancelar
                </button>
                <button type="submit" class="btn-primary">
                    <i class="bi bi-check-lg"></i>
                    Guardar Usuario
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

.user-form-container {
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

.card-body {
    padding: 16px;
}

.form-group {
    margin-bottom: 16px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
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

.password-input {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--secondary);
    cursor: pointer;
    padding: 0;
    font-size: 14px;
}

.toggle-password:hover {
    color: var(--primary);
}

.roles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 12px;
}

.role-item {
    position: relative;
}

.role-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.role-checkbox:hover {
    background-color: var(--primary-light);
}

.role-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.role-checkbox .checkmark {
    position: relative;
    height: 16px;
    width: 16px;
    background-color: var(--white);
    border: 2px solid rgba(0, 0, 0, 0.2);
    border-radius: 3px;
    margin-right: 10px;
    transition: var(--transition);
}

.role-checkbox:hover input ~ .checkmark {
    border-color: var(--primary);
}

.role-checkbox input:checked ~ .checkmark {
    background-color: var(--primary);
    border-color: var(--primary);
}

.role-checkbox .checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.role-checkbox input:checked ~ .checkmark:after {
    display: block;
}

.role-checkbox .checkmark:after {
    left: 4px;
    top: 1px;
    width: 4px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.role-name {
    font-size: 14px;
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

    .roles-grid {
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
    // Mostrar/ocultar contraseña
    const toggleButtons = document.querySelectorAll('.toggle-password');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });

    // Validación del formulario
    const userForm = document.getElementById('userForm');

    userForm.addEventListener('submit', function(e) {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const roleCheckboxes = document.querySelectorAll('input[name="roles[]"]:checked');

        if (nameInput.value.trim() === '') {
            e.preventDefault();
            alert('Por favor, ingrese un nombre.');
            nameInput.focus();
            return;
        }

        if (emailInput.value.trim() === '') {
            e.preventDefault();
            alert('Por favor, ingrese un email.');
            emailInput.focus();
            return;
        }

        if (passwordInput.value.length < 8) {
            e.preventDefault();
            alert('La contraseña debe tener al menos 8 caracteres.');
            passwordInput.focus();
            return;
        }

        if (passwordInput.value !== confirmPasswordInput.value) {
            e.preventDefault();
            alert('Las contraseñas no coinciden.');
            confirmPasswordInput.focus();
            return;
        }

        if (roleCheckboxes.length === 0) {
            e.preventDefault();
            alert('Por favor, seleccione al menos un rol.');
            return;
        }
    });
});
</script>
@endsection
