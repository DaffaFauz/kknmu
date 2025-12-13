<?php
class VerifikasiModel
{
    private $pdo;
    private $table = 'pendaftaran';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getForAdmin()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi INNER JOIN fakultas ON prodi.id_fakultas = fakultas.id_fakultas INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun WHERE tahun_akademik.status = 'Aktif'");
        return $this->pdo->resultSet();
    }

    public function getForKaprodi($id)
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun WHERE mahasiswa.id_prodi = :id_prodi AND {$this->table}.status_pendaftaran = 'Pending' OR {$this->table}.status_pendaftaran = 'Diverifikasi Kaprodi' AND tahun_akademik.status = 'Aktif'");
        $this->pdo->bind(':id_prodi', $id);
        return $this->pdo->resultSet();
    }

    public function verifikasi($id)
    {
        if ($_SESSION['role'] == 'Kaprodi') {
            $this->pdo->query("UPDATE {$this->table} SET status_pendaftaran = 'Diverifikasi Kaprodi' WHERE id_pendaftaran = :id_pendaftaran");
            $this->pdo->bind(':id_pendaftaran', $id);
            $this->pdo->execute();
            return $this->pdo->rowCount();
        } else if ($_SESSION['role'] == 'Admin') {
            $this->pdo->query("UPDATE {$this->table} SET status_pendaftaran = 'Diverifikasi' WHERE id_pendaftaran = :id_pendaftaran");
            $this->pdo->bind(':id_pendaftaran', $id);
            $this->pdo->execute();
            return $this->pdo->rowCount();
        }
    }

    public function tolak($id, $data)
    {
        $this->pdo->query("UPDATE {$this->table} SET status_pendaftaran = 'Ditolak', catatan = :catatan WHERE id_pendaftaran = :id_pendaftaran");
        $this->pdo->bind(':id_pendaftaran', $id);
        $this->pdo->bind(':catatan', $data['catatan']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function filterForKaprodi($id, $data)
    {
        $query = "SELECT * FROM {$this->table} 
                  INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa 
                  INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi
                  INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun 
                  WHERE mahasiswa.id_prodi = :id_prodi AND {$this->table}.status_pendaftaran = 'Pending' AND tahun_akademik.status = 'Aktif'";

        if (!empty($data['kelas'])) {
            $query .= " AND mahasiswa.kelas = :kelas";
        }

        $this->pdo->query($query);
        $this->pdo->bind(':id_prodi', $id);

        if (!empty($data['kelas'])) {
            $this->pdo->bind(':kelas', $data['kelas']);
        }

        return $this->pdo->resultSet();
    }

    public function revisi($id, $data)
    {
        $this->pdo->query("UPDATE {$this->table} SET status_pendaftaran = 'Revisi', catatan = :catatan WHERE id_pendaftaran = :id_pendaftaran");
        $this->pdo->bind(':id_pendaftaran', $id);
        $this->pdo->bind(':catatan', $data['catatan']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function filterForAdmin($data)
    {
        $query = "SELECT * FROM {$this->table} 
                  INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa 
                  INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi 
                  INNER JOIN fakultas ON prodi.id_fakultas = fakultas.id_fakultas 
                  INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun 
                  WHERE tahun_akademik.status = 'Aktif'";

        if (!empty($data['id_fakultas'])) {
            $query .= ' AND fakultas.id_fakultas = :fakultas';
        }

        if (!empty($data['id_prodi'])) {
            $query .= ' AND prodi.id_prodi = :prodi';
        }
        // if (!empty($data['status_pendaftaran'])) {
        //     $query .= " AND {$this->table}.status_pendaftaran = :status_pendaftaran";
        // }

        $this->pdo->query($query);

        if (!empty($data['id_fakultas'])) {
            $this->pdo->bind(':fakultas', $data['id_fakultas']);
        }

        if (!empty($data['id_prodi'])) {
            $this->pdo->bind(':prodi', $data['id_prodi']);
        }

        // if (!empty($data['status_pendaftaran'])) {
        //     $this->pdo->bind(':status_pendaftaran', $data['status_pendaftaran']);
        // }

        return $this->pdo->resultSet();
    }

    // For Dashboard Kaprodi
    public function getVerifMahasiswaProdi($id)
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun WHERE {$this->table}.status_pendaftaran = 'Diverifikasi Kaprodi' OR {$this->table}.status_pendaftaran = 'Diverifikasi' AND prodi.id_prodi = :id AND tahun_akademik.status = 'Aktif'");
        $this->pdo->bind(':id', $id);
        $this->pdo->execute();
        return $this->pdo->resultset();
    }

    // For verifikasi mahasiswa in Admin page
    public function verifKaprodi()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun WHERE {$this->table}.status_pendaftaran = 'Diverifikasi Kaprodi' OR {$this->table}.status_pendaftaran = 'Diverifikasi' AND tahun_akademik.status = 'Aktif'");
        return $this->pdo->resultSet();
    }

    public function verif()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun WHERE {$this->table}.status_pendaftaran = 'Diverifikasi' AND tahun_akademik.status = 'Aktif'");
        return $this->pdo->resultSet();
    }

    public function getrevisi()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun WHERE {$this->table}.status_pendaftaran = 'Revisi' AND tahun_akademik.status = 'Aktif'");
        return $this->pdo->resultSet();
    }

    public function getDitolak()
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun WHERE {$this->table}.status_pendaftaran = 'Ditolak' AND tahun_akademik.status = 'Aktif'");
        return $this->pdo->resultSet();
    }

    public function filterVerifKaprodi($data)
    {
        $query = "SELECT * FROM {$this->table} 
                  INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa 
                  INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi 
                  INNER JOIN fakultas ON prodi.id_fakultas = fakultas.id_fakultas 
                  INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun 
                  WHERE tahun_akademik.status = 'Aktif'";

        if (!empty($data['id_fakultas'])) {
            $query .= ' AND fakultas.id_fakultas = :fakultas';
        }

        if (!empty($data['id_prodi'])) {
            $query .= ' AND prodi.id_prodi = :prodi';
        }
        // if (!empty($data['status_pendaftaran'])) {
        //     $query .= " AND {$this->table}.status_pendaftaran = :status_pendaftaran";
        // }

        $this->pdo->query($query);

        if (!empty($data['id_fakultas'])) {
            $this->pdo->bind(':fakultas', $data['id_fakultas']);
        }

        if (!empty($data['id_prodi'])) {
            $this->pdo->bind(':prodi', $data['id_prodi']);
        }

        // if (!empty($data['status_pendaftaran'])) {
        //     $this->pdo->bind(':status_pendaftaran', $data['status_pendaftaran']);
        // }

        return $this->pdo->resultSet();
    }

    public function filterVerif($data)
    {
        $query = "SELECT * FROM {$this->table} 
                  INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa 
                  INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi 
                  INNER JOIN fakultas ON prodi.id_fakultas = fakultas.id_fakultas 
                  INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun 
                  WHERE tahun_akademik.status = 'Aktif'";

        if (!empty($data['id_fakultas'])) {
            $query .= ' AND fakultas.id_fakultas = :fakultas';
        }

        if (!empty($data['id_prodi'])) {
            $query .= ' AND prodi.id_prodi = :prodi';
        }
        // if (!empty($data['status_pendaftaran'])) {
        //     $query .= " AND {$this->table}.status_pendaftaran = :status_pendaftaran";
        // }

        $this->pdo->query($query);

        if (!empty($data['id_fakultas'])) {
            $this->pdo->bind(':fakultas', $data['id_fakultas']);
        }

        if (!empty($data['id_prodi'])) {
            $this->pdo->bind(':prodi', $data['id_prodi']);
        }

        // if (!empty($data['status_pendaftaran'])) {
        //     $this->pdo->bind(':status_pendaftaran', $data['status_pendaftaran']);
        // }

        return $this->pdo->resultSet();
    }

    public function filterRevisi($data)
    {
        $query = "SELECT * FROM {$this->table} 
                  INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa 
                  INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi 
                  INNER JOIN fakultas ON prodi.id_fakultas = fakultas.id_fakultas 
                  INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun 
                  WHERE tahun_akademik.status = 'Aktif'";

        if (!empty($data['id_fakultas'])) {
            $query .= ' AND fakultas.id_fakultas = :fakultas';
        }

        if (!empty($data['id_prodi'])) {
            $query .= ' AND prodi.id_prodi = :prodi';
        }
        // if (!empty($data['status_pendaftaran'])) {
        //     $query .= " AND {$this->table}.status_pendaftaran = :status_pendaftaran";
        // }

        $this->pdo->query($query);

        if (!empty($data['id_fakultas'])) {
            $this->pdo->bind(':fakultas', $data['id_fakultas']);
        }

        if (!empty($data['id_prodi'])) {
            $this->pdo->bind(':prodi', $data['id_prodi']);
        }

        // if (!empty($data['status_pendaftaran'])) {
        //     $this->pdo->bind(':status_pendaftaran', $data['status_pendaftaran']);
        // }

        return $this->pdo->resultSet();
    }

    public function filterDitolak($data)
    {
        $query = "SELECT * FROM {$this->table} 
                  INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa 
                  INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi 
                  INNER JOIN fakultas ON prodi.id_fakultas = fakultas.id_fakultas 
                  INNER JOIN tahun_akademik ON {$this->table}.id_tahun = tahun_akademik.id_tahun 
                  WHERE tahun_akademik.status = 'Aktif'";

        if (!empty($data['id_fakultas'])) {
            $query .= ' AND fakultas.id_fakultas = :fakultas';
        }

        if (!empty($data['id_prodi'])) {
            $query .= ' AND prodi.id_prodi = :prodi';
        }
        // if (!empty($data['status_pendaftaran'])) {
        //     $query .= " AND {$this->table}.status_pendaftaran = :status_pendaftaran";
        // }

        $this->pdo->query($query);

        if (!empty($data['id_fakultas'])) {
            $this->pdo->bind(':fakultas', $data['id_fakultas']);
        }

        if (!empty($data['id_prodi'])) {
            $this->pdo->bind(':prodi', $data['id_prodi']);
        }

        // if (!empty($data['status_pendaftaran'])) {
        //     $this->pdo->bind(':status_pendaftaran', $data['status_pendaftaran']);
        // }

        return $this->pdo->resultSet();
    }
}
