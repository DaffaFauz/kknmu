<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter mahasiswa berdasarkan prodi dan fakultas -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Program Studi</h5>
                </div>
            </div>
            <form action="<?= BASE_URL ?>/Verifikasi/filter/<?= $data['id_fakultas'] ?? '' ?>" method="post">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="id_fakultas">Fakultas</label>
                        <select name="id_fakultas" id="id_fakultas" class="form-select">
                            <option value="">Pilih Fakultas</option>
                            <?php foreach ($data['fakultas'] as $row): ?>
                                <option value="<?= $row['id_fakultas'] ?>" <?= !empty($_POST['id_fakultas']) && $row['id_fakultas'] == $_POST['id_fakultas'] ? 'selected' : '' ?>>
                                    <?= $row['nama_fakultas'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="id_prodi">Prodi</label>
                        <select name="id_prodi" id="id_prodi" class="form-select">
                            <option value="">Pilih Prodi</option>
                            <?php foreach ($data['prodi'] as $row): ?>
                                <option value="<?= $row['id_prodi'] ?>" <?= !empty($_POST['id_prodi']) && $row['id_prodi'] == $_POST['id_prodi'] ? 'selected' : '' ?>>
                                    <?= $row['nama_prodi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 align-self-end d-flex">
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
            <h5 class="card-title mb-0">Verifikasi Mahasiswa</h5>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['mahasiswa'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nim']); ?></td>
                            <td><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                            <td><?= htmlspecialchars($row['nama_prodi']); ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#lihatPendaftaran<?= htmlspecialchars($row['id_pendaftaran']) ?>"><i
                                        class="ti tabler-eye me-1"></i> Lihat Detail</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Complex Headers -->
</div>

<!-- Modal Lihat detail Pendaftaran -->
<?php foreach ($data['mahasiswa'] as $row): ?>
    <div class="modal fade" id="lihatPendaftaran<?= htmlspecialchars($row['id_pendaftaran']) ?>" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Lihat Detail Pendaftaran Mahasiswa</h4>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" for="modalTambahProdi">NIM</label>
                            <input type="text" id="modalTambahProdi" value="<?= htmlspecialchars($row['nim']) ?>"
                                class="form-control" placeholder="NIM" readonly disabled />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="modalTambahProdi">Nama Mahasiswa</label>
                            <input type="text" id="modalTambahProdi" value="<?= htmlspecialchars($row['nama_mahasiswa']) ?>"
                                class="form-control" placeholder="Nama Prodi" readonly disabled />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="modalTambahProdi">Alamat</label>
                            <input type="text" id="modalTambahProdi" value="<?= htmlspecialchars($row['alamat']) ?>"
                                class="form-control" placeholder="Alamat" readonly disabled />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="modalTambahProdi">Fakultas</label>
                            <input type="text" id="modalTambahProdi" value="<?= htmlspecialchars($row['nama_fakultas']) ?>"
                                class="form-control" readonly disabled />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="modalTambahProdi">Prodi</label>
                            <input type="text" id="modalTambahProdi" value="<?= htmlspecialchars($row['nama_prodi']) ?>"
                                class="form-control" readonly disabled />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="modalTambahProdi">Kelas</label>
                            <input type="text" id="modalTambahProdi" value="<?= htmlspecialchars($row['kelas']) ?>"
                                class="form-control" readonly disabled />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="modalTambahProdi">Bukti Pembayaran</label>
                            <a href="<?= BASE_URL ?>/assets/img/bukti_pembayaran/<?= htmlspecialchars($row['bukti_pembayaran']) ?>"
                                target="_blank" class="btn btn-sm btn-info mt-2"><i class="ti tabler-eye me-1"></i>
                                Lihat</a>
                        </div>
                    </div>
                    <div class="col-12 text-end mt-4">
                        <form class="d-inline"
                            action="<?= BASE_URL ?>/Pendaftaran/verifikasi/<?= htmlspecialchars($row['id_pendaftaran']) ?>"
                            method="post">
                            <button type="submit" class="btn btn-success"
                                onClick="return confirm('Verifikasi Pendaftaran mahasiswa ini?')"><i
                                    class="ti tabler-check me-1"></i>
                                Verifikasi
                            </button>
                        </form>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#revisiPendaftaran<?= htmlspecialchars($row['id_pendaftaran']) ?>"><i
                                class="ti tabler-pencil me-1"></i> Revisi</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#tolakPendaftaran<?= htmlspecialchars($row['id_pendaftaran']) ?>"><i
                                class="ti tabler-x me-1"></i> Tolak</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Revisi -->
<?php foreach ($data['mahasiswa'] as $row): ?>
    <div class="modal fade" id="revisiPendaftaran<?= $row['id_pendaftaran'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Revisi Pendaftaran</h4>
                    </div>
                    <form id="ubahProdiForm<?= $row['id_prodi'] ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Verifikasi/revisi/<?= $row['id_pendaftaran'] ?>" method="post">
                        <div class="col-12">
                            <label class="form-label" for="modalUbahProdi">Catatan</label>
                            <textarea type="text" id="modalUbahProdi" name="catatan" class="form-control"
                                placeholder="Catatan"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-warning me-3">Kirim</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Tolak -->
<?php foreach ($data['mahasiswa'] as $row): ?>
    <div class="modal fade" id="tolakPendaftaran<?= $row['id_pendaftaran'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Tolak Pendaftaran</h4>
                    </div>
                    <form id="ubahProdiForm<?= $row['id_prodi'] ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Verifikasi/tolak/<?= $row['id_pendaftaran'] ?>" method="post">
                        <div class="col-12">
                            <label class="form-label" for="modalUbahProdi">Catatan</label>
                            <textarea type="text" id="modalUbahProdi" name="kode_prodi" class="form-control"
                                placeholder="Catatan"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-danger me-3">Tolak</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>