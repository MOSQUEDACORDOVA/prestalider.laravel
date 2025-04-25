@extends('layouts.app')

@section('content')
    <h2 class="mt-4">Otros Ingresos</h2>


    <div class="main-container">
        <!-- Header con búsqueda y exportar -->
        <div class="header-table">
            <div class="search-container">
                <input type="text" class="form-control" placeholder="Buscar...">
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-primary ms-2">
                    <i class="bi bi-funnel"></i> Filtrar
                </button>
                <button class="btn btn-primary">EXPORTAR</button>
            </div>
        </div>

        <!-- Tabla de registros -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Acciones</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Concepto</th>
                        <th>Categoria</th>
                        <th>Cajas</th>
                        <th>Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="action-buttons">
                                <a href="/detail-loan-page" class="btn-action btn-view btn-primary text-decoration-none"
                                    title="Ver detalles">
                                    <i class="hgi hgi-stroke hgi-eye fs-5"></i>
                                </a>
                                <button class="btn-action btn-edit" title="Editar registro">
                                    <i class="hgi hgi-stroke hgi-pencil-edit-02 fs-5"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Eliminar registro">
                                    <i class="hgi hgi-stroke hgi-delete-02 fs-5"></i>
                                </button>
                            </div>
                        </td>
                        <td>15/03/2025</td>
                        <td>$1,500.00</td>
                        <td>Pago cuota préstamo</td>
                        <td>Categoría 1</td>
                        <td>Caja 1</td>
                        <td>Comentario adicional</td>
                    </tr>
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
                        <td>18/03/2025</td>
                        <td>$2,000.00</td>
                        <td>Abono parcial</td>
                        <td>Categoría 2</td>
                        <td>Caja 2</td>
                        <td>Comentario adicional</td>
                    </tr>
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
                        <td>20/03/2025</td>
                        <td>$3,000.00</td>
                        <td>Pago completo</td>
                        <td>Categoría 3</td>
                        <td>Caja 3</td>
                        <td>Comentario adicional</td>
                    </tr>
                </tbody>


            </table>

        </div>

        <!-- Estado vacío -->
        <div class="empty-state">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="No hay registros">
            <p>No tienes Registros!</p>
        </div>

        <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="filterModalLabel">Agregar Gasto</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fechaDesde" class="form-label text-muted">Fecha *</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fechaDesde"
                                            placeholder="dd / mm / aaaa">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="creadoPor" class="form-label text-muted">Categoria</label>
                                    <select class="form-select" id="creadoPor">
                                        <option selected>Todo</option>
                                        <option>Usuario 1</option>
                                        <option>Usuario 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="ruta" class="form-label text-muted">Concepto *</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fechaDesde" class="form-label text-muted">Monto *</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fechaDesde">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="creadoPor" class="form-label text-muted">Caja</label>
                                    <select class="form-select" id="creadoPor">
                                        <option selected>Ninguna</option>
                                        <option>Usuario 1</option>
                                        <option>Usuario 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ruta" class="form-label text-muted">Comentario</label>
                                <textarea name="" class="form-control" id=""></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn hiper-vinculo border-0"
                            id="resetFiltersBtn">Restablecer</button>
                        <button type="button" class="btn btn-primary text-white" id="applyFiltersBtn">FILTRAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a data-bs-toggle="modal" data-bs-target="#crearModal" class="btn btn-primary btn-floating">
        <i class="hgi hgi-stroke hgi-plus-sign-circle fs-3"></i>
    </a>
@endsection
