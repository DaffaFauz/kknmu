<?php
class DashboardModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getPendaftaranMahasiswa($id_mahasiswa)
    {
        $this->pdo->query("SELECT * FROM pendaftaran WHERE id_mahasiswa = :id_mahasiswa");
        $this->pdo->bind(':id_mahasiswa', $id_mahasiswa);
        return $this->pdo->single();
    }
}