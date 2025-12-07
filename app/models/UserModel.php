<?php

class UserModel
{
    private $pdo;
    private $table = 'users';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function login($data)
    {
        // Validasi input
        $username = $data['username'];
        $password = $data['password'];

        if (empty($username) || empty($password)) {
            redirectWithMsg(BASE_URL, 'Username atau password tidak boleh kosong!', 'danger');
        }

        // Get data user
        $this->pdo->query("SELECT * FROM {$this->table} INNER JOIN user_jabatan ON {$this->table}.id_user = user_jabatan.id_user INNER JOIN jabatan ON user_jabatan.id_jabatan = jabatan.id_jabatan WHERE {$this->table}.username = :username");
        $this->pdo->bind(':username', $username);
        $user = $this->pdo->single();

        // Matching password
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama'] = $user['name'];

            // Mendapatkan semua jabatan user
            $this->pdo->query("SELECT * FROM user_jabatan WHERE id_user = :id_user");
            $this->pdo->bind(':id_user', $user['id_user']);
            $jabatan = $this->pdo->resultSet();

            $_SESSION['jml_jabatan'] = count($jabatan);
            $_SESSION['jabatan_list'] = $jabatan;
            $_SESSION['role'] = $user['nama_jabatan'];

            // Jika mahasiswa, ambil id_mahasiswa untuk pengajuan daftar KKN
            if ($user['nama_jabatan'] === 'Mahasiswa') {
                $this->pdo->query("SELECT * FROM mahasiswa WHERE id_user = :id_user");
                $this->pdo->bind(':id_user', $user['id_user']);
                $mahasiswa = $this->pdo->single();
                if ($mahasiswa) {
                    $_SESSION['id_mahasiswa'] = $mahasiswa['id_mahasiswa'];
                }
            }
            // Jika bukan mahasiswa, ambil prodi untuk dosen
            else if ($user['nama_jabatan'] !== 'Mahasiswa') {
                $this->pdo->query("SELECT * FROM dosen WHERE id_user = :id_user");
                $this->pdo->bind(':id_user', $user['id_user']);
                $dosen = $this->pdo->single();
                if ($dosen) {
                    $_SESSION['id_prodi'] = $dosen['id_prodi'];
                    $_SESSION['nidn'] = $dosen['nidn'];
                }
            }
            return true;
        }
        return false;
    }

    public function register($data)
    {
        $this->pdo->beginTransaction();

        // Cek apakah username sudah ada
        $this->pdo->query("SELECT * FROM users WHERE username = :username");
        $this->pdo->bind('username', $data['username']);
        $cekUsername = $this->pdo->single();

        if ($cekUsername) {
            $this->pdo->rollBack();
            redirectWithMsg(BASE_URL . '/Login', 'Data Anda sudah terdaftar! Silahkan login untuk melanjutkan.', 'danger');
            exit;
        }

        // Add to user table
        $this->pdo->query("INSERT INTO users (name, username, password) VALUES (:name, :username, :password)");
        $this->pdo->bind("name", $data["nama"]);
        $this->pdo->bind("username", $data["username"]);
        $this->pdo->bind("password", password_hash($data["username"], PASSWORD_DEFAULT));
        if (!$this->pdo->execute()) {
            $this->pdo->rollBack();
            redirectWithMsg(BASE_URL . '/Login/register', 'Data Anda sudah terdaftar! Silahkan login untuk melanjutkan.', 'danger');
            exit;
        }
        $newId = $this->pdo->lastInsertId();

        // Add to user_jabatan table
        $this->pdo->query("INSERT INTO user_jabatan (id_user, id_jabatan) VALUES (:id_user, 4)");
        $this->pdo->bind("id_user", $newId);
        $this->pdo->execute();
        $this->pdo->commit();
        return $newId;
    }

    public function create($data)
    {
        // Add to user table
        $this->pdo->query("INSERT INTO users (name, username, password) VALUES (:name, :username, :password)");
        $this->pdo->bind("name", $data["nama_dosen"]);
        $this->pdo->bind("username", $data["nidn"]);
        $this->pdo->bind("password", password_hash($data["nidn"], PASSWORD_DEFAULT));
        $this->pdo->execute();
        $newId = $this->pdo->lastInsertId();
        return $newId;
    }

    public function update($id, $data)
    {
        $this->pdo->query("UPDATE users SET name = :name, username = :username, password = :password WHERE id_user = :id_user");
        $this->pdo->bind("id_user", $id);
        $this->pdo->bind("name", $data["nama"]);
        $this->pdo->bind("username", $data["username"]);
        $this->pdo->bind("password", password_hash($data["username"], PASSWORD_DEFAULT));
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function delete($id)
    {
        $this->pdo->query("DELETE FROM users WHERE id_user = :id_user");
        $this->pdo->bind("id_user", $id);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }

    public function logout()
    {
        session_abort();
        session_destroy();
        redirectWithMsg(BASE_URL . '/Login', 'Anda berhasil logout', 'success');
    }
}