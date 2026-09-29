<?php
include "cek_login.php";
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM anggota WHERE id=$id");
    header("Location: anggota.php?pesan=" . urlencode("Data anggota berhasil dihapus"));
    exit;
} else {
    header("Location: anggota.php");
    exit;
}
?>
