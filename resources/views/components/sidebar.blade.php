<style>
    li a {
        color: #1C1D1D !important;
    }

    .badge-color {
        background-color: #39D2C0;
    }

    .offcanvas-body {
        scrollbar-width: thin;
        /* Para Firefox */
        scrollbar-color: rgba(128, 128, 128, 0.6) transparent;
        /* Gris bonito */
        overflow-y: auto;
        /* Asegura que el scroll funcione */
    }

    /* Para navegadores basados en WebKit (Chrome, Edge, Safari) */
    .offcanvas-body::-webkit-scrollbar {
        width: 8px;
        /* Grosor de la barra */
    }

    .offcanvas-body::-webkit-scrollbar-thumb {
        background: rgba(128, 128, 128, 0.6);
        /* Gris elegante */
        border-radius: 4px;
        /* Bordes redondeados */
        transition: background 0.3s ease-in-out;
    }

    /* Al pasar el cursor, la barra se oscurece un poco */
    .offcanvas-body:hover::-webkit-scrollbar-thumb {
        background: rgba(128, 128, 128, 0.8);
    }

    /* Fondo de la barra de scroll */
    .offcanvas-body::-webkit-scrollbar-track {
        background: rgba(200, 200, 200, 0.4);
        /* Un gris muy claro */
        border-radius: 4px;
    }

    .submenu {
        display: none;
        padding-left: 1rem;
    }

    .submenu.show {
        display: block;
    }

    .nav-item.main-item {
        cursor: pointer;
    }

    .rotate-icon {
        transition: transform 0.3s ease;
    }

    .rotate-icon.rotated {
        transform: rotate(90deg);
    }

    .cajalist li {
        list-style: none;
    }

    .rotate-180 {
        transform: rotate(180deg);
        transition: transform 0.3s ease;
    }

    .transition {
        transition: transform 0.3s ease;
    }
</style>
<div class="sidebar border-end col-md-3 col-lg-2 p-0">
    <div class="offcanvas-md offcanvas-end position-fixed col-md-3 col-lg-2" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header justify-content-between border-bottom">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
            <button type="button" class="nav-link " data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close">
                <i class="hgi hgi-stroke hgi-circle-arrow-right-02 fs-1 text-secondary"></i>
            </button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto " style="max-height: 90vh;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('home') || request()->is('/') ? 'active' : '' }}"
                        aria-current="page" href="{{ url('home') }}">
                        <i class="hgi hgi-stroke hgi-dashboard-square-02 fs-3 me-2 text-secondary"></i>
                        Resumen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center justify-content-between gap-2 w-100 {{ request()->is('solicitudes*') ? 'active' : '' }}"
                        href="{{ url('solicitudes') }}">
                        <span class="d-flex align-items-center gap-2 ps-4 py-2">
                            <i class="hgi hgi-stroke hgi-wallet-add-02 fs-3 me-2 text-secondary"></i>
                            Solicitudes
                        </span>
                        <span class="badge bg-primary me-2">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('clientes*') ? 'active' : '' }}"
                        href="{{ url('clientes') }}">
                        <i class="hgi hgi-stroke hgi-user-group fs-3 me-2 text-secondary"></i>
                        Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('prestamos*') ? 'active' : '' }}"
                        href="{{ url('prestamos') }}">
                        <i class="hgi hgi-stroke hgi-invoice-03 fs-3 me-2 text-secondary"></i>
                        Préstamos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('pagos*') ? 'active' : '' }}"
                        href="{{ url('pagos') }}">
                        <i class="hgi hgi-stroke hgi-payment-success-02 fs-3 me-2 text-secondary"></i>
                        Pagos
                    </a>
                </li>
                <li class="nav-item main-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('box-page*') || request()->is('box-bills-page*') || request()->is('box-otherincome-page*') ? 'active' : '' }}"
                        click.trigger="toggleSubmenu()">
                        <i class="hgi hgi-stroke hgi-cashier-02 fs-3 text-secondary"></i>
                        Caja
                        <i
                            class="hgi hgi-stroke hgi-arrow-down-01 fs-4 text-secondary ms-auto transition {{ request()->is('box-page*') || request()->is('box-bills-page*') || request()->is('box-otherincome-page*') ? 'rotate-180' : '' }}"></i>
                    </a>
                    <ul class="cajalist"
                        {{ request()->is('cajas*') || request()->is('gastos*') || request()->is('box-otherincome-page*') ? 'style=display:block' : '' }}>
                        <li class="nav-item">
                            <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('cajas*') ? 'active' : '' }}"
                                href="{{ url('cajas') }}">
                                <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                Cajas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('gastos*') ? 'active' : '' }}"
                                href="{{ url('gastos') }}">
                                <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                Gastos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('otros-ingresos*') ? 'active' : '' }}"
                                href="{{ url('otros-ingresos') }}">
                                <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                Otros Ingresos
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('cartera*') ? 'active' : '' }}"
                        href="{{ url('cartera') }}">
                        <i class="hgi hgi-stroke hgi-wallet-01 fs-3 me-2 text-secondary"></i>
                        Cartera
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('map*') ? 'active' : '' }}"
                        href="{{ url('map') }}">
                        <i class="hgi hgi-stroke hgi-maps-search fs-3 me-2 text-secondary"></i>
                        Mapa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('routes*') ? 'active' : '' }}"
                        href="{{ url('routes') }}">
                        <i class="hgi hgi-stroke hgi-route-02 fs-3 me-2 text-secondary"></i>
                        Rutas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('reports*') ? 'active' : '' }}"
                        href="{{ url('reports') }}">
                        <i class="hgi hgi-stroke hgi-analytics-up fs-3 me-2 text-secondary"></i>
                        Reportes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('transactions*') ? 'active' : '' }}"
                        href="{{ url('transactions') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Transacciones
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('income-vs-expenses*') ? 'active' : '' }}"
                        href="{{ url('income-vs-expenses') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Ingresos VS Gastos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('aging-balance*') ? 'active' : '' }}"
                        href="{{ url('aging-balance') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Saldo por Antigüedad
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('settings*') ? 'active' : '' }}"
                        href="{{ url('settings') }}">
                        <i class="hgi hgi-stroke hgi-settings-04 fs-3 me-2 text-secondary"></i>
                        Configuración
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('company*') ? 'active' : '' }}"
                        href="{{ url('company') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Empresa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('templates*') ? 'active' : '' }}"
                        href="{{ url('templates') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Plantillas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('holidays*') ? 'active' : '' }}"
                        href="{{ url('holidays') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Días Feriados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('security*') ? 'active' : '' }}"
                        href="{{ url('security') }}">
                        <i class="hgi hgi-stroke hgi-shield-key fs-3 me-2 text-secondary"></i>
                        Seguridad
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('agents*') ? 'active' : '' }}"
                        href="{{ url('agents') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Agentes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('roles-permissions*') ? 'active' : '' }}"
                        href="{{ url('roles-permissions') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Roles & Permisos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('authorizations*') ? 'active' : '' }}"
                        href="{{ url('authorizations') }}">
                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                        Autorizaciones
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('calculator*') ? 'active' : '' }}"
                        href="{{ url('calculator') }}">
                        <i class="hgi hgi-stroke hgi-calculate fs-3 me-2 text-secondary"></i>
                        Calculadora
                    </a>
                </li>
            </ul>

            <hr class="my-0">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="d-flex align-items-center gap-2 ps-4 py-2"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="hgi hgi-stroke hgi-logout-01 fs-3 me-2 text-secondary"></i>
                        Sign out
                    </a>
                </li>
            </ul>

            <!-- Formulario de logout oculto -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>
</div>
