<?php

class Mahasiswa extends Controller
{
    public function index()
    {
        // Ambil data mahasiswa yang sudah daftar
        $mahasiswa = $this->model("PendaftaranModel")->getAllForAdmin();


        // View
        $this->view("layout/head", ['pageTitle' => 'Data Mahasiswa']);
        $this->view("layout/sidebar");
        $this->view("layout/header", ['nama' => $_SESSION['nama']]);
        $this->view("admin/master/mahasiswa", ['mahasiswa' => $mahasiswa]);
        $this->view("layout/footer");
        $this->view("layout/script");

    }

    public function create()
    {
        $newId = $this->model("UserModel")->register($_POST);
        if ($newId > 0) {
            $_POST['newId'] = $newId;
            if ($this->model("MahasiswaModel")->create($_POST) > 0) {
                redirectWithMsg(BASE_URL . '/Mahasiswa', 'Data mahasiswa berhasil ditambahkan.', 'success');
            } else {
                $this->model('UserModel')->delete($newId);
                redirectWithMsg(BASE_URL . '/Mahasiswa', 'Data mahasiswa gagal ditambahkan.', 'danger');
            }
        }
    }
}