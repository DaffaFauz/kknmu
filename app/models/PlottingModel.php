<?php
class PlottingModel
{
    private $pdo;
    private $table = 'detail_kelompok';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getAll()
    {
        $this->pdo->query("SELECT {$this->table}.*, kelompok.nama_kelompok, lokasi.nama_desa, lokasi.nama_kecamatan, lokasi.nama_kabupaten 
                           FROM {$this->table} 
                           JOIN kelompok ON {$this->table}.id_kelompok = kelompok.id_kelompok
                           JOIN lokasi ON {$this->table}.id_lokasi = lokasi.id_lokasi");
        return $this->pdo->resultSet();
    }

    public function getFiltered($filters)
    {
        $query = "SELECT {$this->table}.*, kelompok.nama_kelompok, lokasi.nama_desa, lokasi.nama_kecamatan, lokasi.nama_kabupaten 
                  FROM {$this->table} 
                  JOIN kelompok ON {$this->table}.id_kelompok = kelompok.id_kelompok
                  JOIN lokasi ON {$this->table}.id_lokasi = lokasi.id_lokasi
                  WHERE 1=1";

        if (!empty($filters['kabupaten'])) {
            $query .= " AND lokasi.nama_kabupaten = :kabupaten";
        }
        if (!empty($filters['kecamatan'])) {
            $query .= " AND lokasi.nama_kecamatan = :kecamatan";
        }
        if (!empty($filters['desa'])) {
            $query .= " AND lokasi.nama_desa = :desa";
        }

        $this->pdo->query($query);

        if (!empty($filters['kabupaten'])) {
            $this->pdo->bind(':kabupaten', $filters['kabupaten']);
        }
        if (!empty($filters['kecamatan'])) {
            $this->pdo->bind(':kecamatan', $filters['kecamatan']);
        }
        if (!empty($filters['desa'])) {
            $this->pdo->bind(':desa', $filters['desa']);
        }

        return $this->pdo->resultSet();
    }

    public function countStudents($id_kelompok)
    {
        $this->pdo->query("SELECT COUNT(*) as total FROM mahasiswa WHERE id_kelompok = :id_kelompok");
        $this->pdo->bind(':id_kelompok', $id_kelompok);
        $result = $this->pdo->single();
        return $result['total'];
    }

    public function countStudentsByFakultas($id_kelompok)
    {
        $this->pdo->query("SELECT mahasiswa.id_prodi, prodi.id_fakultas, COUNT(*) as total 
                           FROM mahasiswa 
                           JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi 
                           WHERE mahasiswa.id_kelompok = :id_kelompok 
                           GROUP BY prodi.id_fakultas");
        $this->pdo->bind(':id_kelompok', $id_kelompok);
        return $this->pdo->resultSet();
    }

    public function createPlotting($id_kelompok, $id_lokasi, $dosen1, $dosen2, $id_tahun)
    {
        $this->pdo->query("INSERT INTO {$this->table} (id_kelompok, id_lokasi, id_dosen1, id_dosen2, id_tahun) VALUES (:id_kelompok, :id_lokasi, :dosen1, :dosen2, :id_tahun)");
        $this->pdo->bind(':id_kelompok', $id_kelompok);
        $this->pdo->bind(':id_lokasi', $id_lokasi);
        $this->pdo->bind(':dosen1', $dosen1);
        $this->pdo->bind(':dosen2', $dosen2);
        $this->pdo->bind(':id_tahun', $id_tahun);
        $this->pdo->execute();
        return $this->pdo->lastInsertId();
    }

    public function getDetailKelompokId($id_kelompok, $id_tahun)
    {
        $this->pdo->query("SELECT id FROM {$this->table} WHERE id_kelompok = :id_kelompok AND id_tahun = :id_tahun");
        $this->pdo->bind(':id_kelompok', $id_kelompok);
        $this->pdo->bind(':id_tahun', $id_tahun);
        $result = $this->pdo->single();
        return $result ? $result['id'] : false;
    }

    public function updateMahasiswaKelompok($id_mahasiswa, $id_kelompok)
    {
        $this->pdo->query("UPDATE mahasiswa SET id_kelompok = :id_kelompok WHERE id_mahasiswa = :id_mahasiswa");
        $this->pdo->bind(':id_kelompok', $id_kelompok);
        $this->pdo->bind(':id_mahasiswa', $id_mahasiswa);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function getDetailKelompok($id)
    {
        $this->pdo->query("SELECT {$this->table}.*, kelompok.nama_kelompok, lokasi.nama_desa, lokasi.nama_kecamatan, lokasi.nama_kabupaten, dosen1.nama_dosen as dosen1, dosen2.nama_dosen as dosen2
                           FROM {$this->table}
                           JOIN kelompok ON {$this->table}.id_kelompok = kelompok.id_kelompok
                           JOIN lokasi ON {$this->table}.id_lokasi = lokasi.id_lokasi
                           JOIN dosen as dosen1 ON {$this->table}.id_dosen1 = dosen1.id_dosen
                           LEFT JOIN dosen as dosen2 ON {$this->table}.id_dosen2 = dosen2.id_dosen
                           WHERE {$this->table}.id = :id");
        $this->pdo->bind(':id', $id);
        $data = $this->pdo->single();

        if ($data) {
            $this->pdo->query("SELECT mahasiswa.*, prodi.nama_prodi as jurusan 
                               FROM mahasiswa 
                               LEFT JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi
                               WHERE mahasiswa.id_kelompok = :id");
            $this->pdo->bind(':id', $id);
            $data['mahasiswa'] = $this->pdo->resultSet();
        }

        return $data;
    }

    public function destroy($id)
    {
        $this->pdo->beginTransaction();
        // Hapus detail kelompok terlebih dahulu
        $this->pdo->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        $deleted = $this->pdo->rowCount();

        // Hapus id_kelompok dari mahasiswa
        $this->pdo->query("UPDATE mahasiswa SET id_kelompok = NULL WHERE id_kelompok = :id");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        $this->pdo->commit();

        return $deleted;
    }
}