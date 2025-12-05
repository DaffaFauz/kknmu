<?php
function uploadFile($file, $path)
{
    $file_name = time() . '-' . basename($file['name']);
    $target_file = $path . '/' . $file_name;
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $file_name;
    }
    return false;
}

function redirectWithMsg($url, $msg, $type)
{
    session_start();
    $_SESSION['msg'] = $msg;
    $_SESSION['msg_type'] = $type;
    header("location: $url");
    exit;
}

function checkLogin()
{
    if (!isset($_SESSION['user'])) {
        redirectWithMsg(BASE_URL . '/Login', 'Anda belum login', 'danger');
        exit;
    }

    // Mendapatkan path halaman yang sedang diakses
    $currentPath = str_replace('\\', '/', dirname($_SERVER['PHP_SELF']));

    // Ambil folder utama setelah views
    $pathParts = explode('/', $currentPath);
    $folderName = '';
    if (($key = array_search('views', $pathParts)) !== false && isset($pathParts[$key + 1])) {
        $folderName = strtolower($pathParts[$key + 1]);
    }

    // Map folder ke role
    $roleMap = [
        'admin' => 'LPPM',
        'kaprodi' => 'Kaprodi',
        'pembimbing' => 'Pembimbing',
        'mahasiswa' => 'Mahasiswa'
    ];

    // Cek folder yang memiliki role
    if (array_key_exists($folderName, $roleMap)) {
        $expectedRole = $roleMap[$folderName];
        $userRole = strtolower($_SESSION['role']);
        $expectedRoleLower = strtolower($expectedRole);

        if ($userRole !== $expectedRoleLower) {
            redirectWithMsg(BASE_URL . '/Login', 'Anda tidak memiliki akses', 'danger');
            exit;
        }
    }


}

// Jika halaman ini membutuhkan role tertentu, kita cek sesuai kebutuhan
function checkRole($allowed_roles = [])
{
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
        redirectWithMsg(BASE_URL . '/Login', 'Anda tidak memiliki akses', 'danger');
        exit;
    }
}