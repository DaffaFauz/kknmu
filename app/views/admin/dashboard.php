<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <!-- Card Border Shadow -->
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="fas fa-user-graduate"></i></span>
                        </div>
                        <h4 class="mb-0"><?= htmlspecialchars($data['mahasiswa']) ?></h4>
                    </div>
                    <p class="mb-1">Jumlah Mahasiswa</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="icon-base ti tabler-user icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0"><?= htmlspecialchars($data['pembimbing']) ?></h4>
                    </div>
                    <p class="mb-1">Jumlah Dosen Pembimbing</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-success"><i
                                    class="icon-base ti tabler-users-group icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0"><?= htmlspecialchars($data['kelompok']) ?></h4>
                    </div>
                    <p class="mb-1">Jumlah Kelompok</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-info"><i
                                    class="icon-base ti tabler-map icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0"><?= htmlspecialchars($data['lokasi']) ?></h4>
                    </div>
                    <p class="mb-1">Jumlah Lokasi</p>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->

        <!-- Kegiatan Mahasiswa terbaru Table -->
        <div class="col-12 order-5">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Kegiatan Mahasiswa terbaru</h5>
                    </div>
                </div>
                <div class="card-datatable border-top">
                    <table class="dt-route-vehicles table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kelompok</th>
                                <th>Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($data['laporan']):
                                $no = 1;
                                foreach ($data['laporan'] as $laporan): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars(date('d-F-Y', strtotime($laporan['tanggal']))) ?></td>
                                        <td><?= htmlspecialchars($laporan['nama_kelompok']) ?></td>
                                        <td><?= htmlspecialchars($laporan['judul']) ?></td>
                                        <td><?= htmlspecialchars($laporan['nama_desa']) . ', ' . htmlspecialchars($laporan['nama_kecamatan'] . ', ' . htmlspecialchars($laporan['nama_kabupaten'])) ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm text-white btn-icon btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#detailLaporan<?= htmlspecialchars($laporan['id_laporan']) ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ On route vehicles Table -->
    </div>

    <!-- Modal detail laporan -->
    <!-- Modal detail laporan harian nya -->
    <?php foreach ($data['laporan'] as $row): ?>
        <div class="modal fade" id="detailLaporan<?= htmlspecialchars($row['id_laporan']) ?>" tabindex="-1"
            aria-hidden="true">
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
                                <input type="text" class="form-control" placeholder="tgl bulan tahun"
                                    id="flatpickr-date-modal" value="<?= htmlspecialchars($row['tanggal']) ?>" readonly
                                    disabled />
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
</div>
<!-- / Content -->