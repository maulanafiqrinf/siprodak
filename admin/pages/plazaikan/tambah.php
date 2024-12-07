<?php
include '../koneksi/koneksi.php';

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

// Proses penyimpanan data jika tombol "save" ditekan
if (isset($_POST['save'])) {
    // Validasi dan sanitasi input
    $tanggal = htmlspecialchars(trim($_POST['tanggal']));
    $nama_tpi = htmlspecialchars(trim($_POST['nama_tpi']));
    $namaikan_tpi = htmlspecialchars(trim($_POST['namaikan_tpi']));
    $volume = htmlspecialchars(trim($_POST['volume']));
    $harga = htmlspecialchars(trim($_POST['harga']));

    // Validasi data wajib diisi
    if (empty($tanggal) || empty($nama_tpi) || empty($namaikan_tpi) || empty($volume) || empty($harga)) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Semua kolom wajib diisi!',
                confirmButtonText: 'OK'
            });
        </script>";
        exit();
    }

    // Siapkan statement SQL
    $stmt = $koneksi->prepare("INSERT INTO tb_tpi (tanggal, nama_tpi, namaikan_tpi, volume, harga) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssss", $tanggal, $nama_tpi, $namaikan_tpi, $volume, $harga);

        // Eksekusi statement
        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    title: 'Success',
                    text: 'Data Tersimpan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.href = 'admin/admin.php?halaman=tpi-plazaikan';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan Data',
                    text: 'Kesalahan: " . htmlspecialchars($stmt->error) . "',
                    confirmButtonText: 'OK'
                });
            </script>";
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan Data',
                text: 'Kesalahan: " . htmlspecialchars($koneksi->error) . "',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    // Tutup koneksi
    $koneksi->close();
}
?>

<div class="row">
    <div class="col-12">
        <div class="page-tanggal-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Data TPI PLAZA IKAN</h4>
        </div>
    </div>
</div>
<!-- end page tanggal -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" id="tanggal" class="form-control" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_tpi">Nama TPI</label>
                                <select id="nama_tpi" name="nama_tpi" class="form-control" required>
                                    <option value="TPI PLAZA IKAN" selected>TPI PLAZA IKAN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="namaikan_tpi">Nama Ikan</label>
                                <input id="namaikan_tpi" name="namaikan_tpi" type="text" class="form-control" placeholder="Nama Ikan" required>
                            </div>
                            <div class="mb-3">
                                <label for="volume">Volume (kg)</label>
                                <input id="volume" name="volume" type="text" class="form-control" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga">Harga (Rp)</label>
                                <input id="harga" name="harga" type="number" class="form-control" min="0" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                </form>

            </div>
        </div>
    </div>
</div>