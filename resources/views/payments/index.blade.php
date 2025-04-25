@extends('layouts.app')

@section('content')
    <h2 class="mt-4">Pagos</h2>


    <div class="main-container">
        <!-- Header con búsqueda y exportar -->
        <div class="header-table">
            <div class="search-container">
                <input type="text" class="form-control" placeholder="Buscar...">
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#filterModal">
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
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Fecha Vencimiento</th>
                        <th>Caja</th>
                        <th>Creado Por</th>
                        <th>Concepto</th>
                        <th>Capital</th>
                        <th>Interes</th>
                        <th>Mora</th>
                        <th>Descuento</th>
                        <th>Comision</th>
                        <th>Seguro</th>
                        <th>Otros</th>
                        <th>Total Pagado</th>
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
                        <td>Juan Pérez</td>
                        <td>15/03/2025</td>
                        <td>15/04/2025</td>
                        <td>Caja 1</td>
                        <td>Usuario 1</td>
                        <td>Pago cuota préstamo</td>
                        <td>$1,500.00</td>
                        <td>$100.00</td>
                        <td>$50.00</td>
                        <td>$30.00</td>
                        <td>$20.00</td>
                        <td>$10.00</td>
                        <td>$5.00</td>
                        <td>$1,715.00</td>
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
                        <td>María Gómez</td>
                        <td>18/03/2025</td>
                        <td>18/04/2025</td>
                        <td>Caja 2</td>
                        <td>Usuario 2</td>
                        <td>Abono parcial</td>
                        <td>$2,000.00</td>
                        <td>$80.00</td>
                        <td>$20.00</td>
                        <td>$50.00</td>
                        <td>$30.00</td>
                        <td>$15.00</td>
                        <td>$10.00</td>
                        <td>$2,205.00</td>
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
                        <td>Luis Martínez</td>
                        <td>20/03/2025</td>
                        <td>20/04/2025</td>
                        <td>Caja 3</td>
                        <td>Usuario 3</td>
                        <td>Pago completo</td>
                        <td>$3,000.00</td>
                        <td>$120.00</td>
                        <td>$60.00</td>
                        <td>$100.00</td>
                        <td>$40.00</td>
                        <td>$20.00</td>
                        <td>$15.00</td>
                        <td>$3,355.00</td>
                    </tr>
                </tbody>

            </table>

        </div>

        <!-- Estado vacío -->
        <div class="empty-state">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="No hay registros">
            <p>No tienes Registros!</p>
        </div>

        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="filterModalLabel">Filtrar</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fechaDesde" class="form-label text-muted">Fecha desde</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fechaDesde"
                                            placeholder="dd / mm / aaaa">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaHasta" class="form-label text-muted">Fecha hasta</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fechaHasta"
                                            placeholder="dd / mm / aaaa">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="creadoPor" class="form-label text-muted">Creado por</label>
                                    <select class="form-select" id="creadoPor">
                                        <option selected>Todo</option>
                                        <option>Usuario 1</option>
                                        <option>Usuario 2</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="agentes" class="form-label text-muted">Tipo de Pago</label>
                                    <select class="form-select" id="agentes">
                                        <option selected>Todo</option>
                                        <option>Pago Cuota</option>
                                        <option>Abonar al capital</option>
                                        <option>Ajuste Capital</option>
                                        <option>Pago Interes</option>
                                        <option>Saldar</option>
                                        <option>Pago borrador</option>
                                        <option>Pagar Inicial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="caja" class="form-label text-muted">Caja</label>
                                <select class="form-select" id="caja">
                                    <option selected>Todo</option>
                                    <option>Caja 1</option>
                                    <option>Caja 2</option>
                                    <option>Caja 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cartera" class="form-label text-muted">Forma de pago</label>
                                <select class="form-select" id="cartera">
                                    <option selected>Seleccione</option>
                                    <option>Efectivo</option>
                                    <option>Transferencia</option>
                                    <option>Deposito</option>
                                    <option>Tarjeta</option>
                                    <option>Permuta</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ruta" class="form-label text-muted">Rutas</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="ruta" class="form-label text-muted">Ver Anulado</label>
                                <input type="checkbox">
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
@endsection
