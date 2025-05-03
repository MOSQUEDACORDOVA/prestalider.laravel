<style>
    /* Estilos base mejorados pero manteniendo la estructura */
    li a {
        color: #1C1D1D !important;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    li a:hover {
        background-color: rgba(189, 109, 255, 0.08);
    }

    li a.active {
        background-color: rgba(189, 109, 255, 0.15);
        border-left: 3px solid #BD6DFF;
    }

    .badge-color {
        background-color: #BD6DFF;
    }

    /* Mejora del scrollbar */
    .offcanvas-body {
        scrollbar-width: thin;
        scrollbar-color: rgba(128, 128, 128, 0.6) transparent;
        overflow-y: auto;
    }

    .offcanvas-body::-webkit-scrollbar {
        width: 6px;
    }

    .offcanvas-body::-webkit-scrollbar-thumb {
        background: rgba(128, 128, 128, 0.6);
        border-radius: 6px;
        transition: background 0.3s ease-in-out;
    }

    .offcanvas-body:hover::-webkit-scrollbar-thumb {
        background: rgba(128, 128, 128, 0.8);
    }

    .offcanvas-body::-webkit-scrollbar-track {
        background: rgba(200, 200, 200, 0.4);
        border-radius: 6px;
    }

    /* Mejora de los submenús */
    .submenu {
        display: none;
        padding-left: 1rem;
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.3s ease-in-out;
    }

    .submenu.show {
        display: block;
        max-height: 500px;
        /* Altura máxima arbitraria */
    }

    .nav-item.main-item {
        cursor: pointer;
        position: relative;
    }

    /* Mejora de los iconos de rotación */
    .transition {
        transition: transform 0.3s ease;
    }

    .rotate-180 {
        transform: rotate(180deg);
    }

    /* Mejora de los elementos de la lista */
    .cajalist li {
        list-style: none;
        margin: 5px 0;
    }

    /* Mejora de los enlaces */
    .nav-item a {
        border-radius: 6px;
        margin: 2px 8px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
    }

    /* Efecto hover para los elementos del menú */
    .nav-item a:hover {
        transform: translateX(3px);
    }

    /* Mejora del diseño de los badges */
    .badge {
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* Mejora del diseño general del sidebar */
    .sidebar {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        background-color: #fff;
    }

    .offcanvas-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 15px;
    }

    /* Animación suave para los submenús */
    @keyframes slideDown {
        from {
            max-height: 0;
            opacity: 0;
        }

        to {
            max-height: 500px;
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            max-height: 500px;
            opacity: 1;
        }

        to {
            max-height: 0;
            opacity: 0;
        }
    }

    .submenu-animation-enter {
        animation: slideDown 0.3s ease forwards;
    }

    .submenu-animation-exit {
        animation: slideUp 0.3s ease forwards;
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

                @can('solicitudes-list')
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
                @endcan

                @can('clientes-list')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('clientes*') ? 'active' : '' }}"
                            href="{{ url('clientes') }}">
                            <i class="hgi hgi-stroke hgi-user-group fs-3 me-2 text-secondary"></i>
                            Clientes
                        </a>
                    </li>
                @endcan

                @can('prestamos-list')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('prestamos*') ? 'active' : '' }}"
                            href="{{ url('prestamos') }}">
                            <i class="hgi hgi-stroke hgi-invoice-03 fs-3 me-2 text-secondary"></i>
                            Préstamos
                        </a>
                    </li>
                @endcan

                @can('pagos-list')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('pagos*') ? 'active' : '' }}"
                            href="{{ url('pagos') }}">
                            <i class="hgi hgi-stroke hgi-payment-success-02 fs-3 me-2 text-secondary"></i>
                            Pagos
                        </a>
                    </li>
                @endcan

                @if (auth()->user()->can('cajas-list') ||
                        auth()->user()->can('gastos-list') ||
                        auth()->user()->can('otros-ingresos-list'))
                    <li class="nav-item main-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('box-page*') || request()->is('box-bills-page*') || request()->is('box-otherincome-page*') ? 'active' : '' }}"
                            href="javascript:void(0);">
                            <i class="hgi hgi-stroke hgi-cashier-02 fs-3 text-secondary"></i>
                            Caja
                            <i
                                class="hgi hgi-stroke hgi-arrow-down-01 fs-4 text-secondary ms-auto transition {{ request()->is('box-page*') || request()->is('box-bills-page*') || request()->is('box-otherincome-page*') ? 'rotate-180' : '' }}"></i>
                        </a>
                        <ul class="cajalist submenu"
                            {{ request()->is('cajas*') || request()->is('gastos*') || request()->is('box-otherincome-page*') ? 'style=display:block' : '' }}>
                            @can('cajas-list')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('cajas*') ? 'active' : '' }}"
                                        href="{{ url('cajas') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Cajas
                                    </a>
                                </li>
                            @endcan

                            @can('gastos-list')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('gastos*') ? 'active' : '' }}"
                                        href="{{ url('gastos') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Gastos
                                    </a>
                                </li>
                            @endcan

                            @can('otros-ingresos-list')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('otros-ingresos*') ? 'active' : '' }}"
                                        href="{{ url('otros-ingresos') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Otros Ingresos
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @can('cartera-list')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('cartera*') ? 'active' : '' }}"
                            href="{{ url('cartera') }}">
                            <i class="hgi hgi-stroke hgi-wallet-01 fs-3 me-2 text-secondary"></i>
                            Cartera
                        </a>
                    </li>
                @endcan

                @can('map-view')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('map*') ? 'active' : '' }}"
                            href="{{ url('map') }}">
                            <i class="hgi hgi-stroke hgi-maps-search fs-3 me-2 text-secondary"></i>
                            Mapa
                        </a>
                    </li>
                @endcan

                @can('routes-list')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('routes*') ? 'active' : '' }}"
                            href="{{ url('routes') }}">
                            <i class="hgi hgi-stroke hgi-route-02 fs-3 me-2 text-secondary"></i>
                            Rutas
                        </a>
                    </li>
                @endcan

                @can('reports-view')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('reports*') ? 'active' : '' }}"
                            href="{{ url('reports') }}">
                            <i class="hgi hgi-stroke hgi-analytics-up fs-3 me-2 text-secondary"></i>
                            Reportes
                        </a>
                    </li>
                @endcan

                @can('transactions-list')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('transactions*') ? 'active' : '' }}"
                            href="{{ url('transactions') }}">
                            <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                            Transacciones
                        </a>
                    </li>
                @endcan

                @can('income-expenses-view')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('income-vs-expenses*') ? 'active' : '' }}"
                            href="{{ url('income-vs-expenses') }}">
                            <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                            Ingresos VS Gastos
                        </a>
                    </li>
                @endcan

                @can('aging-balance-view')
                    <li class="nav-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('aging-balance*') ? 'active' : '' }}"
                            href="{{ url('aging-balance') }}">
                            <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                            Saldo por Antigüedad
                        </a>
                    </li>
                @endcan

                @if (auth()->user()->can('settings-manage') ||
                        auth()->user()->can('company-manage') ||
                        auth()->user()->can('templates-manage') ||
                        auth()->user()->can('holidays-manage'))
                    <li class="nav-item main-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('settings*') || request()->is('company*') || request()->is('templates*') || request()->is('holidays*') ? 'active' : '' }}"
                            href="javascript:void(0);">
                            <i class="hgi hgi-stroke hgi-settings-04 fs-3 me-2 text-secondary"></i>
                            Configuración
                            <i
                                class="hgi hgi-stroke hgi-arrow-down-01 fs-4 text-secondary ms-auto transition {{ request()->is('settings*') || request()->is('company*') || request()->is('templates*') || request()->is('holidays*') ? 'rotate-180' : '' }}"></i>
                        </a>
                        <ul class="cajalist submenu"
                            {{ request()->is('settings*') || request()->is('company*') || request()->is('templates*') || request()->is('holidays*') ? 'style=display:block' : '' }}>
                            @can('settings-manage')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('settings*') ? 'active' : '' }}"
                                        href="{{ url('settings') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Configuración General
                                    </a>
                                </li>
                            @endcan

                            @can('company-manage')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('company*') ? 'active' : '' }}"
                                        href="{{ url('company') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Empresa
                                    </a>
                                </li>
                            @endcan

                            @can('templates-manage')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('templates*') ? 'active' : '' }}"
                                        href="{{ url('templates') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Plantillas
                                    </a>
                                </li>
                            @endcan

                            @can('holidays-manage')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('holidays*') ? 'active' : '' }}"
                                        href="{{ url('holidays') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Días Feriados
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->can('security-manage') ||
                        auth()->user()->can('agents-manage') ||
                        auth()->user()->can('role-list') ||
                        auth()->user()->can('authorizations-manage'))
                    <li class="nav-item main-item">
                        <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('security*') || request()->is('agents*') || request()->is('roles*') || request()->is('permissions*') || request()->is('users*') ? 'active' : '' }}"
                            href="javascript:void(0);">
                            <i class="hgi hgi-stroke hgi-shield-key fs-3 me-2 text-secondary"></i>
                            Seguridad
                            <i
                                class="hgi hgi-stroke hgi-arrow-down-01 fs-4 text-secondary ms-auto transition {{ request()->is('security*') || request()->is('agents*') || request()->is('roles*') || request()->is('permissions*') || request()->is('users*') ? 'rotate-180' : '' }}"></i>
                        </a>
                        <ul class="cajalist submenu"
                            {{ request()->is('security*') || request()->is('agents*') || request()->is('roles*') || request()->is('permissions*') || request()->is('users*') ? 'style=display:block' : '' }}>
                            @can('security-manage')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('security*') ? 'active' : '' }}"
                                        href="{{ url('security') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Configuración de Seguridad
                                    </a>
                                </li>
                            @endcan

                            @can('agents-manage')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('agents*') ? 'active' : '' }}"
                                        href="{{ url('agents') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Agentes
                                    </a>
                                </li>
                            @endcan

                            @can('role-list')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('roles*') ? 'active' : '' }}"
                                        href="{{ url('roles') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Roles
                                    </a>
                                </li>
                            @endcan
                            @can('permission-list')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('permissions*') ? 'active' : '' }}" href="{{ route('permissions.index') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        <span>Permisos</span>
                                    </a>
                                </li>
                            @endcan
                            @can('user-list')
                            <li class="nav-item">
                                <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                    <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                    <span>Usuarios</span>
                                </a>
                            </li>
                        @endcan

                            @can('authorizations-manage')
                                <li class="nav-item">
                                    <a class="d-flex align-items-center gap-2 ps-4 py-2 {{ request()->is('authorizations*') ? 'active' : '' }}"
                                        href="{{ url('authorizations') }}">
                                        <i class="hgi hgi-stroke hgi-record fs-6 mx-3 text-secondary"></i>
                                        Autorizaciones
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

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
                        Cerrar Session
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener todos los elementos principales que tienen submenús
        const mainItems = document.querySelectorAll('.nav-item.main-item');

        // Agregar evento de clic a cada elemento principal
        mainItems.forEach(item => {
            const link = item.querySelector('a');
            const submenu = item.querySelector('ul.cajalist');
            const icon = item.querySelector('.transition');

            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Animación suave para mostrar/ocultar submenú
                if (submenu.style.display === 'block') {
                    // Primero aplicamos la animación de salida
                    submenu.classList.add('submenu-animation-exit');
                    submenu.classList.remove('submenu-animation-enter');
                    icon.classList.remove('rotate-180');

                    // Después de la animación, ocultamos el elemento
                    setTimeout(() => {
                        submenu.style.display = 'none';
                        submenu.classList.remove('submenu-animation-exit');
                    }, 280); // Tiempo ligeramente menor que la duración de la animación
                } else {
                    // Primero mostramos el elemento
                    submenu.style.display = 'block';

                    // Luego aplicamos la animación de entrada
                    setTimeout(() => {
                        submenu.classList.add('submenu-animation-enter');
                        submenu.classList.remove('submenu-animation-exit');
                        icon.classList.add('rotate-180');
                    },
                    10); // Pequeño retraso para asegurar que el display:block se aplique primero
                }
            });
        });

        // Inicializar los submenús que deben estar abiertos según la URL actual
        mainItems.forEach(item => {
            const submenu = item.querySelector('ul.cajalist');
            const icon = item.querySelector('.transition');

            // Si el submenú debe estar visible según la URL actual
            if (submenu && submenu.hasAttribute('style') && submenu.getAttribute('style').includes(
                    'display:block')) {
                submenu.classList.add('show');
                icon.classList.add('rotate-180');
            }
        });

        // Efecto hover para los elementos del menú
        const navItems = document.querySelectorAll('.nav-item a');
        navItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.2s ease';
                this.style.backgroundColor = 'rgba(189, 109, 255, 0.08)';
            });

            item.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.backgroundColor = '';
                }
            });
        });

        // Efecto de ripple al hacer clic
        const addRippleEffect = (e) => {
            const target = e.currentTarget;

            // Crear el elemento de efecto ripple
            const ripple = document.createElement('span');
            ripple.classList.add('ripple-effect');

            // Establecer posición y estilo
            const rect = target.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;

            // Agregar al elemento
            target.appendChild(ripple);

            // Eliminar después de la animación
            setTimeout(() => {
                ripple.remove();
            }, 600);
        };

        // Agregar efecto ripple a todos los enlaces
        document.querySelectorAll('.nav-item a').forEach(link => {
            link.addEventListener('click', addRippleEffect);
        });
    });
</script>

<style>
    /* Estilos adicionales para efectos visuales */

    /* Efecto ripple */
    .nav-item a {
        position: relative;
        overflow: hidden;
    }

    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.7);
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Mejora de los elementos activos */
    .nav-item a.active {
        font-weight: 500;
        box-shadow: 0 2px 5px rgba(189, 109, 255, 0.15);
    }

    /* Mejora de los iconos */
    .nav-item a i {
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .nav-item a:hover i {
        transform: scale(1.1);
        color: #BD6DFF !important;
    }

    /* Mejora de los badges */
    .badge {
        transition: transform 0.2s ease;
    }

    .nav-item a:hover .badge {
        transform: scale(1.1);
    }

    /* Mejora de los submenús */
    .submenu {
        padding-left: 0;
    }

    .submenu .nav-item a {
        padding-left: 3.5rem;
        font-size: 0.95rem;
    }

    /* Mejora del separador */
    hr {
        opacity: 0.1;
        margin: 1rem 1rem;
    }
</style>
