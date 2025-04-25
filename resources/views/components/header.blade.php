
<header class="navbar mt-3 sticky-top flex-md-nowrap p-0 bg-fondo background-body border-bottom">
    <div class="col-8 col-md-3 col-lg-2 me-0 px-3 fs-6 border-end border-sm-0 ">
        <div class="row d-flex align-items-center py-2">
            <div class="col-3 col-md-4">
                <img src="{{asset('default.jpg')}}" alt="Logo" class="img-fluid rounded-circle border" />
            </div>
            <div class="col-9 col-md-8 aling-items-center">
                <div class="fw-bold">User</div>
                <div class="fs-6">
                    <!--FALTA ELIPISIS PARA EVITAR DESBORDAMIENTO-->
                    <small class="text-secondary">Role and Mail</small>
                </div>
            </div>
        </div>
    </div>

    <div class="d-none d-md-flex col-md-9 col-lg-10 justify-content-end px-3 gap-2 ">

        @include('components.notification')
        <button class="btn  border bg-transparent rounded-circle" type="button">
            <i class="hgi hgi-stroke hgi-moon-02 fs-5"></i>
        </button>
        <button class="btn button-color-g d-flex align-items-center gap-2" type="button">
            <i class="hgi hgi-stroke hgi-whatsapp fs-5"></i>
            WhatsApp
        </button>
    </div>

    <ul class="col-4 navbar-nav flex-row d-md-none justify-content-end">
        <!--
      BUSCADOR PARA LUEGO

      <li class="nav-item text-nowrap">
        <button class="nav-link px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch"
          aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
          <i class="hgi hgi-stroke hgi-search-01 fs-6"></i>
        </button>
      </li>-->
        <li class="nav-item text-nowrap">
            @include('components.notification')
        </li>
        <li class="nav-item text-nowrap">

            <button class="nav-link px-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="hgi hgi-stroke hgi-menu-11 fs-4"></i>
            </button>
        </li>
    </ul>

    <div id="navbarSearch" class="navbar-search w-100 collapse">
        <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div>
</header>
