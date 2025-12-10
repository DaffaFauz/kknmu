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
        $this->pdo->query("SELECT * FROM {$this->table} WHERE id_kelompok = :id");
        $this->pdo->bind(':id', $id);
        return $this->pdo->single();
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