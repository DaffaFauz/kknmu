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

<?php if ($data['page'] && $data['page'] == 'Verifikasi Mahasiswa'): ?>
    <script>
        // load option prodi
        $(document).ready(function () {
            function loadProdi(id_fakultas, selected_prodi = null) {
                $('#prodi').html(`<option selected disabled value="">Pilih Prodi</option>`);

                if (id_fakultas) {
                    $.ajax({
                        url: '<?= BASE_URL; ?>/Prodi/getByFakultas/' + id_fakultas,
                        type: 'POST',
                        data: { fakultas: id_fakultas },
                        dataType: 'json',
                        success: function (response) {
                            if (response.length > 0) {
                                $.each(response, function (index, item) {
                                    var isSelected = (selected_prodi && item.id_prodi == selected_prodi) ? true : false;
                                    $('#prodi').append($('<option>', {
                                        value: item.id_prodi,
                                        text: item.nama_prodi,
                                        selected: isSelected
                                    }));
                                })
                            } else {
                                $('#prodi').append('<option disabled>Tidak ada Prodi</option>');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("AJAX Error:" + error);
                            alert("Gagal memuat data")
                        }
                    })
                }
            }

            $('#fakultas').on('change', function () {
                var id_fakultas = $(this).val();
                loadProdi(id_fakultas);
            });

            // Load on init if value exists
            var initial_fakultas = $('#fakultas').val();
            var initial_prodi = '<?= $_POST['id_prodi'] ?? '' ?>';

            if (initial_fakultas) {
                loadProdi(initial_fakultas, initial_prodi);
            }
        })
    </script>
<?php endif; ?>

<?php if ($data['page'] && $data['page'] == 'Lokasi'): ?>
    <script>
        // load option kecamatan
        $(document).ready(function () {
            function loadKecamatan(nama_kabupaten, selected_kecamatan = null) {
                $('#kecamatan').html(`<option selected disabled value="">Pilih Kecamatan</option>`);

                if (nama_kabupaten) {
                    $.ajax({
                        url: '<?= BASE_URL; ?>/Lokasi/getByKabupaten/' + encodeURIComponent(nama_kabupaten),
                        type: 'POST',
                        data: { kabupaten: nama_kabupaten },
                        dataType: 'json',
                        success: function (response) {
                            if (response.length > 0) {
                                $.each(response, function (index, item) {
                                    var isSelected = (selected_kecamatan && item.nama_kecamatan == selected_kecamatan) ? true : false;
                                    $('#kecamatan').append($('<option>', {
                                        value: item.nama_kecamatan,
                                        text: item.nama_kecamatan,
                                        selected: isSelected
                                    }));
                                })
                            } else {
                                $('#kecamatan').append('<option disabled>Tidak ada Kecamatan</option>');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("AJAX Error:" + error);
                            alert("Gagal memuat data")
                        }
                    })
                }
            }

            $('#kabupaten').on('change', function () {
                var nama_kabupaten = $(this).val();
                loadKecamatan(nama_kabupaten);
            });

            // Load on init if value exists
            var initial_kabupaten = $('#kabupaten').val();
            var initial_kecamatan = '<?= $_POST['kecamatan'] ?? '' ?>';

            if (initial_kabupaten) {
                loadKecamatan(initial_kabupaten, initial_kecamatan);
            }
        })
    </script>
<?php endif; ?>

</body>

</html>