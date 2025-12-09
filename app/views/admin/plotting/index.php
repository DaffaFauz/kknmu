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
            <form action="<?= BASE_URL ?>/Plotting/filter" method="POST">
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
                    <div class="col-md-4">
                        <label class="form-label" for="desa">Desa</label>
                        <select name="desa" id="desa" class="form-select">
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
            <h5 class="card-title mb-0">Plotting Kelompok</h5>
            <a href="<?= BASE_URL ?>/Plotting/create" class="btn btn-primary ps-2">
                <i class="ti tabler-plus me-1"></i> Plotting Kelompok
            </a>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelompok</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['detail_kelompok'] as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_kelompok']); ?></td>
                            <td><?= htmlspecialchars($row['nama_desa']); ?></td>
                            <td><?= htmlspecialchars($row['nama_kecamatan']); ?></td>
                            <td><?= htmlspecialchars($row['nama_kabupaten']); ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>/Plotting/show/<?= htmlspecialchars($row['id']) ?>"
                                    class="btn btn-info"><i class="ti tabler-eye me-1"></i> Detail</a>
                                <a href="<?= BASE_URL ?>/Plotting/edit/<?= htmlspecialchars($row['id']) ?>"
                                    class="btn btn-warning"><i class="ti tabler-pencil me-1"></i> Edit</a>
                                <form class="d-inline"
                                    action="<?= BASE_URL ?>/Plotting/delete/<?= htmlspecialchars($row['id']) ?>"
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