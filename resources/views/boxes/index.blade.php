@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <!-- Vista principal -->
        <div id="main-view">
            <h2 class="mt-4">Cajas</h2>

            <div class="main-container">
                <!-- Header con búsqueda y exportar -->
                <div class="header-table">
                    <div class="search-container">
                        <input type="text" class="form-control" placeholder="Buscar...">
                    </div>

                </div>

                <!-- Tabla de registros -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Acciones</th>
                                <th>Descripcion</th>
                                <th>Balance Inicial</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="clickable-row" data-client="Briam Valerio">
                                <td>
                                    <div class="action-buttons">
                                        <a href="/detail-loan-page"
                                            class="btn-action btn-view btn-primary text-decoration-none"
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
                                <td>Pago préstamo</td>
                                <td>$500,000</td>
                            </tr>
                            <tr class="clickable-row" data-client="Briam Valerio">
                                <td>
                                    <div class="action-buttons">
                                        <a href="/detail-loan-page"
                                            class="btn-action btn-view btn-primary text-decoration-none"
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
                                <td>Pago préstamo</td>
                                <td>$500,000</td>
                            </tr>
                            <tr class="clickable-row" data-client="Briam Valerio">
                                <td>
                                    <div class="action-buttons">
                                        <a href="/detail-loan-page"
                                            class="btn-action btn-view btn-primary text-decoration-none"
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
                                <td>Pago préstamo</td>
                                <td>$500,000</td>
                            </tr>
                            <tr class="clickable-row" data-client="Briam Valerio">
                                <td>
                                    <div class="action-buttons">
                                        <a href="/detail-loan-page"
                                            class="btn-action btn-view btn-primary text-decoration-none"
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
                                <td>Pago préstamo</td>
                                <td>$500,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Estado vacío (oculto por defecto) -->
                <div class="empty-state" style="display: none;">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="No hay registros">
                    <p>No tienes Registros!</p>
                </div>

                <!-- Modal de filtros -->
                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="filterModalLabel">Agregar Caja</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="ruta" class="form-label text-muted">Descripcion *</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ruta" class="form-label text-muted">Balance Inicial *</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn hiper-vinculo border-0"
                                    id="resetFiltersBtn">Restablecer</button>
                                <button type="button" class="btn btn-primary text-white"
                                    id="applyFiltersBtn">FILTRAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vista detallada (oculta por defecto) -->
        <div id="detail-view" style="display: none;">
            <div class="d-flex align-items-center mb-3">
                <button id="back-button" class="btn btn-sm btn-primary me-2">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <h4 id="client-name" class="mb-0">Briam Valerio</h4>
                <div class="ms-auto">
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-printer"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-success ms-2">
                        <i class="bi bi-whatsapp"></i>
                    </button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Capital prestado</h6>
                            <h5 class="text-primary">RD$340,577.49</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Capital recaudado</h6>
                            <h5 class="text-primary">RD$143,122.24</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Interés recaudado</h6>
                            <h5 class="text-primary">RD$83,748.04</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Mora recaudada</h6>
                            <h5 class="text-primary">RD$253.29</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Cliente</th>
                            <th>Balance Pendiente</th>
                            <th>Monto Cuota</th>
                            <th>Mora</th>
                            <th>Próximo Pago</th>
                            <th>Capital Pendiente</th>
                            <th>Gastos legales</th>
                            <th>Amortización</th>
                            <th># Cuota</th>
                            <th>Capital Inicial</th>
                            <th>Total pagado</th>
                            <th>Interés</th>
                            <th>Modalidad</th>
                            <th>Código Referencia</th>
                            <th>Fecha Préstamo</th>
                            <th>Caja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="window.location.href='detail-loan-page?cliente=BriamValerio'"
                            style="cursor:pointer;">
                            <td>HELITON ALFREDO ROSARIO VÁSQUEZ <br><small class="text-muted">Cliente Vencido: 8</small>
                            </td>
                            <td>RD$12,000</td>
                            <td>RD$1,800</td>
                            <td>RD$0</td>
                            <td>Sa 04/01/2028</td>
                            <td>RD$28,000.9</td>
                            <td>RD$0</td>
                            <td>Interés Fijo</td>
                            <td>1.0</td>
                            <td>RD$15,001</td>
                            <td>RD$1,801</td>
                            <td>4.555%</td>
                            <td>Semanal</td>
                            <td>0010001</td>
                            <td>28/12/2024</td>
                            <td>CAJA CENTRAL TIENDA</td>
                        </tr>
                        <tr>
                            <td>CARLOS EDGAR MATAS <br><small class="text-muted">Cliente Vencido: 6</small></td>
                            <td>RD$28,000</td>
                            <td>RD$5,500</td>
                            <td>RD$0</td>
                            <td>Sa 18/01/2028</td>
                            <td>RD$24,000</td>
                            <td>RD$0</td>
                            <td>Interés Fijo</td>
                            <td>1.0</td>
                            <td>RD$32,000</td>
                            <td>RD$24,000</td>
                            <td>8%</td>
                            <td>Quincenal</td>
                            <td>0010001</td>
                            <td>28/09/2024</td>
                            <td>CUENTA CORRIENTE EMPRESARIAL</td>
                        </tr>
                        <tr>
                            <td>TOMAS MIGUEL HIDALGO <br><small class="text-muted">Particular</small></td>
                            <td>RD$38,000</td>
                            <td>RD$6,500</td>
                            <td>RD$0</td>
                            <td>Th 20/02/2028</td>
                            <td>RD$38,000</td>
                            <td>RD$0</td>
                            <td>Cuota Fija</td>
                            <td>1</td>
                            <td>RD$38,000</td>
                            <td>RD$38,000</td>
                            <td>20%</td>
                            <td>Mensual</td>
                            <td>0010001</td>
                            <td>20/09/2024</td>
                            <td>CUENTA CORRIENTE EMPRESARIAL</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="empty-state">
        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="No hay registros">
        <p>No tienes Cajas!</p>
        <p><strong>Las cajas te permiten tener un control de flujo de dinero. <br> Cada vez que se realice una operacion se
                registrar un movimiento de caja indicando que salio o entro dinero a caja.</strong></p>
    </div>
    <a data-bs-toggle="modal" data-bs-target="#filterModal" class="btn btn-primary btn-floating">
        <i class="hgi hgi-stroke hgi-plus-sign-circle fs-3"></i>
    </a>
@endsection
