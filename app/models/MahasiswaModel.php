<?php
class mahasiswaModel
{
    private $pdo;
    private $table = 'mahasiswa';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getAll()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN pendaftaran ON {$this->table}.id_mahasiswa = pendaftaran.id_mahasiswa INNER JOIN tahun_akademik ON pendaftaran.id_tahun = tahun_akademik.id_tahun WHERE tahun_akademik.status = 'Aktif'");
        return $this->pdo->resultSet();
    }

    public function create($data)
    {
        $this->pdo->beginTransaction();
        $this->pdo->query("INSERT INTO {$this->table} (id_user, nim, nama_mahasiswa, alamat, jenis_kelamin, id_prodi, kelas) VALUES (:id_user, :nim, :nama, :alamat, :jenis_kelamin, :prodi, :kelas)");
        $this->pdo->bind("id_user", $data['id_user']);
        $this->pdo->bind("nim", $data["username"]);
        $this->pdo->bind("nama", $data["nama"]);
        $this->pdo->bind("alamat", $data["alamat"]);
        $this->pdo->bind("jenis_kelamin", $data["jenis_kelamin"]);
        $this->pdo->bind("prodi", $data["prodi"]);
        $this->pdo->bind("kelas", $data["kelas"]);
        $this->pdo->execute();
        $id = $this->pdo->lastInsertId();
        $this->pdo->commit();
        return $id;
    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {
        $this->pdo->query("DELETE FROM {$this->table} WHERE id_mahasiswa = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function getMahasiswaForPlotting($tahun)
    {
        $this->pdo->query("SELECT * FROM pendaftaran INNER JOIN {$this->table} ON pendaftaran.id_mahasiswa = {$this->table}.id_mahasiswa INNER JOIN prodi ON {$this->table}.id_prodi = prodi.id_prodi INNER JOIN fakultas ON prodi.id_fakultas = fakultas.id_fakultas INNER JOIN tahun_akademik ON pendaftaran.id_tahun = tahun_akademik.id_tahun WHERE pendaftaran.status_pendaftaran = 'Diverifikasi' AND {$this->table}.id_kelompok IS NULL AND tahun_akademik.id_tahun = :tahun");
        $this->pdo->bind(':tahun', $tahun['id_tahun']);
        return $this->pdo->resultSet();
    }

    public function getMahasiswaForPlottingEdit($tahun, $current_id_kelompok)
    {
        $this->pdo->query("SELECT * FROM pendaftaran 
                           INNER JOIN {$this->table} ON pendaftaran.id_mahasiswa = {$this->table}.id_mahasiswa 
                           INNER JOIN prodi ON {$this->table}.id_prodi = prodi.id_prodi 
                           INNER JOIN fakultas ON prodi.id_fakultas = fakultas.id_fakultas 
                           INNER JOIN tahun_akademik ON pendaftaran.id_tahun = tahun_akademik.id_tahun 
                           WHERE pendaftaran.status_pendaftaran = 'Diverifikasi' 
                           AND ({$this->table}.id_kelompok IS NULL OR {$this->table}.id_kelompok = :current_id) 
                           AND tahun_akademik.id_tahun = :tahun");
        $this->pdo->bind(':tahun', $tahun['id_tahun']);
        $this->pdo->bind(':current_id', $current_id_kelompok);
        return $this->pdo->resultSet();
    }
}