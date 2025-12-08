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
        $this->view('admin/kelompok', ['kelompok' => $kelompok]);
        $this->view('layout/footer', ['page' => 'Kelompok']);
    }

    public function create()
    {
        if ($this->model("KelompokModel")->create($_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Kelompok', 'Berhasil menambahkan kelompok baru', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Kelompok', 'Gagal menambahkan kelompok baru, coba lagi.', 'danger');
        }
    }

    public function update($id)
    {
        if ($this->model("KelompokModel")->update($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Kelompok', 'Berhasil mengubah kelompok', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Kelompok', 'Gagal mengubah kelompok, coba lagi.', 'danger');
        }
    }

    public function delete($id)
    {
        if ($this->model("KelompokModel")->delete($id) > 0) {
            redirectWithMsg(BASE_URL . '/Kelompok', 'Berhasil menghapus kelompok', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Kelompok', 'Gagal menghapus kelompok, coba lagi.', 'danger');
        }
    }
}