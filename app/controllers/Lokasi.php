<?php

class Lokasi extends Controller
{
    public function index()
    {
        // Get data lokasi
        $lokasi = $this->model('LokasiModel')->getAll();
        $kabupaten = $this->model('LokasiModel')->getKabupaten();
        $kecamatan = $this->model('LokasiModel')->getKecamatan();

        // Load view
        $this->view('layout/head', ['title' => 'Data Lokasi', 'page' => 'Data Lokasi']);
        $this->view('layout/sidebar', ['page' => 'Lokasi']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/lokasi', ['lokasi' => $lokasi, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan]);
        $this->view('layout/footer', ['page' => 'Lokasi']);
    }

    public function create()
    {
        if ($this->model("LokasiModel")->create($_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Lokasi', 'Lokasi berhasil ditambahkan', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Lokasi', 'Lokasi gagal ditambahkan', 'danger');
        }
    }

    public function update($id)
    {
        if ($this->model("LokasiModel")->update($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Lokasi', 'Lokasi berhasil diubah', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Lokasi', 'Lokasi gagal diubah', 'danger');
        }
    }

    public function delete($id)
    {
        if ($this->model("LokasiModel")->delete($id) > 0) {
            redirectWithMsg(BASE_URL . '/Lokasi', 'Lokasi berhasil dihapus', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Lokasi', 'Lokasi gagal dihapus', 'danger');
        }
    }

    public function filter()
    {
        // Get data lokasi
        if (!empty($_POST)) {
            $lokasi = $this->model('LokasiModel')->filter($_POST);
        } else {
            $lokasi = $this->model('LokasiModel')->getAll();
        }

        $kabupaten = $this->model('LokasiModel')->getKabupaten();
        // If kabupaten is selected, filter kecamatan list
        $selected_kabupaten = $_POST['kabupaten'] ?? null;
        $kecamatan = $this->model('LokasiModel')->getKecamatan($selected_kabupaten);

        // Load view
        $this->view('layout/head', ['title' => 'Data Lokasi', 'page' => 'Data Lokasi']);
        $this->view('layout/sidebar', ['page' => 'Lokasi']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/lokasi', ['lokasi' => $lokasi, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan]);
        $this->view('layout/footer', ['page' => 'Lokasi']);
    }

    public function getByKabupaten($nama_kabupaten)
    {
        // Decode URL encoded string just in case, though usually handled by routing/PHP
        $nama_kabupaten = urldecode($nama_kabupaten);
        $kecamatan = $this->model('LokasiModel')->getKecamatan($nama_kabupaten);
        echo json_encode($kecamatan);
    }
}