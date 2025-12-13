<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter mahasiswa berdasarkan prodi, fakultas dan status pendaftaran -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Pendaftaran Mahasiswa</h5>
                </div>
            </div>
            <form action="<?= BASE_URL ?>/Verifikasi/filter" method="post">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label" for="fakultas">Fakultas</label>
                        <select name="id_fakultas" id="fakultas" class="form-select">
                            <option value="">Pilih Fakultas</option>
                            <?php foreach ($data['fakultas'] as $row): ?>
                                <option value="<?= $row['id_fakultas'] ?>" <?= !empty($_POST['id_fakultas']) && $row['id_fakultas'] == $_POST['id_fakultas'] ? 'selected' : '' ?>>
                                    <?= $row['nama_fakultas'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="prodi">Prodi</label>
                        <select name="id_prodi" id="prodi" class="form-select">
                            <option value="">Pilih Prodi</option>
                            <?php foreach ($data['prodi'] as $row): ?>
                                <option value="<?= $row['id_prodi'] ?>" <?= !empty($_POST[' id_prodi']) && $row['id_prodi'] == $_POST['id_prodi'] ? 'selected' : '' ?>>
                                    <?= $row['nama_prodi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- <div class="col-md-3">
                        <label class="form-label" for="status_pendaftaran">Status Pendaftaran</label>
                        <select name="status_pendaftaran" id="status_pendaftaran" class="form-select">
                            <option value="">Pilih Status Pendaftaran</option>
                            <option value="Diverifikasi Kaprodi" <?php // !empty($_POST['status_pendaftaran']) && $_POST['status_pendaftaran'] == 'Diverifikasi Kaprodi' ? 'selected' : '' ?>
                                Diverifikasi Kaprodi
                            </option>
                            <option value="Revisi" <?php // !empty($_POST['status_pendaftaran']) && $_POST['status_pendaftaran'] == 'Revisi' ? 'selected' : '' ?>>
                                Revisi
                            </option>
                            <option value="Diverifikasi" <?php // !empty($_POST['status_pendaftaran']) && $_POST['status_pendaftaran'] == 'Diverifikasi' ? 'selected' : '' ?>>
                                Diverifikasi
                            </option>
                        </select>
                    </div> -->
                    <div class="col-md-3 align-self-end d-flex">
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
        <div class="nav-align-top nav-tabs-shadow">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-verifikasiKaprodi"
                        aria-controls="navs-justified-verifikasiKaprodi" aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                            <i class="icon-base ti tabler-user icon-sm me-1_5"></i>Diverifikasi Kaprodi
                            <span
                                class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-info ms-1_5"><?= count($data['jml_verifKaprodi']) ?></span>
                        </span>
                        <i class="icon-base ti tabler-user icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-verifikasi" aria-controls="navs-justified-verifikasi"
                        aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i
                                class="icon-base ti tabler-check icon-sm me-1_5"></i>Diverifikasi</span>
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-success ms-1_5"><?= count($data['jml_verif']) ?></span>
                        <i class="icon-base ti tabler-check icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-revisi" aria-controls="navs-justified-revisi"
                        aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i
                                class="icon-base ti tabler-message-dots icon-sm me-1_5"></i>Revisi</span>
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-warning ms-1_5"><?= count($data['jml_revisi']) ?></span>
                        <i class="icon-base ti tabler-message-dots icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-ditolak" aria-controls="navs-justified-ditolak"
                        aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i
                                class="icon-base ti tabler-ban icon-sm me-1_5"></i>Ditolak</span>
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1_5"><?= count($data['jml_ditolak']) ?></span>
                        <i class="icon-base ti tabler-ban icon-sm d-sm-none"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-justified-verifikasiKaprodi" role="tabpanel">
                    <div class="card-datatable text-nowrap">
                        <div class="table-responsive">
                            <table id="table-verifikasi-kaprodi" class="dt-complex-header table table-bordered">
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
                                        if ($row['status_pendaftaran'] == 'Diverifikasi Kaprodi'):
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
                                        <?php endif; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-verifikasi" role="tabpanel">
                    <div class="card-datatable text-nowrap">
                        <div class="table-responsive">
                            <table id="table-diverifikasi" class="dt-complex-header table table-bordered">
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
                                        if ($row['status_pendaftaran'] == 'Diverifikasi'):
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
                                        <?php endif; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-revisi" role="tabpanel">
                    <div class="card-datatable text-nowrap">
                        <div class="table-responsive">
                            <table id="table-revisi" class="dt-complex-header table table-bordered">
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
                                        if ($row['status_pendaftaran'] == 'Revisi'):
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
                                        <?php endif; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-ditolak" role="tabpanel">

                    <div class="card-datatable text-nowrap">
                        <div class="table-responsive">
                            <table id="table-ditolak" class="dt-complex-header table table-bordered">
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
                                        if ($row['status_pendaftaran'] == 'Ditolak'):
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
                                        <?php endif; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
                            <label class="form-label" for="modalTambahProdi">Status Pendaftaran</label>
                            <input type="text" id="modalTambahProdi"
                                value="<?= htmlspecialchars($row['status_pendaftaran']) ?>" class="form-control" readonly
                                disabled />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="modalTambahProdi">Bukti Pembayaran</label>
                            <br>
                            <a href="<?= BASE_URL ?>/assets/img/bukti_pembayaran/<?= htmlspecialchars($row['bukti_pembayaran']) ?>"
                                target="_blank" class="btn btn-sm btn-info mt-2"><i class="ti tabler-eye me-1"></i>
                                Lihat</a>
                        </div>
                    </div>
                    <div class="col-12 text-end mt-4">
                        <?php if ($row['status_pendaftaran'] && $row['status_pendaftaran'] == 'Diverifikasi Kaprodi' || $row['status_pendaftaran'] && $row['status_pendaftaran'] == 'Revisi'): ?>
                            <form class="d-inline"
                                action="<?= BASE_URL ?>/Verifikasi/verifikasi/<?= htmlspecialchars($row['id_pendaftaran']) ?>"
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
                        <?php endif; ?>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Tutup
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