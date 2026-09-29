<?php
include "cek_login.php";
include "koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include "navbar.php"; ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Buku</h2>
        <a href="form_buku.php" class="btn btn-primary">+ Tambah Buku</a>
    </div>

    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['pesan']) ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>No</th><th>Kode</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Stok</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['kode_buku']) ?></td>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><?= htmlspecialchars($row['pengarang']) ?></td>
                <td><?= htmlspecialchars($row['penerbit']) ?></td>
                <td><?= $row['stok'] ?></td>
                <td>
                    <a href="form_buku.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus_buku.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
