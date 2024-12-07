<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="admin/admin.php?halaman=dashboard" class="waves-effect active">
                        <i class="bx bx-home"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <?php if ($id_level == 1): ?>
                    <li class="menu-title" key="t-master">Master Data</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-store"></i>
                            <span key="t-ecommerce">TPI</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="admin/admin.php?halaman=tpi-bulu" key="t-bulu">TPI Bulu</a></li>
                            <li><a href="admin/admin.php?halaman=tpi-glongonggede" key="t-glongonggede">TPI Glondong Gede</a></li>
                            <li><a href="admin/admin.php?halaman=tpi-palang" key="t-palang">TPI Palang</a></li>
                            <li><a href="admin/admin.php?halaman=tpi-karangagung" key="t-karangagung">TPI Karangagung</a></li>
                            <li><a href="admin/admin.php?halaman=tpi-plazaikan" key="t-plazaikan">TPI Plaza Ikan</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="menu-title" key="t-grafik">Grafik Data</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-Grafik">Grafik TPI</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="admin/admin.php?halaman=grafik-tpibulu" key="t-grafikbulu">TPI Bulu</a></li>
                        <li><a href="admin/admin.php?halaman=grafik-tpiglongonggede" key="t-grafikglongonggede">TPI Glondong Gede</a></li>
                        <li><a href="admin/admin.php?halaman=grafik-tpipalang" key="t-grafikpalang">TPI Palang</a></li>
                        <li><a href="admin/admin.php?halaman=grafik-tpikarangagung" key="t-grafikkarangagung">TPI Karangagung</a></li>
                        <li><a href="admin/admin.php?halaman=grafik-tpiplazaikan" key="t-grafikplazaikan">TPI Plaza Ikan</a></li>
                    </ul>
                </li>
                <?php if ($id_level == 1): ?>
                    <li class="menu-title" key="t-pengguna">Pengguna</li>
                    <li>
                        <a href="admin/admin.php?halaman=user" class="waves-effect active">
                            <i class="bx bx-wrench"></i>
                            <span key="t-penggunatambah">Pengguna</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>