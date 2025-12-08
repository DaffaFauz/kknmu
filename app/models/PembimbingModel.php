<?php

class PembimbingModel
{
    private $pdo;
    private $table = 'dosen';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getAll()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN prodi ON {$this->table}.id_prodi = prodi.id_prodi INNER JOIN users ON {$this->table}.id_user = users.id_user INNER JOIN user_jabatan ON users.id_user = user_jabatan.id_user WHERE user_jabatan.id_jabatan = 2");
        return $this->pdo->resultSet();
    }

    public function getNotPembimbing()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN prodi ON {$this->table}.id_prodi = prodi.id_prodi WHERE {$this->table}.id_user NOT IN (SELECT id_user FROM user_jabatan WHERE id_jabatan = 2)");
        return $this->pdo->resultSet();
    }

    public function create($data)
    {
        $this->pdo->query("INSERT INTO user_jabatan (id_user, id_jabatan) VALUES (:id_user, :id_jabatan)");
        $this->pdo->bind("id_user", $data["id_pembimbing"]);
        $this->pdo->bind("id_jabatan", 2);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function delete($id)
    {
        $this->pdo->query("DELETE FROM user_jabatan WHERE id_user = :id_user");
        $this->pdo->bind("id_user", $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function getForPlotting($id_tahun)
    {
        $this->pdo->query("SELECT * FROM {$this->table} 
            INNER JOIN users ON {$this->table}.id_user = users.id_user 
            INNER JOIN user_jabatan ON users.id_user = user_jabatan.id_user 
            INNER JOIN jabatan ON user_jabatan.id_jabatan = jabatan.id_jabatan 
            WHERE jabatan.nama_jabatan = 'Pembimbing' 
            AND {$this->table}.id_dosen NOT IN (
                SELECT id_dosen1 FROM detail_kelompok WHERE id_tahun = :id_tahun1 AND id_dosen1 IS NOT NULL
                UNION
                SELECT id_dosen2 FROM detail_kelompok WHERE id_tahun = :id_tahun2 AND id_dosen2 IS NOT NULL
            )");
        $this->pdo->bind(':id_tahun1', $id_tahun['id_tahun']);
        $this->pdo->bind(':id_tahun2', $id_tahun['id_tahun']);
        return $this->pdo->resultSet();
    }
}