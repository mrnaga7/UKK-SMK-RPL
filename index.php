<?php
include "cek_login.php";
include "koneksi.php";

$total_buku = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM buku"))['jumlah'];
$total_anggota = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM anggota"))['jumlah'];
$total_dipinjam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM peminjaman WHERE status='Dipinjam'"))['jumlah'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include "navbar.php"; ?>
<div class="container">
    <h2 class="mb-4">Dashboard</h2>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h6>Total Judul Buku</h6>
                    <h2><?= $total_buku ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h6>Total Anggota</h6>
                    <h2><?= $total_anggota ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h6>Sedang Dipinjam</h6>
                    <h2><?= $total_dipinjam ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
