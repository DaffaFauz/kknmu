<?php
class Kaprodi extends Controller
{
    public function index()
    {
        // Get data
        $kaprodi = $this->model("KaprodiModel")->getAll();
        $prodi = $this->model("ProdiModel")->getAll();
        $notKaprodi = $this->model("KaprodiModel")->getNotKaprodi();

        // Load view
        $this->view("layout/head", ['title' => 'Data Kaprodi', 'page' => 'Kaprodi']);
        $this->view("layout/sidebar", ['page' => 'Kaprodi']);
        $this->view("layout/navbar", ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view("admin/kaprodi", ['kaprodi' => $kaprodi, 'prodi' => $prodi, 'notKaprodi' => $notKaprodi]);
        $this->view("layout/footer", ['page' => 'Kaprodi']);
    }

    public function create()
    {
        if ($this->model("KaprodiModel")->create($_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Kaprodi', 'Berhasil menambahkan kaprodi!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Kaprodi', 'Gagal menambahkan kaprodi, coba lagi.', 'danger');
        }
    }

    public function delete($id)
    {
        if ($this->model("KaprodiModel")->delete($id) > 0) {
            redirectWithMsg(BASE_URL . '/Kaprodi', 'Data kaprodi berhasil dihapus!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Kaprodi', 'Gagal menghapus data kaprodi!', 'danger');
        }
    }
}