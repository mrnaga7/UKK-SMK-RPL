<?php
include "cek_login.php";
include "koneksi.php";

$edit_mode = false;
$data = ['kode_buku' => '', 'judul' => '', 'pengarang' => '', 'penerbit' => '', 'stok' => ''];

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id=$id");
    $hasil = mysqli_fetch_assoc($query);
    if ($hasil) {
        $data = $hasil;
        $edit_mode = true;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_buku = mysqli_real_escape_string($koneksi, $_POST['kode_buku']);
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $stok = (int) $_POST['stok'];
    $id_post = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($kode_buku == "" || $judul == "" || $pengarang == "" || $penerbit == "" || $stok < 0) {
        $error = "Semua field wajib diisi dengan benar!";
        $data = $_POST;
    } else {
        if ($id_post > 0) {
            $sql = "UPDATE buku SET kode_buku='$kode_buku', judul='$judul', pengarang='$pengarang', penerbit='$penerbit', stok=$stok WHERE id=$id_post";
            $pesan = "Data buku berhasil diperbarui";
        } else {
            $sql = "INSERT INTO buku (kode_buku, judul, pengarang, penerbit, stok) VALUES ('$kode_buku', '$judul', '$pengarang', '$penerbit', $stok)";
            $pesan = "Data buku berhasil ditambahkan";
        }

        if (mysqli_query($koneksi, $sql)) {
            header("Location: buku.php?pesan=" . urlencode($pesan));
            exit;
        } else {
            $error = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $edit_mode ? 'Edit' : 'Tambah' ?> Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include "navbar.php"; ?>
<div class="container">
    <h2 class="mb-4"><?= $edit_mode ? 'Edit' : 'Tambah' ?> Data Buku</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">
        <div class="mb-3">
            <label class="form-label">Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" value="<?= htmlspecialchars($data['kode_buku']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Pengarang</label>
            <input type="text" name="pengarang" class="form-control" value="<?= htmlspecialchars($data['pengarang']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" value="<?= htmlspecialchars($data['penerbit']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" min="0" value="<?= htmlspecialchars($data['stok']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="buku.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
