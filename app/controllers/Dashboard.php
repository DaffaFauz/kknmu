<?php

class Dashboard extends Controller
{
    public function index()
    {
        if ($_SESSION['role'] == 'Admin') {
            $this->view("layout/head", ['title' => 'Dashboard Admin', 'page' => 'Dashboard']);
            $this->view("layout/sidebar", ['page' => 'Dashboard']);
            $this->view("layout/navbar", ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/dashboard');
            $this->view("layout/footer", ['page' => 'Dashboard']);
        } else if ($_SESSION['role'] == 'Mahasiswa') {
            // Get data from database
            $pendaftaran = $this->model("DashboardModel")->getPendaftaranMahasiswa($_SESSION['id_mahasiswa']);

            // Load view
            $this->view('layout/head', ['title' => "Dashboard Mahasiswa", "page" => 'Dashboard']);
            $this->view('layout/sidebar', ['page' => 'Dashboard']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('mahasiswa/dashboard', ['pendaftaran' => $pendaftaran]);
            $this->view("layout/footer", ['page' => 'Dashboard']);
        } else if ($_SESSION['role'] == 'Kaprodi') {
            // Load view
            $this->view('layout/head', ['title' => "Dashboard Mahasiswa", "page" => 'Dashboard']);
            $this->view('layout/sidebar', ['page' => 'Dashboard']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('kaprodi/dashboard');
            $this->view("layout/footer", ['page' => 'Dashboard']);
        }
    }
}