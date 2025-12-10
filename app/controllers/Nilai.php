<?php
class Nilai extends Controller
{
    public function index()
    {
        if ($_SESSION['role'] == 'Admin') {
            // Get data 
            $kelompok = $this->model('NilaiModel')->getKelompok();
            $kabupaten = $this->model('LokasiModel')->getKabupaten();

            // Load view
            $this->view('layout/head', ['title' => 'Nilai', 'page' => 'Nilai']);
            $this->view('layout/sidebar', ['page' => 'Nilai']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/nilai/index', ['kelompok' => $kelompok, 'kabupaten' => $kabupaten]);
            $this->view('layout/footer', ['page' => 'Nilai']);
        }
    }

    public function update($id)
    {
        if ($this->model('NilaiModel')->update($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Nilai/show/' . $_POST['id_kelompok'], 'Berhasil mengubah nilai', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Nilai/show/' . $_POST['id_kelompok'], 'Gagal mengubah nilai', 'danger');
        }
    }

    public function filter()
    {
        $kelompok = $_POST['kabupaten'];
        $kecamatan = $_POST['kecamatan'];
        $desa = $_POST['desa'];

        $kelompok = $this->model('NilaiModel')->filter($kelompok, $kecamatan, $desa);
        $kabupaten = $this->model('LokasiModel')->getKabupaten();

        // Load view
        $this->view('layout/head', ['title' => 'Nilai', 'page' => 'Nilai']);
        $this->view('layout/sidebar', ['page' => 'Nilai']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/nilai/index', ['kelompok' => $kelompok, 'kabupaten' => $kabupaten]);
        $this->view('layout/footer', ['page' => 'Nilai']);
    }

    public function show($id)
    {
        // Get data mahasiswa for selected kelompok
        $mahasiswa = $this->model('NilaiModel')->detail($id);
        $token = $this->model('TokenModel')->getToken($id);

        // Load view
        $this->view('layout/head', ['title' => 'Nilai', 'page' => 'Nilai']);
        $this->view('layout/sidebar', ['page' => 'Nilai']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/nilai/detail', ['mahasiswa' => $mahasiswa, 'token' => $token]);
        $this->view('layout/footer', ['page' => 'Nilai']);
    }
}