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
            <h5 class="card-title mb-0">Laporan Akhir</h5>
        </div>
        <?php if (!$data['laporan_akhir'] && $_SESSION['role'] == 'Mahasiswa'): ?>
            <form action="<?= BASE_URL ?>/Laporan/createAkhir" method="post" enctype="multipart/form-data" class="my-2">
                <input type="hidden" name="id_kelompok"
                    value="<?= isset($_SESSION['id_kelompok']) ? $_SESSION['id_kelompok'] : null ?>">
                <div class="row mx-auto">
                    <div class="col-lg-6 col-md-12">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" />
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="link" class="form-label">Link Video</label>
                        <input type="text" class="form-control" id="link" name="link" />
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="laporan_akhir" class="form-label">Laporan Akhir</label>
                        <input type="file" class="form-control" id="laporan_akhir" name="laporan_akhir" />
                        <small class="form-text text-muted">File format harus .docx dan ukuran maksimal 10MB</small>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="jurnal" class="form-label">Jurnal</label>
                        <input type="file" class="form-control" id="jurnal" name="jurnal" />
                        <small class="form-text text-muted">File format harus .docx dan ukuran maksimal 10MB</small>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="produk_unggulan" class="form-label">Foto Produk Unggulan</label>
                        <input type="file" class="form-control" id="produk_unggulan" name="produk_unggulan" />
                        <small class="form-text text-muted">Format file harus .jpg, .png, .jpeg dan ukuran maksimal
                            5MB</small>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="dokumentasi" class="form-label">Foto Dokumentasi</label>
                        <input type="file" class="form-control" id="dokumentasi" name="dokumentasi" />
                        <small class="form-text text-muted">Format file harus .jpg, .png, .jpeg dan ukuran maksimal
                            5MB</small>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary m-2">Unggah</button>
            </form>
        <?php elseif ($data['laporan_akhir'] && $_SESSION['role'] == 'Mahasiswa'): ?>
            <form action="<?= BASE_URL ?>/Laporan/updateAkhir/<?= $data['laporan_akhir'][0]['id_laporan'] ?>" method="post"
                class="m-2" enctype="multipart/form-data">
                <input type="hidden" name="id_kelompok"
                    value="<?= isset($_SESSION['id_kelompok']) ? $_SESSION['id_kelompok'] : null ?>">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="<?= htmlspecialchars($data['laporan_akhir'][0]['judul']) ?>" />
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="link" class="form-label">Link Video</label>
                        <input type="text" class="form-control" id="link" name="link"
                            value="<?= htmlspecialchars($data['laporan_akhir'][0]['link_video']) ?>" />
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
                        <label for="laporan_akhir" class="form-label">Laporan Akhir</label>
                        <br>
                        <a href="<?= ASSETS_URL ?>dokumen/LaporanAkhir/<?= $data['laporan_akhir'][0]['dokumen_laporan'] ?>"
                            download><i class="ti tabler-file-type-docx"></i> Unduh dokumen</a>
                        <input type="file" class="form-control mt-2" id="laporan_akhir" name="laporan_akhir" />
                        <small class="form-text text-muted">File format harus .docx dan ukuran maksimal 10MB</small>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
                        <label for="jurnal" class="form-label">Jurnal</label>
                        <br>
                        <a href="<?= ASSETS_URL ?>dokumen/Jurnal/<?= $data['laporan_akhir'][0]['dokumen_jurnal'] ?>"
                            download><i class="ti tabler-file-type-docx"></i> Unduh dokumen</a>
                        <input type="file" class="form-control mt-2" id="jurnal" name="jurnal" />
                        <small class="form-text text-muted">File format harus .docx dan ukuran maksimal 10MB</small>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
                        <label for="produk_unggulan" class="form-label">Foto Produk Unggulan</label>
                        <br>
                        <a href="<?= ASSETS_URL ?>img/laporanAkhir/<?= $data['laporan_akhir'][0]['produk_unggulan'] ?>"
                            target="_blank"><i class="ti tabler-eye"></i> Lihat gambar</a>
                        <input type="file" class="form-control mt-2" id="produk_unggulan" name="produk_unggulan" />
                        <small class="form-text text-muted">Format file harus .jpg, .png, .jpeg dan ukuran maksimal
                            5MB</small>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
                        <label for="dokumentasi" class="form-label">Foto Dokumentasi</label>
                        <br>
                        <a href="<?= ASSETS_URL ?>img/laporanAkhir/<?= $data['laporan_akhir'][0]['dokumentasi'] ?>"
                            target="_blank"><i class="ti tabler-eye"></i> Lihat gambar</a>
                        <input type="file" class="form-control mt-2" id="dokumentasi" name="dokumentasi" />
                        <small class="form-text text-muted">Format file harus .jpg, .png, .jpeg dan ukuran maksimal
                            5MB</small>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-6 col-md-12">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" <?= $_SESSION['role'] == 'Mahasiswa' || $_SESSION['role'] == 'Pembimbing' ? 'readonly disabled' : '' ?>><?= $data['laporan_akhir'][0]['catatan'] ? htmlspecialchars($data['laporan_akhir'][0]['catatan']) : 'Belum ada catatan' ?></textarea>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="catatan" class="form-label">Status unggahan: </label>
                        <br>
                        <span
                            class="text-<?= $data['laporan_akhir'][0]['status_verifikasi'] == 'Pending' || $data['laporan_akhir'][0]['status_verifikasi'] == 'Revisi' ? 'warning' : 'success' ?>">
                            <?= $data['laporan_akhir'][0]['status_verifikasi'] ? htmlspecialchars($data['laporan_akhir'][0]['status_verifikasi']) : 'Belum ada catatan' ?>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Unggah</button>
            </form>
        <?php elseif (!$data['laporan_akhir'] && $_SESSION['role'] == 'Pembimbing'): ?>
            <h5 class="text-center m-6 text-muted">Mahasiswa belum mengunggah laporan akhir</h5>
        <?php elseif ($data['laporan_akhir'] && $_SESSION['role'] == 'Pembimbing'): ?>
            <div class="row m-2">
                <div class="col-12 mb-2">
                    <label for="judul" class="form-label">Judul:</label>
                    <br>
                    <span class="text-black"><?= htmlspecialchars($data['laporan_akhir'][0]['judul']) ?></span>
                </div>
                <div class="col-12 mb-2">
                    <label for="link" class="form-label">Link Video:</label>
                    <br>
                    <span class="text-black"><a
                            href="<?= htmlspecialchars($data['laporan_akhir'][0]['link_video']) ?>"><?= htmlspecialchars($data['laporan_akhir'][0]['link_video']) ?></a></span>
                </div>
            </div>
            <div class="row m-2">
                <label for="dokumen">Dokumen:</label>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <a href="<?= ASSETS_URL ?>dokumen/LaporanAkhir/<?= $data['laporan_akhir'][0]['dokumen_laporan'] ?>"
                        download><i class="ti tabler-file-type-docx"></i> Unduh dokumen laporan</a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <a href="<?= ASSETS_URL ?>dokumen/Jurnal/<?= $data['laporan_akhir'][0]['dokumen_jurnal'] ?>" download><i
                            class="ti tabler-file-type-docx"></i> Unduh dokumen jurnal</a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <a href="<?= ASSETS_URL ?>img/laporanAkhir/<?= $data['laporan_akhir'][0]['produk_unggulan'] ?>"
                        target="_blank"><i class="ti tabler-eye"></i> Lihat produk unggulan</a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <a href="<?= ASSETS_URL ?>img/laporanAkhir/<?= $data['laporan_akhir'][0]['dokumentasi'] ?>"
                        target="_blank"><i class="ti tabler-eye"></i> Lihat dokumentasi</a>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-lg-6 col-md-12">
                    <label for="catatan" class="form-label">Status unggahan: </label>
                    <br>
                    <span
                        class="text-<?= $data['laporan_akhir'][0]['status_verifikasi'] == 'Pending' || $data['laporan_akhir'][0]['status_verifikasi'] == 'Revisi' ? 'warning' : 'success' ?>">
                        <?= $data['laporan_akhir'][0]['status_verifikasi'] ? htmlspecialchars($data['laporan_akhir'][0]['status_verifikasi']) : 'Belum ada catatan' ?>
                    </span>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" <?= $_SESSION['role'] == 'Mahasiswa' || $_SESSION['role'] == 'Pembimbing' ? 'readonly disabled' : '' ?>><?= $data['laporan_akhir'][0]['catatan'] ? htmlspecialchars($data['laporan_akhir'][0]['catatan']) : 'Belum ada catatan' ?></textarea>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!--/ Complex Headers -->
</div>