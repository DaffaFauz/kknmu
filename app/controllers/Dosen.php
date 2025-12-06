<?php
class Dosen extends Controller
{
    public function index()
    {
        // Get data
        $dosen = $this->model("DosenModel")->getAll();
        $prodi = $this->model("ProdiModel")->getAll();

        // Load view
        $this->view("layout/head", ['title' => 'Data Dosen', 'page' => 'Dosen']);
        $this->view("layout/sidebar", ['page' => 'Dosen']);
        $this->view("layout/navbar", ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view("admin/dosen", ['dosen' => $dosen, 'prodi' => $prodi]);
        $this->view("layout/footer", ['page' => 'Dosen']);
    }

    public function create()
    {
        // Validasi input
        if ($_POST['nidn'] == '' || $_POST['nama_dosen'] == '' || $_POST['id_prodi'] == '') {
            redirectWithMsg(BASE_URL . '/Dosen', 'Gagal menambahkan data dosen. Data tidak boleh kosong!', 'danger');
            exit;
        }

        // Insert data
        $newId = $this->model("UserModel")->create($_POST);
        if ($newId) {
            $_POST['id_user'] = $newId;
            // Insert data dosen
            if ($this->model("DosenModel")->create($_POST) > 0) {
                redirectWithMsg(BASE_URL . '/Dosen', 'Data dosen berhasil ditambahkan!', 'success');
            } else {
                $this->model("UserModel")->delete($newId);
                redirectWithMsg(BASE_URL . '/Dosen', 'Gagal menambahkan data dosen, coba lagi.', 'danger');
            }
        }
    }

    public function update($id)
    {
        // Validasi input
        if ($_POST['username'] == '' || $_POST['nama'] == '' || $_POST['id_prodi'] == '') {
            redirectWithMsg(BASE_URL . '/Dosen', 'Gagal mengubah data dosen. Data tidak boleh kosong!', 'danger');
            exit;
        }

        // Update data
        if ($this->model("UserModel")->update($id, $_POST) > 0 && $this->model("DosenModel")->update($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Dosen', 'Data dosen berhasil diubah!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Dosen', 'Gagal mengubah data dosen!', 'danger');
        }
    }

    public function delete($id)
    {
        if ($this->model("DosenModel")->delete($id) > 0 && $this->model("UserModel")->delete($id) > 0) {
            redirectWithMsg(BASE_URL . '/Dosen', 'Data dosen berhasil dihapus!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Dosen', 'Gagal menghapus data dosen!', 'danger');
        }
    }
}