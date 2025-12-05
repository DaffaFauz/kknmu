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
            <h5 class="card-title mb-0">Fakultas</h5>
            <button type="button" class="btn btn-primary ps-2" data-bs-toggle="modal" data-bs-target="#tambahFa">
                <i class="ti tabler-plus me-1"></i> Tambah Fakultas
            </button>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Fakultas</th>
                        <th>Nama Fakultas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['fakultas'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['kode_fakultas']); ?></td>
                            <td><?= htmlspecialchars($row['nama_fakultas']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubahFa<?= htmlspecialchars($row['id_fakultas']) ?>"><i
                                        class="ti tabler-pencil me-1"></i> Edit</button>
                                <!-- <form class="d-inline"
                                    action="<?php // BASE_URL ?>/Fakultas/delete/<?= htmlspecialchars($row['id_fakultas']) ?>"
                                    method="post">
                                    <button type="submit" class="btn btn-danger"
                                        onClick="return confirm('Yakin ingin menghapus Fakultas ini?')"><i
                                            class="ti tabler-trash me-1"></i>
                                        Hapus
                                    </button>
                                </form> -->
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
<div class="modal fade" id="tambahFa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Tambah Fakultas</h4>
                </div>
                <form id="tambahFaForm" class="row g-6" action="<?= BASE_URL ?>/Fakultas/create" method="post">
                    <div class="col-12">
                        <label class="form-label" for="modalTambahFakultas">Kode Fakultas</label>
                        <input type="text" id="modalTambahFakultas" name="kode_fakultas" class="form-control"
                            placeholder="Kode Fakultas" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahFakultas">Nama Fakultas</label>
                        <input type="text" id="modalTambahFakultas" name="nama_fakultas" class="form-control"
                            placeholder="Nama Fakultas" required />
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
<?php foreach ($data['fakultas'] as $row): ?>
    <div class="modal fade" id="ubahFa<?= $row['id_fakultas'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Ubah Fakultas</h4>
                    </div>
                    <form id="ubahFaForm<?= $row['id_fakultas'] ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Fakultas/update/<?= $row['id_fakultas'] ?>" method="post">
                        <div class="col-12">
                            <label class="form-label" for="modalUbahFakultas">Kode Fakultas</label>
                            <input type="text" id="modalUbahFakultas" name="kode_fakultas" class="form-control"
                                placeholder="Kode Fakultas" value="<?= $row['kode_fakultas'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahFakultas">Nama Fakultas</label>
                            <input type="text" id="modalUbahFakultas" name="nama_fakultas" class="form-control"
                                placeholder="Nama Fakultas" value="<?= $row['nama_fakultas'] ?>" />
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