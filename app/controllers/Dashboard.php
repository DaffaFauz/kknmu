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
            $this->view("layout/footer");
        } else if ($_SESSION['role'] == 'Mahasiswa') {
            $this->view('layout/head', ['title' => "Dashboard Mahasiswa", "page" => 'Dashboard']);
            $this->view('layout/sidebar', ['page' => 'Dashboard']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('mahasiswa/dashboard');
            $this->view("layout/footer");
        }
    }
}