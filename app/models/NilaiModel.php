<?php
class NilaiModel
{
    private $pdo;
    private $table = 'nilai';

    public function __construct()
    {
        $this->pdo = new Db();
    }


    public function create($data)
    {
        $this->pdo->query("INSERT INTO {$this->table} (id_mahasiswa) VALUES(:id_mahasiswa)");
        $this->pdo->bind(':id_mahasiswa', $data['id_mahasiswa']);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function getKelompok()
    {
        $this->pdo->query("SELECT * FROM detail_kelompok INNER JOIN kelompok ON detail_kelompok.id_kelompok = kelompok.id_kelompok INNER JOIN mahasiswa ON detail_kelompok.id = mahasiswa.id_kelompok INNER JOIN tahun_akademik ON detail_kelompok.id_tahun = tahun_akademik.id_tahun INNER JOIN lokasi ON detail_kelompok.id_lokasi = lokasi.id_lokasi WHERE tahun_akademik.status = 'Aktif'");
        return $this->pdo->resultSet();
    }

    public function getNilaiMahasiswaForKaprodi($id)
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa INNER JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi INNER JOIN detail_kelompok ON mahasiswa.id_kelompok = detail_kelompok.id INNER JOIN tahun_akademik ON detail_kelompok.id_tahun = tahun_akademik.id_tahun WHERE tahun_akademik.status = 'Aktif' AND mahasiswa.id_prodi = :id");
        $this->pdo->bind(":id", $id);
        return $this->pdo->resultSet();
    }

    public function filter($kelompok, $kecamatan, $desa)
    {
        $query = "SELECT * FROM detail_kelompok INNER JOIN kelompok ON detail_kelompok.id_kelompok = kelompok.id_kelompok INNER JOIN mahasiswa ON detail_kelompok.id = mahasiswa.id_kelompok INNER JOIN tahun_akademik ON detail_kelompok.id_tahun = tahun_akademik.id_tahun INNER JOIN lokasi ON detail_kelompok.id_lokasi = lokasi.id_lokasi WHERE tahun_akademik.status = 'Aktif'";
        if (!empty($kelompok)) {
            $query .= " AND detail_kelompok.id_kelompok = $kelompok";
        }
        if (!empty($kecamatan)) {
            $query .= " AND detail_kelompok.id_kecamatan = $kecamatan";
        }
        if (!empty($desa)) {
            $query .= " AND detail_kelompok.id_desa = $desa";
        }
        $this->pdo->query($query);
        return $this->pdo->resultSet();
    }

    public function detail($id)
    {
        $this->pdo->query("SELECT detail_kelompok.*, kelompok.nama_kelompok, 
                           dosen1.nama_dosen AS nama_dosen1, dosen2.nama_dosen AS nama_dosen2,
                           lokasi.nama_desa, lokasi.nama_kecamatan, lokasi.nama_kabupaten,
                           mahasiswa.id_mahasiswa, mahasiswa.nim, mahasiswa.nama_mahasiswa, mahasiswa.jenis_kelamin, prodi.nama_prodi,
                           nilai.* 
                           FROM detail_kelompok 
                           INNER JOIN kelompok ON detail_kelompok.id_kelompok = kelompok.id_kelompok 
                           INNER JOIN lokasi ON detail_kelompok.id_lokasi = lokasi.id_lokasi
                           LEFT JOIN dosen AS dosen1 ON detail_kelompok.id_dosen1 = dosen1.id_dosen 
                           LEFT JOIN dosen AS dosen2 ON detail_kelompok.id_dosen2 = dosen2.id_dosen 
                           LEFT JOIN mahasiswa ON detail_kelompok.id = mahasiswa.id_kelompok 
                           LEFT JOIN nilai ON mahasiswa.id_mahasiswa = nilai.id_mahasiswa 
                           LEFT JOIN prodi ON mahasiswa.id_prodi = prodi.id_prodi 
                           WHERE detail_kelompok.id = :id");
        $this->pdo->bind('id', $id);
        return $this->pdo->resultSet();
    }

    public function update($id, $data)
    {
        if ($_SESSION['role'] == 'Admin') {
            // Mendapatkan nilai rata-rata dari semua input
            $total_nilai = $data['n_lapangan'] + $data['n_penulisan'] + $data['n_penguasaan_materi'] + $data['n_wawasan_umum'] + $data['n_teknik_presentasi'] + $data['n_penguasaan_jurnal'] + $data['n_produk_unggulan'];
            $rata_rata = round($total_nilai / 7, 2);

            // Inisiasi indeks
            $indeks = $data['indeks'];

            if ($indeks == '') {
                // Mengidentifikasi indeks berdasarkan rata-rata
                if ($rata_rata >= 86) {
                    $indeks = 'A';
                } elseif ($rata_rata >= 76) {
                    $indeks = 'B';
                } elseif ($rata_rata >= 66) {
                    $indeks = 'C';
                } elseif ($rata_rata >= 61) {
                    $indeks = 'D';
                } elseif ($rata_rata >= 51) {
                    $indeks = 'E';
                } else {
                    $indeks = 'T';
                }
            }

            $this->pdo->query("UPDATE nilai SET n_lapangan = :n_lapangan, n_penulisan = :n_penulisan, n_sistematika_penulisan = :n_sistematika_penulisan, n_penguasaan_materi = :n_penguasaan_materi, n_wawasan_umum = :n_wawasan_umum, n_teknik_presentasi = :n_teknik_presentasi, n_penguasaan_jurnal = :n_penguasaan_jurnal, n_produk_unggulan = :n_produk_unggulan, n_rata_rata = :n_rata_rata, indeks = :indeks WHERE id_nilai = :id_nilai");
            $this->pdo->bind('id_nilai', $id);
            $this->pdo->bind('n_lapangan', $data['n_lapangan']);
            $this->pdo->bind('n_penulisan', $data['n_penulisan']);
            $this->pdo->bind('n_sistematika_penulisan', $data['n_sistematika_penulisan']);
            $this->pdo->bind('n_penguasaan_materi', $data['n_penguasaan_materi']);
            $this->pdo->bind('n_wawasan_umum', $data['n_wawasan_umum']);
            $this->pdo->bind('n_teknik_presentasi', $data['n_teknik_presentasi']);
            $this->pdo->bind('n_penguasaan_jurnal', $data['n_penguasaan_jurnal']);
            $this->pdo->bind('n_produk_unggulan', $data['n_produk_unggulan']);
            $this->pdo->bind('n_rata_rata', $rata_rata);
            $this->pdo->bind('indeks', $indeks);
            return $this->pdo->execute();
        } else if ($_SESSION['role'] == 'Pembimbing') {
            // Mendapatkan nilai rata-rata dari semua input
            $total_nilai = $data['n_lapangan'] + $data['n_penulisan'];
            $rata_rata = round($total_nilai / 2, 2);

            // Inisiasi indeks
            $indeks = $data['indeks'];

            if ($indeks == '') {
                // Mengidentifikasi indeks berdasarkan rata-rata
                if ($rata_rata >= 86) {
                    $indeks = 'A';
                } elseif ($rata_rata >= 76) {
                    $indeks = 'B';
                } elseif ($rata_rata >= 66) {
                    $indeks = 'C';
                } elseif ($rata_rata >= 61) {
                    $indeks = 'D';
                } elseif ($rata_rata >= 51) {
                    $indeks = 'E';
                } else {
                    $indeks = 'T';
                }
            }

            $this->pdo->query("UPDATE nilai SET n_lapangan = :n_lapangan, n_penulisan = :n_penulisan, n_rata_rata = :n_rata_rata, indeks = :indeks WHERE id_nilai = :id_nilai");
            $this->pdo->bind('id_nilai', $id);
            $this->pdo->bind('n_lapangan', $data['n_lapangan']);
            $this->pdo->bind('n_penulisan', $data['n_penulisan']);
            $this->pdo->bind('n_rata_rata', $rata_rata);
            $this->pdo->bind('indeks', $indeks);
            $this->pdo->execute();
            return $this->pdo->rowCount();
        }
    }

    public function updateFromPenguji($id, $data)
    {
        // Get data mahasiswa from id
        $this->pdo->query("SELECT * FROM mahasiswa INNER JOIN nilai ON mahasiswa.id_mahasiswa = nilai.id_mahasiswa WHERE id_kelompok = :id_kelompok");
        $this->pdo->bind(':id_kelompok', $id);
        $mahasiswa = $this->pdo->resultSet();

        if ($_SESSION['role'] == 'Penguji 1') {
            // Foreach for input data
            foreach ($mahasiswa as $mhs) {
                // Calculate average using existing values + new values
                $nilai_lapangan = $mhs['n_lapangan'] ?? 0;
                $nilai_penulisan = $mhs['n_penulisan'] ?? 0;
                // Penguji 1 inputs
                $nilai_sistematika_penulisan = $data['n_sistematika_penulisan'];
                $nilai_penguasaan_materi = $data['n_penguasaan_materi'];
                $nilai_wawasan_umum = $data['n_wawasan_umum'];
                // Penguji 2 inputs (existing)
                $nilai_teknik_presentasi = $mhs['n_teknik_presentasi'] ?? 0;
                $nilai_penguasaan_jurnal = $mhs['n_penguasaan_jurnal'] ?? 0;
                $nilai_produk_unggulan = $mhs['n_produk_unggulan'] ?? 0;

                $total = $nilai_lapangan + $nilai_penulisan + $nilai_sistematika_penulisan + $nilai_penguasaan_materi + $nilai_wawasan_umum + $nilai_teknik_presentasi + $nilai_penguasaan_jurnal + $nilai_produk_unggulan;
                $rata_rata = round($total / 8, 2);

                $this->pdo->query("UPDATE nilai SET n_sistematika_penulisan = :n_sistematika_penulisan, n_penguasaan_materi = :n_penguasaan_materi, n_wawasan_umum = :n_wawasan_umum, n_rata_rata = :n_rata_rata WHERE nilai.id_nilai = :id_nilai");
                $this->pdo->bind('id_nilai', $mhs['id_nilai']);
                $this->pdo->bind('n_sistematika_penulisan', $nilai_sistematika_penulisan);
                $this->pdo->bind('n_penguasaan_materi', $nilai_penguasaan_materi);
                $this->pdo->bind('n_wawasan_umum', $nilai_wawasan_umum);
                $this->pdo->bind('n_rata_rata', $rata_rata);
                $this->pdo->execute();

                // Input data nilai_dosen
                $this->pdo->query("INSERT INTO dosen_nilai (id_dosen, id_nilai) VALUES(:id_dosen, :id_nilai)");
                $this->pdo->bind('id_dosen', $data['nama_penguji']);
                $this->pdo->bind('id_nilai', $mhs['id_nilai']);
                $this->pdo->execute();
            }
            return $this->pdo->rowCount();
        } else if ($_SESSION['role'] == 'Penguji 2') {
            // Foreach for input data
            foreach ($mahasiswa as $mhs) {
                // Calculate average using existing values + new values
                $nilai_lapangan = $mhs['n_lapangan'] ?? 0;
                $nilai_penulisan = $mhs['n_penulisan'] ?? 0;
                // Penguji 1 inputs (existing)
                $nilai_sistematika_penulisan = $mhs['n_sistematika_penulisan'] ?? 0;
                $nilai_penguasaan_materi = $mhs['n_penguasaan_materi'] ?? 0;
                $nilai_wawasan_umum = $mhs['n_wawasan_umum'] ?? 0;
                // Penguji 2 inputs
                $nilai_teknik_presentasi = $data['n_teknik_presentasi'];
                $nilai_penguasaan_jurnal = $data['n_penguasaan_jurnal'];
                $nilai_produk_unggulan = $data['n_produk_unggulan'];

                $total = $nilai_lapangan + $nilai_penulisan + $nilai_sistematika_penulisan + $nilai_penguasaan_materi + $nilai_wawasan_umum + $nilai_teknik_presentasi + $nilai_penguasaan_jurnal + $nilai_produk_unggulan;
                $rata_rata = round($total / 8, 2);

                $this->pdo->query("UPDATE nilai SET n_teknik_presentasi = :n_teknik_presentasi, n_penguasaan_jurnal = :n_penguasaan_jurnal, n_produk_unggulan = :n_produk_unggulan, n_rata_rata = :n_rata_rata WHERE nilai.id_nilai = :id_nilai");
                $this->pdo->bind('id_nilai', $mhs['id_nilai']);
                $this->pdo->bind('n_teknik_presentasi', $nilai_teknik_presentasi);
                $this->pdo->bind('n_penguasaan_jurnal', $nilai_penguasaan_jurnal);
                $this->pdo->bind('n_produk_unggulan', $nilai_produk_unggulan);
                $this->pdo->bind('n_rata_rata', $rata_rata);
                $this->pdo->execute();

                // Input data nilai_dosen
                $this->pdo->query("INSERT INTO dosen_nilai (id_dosen, id_nilai) VALUES(:id_dosen, :id_nilai)");
                $this->pdo->bind('id_dosen', $data['nama_penguji']);
                $this->pdo->bind('id_nilai', $mhs['id_nilai']);
                $this->pdo->execute();
            }
            return $this->pdo->rowCount();
        }
    }

    public function isNilaiLengkap($data)
    {
        if (!$data) {
            return false;
        }

        // List of all required grade components
        $components = [
            'n_lapangan',
            'n_penulisan',
            'n_sistematika_penulisan',
            'n_penguasaan_materi',
            'n_wawasan_umum',
            'n_teknik_presentasi',
            'n_penguasaan_jurnal',
            'n_produk_unggulan'
        ];

        foreach ($components as $component) {
            if (!isset($data[$component]) || $data[$component] === null || $data[$component] === '') {
                return false;
            }
        }

        return true;
    }

    public function getNilaiMahasiswa($id)
    {
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN mahasiswa ON {$this->table}.id_mahasiswa = mahasiswa.id_mahasiswa WHERE {$this->table}.id_mahasiswa = :id");
        $this->pdo->bind('id', $id);
        return $this->pdo->single();
    }
}