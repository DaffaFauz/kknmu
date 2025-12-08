<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter lokasi berdasarkan kabupaten dan kecataman -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Lokasi</h5>
                </div>
            </div>
            <form action="<?= BASE_URL ?>/Lokasi/filter" method="POST">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="kabupaten">Kabupaten</label>
                        <select name="kabupaten" id="kabupaten" class="form-select">
                            <option value="">Pilih Kabupaten</option>
                            <?php foreach ($data['kabupaten'] as $row): ?>
                                <option value="<?= $row['nama_kabupaten'] ?>" <?= !empty($_POST['kabupaten']) && $row['nama_kabupaten'] == $_POST['kabupaten'] ? 'selected' : '' ?>>
                                    <?= $row['nama_kabupaten'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="kecamatan">Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" class="form-select">
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($data['kecamatan'] as $row): ?>
                                <option value="<?= $row['nama_kecamatan'] ?>" <?= !empty($_POST['kecamatan']) && $row['nama_kecamatan'] == $_POST['kecamatan'] ? 'selected' : '' ?>>
                                    <?= $row['nama_kecamatan'] ?>
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
            <h5 class="card-title mb-0">Lokasi</h5>
            <button type="button" class="btn btn-primary ps-2" data-bs-toggle="modal" data-bs-target="#tambahLokasi">
                <i class="ti tabler-plus me-1"></i> Tambah Lokasi
            </button>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['lokasi'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_desa']); ?></td>
                            <td><?= htmlspecialchars($row['nama_kecamatan']); ?></td>
                            <td><?= htmlspecialchars($row['nama_kabupaten']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubahLokasi<?= htmlspecialchars($row['id_lokasi']) ?>"><i
                                        class="ti tabler-pencil me-1"></i> Edit</button>
                                <form class="d-inline"
                                    action="<?= BASE_URL ?>/Lokasi/delete/<?= htmlspecialchars($row['id_lokasi']) ?>"
                                    method="post">
                                    <button type="submit" class="btn btn-danger"
                                        onClick="return confirm('Yakin ingin menghapus Lokasi ini?')"><i
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

<!-- Modal tambah Lokasi -->
<div class="modal fade" id="tambahLokasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Tambah Lokasi</h4>
                </div>
                <form id="tambahLokasiForm" class="row g-6" action="<?= BASE_URL ?>/Lokasi/create" method="post">
                    <div class="col-12">
                        <label class="form-label" for="modalTambahLokasi">Nama Desa</label>
                        <input type="text" id="modalTambahLokasi" name="nama_desa" class="form-control"
                            placeholder="Nama Desa" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahLokasi">Nama Kecamatan</label>
                        <input type="text" id="modalTambahLokasi" name="nama_kecamatan" class="form-control"
                            placeholder="Nama Kecamatan" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahLokasi">Nama Kabupaten</label>
                        <input type="text" id="modalTambahLokasi" name="nama_kabupaten" class="form-control"
                            placeholder="Nama Kabupaten" required />
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

<!-- Modal edit Lokasi -->
<?php foreach ($data['lokasi'] as $row): ?>
    <div class="modal fade" id="ubahLokasi<?= $row['id_lokasi'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Ubah Lokasi</h4>
                    </div>
                    <form id="ubahLokasiForm<?= $row['id_lokasi'] ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Lokasi/update/<?= $row['id_lokasi'] ?>" method="post">
                        <div class="col-12">
                            <label class="form-label" for="modalUbahLokasi">Nama Desa</label>
                            <input type="text" id="modalUbahLokasi" name="nama_desa" class="form-control"
                                placeholder="Nama Desa" value="<?= $row['nama_desa'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahLokasi">Nama Kecamatan</label>
                            <input type="text" id="modalUbahLokasi" name="nama_kecamatan" class="form-control"
                                placeholder="Nama Kecamatan" value="<?= $row['nama_kecamatan'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahLokasi">Nama Kabupaten</label>
                            <input type="text" id="modalUbahLokasi" name="nama_kabupaten" class="form-control"
                                placeholder="Nama Kabupaten" value="<?= $row['nama_kabupaten'] ?>" />
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary me-3">Ubah</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>