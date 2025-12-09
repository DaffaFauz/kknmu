<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjukanPendaftaran"
                <?= (isset($data['pendaftaran']['status_pendaftaran']) && ($data['pendaftaran']['status_pendaftaran'] == 'Diverifikasi Kaprodi' || $data['pendaftaran']['status_pendaftaran'] == 'Revisi')) ? '' : 'disabled' ?>><i
                    class="icon-base ti tabler-cloud-upload icon-20px me-2"></i> Ajukan
                pendaftaran
                KKN</button>
        </div>
    </div>
    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible" role="alert">
            <i class="icon-base ti tabler-alert-circle"></i>
            <strong><?= $_SESSION['msg'] ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['msg']); endif; ?>
    <div class="row g-6">
        <!-- Card Border Shadow -->
        <div class="col-lg-6 col-sm-6">
            <div
                class="card card-border-shadow-<?= $data['pendaftaran']['status_pendaftaran'] == 'Ditolak' ? 'danger' : ($data['pendaftaran']['status_pendaftaran'] == 'Pending' || $data['pendaftaran']['status_pendaftaran'] == 'Revisi' || $data['pendaftaran']['status_pendaftaran'] == 'Diverifikasi Kaprodi' ? 'warning' : 'success') ?> h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span
                                class="avatar-initial rounded bg-label-<?= $data['pendaftaran']['status_pendaftaran'] == 'Ditolak' ? 'danger' : ($data['pendaftaran']['status_pendaftaran'] == 'Pending' || $data['pendaftaran']['status_pendaftaran'] == 'Revisi' || $data['pendaftaran']['status_pendaftaran'] == 'Diverifikasi Kaprodi' ? 'warning' : 'success') ?>"><i
                                    class="icon-base ti tabler-<?= ($data['pendaftaran']['status_pendaftaran'] == 'Pending' ? 'progress-help' : ($data['pendaftaran']['status_pendaftaran'] == 'Diverifikasi Kaprodi' || $data['pendaftaran']['status_pendaftaran'] == 'Revisi' || $data['pendaftaran']['status_pendaftaran'] == 'Ditolak' ? 'progress-alert' : 'progress-check')) ?> icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0"><?= htmlspecialchars($data['pendaftaran']['status_pendaftaran']) ?></h4>
                        <?php if (htmlspecialchars($data['pendaftaran']['status_pendaftaran']) == 'Ditolak'): ?>
                            <button type="button" class="btn btn-sm btn-outline-danger d-flex ms-auto"
                                data-bs-toggle="modal" data-bs-target="#modalcatatanTolak"><i
                                    class="icon-base ti tabler-eye me-2"></i>Lihat Detail
                                Catatan</button>
                        <?php endif; ?>
                    </div>
                    <p class="mb-1">Status Pendaftaran:
                        <?php
                        if ($data['pendaftaran']['status_pendaftaran'] == 'Pending') {
                            echo 'Menunggu verifikasi dari Kaprodi';
                        } elseif ($data['pendaftaran']['status_pendaftaran'] == 'Diverifikasi Kaprodi') {
                            if ($data['pendaftaran']['bukti_pembayaran'] != null) {
                                echo 'Tunggu verifikasi dari Admin';
                            } else {
                                echo 'Diverifikasi oleh Kaprodi, Silahkan untuk melakukan pengajuan pendaftaran KKN.';
                            }
                        } elseif ($data['pendaftaran']['status_pendaftaran'] == 'Ditolak') {
                            echo 'Pengajuan ditolak, Anda dapat mengajukan lagi tahun depan';
                        } elseif ($data['pendaftaran']['status_pendaftaran'] == 'Revisi') {
                            echo 'Bukti pembayaran tidak valid, Silahkan untuk melakukan pengajuan ulang.';
                        } else {
                            echo 'Diterima';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="icon-base ti tabler-user icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">Dosen Pembimbing</h4>
                    </div>
                    <p class="mb-1">
                        <?= isset($data['plotting']['nama_dosen2']) ? '1. ' : '' ?>
                        <?= isset($data['plotting']['nama_dosen1']) ? htmlspecialchars($data['plotting']['nama_dosen1']) : '-' ?>
                    </p>
                    <?php if (!empty($data['plotting']['nama_dosen2'])): ?>
                        <p class="mb-1">
                            2. <?= htmlspecialchars($data['plotting']['nama_dosen2']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->

        <!-- Laporan harian kelompok Table -->
        <div class="col-12 order-5">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Laporan Harian Kelompok</h5>
                    </div>
                </div>
                <div class="card-datatable border-top">
                    <table class="dt-route-vehicles table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kelompok</th>
                                <th>Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2025-12-05</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <button class="btn btn-sm text-white btn-icon btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ On route vehicles Table -->
    </div>
</div>
<!-- / Content -->

<!-- Modal untuk pengajuan pendaftaran KKN -->
<div class="modal fade" id="modalAjukanPendaftaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajukan Pendaftaran KKN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form
                    action="<?= BASE_URL . '/Pendaftaran/ajukan/' . htmlspecialchars($data['pendaftaran']['id_pendaftaran']) ?>"
                    method="post" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="nama">Upload bukti pembayaran</label>
                            <input type="file" class="form-control" id="nama" name="bukti_pembayaran"
                                value="<?= $_SESSION['nama'] ?>" readonly>
                            <span class="form-text">Format file: .jpg, .jpeg, .png dan ukuran maksimal 5MB</span>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">Ajukan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk melihat catatan penolakan -->
<div class="modal fade" id="modalcatatanTolak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Catatan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" readonly
                    disabled><?= htmlspecialchars($data['pendaftaran']['catatan']) ?></textarea>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>