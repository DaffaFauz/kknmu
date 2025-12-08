<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
            <?= $_SESSION['msg'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['msg']); endif; ?>
    <!-- Complex Headers -->
    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center my-0">
            <h5 class="card-title mb-0">Kelompok</h5>
            <button type="button" class="btn btn-primary ps-2" data-bs-toggle="modal" data-bs-target="#tambahKelompok">
                <i class="ti tabler-plus me-1"></i> Tambah Kelompok
            </button>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelompok</th>
                        <th class="w-20">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['kelompok'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_kelompok']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubahKelompok<?= htmlspecialchars($row['id_kelompok']) ?>"><i
                                        class="ti tabler-pencil me-1"></i> Edit</button>
                                <form class="d-inline"
                                    action="<?= BASE_URL ?>/Kelompok/delete/<?= htmlspecialchars($row['id_kelompok']) ?>"
                                    method="post">
                                    <button type="submit" class="btn btn-danger"
                                        onClick="return confirm('Yakin ingin menghapus Kelompok ini?')"><i
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

<!-- Modal tambah Fakultas -->
<div class="modal fade" id="tambahKelompok" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Tambah Kelompok</h4>
                </div>
                <form id="tambahKelompokForm" class="row g-6" action="<?= BASE_URL ?>/Kelompok/create" method="post">
                    <div class="col-12">
                        <label class="form-label" for="modalTambahKelompok">Nama Kelompok</label>
                        <input type="text" id="modalTambahKelompok" name="nama_kelompok" class="form-control"
                            placeholder="Nama Kelompok" required />
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

<!-- Modal edit Fakultas -->
<?php foreach ($data['kelompok'] as $row): ?>
    <div class="modal fade" id="ubahKelompok<?= $row['id_kelompok'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Ubah Kelompok</h4>
                    </div>
                    <form id="ubahKelompokForm<?= $row['id_kelompok'] ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Kelompok/update/<?= $row['id_kelompok'] ?>" method="post">
                        <div class="col-12">
                            <label class="form-label" for="modalUbahKelompok">Nama Kelompok</label>
                            <input type="text" id="modalUbahKelompok" name="nama_kelompok" class="form-control"
                                placeholder="Nama Kelompok" value="<?= $row['nama_kelompok'] ?>" />
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