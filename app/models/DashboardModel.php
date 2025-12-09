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
        $this->pdo->query("SELECT * FROM pendaftaran JOIN tahun_akademik ON pendaftaran.id_tahun = tahun_akademik.id_tahun WHERE id_mahasiswa = :id_mahasiswa AND status_pendaftaran = 'Diverifikasi'");
        $this->pdo->bind(':id_mahasiswa', $id_mahasiswa);
        return $this->pdo->single();
    }

    public function getPlottingKelompok($id_kelompok)
    {
        $this->pdo->query("SELECT detail_kelompok.*, 
                                  dosen1.nama_dosen as nama_dosen1,
                                  dosen2.nama_dosen as nama_dosen2
                           FROM detail_kelompok 
                           INNER JOIN dosen as dosen1 ON detail_kelompok.id_dosen1 = dosen1.id_dosen 
                           LEFT JOIN dosen as dosen2 ON detail_kelompok.id_dosen2 = dosen2.id_dosen
                           INNER JOIN tahun_akademik ON detail_kelompok.id_tahun = tahun_akademik.id_tahun
                           WHERE detail_kelompok.id = :id_kelompok 
                           AND tahun_akademik.status = 'Aktif'");
        $this->pdo->bind(':id_kelompok', $id_kelompok);
        return $this->pdo->single();
    }
}