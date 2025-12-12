<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter laporan harian berdasarkan tanggal -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Laporan Harian</h5>
                </div>
            </div>
            <form action="<?= BASE_URL ?>/Laporan/filterHarian" method="post">
                <div class="row g-3">
                    <!-- Human Friendly Date Picker-->
                    <div class="col-md-6 col-12 mb-6">
                        <label for="flatpickr-human-friendly" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" placeholder="tgl bulan tahun"
                            id="flatpickr-human-friendly" name="tanggal"
                            value="<?= isset($_POST['tanggal']) ? $_POST['tanggal'] : '' ?>" />
                    </div>
                    <!-- /Human Friendly Date Picker-->
                    <div class="col-md-6 align-self-center d-flex">
                        <button type="submit" class="btn btn-primary me-2"><i
                                class="ti tabler-filter me-1"></i>Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
            <?= $_SESSION['msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['msg']); endif; ?>
    <!-- Complex Headers -->
    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center my-0">
            <h5 class="card-title mb-0">Laporan Harian</h5>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Mahasiswa'): ?>
                <button type="button" class="btn btn-primary ps-2" data-bs-toggle="modal"
                    data-bs-target="#tambahLaporanHarian" <?= !isset($_SESSION['id_kelompok']) ? 'disabled' : '' ?>>
                    <i class="ti tabler-plus me-1"></i> Tambah Laporan Harian
                </button>
            <?php endif; ?>
        </div>
        <div class="card-datatable text-nowrap">
            <div class="table-responsive">
                <table class="dt-complex-header table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Kelompok</th>
                            <th>Desa</th>
                            <th>Judul</th>
                            <th class="w-25">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data['laporan'] as $row):
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars(date('d F Y', strtotime($row['tanggal']))); ?></td>
                                <td><?= htmlspecialchars($row['nama_kelompok']); ?></td>
                                <td><?= htmlspecialchars($row['nama_desa']); ?></td>
                                <td><?= htmlspecialchars($row['judul']); ?></td>
                                <td>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#detailLaporan<?= htmlspecialchars($row['id_laporan']) ?>"><i
                                            class="ti tabler-eye me-1"></i> Detail</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Complex Headers -->
</div>


<!-- Modal detail laporan harian nya -->
<?php foreach ($data['laporan'] as $row): ?>
    <div class="modal fade" id="detailLaporan<?= htmlspecialchars($row['id_laporan']) ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Detail Laporan Harian</h4>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="flatpickr-date-modal" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" placeholder="tgl bulan tahun" id="flatpickr-date-modal"
                                value="<?= htmlspecialchars($row['tanggal']) ?>" readonly disabled />
                        </div>
                        <div class="col-8">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                value="<?= htmlspecialchars($row['judul']) ?>" readonly disabled />
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="isi" class="form-label">Deskripsi</label>
                        <div class="form-control h-auto" style="min-height: 100px; background-color: #f8f9fa;">
                            <?= $row['isi_laporan'] ?>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="file" class="form-label">Dokumentasi</label>
                        <img src="<?= ASSETS_URL ?>/img/dokumentasi/<?= htmlspecialchars($row['dokumentasi']) ?>"
                            alt="<?= htmlspecialchars($row['dokumentasi']) ?>" class="w-50 d-block mt-2 mx-auto">
                    </div>
                    <div class="col-12 mt-4 justify-content-end d-flex">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-label-secondary">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Flatpickr
        flatpickr("#flatpickr-human-friendly", {
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            locale: "id",
        });

        flatpickr("#flatpickr-date-modal", {
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            locale: "id",
            static: true
        });
    });
</script>