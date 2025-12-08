<?php

class Kelompok extends Controller
{
    public function index()
    {
        // Get data
        $kelompok = $this->model('KelompokModel')->getAll();

        // Load view
        $this->view('layout/head', ['title' => 'Data Kelompok', 'page' => 'Kelompok']);
        $this->view('layout/sidebar', ['page' => 'Kelompok']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('kelompok', $kelompok);
        $this->view('layout/footer', ['page' => 'Kelompok']);
    }
}