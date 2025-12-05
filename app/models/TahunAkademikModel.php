<?php

class TahunAkademikModel
{
    private $pdo;
    private $table = 'tahun_akademik';

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
        $this->pdo->query("INSERT INTO {$this->table} (periode, status) VALUES (:periode, :status)");
        $this->pdo->bind(':periode', $data['periode']);
        $this->pdo->bind(':status', 'Aktif');
        return $this->pdo->execute();
    }

    public function update($id, $data)
    {
        $this->pdo->query("UPDATE {$this->table} SET periode = :periode WHERE id_tahun = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->bind(':periode', $data['periode']);
        return $this->pdo->execute();
    }

    public function switch($id)
    {
        // Get current status
        $this->pdo->query("SELECT status FROM {$this->table} WHERE id_tahun = :id");
        $this->pdo->bind(':id', $id);
        $status = $this->pdo->single();

        if ($status['status'] == 'Aktif') {
            $this->pdo->query("UPDATE {$this->table} SET status = 'Nonaktif' WHERE id_tahun = :id");
        } else {
            $this->pdo->query("UPDATE {$this->table} SET status = 'Aktif' WHERE id_tahun = :id");
        }

        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }
}