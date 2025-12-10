<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
            <?= $_SESSION['msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['msg']); endif; ?>

    <!-- Anggota kelompok Table -->
    <div class="col-12 order-5 mt-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Nilai Anggota Kelompok
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
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASE_URL ?>/Nilai/update/<?= $row['id_nilai'] ?>" method="POST">
                        <input type="hidden" name="id_kelompok" value="<?= $row['id'] ?>">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="n_lapangan">Nilai Lapangan</label>
                                <input type="number" class="form-control" id="n_lapangan" name="n_lapangan"
                                    placeholder="Masukkan nilai lapangan" required value="<?= $row['n_lapangan'] ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="n_penulisan">Nilai Penulisan Laporan</label>
                                <input type="number" class="form-control" id="n_penulisan" name="n_penulisan"
                                    placeholder="Masukkan nilai penulisan" required value="<?= $row['n_penulisan'] ?>">
                            </div>
                            <div class="col-12">
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