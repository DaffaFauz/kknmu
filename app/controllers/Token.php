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
}