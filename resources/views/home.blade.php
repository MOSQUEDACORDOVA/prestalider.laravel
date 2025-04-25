@extends('layouts.app')

@section('content')
    <style>
        .icon-circle {
            width: 60px;
            height: 60px;
            background-color: rgba(20, 184, 166, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .icon-circle svg {
            width: 30px;
            height: 30px;
            color: #14b8a6;
        }

        .metric-value {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            line-height: 1.2;
        }

        .metric-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .metric-content {
            display: flex;
            align-items: center;
        }

        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 30px 0;
        }

        .notification-text {
            flex-grow: 1;
        }





        .blue {
            background-color: #b2e3e3;
        }

        .pink {
            background-color: #F0D3C8;
        }


        .banner-btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 500;
            border: none;
        }



        .stats-card {
            background-color: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }

        .icon-teal {
            color: #00bfa5;
        }

        .stats-number {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
        }

        .stats-label {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .custom-select {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .amount-box {
            text-align: center;
            padding: 15px;
        }

        .amount {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .amount-label {
            font-size: 14px;
            color: #666;
        }








        .amount-due {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .payment-status {
            font-size: 14px;
        }

        .overdue {
            color: #ff5252;
            font-size: 12px;
        }

        .chart-container {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .chart-title {
            font-size: 16px;
            color: #666;
            margin-bottom: 15px;
        }

        .chart {
            height: 300px;
            position: relative;
        }

        .bar {
            position: absolute;
            bottom: 30px;
            width: 30px;
            background-color: #ddd;
            border-radius: 4px 4px 0 0;
        }

        .bar-segment {
            width: 100%;
            border-radius: 4px 4px 0 0;
        }

        .segment-blue {
            background-color: #2196f3;
        }

        .segment-purple {
            background-color: #9c27b0;
        }

        .chart-labels {
            position: absolute;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
        }

        .chart-label {
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .footer {
            text-align: right;
            padding: 10px;
        }

        .flutter-badge {
            background-color: #5e35b1;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            font-size: 14px;
        }

        .flutter-icon {
            margin-right: 5px;
        }



        /* Responsive */

        .header {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .month-card {
            margin-bottom: 20px;
            border-left: 4px solid #ffc107;
            transition: transform 0.3s;
        }

        .month-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .gold-expense {
            background-color: #fff3cd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .month-title {
            color: #343a40;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
    </style>
    <div class="container-fluid pt-3 pb-2 mb-3">
        <!-- Banners de notificación -->

        <div class="alert alert-success d-flex align-items-center justify-content-between py-1" role="alert">
            <i class="hgi hgi-stroke hgi-discount-tag-02 me-2 fs-4"></i>
            <div class="w-100">
                Síguenos en Instagram y obtén un 50% de descuento en tu primer mes.
                <a href="#" class="alert-link">Síguenos</a>
            </div>

        </div>

        <div class="alert alert-warning d-flex align-items-center justify-content-between py-1" role="alert">
            <i class="hgi hgi-stroke hgi-alert-01 me-2 fs-4"></i>
            <div class="w-100">
                Te quedan 5 días para probar el sistema!

                <a href="#" class="alert-link">Ver tutoriales</a>
                <a href="#" class="alert-link">Comprar</a>
            </div>

        </div>
        <!-- Tarjetas de estadísticas -->
        <div class="row g-4 my-5">
            <!-- Clientes Activos -->
            <div class="col-md-6 col-lg-3 d-flex">
                <div class="bg-primary-subtle icon-circle">
                    <i class="hgi hgi-stroke hgi-user-circle-02 fs-4 text-primary"></i>
                </div>
                <div>
                    <h2 class="metric-value">10 de 30</h2>
                    <p class="metric-label">Clientes Activos</p>
                </div>
            </div>

            <!-- Préstamos Activos -->
            <div class="col-md-6 col-lg-3 d-flex ">
                <div class="bg-primary-subtle icon-circle">
                    <i class="hgi hgi-stroke hgi-invoice-03 fs-4 text-primary"></i>
                </div>
                <div>
                    <h2 class="metric-value">8 de 38</h2>
                    <p class="metric-label">Préstamos Activos</p>
                </div>
            </div>

            <!-- Total Prestado -->
            <div class="col-md-6 col-lg-3 d-flex">
                <div class="bg-primary-subtle icon-circle">
                    <i class="hgi hgi-stroke hgi-save-money-dollar fs-4 text-primary"></i>
                </div>
                <div>
                    <h2 class="metric-value">$2000</h2>
                    <p class="metric-label">Total Prestado</p>
                </div>
            </div>
            <!-- Proyección de Intereses -->
            <div class="col-md-6 col-lg-3 d-flex">
                <div class="bg-primary-subtle icon-circle">
                    <i class="hgi hgi-stroke hgi-analytics-up fs-4 text-primary"></i>
                </div>
                <div>
                    <h2 class="metric-value">$10000</h2>
                    <p class="metric-label">Proyección de Intereses</p>
                </div>
            </div>

        </div>


        <!-- Sección de cuentas por cobrar -->
        <div class="row row-gap-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body py-0">
                        <div class="accounts-section">
                            <h2 class="section-title mt-3">Cuentas por cobrar</h2>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <select class="form-select custom-select">
                                        <option>Enero</option>
                                        <option>Febrero</option>
                                        <option>Marzo</option>
                                        <option>Abril</option>
                                        <option>Mayo</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select custom-select">
                                        <option>Todas las rutas</option>
                                        <option>Ruta 1</option>
                                        <option>Ruta 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="amount-box">
                                        <p class="amount">$0.00</p>
                                        <p class="amount-label">Ingresos</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="amount-box">
                                        <p class="amount">$0.00</p>
                                        <p class="amount-label">Egresos</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tarjetas de clientes -->
                            <div class="d-flex flex-column gap-2 mb-3">

                                <div class="border rounded border-danger">
                                    <div class="d-flex">
                                        <div class="col-md-8 border-end p-3">
                                            <div class="">
                                                <p class="h6">Nombre Cliente</p>
                                                <p class="mb-1"><small>Próximo pago:</small><br>
                                                    <span class="fw-bold text-secondary">ma, 30 may, 2025</span>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <small>Pendiente:</small>
                                                        <div class="fw-bold text-secondary">1000$</div>
                                                    </div>
                                                    <div>
                                                        <small>Modalidad:</small>
                                                        <div class="fw-bold text-secondary">Mensual</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-3 d-flex align-items-center">
                                            <div class="d-flex flex-column text-center gap-1">
                                                <div class="fw-bold fs-5">100$</div>
                                                <small class="">Cuota 3/10</small>
                                                <small class="text-danger">4 Cuotas vencidas.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border rounded ">
                                    <div class="d-flex">
                                        <div class="col-md-8 border-end p-3">
                                            <div class="">
                                                <p class="h6">Nombre Cliente</p>
                                                <p class="mb-1"><small>Próximo pago:</small><br>
                                                    <span class="fw-bold text-secondary">ma, 30 may, 2025</span>
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <small>Pendiente:</small>
                                                        <div class="fw-bold text-secondary">1000$</div>
                                                    </div>
                                                    <div>
                                                        <small>Modalidad:</small>
                                                        <div class="fw-bold text-secondary">Mensual</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-3 d-flex align-items-center">
                                            <div class="d-flex flex-column text-center gap-1">
                                                <div class="fw-bold fs-5">100$</div>
                                                <small class="">Cuota 3/10</small>
                                                <small class="text-danger">4 Cuotas vencidas.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico de gastos -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="section-title">Gráficos 2024</h2>
                        <canvas id="myChart"></canvas>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
