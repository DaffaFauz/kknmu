<?php
class FakultasModel
{
    private $pdo;
    private $table = 'fakultas';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getAll()
    {
        $this->pdo->query("SELECT * FROM {$this->table}");
        return $this->pdo->resultSet();
    }

    public function create($data)
    {
        $this->pdo->query("INSERT INTO {$this->table} (kode_fakultas, nama_fakultas) VALUES (:kode_fakultas, :nama_fakultas)");
        $this->pdo->bind(':kode_fakultas', $data['kode_fakultas']);
        $this->pdo->bind(':nama_fakultas', $data['nama_fakultas']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function update($id, $data)
    {
        $this->pdo->query("UPDATE {$this->table} SET kode_fakultas = :kode_fakultas, nama_fakultas = :nama_fakultas WHERE id_fakultas = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->bind(':kode_fakultas', $data['kode_fakultas']);
        $this->pdo->bind(':nama_fakultas', $data['nama_fakultas']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    // public function delete($id)
    // {
    //     $this->pdo->query("DELETE FROM {$this->table} WHERE id_fakultas = :id");
    //     $this->pdo->bind(':id', $id);
    //     $this->pdo->execute();
    //     return $this->pdo->rowCount();
    // }
}