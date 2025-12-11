<?php
class TokenModel
{
    private $pdo;
    private $table = 'token';

    public function __construct()
    {
        $this->pdo = new Db();
    }

    public function getToken($id)
    {
        // Ambil data berdasarkan token
        $this->pdo->query("SELECT * FROM {$this->table} WHERE id_kelompok = :id");
        $this->pdo->bind(':id', $id);
        $data = $this->pdo->single();
        if ($data) {
            $this->pdo->query("SELECT * FROM detail_kelompok INNER JOIN kelompok ON detail_kelompok.id_kelompok = kelompok.id_kelompok WHERE detail_kelompok.id = :id");
            $this->pdo->bind(':id', $data['id_kelompok']);
            $data = $this->pdo->single();
        }

        return $data;
    }

    public function getTokenLogin($token)
    {
        // Ambil data berdasarkan token
        $this->pdo->query("SELECT * FROM {$this->table} WHERE token1 = :token1 OR token2 = :token2");
        $this->pdo->bind(':token1', $token);
        $this->pdo->bind(':token2', $token);

        // Periksa apakah data yang didapat berasal dari token1 atau token2
        $data = $this->pdo->single();
        if ($data['token1'] == $token) {
            $_SESSION['role'] = 'Penguji 1';
        } else {
            $_SESSION['role'] = 'Penguji 2';
        }
        $_SESSION['id'] = $data['id_kelompok'];

        return $data;
    }

    public function generate($id)
    {
        // Generate token dengan panjang 10 karakter
        $token1 = bin2hex(random_bytes(5));
        $token2 = bin2hex(random_bytes(5));

        // Insert token ke database
        $this->pdo->query("INSERT INTO $this->table (id_kelompok, token1, token2) VALUES (:id, :token1, :token2)");
        $this->pdo->bind(':id', $id);
        $this->pdo->bind(':token1', $token1);
        $this->pdo->bind(':token2', $token2);
        $this->pdo->execute();
        return $this->pdo->rowCount();
    }
}