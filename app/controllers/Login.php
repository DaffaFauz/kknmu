<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function register()
    {
        // Get data fakultas
        $fakultas = $this->model('FakultasModel')->getAll();

        // Load View
        $this->view('register', ['fakultas' => $fakultas]);
    }

    public function SelectJabatan()
    {
        $this->view('selectJabatan');
    }
}