<?php
class ProdiModel
{
    private $pdo;
    private $table = 'prodi';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getAll()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN fakultas ON {$this->table}.id_fakultas = fakultas.id_fakultas");
        return $this->pdo->resultSet();
    }

    public function filter($id)
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN fakultas ON {$this->table}.id_fakultas = fakultas.id_fakultas WHERE {$this->table}.id_fakultas = :id");
        $this->pdo->bind(':id', $id);
        return $this->pdo->resultSet();
    }

    public function create($data)
    {
        $this->pdo->query("INSERT INTO {$this->table} (kode_prodi, nama_prodi, id_fakultas) VALUES (:kode_prodi, :nama_prodi, :id_fakultas)");
        $this->pdo->bind(':kode_prodi', $data['kode_prodi']);
        $this->pdo->bind(':nama_prodi', $data['nama_prodi']);
        $this->pdo->bind(':id_fakultas', $data['id_fakultas']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function update($id, $data)
    {
        $this->pdo->query("UPDATE {$this->table} SET kode_prodi = :kode_prodi, nama_prodi = :nama_prodi, id_fakultas = :id_fakultas WHERE id_prodi = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->bind(':kode_prodi', $data['kode_prodi']);
        $this->pdo->bind(':nama_prodi', $data['nama_prodi']);
        $this->pdo->bind(':id_fakultas', $data['id_fakultas']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function delete($id)
    {
        $this->pdo->query("DELETE FROM {$this->table} WHERE id_prodi = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function getNamaForKaprodi($id)
    {
        $this->pdo->query("SELECT nama_prodi FROM {$this->table} WHERE id_prodi = :id_prodi");
        $this->pdo->bind(':id_prodi', $id);
        return $this->pdo->single();
    }
}