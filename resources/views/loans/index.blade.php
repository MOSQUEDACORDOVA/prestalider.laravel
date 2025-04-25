@extends('layouts.app')

@section('content')
    <style>
        .modal-footer-custom {
            display: flex;
            justify-content: space-between;
            padding: 15px 20px;
            border-top: 1px solid #dee2e6;
        }

        .btn-amortizacion {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;

        }

        .btn-cancelar {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #dc3545;
        }

        .btn-guardar {
            color: white;
        }

        .section-title {
            background-color: #f8f9fa;
            padding: 10px 15px;
            margin-bottom: 15px;
            font-weight: bold;
            color: #6c757d;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
    <h2 class="mt-4">Prestamos</h2>


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
                        <th>Clientes</th>
                        <th>Referencia</th>
                        <th>Balance Pendiente</th>
                        <th>Monto Cuota</th>
                        <th>Mora</th>
                        <th>Próximo Pago</th>
                        <th>Capital Pendiente</th>
                        <th>Gastos Legales</th>
                        <th>Amortización</th>
                        <th># Cuota</th>
                        <th>Capital Inicial</th>
                        <th>Total Pagado</th>
                        <th>Interés</th>
                        <th>Modalidad</th>
                        <th>Fecha Préstamo</th>
                        <th>Caja</th>
                        <th>Cartera</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="action-buttons">
                                <a href="prestamos-detalle" class="btn-action btn-view btn-primary text-decoration-none"
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
                        <td>REF001</td>
                        <td>$2,000.00</td>
                        <td>$200.00</td>
                        <td>$50.00</td>
                        <td>15/04/2025</td>
                        <td>$1,500.00</td>
                        <td>$100.00</td>
                        <td>$300.00</td>
                        <td>5</td>
                        <td>$5,000.00</td>
                        <td>$3,500.00</td>
                        <td>$400.00</td>
                        <td>Mensual</td>
                        <td>01/01/2024</td>
                        <td>Caja 1</td>
                        <td>Cartera A</td>
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
                        <td>REF002</td>
                        <td>$3,500.00</td>
                        <td>$350.00</td>
                        <td>$0.00</td>
                        <td>20/04/2025</td>
                        <td>$2,800.00</td>
                        <td>$50.00</td>
                        <td>$700.00</td>
                        <td>10</td>
                        <td>$6,000.00</td>
                        <td>$3,200.00</td>
                        <td>$500.00</td>
                        <td>Quincenal</td>
                        <td>10/02/2024</td>
                        <td>Caja 2</td>
                        <td>Cartera B</td>
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
                        <td>REF003</td>
                        <td>$1,000.00</td>
                        <td>$100.00</td>
                        <td>$10.00</td>
                        <td>25/04/2025</td>
                        <td>$800.00</td>
                        <td>$0.00</td>
                        <td>$200.00</td>
                        <td>2</td>
                        <td>$3,000.00</td>
                        <td>$2,000.00</td>
                        <td>$300.00</td>
                        <td>Semanal</td>
                        <td>15/03/2024</td>
                        <td>Caja 3</td>
                        <td>Cartera C</td>
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
                                    <label for="proximoPago" class="form-label text-muted">Próximo Pago</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="proximoPago"
                                            placeholder="dd / mm / aaaa">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="modalidad" class="form-label text-muted">Modalidad</label>
                                    <select class="form-select" id="modalidad">
                                        <option selected>Todo</option>
                                        <option>Mensual</option>
                                        <option>Quincenal</option>
                                        <option>Semanal</option>
                                    </select>
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
                                    <label for="agentes" class="form-label text-muted">Agentes</label>
                                    <select class="form-select" id="agentes">
                                        <option selected>Todo</option>
                                        <option>Agente 1</option>
                                        <option>Agente 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="estado" class="form-label text-muted">Estado</label>
                                <select class="form-select" id="estado">
                                    <option selected>Todo</option>
                                    <option>Activo</option>
                                    <option>Inactivo</option>
                                    <option>Pendiente</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ruta" class="form-label text-muted">Ruta</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="cartera" class="form-label text-muted">Cartera</label>
                                <select class="form-select" id="cartera">
                                    <option selected>Todo</option>
                                    <option>Cartera A</option>
                                    <option>Cartera B</option>
                                    <option>Cartera C</option>
                                </select>
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
        <div class="modal fade modal-prestamo" id="crearPrestamoModal" tabindex="-1"
            aria-labelledby="crearPrestamoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-link text-white me-2 p-0">
                                <i class="bi bi-arrow-left fs-4"></i>
                            </button>
                            <h5 class="modal-title text-white" id="crearPrestamoModalLabel"> Crear Préstamo</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form>
                            <!-- Cliente -->
                            <div class="mb-3">
                                <label for="cliente" class="form-label required">Cliente</label>
                                <select class="form-select" id="cliente" required>
                                    <option selected disabled value="">Seleccione</option>
                                    <option>Juan Pérez</option>
                                    <option>María Gómez</option>
                                    <option>Luis Martínez</option>
                                </select>
                            </div>

                            <!-- DATOS DEL PRÉSTAMO -->
                            <div class="section-title">DATOS DEL PRÉSTAMO</div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="amortizacion" class="form-label required">Amortización</label>
                                    <select class="form-select" id="amortizacion" required>
                                        <option>Seleccione</option>
                                        <option>Cuota Fija</option>
                                        <option>Disminuir Cuota</option>
                                        <option>Interes Fijo</option>
                                        <option>Capital Al Final</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="modalidad" class="form-label required">Modalidad</label>
                                    <select class="form-select" id="modalidad" required>
                                        <option selected disabled value="">Seleccione</option>
                                        <option>Diario</option>
                                        <option>Interdiario</option>
                                        <option>Semanal</option>
                                        <option>Bisemanal</option>
                                        <option>Quincenal</option>
                                        <option>15 y fin de mes</option>
                                        <option>Mensual</option>
                                        <option>Anual</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="montoPrestar" class="form-label required">Monto a prestar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">RD$</span>
                                        <input type="text" class="form-control" id="montoPrestar" value="0"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="numCuotas" class="form-label required"># Cuotas</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="numCuotas" required>
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="interes" class="form-label required">Interés</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="interes" required>
                                        <span class="input-group-text">%</span>
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="montoCuotas" class="form-label">Monto Cuotas</label>
                                    <div class="input-group">
                                        <span class="input-group-text">RD$</span>
                                        <input type="text" class="form-control" id="montoCuotas" value="0"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="fecha" class="form-label required">Fecha</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fecha"
                                            placeholder="27/02/2025" required>
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="fechaPrimerPago" class="form-label required">Fecha Primer pago</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fechaPrimerPago"
                                            placeholder="dd/mm/aaaa" required>
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- OTROS -->
                            <div class="section-title">OTROS</div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="caja" class="form-label">Caja</label>
                                    <select class="form-select" id="caja">
                                        <option>Ninguna</option>
                                        <option>Caja 1</option>
                                        <option>Caja 2</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="codigoReferencia" class="form-label">Código Referencia</label>
                                    <input type="text" class="form-control" id="codigoReferencia">
                                </div>
                                <div class="col-md-3">
                                    <label for="gastosLegales" class="form-label">Gastos legales</label>
                                    <div class="input-group">
                                        <span class="input-group-text">RD$</span>
                                        <input type="text" class="form-control" id="gastosLegales" value="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="mora" class="form-label">Mora</label>
                                    <div class="input-group">
                                        <span class="input-group-text">%</span>
                                        <input type="text" class="form-control" id="mora" value="3">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="comision" class="form-label">Comisión</label>
                                    <div class="input-group">
                                        <span class="input-group-text">%</span>
                                        <input type="text" class="form-control" id="comision">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cartera" class="form-label">Cartera</label>
                                    <select class="form-select" id="cartera">
                                        <option selected disabled value="">Seleccione</option>
                                        <option>Cartera A</option>
                                        <option>Cartera B</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="montoSeguro" class="form-label">Monto Seguro</label>
                                    <div class="input-group">
                                        <span class="input-group-text">RD$</span>
                                        <input type="text" class="form-control" id="montoSeguro" value="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="inicial" class="form-label">Inicial</label>
                                    <div class="input-group">
                                        <span class="input-group-text">RD$</span>
                                        <input type="text" class="form-control" id="inicial" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="garantia" class="form-label required">GARANTÍA</label>
                                    <input type="text" class="form-control" id="garantia" required>
                                </div>
                            </div>

                            <!-- CO-DEUDOR -->
                            <div class="section-title">CO-DEUDOR</div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="nombres" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="nombres">
                                </div>
                                <div class="col-md-3">
                                    <label for="identificacion" class="form-label">No. Identificación</label>
                                    <input type="text" class="form-control" id="identificacion">
                                </div>
                                <div class="col-md-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="https://flagcdn.com/w20/do.png" alt="DO" width="20"
                                                height="15">
                                            +1
                                        </span>
                                        <input type="text" class="form-control" id="telefono">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer-custom">
                        <button type="button" class="btn btn-amortizacion btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#calculadoraModal">
                            <i class="hgi hgi-stroke hgi-calculator-01 fs-6"></i> AMORTIZACIÓN
                        </button>
                        <div>
                            <button type="button" class="btn btn-cancelar btn-outline-primary" data-bs-dismiss="modal">
                                <i class="hgi hgi-stroke hgi-x-variable-circle fs-6"></i> CANCELAR
                            </button>
                            <button type="button" class="btn btn-guardar btn-primary">
                                <i class="hgi hgi-stroke hgi-floppy-disk fs-6"></i> GUARDAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-calculadora modal-nested" id="calculadoraModal" tabindex="-1"
            aria-labelledby="calculadoraModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white" id="calculadoraModalLabel">Calculadora</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="montoCalculadora" class="form-label">Monto del Préstamo *</label>
                                <input type="text" class="form-control" id="montoCalculadora" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tipoAmortizacion" class="form-label">Tipo de Amortización *</label>
                                    <select class="form-select" id="tipoAmortizacion" required>
                                        <option>Cuota Fija</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="modalidadPago" class="form-label">Modalidad de Pago *</label>
                                    <select class="form-select" id="modalidadPago" required>
                                        <option selected disabled value="">Seleccione</option>
                                        <option>Mensual</option>
                                        <option>Quincenal</option>
                                        <option>Semanal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="numCuotasCalculadora" class="form-label"># Cuotas *</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="numCuotasCalculadora" required>
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="interesCalculadora" class="form-label">Interés fijo *</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="interesCalculadora" required>
                                        <span class="input-group-text">%</span>
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mostrar-mas">
                                <span>Mostrar Más...</span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" id="btnUsarValores">USAR VALORES</button>
                        <button type="button" class="btn btn-primary">CALCULAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón flotante para agregar -->
    <a class="btn btn-primary btn-floating" data-bs-toggle="modal" data-bs-target="#crearPrestamoModal">
        <i class="hgi hgi-stroke hgi-plus-sign-circle fs-3"></i>
    </a>
@endsection
