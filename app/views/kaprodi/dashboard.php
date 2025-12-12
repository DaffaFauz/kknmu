<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <!-- Card Border Shadow -->
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="fas fa-user-graduate"></i></span>
                        </div>
                        <h4 class="mb-0"><?= htmlspecialchars(count($data['mahasiswaDaftar'])) ?></h4>
                    </div>
                    <p class="mb-1">Jumlah Mahasiswa <?= $data['mahasiswaDaftar'][0]['nama_prodi'] ?> yang mengajukan
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="icon-base ti tabler-user icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0"><?= htmlspecialchars(count($data['mahasiswaVerif'])) ?></h4>
                    </div>
                    <p class="mb-1">Jumlah Mahasiswa yang sudah diverifikasi kaprodi</p>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->

        <!-- Kegiatan Mahasiswa terbaru Table -->
        <div class="col-12 order-5">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Mahasiswa yang belum diverifikasi kaprodi
                            <?= $data['mahasiswa'][0]['nama_prodi'] ?>
                        </h5>
                    </div>
                </div>
                <div class="card-datatable border-top">
                    <div class="table-responsive">
                        <table class="dt-route-vehicles table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['mahasiswa']):
                                    $no = 1;
                                    foreach ($data['mahasiswa'] as $mahasiswa): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($mahasiswa['nim']) ?></td>
                                            <td><?= htmlspecialchars($mahasiswa['nama_mahasiswa']) ?></td>
                                            <td><?= htmlspecialchars($mahasiswa['jenis_kelamin']) ?></td>
                                            <td>
                                                <form class="d-inline"
                                                    action="<?= BASE_URL ?>/Verifikasi/verifikasi/<?= htmlspecialchars($mahasiswa['id_pendaftaran']) ?>"
                                                    method="post">
                                                    <button type="submit" class="btn btn-success"
                                                        onClick="return confirm('Verifikasi mahasiswa ini?')"><i
                                                            class="ti tabler-check me-1"></i>
                                                        Verifikasi
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#ubahPendaftaran<?= htmlspecialchars($mahasiswa['id_pendaftaran']) ?>"><i
                                                        class="ti tabler-x me-1"></i> Tolak</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ On route vehicles Table -->
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
                                <button type="submit" class="btn btn-danger me-2"><i
                                        class="ti tabler-x me-1"></i>Tolak</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- / Content -->