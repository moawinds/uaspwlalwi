<!-- Topbar -->
<nav class="navbar navbar-expand navbar-dark bg-primary topbar mb-4 shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <form class="form-inline">
        <button id="sidebarToggleTop" class="btn btn-outline-light d-md-none rounded-circle mr-3">
            <i class="fas fa-sliders-h"></i> <!-- Ikon diganti -->
        </button>
    </form>

    <!-- Brand or Tagline -->
    <span class="navbar-brand font-weight-bold text-white d-none d-sm-inline">
        <i class="fas fa-microchip"></i> ELECTRONIK ADMIN PANEL
    </span>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline ml-auto mr-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari produk..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-warning" type="button">
                    <i class="fas fa-magnifying-glass"></i> <!-- Ikon diganti -->
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav">

        <!-- Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell-concierge"></i> <!-- Ikon diganti -->
                <span class="badge badge-danger badge-counter">3</span>
            </a>
            <!-- Alerts Dropdown content tetap -->
        </li>

        <!-- Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-comments-alt"></i> <!-- Ikon diganti -->
                <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Messages Dropdown content tetap -->
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- User Info -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white small">
                    <i class="fas fa-user-circle mr-1"></i> <?= session()->get('username'); ?> (<?= session()->get('role'); ?>)
                </span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information tetap -->
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
