<?php
include 'koneksi/koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Define user levels and their respective redirect paths
    $userLevels = [
        1 => 'admin/admin.php',
        2 => 'admin/admin.php',
        3 => 'tpi/user/glondong.php',
        4 => 'tpi/palang.php',
        5 => 'tpi/plaza.php',
        6 => 'tpi/bulu.php',
        7 => 'tpi/karang.php'

    ];

    foreach ($userLevels as $id_level => $redirectPath) {
        // Prepare SQL query to prevent SQL injection
        $stmt = $koneksi->prepare("SELECT * FROM tb_admin WHERE username = ? AND id_level = ?");
        $stmt->bind_param("si", $username, $id_level);

        // Execute the query and fetch the result
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $akun = $result->fetch_assoc();
            if (password_verify($password, $akun['password'])) {
                // Store session data
                $_SESSION['user'] = $akun;
                $_SESSION['id_admin'] = $akun['id_admin'];
                $_SESSION['username'] = $akun['username'];
                $_SESSION['status'] = "Login";
                $_SESSION['id_level'] = (string)$id_level;

                header("Location: $redirectPath?pesan=berhasil");
                exit;
            } else {
                redirectToLoginWithError("gagal");
            }
        }
    }
    // If no match found for any level
    redirectToLoginWithError("gagal");
} else {
    echo "<script>alert('Silahkan login terlebih dahulu'); location.href='index.php';</script>";
}

function redirectToLoginWithError($error)
{
    header("Location: index.php?pesan=$error");
    exit;
}
