<?php

class DosenModel
{
    private $pdo;
    private $table = 'dosen';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getAll()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN prodi ON {$this->table}.id_prodi = prodi.id_prodi");
        return $this->pdo->resultSet();
    }

    public function create($data)
    {
        $this->pdo->query("INSERT INTO {$this->table} (id_user, nidn, nama_dosen, id_prodi) VALUES (:id_user, :nidn, :nama_dosen, :id_prodi)");
        $this->pdo->bind("id_user", $data["id_user"]);
        $this->pdo->bind("nidn", $data["nidn"]);
        $this->pdo->bind("nama_dosen", $data["nama_dosen"]);
        $this->pdo->bind("id_prodi", $data["id_prodi"]);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function update($id, $data)
    {
        $this->pdo->query("UPDATE {$this->table} SET nidn = :nidn, nama_dosen = :nama_dosen, id_prodi = :id_prodi WHERE id_user = :id_user");
        $this->pdo->bind("id_user", $id);
        $this->pdo->bind("nidn", $data["username"]);
        $this->pdo->bind("nama_dosen", $data["nama"]);
        $this->pdo->bind("id_prodi", $data["id_prodi"]);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function delete($id)
    {
        $this->pdo->query("DELETE FROM {$this->table} WHERE id_user = :id_user");
        $this->pdo->bind("id_user", $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }
}