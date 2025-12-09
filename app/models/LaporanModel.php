<?php

class LaporanModel
{
    private $pdo;
    private $table1 = 'laporan_harian';
    private $table2 = 'laporan_akhir';
    private $table3 = 'nilai';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getLaporanHarian()
    {
        $this->pdo->query("SELECT * FROM {$this->table1}");
        return $this->pdo->resultSet();
    }

    public function getLaporanAkhir()
    {
        $this->pdo->query("SELECT * FROM {$this->table2}");
        return $this->pdo->resultSet();
    }

    public function getNilai()
    {
        $this->pdo->query("SELECT * FROM {$this->table3}");
        return $this->pdo->resultSet();
    }

    public function getLaporanHarianForMahasiswaAndPembimbing($id)
    {
        $this->pdo->query("SELECT * FROM {$this->table1} WHERE id_kelompok = :id");
        $this->pdo->bind(':id', $id);
        return $this->pdo->resultSet();
    }

    public function createHarian($data)
    {
        $this->pdo->query("INSERT INTO {$this->table1} (id_kelompok, judul, isi_laporan, tanggal, dokumentasi) VALUES (:id_kelompok, :judul, :isi_laporan, :tanggal, :dokumentasi)");
        $this->pdo->bind(':id_kelompok', $data['id_kelompok']);
        $this->pdo->bind(':judul', $data['judul']);
        $this->pdo->bind(':isi_laporan', $data['deskripsi']);
        $this->pdo->bind(':tanggal', $data['tanggal']);
        $this->pdo->bind(':dokumentasi', $data['file']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }
}