<?php
include_once('templates/header.php');
require_once('function.php');
include_once('koneksi.php');

$sql = "SELECT COUNT(*) AS jumlah_tamu FROM buku_tamu";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$jumlah_tamu = $row['jumlah_tamu'];

// $query = mysqli_query($koneksi, "SELECT max(id_tamu) as KodeTerbesar FROM buku_tamu");
// $data = mysqli_fetch_array($query);
// $kodeTamu = $data['kodeTerbesar'];
// $urutan = (int) substr($kodeTamu, 2, 3);
// $urutan++;
// $huruf - 'zt';
// $kodeTamu = $huruf . sprintf("%03s", $urutan);

$sql_user = "SELECT COUNT(*) AS jumlah_user FROM users";
$user_result = mysqli_query($koneksi, $sql_user);
$row = mysqli_fetch_assoc($user_result);
$jumlah_user = $row['jumlah_user']
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="container-fluid">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Dashboard Tamu</h1>

            <!-- Informasi Jumlah Tamu -->
            <div class="alert alert-info" role="alert">
                Jumlah Tamu: <?= $jumlah_tamu ?>
            </div>

            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Tamu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Bertemu Dg</th>
                                    <th>Kepentingan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $buku_tamu = query("SELECT * FROM buku_tamu");
                                foreach ($buku_tamu as $tamu) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $tamu['tanggal'] ?></td>
                                        <td><?= $tamu['nama_tamu'] ?></td>
                                        <td><?= $tamu['alamat'] ?></td>
                                        <td><?= $tamu['no_hp'] ?></td>
                                        <td><?= $tamu['bertemu'] ?></td>
                                        <td><?= $tamu['kepentingan'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Dashboard Users</h1>

            <!-- Informasi Jumlah Tamu -->
            <div class="alert alert-info" role="alert">
                Jumlah User: <?= $jumlah_user ?>
            </div>

            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables User</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>User Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $users = query("SELECT * FROM users");
                                foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $user['user_role'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php')
?>