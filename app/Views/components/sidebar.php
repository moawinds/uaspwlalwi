<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-bolt"></i> <!-- Ikon baru -->
        </div>
        <div class="sidebar-brand-text mx-3">Electronik</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="fas fa-tachometer-alt"></i> <!-- Ikon baru -->
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Produk -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('produk') ?>">
            <i class="fas fa-laptop-code"></i> <!-- Ikon baru -->
            <span>Produk</span>
        </a>
    </li>

    <!-- Nav Item - Keranjang -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('keranjang') ?>">
            <i class="fas fa-cart-plus"></i> <!-- Ikon baru -->
            <span>Keranjang</span>
        </a>
    </li>

    <!-- Nav Item - Contact -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('contact') ?>">
            <i class="fas fa-envelope-open-text"></i> <!-- Ikon baru -->
            <span>Contact</span>
        </a>
    </li>

    <!-- Nav Item - About -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('about') ?>">
            <i class="fas fa-question-circle"></i> <!-- Ikon baru -->
            <span>About</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
