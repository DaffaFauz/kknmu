<!doctype html>

<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default" data-assets-path="<?= ASSETS_URL ?>"
    data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> Login | SIM KKN</title>

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
                <!-- Login -->
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

                        <form id="formAuthentication" class="mb-4" action="<?= BASE_URL ?>/Auth/" method="POST">
                            <div class="mb-6 form-control-validation">
                                <label for="email" class="form-label">NIM atau NIDN</label>
                                <input type="text" class="form-control" id="email" name="username"
                                    placeholder="Masukkan NIM atau NIDN" autofocus />
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base ti tabler-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Belum Punya Akun?</span>
                            <a href="<?= BASE_URL ?>/Login/register">
                                <span>Buat Akun</span>
                            </a>
                        </p>
                        <!-- /Login -->
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

            <!-- Main JS -->

            <script src="<?= ASSETS_URL ?>vendor/js/main.js"></script>

            <!-- Page JS -->
            <script src="<?= ASSETS_URL ?>vendor/js/pages-auth.js"></script>
</body>

</html>