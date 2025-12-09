<?php

class Dashboard extends Controller
{
    public function index()
    {
        if ($_SESSION['role'] == 'Admin') {
            // Get data
            $tahun = $this->model("TahunAkademikModel")->GetTahunActive();
            $laporan = $this->model("DashboardModel")->getLaporanHarianTerbaru($tahun['id_tahun']);

            // Load view
            $this->view("layout/head", ['title' => 'Dashboard Admin', 'page' => 'Dashboard']);
            $this->view("layout/sidebar", ['page' => 'Dashboard']);
            $this->view("layout/navbar", ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/dashboard', ['laporan' => $laporan]);
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
            // Load view
            $this->view('layout/head', ['title' => "Dashboard Mahasiswa", "page" => 'Dashboard']);
            $this->view('layout/sidebar', ['page' => 'Dashboard']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('kaprodi/dashboard');
            $this->view("layout/footer", ['page' => 'Dashboard']);
        } else if ($_SESSION['role'] == 'Pembimbing') {
            // Load view
            $this->view('layout/head', ['title' => "Dashboard Pembimbing", "page" => 'Dashboard']);
            $this->view('layout/sidebar', ['page' => 'Dashboard']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('pembimbing/dashboard');
            $this->view("layout/footer", ['page' => 'Dashboard']);
        }
    }
}