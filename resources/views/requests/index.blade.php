@extends('layouts.app')

@section('content')
    <h2 class="mt-4">Todas las Solicitudes</h2>


    <div class="main-container">
        <!-- Header con búsqueda y exportar -->
        <div class="header-table">
            <div class="search-container">
                <input type="text" class="form-control" placeholder="Buscar...">
            </div>
            <div class="header-actions">
                <span class="pending-badge">Pendiente</span>
                <button class="btn btn-primary">EXPORTAR</button>
            </div>
        </div>

        <!-- Tabla de registros -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Acciones</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Solicitante</th>
                        <th>Monto</th>
                        <th>Cuotas</th>
                        <th>Modalidad</th>
                        <th>No. Identificación</th>
                        <th>Teléfono</th>
                        <th>Rechazada</th>
                        <th>Agentes</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view btn-primary" title="Ver detalles">
                                    <i class="hgi hgi-stroke hgi-eye fs-5"></i>
                                </button>
                                <button class="btn-action btn-edit" title="Editar registro">
                                    <i class="hgi hgi-stroke hgi-pencil-edit-02 fs-5"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Eliminar registro">
                                    <i class="hgi hgi-stroke hgi-delete-02 fs-5"></i>
                                </button>
                            </div>
                        </td>
                        <td><span class="status-badge status-pending">Pendiente</span></td>
                        <td>15/03/2023</td>
                        <td>Juan Pérez González</td>
                        <td>$5,000.00</td>
                        <td>12</td>
                        <td>Mensual</td>
                        <td>123456789</td>
                        <td>+1 234 567 8901</td>
                        <td>No</td>
                        <td>Carlos Rodríguez</td>

                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Estado vacío -->
        <div class="empty-state">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="No hay registros">
            <p>No tienes Registros!</p>
        </div>
    </div>

    <!-- Botón flotante para agregar -->
    <a class="btn btn-primary btn-floating" href="solicitudes-formulario">
        <i class="hgi hgi-stroke hgi-link-05 fs-3"></i>
    </a>
@endsection
