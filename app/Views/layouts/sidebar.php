<div class="container-fluid">

    <div id="two-column-menu">
    </div>
    <ul class="navbar-nav" id="navbar-nav">
        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
        <li class="nav-item">
            <a class="nav-link menu-link <?= uri_string() == '/' ? 'active' : '' ?>" href="/">
                <i class="ri-home-4-line"></i> <span data-key="t-widgets">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link menu-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link menu-link <?= uri_string() == 'user' ? 'active' : '' ?>" href="/user">
                <i class="ri-team-line"></i> <span data-key="t-widgets">Kelola User</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link menu-link <?= uri_string() == 'produk' ? 'active' : '' ?>" href="/produk">
                <i class="ri-dropbox-line"></i> <span data-key="t-widgets">Kelola Produk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                <i class="ri-file-damage-line"></i> <span data-key="t-dashboards">Laporan</span>
            </a>
            <div class="collapse menu-dropdown" id="sidebarDashboards">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="/responden/show" class="nav-link" data-key="t-analytics"> Jawaban Responden </a>
                    </li>
                    <li class="nav-item">
                        <a href="/responden/rasio" class="nav-link" data-key="t-crm">Rasio Penilaian </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link menu-link <?= uri_string() == 'logout' ? 'active' : '' ?>" href="/logout">
                <i class="ri-logout-box-r-line"></i> <span data-key="t-widgets">Logout</span>
            </a>
        </li>
        
        <!-- <li class="nav-item">
            <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Layouts</span> <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span>
            </a>
            <div class="collapse menu-dropdown" id="sidebarLayouts">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="layouts-horizontal.html" target="_blank" class="nav-link" data-key="t-horizontal">Horizontal</a>
                    </li>
                    <li class="nav-item">
                        <a href="layouts-detached.html" target="_blank" class="nav-link" data-key="t-detached">Detached</a>
                    </li>
                    <li class="nav-item">
                        <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Two Column</a>
                    </li>
                    <li class="nav-item">
                        <a href="layouts-vertical-hovered.html" target="_blank" class="nav-link" data-key="t-hovered">Hovered</a>
                    </li>
                </ul>
            </div>
        </li> -->
        <!-- end Dashboard Menu -->

    </ul>
</div>