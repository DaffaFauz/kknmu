<?php

class Auth extends Controller
{
    public function index()
    {
        if ($this->model('UserModel')->login($_POST)) {
            // Cek jumlah jabatan 
            $jumlah_jabatan = $_SESSION['jml_jabatan'] ?? 1;
            if ($jumlah_jabatan > 1) {
                redirectWithMsg(BASE_URL . '/SelectJabatan', 'Anda berhasil login', 'success');
                exit;
            }

            // Get Role
            $role = $_SESSION['role'];

            switch ($role) {
                case 'Mahasiswa':
                    header('location: ' . BASE_URL . '/Dashboard');
                    break;
                case 'Pembimbing':
                    header('location: ' . BASE_URL . '/Dashboard');
                    break;
                case 'Kaprodi':
                    header('location: ' . BASE_URL . '/Dashboard');
                    break;
                case 'Admin':
                    header('location: ' . BASE_URL . '/Dashboard');
                    break;
                default:
                    redirectWithMsg(BASE_URL . '/Login', 'Role tidak ditemukan.', 'danger');
                    break;
            }
            exit;
        } else {
            redirectWithMsg(BASE_URL . '/Login', 'Gagal Login, Username atau Password salah.', 'danger');
            exit;
        }
    }

    public function register()
    {

    }

    public function logout()
    {
        session_unset();
        session_destroy();
        redirectWithMsg(BASE_URL . "/Login", "Anda telah logout.", "success");
        exit();
    }

    public function selectJabatan()
    {
        // Check login
        checkLogin();

        // Get selected jabatan from POST
        if (!isset($_POST['id_jabatan']) || !isset($_POST['nama_jabatan'])) {
            redirectWithMsg(BASE_URL . "/Home/login", "Data jabatan tidak valid.", "danger");
            exit;
        }

        $id_jabatan = $_POST['id_jabatan'];
        $nama_jabatan = $_POST['nama_jabatan'];

        // Update session role dengan jabatan yang dipilih
        $_SESSION['role'] = $nama_jabatan;
        $_SESSION['id_jabatan'] = $id_jabatan;

        // Routing sesuai dengan role yang dipilih
        switch ($nama_jabatan) {
            case 'Mahasiswa':
                header('location: ' . BASE_URL . '/Dashboard');
                break;
            case 'Pembimbing':
                header('location: ' . BASE_URL . '/Dashboard');
                break;
            case 'Kaprodi':
                header('location: ' . BASE_URL . '/Dashboard');
                break;
            case 'Admin':
                header('location: ' . BASE_URL . '/Dashboard');
                break;
            default:
                redirectWithMsg(BASE_URL . "/Login", "Role tidak ditemukan.", "danger");
                exit;
        }
        exit;
    }
}