<?php
include "cek_login.php";
include "koneksi.php";

$sql = "SELECT p.id, b.judul, a.nama, p.tanggal_pinjam, p.tanggal_wajib_kembali, p.tanggal_kembali, p.status
        FROM peminjaman p
        JOIN buku b ON p.id_buku = b.id
        JOIN anggota a ON p.id_anggota = a.id
        ORDER BY p.id DESC";
$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include "navbar.php"; ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Transaksi Peminjaman</h2>
        <a href="tambah_peminjaman.php" class="btn btn-primary">+ Pinjam Buku</a>
    </div>

    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['pesan']) ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>No</th><th>Buku</th><th>Anggota</th><th>Tgl Pinjam</th>
                <th>Wajib Kembali</th><th>Tgl Kembali</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= $row['tanggal_pinjam'] ?></td>
                <td><?= $row['tanggal_wajib_kembali'] ?></td>
                <td><?= $row['tanggal_kembali'] ?? '-' ?></td>
                <td>
                    <?php if ($row['status'] == 'Dipinjam'): ?>
                        <span class="badge bg-warning text-dark">Dipinjam</span>
                    <?php else: ?>
                        <span class="badge bg-success">Dikembalikan</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($row['status'] == 'Dipinjam'): ?>
                        <a href="kembalikan.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success"
                           onclick="return confirm('Tandai buku ini sudah dikembalikan?')">Kembalikan</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
