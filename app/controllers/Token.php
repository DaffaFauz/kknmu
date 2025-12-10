<?php

class Token extends Controller
{
    public function generate($id)
    {
        if ($this->model('TokenModel')->generate($id)) {
            redirectWithMsg(BASE_URL . '/Nilai', 'Token berhasil di generate', 'success');
        } else {
            redirectWithMsg(BASE_URL . '/Nilai', 'Gagal menggenerate token', 'danger');
        }
    }

    public function validate()
    {
        $token = $this->model('TokenModel')->getTokenLogin($_POST['token']);
        if ($token) {
            header("location:" . BASE_URL . '/Nilai');
        } else {
            redirectWithMsg(BASE_URL . '/Login/penguji', 'Token yang anda masukkan salah! Coba lagi.', 'danger');
        }
    }
}