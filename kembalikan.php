<?php
include "cek_login.php";
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: peminjaman.php");
    exit;
}
$id = (int) $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id=$id AND status='Dipinjam'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: peminjaman.php?error=" . urlencode("Transaksi tidak ditemukan atau sudah dikembalikan"));
    exit;
}

mysqli_begin_transaction($koneksi);
try {
    $sql1 = "UPDATE peminjaman SET status='Dikembalikan', tanggal_kembali=CURDATE() WHERE id=$id";
    mysqli_query($koneksi, $sql1);

    $sql2 = "UPDATE buku SET stok = stok + 1 WHERE id=" . $data['id_buku'];
    mysqli_query($koneksi, $sql2);

    mysqli_commit($koneksi);
    header("Location: peminjaman.php?pesan=" . urlencode("Buku berhasil ditandai dikembalikan"));
    exit;
} catch (Exception $e) {
    mysqli_rollback($koneksi);
    header("Location: peminjaman.php?error=" . urlencode("Gagal memproses pengembalian"));
    exit;
}
?>
