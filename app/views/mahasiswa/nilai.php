<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk nilai mahasiswa -->
    <div class="col-lg-6 col-sm-6">
        <div class="card card-border-shadow-success h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-success"><i
                                class="icon-base ti tabler-file-analytics icon-28px"></i></span>
                    </div>
                    <h4 class="mb-0">Nilai akhir:
                        <?= ($data['nilai'] && $data['nilai_lengkap']) ? htmlspecialchars($data['nilai']['n_rata_rata']) . '(' . htmlspecialchars($data['nilai']['indeks']) . ')' : 'Belum ada nilai, Mohon tunggu.' ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>