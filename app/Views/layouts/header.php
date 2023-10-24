<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="/dashboard" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= base_url(); ?>assets/images/logo-tulus-1.png" alt="" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url(); ?>assets/images/logo-tulus-1.png" alt="" height="22">
                        </span>
                    </a>

                    <a href="/dashboard" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= base_url(); ?>assets/images/logo-tulus-2.png" alt="" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url(); ?>assets/images/logo-tulus-2.png" alt="" height="22">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="text-start">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= session('username'); ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?= session('nama_role'); ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome <?= session('username') ?>!</h6>
                        <a class="dropdown-item" href="/logout"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>