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
                window.location.href = '../admin/admin.php';
            });
        </script>
    </body>
    </html>";
    exit();
}

// Get current date, month, and year from URL parameters if set, otherwise use the current date
$current_date = date('Y-m-d');
$current_month = isset($_GET['month']) ? $_GET['month'] : date('m');
$current_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Calculate total per day, month, and year
// Daily Total
$stmt_daily = $koneksi->prepare("SELECT SUM(volume) AS total_volume, SUM(harga) AS total_harga FROM tb_tpi WHERE nama_tpi = ? AND DATE(tanggal) = ?");
$stmt_daily->bind_param("ss", $nama_tpi_filter, $current_date);
$nama_tpi_filter = "TPI PALANG";
$stmt_daily->execute();
$result_daily = $stmt_daily->get_result();
$daily_data = $result_daily->fetch_assoc();
$daily_volume = $daily_data['total_volume'] ?? 0;
$daily_harga = $daily_data['total_harga'] ?? 0;

// Monthly Total
$stmt_monthly = $koneksi->prepare("SELECT SUM(volume) AS total_volume, SUM(harga) AS total_harga FROM tb_tpi WHERE nama_tpi = ? AND MONTH(tanggal) = ? AND YEAR(tanggal) = ?");
$stmt_monthly->bind_param("sii", $nama_tpi_filter, $current_month, $current_year);
$stmt_monthly->execute();
$result_monthly = $stmt_monthly->get_result();
$monthly_data = $result_monthly->fetch_assoc();
$monthly_volume = $monthly_data['total_volume'] ?? 0;
$monthly_harga = $monthly_data['total_harga'] ?? 0;

// Yearly Total
$stmt_yearly = $koneksi->prepare("SELECT SUM(volume) AS total_volume, SUM(harga) AS total_harga FROM tb_tpi WHERE nama_tpi = ? AND YEAR(tanggal) = ?");
$stmt_yearly->bind_param("si", $nama_tpi_filter, $current_year);
$stmt_yearly->execute();
$result_yearly = $stmt_yearly->get_result();
$yearly_data = $result_yearly->fetch_assoc();
$yearly_volume = $yearly_data['total_volume'] ?? 0;
$yearly_harga = $yearly_data['total_harga'] ?? 0;

// Close the statements
$stmt_daily->close();
$stmt_monthly->close();
$stmt_yearly->close();
?>

<!-- Display Cards -->
<div class="row">
    <!-- Card for Daily Data -->
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">Volume Harian</p>
                        <h4 class="mb-0"><?php echo $daily_volume; ?> kg</h4>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                            <span class="avatar-title">
                                <i class="bx bx-copy-alt font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card for Monthly Data -->
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">Volume Bulanan</p>
                        <h4 class="mb-0"><?php echo $monthly_volume; ?> kg</h4>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="bx bx-archive-in font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card for Yearly Data -->
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">Volume Tahunan</p>
                        <h4 class="mb-0"><?php echo $yearly_volume; ?> kg</h4>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dropdown for Month and Year Selection -->
<div class="row mb-3">
    <div class="col-md-6">
        <label for="monthSelect">Select Month:</label>
        <select id="monthSelect" class="form-control" onchange="filterByMonthYear()">
            <?php for ($i = 1; $i <= 12; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php echo ($i == $current_month) ? 'selected' : ''; ?>><?php echo $i; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="yearSelect">Select Year:</label>
        <select id="yearSelect" class="form-control" onchange="filterByMonthYear()">
            <option value="2024" <?php echo ($current_year == 2024) ? 'selected' : ''; ?>>2024</option>
            <option value="2023" <?php echo ($current_year == 2023) ? 'selected' : ''; ?>>2023</option>
            <!-- Add more years if needed -->
        </select>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="text-sm-end">
                            <a href="admin/admin.php?halaman=tambah-tpipalang" class="btn btn-success btn-rounded" id="addProject-btn">
                                <i class="mdi mdi-plus me-1"></i> Tambah
                            </a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap dt-responsive nowrap w-100" id="datatable-buttons">
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
                            // Fetch data using the month and year filter
                            $stmt = $koneksi->prepare("SELECT * FROM tb_tpi WHERE nama_tpi = ? ");
                            $stmt->bind_param("s", $nama_tpi_filter);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                $id_tpi = htmlspecialchars($row['id_tpi']);
                                $tanggal = htmlspecialchars($row['tanggal']);
                                $nama_tpi = htmlspecialchars($row['nama_tpi']);
                                $namaikan_tpi = htmlspecialchars($row['namaikan_tpi']);
                                $volume = htmlspecialchars($row['volume']);
                                $harga = htmlspecialchars($row['harga']);
                            ?>
                                <tr align="center">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tanggal; ?></td>
                                    <td><?php echo $nama_tpi; ?></td>
                                    <td><?php echo $namaikan_tpi; ?></td>
                                    <td><?php echo $volume; ?></td>
                                    <td><?php echo $harga; ?></td>
                                    <td>
                                        <a href="admin/admin.php?halaman=update-tpipalang&id=<?php echo $id_tpi; ?>" class="btn btn-warning">
                                            <i class="mdi mdi-pencil me-1"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmDelete('<?php echo $id_tpi; ?>');">
                                            <i class="mdi mdi-delete me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            $stmt->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete page
                window.location.href = 'admin/admin.php?halaman=hapus-tpipalang&id=' + id;
            }
        });
    }

    function filterByMonthYear() {
        var month = document.getElementById('monthSelect').value;
        var year = document.getElementById('yearSelect').value;
        window.location.href = 'admin/admin.php?halaman=tpi-palang&month=' + month + '&year=' + year;
    }
</script>