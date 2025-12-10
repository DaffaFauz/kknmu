<?php

class LaporanModel
{
    private $pdo;
    private $table1 = 'laporan_harian';
    private $table2 = 'laporan_akhir';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getLaporanHarian()
    {
        $this->pdo->query("SELECT * FROM {$this->table1} INNER JOIN detail_kelompok ON {$this->table1}.id_kelompok = detail_kelompok.id INNER JOIN kelompok ON detail_kelompok.id_kelompok = kelompok.id_kelompok INNER JOIN lokasi ON detail_kelompok.id_lokasi = lokasi.id_lokasi");
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
        $this->pdo->query("INSERT INTO {$this->table1} (id_kelompok, tanggal, judul, isi_laporan, dokumentasi) VALUES (:id_kelompok, :tanggal, :judul, :isi_laporan, :dokumentasi)");
        $this->pdo->bind(':id_kelompok', $data['id_kelompok']);
        $this->pdo->bind(':judul', $data['judul']);
        $this->pdo->bind(':isi_laporan', $data['deskripsi']);
        $this->pdo->bind(':tanggal', $data['tanggal']);
        $this->pdo->bind(':dokumentasi', $data['file']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function updateHarian($data)
    {
        if (empty($data['file'])) {
            $this->pdo->query("UPDATE {$this->table1} SET judul = :judul, isi_laporan = :isi_laporan, tanggal = :tanggal WHERE id_laporan = :id_laporan");
        } else {
            $this->pdo->query("UPDATE {$this->table1} SET judul = :judul, isi_laporan = :isi_laporan, tanggal = :tanggal, dokumentasi = :dokumentasi WHERE id_laporan = :id_laporan");
            $this->pdo->bind(':dokumentasi', $data['file']);
        }

        $this->pdo->bind(':id_laporan', $data['id_laporan']);
        $this->pdo->bind(':judul', $data['judul']);
        $this->pdo->bind(':isi_laporan', $data['deskripsi']);
        $this->pdo->bind(':tanggal', $data['tanggal']);

        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function deleteHarian($id)
    {
        $this->pdo->query("DELETE FROM {$this->table1} WHERE id_laporan = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function filterLaporanHarian($tanggal)
    {
        $this->pdo->query("SELECT * FROM {$this->table1} WHERE tanggal = :tanggal");
        $this->pdo->bind(':tanggal', $tanggal);
        return $this->pdo->resultSet();
    }

    public function filterLaporanHarianForMahasiswaAndPembimbing($id, $tanggal)
    {
        $this->pdo->query("SELECT * FROM {$this->table1} WHERE id_kelompok = :id AND tanggal = :tanggal");
        $this->pdo->bind(':id', $id);
        $this->pdo->bind(':tanggal', $tanggal);
        return $this->pdo->resultSet();
    }


    public function getLaporanAkhirForMahasiswaAndPembimbing($id)
    {
        $this->pdo->query("SELECT * FROM {$this->table2} INNER JOIN detail_kelompok ON {$this->table2}.id_kelompok = detail_kelompok.id INNER JOIN tahun_akademik ON detail_kelompok.id_tahun = tahun_akademik.id_tahun WHERE {$this->table2}.id_kelompok = :id AND tahun_akademik.status = 'Aktif'");
        $this->pdo->bind(':id', $id);
        return $this->pdo->resultSet();
    }

    public function getLaporanAkhir()
    {
        $this->pdo->query("SELECT * FROM {$this->table2} INNER JOIN detail_kelompok ON {$this->table2}.id_kelompok = detail_kelompok.id INNER JOIN tahun_akademik ON detail_kelompok.id_tahun = tahun_akademik.id_tahun INNER JOIN kelompok ON detail_kelompok.id_kelompok = kelompok.id_kelompok INNER JOIN lokasi ON detail_kelompok.id_lokasi = lokasi.id_lokasi WHERE tahun_akademik.status = 'Aktif'");
        return $this->pdo->resultSet();
    }

    public function createAkhir($data)
    {
        $this->pdo->query("INSERT INTO {$this->table2} (id_kelompok, judul, link_video, dokumen_laporan, dokumen_jurnal, produk_unggulan, dokumentasi, status_verifikasi) VALUES (:id_kelompok, :judul, :link_video, :dokumen_laporan, :dokumen_jurnal, :produk_unggulan, :dokumentasi, :status_verifikasi)");
        $this->pdo->bind(':id_kelompok', $data['id_kelompok']);
        $this->pdo->bind(':judul', $data['judul']);
        $this->pdo->bind(':link_video', $data['link_video']);
        $this->pdo->bind(':dokumen_laporan', $data['dokumen_laporan']);
        $this->pdo->bind(':dokumen_jurnal', $data['dokumen_jurnal']);
        $this->pdo->bind(':produk_unggulan', $data['produk_unggulan']);
        $this->pdo->bind(':dokumentasi', $data['dokumentasi']);
        $this->pdo->bind(':status_verifikasi', 'Pending');
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function updateAkhir($data)
    {
        $query = "UPDATE {$this->table2} SET judul = :judul, link_video = :link_video, status_verifikasi = :status_verifikasi";

        if (!empty($data['dokumen_laporan'])) {
            $query .= ", dokumen_laporan = :dokumen_laporan";
        }
        if (!empty($data['dokumen_jurnal'])) {
            $query .= ", dokumen_jurnal = :dokumen_jurnal";
        }
        if (!empty($data['produk_unggulan'])) {
            $query .= ", produk_unggulan = :produk_unggulan";
        }
        if (!empty($data['dokumentasi'])) {
            $query .= ", dokumentasi = :dokumentasi";
        }

        $query .= " WHERE id_laporan = :id_laporan";

        $this->pdo->query($query);

        $this->pdo->bind(':id_laporan', $data['id_laporan']);
        $this->pdo->bind(':judul', $data['judul']);
        $this->pdo->bind(':link_video', $data['link_video']);
        $this->pdo->bind(':status_verifikasi', 'Pending');

        if (!empty($data['dokumen_laporan'])) {
            $this->pdo->bind(':dokumen_laporan', $data['dokumen_laporan']);
        }
        if (!empty($data['dokumen_jurnal'])) {
            $this->pdo->bind(':dokumen_jurnal', $data['dokumen_jurnal']);
        }
        if (!empty($data['produk_unggulan'])) {
            $this->pdo->bind(':produk_unggulan', $data['produk_unggulan']);
        }
        if (!empty($data['dokumentasi'])) {
            $this->pdo->bind(':dokumentasi', $data['dokumentasi']);
        }

        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function verifikasiLaporanAkhir($id)
    {
        $this->pdo->query("UPDATE {$this->table2} SET status_verifikasi = 'Diterima' WHERE id_laporan = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function revisiLaporanAkhir($id, $data)
    {
        $this->pdo->query("UPDATE {$this->table2} SET status_verifikasi = 'Revisi', catatan = :catatan WHERE id_laporan = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->bind(':catatan', $data['catatan']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function filterLaporanAkhir($kabupaten, $kecamatan = null, $desa = null)
    {
        $query = "SELECT * FROM {$this->table2} INNER JOIN detail_kelompok ON {$this->table2}.id_kelompok = detail_kelompok.id INNER JOIN tahun_akademik ON detail_kelompok.id_tahun = tahun_akademik.id_tahun INNER JOIN kelompok ON detail_kelompok.id_kelompok = kelompok.id_kelompok INNER JOIN lokasi ON detail_kelompok.id_lokasi = lokasi.id_lokasi WHERE tahun_akademik.status = 'Aktif'";

        if (!empty($kabupaten)) {
            $query .= " AND lokasi.nama_kabupaten = :kabupaten";
        }
        if (!empty($kecamatan)) {
            $query .= " AND lokasi.nama_kecamatan = :kecamatan";
        }
        if (!empty($desa)) {
            $query .= " AND lokasi.nama_desa = :desa";
        }

        $this->pdo->query($query);

        if (!empty($kabupaten)) {
            $this->pdo->bind(':kabupaten', $kabupaten);
        }
        if (!empty($kecamatan)) {
            $this->pdo->bind(':kecamatan', $kecamatan);
        }
        if (!empty($desa)) {
            $this->pdo->bind(':desa', $desa);
        }

        return $this->pdo->resultSet();
    }
}