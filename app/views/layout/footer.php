<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div class="footer-container d-flex align-items-center justify-content-center py-4 flex-md-row flex-column">
            <div class="text-body">
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , LPPM MU
            </div>
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

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
<?php if ($data['page'] && $data['page'] == 'Dashboard'): ?>
    <script src="<?= ASSETS_URL ?>vendor/libs/apex-charts/apexcharts.js"></script>
<?php endif; ?>
<script src="<?= ASSETS_URL ?>vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="<?= ASSETS_URL ?>vendor/libs/moment/moment.js"></script>
<script src="<?= ASSETS_URL ?>vendor/libs/flatpickr/flatpickr.js"></script>
<script src="<?= ASSETS_URL ?>vendor/libs/@form-validation/popular.js"></script>
<script src="<?= ASSETS_URL ?>vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="<?= ASSETS_URL ?>vendor/libs/@form-validation/auto-focus.js"></script>

<!-- Main JS -->

<script src="<?= ASSETS_URL ?>js/main.js"></script>

<script src="<?= ASSETS_URL ?>js/tables-datatables-basic.js"></script>

</body>

</html>