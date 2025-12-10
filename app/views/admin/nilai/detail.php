<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tombol kembali -->
    <?php if ($_SESSION['role'] == 'Admin'): ?>
        <a href="<?= BASE_URL ?>/Nilai" class="btn btn-secondary mb-4">
            <i class="ti tabler-arrow-left me-1"></i> Kembali
        </a>
    <?php endif; ?>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
            <?= $_SESSION['msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['msg']); endif; ?>
    <div class="row g-6">
        <!-- Card Border Shadow -->
        <div class="col-lg-4 col-sm-4">
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
                    <p class="mb-1">Dosen Pembimbing <?= isset($data['mahasiswa'][0]['id_dosen2']) ? '1' : '' ?>:
                        <?= isset($data['mahasiswa'][0]['id_dosen1']) ? htmlspecialchars($data['mahasiswa'][0]['nama_dosen1']) : '-' ?>
                    </p>
                    <?php if (isset($data['mahasiswa'][0]['id_dosen2'])): ?>
                        <p class="mb-1">Dosen Pembimbing 2:
                            <?= isset($data['mahasiswa'][0]['id_dosen2']) ? htmlspecialchars($data['mahasiswa'][0]['nama_dosen2']) : '-' ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="icon-base ti tabler-settings icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">
                            Token
                        </h4>
                    </div>
                    <p class="mb-1">Untuk Penguji 1:
                        <?= isset($data['token']['token1']) ? htmlspecialchars($data['token']['token1']) : '-' ?>
                    </p>
                    <p class="mb-1">Untuk Penguji 2:
                        <?= isset($data['token']['token2']) ? htmlspecialchars($data['token']['token2']) : '-' ?>
                    </p>
                </div>
            </div>
        </div>
        <?php if (isset($data['mahasiswa'][0]['nama_desa'])): ?>
            <div class="col-lg-4 col-sm-4">
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
                            <?= isset($data['mahasiswa'][0]['nama_desa']) ? htmlspecialchars($data['mahasiswa'][0]['nama_desa']) : '-' ?>
                        </p>
                        <p class="mb-1">Kecamatan
                            <?= isset($data['mahasiswa'][0]['nama_kecamatan']) ? htmlspecialchars($data['mahasiswa'][0]['nama_kecamatan']) : '-' ?>
                        </p>
                        <p class="mb-1">Kabupaten
                            <?= isset($data['mahasiswa'][0]['nama_kabupaten']) ? htmlspecialchars($data['mahasiswa'][0]['nama_kabupaten']) : '-' ?>
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
                        <?= $data['mahasiswa'][0]['nama_kelompok'] ? htmlspecialchars($data['mahasiswa'][0]['nama_kelompok']) : '-' ?>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data['mahasiswa'] as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nim'] ?></td>
                                <td><?= $row['nama_mahasiswa'] ?></td>
                                <td><?= $row['jenis_kelamin'] ?></td>
                                <td><?= $row['nama_prodi'] ?></td>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#nilaiModal<?= $row['id_mahasiswa'] ?>">Detail Nilai</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ On route vehicles Table -->
</div>

<!-- Modal input nilai mahasiswa -->
<?php foreach ($data['mahasiswa'] as $row): ?>
    <div class="modal fade" id="nilaiModal<?= $row['id_mahasiswa'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASE_URL ?>/Nilai/update/<?= $row['id_nilai'] ?>" method="POST">
                        <input type="hidden" name="id_kelompok" value="<?= $row['id'] ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="n_lapangan">Nilai Lapangan</label>
                                <input type="number" class="form-control" id="n_lapangan" name="n_lapangan"
                                    placeholder="Masukkan nilai lapangan" required value="<?= $row['n_lapangan'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="n_penulisan">Nilai Penulisan Laporan</label>
                                <input type="number" class="form-control" id="n_penulisan" name="n_penulisan"
                                    placeholder="Masukkan nilai penulisan" required value="<?= $row['n_penulisan'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="n_sistematika">Sistematika Penulisan Laporan</label>
                                <input type="number" class="form-control" id="n_sistematika" name="n_sistematika_penulisan"
                                    placeholder="Masukkan nilai sistematika penulisan laporan" readonly disabled
                                    value="<?= $row['n_sistematika_penulisan'] ?>">
                                <input type="hidden" name="n_sistematika_penulisan"
                                    value="<?= $row['n_sistematika_penulisan'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="n_penguasaan">Penguasaan Materi</label>
                                <input type="number" class="form-control" id="n_penguasaan" name="n_penguasaan_materi"
                                    placeholder="Masukkan nilai penguasaan materi" readonly disabled
                                    value="<?= $row['n_penguasaan_materi'] ?>">
                                <input type="hidden" name="n_penguasaan_materi" value="<?= $row['n_penguasaan_materi'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="n_wawasan">Wawasan Umum</label>
                                <input type="number" class="form-control" id="n_wawasan" name="n_wawasan_umum"
                                    placeholder="Masukkan nilai wawasan umum" readonly disabled
                                    value="<?= $row['n_wawasan_umum'] ?>">
                                <input type="hidden" name="n_wawasan_umum" value="<?= $row['n_wawasan_umum'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="n_teknik">Teknik Presentasi</label>
                                <input type="number" class="form-control" id="n_teknik" name="n_teknik_presentasi"
                                    placeholder="Masukkan nilai teknik presentasi" readonly disabled
                                    value="<?= $row['n_teknik_presentasi'] ?>">
                                <input type="hidden" name="n_teknik_presentasi" value="<?= $row['n_teknik_presentasi'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="n_jurnal">Penguasaan Jurnal</label>
                                <input type="number" class="form-control" id="n_jurnal" name="n_penguasaan_jurnal"
                                    placeholder="Masukkan nilai penguasaan jurnal" readonly disabled
                                    value="<?= $row['n_penguasaan_jurnal'] ?>">
                                <input type="hidden" name="n_penguasaan_jurnal" value="<?= $row['n_penguasaan_jurnal'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="n_unggulan">Produk Unggulan</label>
                                <input type="number" class="form-control" id="n_unggulan" name="n_produk_unggulan"
                                    placeholder="Masukkan nilai produk unggulan" readonly disabled
                                    value="<?= $row['n_produk_unggulan'] ?>">
                                <input type="hidden" name="n_produk_unggulan" value="<?= $row['n_produk_unggulan'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="n_unggulan">Nilai Rata-rata</label>
                                <input type="number" class="form-control" id="n_rata" name="n_rata_rata"
                                    placeholder="Masukkan nilai rata-rata"
                                    value="<?= $row['n_rata_rata'] ? htmlspecialchars($row['n_rata_rata']) : '0' ?>"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="nilaiindeks">Indeks</label>
                                <select name="indeks" id="nilaiindeks" class="form-control">
                                    <option value="">Masukkan indeks</option>
                                    <option value="A" <?= $row['indeks'] == 'A' ? 'selected' : '' ?>>A</option>
                                    <option value="B" <?= $row['indeks'] == 'B' ? 'selected' : '' ?>>B</option>
                                    <option value="C" <?= $row['indeks'] == 'C' ? 'selected' : '' ?>>C</option>
                                    <option value="D" <?= $row['indeks'] == 'D' ? 'selected' : '' ?>>D</option>
                                    <option value="E" <?= $row['indeks'] == 'E' ? 'selected' : '' ?>>E</option>
                                    <option value="T" <?= $row['indeks'] == 'T' ? 'selected' : '' ?>>T</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer mt-5">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<!-- / Content -->