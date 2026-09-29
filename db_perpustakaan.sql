-- Database: db_perpustakaan
CREATE DATABASE IF NOT EXISTS db_perpustakaan;
USE db_perpustakaan;

CREATE TABLE IF NOT EXISTS petugas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL
);

-- Data akun admin dibuat lewat setup_admin.php (bukan lewat SQL ini)
-- karena password harus di-hash pakai fungsi password_hash() PHP

CREATE TABLE IF NOT EXISTS buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_buku VARCHAR(20) NOT NULL UNIQUE,
    judul VARCHAR(150) NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    stok INT NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS anggota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    kelas VARCHAR(30) NOT NULL,
    telepon VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_buku INT NOT NULL,
    id_anggota INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_wajib_kembali DATE NOT NULL,
    tanggal_kembali DATE DEFAULT NULL,
    status ENUM('Dipinjam','Dikembalikan') NOT NULL DEFAULT 'Dipinjam',
    FOREIGN KEY (id_buku) REFERENCES buku(id),
    FOREIGN KEY (id_anggota) REFERENCES anggota(id)
);

-- Data contoh
INSERT INTO buku (kode_buku, judul, pengarang, penerbit, stok) VALUES
('BK001', 'Pemrograman Web Dasar', 'Budi Raharjo', 'Informatika', 5),
('BK002', 'Basis Data MySQL', 'Andi Setiawan', 'Elex Media', 3),
('BK003', 'Algoritma dan Struktur Data', 'Sri Wahyuni', 'Andi Offset', 4);

INSERT INTO anggota (nis, nama, kelas, telepon) VALUES
('2024001', 'Rangga Pratama', 'XI RPL 1', '081234567890'),
('2024002', 'Salsabila Putri', 'XII RPL 2', '081298765432');
