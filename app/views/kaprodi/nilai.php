<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tombol kembali -->
    <?php if ($_SESSION['role'] == 'Admin'): ?>
        <a href="<?= BASE_URL ?>/Nilai" class="btn btn-secondary mb-4">
            <i class="ti tabler-arrow-left me-1"></i> Kembali
        </a>
    <?php endif; ?>

    <!-- Mahasiswa prodi Table -->
    <div class="col-12 order-5 mt-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Nilai Mahasiswa</h5>
                </div>
            </div>
            <div class="card-datatable border-top m-2">
                <table class="dt-route-vehicles table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Nilai Akhir</th>
                            <th>Indeks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data['mahasiswa'] as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nim'] ?></td>
                                <td><?= $row['nama_mahasiswa'] ?></td>
                                <td><?= $row['n_rata_rata'] ? htmlspecialchars($row['n_rata_rata']) : '-' ?></td>
                                <td><?= $row['indeks'] ? htmlspecialchars($row['indeks']) : '-' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ On route vehicles Table -->
</div>
<!-- / Content -->