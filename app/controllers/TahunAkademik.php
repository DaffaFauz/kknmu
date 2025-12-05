<?php
class TahunAkademik extends Controller
{
    public function index()
    {
        // Get data tahun akademik
        $tahunAkademik = $this->model('TahunAkademikModel')->getAll();

        // Load view
        $this->view('layout/head', ['title' => 'Tahun Akademik', 'page' => 'Tahun Akademik']);
        $this->view('layout/sidebar', ['page' => 'Tahun Akademik']);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('admin/tahun_akademik', ['tahunAkademik' => $tahunAkademik]);
        $this->view('layout/footer');
    }

    public function create()
    {
        if ($this->model('TahunAkademikModel')->create($_POST)) {
            redirectWithMsg(BASE_URL . '/TahunAkademik', 'Berhasil menambahkan periode baru.', 'success');
        }
    }

    public function update($id)
    {
        if ($this->model('TahunAkademikModel')->update($id, $_POST)) {
            redirectWithMsg(BASE_URL . '/TahunAkademik', 'Berhasil mengubah periode.', 'success');
        }
    }

    public function switch($id)
    {
        if ($this->model("TahunAkademikModel")->switch($id) > 0) {
            redirectWithMsg(BASE_URL . '/TahunAkademik', 'Berhasil mengubah periode.', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/TahunAkademik', 'Gagal mengubah periode.', 'danger');
        }
    }
}