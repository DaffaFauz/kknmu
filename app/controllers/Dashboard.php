<?php

class Dashboard extends Controller
{
    public function index()
    {
        if ($_SESSION['role'] == 'Admin') {
            // Get data
            $tahun = $this->model("TahunAkademikModel")->GetTahunActive();
            $laporan = $this->model("DashboardModel")->getLaporanHarianTerbaru($tahun['id_tahun']);
            $pembimbing = count($this->model("PembimbingModel")->getAll());
            $kelompok = count($this->model("PlottingModel")->getAll());
            $mahasiswa = count($this->model("MahasiswaModel")->getAll());
            $lokasi = count($this->model("LokasiModel")->getAll());

            // Load view
            $this->view("layout/head", ['title' => 'Dashboard Admin', 'page' => 'Dashboard']);
            $this->view("layout/sidebar", ['page' => 'Dashboard']);
            $this->view("layout/navbar", ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/dashboard', ['laporan' => $laporan, 'pembimbing' => $pembimbing, 'kelompok' => $kelompok, 'mahasiswa' => $mahasiswa, 'lokasi' => $lokasi]);
            $this->view("layout/footer", ['page' => 'Dashboard']);
        } else if ($_SESSION['role'] == 'Mahasiswa') {
            // Get data from database
            $pendaftaran = $this->model("DashboardModel")->getPendaftaranMahasiswa($_SESSION['id_mahasiswa']);
            $plotting = $this->model("DashboardModel")->getPlottingKelompok($_SESSION['id_kelompok']);

            // Load view
            $this->view('layout/head', ['title' => "Dashboard Mahasiswa", "page" => 'Dashboard']);
            $this->view('layout/sidebar', ['page' => 'Dashboard']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('mahasiswa/dashboard', ['pendaftaran' => $pendaftaran, 'plotting' => $plotting]);
            $this->view("layout/footer", ['page' => 'Dashboard']);
        } else if ($_SESSION['role'] == 'Kaprodi') {
            // Get data
            $mahasiswa = $this->model("VerifikasiModel")->getForKaprodi($_SESSION['id_prodi']);
            $mahasiswaDaftar = $this->model("PendaftaranModel")->getForKaprodi($_SESSION['id_prodi']);
            $mahasiswaVerif = $this->model("VerifikasiModel")->getVerifMahasiswaProdi($_SESSION['id_prodi']);

            // Load view
            $this->view('layout/head', ['title' => "Dashboard Mahasiswa", "page" => 'Dashboard']);
            $this->view('layout/sidebar', ['page' => 'Dashboard']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('kaprodi/dashboard', ['mahasiswa' => $mahasiswa, 'mahasiswaDaftar' => $mahasiswaDaftar, 'mahasiswaVerif' => $mahasiswaVerif]);
            $this->view("layout/footer", ['page' => 'Dashboard']);
        } else if ($_SESSION['role'] == 'Pembimbing') {
            // Get data
            if (!empty($_SESSION['id_kelompok'])) {
                $laporan = $this->model('LaporanModel')->getLaporanHarianForMahasiswaAndPembimbing($_SESSION['id_kelompok']);
                $detail_kelompok = $this->model('PlottingModel')->getDetailKelompok($_SESSION['id_kelompok']);
            } else {
                $laporan = [];
                $detail_kelompok = [];
            }


            // Load view
            $this->view('layout/head', ['title' => "Dashboard Pembimbing", "page" => 'Dashboard']);
            $this->view('layout/sidebar', ['page' => 'Dashboard']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('pembimbing/dashboard', ['laporan' => $laporan, 'anggota_kelompok' => $detail_kelompok]);
            $this->view("layout/footer", ['page' => 'Dashboard']);
        }
    }
}