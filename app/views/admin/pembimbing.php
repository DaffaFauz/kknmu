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
            <h5 class="card-title mb-0">Data Pembimbing</h5>
            <button type="button" class="btn btn-primary ps-2" data-bs-toggle="modal"
                data-bs-target="#tambahPembimbing">
                <i class="ti tabler-plus me-1"></i> Tambah Pembimbing
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
                    foreach ($data['pembimbing'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nidn']); ?></td>
                            <td><?= htmlspecialchars($row['nama_dosen']); ?></td>
                            <td><?= htmlspecialchars($row['nama_prodi']); ?></td>
                            <td>
                                <form class="d-inline"
                                    action="<?= BASE_URL ?>/Pembimbing/delete/<?= htmlspecialchars($row['id_user']) ?>"
                                    method="post">
                                    <button type="submit" class="btn btn-danger"
                                        onClick="return confirm('Yakin ingin melepaskan jabatan dosen ini dari pembimbing?')"><i
                                            class="ti tabler-unlink me-1"></i>
                                        Lepas jabatan
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

<!-- Modal tambah Pembimbing -->
<div class="modal fade" id="tambahPembimbing" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Tambah Pembimbing</h4>
                </div>
                <form id="tambahPembimbingForm" class="row g-6" action="<?= BASE_URL ?>/Pembimbing/create"
                    method="post">
                    <div class="col-12">
                        <label class="form-label" for="modalTambahPembimbing">Dosen</label>
                        <select name="id_pembimbing" id="modalTambahPembimbing" class="form-select" required>
                            <option value="">Pilih Dosen</option>
                            <?php foreach ($data['notPembimbing'] as $row): ?>
                                <option value="<?= $row['id_user'] ?>"><?= $row['nama_dosen'] ?></option>
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