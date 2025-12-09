<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tombol kembali -->
    <a href="<?= BASE_URL ?>/Plotting" class="btn btn-secondary mb-4">
        <i class="ti tabler-arrow-left me-1"></i> Kembali
    </a>
    <div class="row g-6">
        <!-- Card Border Shadow -->
        <div class="col-lg-6 col-sm-6">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-success"><i
                                    class="icon-base ti tabler-user icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">
                            Dosen Pembimbing
                        </h4>
                    </div>
                    <p class="mb-1">Dosen Pembimbing <?= isset($data['detail_kelompok']['dosen2']) ? '1' : '' ?>:
                        <?= isset($data['detail_kelompok']['dosen1']) ? htmlspecialchars($data['detail_kelompok']['dosen1']) : '-' ?>
                    </p>
                    <?php if (isset($data['detail_kelompok']['dosen2'])): ?>
                        <p class="mb-1">Dosen Pembimbing 2:
                            <?= isset($data['detail_kelompok']['dosen2']) ? htmlspecialchars($data['detail_kelompok']['dosen2']) : '-' ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if (isset($data['detail_kelompok']['nama_desa'])): ?>
            <div class="col-lg-6 col-sm-6">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="icon-base ti tabler-map-pin icon-28px"></i></span>
                            </div>
                            <h4 class="mb-0">
                                Lokasi
                            </h4>
                        </div>
                        <p class="mb-1">Desa
                            <?= isset($data['detail_kelompok']['nama_desa']) ? htmlspecialchars($data['detail_kelompok']['nama_desa']) : '-' ?>
                        </p>
                        <p class="mb-1">Kecamatan
                            <?= isset($data['detail_kelompok']['nama_kecamatan']) ? htmlspecialchars($data['detail_kelompok']['nama_kecamatan']) : '-' ?>
                        </p>
                        <p class="mb-1">Kabupaten
                            <?= isset($data['detail_kelompok']['nama_kabupaten']) ? htmlspecialchars($data['detail_kelompok']['nama_kabupaten']) : '-' ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!--/ Card Border Shadow -->

    <!-- Anggota kelompok Table -->
    <div class="col-12 order-5 mt-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Anggota Kelompok
                        <?= $data['detail_kelompok']['nama_kelompok'] ? htmlspecialchars($data['detail_kelompok']['nama_kelompok']) : '-' ?>
                    </h5>
                </div>
            </div>
            <div class="card-datatable border-top">
                <table class="dt-route-vehicles table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['detail_kelompok']['mahasiswa'] as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['nim'] ?></td>
                                <td><?= $value['nama_mahasiswa'] ?></td>
                                <td><?= $value['jenis_kelamin'] ?></td>
                                <td><?= $value['jurusan'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ On route vehicles Table -->
</div>
</div>
<!-- / Content -->