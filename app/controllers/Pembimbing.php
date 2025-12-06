<?php
class Pembimbing extends Controller
{
    public function index()
    {
        // Get data
        $pembimbing = $this->model("PembimbingModel")->getAll();
        $prodi = $this->model("ProdiModel")->getAll();
        $notPembimbing = $this->model("PembimbingModel")->getNotPembimbing();

        // Load view
        $this->view("layout/head", ['title' => 'Data Pembimbing', 'page' => 'Pembimbing']);
        $this->view("layout/sidebar", ['page' => 'Pembimbing']);
        $this->view("layout/navbar", ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view("admin/pembimbing", ['pembimbing' => $pembimbing, 'prodi' => $prodi, 'notPembimbing' => $notPembimbing]);
        $this->view("layout/footer", ['page' => 'Pembimbing']);
    }

    public function create()
    {
        if ($this->model("PembimbingModel")->create($_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Pembimbing', 'Berhasil menambahkan pembimbing!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Pembimbing', 'Gagal menambahkan pembimbing, coba lagi.', 'danger');
        }
    }

    public function delete($id)
    {
        if ($this->model("PembimbingModel")->delete($id) > 0) {
            redirectWithMsg(BASE_URL . '/Pembimbing', 'Data pembimbing berhasil dihapus!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Pembimbing', 'Gagal menghapus data pembimbing!', 'danger');
        }
    }
}