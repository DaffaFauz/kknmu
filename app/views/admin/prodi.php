<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter prodi -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Program Studi</h5>
                </div>
            </div>
            <form action="<?= BASE_URL ?>/Prodi/filter/<?= $data['id_fakultas'] ?? '' ?>" method="post">
                <div class="row g-3">
                    <div class="col-md-6">
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
                    <div class="col-md-6 align-self-end d-flex">
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
            <h5 class="card-title mb-0">Program Studi</h5>
            <button type="button" class="btn btn-primary ps-2" data-bs-toggle="modal" data-bs-target="#tambahProdi">
                <i class="ti tabler-plus me-1"></i> Tambah Program Studi
            </button>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Prodi</th>
                        <th>Nama Prodi</th>
                        <th>Nama Fakultas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['prodi'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['kode_prodi']); ?></td>
                            <td><?= htmlspecialchars($row['nama_prodi']); ?></td>
                            <td><?= htmlspecialchars($row['nama_fakultas']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubahProdi<?= htmlspecialchars($row['id_prodi']) ?>"><i
                                        class="ti tabler-pencil me-1"></i> Edit</button>
                                <form class="d-inline"
                                    action="<?= BASE_URL ?>/Prodi/delete/<?= htmlspecialchars($row['id_prodi']) ?>"
                                    method="post">
                                    <button type="submit" class="btn btn-danger"
                                        onClick="return confirm('Yakin ingin menghapus Prodi ini?')"><i
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

<!-- Modal tambah Prodi -->
<div class="modal fade" id="tambahProdi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Tambah Prodi</h4>
                </div>
                <form id="tambahProdiForm" class="row g-6" action="<?= BASE_URL ?>/Prodi/create" method="post">
                    <div class="col-12">
                        <label class="form-label" for="modalTambahProdi">Kode Prodi</label>
                        <input type="text" id="modalTambahProdi" name="kode_prodi" class="form-control"
                            placeholder="Kode Prodi" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahProdi">Nama Prodi</label>
                        <input type="text" id="modalTambahProdi" name="nama_prodi" class="form-control"
                            placeholder="Nama Prodi" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahProdi">Fakultas</label>
                        <select name="id_fakultas" id="modalTambahProdi" class="form-select" required>
                            <option value="">Pilih Fakultas</option>
                            <?php foreach ($data['fakultas'] as $row): ?>
                                <option value="<?= $row['id_fakultas'] ?>"><?= $row['nama_fakultas'] ?></option>
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

<!-- Modal edit Prodi -->
<?php foreach ($data['prodi'] as $row): ?>
    <div class="modal fade" id="ubahProdi<?= $row['id_prodi'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Ubah Prodi</h4>
                    </div>
                    <form id="ubahProdiForm<?= $row['id_prodi'] ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Prodi/update/<?= $row['id_prodi'] ?>" method="post">
                        <div class="col-12">
                            <label class="form-label" for="modalUbahProdi">Kode Prodi</label>
                            <input type="text" id="modalUbahProdi" name="kode_prodi" class="form-control"
                                placeholder="Kode Prodi" value="<?= $row['kode_prodi'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahProdi">Nama Prodi</label>
                            <input type="text" id="modalUbahProdi" name="nama_prodi" class="form-control"
                                placeholder="Nama Prodi" value="<?= $row['nama_prodi'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahProdi">Fakultas</label>
                            <select name="id_fakultas" id="modalUbahProdi" class="form-select" required>
                                <option value="">Pilih Fakultas</option>
                                <?php foreach ($data['fakultas'] as $f): ?>
                                    <option value="<?= $f['id_fakultas'] ?>" <?= $f['id_fakultas'] == $row['id_fakultas'] ? 'selected' : '' ?>><?= $f['nama_fakultas'] ?></option>
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