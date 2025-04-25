<div class="dropdown">
    <button class="btn border bg-transparent rounded-circle position-relative notification-btn" type="button"
        id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="hgi hgi-stroke hgi-notification-03 fs-5"></i>
        <span
            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary notification-badge">
            6
            <span class="visually-hidden">notificaciones no leídas</span>
        </span>
    </button>
    <!-- Menú desplegable de notificaciones -->
    <div class="dropdown-menu dropdown-menu-end notification-panel p-0 w-100 w-sm-auto"
        aria-labelledby="notificationDropdown" style="max-width: 360px; min-width: 280px;">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <h6 class="mb-0">Notificaciones</h6>
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">6 Nuevas</span>
        </div>

        <div class="notification-list" style="max-height: 400px; overflow-y: auto;">
            <!-- Notificaciones del usuario -->
            <div class="notification-item d-flex p-3 border-bottom">
                <div class="flex-shrink-0">
                    <img src="https://ui-avatars.com/api/?name=User&background=random" class="rounded-circle"
                        width="40" height="40" alt="">
                </div>
                <div class="flex-grow-1 ms-3 overflow-hidden">
                    <p class="mb-0 fw-medium text-truncate">¡Felicidades Sam 🎉 ganador!</p>
                    <p class="text-muted small mb-0 text-truncate">Ganaste la insignia de mejor vendedor del mes.</p>
                    <small class="text-muted">Actualizado hace 1 mes</small>
                </div>
            </div>


            <div class="notification-item d-flex p-3 border-bottom">
                <div class="flex-shrink-0">
                    <img src="https://ui-avatars.com/api/?name=User&background=random" class="rounded-circle"
                        width="40" height="40" alt="">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="mb-0 fw-medium">Nuevo mensaje recibido</p>
                    <p class="text-muted small mb-0">Tienes 10 mensajes sin leer</p>
                    <small class="text-muted">Actualizado hace 1 mes</small>
                </div>
            </div>

            <div class="notification-item d-flex p-3 border-bottom">
                <div class="flex-shrink-0">
                    <img src="https://ui-avatars.com/api/?name=User&background=random" class="rounded-circle"
                        width="40" height="40" alt="">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="mb-0 fw-medium">Pedido revisado 👋 revisar</p>
                    <p class="text-muted small mb-0">Pedido de MD Inc. actualizado</p>
                    <small class="text-muted">Actualizado hace 1 mes</small>
                </div>
            </div>

        </div>

        <!-- Botón Leer Todo -->
        <div class="p-2">
            <a class="btn button-color-g w-100" id="readAllBtn" href="{{route('all-notifications')}}">Leer todas las
                notificaciones</a>
        </div>
    </div>
</div>
