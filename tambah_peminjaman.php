<?php
include "cek_login.php";
include "koneksi.php";

// Hanya tampilkan buku yang stoknya masih ada
$buku_query = mysqli_query($koneksi, "SELECT * FROM buku WHERE stok > 0 ORDER BY judul ASC");
$anggota_query = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_buku = (int) $_POST['id_buku'];
    $id_anggota = (int) $_POST['id_anggota'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_wajib_kembali = $_POST['tanggal_wajib_kembali'];

    if ($id_buku == 0 || $id_anggota == 0 || $tanggal_pinjam == "" || $tanggal_wajib_kembali == "") {
        $error = "Semua field wajib diisi!";
    } else {
        // Cek ulang stok sebelum insert (mencegah race condition sederhana)
        $cek_stok = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stok FROM buku WHERE id=$id_buku"));

        if ($cek_stok['stok'] < 1) {
            $error = "Stok buku ini sudah habis!";
        } else {
            mysqli_begin_transaction($koneksi);
            try {
                $sql1 = "INSERT INTO peminjaman (id_buku, id_anggota, tanggal_pinjam, tanggal_wajib_kembali, status)
                         VALUES ($id_buku, $id_anggota, '$tanggal_pinjam', '$tanggal_wajib_kembali', 'Dipinjam')";
                mysqli_query($koneksi, $sql1);

                $sql2 = "UPDATE buku SET stok = stok - 1 WHERE id=$id_buku";
                mysqli_query($koneksi, $sql2);

                mysqli_commit($koneksi);
                header("Location: peminjaman.php?pesan=" . urlencode("Peminjaman berhasil dicatat"));
                exit;
            } catch (Exception $e) {
                mysqli_rollback($koneksi);
                $error = "Gagal menyimpan transaksi: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include "navbar.php"; ?>
<div class="container">
    <h2 class="mb-4">Form Peminjaman Buku</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Buku</label>
            <select name="id_buku" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                <?php while ($b = mysqli_fetch_assoc($buku_query)): ?>
                    <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['judul']) ?> (stok: <?= $b['stok'] ?>)</option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Anggota</label>
            <select name="id_anggota" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <?php while ($a = mysqli_fetch_assoc($anggota_query)): ?>
                    <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nama']) ?> (<?= htmlspecialchars($a['kelas']) ?>)</option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Wajib Kembali</label>
            <input type="date" name="tanggal_wajib_kembali" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
        <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
