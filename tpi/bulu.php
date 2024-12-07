<?php
session_start();
include '../koneksi/koneksi.php';

// Fungsi menampilkan alert biasa
function showAlert($message, $redirectUrl = null)
{
    echo "<script>
        alert('$message');
        " . ($redirectUrl ? "window.location.href = '$redirectUrl';" : "") . "
    </script>";
    exit();
}

// Fungsi memeriksa akses pengguna
function checkAccess($requiredLevel)
{
    if (empty($_SESSION['id_level']) || !in_array($_SESSION['id_level'], $requiredLevel)) {
        showAlert('Anda tidak memiliki hak akses ke halaman ini!', '../index.php');
    }
}

// Periksa akses pengguna (hanya level 3 yang diizinkan)
checkAccess([6]);

// Fungsi untuk menyimpan data baru
function saveTpiData($koneksi)
{
    if (isset($_POST['save'])) {
        $query = "INSERT INTO tb_tpi (tanggal, nama_tpi, namaikan_tpi, volume, harga) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        if ($stmt) {
            $stmt->bind_param(
                "ssssi",
                $_POST['tanggal'],
                $_POST['nama_tpi'],
                $_POST['namaikan_tpi'],
                $_POST['volume'],
                $_POST['harga']
            );
            if ($stmt->execute()) {
                showAlert('Data berhasil disimpan!', 'bulu.php');
            } else {
                showAlert('Gagal menyimpan data.');
            }
            $stmt->close();
        } else {
            showAlert('Koneksi database bermasalah.');
        }
    }
}

// Fungsi untuk memperbarui data
function updateTpiData($koneksi)
{
    if (isset($_POST['update'])) {
        $query = "UPDATE tb_tpi SET tanggal = ?, nama_tpi = ?, namaikan_tpi = ?, volume = ?, harga = ? WHERE id_tpi = ?";
        $stmt = $koneksi->prepare($query);
        if ($stmt) {
            $stmt->bind_param(
                "ssssii",
                $_POST['tanggal'],
                $_POST['nama_tpi'],
                $_POST['namaikan_tpi'],
                $_POST['volume'],
                $_POST['harga'],
                $_POST['id_tpi']
            );
            if ($stmt->execute()) {
                showAlert('Data berhasil diperbarui!', 'bulu.php');
            } else {
                showAlert('Gagal memperbarui data.');
            }
            $stmt->close();
        } else {
            showAlert('Koneksi database bermasalah.');
        }
    }
}

// Panggil fungsi berdasarkan form yang dikirim
saveTpiData($koneksi);
updateTpiData($koneksi);
?>



<!doctype html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="utf-8" />
    <title>SIPRODAK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MFNF" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="assets/js/plugin.js"></script>

    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body data-sidebar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include 'components/navbar.php' ?>
        <!-- Left Sidebar End -->
        <?php include 'components/sidebar.php' ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- Form Input Data -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Tambah Data Perolehan Ikan TPI BULU</h4>
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="date" id="tanggal" class="form-control" name="tanggal" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_tpi">Nama TPI</label>
                                                    <select id="nama_tpi" name="nama_tpi" class="form-control" required>
                                                        <option value="TPI BULU" selected>TPI BULU</option>
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-sm-0 font-size-18">Data Perolehan Ikan TPI BULU</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="tpiTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama TPI</th>
                                                    <th>Nama Ikan</th>
                                                    <th>Volume (kg)</th>
                                                    <th>Harga (Rp)</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Mendapatkan tanggal hari ini
                                                $tanggalHariIni = date('Y-m-d');

                                                // Query untuk mengambil data hanya hari ini
                                                $query = "SELECT * FROM tb_tpi WHERE tanggal = ? AND nama_tpi = 'TPI BULU'";
                                                $stmt = $koneksi->prepare($query);
                                                $stmt->bind_param("s", $tanggalHariIni);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                // Penomoran baris
                                                $no = 1;

                                                // Cek apakah ada data yang tersedia
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= htmlspecialchars($row['tanggal']); ?></td>
                                                            <td><?= htmlspecialchars($row['nama_tpi']); ?></td>
                                                            <td><?= htmlspecialchars($row['namaikan_tpi']); ?></td>
                                                            <td><?= htmlspecialchars($row['volume']); ?></td>
                                                            <td><?= htmlspecialchars($row['harga']); ?></td>
                                                            <td>
                                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                                                    onclick="loadEditData(<?= $row['id_tpi']; ?>,
                            '<?= htmlspecialchars($row['tanggal']); ?>',
                            '<?= htmlspecialchars($row['nama_tpi']); ?>',
                            '<?= htmlspecialchars($row['namaikan_tpi']); ?>',
                            <?= htmlspecialchars($row['volume']); ?>,
                            <?= $row['harga']; ?>
                        )">
                                                                    Edit
                                                                </button>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='7' class='text-center'>Data tidak tersedia untuk hari ini</td></tr>";
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data Perolehan Ikan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_tpi" id="editIdTpi">
                                        <div class="mb-3">
                                            <label for="editTanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="editTanggal" name="tanggal" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editNamaTpi">Nama TPI</label>
                                            <select id="editNamaTpi" name="nama_tpi" class="form-control" required>
                                                <option value="TPI BULU" selected>TPI BULU</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editNamaIkan">Nama Ikan</label>
                                            <input type="text" class="form-control" id="editNamaIkan" name="namaikan_tpi" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editVolume">Volume (kg)</label>
                                            <input type="text" class="form-control" id="editVolume" name="volume" min="0" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editHarga">Harga (Rp)</label>
                                            <input type="number" class="form-control" id="editHarga" name="harga" min="0" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary" name="update">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Script DataTables -->
                    <script>
                        $(document).ready(function() {
                            $('#tpiTable').DataTable({
                                responsive: true,
                                pageLength: 10,
                                lengthChange: false,
                                autoWidth: false,
                                language: {
                                    search: "Cari:",
                                    paginate: {
                                        previous: "Sebelumnya",
                                        next: "Selanjutnya"
                                    }
                                }
                            });
                        });

                        function loadEditData(id_tpi, tanggal, nama_tpi, namaikan_tpi, volume, harga) {
                            document.getElementById('editIdTpi').value = id_tpi;
                            document.getElementById('editTanggal').value = tanggal;
                            document.getElementById('editNamaTpi').value = nama_tpi;
                            document.getElementById('editNamaIkan').value = namaikan_tpi;
                            document.getElementById('editVolume').value = volume;
                            document.getElementById('editHarga').value = harga;
                        }
                    </script>
                </div>
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © SIPRODAK.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by MFNF
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- dashboard blog init -->
    <script src="assets/js/pages/dashboard-blog.init.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- bootstrap-datepicker js -->
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
</body>


</html>