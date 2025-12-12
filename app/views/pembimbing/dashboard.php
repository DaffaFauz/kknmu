<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <!-- Card Border Shadow -->
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">
                            <?= !empty($data['anggota_kelompok']) ? 'Kelompok ' . $data['anggota_kelompok']['nama_kelompok'] : 'Belum ada kelompok' ?>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table card-table table-border-top-0 table-border-bottom-0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                if (!empty($data['anggota_kelompok']['mahasiswa'])) {
                                    foreach ($data['anggota_kelompok']['mahasiswa'] as $kelompok): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <h6 class="mb-0 fw-normal"><?= $kelompok['nim'] ?></h6>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><?= $kelompok['nama_mahasiswa'] ?></h6>
                                            </td>
                                            <td>
                                                <span><?= $kelompok['nama_prodi'] ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->

        <!-- Laporan harian kelompok yang dibimbing Table -->
        <div class="col-12 order-5">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Kegiatan Harian Mahasiswa</h5>
                    </div>
                </div>
                <div class="card-datatable border-top">
                    <div class="table-responsive">
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
                                                <button class="btn btn-sm text-white btn-icon btn-primary"
                                                    data-bs-toggle="modal"
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