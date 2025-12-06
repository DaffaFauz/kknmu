<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter Dosen -->
    <!-- <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Dosen</h5>
                </div>
            </div>
            <form action="<?php //BASE_URL ?>/Dosen/filter/<?php //$data['id_dosen'] ?? '' ?>" method="post">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="id_fakultas">Fakultas</label>
                        <select name="id_fakultas" id="id_fakultas" class="form-select">
                            <option value="">Pilih Fakultas</option>
                            <?php //foreach ($data['fakultas'] as $row): ?>
                                <option value="<?php // $row['id_fakultas'] ?>" <?php // !empty($_POST['id_fakultas']) && $row['id_fakultas'] == $_POST['id_fakultas'] ? 'selected' : '' ?>>
                                    <?php // $row['nama_fakultas'] ?>
                                </option>
                            <?php // endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="id_prodi">Prodi</label>
                        <select name="id_prodi" id="id_prodi" class="form-select">
                            <option value="">Pilih Prodi</option>
                            <?php // foreach ($data['prodi'] as $row): ?>
                                <option value="<?php //$row['id_prodi'] ?>" <?php //!empty($_POST['id_prodi']) && $row['id_prodi'] == $_POST['id_prodi'] ? 'selected' : '' ?>>
                                    <?php //$row['nama_prodi'] ?>
                                </option>
                            <?php // endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 align-self-end d-flex">
                        <button type="submit" class="btn btn-primary me-2"><i
                                class="ti tabler-filter me-1"></i>Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->


    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
            <?= $_SESSION['msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['msg']); endif; ?>
    <!-- Complex Headers -->
    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center my-0">
            <h5 class="card-title mb-0">Data Dosen</h5>
            <button type="button" class="btn btn-primary ps-2" data-bs-toggle="modal" data-bs-target="#tambahDosen">
                <i class="ti tabler-plus me-1"></i> Tambah Dosen
            </button>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Nama Dosen</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['dosen'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nidn']); ?></td>
                            <td><?= htmlspecialchars($row['nama_dosen']); ?></td>
                            <td><?= htmlspecialchars($row['nama_prodi']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubahDosen<?= htmlspecialchars($row['id_dosen']) ?>"><i
                                        class="ti tabler-pencil me-1"></i> Edit</button>
                                <form class="d-inline"
                                    action="<?= BASE_URL ?>/Dosen/delete/<?= htmlspecialchars($row['id_user']) ?>"
                                    method="post">
                                    <button type="submit" class="btn btn-danger"
                                        onClick="return confirm('Yakin ingin menghapus Dosen ini?')"><i
                                            class="ti tabler-trash me-1"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Complex Headers -->
</div>

<!-- Modal tambah Dosen -->
<div class="modal fade" id="tambahDosen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Tambah Dosen</h4>
                </div>
                <form id="tambahDosenForm" class="row g-6" action="<?= BASE_URL ?>/Dosen/create" method="post">
                    <div class="col-12">
                        <label class="form-label" for="modalTambahDosen">NIDN</label>
                        <input type="text" id="modalTambahDosen" name="nidn" class="form-control" placeholder="NIDN"
                            required />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahDosen">Nama Dosen</label>
                        <input type="text" id="modalTambahDosen" name="nama_dosen" class="form-control"
                            placeholder="Nama Dosen" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahDosen">Prodi</label>
                        <select name="id_prodi" id="modalTambahProdi" class="form-select" required>
                            <option value="">Pilih Prodi</option>
                            <?php foreach ($data['prodi'] as $row): ?>
                                <option value="<?= $row['id_prodi'] ?>"><?= $row['nama_prodi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary me-3">Tambah</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit Dosen -->
<?php foreach ($data['dosen'] as $row): ?>
    <div class="modal fade" id="ubahDosen<?= $row['id_dosen'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Ubah Dosen</h4>
                    </div>
                    <form id="ubahDosenForm<?= $row['id_dosen'] ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Dosen/update/<?= $row['id_user'] ?>" method="post">
                        <div class="col-12">
                            <label class="form-label" for="modalUbahProdi">NIDN</label>
                            <input type="text" id="modalUbahProdi" name="username" class="form-control" placeholder="NIDN"
                                value="<?= $row['nidn'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahNama">Nama Dosen</label>
                            <input type="text" id="modalUbahNama" name="nama" class="form-control" placeholder="Nama Dosen"
                                value="<?= $row['nama_dosen'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahProdi">Prodi</label>
                            <select name="id_prodi" id="modalUbahProdi" class="form-select" required>
                                <option value="">Pilih Prodi</option>
                                <?php foreach ($data['prodi'] as $p): ?>
                                    <option value="<?= $p['id_prodi'] ?>" <?= $p['id_prodi'] == $row['id_prodi'] ? 'selected' : '' ?>><?= $p['nama_prodi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary me-3">Ubah</button>
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