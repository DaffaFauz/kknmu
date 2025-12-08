<?php
class Verifikasi extends Controller
{
    public function index()
    {
        if ($_SESSION['role'] == 'Kaprodi') {
            // Get data
            $mahasiswa = $this->model("VerifikasiModel")->getForKaprodi($_SESSION['id_prodi']);

            // Load view
            $this->view('layout/head', ['title' => 'Verifikasi Mahasiswa', 'page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/sidebar', ['page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('kaprodi/verifikasi', ['mahasiswa' => $mahasiswa]);
            $this->view('layout/footer', ['page' => 'Verifikasi Mahasiswa']);
        } else if ($_SESSION['role'] == 'Admin') {
            // Get data
            $mahasiswa = $this->model("VerifikasiModel")->getForAdmin();
            $fakultas = $this->model("FakultasModel")->getAll();

            // Load view
            $this->view('layout/head', ['title' => 'Verifikasi Mahasiswa', 'page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/sidebar', ['page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/verifikasi', ['mahasiswa' => $mahasiswa, 'fakultas' => $fakultas]);
            $this->view('layout/footer', ['page' => 'Verifikasi Mahasiswa']);
        }
    }

    public function verifikasi($id)
    {
        if ($this->model("VerifikasiModel")->verifikasi($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Verifikasi', 'Mahasiswa berhasil di verifikasi', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Verifikasi', 'Mahasiswa gagal di verifikasi, coba lagi.', 'danger');
        }
    }

    public function tolak($id)
    {
        if ($this->model("VerifikasiModel")->tolak($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Verifikasi', 'Mahasiswa berhasil di tolak', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Verifikasi', 'Mahasiswa gagal di tolak, coba lagi.', 'danger');
        }
    }

    public function revisi($id)
    {
        if ($this->model("VerifikasiModel")->revisi($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Verifikasi', 'Berhasil mengirim catatan', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Verifikasi', 'Gagal mengirim catatan, coba lagi.', 'danger');
        }
    }

    public function filter()
    {
        if ($_SESSION['role'] == 'Admin') {
            if ($_POST['id_fakultas'] && $_POST['id_prodi']) {
                // Get data filter
                $mahasiswa = $this->model('VerifikasiModel')->filterForAdmin($_POST);
            } else {
                // Get data filter
                $mahasiswa = $this->model("VerifikasiModel")->getForAdmin();
            }
            $fakultas = $this->model("FakultasModel")->getAll();

            // Load view
            $this->view('layout/head', ['title' => 'Verifikasi Mahasiswa', 'page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/sidebar', ['page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/verifikasi', ['mahasiswa' => $mahasiswa, 'fakultas' => $fakultas]);
            $this->view('layout/footer', ['page' => 'Verifikasi Mahasiswa']);
        } else if ($_SESSION['role'] == 'Kaprodi') {
            if ($_POST['id_prodi']) {
                // Get data filter
                $mahasiswa = $this->model('VerifikasiModel')->filterForAdmin($_POST['id_prodi']);
            } else {
                // Get data filter
                $mahasiswa = $this->model("VerifikasiModel")->getForKaprodi($_SESSION['id_prodi']);
            }

            // Load view
            $this->view('layout/head', ['title' => 'Verifikasi Mahasiswa', 'page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/sidebar', ['page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('kaprodi/verifikasi', ['mahasiswa' => $mahasiswa]);
            $this->view('layout/footer', ['page' => 'Verifikasi Mahasiswa']);
        }
    }
}
