@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <!-- Vista principal -->
    <div id="main-view">
        <h2 class="mt-4">Cartera</h2>

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
                </div>
            </div>

            <!-- Tabla de registros -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Descripcion</th>
                            <th>Capital</th>
                            <th>Prestamos</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="clickable-row" style="cursor:pointer;" data-client="Briam Valerio">
                            <td>Compra de insumos</td>
                            <td>$1,500,000</td>
                            <td>$500,000</td>
                            <td>2025-04-01</td>
                        </tr>
                        <tr class="clickable-row" style="cursor:pointer;" data-client="Carlos Edgar Matas">
                            <td>Pago de nómina</td>
                            <td>$2,000,000</td>
                            <td>$0</td>
                            <td>2025-04-02</td>
                        </tr>
                        <tr class="clickable-row" style="cursor:pointer;" data-client="Tomas Miguel Hidalgo">
                            <td>Inversión maquinaria</td>
                            <td>$3,500,000</td>
                            <td>$1,000,000</td>
                            <td>2025-04-03</td>
                        </tr>
                        <tr class="clickable-row" style="cursor:pointer;" data-client="Luis Alberto Mendez Mota">
                            <td>Mantenimiento oficina</td>
                            <td>$750,000</td>
                            <td>$250,000</td>
                            <td>2025-04-04</td>
                        </tr>
                        <tr class="clickable-row" style="cursor:pointer;" data-client="Rafael Mateo Mendez">
                            <td>Publicidad online</td>
                            <td>$1,200,000</td>
                            <td>$0</td>
                            <td>2025-04-05</td>
                        </tr>
                        <tr class="clickable-row" style="cursor:pointer;" data-client="Jesus Alberto Hernandez Rosado">
                            <td>Consultoría externa</td>
                            <td>$900,000</td>
                            <td>$100,000</td>
                            <td>2025-04-06</td>
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
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title" id="filterModalLabel">Filtrar</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="fechaDesde" class="form-label text-muted">Fecha desde</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="fechaDesde" placeholder="dd / mm / aaaa">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fechaHasta" class="form-label text-muted">Fecha hasta</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="fechaHasta" placeholder="dd / mm / aaaa">
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
                                    <label for="verAnulado" class="form-label text-muted">Ver Anulado</label>
                                    <input type="checkbox" id="verAnulado">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn hiper-vinculo border-0" id="resetFiltersBtn">Restablecer</button>
                            <button type="button" class="btn btn-primary text-white" id="applyFiltersBtn">FILTRAR</button>
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
                    <tr onclick="window.location.href='detail-loan-page?cliente=BriamValerio'" style="cursor:pointer;">
                        <td>HELITON ALFREDO ROSARIO VÁSQUEZ <br><small class="text-muted">Cliente Vencido: 8</small></td>
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
@endsection
