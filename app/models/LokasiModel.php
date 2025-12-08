<?php

class LokasiModel
{
    private $pdo;
    protected $table = 'lokasi';

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
        $this->pdo->query("INSERT INTO {$this->table} (nama_desa, nama_kecamatan, nama_kabupaten) VALUES (:nama_desa, :nama_kecamatan, :nama_kabupaten)");
        $this->pdo->bind(':nama_desa', $data['nama_desa']);
        $this->pdo->bind(':nama_kecamatan', $data['nama_kecamatan']);
        $this->pdo->bind(':nama_kabupaten', $data['nama_kabupaten']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function update($id, $data)
    {
        $this->pdo->query("UPDATE {$this->table} SET nama_desa = :nama_desa, nama_kecamatan = :nama_kecamatan, nama_kabupaten = :nama_kabupaten WHERE id_lokasi = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->bind(':nama_desa', $data['nama_desa']);
        $this->pdo->bind(':nama_kecamatan', $data['nama_kecamatan']);
        $this->pdo->bind(':nama_kabupaten', $data['nama_kabupaten']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function delete($id)
    {
        $this->pdo->query("DELETE FROM {$this->table} WHERE id_lokasi = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function getKabupaten()
    {
        $this->pdo->query("SELECT DISTINCT nama_kabupaten FROM {$this->table} ORDER BY nama_kabupaten ASC");
        return $this->pdo->resultSet();
    }

    public function getKecamatan($kabupaten = null)
    {
        $query = "SELECT DISTINCT nama_kecamatan FROM {$this->table}";
        if ($kabupaten) {
            $query .= " WHERE nama_kabupaten = :kabupaten";
        }
        $query .= " ORDER BY nama_kecamatan ASC";

        $this->pdo->query($query);
        if ($kabupaten) {
            $this->pdo->bind(':kabupaten', $kabupaten);
        }
        return $this->pdo->resultSet();
    }

    public function filter($data)
    {
        $query = "SELECT * FROM {$this->table} WHERE 1=1";

        if (!empty($data['kecamatan'])) {
            $query .= " AND nama_kecamatan = :nama_kecamatan";
        }

        if (!empty($data['kabupaten'])) {
            $query .= " AND nama_kabupaten = :nama_kabupaten";
        }

        $this->pdo->query($query);
        if (!empty($data['kecamatan'])) {
            $this->pdo->bind(':nama_kecamatan', $data['kecamatan']);
        }
        if (!empty($data['kabupaten'])) {
            $this->pdo->bind(':nama_kabupaten', $data['kabupaten']);
        }
        return $this->pdo->resultSet();
    }
}
