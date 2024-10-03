<?php
include_once('templates/header.php');
require_once('function.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Buku Tamu</h1>

    <?php
    if (isset($_POST['simpan'])) {
        if (tambah_user($_POST) > 0) {
    ?>
            <div class="alert alert-success" role="alert">
                Data berhasil disimpan!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Data gagal disimpan
            </div>
    <?php
        }
    }
    ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Data Users</span>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>User Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $users = query("SELECT * FROM users");
                        foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['user_role'] ?></td>
                                <td>
                                    <a class="btn btn-success" href="edit-user.php?id=<?= $user['id_users'] ?>">Ubah</a>
                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger"
                                        href="hapus-user.php?id=<?= $user['id_users'] ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$query = mysqli_query($koneksi, "SELECT max(id_users) as kodeTerbesar FROM users");
$data = mysqli_fetch_array($query);
$kodeuser = $data['kodeTerbesar'];

$urutan = (int) substr($kodeuser, 3, 2);

$urutan++;

$huruf = "usr";
$kodeuser = $huruf . sprintf("%02s", $urutan);
?>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_users" id="id_users" value="<?= $kodeuser ?>">
                    <div class="form-group row">
                        <label for="nama_tamu" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="password" name="password"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_hp" class="col-sm-3 col-form-label">User Role</label>
                        <div class="col-sm-8">
                            <select name="user_role" id="user_role" class="form-control">
                                <option value="admin">Administrator</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/demo/datatables-demo.js"></script>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php')
?>