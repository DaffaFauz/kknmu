<?php

class Laporan extends Controller
{
    public function harian()
    {
        if ($_SESSION['role'] == 'Mahasiswa') {
            // Get data
            $laporan = $this->model('LaporanModel')->getLaporanHarianForMahasiswaAndPembimbing($_SESSION['id_kelompok']);

            // Load view
            $this->view('layout/head', ['title' => "Laporan Harian", "page" => 'Laporan']);
            $this->view('layout/sidebar', ['page' => 'Laporan Harian', 'role' => $_SESSION['role']]);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('mahasiswa/laporan_harian', ['laporan' => $laporan]);
            $this->view("layout/footer", ['page' => 'Laporan']);
        } else if ($_SESSION['role'] == 'Pembimbing') {
            // Get data
            $laporan = $this->model('LaporanModel')->getLaporanHarianForMahasiswaAndPembimbing($_SESSION['id_kelompok']);

            // Load view
            $this->view('layout/head', ['title' => "Laporan Harian", "page" => 'Laporan']);
            $this->view('layout/sidebar', ['page' => 'Laporan Harian', 'role' => $_SESSION['role']]);
            exit;
        }



    }

    public function createHarian()
    {
        // Validasi apakah kelompok benar-benar ada di database
        $kelompok = $this->model('KelompokModel')->getById($_SESSION['id_kelompok']);
        if (!$kelompok) {
            redirectWithMsg('Laporan/harian', 'Data kelompok tidak valid atau tidak ditemukan! Silahkan hubungi admin.', 'danger');
            exit;
        }

        // Validasi input
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $tanggal = $_POST['tanggal'];

        if (empty($judul) || empty($deskripsi) || empty($tanggal)) {
            redirectWithMsg('Laporan/harian', 'Judul, deskripsi, dan tanggal harus diisi!', 'danger');
            exit;
        }

        // Validasi file
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        if ($file_error === 4) {
            redirectWithMsg('Laporan/harian', 'File harus diupload!', 'danger');
            exit;
        }

        if ($file_size > 2000000) {
            redirectWithMsg('Laporan/harian', 'File tidak boleh lebih dari 2MB!', 'danger');
            exit;
        }

        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_ext = array('jpg', 'jpeg', 'png');

        if (!in_array($file_ext, $allowed_ext)) {
            redirectWithMsg('Laporan/harian', 'File harus berekstensi .jpg, .jpeg, .png!', 'danger');
            exit;
        }

        // Buat folder dokumentasi untuk laporan harian jika folder belum ada
        $folder = __DIR__ . '/../../public/assets/img/dokumentasi';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload file
        $file_name_new = uniqid('', true) . '.' . $file_ext;
        move_uploaded_file($file_tmp_name, 'assets/img/dokumentasi/' . $file_name_new);

        // Simpan data ke database
        $data = array(
            'id_kelompok' => $_SESSION['id_kelompok'],
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'tanggal' => $tanggal,
            'file' => $file_name_new
        );

        $this->model('LaporanModel')->createHarian($data);

        redirectWithMsg('Laporan/harian', 'Laporan harian berhasil dibuat!', 'success');
        exit;
    }


    public function akhir()
    {

    }

    public function nilai()
    {

    }
}