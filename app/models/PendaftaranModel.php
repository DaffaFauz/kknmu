<?php
class PendaftaranModel
{
    private $pdo;
    private $table = 'pendaftaran';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function create($data)
    {
        // Get data tahun active
        require_once __DIR__ . '/TahunAkademikModel.php';
        $tahun = (new TahunAkademikModel())->GetTahunActive();
        $this->pdo->query("INSERT INTO {$this->table} (id_mahasiswa, status_pendaftaran, id_tahun) VALUES (:id_mahasiswa, :status_pendaftaran, :id_tahun)");
        $this->pdo->bind(':id_mahasiswa', $data['id_mahasiswa']);
        $this->pdo->bind(':status_pendaftaran', 'Pending');
        $this->pdo->bind(':id_tahun', $tahun['id_tahun']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function ajukan($id, $file)
    {
        // Periksa status pendaftaran
        $this->pdo->query("SELECT * FROM {$this->table} WHERE id_pendaftaran = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        $data = $this->pdo->single();
        if ($data['status_pendaftaran'] == 'Ditolak' || $data['status_pendaftaran'] == 'Pending') {
            redirectWithMsg(BASE_URL . '/Dashboard', 'Gak usah ngadi-ngadi deh, Ikutin sesuai aturan aja!', 'danger');
            exit;
        }

        // Periksa file
        if ($file['error'] != 0) {
            redirectWithMsg(BASE_URL . '/Dashboard', 'File tidak valid!', 'danger');
            exit;
        }

        // Mengambil data file
        $file_name = $file['name'];
        $file_type = $file['type'];
        $file_size = $file['size'];
        $file_tmp_name = $file['tmp_name'];

        // Validasi ukuran maks. file
        if ($file_size > 5000000) {
            redirectWithMsg(BASE_URL . '/Dashboard', 'Ukuran file terlalu besar!', 'danger');
            exit;
        }

        // Validasi format file gambar
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file_tmp_name);

        $allowed_types = ['image/jpeg', 'image/png'];

        if (!in_array($mime, $allowed_types)) {
            redirectWithMsg(BASE_URL . '/Dashboard', 'Format file tidak valid! Hanya JPG/PNG', 'danger');
            exit;
        }

        // Buat folder bukti_pembayaran jika folder belum ada
        $folder = __DIR__ . '/../../public/assets/img/bukti_pembayaran';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Pindahkan file ke folder bukti_pembayaran
        $file_name = uniqid() . $file_name;
        $file_path = $folder . '/' . $file_name;
        if (!move_uploaded_file($file_tmp_name, $file_path)) {
            redirectWithMsg(BASE_URL . '/Dashboard', 'Gagal mengunggah file!', 'danger');
            exit;
        }

        // Update status pendaftaran
        $this->pdo->query("UPDATE {$this->table} SET bukti_pembayaran = :bukti_pembayaran WHERE id_pendaftaran = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->bind(':bukti_pembayaran', $file_name);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }
}