<?php

require_once 'function.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (hapus_tamu($id) > 0) {
        echo "<script>alert('Data tamu berhasil dihapus')</script>";

        echo "<script>window.location.href='buku-tamu.php'</script>";
    } else {
        echo "<script>alert('Data gagal di hapus!')</script>";
    }
}