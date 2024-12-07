<?php
include '../koneksi/koneksi.php';

// Nilai default
$filterType = 'hari'; // Default filter
$filterValue = date('Y-m-d'); // Default tanggal hari ini
$dataIkan = [];

// Daftar tahun untuk dropdown
$startYear = 2000;
$currentYear = date('Y');
$years = range($currentYear, $startYear);

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filterType = $_POST['filterType'];
    $filterValue = $_POST['filterValue'];

    // Format ulang $filterValue jika perlu
    $filterDate = '';
    if ($filterType == 'bulan') {
        $filterDate = date('Y-m', strtotime($filterValue)) . '-01'; // Format jadi tanggal awal bulan
    } elseif ($filterType == 'tahun') {
        $filterDate = $filterValue . '-01-01'; // Format jadi awal tahun
    } else {
        $filterDate = $filterValue; // Tetap gunakan untuk hari
    }

    // Query berdasarkan filter
    $nama_tpi_filter = "TPI PLAZA IKAN";
    if ($filterType == 'hari') {
        $stmt = $koneksi->prepare("
            SELECT namaikan_tpi, SUM(volume) as total_volume, SUM(harga) as total_harga 
            FROM tb_tpi 
            WHERE nama_tpi = ? AND DATE(tanggal) = ?
            GROUP BY namaikan_tpi
        ");
        $stmt->bind_param("ss", $nama_tpi_filter, $filterDate);
    } elseif ($filterType == 'bulan') {
        $stmt = $koneksi->prepare("
            SELECT namaikan_tpi, SUM(volume) as total_volume, SUM(harga) as total_harga 
            FROM tb_tpi 
            WHERE nama_tpi = ? AND DATE_FORMAT(tanggal, '%Y-%m') = DATE_FORMAT(?, '%Y-%m')
            GROUP BY namaikan_tpi
        ");
        $stmt->bind_param("ss", $nama_tpi_filter, $filterDate);
    } else { // Tahun
        $stmt = $koneksi->prepare("
            SELECT namaikan_tpi, SUM(volume) as total_volume, SUM(harga) as total_harga 
            FROM tb_tpi 
            WHERE nama_tpi = ? AND YEAR(tanggal) = ?
            GROUP BY namaikan_tpi
        ");
        $stmt->bind_param("si", $nama_tpi_filter, $filterValue);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $dataIkan[] = [
            'nama_ikan' => $row['namaikan_tpi'],
            'total_volume' => (float)$row['total_volume'],
            'total_harga' => (float)$row['total_harga']
        ];
    }
    $stmt->close();
}
?>

<?php // Ambil tanggal hari ini
// Ambil tanggal hari ini
$tanggal_hari_ini = date('Y-m-d');
$nama_tpi = "TPI PLAZA IKAN"; // Filter untuk TPI Palang

// Query untuk menghitung jumlah data hari ini
$stmt_hari_ini = $koneksi->prepare("SELECT COUNT(*) AS jumlah_data_hari_ini FROM tb_tpi WHERE tanggal = ? AND nama_tpi = ?");
$stmt_hari_ini->bind_param("ss", $tanggal_hari_ini, $nama_tpi);
$stmt_hari_ini->execute();
$result_hari_ini = $stmt_hari_ini->get_result();
$data_hari_ini = $result_hari_ini->fetch_assoc();
$jumlah_data_hari_ini = $data_hari_ini['jumlah_data_hari_ini'] ?? 0;

// Query untuk menghitung jumlah keseluruhan data
$stmt_keseluruhan = $koneksi->prepare("SELECT COUNT(*) AS jumlah_keseluruhan FROM tb_tpi WHERE nama_tpi = ?");
$stmt_keseluruhan->bind_param("s", $nama_tpi);
$stmt_keseluruhan->execute();
$result_keseluruhan = $stmt_keseluruhan->get_result();
$data_keseluruhan = $result_keseluruhan->fetch_assoc();
$jumlah_keseluruhan = $data_keseluruhan['jumlah_keseluruhan'] ?? 0;

// Tutup statement
$stmt_hari_ini->close();
$stmt_keseluruhan->close();
?>

<div class="row">
    <div class="col-12">
        <div class="page-tanggal-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Grafik TPI PLAZA IKAN</h4>
        </div>
    </div>
</div>
<br />

<div class="row">
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">Jumlah Data Hari ini</p>
                        <h4 class="mb-0"><?php echo $jumlah_data_hari_ini; ?></h4>
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
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">Jumlah Keseluruhan Data</p>
                        <h4 class="mb-0">
                            <?php echo $jumlah_keseluruhan; ?>
                        </h4>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                            <span class="avatar-title">
                                <i class="bx bx-archive font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <form method="POST" class="row">
        <div class="col-md-4">
            <label for="filterDate">Pilih Filter:</label>
            <select id="filterDate" name="filterType" class="form-select" onchange="adjustInputType(this.value)">
                <option value="hari" <?= $filterType == 'hari' ? 'selected' : '' ?>>Hari</option>
                <option value="bulan" <?= $filterType == 'bulan' ? 'selected' : '' ?>>Bulan</option>
                <option value="tahun" <?= $filterType == 'tahun' ? 'selected' : '' ?>>Tahun</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="filterValue">Pilih Nilai:</label>
            <div id="inputContainer">
                <!-- Input dinamis berdasarkan jenis filter -->
                <?php if ($filterType == 'hari'): ?>
                    <input type="date" id="filterValue" name="filterValue" class="form-control" value="<?= $filterValue ?>">
                <?php elseif ($filterType == 'bulan'): ?>
                    <input type="month" id="filterValue" name="filterValue" class="form-control" value="<?= $filterValue ?>">
                <?php elseif ($filterType == 'tahun'): ?>
                    <select id="filterValue" name="filterValue" class="form-select">
                        <?php foreach ($years as $year): ?>
                            <option value="<?= $year ?>" <?= $filterValue == $year ? 'selected' : '' ?>><?= $year ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary" type="submit">Terapkan Filter</button>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-md-6">
        <h5>Pie Chart</h5>
        <canvas id="pieChart" width="400" height="400"></canvas>
    </div>
    <div class="col-md-6">
        <h5>Bar Chart</h5>
        <canvas id="barChart" width="400" height="400"></canvas>
    </div>
</div>

<script>
    function adjustInputType(filterType) {
        const inputContainer = document.getElementById('inputContainer');
        if (filterType === 'hari') {
            inputContainer.innerHTML = '<input type="date" id="filterValue" name="filterValue" class="form-control" value="<?= $filterValue ?>">';
        } else if (filterType === 'bulan') {
            inputContainer.innerHTML = '<input type="month" id="filterValue" name="filterValue" class="form-control" value="<?= $filterValue ?>">';
        } else {
            const years = <?= json_encode($years) ?>;
            let yearOptions = years.map(year => `<option value="${year}" ${year == <?= $filterValue ?> ? 'selected' : ''}>${year}</option>`).join('');
            inputContainer.innerHTML = `<select id="filterValue" name="filterValue" class="form-select">${yearOptions}</select>`;
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataIkan = <?= json_encode($dataIkan) ?>;

    const pieData = {
        labels: dataIkan.map(item => item.nama_ikan),
        datasets: [{
            label: 'Total Volume',
            data: dataIkan.map(item => item.total_volume),
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
            borderWidth: 1
        }]
    };

    const barData = {
        labels: dataIkan.map(item => item.nama_ikan),
        datasets: [{
                label: 'Volume (kg)',
                data: dataIkan.map(item => item.total_volume),
                backgroundColor: '#36A2EB',
            },
            {
                label: 'Harga (Rp)',
                data: dataIkan.map(item => item.total_harga),
                backgroundColor: '#FFCE56',
            }
        ]
    };

    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: pieData,
        options: {
            responsive: true,
        }
    });

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });
</script>