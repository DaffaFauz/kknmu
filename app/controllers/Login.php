<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function register()
    {
        $this->view('register');
    }

    public function SelectJabatan()
    {
        $this->view('selectJabatan');
    }
}