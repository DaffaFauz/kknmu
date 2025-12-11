<!doctype html>

<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default" data-assets-path="<?= ASSETS_URL ?>"
    data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Daftar | SIM KKN</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= ASSETS_URL ?>img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/libs/pickr/pickr-themes.css" />

    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/css/core.css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/demo.css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/libs/select2/select2.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <!-- Vendor -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="<?= ASSETS_URL ?>vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?= ASSETS_URL ?>vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="<?= ASSETS_URL ?>js/config.js"></script>
</head>

<style>
    .authentication-wrapper.authentication-basic .authentication-inner {
        max-width: 500px;
    }
</style>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <?php if (isset($_SESSION['msg'])): ?>
                    <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
                        <i class="icon-base ti tabler-alert-circle"></i>
                        <strong><?= $_SESSION['msg'] ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['msg']); endif; ?>
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="<?= BASE_URL ?>/Login" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <img src="<?= ASSETS_URL ?>img/branding/logo32x32.png" alt="">
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">SIM KKN</span>
                            </a>
                        </div>
                        <!-- /Logo -->


                        <?php if ($_SESSION['role'] == 'Penguji 1'): ?>
                            <form id="formAuthentication" action="<?= BASE_URL ?>/Nilai/update/<?= $_SESSION['id'] ?>"
                                method="POST">

                                <div class="mb-6 form-control-validation">
                                    <label for="nama" class="form-label">Nama</label>
                                    <select class="form-select select2" id="nama" name="nama">
                                        <option selected disabled value="">Masukkan / Cari nama anda</option>
                                        <?php foreach ($data['dosen'] as $row): ?>
                                            <option value="<?= $row['id_dosen'] ?>"><?= $row['nama_dosen'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <h4 class="mb-1">Masukkan Nilai untuk Kelompok
                                    <?= $data['nama_kelompok']['nama_kelompok'] ?>
                                </h4>

                                <div class="mb-6 form-control-validation">
                                    <label for="n_sistematika_penulisan" class="form-label">Sistematika
                                        Penulisan</label>
                                    <input type="number" class="form-control" id="n_sistematika_penulisan"
                                        name="n_sistematika_penulisan" placeholder="Masukkan Sistematika Penulisan"
                                        autofocus />
                                </div>
                                <div class="mb-6 form-control-validation">
                                    <label for="n_penguasaan_materi" class="form-label">Penguasaan Materi</label>
                                    <input type="number" class="form-control" id="n_penguasaan_materi"
                                        name="n_penguasaan_materi" placeholder="Masukkan Penguasaan Materi" />
                                </div>
                                <div class="mb-6 form-control-validation">
                                    <label class="form-label" for="n_wawasan_umum">Wawasan Umum</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" id="n_wawasan_umum" class="form-control" name="n_wawasan_umum"
                                            placeholder="Masukkan Wawasan Umum" />
                                    </div>
                                </div>
                                <button class="btn btn-primary d-grid w-100">Kirim</button>
                            </form>
                        <?php elseif ($_SESSION['role'] == 'Penguji 2'): ?>
                            <form id="formAuthentication" action="<?= BASE_URL ?>/Nilai/update/<?= $_SESSION['id'] ?>"
                                method="POST">

                                <div class="mb-6 form-control-validation">
                                    <label for="nama" class="form-label">Nama</label>
                                    <select class="form-select select2" id="nama" name="nama">
                                        <option selected disabled value="">Masukkan / Cari nama anda</option>
                                        <?php foreach ($data['dosen'] as $row): ?>
                                            <option value="<?= $row['id_dosen'] ?>"><?= $row['nama_dosen'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <h4 class="mb-1">Masukkan Nilai untuk Kelompok
                                    <?= $data['nama_kelompok']['nama_kelompok'] ?>
                                </h4>

                                <div class="mb-6 form-control-validation">
                                    <label for="n_teknik_presentasi" class="form-label">Teknik
                                        Presentasi</label>
                                    <input type="number" class="form-control" id="n_teknik_presentasi"
                                        name="n_teknik_presentasi" placeholder="Masukkan Teknik Presentasi" autofocus />
                                </div>
                                <div class="mb-6 form-control-validation">
                                    <label for="n_penguasaan_jurnal" class="form-label">Penguasaan
                                        Jurnal</label>
                                    <input type="number" class="form-control" id="n_penguasaan_jurnal"
                                        name="n_penguasaan_jurnal" placeholder="Masukkan Penguasaan Jurnal" />
                                </div>
                                <div class="mb-6 form-control-validation">
                                    <label class="form-label" for="n_produksi_unggulan">Produk Unggulan</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" id="n_produksi_unggulan" class="form-control"
                                            name="n_produksi_unggulan" placeholder="Masukkan Produk Unggulan" />
                                    </div>
                                </div>
                                <button class="btn btn-primary d-grid w-100">Kirim</button>
                            </form>
                        <?php endif; ?>

                        <p class="text-center mt-6">
                            <span>Keluar?</span>
                            <a href="<?= BASE_URL ?>/Auth/logout">
                                <span>Keluar</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <script src="<?= ASSETS_URL ?>vendor/libs/jquery/jquery.js"></script>

    <script src="<?= ASSETS_URL ?>vendor/libs/popper/popper.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/js/bootstrap.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/libs/node-waves/node-waves.js"></script>

    <script src="<?= ASSETS_URL ?>vendor/libs/@algolia/autocomplete-js.js"></script>

    <script src="<?= ASSETS_URL ?>vendor/libs/pickr/pickr.js"></script>

    <script src="<?= ASSETS_URL ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= ASSETS_URL ?>vendor/libs/hammer/hammer.js"></script>

    <script src="<?= ASSETS_URL ?>vendor/libs/i18n/i18n.js"></script>

    <script src="<?= ASSETS_URL ?>vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= ASSETS_URL ?>vendor/libs/@form-validation/popular.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/libs/select2/select2.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>

    <!-- Main JS -->
    <script src="<?= ASSETS_URL ?>js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= ASSETS_URL ?>js/pages-auth.js"></script>
</body>

</html>