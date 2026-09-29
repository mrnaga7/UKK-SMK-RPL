<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">Perpustakaan SMK</a>
    <div class="navbar-nav me-auto">
      <a class="nav-link" href="index.php">Dashboard</a>
      <a class="nav-link" href="buku.php">Data Buku</a>
      <a class="nav-link" href="anggota.php">Data Anggota</a>
      <a class="nav-link" href="peminjaman.php">Peminjaman</a>
      <a class="nav-link" href="laporan.php">Laporan</a>
    </div>
    <span class="navbar-text text-white me-3">Halo, <?= htmlspecialchars($_SESSION['nama']) ?></span>
    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
  </div>
</nav>
