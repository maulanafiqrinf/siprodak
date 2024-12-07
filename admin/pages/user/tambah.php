<?php
include '../koneksi/koneksi.php'; // File koneksi

// Periksa apakah sesi id_level kosong
if (empty($_SESSION['id_level'])) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Akses Ditolak</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Akses Ditolak',
                text: 'Silahkan login terlebih dahulu!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../login.php';
            });
        </script>
    </body>
    </html>";
    exit();
}

// Periksa apakah id_level = 1
$id_level = $_SESSION['id_level'];
if ($id_level != 1) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Akses Ditolak</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: 'Anda tidak memiliki hak akses ke halaman ini!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../login.php';
            });
        </script>
    </body>
    </html>";
    exit();
}

if (isset($_POST['daftar'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $id_level = intval($_POST['id_level']); // Level pengguna (1, 2, 3)

    // Validasi data
    if (empty($username) || empty($email) || empty($password) || empty($id_level)) {
        echo "<script>alert('Semua data wajib diisi!'); location.href='admin/admin.php?halaman=user';</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); location.href='admin/admin.php?halaman=user';</script>";
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $checkStmt = $koneksi->prepare("SELECT * FROM tb_admin WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username sudah terdaftar!'); location.href='admin/admin.php?halaman=user';</script>";
        exit;
    }

    // Simpan data ke database
    $stmt = $koneksi->prepare("INSERT INTO tb_admin (username, email, password, id_level) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $username, $email, $hashedPassword, $id_level);

    if ($stmt->execute()) {
        echo "<script>
            alert('Pendaftaran berhasil! Silakan login.');
            location.href='admin/admin.php?halaman=user';
        </script>";
    } else {
        echo "<script>
            alert('Gagal mendaftar: " . $koneksi->error . "');
            location.href='admin/admin.php?halaman=user';
        </script>";
    }

    $stmt->close();
}
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Starter</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                    <li class="breadcrumb-item active">Starter</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="username" id="username" name="username" required>
                        </div>
                    </div><!--end col-->
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="email" id="email" name="email" required>
                        </div>
                    </div><!--end col-->
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="password" id="password" name="password" required>
                        </div>
                    </div><!--end col-->
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="id_level" class="form-label">Level Pengguna</label>
                            <select id="id_level" class="form-select" name="id_level" required>
                                <option value="">-- Pilih Level Pengguna --</option>
                                <option value="1">Superadmin</option>
                                <option value="2">Admin</option>
                                <option value="3">TPI Glondong</option>
                                <option value="4">TPI Palang</option>
                                <option value="5">TPI Plaza Ikan</option>
                                <option value="6">TPI Bulu</option>
                                <option value="7">TPI Karang</option>
                            </select>
                        </div>
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </form>
        </div>
    </div>
</div>
