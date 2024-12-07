<?php
include '../koneksi/koneksi.php'; // Ensure the path is correct

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

// Check if the id parameter exists in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get id from URL parameter
    $id_tpi = intval($_GET['id']); // Ensure the ID is treated as an integer

    // Prepare delete query
    if ($delete_query = $koneksi->prepare("DELETE FROM tb_tpi WHERE id_tpi = ?")) {
        $delete_query->bind_param("i", $id_tpi);
        
        // Execute the delete query
        if ($delete_query->execute()) {
            if ($delete_query->affected_rows > 0) {
                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data telah terhapus.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'admin/admin.php?halaman=tpi-karangagung';
                    });
                </script>";
            } else {
                echo "
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ditemukan!',
                        text: 'Data tidak ditemukan.',
                        showConfirmButton: true
                    });
                </script>";
            }
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal menghapus data.',
                    showConfirmButton: true
                });
            </script>";
        }

        // Close the prepared statement
        $delete_query->close();
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menyiapkan query.',
                showConfirmButton: true
            });
        </script>";
    }
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'ID Tidak Valid!',
            text: 'ID yang diberikan tidak valid.',
            showConfirmButton: true
        });
    </script>";
}

// Close the database connection
$koneksi->close();
?>
