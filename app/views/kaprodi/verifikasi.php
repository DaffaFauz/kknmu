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
            <h5 class="card-title mb-0">Verifikasi Mahasiswa</h5>
        </div>
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
                    <?php endforeach; ?>
                </tbody>
            </table>
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