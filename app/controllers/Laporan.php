<?php

class Laporan extends Controller
{

    public function harian()
    {
        if ($_SESSION['role'] == 'Mahasiswa' || $_SESSION['role'] == 'Pembimbing') {
            // Get data
            $laporan = $this->model('LaporanModel')->getLaporanHarianForMahasiswaAndPembimbing($_SESSION['id_kelompok']);

            // Load view
            $this->view('layout/head', ['title' => "Laporan Harian", "page" => 'Laporan']);
            $this->view('layout/sidebar', ['page' => 'Laporan Harian', 'role' => $_SESSION['role']]);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('mahasiswa/laporan_harian', ['laporan' => $laporan]);
            $this->view("layout/footer", ['page' => 'Laporan']);
        } else if ($_SESSION['role'] == 'Admin') {
            // Get data
            $laporan = $this->model('LaporanModel')->getLaporanHarian();

            // Load view
            $this->view('layout/head', ['title' => "Laporan Harian", "page" => 'Laporan']);
            $this->view('layout/sidebar', ['page' => 'Laporan Harian', 'role' => $_SESSION['role']]);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/laporan_harian', ['laporan' => $laporan]);
            $this->view("layout/footer", ['page' => 'Laporan']);
        }



    }

    public function createHarian()
    {
        // Validasi apakah kelompok benar-benar ada di database
        $kelompok = $this->model('KelompokModel')->getById($_SESSION['id_kelompok']);
        if (!$kelompok) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Data kelompok tidak valid atau tidak ditemukan! Silahkan hubungi admin.', 'danger');
            exit;
        }



        // Validasi input
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $tanggal = $_POST['tanggal'];

        if (empty($judul) || empty($deskripsi) || empty($tanggal)) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Judul, deskripsi, dan tanggal harus diisi!', 'danger');
            exit;
        }

        // Validasi deskripsi minimal 700 kata
        $clean_deskripsi = strip_tags($deskripsi);
        $word_count = str_word_count($clean_deskripsi);
        if ($word_count < 700) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Deskripsi harus berisi minimal 700 kata! Saat ini: ' . $word_count . ' kata.', 'danger');
            exit;
        }


        // Validasi file
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        if ($file_error === 4) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'File harus diupload!', 'danger');
            exit;
        }

        if ($file_size > 2000000) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'File tidak boleh lebih dari 2MB!', 'danger');
            exit;
        }

        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_ext = array('jpg', 'jpeg', 'png');

        if (!in_array($file_ext, $allowed_ext)) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'File harus berekstensi .jpg, .jpeg, .png!', 'danger');
            exit;
        }

        // Buat folder dokumentasi untuk laporan harian jika folder belum ada
        $folder = __DIR__ . '/../../public/assets/img/dokumentasi';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload file
        $file_name_new = uniqid('', true) . '.' . $file_ext;
        move_uploaded_file($file_tmp_name, 'assets/img/dokumentasi/' . $file_name_new);

        // Simpan data ke database
        $data = array(
            'id_kelompok' => $_SESSION['id_kelompok'],
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'tanggal' => $tanggal,
            'file' => $file_name_new
        );

        if ($this->model('LaporanModel')->createHarian($data)) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Laporan harian berhasil dibuat!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Laporan harian gagal dibuat!', 'danger');
        }
    }

    public function updateHarian($id)
    {
        // Validasi input
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $tanggal = $_POST['tanggal'];

        if (empty($judul) || empty($deskripsi) || empty($tanggal)) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Judul, deskripsi, dan tanggal harus diisi!', 'danger');
            exit;
        }

        $file_name_new = '';

        // Validasi file jika ada upload baru
        if ($_FILES['file']['error'] !== 4) {
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $file_tmp_name = $file['tmp_name'];
            $file_size = $file['size'];

            if ($file_size > 2000000) {
                redirectWithMsg(BASE_URL . '/Laporan/harian', 'File tidak boleh lebih dari 2MB!', 'danger');
                exit;
            }

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_ext = array('jpg', 'jpeg', 'png');

            if (!in_array($file_ext, $allowed_ext)) {
                redirectWithMsg(BASE_URL . '/Laporan/harian', 'File harus berekstensi .jpg, .jpeg, .png!', 'danger');
                exit;
            }

            // Upload file
            $file_name_new = uniqid('', true) . '.' . $file_ext;
            move_uploaded_file($file_tmp_name, 'assets/img/dokumentasi/' . $file_name_new);
        }

        // Simpan data ke database
        $data = array(
            'id_laporan' => $id,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'tanggal' => $tanggal,
            'file' => $file_name_new
        );

        if ($this->model('LaporanModel')->updateHarian($data) > 0) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Laporan harian berhasil diubah!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Laporan harian gagal diubah!', 'danger');
        }
    }

    public function deleteHarian($id)
    {
        if ($this->model('LaporanModel')->deleteHarian($id) > 0) {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Laporan harian berhasil dihapus!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Laporan/harian', 'Laporan harian gagal dihapus!', 'danger');
        }
    }

    public function filterHarian()
    {
        // Get tanggal from input
        $tanggal = $_POST['tanggal'];
        if (!empty($tanggal) && $_SESSION['role'] == 'Mahasiswa' || !empty($tanggal) && $_SESSION['role'] == 'Pembimbing') {
            $filter = $this->model('LaporanModel')->filterLaporanHarianForMahasiswaAndPembimbing($_SESSION['id_kelompok'], $tanggal);
        } else if (!empty($tanggal) && $_SESSION['role'] == 'Admin') {
            $filter = $this->model('LaporanModel')->filterLaporanHarian($tanggal);
        } else if (empty($tanggal) && $_SESSION['role'] == 'Mahasiswa' || empty($tanggal) && $_SESSION['role'] == 'Pembimbing') {
            $filter = $this->model('LaporanModel')->getLaporanHarianForMahasiswaAndPembimbing($_SESSION['id_kelompok']);
        } else if (empty($tanggal) && $_SESSION['role'] == 'Admin') {
            $filter = $this->model('LaporanModel')->getLaporanHarian();
        }

        // Load View
        $this->view('layout/head', ['title' => "Laporan Harian", "page" => 'Laporan']);
        $this->view('layout/sidebar', ['page' => 'Laporan Harian', 'role' => $_SESSION['role']]);
        $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
        $this->view('mahasiswa/laporan_harian', ['laporan' => $filter]);
        $this->view("layout/footer", ['page' => 'Laporan']);
    }


    public function akhir()
    {
        if ($_SESSION['role'] == 'Mahasiswa' || $_SESSION['role'] == 'Pembimbing') {
            // Get data
            $laporan = $this->model('LaporanModel')->getLaporanAkhirForMahasiswaAndPembimbing($_SESSION['id_kelompok']);

            // Load view
            $this->view('layout/head', ['title' => "Laporan Akhir", "page" => 'Laporan']);
            $this->view('layout/sidebar', ['page' => 'Laporan Akhir', 'role' => $_SESSION['role']]);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('mahasiswa/laporan_akhir', ['laporan_akhir' => $laporan]);
            $this->view("layout/footer", ['page' => 'Laporan']);
        } else if ($_SESSION['role'] == 'Admin') {
            // Get data
            $laporan = $this->model('LaporanModel')->getLaporanAkhir();
            $kabupaten = $this->model('LokasiModel')->getKabupaten();

            // Load view
            $this->view('layout/head', ['title' => "Laporan Akhir", "page" => 'Laporan']);
            $this->view('layout/sidebar', ['page' => 'Laporan Akhir', 'role' => $_SESSION['role']]);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/laporan_akhir', ['laporan' => $laporan, 'kabupaten' => $kabupaten]);
            $this->view("layout/footer", ['page' => 'Laporan']);
        }
    }

    public function filterAkhir()
    {
        if ($_SESSION['role'] == 'Admin') {
            $kabupaten = isset($_POST['kabupaten']) ? $_POST['kabupaten'] : null;
            $kecamatan = isset($_POST['kecamatan']) ? $_POST['kecamatan'] : null;
            $desa = isset($_POST['desa']) ? $_POST['desa'] : null;

            $laporan = $this->model('LaporanModel')->filterLaporanAkhir($kabupaten, $kecamatan, $desa);
            $data_kabupaten = $this->model('LokasiModel')->getKabupaten();
            $data_kecamatan = $this->model('LokasiModel')->getKecamatan($kabupaten);
            $data_desa = $this->model('LokasiModel')->getDesa($kecamatan);

            // Load view
            $this->view('layout/head', ['title' => "Laporan Akhir", "page" => 'Laporan']);
            $this->view('layout/sidebar', ['page' => 'Laporan Akhir', 'role' => $_SESSION['role']]);
            $this->view('layout/navbar', ['nama' => $_SESSION['nama'], 'role' => $_SESSION['role']]);
            $this->view('admin/laporan_akhir', ['laporan' => $laporan, 'kabupaten' => $data_kabupaten, 'kecamatan' => $data_kecamatan, 'desa' => $data_desa]);
            $this->view("layout/footer", ['page' => 'Laporan']);
        } else {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Anda tidak memiliki akses!', 'danger');
        }
    }

    public function createAkhir()
    {
        // Validasi apakah kelompok benar-benar ada di database
        $kelompok = $this->model('KelompokModel')->getById($_SESSION['id_kelompok']);
        if (!$kelompok) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Data kelompok tidak valid atau tidak ditemukan! Silahkan hubungi admin.', 'danger');
            exit;
        }

        // Validasi input
        $judul = $_POST['judul'];
        $link = $_POST['link'];

        if (empty($judul) || empty($link)) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Judul dan Link Video harus diisi!', 'danger');
            exit;
        }

        // Validasi file
        $laporan_akhir = $_FILES['laporan_akhir'];
        $jurnal = $_FILES['jurnal'];
        $produk_unggulan = $_FILES['produk_unggulan'];
        $dokumentasi = $_FILES['dokumentasi'];

        $errors = [];
        $errors[] = $this->validateDokumen($laporan_akhir, ['docx'], 10000000, 'Laporan Akhir');
        $errors[] = $this->validateDokumen($jurnal, ['docx'], 10000000, 'Jurnal');
        $errors[] = $this->validateDokumen($produk_unggulan, ['jpg', 'jpeg', 'png'], 5000000, 'Produk Unggulan');
        $errors[] = $this->validateDokumen($dokumentasi, ['jpg', 'jpeg', 'png'], 5000000, 'Dokumentasi');

        $errors = array_filter($errors);
        if (!empty($errors)) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', implode('<br>', $errors), 'danger');
            exit;
        }

        $laporan_akhir_name = $this->uploadDokumen($laporan_akhir, 'assets/dokumen/laporanAkhir');
        $jurnal_name = $this->uploadDokumen($jurnal, 'assets/dokumen/laporanAkhir');
        $produk_unggulan_name = $this->uploadDokumen($produk_unggulan, 'assets/img/laporanAkhir');
        $dokumentasi_name = $this->uploadDokumen($dokumentasi, 'assets/img/laporanAkhir');

        // Simpan data ke database
        $data = array(
            'id_kelompok' => $_SESSION['id_kelompok'],
            'judul' => $judul,
            'link_video' => $link,
            'laporan_akhir' => $laporan_akhir_name,
            'jurnal' => $jurnal_name,
            'produk_unggulan' => $produk_unggulan_name,
            'dokumentasi' => $dokumentasi_name
        );

        if ($this->model('LaporanModel')->createAkhir($data)) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Laporan akhir berhasil dibuat!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Laporan akhir gagal dibuat!', 'danger');
        }
    }

    public function updateAkhir($id)
    {
        // Validasi input
        $judul = $_POST['judul'];
        $link = $_POST['link'];

        if (empty($judul) || empty($link)) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Judul dan Link Video harus diisi!', 'danger');
            exit;
        }

        // Validasi file
        $laporan_akhir = $_FILES['laporan_akhir'];
        $jurnal = $_FILES['jurnal'];
        $produk_unggulan = $_FILES['produk_unggulan'];
        $dokumentasi = $_FILES['dokumentasi'];

        $errors = [];
        $errors[] = $this->validateDokumenUpdate($laporan_akhir, ['docx'], 10000000, 'Laporan Akhir');
        $errors[] = $this->validateDokumenUpdate($jurnal, ['docx'], 10000000, 'Jurnal');
        $errors[] = $this->validateDokumenUpdate($produk_unggulan, ['jpg', 'jpeg', 'png'], 5000000, 'Produk Unggulan');
        $errors[] = $this->validateDokumenUpdate($dokumentasi, ['jpg', 'jpeg', 'png'], 5000000, 'Dokumentasi');

        $errors = array_filter($errors);
        if (!empty($errors)) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', implode('<br>', $errors), 'danger');
            exit;
        }

        $laporan_akhir_name = $this->uploadDokumenUpdate($laporan_akhir, 'assets/dokumen/laporanAkhir');
        $jurnal_name = $this->uploadDokumenUpdate($jurnal, 'assets/dokumen/laporanAkhir');
        $produk_unggulan_name = $this->uploadDokumenUpdate($produk_unggulan, 'assets/img/laporanAkhir');
        $dokumentasi_name = $this->uploadDokumenUpdate($dokumentasi, 'assets/img/laporanAkhir');

        // Simpan data ke database
        $data = array(
            'id_laporan' => $id,
            'judul' => $judul,
            'link_video' => $link,
            'dokumen_laporan' => $laporan_akhir_name,
            'dokumen_jurnal' => $jurnal_name,
            'produk_unggulan' => $produk_unggulan_name,
            'dokumentasi' => $dokumentasi_name
        );

        if ($this->model('LaporanModel')->updateAkhir($data) > 0) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Laporan akhir berhasil diubah!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Laporan akhir gagal diubah!', 'danger');
        }
    }

    private function validateDokumen($file, $allowed_exts, $max_size, $name)
    {
        if ($file['error'] === 4) {
            return "File $name harus diupload!";
        }
        if ($file['size'] > $max_size) {
            return "File $name tidak boleh lebih dari " . ($max_size / 1000000) . "MB!";
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($ext), $allowed_exts)) {
            return "File $name harus berekstensi " . implode(', ', $allowed_exts) . "!";
        }
        return null;
    }

    private function uploadDokumen($file, $destination)
    {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_name = uniqid('', true) . '.' . $ext;
        move_uploaded_file($file['tmp_name'], $destination . '/' . $new_name);
        return $new_name;
    }

    private function validateDokumenUpdate($file, $allowed_exts, $max_size, $name)
    {
        if ($file['error'] !== 4) {
            if ($file['size'] > $max_size) {
                return "File $name tidak boleh lebih dari " . ($max_size / 1000000) . "MB!";
            }
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext), $allowed_exts)) {
                return "File $name harus berekstensi " . implode(', ', $allowed_exts) . "!";
            }
        }
        return null;
    }

    private function uploadDokumenUpdate($file, $destination)
    {
        if ($file['error'] !== 4) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_name = uniqid('', true) . '.' . $ext;
            move_uploaded_file($file['tmp_name'], $destination . '/' . $new_name);
            return $new_name;
        }
        return null;
    }

    public function verifikasiLaporanAkhir($id)
    {
        if ($this->model('LaporanModel')->verifikasiLaporanAkhir($id) > 0) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Laporan akhir berhasil diverifikasi!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Laporan akhir gagal diverifikasi!', 'danger');
        }
    }

    public function revisiLaporanAkhir($id)
    {
        if ($this->model('LaporanModel')->revisiLaporanAkhir($id, $_POST) > 0) {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Laporan akhir berhasil direvisi!', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Laporan/akhir', 'Laporan akhir gagal direvisi!', 'danger');
        }
    }

    public function nilai()
    {

    }
}