@extends('layouts.app')

@section('content')
    <!-- DE ESTA MANERA LA DEJE POR QUE HASTA QUE NO SE INDEPENDICE LA VISTA COGE LOS ESTILOS DEL DASHBOARD -->
    <style>
        .main-container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Common Header Styles */
        .header-prestamo {
            background-color: #1C1D1D;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .header-link {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .header-link.active {
            color: #ccc;
            border-radius: 10px;
        }

        .header-link:hover {
            color: #ccc;
            border-radius: 10px;
        }

        /* Loan Application Styles */
        .application-header {
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .application-header h1 {
            color: #28a745;
            font-size: 1.5rem;
            margin: 0;
            font-weight: bold;
        }

        .section-title {
            background-color: #f1f1f1;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 0.9rem;
            color: #333;
            margin-bottom: 15px;
        }

        .form-section {
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: bold;
        }

        .form-control,
        .form-select {
            font-size: 0.9rem;
        }

        .required::after {
            content: " *";
            color: red;
        }

        .info-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .btn-action {
            background-color: #17a2b8;
            color: white;
            font-size: 0.8rem;
            padding: 5px 15px;
            border: none;
        }

        .btn-submit {
            background-color: #17a2b8;
            color: white;
            font-size: 0.9rem;
            padding: 8px 20px;
            border: none;
        }

        .flag-icon {
            width: 20px;
            margin-right: 5px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-header h2 {
            font-size: 1rem;
            font-weight: bold;
            margin: 0;
        }

        .amortization-link {
            color: #17a2b8;
            font-size: 0.8rem;
            text-decoration: none;
        }

        /* Loan Status Styles */
        .loan-status-header {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e9ecef;
        }

        .loan-status-title {
            color: #4CAF50;
            font-size: 1.2rem;
            font-weight: bold;
            margin: 0;
        }

        .company-name {
            color: #20B2AA;
            font-size: 1rem;
            margin: 0;
        }

        .logout-link {
            color: #4CAF50;
            font-size: 0.8rem;
            text-decoration: none;
            padding: 5px 10px;
            text-align: right;
        }

        .back-link {
            color: #4CAF50;
            font-size: 0.8rem;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
        }

        .loan-details {
            padding: 15px 20px;
            background-color: #f8f9fa;
        }

        .loan-details-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .loan-detail {
            flex: 1;
            min-width: 200px;
            margin-bottom: 10px;
        }

        .detail-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            margin-top: 20px;
        }

        .tab {
            padding: 10px 20px;
            font-size: 0.9rem;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .tab.active {
            color: #20B2AA;
            border-bottom: 2px solid #20B2AA;
            font-weight: bold;
        }

        .tab:not(.active) {
            color: #6c757d;
        }

        .payments-table {
            width: 100%;
            margin-top: 0;
        }

        .payments-table th {
            background-color: #f8f9fa;
            font-size: 0.8rem;
            font-weight: normal;
            color: #212529;
            padding: 10px;
            text-align: left;
        }

        .payments-table td {
            font-size: 0.9rem;
            padding: 10px;
            border-top: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .loan-detail {
                min-width: 150px;
            }
        }

        /* Hide/Show Content */
        .content {
            display: none;
        }

        .content.active {
            display: block;
        }
    </style>
    <!-- CUANDO SE HAGA EL CAMBIO ES SOLO METERLO EN EL CSS -->
    <div class="main-container">
        <!-- Common Header -->
        <div class="header-prestamo">
            <a class="header-link" id="solicitar-link">SOLICITAR PRÉSTAMO</a>
            <a class="header-link" id="consultar-link">CONSULTAR ESTADO</a>
        </div>

        <!-- Loan Application Content -->
        <div id="solicitar-content" class="content active bg-white">
            <!-- Header -->
            <div class="application-header">
                <h1>SOLICITUD PRÉSTAMO</h1>
                <span class="text-primary">Isaac</span>
            </div>

            <!-- Info Message -->
            <div class="form-section">
                <p class="info-text mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Para aumentar la probabilidad de que su solicitud sea aprobada, proporcione la mayor
                    cantidad de datos posible.
                </p>
            </div>

            <!-- Client Data Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2>DATOS DEL CLIENTE</h2>
                </div>

                <div class="row g-3">
                    <!-- First Row -->
                    <div class="col-md-3">
                        <label for="tipo" class="form-label required">Tipo</label>
                        <div class="input-group">
                            <select class="form-select" id="tipo">
                                <option selected>Persona</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="cedula" class="form-label required">Cédula de Ciudadanía</label>
                        <input type="text" class="form-control" id="cedula">
                    </div>
                    <div class="col-md-3">
                        <label for="nombres" class="form-label required">Nombres</label>
                        <input type="text" class="form-control" id="nombres">
                    </div>
                    <div class="col-md-3">
                        <label for="apellidos" class="form-label required">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos">
                    </div>

                    <!-- Second Row -->
                    <div class="col-md-3">
                        <label for="genero" class="form-label">Género</label>
                        <select class="form-select" id="genero">
                            <option selected>Seleccione</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="celular" class="form-label required">Celular</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                +57
                            </span>
                            <input type="text" class="form-control" id="celular">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                +57
                            </span>
                            <input type="text" class="form-control" id="telefono">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <select class="form-select" id="nacionalidad">
                            <option selected>Seleccione</option>
                        </select>
                    </div>

                    <!-- Third Row -->
                    <div class="col-md-3">
                        <label for="vivienda" class="form-label">Vivienda</label>
                        <select class="form-select" id="vivienda">
                            <option selected>Seleccione</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="condicion-laboral" class="form-label">Condición Laboral</label>
                        <select class="form-select" id="condicion-laboral">
                            <option selected>Seleccione</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="ingreso" class="form-label">Ingreso</label>
                        <input type="text" class="form-control" id="ingreso" value="$0.00">
                    </div>
                    <div class="col-md-3">
                        <label for="estado-civil" class="form-label">Estado Civil</label>
                        <select class="form-select" id="estado-civil">
                            <option selected>Seleccione</option>
                        </select>
                    </div>

                    <!-- Fourth Row -->
                    <div class="col-md-3">
                        <label for="dependientes" class="form-label">Dependientes</label>
                        <input type="number" class="form-control" id="dependientes" value="0">
                    </div>
                    <div class="col-md-9">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion">
                    </div>

                    <!-- Fifth Row -->
                    <div class="col-md-9">
                        <label for="direccion2" class="form-label">Dirección 2</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="direccion2">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="codigo-postal" class="form-label">Código Postal</label>
                        <input type="text" class="form-control" id="codigo-postal">
                    </div>

                    <!-- Sixth Row -->
                    <div class="col-md-3">
                        <label for="fecha-nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha-nacimiento" placeholder="mm/dd/yyyy">
                    </div>
                    <div class="col-md-9">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button class="btn button-color-g" id="btn-adjuntos-cliente">ADJUNTOS</button>
                    <div class="info-text">Agregar fotos de cédula y cualquier otro documento de interés.</div>
                </div>
            </div>

            <!-- Loan Data Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2>DATOS DEL PRÉSTAMO</h2>
                    <a href="#" class="amortization-link" id="link-amortizacion">AMORTIZACIÓN</a>
                </div>

                <div class="row g-3">
                    <!-- First Row -->
                    <div class="col-md-3">
                        <label for="modalidad" class="form-label required">Modalidad</label>
                        <select class="form-select" id="modalidad">
                            <option selected>Seleccione</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="monto" class="form-label required">Monto a prestar</label>
                        <input type="text" class="form-control" id="monto" value="$0.00">
                    </div>
                    <div class="col-md-3">
                        <label for="cuotas" class="form-label required"># Cuotas</label>
                        <input type="number" class="form-control" id="cuotas" value="0">
                    </div>
                </div>

                <!-- Repeat some client fields for loan section -->
                <div class="row g-3 mt-2">
                    <div class="col-md-3">
                        <label for="vivienda-prestamo" class="form-label">Vivienda</label>
                        <select class="form-select" id="vivienda-prestamo">
                            <option selected>Seleccione</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="condicion-laboral-prestamo" class="form-label">Condición Laboral</label>
                        <select class="form-select" id="condicion-laboral-prestamo">
                            <option selected>Seleccione</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="ingreso-prestamo" class="form-label">Ingreso</label>
                        <input type="text" class="form-control" id="ingreso-prestamo" value="$0.00">
                    </div>
                    <div class="col-md-3">
                        <label for="estado-civil-prestamo" class="form-label">Estado Civil</label>
                        <select class="form-select" id="estado-civil-prestamo">
                            <option selected>Seleccione</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="dependientes-prestamo" class="form-label">Dependientes</label>
                        <input type="number" class="form-control" id="dependientes-prestamo" value="0">
                    </div>
                    <div class="col-md-9">
                        <label for="direccion-prestamo" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion-prestamo">
                    </div>

                    <div class="col-md-9">
                        <label for="direccion2-prestamo" class="form-label">Dirección 2</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="direccion2-prestamo">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="codigo-postal-prestamo" class="form-label">Código Postal</label>
                        <input type="text" class="form-control" id="codigo-postal-prestamo">
                    </div>

                    <div class="col-md-3">
                        <label for="fecha-nacimiento-prestamo" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha-nacimiento-prestamo"
                            placeholder="mm/dd/yyyy">
                    </div>
                    <div class="col-md-9">
                        <label for="email-prestamo" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email-prestamo">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button class="btn button-color-g" id="btn-adjuntos-prestamo">ADJUNTOS</button>
                    <div class="info-text">Agregar fotos de cédula y cualquier otro documento de interés.</div>
                </div>
            </div>

            <!-- Co-debtor Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2>CO-DEUDOR</h2>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="nombre-completo" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre-completo">
                    </div>
                    <div class="col-md-4">
                        <label for="no-identificacion" class="form-label">No. Identificación</label>
                        <input type="text" class="form-control" id="no-identificacion">
                    </div>
                    <div class="col-md-4">
                        <label for="telefono-codeudor" class="form-label">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                +57
                            </span>
                            <input type="text" class="form-control" id="telefono-codeudor">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="direccion-codeudor" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion-codeudor">
                    </div>
                </div>
            </div>

            <!-- References Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2>REFERENCIAS</h2>
                    <a href="#" class="amortization-link" id="btn-agregar-referencia">AGREGAR</a>
                </div>

                <div class="info-text text-center">Agregar contactos de referencia.</div>
            </div>

            <!-- Submit Button -->
            <div class="form-section text-center">
                <button class="btn button-color-g" id="btn-enviar-solicitud">ENVIAR SOLICITUD</button>
            </div>
        </div>

        <!-- Loan Status Content -->
        <div id="consultar-content" class="content">
            <!-- Loan Status Header -->
            <div class="loan-status-header">
                <h1 class="loan-status-title">ESTADO PRÉSTAMO</h1>
                <h2 class="company-name">Prestamos Pechin</h2>
            </div>

            <!-- Logout Link -->
            <div class="text-end">
                <a href="#" class="logout-link" id="btn-cerrar-sesion">CERRAR SESIÓN</a>
            </div>

            <!-- Back Link -->
            <a href="#" class="back-link" id="btn-ir-atras">IR ATRÁS</a>

            <!-- Loan Details -->
            <div class="loan-details">
                <div class="loan-details-row">
                    <div class="loan-detail">
                        <div class="detail-label">Referencia</div>
                        <div class="detail-value">-</div>
                    </div>
                    <div class="loan-detail">
                        <div class="detail-label">Cuotas</div>
                        <div class="detail-value">0</div>
                    </div>
                    <div class="loan-detail">
                        <div class="detail-label">Próximo Pago</div>
                        <div class="detail-value">ju, 06/03/2025</div>
                    </div>
                </div>

                <div class="loan-details-row">
                    <div class="loan-detail">
                        <div class="detail-label">Monto Prestado</div>
                        <div class="detail-value">$1,000.00</div>
                    </div>
                    <div class="loan-detail">
                        <div class="detail-label">Balance pendiente</div>
                        <div class="detail-value">$0.00</div>
                    </div>
                    <div class="loan-detail">
                        <div class="detail-label">Modalidad</div>
                        <div class="detail-value">Semanal</div>
                    </div>
                </div>

                <div class="loan-details-row">
                    <div class="loan-detail">
                        <div class="detail-label">Parcial pendiente</div>
                        <div class="detail-value">$0.00</div>
                    </div>
                    <div class="loan-detail">
                        <div class="detail-label">Cuotas Pendiente</div>
                        <div class="detail-value">0</div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <div class="tab active" data-tab="pagos">PAGOS</div>
                <div class="tab" data-tab="amortizacion">AMORTIZACIÓN</div>
            </div>

            <!-- Payments Table -->
            <div id="tab-content-pagos" class="tab-content active">
                <table class="payments-table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Adjuntos</th>
                            <th>Concepto</th>
                            <th>Monto</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table is empty in the image -->
                    </tbody>
                </table>
            </div>

            <!-- Amortization Table -->
            <div id="tab-content-amortizacion" class="tab-content">
                <table class="payments-table">
                    <thead>
                        <tr>
                            <th>Cuota</th>
                            <th>Fecha</th>
                            <th>Capital</th>
                            <th>Interés</th>
                            <th>Total</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Amortization data would go here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
