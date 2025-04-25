@extends('layouts.app')

@section('content')
    <h2 class="mt-4">Todas Las Notificaciones</h2>


    <div class="main-container">

        <!-- Tabla de registros -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Acciones</th>
                        <td>Fecha</td>
                        <td>Notificacion</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view btn-primary" title="Ver detalles">
                                    <i class="hgi hgi-stroke hgi-eye fs-5"></i>
                                </button>

                            </div>
                        </td>
                        <td>15/03/2023 07:01 pm</td>
                        <td><strong>Nueva Solicitud</strong><br>Juan Pérez González</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view btn-primary" title="Ver detalles">
                                    <i class="hgi hgi-stroke hgi-eye fs-5"></i>
                                </button>

                            </div>
                        </td>
                        <td>15/03/2023 07:01 pm</td>
                        <td><strong>Nueva Solicitud</strong><br>Juan Pérez González</td>
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
    <a href="#" class="btn btn-primary btn-floating">
        <i class="hgi hgi-stroke hgi-plus-sign-circle fs-3"></i>
    </a>
@endsection
