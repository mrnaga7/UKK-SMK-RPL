<?php
include "cek_login.php";
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM buku WHERE id=$id");
    header("Location: buku.php?pesan=" . urlencode("Data buku berhasil dihapus"));
    exit;
} else {
    header("Location: buku.php");
    exit;
}
?>
