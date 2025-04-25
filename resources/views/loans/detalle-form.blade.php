@extends('layouts.app')

@section('content')
    <style>
        .recibo-pago {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 0 auto;
            padding: 15px;
        }

        .recibo-item {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .firma-container {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .firma-linea {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto;
        }

        .firma-texto {
            font-size: 12px;
            margin-top: 5px;
        }

        .qr-code {
            max-width: 100px;
            margin: 0 auto;
        }

        /* Botones para el recibo */
        #btnImprimirRecibo,
        #btnWhatsAppRecibo {
            min-width: 120px;
        }

        #btnWhatsAppRecibo {
            background-color: #25d366;
            border-color: #25d366;
        }

        #btnWhatsAppRecibo:hover {
            background-color: #128c7e;
            border-color: #128c7e;
        }
    </style>
    <!-- Cabecera con botón de regreso -->
    <header class="bg-primary text-white p-2 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="prestamos.html" class="text-white me-2 text-decoration-none">
                <i class="hgi hgi-stroke hgi-arrow-left-01 fs-3"></i>
            </a>
            <span>Detalles</span>
        </div>
        <div>
            <a href="#" class="text-white me-2 text-decoration-none">
                <i class="hgi hgi-stroke hgi-printer fs-3"></i>
            </a>
            <a data-bs-toggle="modal" data-bs-target="#enviarMensajeModal" class="text-white text-decoration-none">
                <i class="hgi hgi-stroke hgi-whatsapp fs-3"></i>
            </a>
        </div>
    </header>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Información del cliente -->
            <div class="col-md-3 border-end">
                <div class="text-center p-3">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle" width="80"
                        height="80" alt="Foto de perfil">
                    <h5 class="mt-2">MARIA DEL CARMEN CRUZ</h5>
                    <div class="d-flex justify-content-center">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star text-warning"></i>
                        <i class="bi bi-star text-warning"></i>
                    </div>
                    <div class="bg-light p-2 mt-3">
                        <p class="mb-0">Cuotas Vencidas: 0</p>
                    </div>
                </div>
            </div>

            <!-- Detalles del préstamo -->
            <div class="col-md-9">
                <div class="bg-light p-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Capital actual:</span>
                                <span class="fw-bold">RD$5,000</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Próximo Pago:</span>
                                <span>15/06/2023</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Balance pendiente:</span>
                                <span class="text-danger fw-bold">RD$700</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Comisión:</span>
                                <span>No</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Cuotas:</span>
                                <span>4/4</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Interés:</span>
                                <span>30%</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Modalidad:</span>
                                <span>Mensual</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Gastos legales:</span>
                                <span>0</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Amortización:</span>
                                <span>-</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Capital al Final:</span>
                                <span>RD$5,000</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Capital inicial:</span>
                                <span>RD$5,000</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Mora:</span>
                                <span>5%</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Atraso:</span>
                                <span class="text-danger">20 cuotas y 23 días</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex flex-wrap gap-1 p-2 bg-light-subtle border-top border-bottom">
                    <button class="btn btn-primary text-white btn-sm" data-bs-toggle="modal"
                        data-bs-target="#agregarPagoModal">AGREGAR PAGO</button>
                    <button class="btn btn-outline-primary btn-sm">EDITAR</button>
                    <button class="btn btn-outline-primary btn-sm">AJUSTAR CAPITAL</button>
                    <button class="btn btn-outline-primary btn-sm">RECALCULAR MORA</button>
                    <button class="btn btn-outline-primary btn-sm">REFINANCIAR</button>
                    <button class="btn btn-outline-primary btn-sm">INCOBRABLE</button>
                    <button class="btn btn-outline-primary btn-sm">IMPRIMIR</button>
                    <button class="btn btn-outline-primary btn-sm">CONTACTAR</button>
                </div>
            </div>
        </div>

        <!-- Pestañas -->
        <div class="container-fluid p-0">
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active text-primary" id="pagos-tab" data-bs-toggle="tab" data-bs-target="#pagos"
                        type="button" role="tab" aria-controls="pagos" aria-selected="true">Pagos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-primary" id="amortizacion-tab" data-bs-toggle="tab"
                        data-bs-target="#amortizacion" type="button" role="tab" aria-controls="amortizacion"
                        aria-selected="false">Amortización</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-primary" id="notas-tab" data-bs-toggle="tab" data-bs-target="#notas"
                        type="button" role="tab" aria-controls="notas" aria-selected="false">Notas (2)</button>
                </li>
                <li class="ms-auto">
                    <span class="text-muted me-3">
                        <i class="bi bi-check-circle"></i> Anulado
                    </span>
                </li>
            </ul>

            <!-- Contenido de las pestañas -->
            <div class="tab-content" id="myTabContent">
                <!-- Pestaña de Pagos -->
                <div class="tab-pane fade show active" id="pagos" role="tabpanel" aria-labelledby="pagos-tab">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Concepto</th>
                                    <th>Fecha</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Total pagado</th>
                                    <th>Capital</th>
                                    <th>Interés</th>
                                    <th>Mora</th>
                                    <th>Descuento</th>
                                    <th>Comisión</th>
                                    <th>Otros</th>
                                    <th>Capital Pendiente</th>
                                    <th>Caja</th>
                                    <th>Creado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PAGO CUOTA 4/4</td>
                                    <td>22/05/2023</td>
                                    <td>15/05/2023</td>
                                    <td>RD$500</td>
                                    <td>RD$0</td>
                                    <td>RD$500</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$5,000</td>
                                    <td>CAJA CENTRAL TIENDA</td>
                                    <td>Jhoan Alberto Delgado Mejía</td>
                                </tr>
                                <tr>
                                    <td>PAGO CUOTA 3/4</td>
                                    <td>24/04/2023</td>
                                    <td>15/04/2023</td>
                                    <td>RD$1,000</td>
                                    <td>RD$0</td>
                                    <td>RD$1,000</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$5,000</td>
                                    <td>CAJA CENTRAL TIENDA</td>
                                    <td>Jhoan Alberto Delgado Mejía</td>
                                </tr>
                                <tr>
                                    <td>CIERRE CUOTA 2/4</td>
                                    <td>23/03/2023</td>
                                    <td>15/03/2023</td>
                                    <td>RD$500</td>
                                    <td>RD$0</td>
                                    <td>RD$500</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$5,000</td>
                                    <td>CAJA CENTRAL TIENDA</td>
                                    <td>Jhoan Alberto Delgado Mejía</td>
                                </tr>
                                <tr>
                                    <td>CIERRE CUOTA 1/4</td>
                                    <td>09/03/2023</td>
                                    <td>15/02/2023</td>
                                    <td>RD$500</td>
                                    <td>RD$0</td>
                                    <td>RD$500</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$5,000</td>
                                    <td>CAJA CENTRAL TIENDA</td>
                                    <td>Jhoan Alberto Delgado Mejía</td>
                                </tr>
                                <tr class="table-info">
                                    <td>REENGANCHE</td>
                                    <td>10/02/2023</td>
                                    <td>01/01/2000</td>
                                    <td>RD$4,000</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>RD$5,000</td>
                                    <td>CUENTA CORRIENTE BANRESERVAS</td>
                                    <td>Jhoan Alberto Delgado Mejía</td>
                                </tr>
                                <tr class="table-secondary">
                                    <td colspan="3" class="text-end fw-bold">Total:</td>
                                    <td>RD$2,500</td>
                                    <td>RD$0</td>
                                    <td>RD$2,500</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pestaña de Amortización -->
                <div class="tab-pane fade" id="amortizacion" role="tabpanel" aria-labelledby="amortizacion-tab">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No - Fecha</th>
                                    <th>Cuota</th>
                                    <th>Interés</th>
                                    <th>Capital</th>
                                    <th>Seguro</th>
                                    <th>Capital Restante</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 - 15/04/2023</td>
                                    <td>RD$2,200</td>
                                    <td>RD$200</td>
                                    <td>RD$2,000</td>
                                    <td>RD$0</td>
                                    <td>RD$0</td>
                                </tr>
                                <tr class="table-secondary">
                                    <td colspan="1" class="text-end fw-bold">Total:</td>
                                    <td>RD$2,200</td>
                                    <td>RD$200</td>
                                    <td>RD$2,000</td>
                                    <td>RD$0</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pestaña de Notas -->
                <div class="tab-pane fade" id="notas" role="tabpanel" aria-labelledby="notas-tab">

                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th></th>
                                    <th>Fecha</th>
                                    <th>Fecha Recordatorio</th>
                                    <th>Comentario</th>
                                    <th>Creado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </td>
                                    <td>05/11/2024 4:25 pm</td>
                                    <td>05/12/2024</td>
                                    <td>cliente debe ser visitada en diciembre 5</td>
                                    <td>Jhoan Alberto Delgado Mejía</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Agregar Pago -->
    <div class="modal fade" id="agregarPagoModal" tabindex="-1" aria-labelledby="agregarPagoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="agregarPagoModalLabel">Agregar Pago</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- Selector de tipo de pago -->
                    <div class="dropdown-pago">
                        <button class="btn btn-light dropdown-toggle w-100 text-center border-0 rounded-0 py-3"
                            type="button" id="tipoPagoDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            CUOTA COMPLETA
                        </button>
                        <ul class="dropdown-menu w-100 rounded-0" aria-labelledby="tipoPagoDropdown"
                            id="tipoPagoOptions">
                            <li>
                                <a class="dropdown-item" href="#" data-value="cuota-completa">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="cuotaCompletaCheck" checked>
                                        <label class="form-check-label" for="cuotaCompletaCheck">
                                            Cuota Completa
                                        </label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-value="abonar-capital">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="abonarCapitalCheck">
                                        <label class="form-check-label" for="abonarCapitalCheck">
                                            Abonar al capital
                                        </label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-value="solo-interes">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="soloInteresCheck">
                                        <label class="form-check-label" for="soloInteresCheck">
                                            Solo interés
                                        </label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-value="saldar">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="saldarCheck">
                                        <label class="form-check-label" for="saldarCheck">
                                            Saldar
                                        </label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-value="pagar-inicial">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="pagarInicialCheck">
                                        <label class="form-check-label" for="pagarInicialCheck">
                                            Pagar Inicial
                                        </label>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="p-3">
                        <!-- Selector de cuota y fecha -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <select class="form-select">
                                    <option>1 Cuota (Pendiente)</option>
                                    <option>2 Cuota (Pendiente)</option>
                                    <option>3 Cuota (Pendiente)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="27/02/2025"
                                        aria-label="Fecha">
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Detalles del pago -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="text-muted small">Mora:</label>
                                    <div class="text-danger">RD$924</div>
                                </div>
                                <div class="mb-2">
                                    <label class="text-muted small">Cuota:</label>
                                    <div>RD$2,200</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="text-muted small">Pendiente:</label>
                                    <div>RD$0</div>
                                </div>
                                <div class="mb-2">
                                    <label class="text-muted small">Interés:</label>
                                    <div>RD$160</div>
                                </div>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="bg-light p-3 text-end mb-3">
                            <span class="text-info fw-bold">RD$3,124</span>
                        </div>

                        <!-- Descuento y Otros -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Descuento</label>
                                <input type="text" class="form-control" placeholder="RD$0">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Otros</label>
                                <input type="text" class="form-control" placeholder="RD$0">
                            </div>
                        </div>

                        <!-- Forma de pago -->
                        <div class="mb-3">
                            <label class="form-label">Forma de pago *</label>
                            <select class="form-select">
                                <option>Efectivo</option>
                                <option>Transferencia</option>
                                <option>Tarjeta</option>
                            </select>
                        </div>

                        <!-- Total a Pagar -->
                        <div class="text-end mb-3">
                            <span class="text-muted">Total a Pagar: </span>
                            <span class="text-info fw-bold">RD$3,124</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                        <i class="hgi hgi-stroke hgi-x-variable-circle fs-6"></i> CANCELAR
                    </button>
                    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                        data-bs-target="#reciboModal">
                        <i class="hgi hgi-stroke hgi-floppy-disk fs-6"></i> AGREGAR PAGO
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reciboModal" tabindex="-1" aria-labelledby="reciboModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="reciboModalLabel">Recibo de Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="recibo-content" class="recibo-pago">
                        <!-- Logo -->
                        <div class="text-center mb-3">
                            <img src="./../../../favicon.png" width="50" alt="Logo" class="img-fluid">
                        </div>

                        <!-- Título -->
                        <h4 class="text-center text-info mb-4">RECIBO DE PAGO</h4>

                        <!-- Detalles del recibo -->
                        <div class="row mb-2">
                            <div class="col-6">
                                <strong>Recibo No.</strong> 247533
                            </div>
                            <div class="col-6 text-end">
                                <strong>Fecha:</strong> 24/02/2025 06:38 pm
                            </div>
                        </div>

                        <div class="recibo-item">
                            <strong>RECIBIDO DE:</strong> RAHAM RAFAEL REYES LOPEZ
                        </div>

                        <div class="recibo-item">
                            <strong>MONTO TOTAL:</strong> $10.76
                        </div>

                        <div class="recibo-item">
                            <strong>CONCEPTO:</strong> PAGO CUOTA 4/8
                        </div>

                        <div class="recibo-item">
                            <strong>FORMA DE PAGO:</strong> Efectivo
                        </div>

                        <div class="recibo-item">
                            <strong>CAPITAL:</strong> $608.02
                        </div>

                        <div class="recibo-item">
                            <strong>INTERÉS:</strong> $202.74
                        </div>

                        <div class="recibo-item">
                            <strong>DESCUENTO:</strong> $0
                        </div>

                        <div class="recibo-item text-danger">
                            <strong>MORA:</strong> $0
                        </div>

                        <div class="recibo-item">
                            <strong>CAPITAL PENDIENTE:</strong> $8,419.36
                        </div>

                        <div class="recibo-item">
                            <strong>PRÓXIMO PAGO:</strong> 25/03/2025
                        </div>

                        <!-- QR Code -->
                        <div class="text-center my-3">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=Recibo247533"
                                alt="QR Code" class="img-fluid qr-code">
                        </div>

                        <!-- Firma -->
                        <div class="firma-container text-center">
                            <div class="firma-linea"></div>
                            <div class="firma-texto">FIRMA</div>
                        </div>

                        <!-- Mensaje final -->
                        <div class="text-center mt-3">
                            <p>Gracias por tu pago!!</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" id="btnImprimirRecibo">
                        <i class="hgi hgi-stroke hgi-printer fs-6"></i> Imprimir
                    </button>
                    <button type="button" class="btn btn-success" id="btnWhatsAppRecibo">
                        <i class="hgi hgi-stroke hgi-whatsapp fs-6"></i> WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="enviarMensajeModal" tabindex="-1" aria-labelledby="enviarMensajeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="enviarMensajeModalLabel">Enviar Mensaje</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Opciones de mensaje -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="whatsappCheck" checked>
                            <label class="form-check-label" for="whatsappCheck">
                                WhatsApp
                            </label>
                        </div>
                    </div>

                    <!-- Plantillas -->
                    <div class="mb-3">
                        <label class="form-label">Plantillas</label>
                        <select class="form-select" id="plantillaSelect">
                            <option selected>CARTA SALDO</option>
                            <option>RECORDATORIO DE PAGO</option>
                            <option>AVISO DE MORA</option>
                        </select>
                    </div>

                    <!-- Nombre del cliente -->
                    <div class="mb-3">
                        <div class="text-primary">MARIA DEL CARMEN CRUZ</div>
                    </div>

                    <!-- Número de teléfono -->
                    <div class="mb-3">
                        <input type="text" class="form-control" id="telefonoInput" value="58997443355">
                    </div>

                    <!-- Mensaje -->
                    <div class="mb-3">
                        <textarea class="form-control" id="mensajeTextarea" rows="6">Distinguid@ Sr/Sra. MARIA DEL CARMEN, Cédula No 031-0252812-6

Mediante este documento, certificamos que su préstamo 28987, de fecha $PrestamoFecha, por un monto de DOP$5,000.00 ha sido saldado, por lo que rectificamos que su compromiso por dicho préstamo fue cancelado.</textarea>
                    </div>

                    <!-- Adjunto -->
                    <div class="mb-3">
                        <button class="btn btn-primary text-white p-0" id="btnAdjunto">
                            <i class="hgi hgi-stroke hgi-file-attachment fs-6"></i> ADJUNTO
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" id="btnEnviarMensaje">
                        <i class="hgi hgi-stroke hgi-checkmark-circle-02 fs-6"></i> ENVIAR
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
