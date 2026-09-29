<?php
include "cek_login.php";
include "koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include "navbar.php"; ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Anggota</h2>
        <a href="form_anggota.php" class="btn btn-primary">+ Tambah Anggota</a>
    </div>

    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['pesan']) ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr><th>No</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Telepon</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nis']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['kelas']) ?></td>
                <td><?= htmlspecialchars($row['telepon']) ?></td>
                <td>
                    <a href="form_anggota.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus_anggota.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
