<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tombol kembali -->
    <?php if ($_SESSION['role'] == 'Admin'): ?>
        <a href="<?= BASE_URL ?>/Plotting" class="btn btn-secondary mb-4">
            <i class="ti tabler-arrow-left me-1"></i> Kembali
        </a>
    <?php endif; ?>
    <div class="row g-6">
        <div class="col-lg-6 col-sm-6">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <h4 class="mb-0">
                            Kelompok
                        </h4>
                    </div>
                    <p class="mb-1">
                        Anda belum memiliki kelompok. Tunggu proses plotting selesai.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--/ Card Border Shadow -->
</div>
<!-- / Content -->