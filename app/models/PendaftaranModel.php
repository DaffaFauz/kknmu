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
}