<?php
class Prodi extends Controller
{
    public function index()
    {
        // Get data prodi & fakultas
        $prodi = $this->model('ProdiModel')->getAll();
        $fakultas = $this->model('FakultasModel')->getAll();

        // Load view
        $this->view('layout/head', ['title' => 'Program Studi', 'page' => 'Program Studi']);
        $this->view('layout/sidebar', ['page' => 'Program Studi']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/prodi', ['prodi' => $prodi, 'fakultas' => $fakultas]);
        $this->view('layout/footer');
    }

    public function create()
    {
        // Validasi input
        if ($_POST['kode_prodi'] == '' || $_POST['nama_prodi'] == '' || $_POST['id_fakultas'] == '') {
            redirectWithMsg(BASE_URL . '/Prodi', 'Data tidak boleh kosong', 'danger');
            exit;
        }

        // Insert data
        if ($this->model('ProdiModel')->create($_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Prodi', 'Berhasil menambahkan prodi baru', 'success');
            exit;
        } else {
            redirectWithMsg(BASE_URL . '/Prodi', 'Gagal menambahkan prodi baru', 'danger');
            exit;
        }
    }

    public function update($id)
    {
        // Validasi input
        if ($_POST['kode_prodi'] == '' || $_POST['nama_prodi'] == '' || $_POST['id_fakultas'] == '') {
            redirectWithMsg(BASE_URL . '/Prodi', 'Data tidak boleh kosong', 'danger');
            exit;
        }

        // Update data
        if ($this->model('ProdiModel')->update($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Prodi', 'Berhasil mengubah prodi', 'success');
            exit;
        } else {
            redirectWithMsg(BASE_URL . '/Prodi', 'Gagal mengubah prodi', 'danger');
            exit;
        }
    }

    public function delete($id)
    {
        // Delete data
        if ($this->model('ProdiModel')->delete($id) > 0) {
            redirectWithMsg(BASE_URL . '/Prodi', 'Berhasil menghapus prodi', 'success');
            exit;
        } else {
            redirectWithMsg(BASE_URL . '/Prodi', 'Gagal menghapus prodi', 'danger');
            exit;
        }
    }

    public function filter($id = null)
    {
        // Jika ada post id_fakultas, gunakan itu (override url params)
        if (isset($_POST['id_fakultas'])) {
            $id = $_POST['id_fakultas'];
        }

        // Get data prodi & fakultas
        if (empty($id)) {
            $prodi = $this->model('ProdiModel')->getAll();
        } else {
            $prodi = $this->model('ProdiModel')->filter($id);
        }

        $fakultas = $this->model('FakultasModel')->getAll();

        // Load view
        $this->view('layout/head', ['title' => 'Program Studi', 'page' => 'Program Studi']);
        $this->view('layout/sidebar', ['page' => 'Program Studi']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/prodi', ['prodi' => $prodi, 'fakultas' => $fakultas, 'id_fakultas' => $id]);
        $this->view('layout/footer');
    }

    public function getByFakultas($id)
    {
        $prodi = $this->model('ProdiModel')->filter($id);
        echo json_encode($prodi);
    }
}