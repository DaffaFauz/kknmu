<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk filter laporan harian berdasarkan tanggal -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center">
                    <i class="ti tabler-filter me-1"></i>
                    <h5 class="card-title mb-0">Filter Laporan Harian</h5>
                </div>
            </div>
            <form action="<?= BASE_URL ?>/Laporan/filterHarian/<?= $data['id_laporan'] ?? '' ?>" method="post">
                <div class="row g-3">
                    <div class="col-md-6 col-12 mb-6">
                        <label for="flatpickr-date" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="flatpickr-date" />
                    </div>
                    <div class="col-md-6 align-self-center d-flex">
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
            <h5 class="card-title mb-0">Laporan Harian</h5>
            <button type="button" class="btn btn-primary ps-2" data-bs-toggle="modal"
                data-bs-target="#tambahLaporanHarian" <?= !isset($_SESSION['id_kelompok']) ? 'disabled' : '' ?>>
                <i class="ti tabler-plus me-1"></i> Tambah Laporan Harian
            </button>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['laporan'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['tanggal']); ?></td>
                            <td><?= htmlspecialchars($row['judul']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubahLaporan<?= htmlspecialchars($row['id_laporan']) ?>"><i
                                        class="ti tabler-pencil me-1"></i> Edit</button>
                                <form class="d-inline"
                                    action="<?= BASE_URL ?>/Laporan/deleteHarian/<?= htmlspecialchars($row['id_laporan']) ?>"
                                    method="post">
                                    <button type="submit" class="btn btn-danger"
                                        onClick="return confirm('Yakin ingin menghapus Laporan ini?')"><i
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

<!-- Modal tambah Laporan Harian -->
<div class="modal fade" id="tambahLaporanHarian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Tambah Laporan Harian</h4>
                </div>
                <form id="tambahLaporanHarianForm" class="row g-6" action="<?= BASE_URL ?>/Laporan/createHarian"
                    method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_kelompok"
                        value="<?= isset($_SESSION['id_kelompok']) ? $_SESSION['id_kelompok'] : null ?>">
                    <div class="col-12">
                        <label for="flatpickr-date-modal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="flatpickr-date-modal"
                            name="tanggal" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahLaporanHarian">Judul</label>
                        <input type="text" id="modalTambahLaporanHarian" name="judul" class="form-control"
                            placeholder="Judul" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahLaporanHarian">Deskripsi</label>
                        <div id="full-editor" style="min-height: 150px;"></div>
                        <input type="hidden" name="deskripsi" id="deskripsi">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTambahLaporanHarian">Dokumentasi</label>
                        <input type="file" id="modalTambahLaporanHarian" name="file" class="form-control" required />
                        <small class="form-text text-muted">File harus berupa gambar (jpg, png, jpeg) dengan ukuran
                            maksimal 2MB</small>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Flatpickr
        flatpickr("#flatpickr-date", {
            enableTime: false,
            dateFormat: "Y-m-d",
            locale: "id",
        });

        flatpickr("#flatpickr-date-modal", {
            enableTime: false,
            dateFormat: "Y-m-d",
            locale: "id",
            static: true
        });

        // Initialize Quill editor
        const fullToolbar = [
            [
                { font: [] },
                { size: [] }
            ],
            ['bold', 'italic', 'underline', 'strike'],
            [
                { color: [] },
                { background: [] }
            ],
            [
                { script: 'super' },
                { script: 'sub' }
            ],
            [
                { header: '1' },
                { header: '2' },
                'blockquote',
                'code-block'
            ],
            [
                { list: 'ordered' },
                { list: 'bullet' },
                { indent: '-1' },
                { indent: '+1' }
            ],
            [{ direction: 'rtl' }, { align: [] }],
            ['link', 'image', 'video', 'formula'],
            ['clean']
        ];

        const fullEditor = new Quill('#full-editor', {
            bounds: '#full-editor',
            placeholder: 'Tulis deskripsi laporan...',
            modules: {
                syntax: true,
                toolbar: fullToolbar
            },
            theme: 'snow'
        });

        // Form submission handler
        var form = document.getElementById('tambahLaporanHarianForm');
        form.addEventListener('submit', function (e) {
            // Get content from Quill editor
            var editorContent = document.querySelector('#full-editor .ql-editor').innerHTML;
            document.getElementById('deskripsi').value = editorContent;
        });
    });
</script>

<!-- Modal edit Laporan -->
<?php foreach ($data['laporan'] as $row): ?>
    <div class="modal fade" id="ubahLaporan<?= $row['id_laporan'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Ubah Laporan Harian</h4>
                    </div>
                    <form id="ubahLaporanForm<?= $row['id_laporan'] ?>" class="row g-6"
                        action="<?= BASE_URL ?>/Laporan/updateHarian/<?= $row['id_laporan'] ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="col-12">
                            <label class="form-label" for="modalUbahLaporan">Tanggal</label>
                            <input type="text" id="modalUbahLaporan" name="tanggal" class="form-control"
                                placeholder="Tanggal" value="<?= $row['tanggal'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahLaporan">Judul</label>
                            <input type="text" id="modalUbahLaporan" name="judul" class="form-control" placeholder="Judul"
                                value="<?= $row['judul'] ?>" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahLaporan">Deskripsi</label>
                            <textarea name="deskripsi" id="modalUbahLaporan" class="form-control"
                                required><?= $row['deskripsi'] ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalUbahLaporan">Dokumentasi</label>
                            <input type="file" id="modalUbahLaporan" name="file" class="form-control" />
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