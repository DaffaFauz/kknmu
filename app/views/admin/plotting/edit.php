<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tombol kembali -->
    <a href="<?= BASE_URL ?>/Plotting" class="btn btn-secondary mb-4">
        <i class="ti tabler-arrow-left me-1"></i> Kembali
    </a>


    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
            <?= $_SESSION['msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['msg']); endif; ?>
    <!-- Complex Headers -->

    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center my-0">
            <h5 class="card-title mb-0">Form Edit Plotting Kelompok</h5>
        </div>
        <div class="card-body mt-4">
            <form action="<?= BASE_URL ?>/Plotting/update/<?= $data['detail_kelompok']['id'] ?>" method="POST">
                <input type="hidden" name="id_tahun"
                    value="<?= htmlspecialchars($data['detail_kelompok']['id_tahun']) ?>">
                <div class="row g-3">
                    <!-- Nama Kelompok -->
                    <div class="col-md-12">
                        <label class="form-label" for="kelompok">Nama Kelompok</label>
                        <select id="kelompok" class="form-select select2" disabled>
                            <option value="<?= $data['detail_kelompok']['id_kelompok'] ?>">
                                <?= $data['detail_kelompok']['nama_kelompok'] ?>
                            </option>
                        </select>
                        <input type="hidden" name="kelompok" value="<?= $data['detail_kelompok']['id_kelompok'] ?>">
                    </div>

                    <!-- Lokasi -->
                    <div class="col-md-4">
                        <label class="form-label" for="kabupaten">Kabupaten</label>
                        <select name="kabupaten" id="kabupaten" class="form-select select2" required>
                            <option value="">Pilih Kabupaten</option>
                            <?php foreach ($data['kabupaten'] as $row): ?>
                                <option value="<?= $row['nama_kabupaten'] ?>"
                                    <?= $row['nama_kabupaten'] == $data['detail_kelompok']['nama_kabupaten'] ? 'selected' : '' ?>>
                                    <?= $row['nama_kabupaten'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="kecamatan">Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" class="form-select select2" required>
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($data['kecamatan'] as $row): ?>
                                <option value="<?= $row['nama_kecamatan'] ?>"
                                    <?= $row['nama_kecamatan'] == $data['detail_kelompok']['nama_kecamatan'] ? 'selected' : '' ?>>
                                    <?= $row['nama_kecamatan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="desa">Desa</label>
                        <select name="desa" id="desa" class="form-select select2" required>
                            <option value="">Pilih Desa</option>
                            <?php foreach ($data['desa'] as $row): ?>
                                <option value="<?= $row['id_lokasi'] ?>"
                                    <?= $row['id_lokasi'] == $data['detail_kelompok']['id_lokasi'] ? 'selected' : '' ?>>
                                    <?= $row['nama_desa'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Desa yang dipilih akan disimpan sebagai lokasi kelompok.</small>
                    </div>

                    <!-- Pembimbing -->
                    <div class="col-md-6">
                        <label class="form-label" for="dosen1">Pembimbing 1</label>
                        <select name="dosen1" id="dosen1" class="form-select select2" required>
                            <option value="">Pilih Pembimbing 1</option>
                            <?php foreach ($data['pembimbing'] as $row): ?>
                                <option value="<?= $row['id_dosen'] ?>"
                                    <?= $row['id_dosen'] == $data['detail_kelompok']['id_dosen1'] ? 'selected' : '' ?>>
                                    <?= $row['nama_dosen'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="dosen2">Pembimbing 2 (Opsional)</label>
                        <select name="dosen2" id="dosen2" class="form-select select2">
                            <option value="">Pilih Pembimbing 2</option>
                            <?php foreach ($data['pembimbing'] as $row): ?>
                                <option value="<?= $row['id_dosen'] ?>"
                                    <?= $row['id_dosen'] == $data['detail_kelompok']['id_dosen2'] ? 'selected' : '' ?>>
                                    <?= $row['nama_dosen'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Mahasiswa -->
                    <div class="col-12 mt-4">
                        <h6 class="mb-3">Pilih Mahasiswa (Maksimal 17 orang, Max 7 per Fakultas)</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-mahasiswa">
                                <thead>
                                    <tr>
                                        <th width="5%"><input type="checkbox" id="check-all"></th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Fakultas</th>
                                        <th>Prodi</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['mahasiswa'] as $mhs): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="mahasiswa[]"
                                                    value="<?= $mhs['id_mahasiswa'] ?>" class="check-item"
                                                    <?= in_array($mhs['id_mahasiswa'], $data['detail_kelompok']['mahasiswa_ids']) ? 'checked' : '' ?>>
                                            </td>
                                            <td><?= $mhs['nim'] ?></td>
                                            <td><?= $mhs['nama_mahasiswa'] ?></td>
                                            <td><?= $mhs['nama_fakultas'] ?></td>
                                            <td><?= $mhs['nama_prodi'] ?></td>
                                            <td><?= $mhs['jenis_kelamin'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Simpan Plotting</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Complex Headers -->
</div>