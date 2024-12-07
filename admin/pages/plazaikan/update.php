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

// Ensure the ID is provided via URL parameter
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Fetch tpi data based on ID
    $result = $koneksi->query("SELECT * FROM tb_tpi WHERE id_tpi = '$id'");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "<script>Swal.fire('Error', 'Data tidak ditemukan', 'error');</script>";
        exit();
    }
} else {
    echo "<script>Swal.fire('Error', 'ID tidak valid', 'error');</script>";
    exit();
}

// If the form is submitted
if (isset($_POST['update'])) {
    // Sanitize input data
    $tanggal = htmlspecialchars(trim($_POST['tanggal']));
    $nama_tpi = htmlspecialchars(trim($_POST['nama_tpi']));
    $namaikan_tpi = htmlspecialchars(trim($_POST['namaikan_tpi']));
    $volume = htmlspecialchars(trim($_POST['volume']));
    $harga = htmlspecialchars(trim($_POST['harga']));

    // Validate that required data is filled
    if (!empty($tanggal) && !empty($nama_tpi) && !empty($namaikan_tpi)&& !empty($volume)&& !empty($harga)) {
        // Prepare the update query
        $query = $koneksi->prepare("UPDATE tb_tpi SET tanggal = ?, nama_tpi = ?, namaikan_tpi = ?, volume = ?, harga = ? WHERE id_tpi = ?");

        // Bind parameters correctly (4 strings and 1 integer for ID)
        $query->bind_param("sssssi", $tanggal, $nama_tpi, $namaikan_tpi,$volume,$harga, $id);

        // Execute the query
        if ($query->execute()) {
            echo "<script>
                    Swal.fire({
                        title: 'Success',
                        text: 'Data Berhasil Diperbarui',
                        icon: 'success'
                    }).then(() => {
                        location.href='admin/admin.php?halaman=tpi-plazaikan';
                    });
                  </script>";
            exit();
        } else {
            echo "<script>Swal.fire('Error', 'Terjadi kesalahan: " . addslashes($query->error) . "', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Warning', 'Harap isi semua data wajib', 'warning');</script>";
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Update Data TPI PLAZA IKAN</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" id="tanggal" class="form-control" name="tanggal" value="<?= htmlspecialchars($data['tanggal']); ?>">
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
                                <input id="namaikan_tpi" name="namaikan_tpi" type="text" class="form-control" placeholder="Nama Ikan" value="<?= htmlspecialchars($data['namaikan_tpi']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="volume">Volume (kg)</label>
                                <input id="volume" name="volume" type="text" class="form-control" min="0" value="<?= htmlspecialchars($data['volume']); ?>" >
                            </div>
                            <div class="mb-3">
                                <label for="harga">Harga (Rp)</label>
                                <input id="harga" name="harga" type="number" class="form-control" min="0" value="<?= htmlspecialchars($data['harga']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="update">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>