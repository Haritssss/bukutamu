<?php
require_once('koneksi.php');

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_tamu($data)
{
    global $koneksi;

    $kode = htmlspecialchars($data["id_tamu"]);
    $tanggal = date("Y-m-d");
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $bertemu = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);

    $query = "INSERT INTO buku_tamu VALUES ('$kode', '$tanggal', '$nama_tamu', '$alamat', '$no_hp', '$bertemu', '$kepentingan')";
    // $query = "INSERT INTO buku_tamu VALUES ($kode, $tanggal, $nama_tamu, $alamat, $no_hp, $bertemu, $kepentingan)";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}



function ubah_tamu($data)
{
    global $koneksi;

    $id = htmlspecialchars($data["id_tamu"]);
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $bertemu = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);

    $query = "UPDATE buku_tamu SET
        nama_tamu = '$nama_tamu',
        alamat = '$alamat',
        no_hp = '$no_hp',
        bertemu = '$bertemu',
        kepentingan = '$kepentingan'
        WHERE id_tamu = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

if (isset($_GET['id'])) {
    $id_tamu = $_GET['id'];
    $data = query("SELECT * FROM buku_tamu WHERE id_tamu = '$id_tamu'");
    // [0]
}

function hapus_tamu($id)
{
    global $koneksi;

    $query = "DELETE FROM buku_tamu WHERE id_tamu = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function tambah_user($data)
{
    global $koneksi;

    $kode = htmlspecialchars($data["id_users"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $user_role = htmlspecialchars($data["user_role"]);

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users VALUES ('$kode', '$username', '$password_hash', '$user_role')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function ubah_user($data)
{
    global $koneksi;

    $kode = htmlspecialchars($data["id_users"]);
    $username = htmlspecialchars($data["username"]);
    $user_role = htmlspecialchars($data["user_role"]);

    $query = "UPDATE users  SET
            username = '$username',
            user_role = '$user_role'
            WHERE id_users = '$kode'
    ";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function hapus_user($id) {
    global $koneksi;

    $query = "DELETE FROM users WHERE id_users = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}