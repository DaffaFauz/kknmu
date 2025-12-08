<?php

class Mahasiswa extends Controller
{
    public function create()
    {
        $newId = $this->model("UserModel")->register($_POST);
        if ($newId > 0) {
            $_POST['newId'] = $newId;
            if ($this->model("MahasiswaModel")->create($_POST) > 0) {
                redirectWithMsg(BASE_URL . '/Mahasiswa', 'Data mahasiswa berhasil ditambahkan.', 'success');
            } else {
                $this->model('UserModel')->delete($newId);
                redirectWithMsg(BASE_URL . '/Mahasiswa', 'Data mahasiswa gagal ditambahkan.', 'danger');
            }
        }
    }
}