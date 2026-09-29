<?php
// JALANKAN FILE INI SEKALI SAJA UNTUK MEMBUAT AKUN ADMIN PERTAMA
// Setelah berhasil, SEGERA HAPUS file ini demi keamanan.
include "koneksi.php";

$username = "admin";
$password_asli = "admin123";       // ganti sesuai keinginan
$nama = "Admin Perpustakaan";

$password_hash = password_hash($password_asli, PASSWORD_DEFAULT);

$cek = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username'");

if (mysqli_num_rows($cek) > 0) {
    echo "Akun admin sudah ada. Tidak perlu membuat ulang.";
} else {
    $sql = "INSERT INTO petugas (username, password, nama) VALUES ('$username', '$password_hash', '$nama')";
    if (mysqli_query($koneksi, $sql)) {
        echo "Akun admin berhasil dibuat.<br>";
        echo "Username: $username<br>";
        echo "Password: $password_asli<br><br>";
        echo "<b>PENTING:</b> Hapus file setup_admin.php ini sekarang, lalu login di login.php";
    } else {
        echo "Gagal membuat akun: " . mysqli_error($koneksi);
    }
}
?>
