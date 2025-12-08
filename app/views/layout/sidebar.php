<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= ASSETS_URL ?>img/branding/logo32x32.png" alt="">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-3">KKNMU</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item <?= $data['page'] && $data['page'] == 'Dashboard' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>/Dashboard" class="menu-link">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <!-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-layout-sidebar"></i>
                <div data-i18n="Layouts">Layouts</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="layouts-collapsed-menu.html" class="menu-link">
                        <div data-i18n="Collapsed menu">Collapsed menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-content-navbar.html" class="menu-link">
                        <div data-i18n="Content navbar">Content navbar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-content-navbar-with-sidebar.html" class="menu-link">
                        <div data-i18n="Content nav + Sidebar">Content nav + Sidebar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="../horizontal-menu-template/" class="menu-link" target="_blank">
                        <div data-i18n="Horizontal">Horizontal</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-without-menu.html" class="menu-link">
                        <div data-i18n="Without menu">Without menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-without-navbar.html" class="menu-link">
                        <div data-i18n="Without navbar">Without navbar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-fluid.html" class="menu-link">
                        <div data-i18n="Fluid">Fluid</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-container.html" class="menu-link">
                        <div data-i18n="Container">Container</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-blank.html" class="menu-link">
                        <div data-i18n="Blank">Blank</div>
                    </a>
                </li>
            </ul>
        </li> -->

        <!-- Front Pages -->
        <!-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-files"></i>
                <div data-i18n="Front Pages">Front Pages</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="../front-pages/landing-page.html" class="menu-link" target="_blank">
                        <div data-i18n="Landing">Landing</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="../front-pages/pricing-page.html" class="menu-link" target="_blank">
                        <div data-i18n="Pricing">Pricing</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="../front-pages/payment-page.html" class="menu-link" target="_blank">
                        <div data-i18n="Payment">Payment</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="../front-pages/checkout-page.html" class="menu-link" target="_blank">
                        <div data-i18n="Checkout">Checkout</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="../front-pages/help-center-landing.html" class="menu-link" target="_blank">
                        <div data-i18n="Help Center">Help Center</div>
                    </a>
                </li>
            </ul>
        </li> -->

        <!-- Data Master -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Data Master">Data Master</span>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>/Mahasiswa" class="menu-link">
                <i class="menu-icon icon-base ti tabler-user"></i>
                <div data-i18n="Data Mahasiswa">Data Mahasiswa</div>
            </a>
        </li>
        <li
            class="menu-item <?= $data['page'] && $data['page'] == 'Dosen' || $data['page'] == 'Kaprodi' || $data['page'] == 'Pembimbing' ? 'active' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-user-pentagon"></i>
                <div data-i18n="Data Dosen">Data Dosen</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $data['page'] && $data['page'] == 'Dosen' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/Dosen" class="menu-link">
                        <div data-i18n="Data Dosen">Data Dosen</div>
                    </a>
                </li>
                <li class="menu-item <?= $data['page'] && $data['page'] == 'Kaprodi' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/Kaprodi" class="menu-link">
                        <div data-i18n="Data Kaprodi">Data Kaprodi</div>
                    </a>
                </li>
                <li class="menu-item <?= $data['page'] && $data['page'] == 'Pembimbing' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/Pembimbing" class="menu-link">
                        <div data-i18n="Data Pembimbing">Data Pembimbing</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item <?= $data['page'] && $data['page'] == 'Fakultas' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>/Fakultas" class="menu-link">
                <i class="menu-icon icon-base ti tabler-school"></i>
                <div data-i18n="Data Fakultas">Data Fakultas</div>
            </a>
        </li>
        <li class="menu-item <?= $data['page'] && $data['page'] == 'Program Studi' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>/Prodi" class="menu-link">
                <i class="menu-icon icon-base ti tabler-book"></i>
                <div data-i18n="Data Prodi">Data Prodi</div>
            </a>
        </li>
        <li class="menu-item <?= $data['page'] && $data['page'] == 'Lokasi' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>/Lokasi" class="menu-link">
                <i class="menu-icon icon-base ti tabler-map-pin"></i>
                <div data-i18n="Lokasi">Lokasi</div>
            </a>
        </li>
        <li class="menu-item <?= $data['page'] && $data['page'] === 'Tahun Akademik' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>/TahunAkademik" class="menu-link">
                <i class="menu-icon icon-base ti tabler-calendar"></i>
                <div data-i18n="Tahun Akademik">Tahun Akademik</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>/Kelompok" class="menu-link">
                <i class="menu-icon icon-base ti tabler-notes"></i>
                <div data-i18n="Data Kelompok">Data Kelompok</div>
            </a>
        </li>

        <!-- Plotting Kelompok -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Plotting Kelompok">Plotting Kelompok</span>
        </li>
        <li class="menu-item">
            <a href="<?= BASE_URL ?>/PlottingKelompok" class="menu-link">
                <i class="menu-icon icon-base ti tabler-users-group"></i>
                <div data-i18n="Plotting Kelompok">Plotting Kelompok</div>
            </a>
        </li>

        <!-- Laporan -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Laporan">Laporan</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-file-description"></i>
                <div data-i18n="Laporan">Laporan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-academy-dashboard.html" class="menu-link">
                        <div data-i18n="Harian">Harian</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-academy-course.html" class="menu-link">
                        <div data-i18n="Akhir">Akhir</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-academy-course-details.html" class="menu-link">
                        <div data-i18n="Nilai">Nilai</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Verifikasi Mahasiswa -->
        <li class="menu-item <?= $data['page'] && $data['page'] == 'Verifikasi Mahasiswa' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>/Verifikasi" class="menu-link">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div data-i18n="Verifikasi Mahasiswa">Verifikasi Mahasiswa</div>
            </a>
        </li>
    </ul>
</aside>

<div class="menu-mobile-toggler d-xl-none rounded-1">
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
        <i class="ti tabler-menu icon-base"></i>
        <i class="ti tabler-chevron-right icon-base"></i>
    </a>
</div>
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">