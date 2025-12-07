<?php

class Pendaftaran extends Controller
{
    public function ajukan($id)
    {
        if ($this->model("PendaftaranModel")->ajukan($id, $_FILES['bukti_pembayaran']) > 0) {
            redirectWithMsg(BASE_URL . '/Dashboard', 'Pendaftaran berhasil', 'success');
            exit;
        } else {
            redirectWithMsg(BASE_URL . '/Dashboard', 'Pendaftaran gagal, coba lagi.', 'danger');
            exit;
        }
    }
}