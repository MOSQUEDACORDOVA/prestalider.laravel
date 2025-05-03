<header class="adm-header">
    <div class="adm-header__container">
        <div class="adm-header__wrapper">
            <!-- Perfil de usuario -->
            <div class="adm-header__user">
                <div class="adm-header__avatar">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset(Auth::user()->profile_image) }}" alt="Perfil" class="adm-header__avatar-img">
                    @else
                        <div class="adm-header__avatar-placeholder">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="adm-header__user-info">
                    <div class="adm-header__user-name">{{ Auth::user()->name }}</div>
                    <div class="adm-header__user-meta">
                        <span class="adm-header__user-role">{{ Auth::user()->getRoleNames()->first() ?? 'Usuario' }}</span>
                        <span class="adm-header__user-email">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Acciones (Desktop) -->
            <div class="adm-header__actions adm-header__actions--desktop">
                <div class="adm-header__search">
                    <i class="bi bi-search adm-header__search-icon"></i>
                    <input type="text" placeholder="Buscar..." class="adm-header__search-input">
                </div>

                <div class="adm-header__action-group">
                    <div class="adm-header__notification">
                        @include('components.notification')
                    </div>

                    <button type="button" class="adm-header__btn" id="themeToggle">
                        <i class="bi bi-moon-stars"></i>
                    </button>

                    <a href="#" class="adm-header__btn-whatsapp">
                        <i class="bi bi-whatsapp adm-header__btn-icon"></i>
                        <span class="adm-header__btn-text">WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- Acciones (Mobile) -->
            <div class="adm-header__actions adm-header__actions--mobile">
                <button type="button" class="adm-header__btn" data-bs-toggle="collapse" data-bs-target="#navbarSearch">
                    <i class="bi bi-search"></i>
                </button>

                <div class="adm-header__notification">
                    @include('components.notification')
                </div>

                <button type="button" class="adm-header__btn" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Search -->
    <div class="collapse" id="navbarSearch">
        <div class="adm-header__mobile-search">
            <div class="adm-header__search-container">
                <i class="bi bi-search adm-header__search-icon"></i>
                <input type="text" placeholder="Buscar..." class="adm-header__search-input-mobile">
                <button type="button" class="adm-header__search-close" data-bs-toggle="collapse" data-bs-target="#navbarSearch">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<style>
/* Variables específicas para el header */
.adm-header {
    --adm-header-primary: #BD6DFF;
    --adm-header-primary-dark: #a85ae0;
    --adm-header-primary-light: rgba(189, 109, 255, 0.1);
    --adm-header-text-dark: #212529;
    --adm-header-text-muted: #6c757d;
    --adm-header-text-light: #f8f9fa;
    --adm-header-bg-light: #ffffff;
    --adm-header-bg-dark: #1a1a1a;
    --adm-header-border-light: #e9ecef;
    --adm-header-border-dark: #343a40;
    --adm-header-shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
    --adm-header-shadow-md: 0 2px 6px rgba(0,0,0,0.12);
    --adm-header-radius-sm: 4px;
    --adm-header-radius-md: 6px;
    --adm-header-radius-lg: 8px;
    --adm-header-radius-xl: 12px;
    --adm-header-radius-full: 9999px;
    --adm-header-transition: all 0.2s ease;

    position: sticky;
    top: 0;
    z-index: 1000;
    background-color: var(--adm-header-bg-light);
    border-bottom: 1px solid var(--adm-header-border-light);
    box-shadow: var(--adm-header-shadow-sm);
    font-family: inherit;
    margin-top: 2px;
}

.adm-header__container {
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    margin-right: auto;
    margin-left: auto;
}

.adm-header__wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
}

/* Sección de usuario */
.adm-header__user {
    display: flex;
    align-items: center;
    gap: 12px;
}

.adm-header__avatar {
    width: 40px;
    height: 40px;
    border-radius: var(--adm-header-radius-full);
    overflow: hidden;
    box-shadow: var(--adm-header-shadow-sm);
    flex-shrink: 0;
}

.adm-header__avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.adm-header__avatar-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--adm-header-primary);
    color: white;
    font-weight: 600;
    font-size: 16px;
}

.adm-header__user-info {
    max-width: 200px;
}

.adm-header__user-name {
    font-weight: 600;
    font-size: 14px;
    color: var(--adm-header-text-dark);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.adm-header__user-meta {
    font-size: 12px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.adm-header__user-role {
    color: var(--adm-header-primary);
    font-weight: 500;
}

.adm-header__user-email {
    display: none;
    margin-left: 4px;
    color: var(--adm-header-text-muted);
}

@media (min-width: 992px) {
    .adm-header__user-email {
        display: inline;
    }
}

/* Acciones del header */
.adm-header__actions {
    display: flex;
    align-items: center;
}

.adm-header__actions--desktop {
    display: none;
    gap: 16px;
}

.adm-header__actions--mobile {
    display: flex;
    gap: 8px;
}

@media (min-width: 768px) {
    .adm-header__actions--desktop {
        display: flex;
    }

    .adm-header__actions--mobile {
        display: none;
    }
}

.adm-header__search {
    position: relative;
    width: 240px;
}

.adm-header__search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--adm-header-text-muted);
    font-size: 14px;
    pointer-events: none;
}

.adm-header__search-input {
    width: 100%;
    height: 36px;
    padding: 0 12px 0 32px;
    border-radius: var(--adm-header-radius-full);
    border: 1px solid var(--adm-header-border-light);
    background-color: #f8f9fa;
    font-size: 14px;
    transition: var(--adm-header-transition);
}

.adm-header__search-input:focus {
    outline: none;
    border-color: var(--adm-header-primary);
    box-shadow: 0 0 0 3px var(--adm-header-primary-light);
}

.adm-header__action-group {
    display: flex;
    align-items: center;
    gap: 12px;
}

.adm-header__btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: var(--adm-header-radius-full);
    background-color: transparent;
    border: 1px solid var(--adm-header-border-light);
    color: var(--adm-header-text-muted);
    cursor: pointer;
    transition: var(--adm-header-transition);
    padding: 0;
}

.adm-header__btn:hover {
    background-color: var(--adm-header-primary-light);
    color: var(--adm-header-primary);
    border-color: var(--adm-header-primary-light);
}

.adm-header__btn-whatsapp {
    display: flex;
    align-items: center;
    gap: 8px;
    height: 36px;
    padding: 0 16px;
    border-radius: var(--adm-header-radius-full);
    background-color: var(--adm-header-primary);
    color: white;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: var(--adm-header-transition);
}

.adm-header__btn-whatsapp:hover {
    background-color: var(--adm-header-primary-dark);
    transform: translateY(-1px);
    box-shadow: var(--adm-header-shadow-md);
    color: white;
    text-decoration: none;
}

.adm-header__btn-icon {
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.adm-header__btn-text {
    line-height: 1;
}

/* Mobile search */
.adm-header__mobile-search {
    padding: 12px 16px;
    border-top: 1px solid var(--adm-header-border-light);
    background-color: var(--adm-header-bg-light);
}

.adm-header__search-container {
    position: relative;
    width: 100%;
}

.adm-header__search-input-mobile {
    width: 100%;
    height: 40px;
    padding: 0 40px 0 32px;
    border-radius: var(--adm-header-radius-md);
    border: 1px solid var(--adm-header-border-light);
    font-size: 14px;
    transition: var(--adm-header-transition);
}

.adm-header__search-input-mobile:focus {
    outline: none;
    border-color: var(--adm-header-primary);
    box-shadow: 0 0 0 3px var(--adm-header-primary-light);
}

.adm-header__search-close {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: var(--adm-header-text-muted);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    width: 24px;
    height: 24px;
}

/* Dark mode */
.dark-mode .adm-header {
    background-color: var(--adm-header-bg-dark);
    border-bottom: 1px solid var(--adm-header-border-dark);
}

.dark-mode .adm-header__user-name {
    color: var(--adm-header-text-light);
}

.dark-mode .adm-header__search-input,
.dark-mode .adm-header__search-input-mobile {
    background-color: #2c2c2c;
    border-color: #3c3c3c;
    color: var(--adm-header-text-light);
}

.dark-mode .adm-header__btn {
    border-color: #3c3c3c;
    color: var(--adm-header-text-muted);
}

.dark-mode .adm-header__btn:hover {
    background-color: var(--adm-header-primary-light);
    color: var(--adm-header-primary);
}

.dark-mode .adm-header__mobile-search {
    background-color: var(--adm-header-bg-dark);
    border-top: 1px solid var(--adm-header-border-dark);
}

/* Responsive */
@media (max-width: 767.98px) {
    .adm-header__user {
        max-width: 180px;
    }

    .adm-header__user-info {
        max-width: 120px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Funcionalidad para cambiar entre modo claro y oscuro
    const themeToggle = document.getElementById('themeToggle');

    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');

            // Cambiar el icono según el modo
            const icon = this.querySelector('i');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.remove('bi-moon-stars');
                icon.classList.add('bi-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                icon.classList.remove('bi-sun');
                icon.classList.add('bi-moon-stars');
                localStorage.setItem('theme', 'light');
            }
        });

        // Verificar el tema guardado en localStorage
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            const icon = themeToggle.querySelector('i');
            icon.classList.remove('bi-moon-stars');
            icon.classList.add('bi-sun');
        }
    }

    // Cerrar la búsqueda al presionar Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const navbarSearch = document.getElementById('navbarSearch');
            if (navbarSearch && navbarSearch.classList.contains('show')) {
                bootstrap.Collapse.getInstance(navbarSearch).hide();
            }
        }
    });
});
</script>
