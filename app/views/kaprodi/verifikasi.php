<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter mahasiswa berdasarkan kelas -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Kelas Mahasiswa</h5>
                </div>
            </div>
            <form action="<?= BASE_URL ?>/Verifikasi/filter" method="post">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label" for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-select">
                            <option value="">Pilih Kelas</option>
                            <option value="Reguler" <?= !empty($_POST['kelas']) && $_POST['kelas'] == 'Reguler' ? 'selected' : '' ?>>Reguler</option>
                            <option value="Non Reguler" <?= !empty($_POST['kelas']) && $_POST['kelas'] == 'Non Reguler' ? 'selected' : '' ?>>Non
                                Reguler</option>
                        </select>
                    </div>
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
                            <i class="icon-base ti tabler-user icon-sm me-1_5"></i>Pending
                            <span
                                class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-info ms-1_5"><?= count($data['jml_pending']) ?></span>
                        </span>
                        <i class="icon-base ti tabler-user icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-verifikasi" aria-controls="navs-justified-verifikasi"
                        aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i
                                class="icon-base ti tabler-check icon-sm me-1_5"></i>Diverifikasi Kaprodi</span>
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-success ms-1_5"><?= count($data['jml_verif']) ?></span>
                        <i class="icon-base ti tabler-check icon-sm d-sm-none"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-justified-verifikasiKaprodi" role="tabpanel">
                    <div class="card-datatable text-nowrap">
                        <table class="dt-complex-header table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data['mahasiswa'] as $row):
                                    if ($row['status_pendaftaran'] == 'Pending'):
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row['nim']); ?></td>
                                            <td><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                            <td><?= htmlspecialchars($row['kelas']); ?></td>
                                            <td>
                                                <form class="d-inline"
                                                    action="<?= BASE_URL ?>/Verifikasi/verifikasi/<?= htmlspecialchars($row['id_pendaftaran']) ?>"
                                                    method="post">
                                                    <button type="submit" class="btn btn-success"
                                                        onClick="return confirm('Verifikasi mahasiswa ini?')"><i
                                                            class="ti tabler-check me-1"></i>
                                                        Verifikasi
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#ubahPendaftaran<?= htmlspecialchars($row['id_pendaftaran']) ?>"><i
                                                        class="ti tabler-x me-1"></i> Tolak</button>
                                            </td>
                                        </tr>
                                    <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-verifikasi" role="tabpanel">
                    <div class="card-datatable text-nowrap">
                        <table class="dt-complex-header table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data['mahasiswa'] as $row):
                                    if ($row['status_pendaftaran'] == 'Diverifikasi Kaprodi' || $row['status_pendaftaran'] == 'Diverifikasi'):
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row['nim']); ?></td>
                                            <td><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                            <td><?= htmlspecialchars($row['kelas']); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#ubahPendaftaran<?= htmlspecialchars($row['id_pendaftaran']) ?>"><i
                                                        class="ti tabler-x me-1"></i> Tolak</button>
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
    <!--/ Complex Headers -->
</div>

<!-- Modal Tolak pendaftaran -->
<?php foreach ($data['mahasiswa'] as $row): ?>
    <div class="modal fade" id="ubahPendaftaran<?= htmlspecialchars($row['id_pendaftaran']) ?>" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Tolak Pendaftaran</h4>
                    </div>
                    <form id="tolakPendaftaranForm<?= htmlspecialchars($row['id_pendaftaran']) ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Verifikasi/tolak/<?= htmlspecialchars($row['id_pendaftaran']) ?>"
                        method="post">
                        <div class="col-12">
                            <label class="form-label" for="catatan">Alasan</label>
                            <textarea id="catatan" name="catatan" class="form-control" placeholder="Alasan"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-danger me-2"><i class="ti tabler-x me-1"></i>Tolak</button>
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