<?php

class Fakultas extends Controller
{
    public function index()
    {
        // Get data fakultas
        $fakultas = $this->model('FakultasModel')->getAll();

        // Load view
        $this->view('layout/head', ['title' => 'Fakultas', 'page' => 'Fakultas']);
        $this->view('layout/sidebar', ['page' => 'Fakultas']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/fakultas', ['fakultas' => $fakultas]);
        $this->view('layout/footer', ['page' => 'Fakultas']);
    }

    public function create()
    {
        // Validasi input
        if ($_POST['kode_fakultas'] == '' || $_POST['nama_fakultas'] == '') {
            redirectWithMsg(BASE_URL . '/Fakultas', 'Kode fakultas atau nama fakultas tidak boleh kosong', 'danger');
            exit;
        }

        // Insert data
        if ($this->model('FakultasModel')->create($_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Fakultas', 'Berhasil menambahkan fakultas baru.', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Fakultas', 'Gagal menambahkan fakultas baru.', 'danger');
        }
    }

    public function update($id)
    {
        // Validasi input
        if ($_POST['kode_fakultas'] == '' || $_POST['nama_fakultas'] == '') {
            redirectWithMsg(BASE_URL . '/Fakultas', 'Kode fakultas atau nama fakultas tidak boleh kosong', 'danger');
            exit;
        }

        // Update data
        if ($this->model('FakultasModel')->update($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Fakultas', 'Berhasil mengubah data fakultas.', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Fakultas', 'Gagal mengubah data fakultas.', 'danger');
        }
    }

    // public function delete($id)
    // {
    //     // Delete data
    //     if ($this->model('FakultasModel')->delete($id) > 0) {
    //         redirectWithMsg(BASE_URL . '/Fakultas', 'Berhasil menghapus data fakultas.', 'success');
    //     } else {
    //         redirectWithMsg(BASE_URL . '/Fakultas', 'Gagal menghapus data fakultas.', 'danger');
    //     }
    // }
}