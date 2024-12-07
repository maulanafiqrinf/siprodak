<?php
include 'koneksi/koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Daftar level user dan path redirect masing-masing
    $userLevels = [
        1 => 'admin/admin.php',
        2 => 'admin/admin.php',
        3 => 'tpi/glondong.php',
        4 => 'tpi/palang.php',
        5 => 'tpi/plaza.php',
        6 => 'tpi/bulu.php',
        7 => 'tpi/karang.php'
    ];

    // Siapkan query SQL dengan prepared statement
    $stmt = $koneksi->prepare("SELECT * FROM tb_admin WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Eksekusi query
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa jika ada data user
    if ($result->num_rows === 1) {
        $akun = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $akun['password'])) {
            $id_level = $akun['id_level'];

            // Pastikan level user ada di daftar
            if (isset($userLevels[$id_level])) {
                // Simpan data user ke session
                $_SESSION['user'] = $akun;
                $_SESSION['id_admin'] = $akun['id_admin'];
                $_SESSION['username'] = $akun['username'];
                $_SESSION['status'] = "Login";
                $_SESSION['id_level'] = (string)$id_level;

                // Redirect ke halaman sesuai level
                header("Location: " . $userLevels[$id_level] . "?pesan=berhasil");
                exit;
            } else {
                redirectToLoginWithError("level_tidak_terdaftar");
            }
        } else {
            redirectToLoginWithError("password_salah");
        }
    } else {
        redirectToLoginWithError("username_tidak_ditemukan");
    }
} else {
    echo "<script>alert('Silahkan login terlebih dahulu'); location.href='index.php';</script>";
}

// Fungsi untuk redirect dengan pesan error
function redirectToLoginWithError($error)
{
    header("Location: index.php?pesan=$error");
    exit;
}
