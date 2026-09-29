# SOAL LATIHAN UJI KOMPETENSI KEAHLIAN (UKK)
## Kompetensi Keahlian: Rekayasa Perangkat Lunak (RPL)
## Paket Soal: Sistem Informasi Perpustakaan Sekolah

**Waktu Pengerjaan:** 8 jam (dapat dibagi 2 hari @ 4 jam)

---

## 1. SKENARIO / DESKRIPSI KASUS

Perpustakaan SMK Nusantara masih mencatat data peminjaman buku secara manual menggunakan buku besar. Hal ini menyebabkan sering terjadi kehilangan data, sulit mengetahui buku mana yang sedang dipinjam, serta sulit membuat laporan bulanan.

Pihak sekolah meminta Anda sebagai calon tenaga RPL untuk membangun **Sistem Informasi Perpustakaan** berbasis web yang dapat mengelola data buku, data anggota, transaksi peminjaman dan pengembalian buku, serta mencetak laporan.

## 2. INSTRUKSI KERJA (TASK LIST)

Kerjakan hal-hal berikut sesuai urutan prioritas:

1. **Rancang basis data** dengan minimal 3 tabel yang saling berelasi:
   - Tabel buku
   - Tabel anggota
   - Tabel peminjaman (relasi ke buku dan anggota)

2. **Buat sistem login** untuk petugas perpustakaan (admin), lengkap dengan:
   - Validasi username & password
   - Session, sehingga halaman lain tidak bisa diakses tanpa login
   - Fitur logout

3. **Buat modul Data Buku (CRUD)**
   - Tambah, lihat, edit, hapus data buku
   - Field wajib: kode buku, judul, pengarang, penerbit, stok

4. **Buat modul Data Anggota (CRUD)**
   - Tambah, lihat, edit, hapus data anggota
   - Field wajib: NIS/NIP, nama, kelas/jabatan, no. telepon

5. **Buat modul Transaksi Peminjaman**
   - Form peminjaman buku (pilih anggota, pilih buku, tanggal pinjam, tanggal wajib kembali)
   - Stok buku otomatis berkurang saat dipinjam
   - Tombol "Kembalikan" untuk transaksi yang masih dipinjam
   - Stok buku otomatis bertambah saat dikembalikan
   - Status transaksi: "Dipinjam" / "Dikembalikan"

6. **Buat halaman Laporan**
   - Menampilkan rekap seluruh transaksi peminjaman
   - Dapat dicetak (print-friendly / export)

## 3. KETENTUAN TEKNIS

- Bahasa pemrograman: PHP native + MySQL (boleh dikembangkan dengan framework jika waktu memungkinkan)
- Tampilan menggunakan HTML, CSS (boleh Bootstrap)
- Semua input wajib divalidasi (tidak boleh kosong)
- Password disimpan dalam bentuk hash, tidak boleh plain text
- Struktur folder & penamaan file harus rapi dan konsisten

## 4. OUTPUT YANG DIKUMPULKAN

- Source code lengkap (folder project)
- File `.sql` hasil export database
- Screenshot setiap fitur berjalan (login, CRUD buku, CRUD anggota, transaksi, laporan)

## 5. RUBRIK PENILAIAN (SIMULASI)

| Komponen | Bobot |
|---|---|
| Persiapan (struktur project, desain database) | 10% |
| Proses kerja (kesesuaian tahapan, efisiensi coding) | 20% |
| Hasil kerja - Login & keamanan | 15% |
| Hasil kerja - CRUD Buku | 15% |
| Hasil kerja - CRUD Anggota | 15% |
| Hasil kerja - Transaksi Peminjaman/Pengembalian | 15% |
| Hasil kerja - Laporan | 10% |

---

*Soal ini merupakan simulasi latihan mandiri berdasarkan pola umum paket soal UKK RPL, bukan salinan resmi dari LSP atau Direktorat SMK.*
