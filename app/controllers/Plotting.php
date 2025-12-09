<?php
class Plotting extends Controller
{
    public function index()
    {
        // Get data 
        $detail_kelompok = $this->model('PlottingModel')->getAll();
        $kabupaten = $this->model("LokasiModel")->getKabupaten();

        // Load view
        $this->view('layout/head', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/sidebar', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/plotting/index', ['detail_kelompok' => $detail_kelompok, 'kabupaten' => $kabupaten]);
        $this->view('layout/footer', ['page' => 'Plotting']);
    }

    public function filter()
    {
        $filters = [
            'kabupaten' => $_POST['kabupaten'] ?? null,
            'kecamatan' => $_POST['kecamatan'] ?? null,
            'desa' => $_POST['desa'] ?? null
        ];

        // Get filtered data
        $detail_kelompok = $this->model('PlottingModel')->getFiltered($filters);
        $kabupaten = $this->model("LokasiModel")->getKabupaten();

        // Also get kecamatan and desa options if selected, to repopulate the selects
        $kecamatan = [];
        $desa = [];

        if (!empty($filters['kabupaten'])) {
            $kecamatan = $this->model('LokasiModel')->getKecamatan($filters['kabupaten']);
        }

        if (!empty($filters['kecamatan'])) {
            $desa = $this->model('LokasiModel')->getDesa($filters['kecamatan']);
        }

        // Load view
        $this->view('layout/head', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/sidebar', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/plotting/index', [
            'detail_kelompok' => $detail_kelompok,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa
        ]);
        $this->view('layout/footer', ['page' => 'Plotting']);
    }

    public function create()
    {
        // Get Active Year
        $tahun_aktif = $this->model('TahunAkademikModel')->GetTahunActive();

        // Get data kelompok, pembimbing, mahasiswa yang sudah di verifikasi admin
        $kelompok = $this->model('KelompokModel')->getForPlotting();
        $pembimbing = $this->model('PembimbingModel')->getForPlotting($tahun_aktif);
        $mahasiswa = $this->model('MahasiswaModel')->getMahasiswaForPlotting($tahun_aktif);
        $kabupaten = $this->model('LokasiModel')->getKabupaten();

        // Load view
        $this->view('layout/head', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/sidebar', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/plotting/create', ['kelompok' => $kelompok, 'pembimbing' => $pembimbing, 'mahasiswa' => $mahasiswa, 'kabupaten' => $kabupaten, 'tahun' => $tahun_aktif]);
        $this->view('layout/footer', ['page' => 'Plotting']);
    }

    public function store()
    {
        $id_kelompok = $_POST['kelompok'];
        $id_lokasi = $_POST['desa'];
        $dosen1 = $_POST['dosen1'];
        $dosen2 = !empty($_POST['dosen2']) ? $_POST['dosen2'] : null;
        $mahasiswa_ids = $_POST['mahasiswa'] ?? [];

        $tahun = $_POST['id_tahun'];

        // Check if group is already plotted for this year
        $id_detail_kelompok = $this->model('PlottingModel')->getDetailKelompokId($id_kelompok, $tahun);

        if (!$id_detail_kelompok) {
            // Create new plotting entry
            $id_detail_kelompok = $this->model('PlottingModel')->createPlotting($id_kelompok, $id_lokasi, $dosen1, $dosen2, $tahun);
        }

        // Validation: Max 17 students
        $current_count = $this->model('PlottingModel')->countStudents($id_detail_kelompok);
        if ($current_count + count($mahasiswa_ids) > 17) {
            redirectWithMsg(BASE_URL . '/Plotting/create', 'Gagal! Maksimal 17 mahasiswa per kelompok.', 'danger');
            return;
        }

        // Update students
        $success_count = 0;
        foreach ($mahasiswa_ids as $id_mahasiswa) {
            if ($this->model('PlottingModel')->updateMahasiswaKelompok($id_mahasiswa, $id_detail_kelompok) > 0) {
                $success_count++;
            }
        }

        if ($success_count > 0) {
            redirectWithMsg(BASE_URL . '/Plotting', 'Berhasil plotting ' . $success_count . ' mahasiswa.', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Plotting', 'Data disimpan, tetapi tidak ada mahasiswa baru ditambahkan.', 'warning');
        }
    }

    public function getKecamatan($nama_kabupaten)
    {
        $nama_kabupaten = urldecode($nama_kabupaten);
        $kecamatan = $this->model('LokasiModel')->getKecamatan($nama_kabupaten);
        echo json_encode($kecamatan);
    }

    public function getDesa($nama_kecamatan)
    {
        $nama_kecamatan = urldecode($nama_kecamatan);
        $desa = $this->model('LokasiModel')->getDesa($nama_kecamatan);
        echo json_encode($desa);
    }

    public function edit($id)
    {
        // Get data detail kelompok
        $detail_kelompok = $this->model('PlottingModel')->getDetailKelompok($id);
        $tahun_aktif = $this->model('TahunAkademikModel')->GetTahunActive();

        // Get data for dropdowns (including current values)
        $kelompok = $this->model('KelompokModel')->getForPlottingEdit($detail_kelompok['id_kelompok']);
        $pembimbing = $this->model('PembimbingModel')->getAll();
        $mahasiswa = $this->model('MahasiswaModel')->getMahasiswaForPlottingEdit($tahun_aktif, $detail_kelompok['id']);

        $kabupaten = $this->model('LokasiModel')->getKabupaten();
        $kecamatan = $this->model('LokasiModel')->getKecamatan($detail_kelompok['nama_kabupaten']);
        $desa = $this->model('LokasiModel')->getDesa($detail_kelompok['nama_kecamatan']);

        // Extract student IDs for checking checkboxes
        $current_mahasiswa_ids = array_column($detail_kelompok['mahasiswa'], 'id_mahasiswa');
        $detail_kelompok['mahasiswa_ids'] = $current_mahasiswa_ids;

        // Load view
        $this->view('layout/head', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/sidebar', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/plotting/edit', [
            'detail_kelompok' => $detail_kelompok,
            'kelompok' => $kelompok,
            'pembimbing' => $pembimbing,
            'mahasiswa' => $mahasiswa,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa
        ]);
        $this->view('layout/footer', ['page' => 'Plotting']);
    }

    public function update($id)
    {
        $data = [
            'id_kelompok' => $_POST['kelompok'],
            'id_lokasi' => $_POST['desa'],
            'dosen1' => $_POST['dosen1'],
            'dosen2' => !empty($_POST['dosen2']) ? $_POST['dosen2'] : null,
            'id_tahun' => $_POST['id_tahun']
        ];

        $mahasiswa_ids = $_POST['mahasiswa'] ?? [];

        // Validation: Max 17 students
        if (count($mahasiswa_ids) > 17) {
            redirectWithMsg(BASE_URL . '/Plotting/edit/' . $id, 'Gagal! Maksimal 17 mahasiswa per kelompok.', 'danger');
            return;
        }

        // Update Full (Transactional)
        if ($this->model('PlottingModel')->updateFull($id, $data, $mahasiswa_ids)) {
            redirectWithMsg(BASE_URL . '/Plotting', 'Data plotting berhasil diperbarui.', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Plotting/edit/' . $id, 'Gagal memperbarui data plotting.', 'danger');
        }
    }

    public function destroy($id)
    {
        if ($this->model('PlottingModel')->destroy($id) > 0) {
            redirectWithMsg(BASE_URL . '/Plotting', 'Data berhasil dihapus.', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Plotting', 'Gagal menghapus data.', 'danger');
        }
    }

    public function show($id)
    {
        // Get data detail kelompok
        $detail_kelompok = $this->model('PlottingModel')->getDetailKelompok($id);

        // Load view
        if ($_SESSION['role'] == 'Admin') {
            $this->view('layout/head', ['title' => 'Plotting', 'page' => 'Plotting']);
        } else if ($_SESSION['role'] == 'Mahasiswa' || $_SESSION['role'] == 'Pembimbing') {
            $this->view('layout/head', ['title' => 'Detail Kelompok', 'page' => 'Plotting']);
        }
        $this->view('layout/sidebar', ['title' => 'Plotting', 'page' => 'Plotting']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/plotting/detail', ['detail_kelompok' => $detail_kelompok]);
        $this->view('layout/footer', ['page' => 'Plotting']);
    }
}