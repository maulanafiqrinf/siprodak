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
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Pengguna</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="text-sm-end">
                            <a href="admin/admin.php?halaman=tambah-user" class="btn btn-success btn-rounded" id="addProject-btn">
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
                                <th>Nama</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../koneksi/koneksi.php';

                            // Fetch data securely using prepared statements
                            $stmt = $koneksi->prepare("SELECT * FROM tb_admin");
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                $id_admin = htmlspecialchars($row['id_admin']);
                                $email = htmlspecialchars($row['email']);
                                $id_level = htmlspecialchars($row['id_level']);
                            ?>
                                <tr align="center">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $id_level; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmDelete('<?php echo $id_admin; ?>');">
                                            <i class="mdi mdi-delete me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            // Close the statement
                            $stmt->close();
                            ?>
                        </tbody>
                    </table>
                    <!-- end table -->
                </div>
                <!-- end table responsive -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
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
                window.location.href = 'admin/admin.php?halaman=hapus-user&id=' + id;
            }
        });
    }
</script>