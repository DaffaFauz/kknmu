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
            $jml = $this->model("VerifikasiModel")->verifKaprodi();
            $jmlVerif = $this->model("VerifikasiModel")->verif();
            $jmlRevisi = $this->model("VerifikasiModel")->getrevisi();
            $jmlDitolak = $this->model("VerifikasiModel")->getDitolak();

            // Load view
            $this->view('layout/head', ['title' => 'Verifikasi Mahasiswa', 'page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/sidebar', ['page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/verifikasi', ['mahasiswa' => $mahasiswa, 'fakultas' => $fakultas, 'jml_verifKaprodi' => $jml, 'jml_verif' => $jmlVerif, 'jml_revisi' => $jmlRevisi, 'jml_ditolak' => $jmlDitolak]);
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
            if ($_POST['id_fakultas'] && !empty($_POST['id_prodi'])) {
                // Get data filter
                $mahasiswa = $this->model('VerifikasiModel')->filterForAdmin($_POST);
                $jml = $this->model("VerifikasiModel")->filterVerifKaprodi($_POST);
                $jmlVerif = $this->model("VerifikasiModel")->filterVerif($_POST);
                $jmlRevisi = $this->model("VerifikasiModel")->filterRevisi($_POST);
                $jmlDitolak = $this->model("VerifikasiModel")->filterDitolak($_POST);
            } else {
                // Get data filter
                $mahasiswa = $this->model("VerifikasiModel")->getForAdmin();
                // Get data
                $jml = $this->model("VerifikasiModel")->verifKaprodi();
                $jmlVerif = $this->model("VerifikasiModel")->verif();
                $jmlRevisi = $this->model("VerifikasiModel")->getrevisi();
                $jmlDitolak = $this->model("VerifikasiModel")->getDitolak();
            }
            $fakultas = $this->model("FakultasModel")->getAll();



            // Load view
            $this->view('layout/head', ['title' => 'Verifikasi Mahasiswa', 'page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/sidebar', ['page' => 'Verifikasi Mahasiswa']);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/verifikasi', ['mahasiswa' => $mahasiswa, 'fakultas' => $fakultas, 'jml_verifKaprodi' => $jml, 'jml_verif' => $jmlVerif, 'jml_revisi' => $jmlRevisi, 'jml_ditolak' => $jmlDitolak]);
            $this->view('layout/footer', ['page' => 'Verifikasi Mahasiswa']);
        } else if ($_SESSION['role'] == 'Kaprodi') {
            if (isset($_POST['kelas'])) {
                // Get data filter
                $mahasiswa = $this->model('VerifikasiModel')->filterForKaprodi($_SESSION['id_prodi'], $_POST);
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
