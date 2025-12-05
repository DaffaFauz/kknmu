<?php

class Dashboard extends Controller
{
    public function index()
    {
        $this->view("layout/head", ['title' => 'Dashboard Admin']);
        $this->view("layout/sidebar", ['page' => 'Dashboard']);
        $this->view("layout/navbar", ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/dashboard');
        $this->view("layout/footer");
    }
}