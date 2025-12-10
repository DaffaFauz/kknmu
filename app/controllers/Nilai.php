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
            $this->view('layout/head', ['title' => 'Nilai Mahasiswa', 'page' => 'Nilai']);
            $this->view('layout/sidebar', ['page' => 'Nilai']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/nilai/index', ['kelompok' => $kelompok, 'kabupaten' => $kabupaten]);
            $this->view('layout/footer', ['page' => 'Nilai']);
        } else if ($_SESSION['role'] == 'Penguji 1' || $_SESSION['role'] == 'Penguji 2') {
            // Get data Dosen untuk input nama penguji berdasarkan id
            $dosen = $this->model('DosenModel')->getAll();

            // Load view
            $this->view('penguji/nilai', ['dosen' => $dosen, 'role' => $_SESSION['role']]);

        } else if ($_SESSION['role'] == 'Pembimbing') {
            // Get data
            $mahasiswa = $this->model("NilaiModel")->detail($_SESSION['id_kelompok']);

            // Load view
            $this->view('layout/head', ['title' => 'Nilai Mahasiswa', 'page' => 'Nilai']);
            $this->view('layout/sidebar', ['page' => 'Nilai']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('pembimbing/nilai', ['mahasiswa' => $mahasiswa]);
            $this->view('layout/footer', ['page' => 'Nilai']);

        } else if ($_SESSION['role'] == 'Kaprodi') {
            // Get data mahasiswa 
            $mahasiswa = $this->model("NilaiModel")->getNilaiMahasiswaForKaprodi($_SESSION['id_prodi']);

            // Load view
            $this->view('layout/head', ['title' => 'Nilai Mahasiswa', 'page' => 'Nilai']);
            $this->view('layout/sidebar', ['page' => 'Nilai']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('kaprodi/nilai', ['mahasiswa' => $mahasiswa]);
            $this->view('layout/footer', ['page' => 'Nilai']);

        } else if ($_SESSION['role'] == 'Mahasiswa') {
            // Get data
            $nilai = $this->model("NilaiModel")->getNilaiMahasiswa($_SESSION['id_mahasiswa']);
            $nilaiLengkap = $this->model("NilaiModel")->isNilaiLengkap($nilai);

            // Load view
            $this->view('layout/head', ['title' => 'Nilai Mahasiswa', 'page' => 'Nilai']);
            $this->view('layout/sidebar', ['page' => 'Nilai']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view("mahasiswa/nilai", ['nilai' => $nilai, 'nilai_lengkap' => $nilaiLengkap]);
            $this->view('layout/footer', ['page' => 'Nilai']);
        }
    }

    public function update($id)
    {
        if ($_SESSION['role'] == 'Admin') {
            if ($this->model('NilaiModel')->update($id, $_POST) > 0) {
                redirectWithMsg(BASE_URL . '/Nilai/show/' . $_POST['id_kelompok'], 'Berhasil mengubah nilai', 'success');
            } else {
                redirectWithMsg(BASE_URL . '/Nilai/show/' . $_POST['id_kelompok'], 'Gagal mengubah nilai', 'danger');
            }
        } else if ($_SESSION['role'] == 'Pembimbing') {
            if ($this->model('NilaiModel')->update($id, $_POST) > 0) {
                redirectWithMsg(BASE_URL . '/Nilai', 'Berhasil memasukkan nilai', 'success');
            } else {
                redirectWithMsg(BASE_URL . '/Nilai', 'Gagal memasukkan nilai', 'danger');
            }
        } else if ($_SESSION['role'] == 'Penguji 1') {
            if ($this->model('NilaiModel')->update($id, $_POST) > 0) {
                redirectWithMsg(BASE_URL . '/Nilai', 'Berhasil memasukkan nilai', 'success');
            } else {
                redirectWithMsg(BASE_URL . '/Nilai', 'Gagal memasukkan nilai', 'danger');
            }
        } else if ($_SESSION['role'] == 'Penguji 2') {
            if ($this->model('NilaiModel')->update($id, $_POST) > 0) {
                redirectWithMsg(BASE_URL . '/Nilai', 'Berhasil memasukkan nilai', 'success');
            } else {
                redirectWithMsg(BASE_URL . '/Nilai', 'Gagal memasukkan nilai', 'danger');
            }
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
        if ($_SESSION['role'] == 'Admin') {
            $this->view('layout/head', ['title' => 'Nilai', 'page' => 'Nilai']);
            $this->view('layout/sidebar', ['page' => 'Nilai']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/nilai/detail', ['mahasiswa' => $mahasiswa, 'token' => $token]);
            $this->view('layout/footer', ['page' => 'Nilai']);
        }
    }
}