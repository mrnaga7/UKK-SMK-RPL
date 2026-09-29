<?php
include "cek_login.php";
include "koneksi.php";

$edit_mode = false;
$data = ['nis' => '', 'nama' => '', 'kelas' => '', 'telepon' => ''];

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id=$id");
    $hasil = mysqli_fetch_assoc($query);
    if ($hasil) {
        $data = $hasil;
        $edit_mode = true;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);
    $id_post = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($nis == "" || $nama == "" || $kelas == "") {
        $error = "NIS, Nama, dan Kelas wajib diisi!";
        $data = $_POST;
    } else {
        if ($id_post > 0) {
            $sql = "UPDATE anggota SET nis='$nis', nama='$nama', kelas='$kelas', telepon='$telepon' WHERE id=$id_post";
            $pesan = "Data anggota berhasil diperbarui";
        } else {
            $sql = "INSERT INTO anggota (nis, nama, kelas, telepon) VALUES ('$nis', '$nama', '$kelas', '$telepon')";
            $pesan = "Data anggota berhasil ditambahkan";
        }

        if (mysqli_query($koneksi, $sql)) {
            header("Location: anggota.php?pesan=" . urlencode($pesan));
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
    <title><?= $edit_mode ? 'Edit' : 'Tambah' ?> Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include "navbar.php"; ?>
<div class="container">
    <h2 class="mb-4"><?= $edit_mode ? 'Edit' : 'Tambah' ?> Data Anggota</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">
        <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text" name="nis" class="form-control" value="<?= htmlspecialchars($data['nis']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($data['kelas']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= htmlspecialchars($data['telepon']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="anggota.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
