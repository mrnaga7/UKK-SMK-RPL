<?php
include "cek_login.php";
include "koneksi.php";

$sql = "SELECT p.id, b.kode_buku, b.judul, a.nis, a.nama, p.tanggal_pinjam, p.tanggal_wajib_kembali, p.tanggal_kembali, p.status
        FROM peminjaman p
        JOIN buku b ON p.id_buku = b.id
        JOIN anggota a ON p.id_anggota = a.id
        ORDER BY p.tanggal_pinjam DESC";
$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
        }
    </style>
</head>
<body class="bg-light">
<div class="no-print"><?php include "navbar.php"; ?></div>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Laporan Peminjaman Buku</h2>
            <p class="text-muted">Perpustakaan SMK Nusantara — Dicetak: <?= date('d-m-Y') ?></p>
        </div>
        <button onclick="window.print()" class="btn btn-primary no-print">Cetak / Export PDF</button>
    </div>

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>No</th><th>Kode Buku</th><th>Judul</th><th>NIS</th><th>Nama Anggota</th>
                <th>Tgl Pinjam</th><th>Wajib Kembali</th><th>Tgl Kembali</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['kode_buku']) ?></td>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><?= htmlspecialchars($row['nis']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= $row['tanggal_pinjam'] ?></td>
                <td><?= $row['tanggal_wajib_kembali'] ?></td>
                <td><?= $row['tanggal_kembali'] ?? '-' ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
