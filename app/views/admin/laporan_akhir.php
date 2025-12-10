<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter kelompok berdasarkan lokasi -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Kelompok</h5>
                </div>
            </div>
            <form action="<?= BASE_URL ?>/Laporan/filterAkhir" method="POST">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="kabupaten">Kabupaten</label>
                        <select name="kabupaten" id="kabupaten" class="form-select select2">
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
                        <select name="kecamatan" id="kecamatan" class="form-select select2">
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($data['kecamatan'] as $row): ?>
                                <option value="<?= $row['nama_kecamatan'] ?>" <?= !empty($_POST['kecamatan']) && $row['nama_kecamatan'] == $_POST['kecamatan'] ? 'selected' : '' ?>>
                                    <?= $row['nama_kecamatan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="desa">Desa</label>
                        <select name="desa" id="desa" class="form-select select2">
                            <option value="">Pilih Desa</option>
                            <?php foreach ($data['desa'] as $row): ?>
                                <option value="<?= $row['nama_desa'] ?>" <?= !empty($_POST['desa']) && $row['nama_desa'] == $_POST['desa'] ? 'selected' : '' ?>>
                                    <?= $row['nama_desa'] ?>
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
            <h5 class="card-title mb-0">Laporan Akhir</h5>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelompok</th>
                        <th>Lokasi</th>
                        <th>Judul</th>
                        <th class="w-25">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['laporan'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_kelompok']); ?></td>
                            <td><?= htmlspecialchars($row['nama_desa']) . ', ' . htmlspecialchars($row['nama_kecamatan']) . ', ' . htmlspecialchars($row['nama_kabupaten']); ?>
                            </td>
                            <td><?= htmlspecialchars(implode(' ', array_slice(explode(' ', $row['judul']), 0, 6)) . (str_word_count($row['judul']) > 6 ? '...' : '')); ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#detailLaporan<?= htmlspecialchars($row['id_laporan']) ?>"><i
                                        class="ti tabler-eye me-1"></i> Detail</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Complex Headers -->
</div>


<!-- Modal detail laporan harian nya -->
<?php foreach ($data['laporan'] as $row): ?>
    <div class="modal fade" id="detailLaporan<?= htmlspecialchars($row['id_laporan']) ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Detail Laporan Akhir Kelompok</h4>
                    </div>
                    <div class="row m-2">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label for="judul" class="form-label">Kelompok</label>
                            <br>
                            <span class="text-black"><?= htmlspecialchars($row['nama_kelompok']) ?></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label for="link" class="form-label">Lokasi</label>
                            <br>
                            <span
                                class="text-black"><?= htmlspecialchars($row['nama_desa']) . ', ' . htmlspecialchars($row['nama_kecamatan']) . ', ' . htmlspecialchars($row['nama_kabupaten']); ?></span>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-12 mb-2">
                            <label for="judul" class="form-label">Judul:</label>
                            <br>
                            <span class="text-black"><?= htmlspecialchars($row['judul']) ?></span>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="link" class="form-label">Link Video:</label>
                            <br>
                            <span class="text-black"><a
                                    href="<?= htmlspecialchars($row['link_video']) ?>"><?= htmlspecialchars($row['link_video']) ?></a></span>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label for="dokumen">Status Verifikasi :</label>
                            <br>
                            <span
                                class="text-<?= $row['status_verifikasi'] == 'Pending' || $row['status_verifikasi'] == 'Revisi' ? 'warning' : 'success' ?>"><?= htmlspecialchars($row['status_verifikasi']) ?></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                            <label for="catatan">Catatan :</label>
                            <br>
                            <textarea class="form-control"
                                disabled><?= $row['catatan'] ? htmlspecialchars($row['catatan']) : 'Tidak ada catatan' ?></textarea>
                        </div>
                    </div>
                    <div class="row m-2">
                        <label for="dokumen">Dokumen:</label>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                            <a href="<?= ASSETS_URL ?>dokumen/LaporanAkhir/<?= $row['dokumen_laporan'] ?>" download><i
                                    class="ti tabler-file-type-docx"></i> Unduh dokumen laporan</a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                            <a href="<?= ASSETS_URL ?>dokumen/Jurnal/<?= $row['dokumen_jurnal'] ?>" download><i
                                    class="ti tabler-file-type-docx"></i> Unduh dokumen jurnal</a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                            <a href="<?= ASSETS_URL ?>img/laporanAkhir/<?= $row['produk_unggulan'] ?>" target="_blank"><i
                                    class="ti tabler-eye"></i> Lihat produk unggulan</a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                            <a href="<?= ASSETS_URL ?>img/laporanAkhir/<?= $row['dokumentasi'] ?>" target="_blank"><i
                                    class="ti tabler-eye"></i> Lihat dokumentasi</a>
                        </div>
                    </div>
                    <div class="row mt-6">
                        <div class="col-12 justify-content-end d-flex">
                            <form action="<?= BASE_URL . '/Laporan/verifikasiLaporanAkhir/' . $row['id_laporan'] ?>"
                                method="post" class="me-2">
                                <button type="submit" class="btn btn-label-success">Verifikasi</button>
                            </form>
                            <button type="button" data-bs-toggle="modal"
                                data-bs-target="#revisiLaporan<?= htmlspecialchars($row['id_laporan']) ?>"
                                class="btn btn-label-warning me-2">Revisi</button>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-label-secondary">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal revisi laporan -->
<?php foreach ($data['laporan'] as $row): ?>
    <div class="modal fade" id="revisiLaporan<?= htmlspecialchars($row['id_laporan']) ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Revisi Laporan</h4>
                    </div>
                    <form action="<?= BASE_URL . '/Laporan/revisiLaporanAkhir/' . $row['id_laporan'] ?>" method="post">
                        <div class="row">
                            <div class="col-12">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                            </div>
                            <div class="col-12 mt-4 justify-content-end d-flex">
                                <button type="submit" class="btn btn-label-primary me-2">Kirim</button>
                                <button type="button" data-bs-dismiss="modal" class="btn btn-label-secondary">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>