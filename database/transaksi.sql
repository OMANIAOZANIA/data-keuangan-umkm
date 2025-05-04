-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Apr 2025 pada 19.38
-- Versi server: 8.0.41-cll-lve
-- Versi PHP: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xipsmyid_umkm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int NOT NULL,
  `transaksi_tanggal` date NOT NULL,
  `transaksi_jenis` enum('Pengeluaran','Pemasukan') NOT NULL,
  `transaksi_kategori` int NOT NULL,
  `transaksi_nominal` int NOT NULL,
  `transaksi_keterangan` text NOT NULL,
  `transaksi_bank` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tanggal`, `transaksi_jenis`, `transaksi_kategori`, `transaksi_nominal`, `transaksi_keterangan`, `transaksi_bank`) VALUES
(1, '2025-03-21', 'Pemasukan', 3, 1000000, 'Kiki\r\n', 1),
(4, '2025-03-21', 'Pengeluaran', 8, 50000, 'Beli Alat Kantor', 1),
(5, '2025-03-20', 'Pemasukan', 4, 1500000, '', 1),
(6, '2025-03-06', 'Pemasukan', 1, 13570000, 'Pembayaran Project', 1),
(8, '2025-03-14', 'Pemasukan', 12, 20000000, 'Pembuatan Aplikasi Sistem Rumah Sakit Karya Bakti', 1),
(9, '2025-03-22', 'Pengeluaran', 13, 200000, 'Biaya Berobat Pak Tele', 1),
(10, '2025-03-22', 'Pemasukan', 3, 4000000, 'Pembuatan Aplikasi Klinik', 3),
(11, '2025-03-14', 'Pemasukan', 3, 1000000, '', 1),
(12, '2025-03-21', 'Pengeluaran', 10, 32000000, 'tes', 3),
(13, '2025-03-23', 'Pengeluaran', 14, 300000, 'Hosting Tahunan', 1),
(15, '2025-03-23', 'Pengeluaran', 14, 300000, 'Biaya Hosting tahun Depan', 3),
(16, '2025-03-23', 'Pemasukan', 4, 2000000, 'Penjualan Aplikasi Laba Rugi', 1),
(17, '2025-03-23', 'Pemasukan', 4, 2000000, 'Penjualan Aplikasi Akademik Sekolah SMP 888', 1),
(19, '2025-03-01', 'Pemasukan', 4, 2000000, 'pembuatan aplikasi web + hosting', 3),
(20, '2025-04-24', 'Pemasukan', 4, 2500000, 'Penjualan template website toko online', 1),
(21, '2025-04-24', 'Pengeluaran', 8, 75000, 'Beli tinta printer', 2),
(22, '2025-04-24', 'Pemasukan', 3, 3000000, 'Jasa setting toko Shopee', 3),
(23, '2025-04-24', 'Pengeluaran', 13, 150000, 'Langganan Zoom Pro', 1),
(24, '2025-04-24', 'Pengeluaran', 10, 5000000, 'Sewa tempat seminar UMKM', 3),
(25, '2025-04-24', 'Pemasukan', 1, 12000000, 'Project ERP untuk UMKM makanan', 1),
(26, '2025-04-24', 'Pemasukan', 12, 8500000, 'Bayaran aplikasi absensi karyawan', 2),
(27, '2025-04-24', 'Pengeluaran', 14, 250000, 'Perpanjangan domain dan SSL', 1),
(28, '2025-04-24', 'Pengeluaran', 8, 130000, 'Beli alat tulis kantor', 3),
(29, '2025-04-24', 'Pemasukan', 4, 1750000, 'Jual script laporan keuangan UMKM', 1),
(30, '2025-02-02', 'Pemasukan', 3, 5000000, 'Pembuatan sistem kasir minimarket', 1),
(31, '2025-02-05', 'Pengeluaran', 8, 200000, 'Beli mouse dan keyboard baru', 2),
(32, '2025-02-07', 'Pemasukan', 4, 4000000, 'Penjualan aplikasi invoice sederhana', 1),
(33, '2025-02-10', 'Pengeluaran', 14, 300000, 'Perpanjangan hosting & domain', 3),
(34, '2025-02-12', 'Pemasukan', 12, 6500000, 'Bayaran pembuatan sistem absensi', 1),
(35, '2025-02-14', 'Pengeluaran', 13, 500000, 'Langganan Canva dan Google Workspace', 2),
(36, '2025-02-16', 'Pemasukan', 4, 4500000, 'Jual aplikasi keuangan UMKM', 1),
(37, '2025-02-18', 'Pengeluaran', 10, 3500000, 'Biaya operasional event pelatihan', 3),
(38, '2025-02-20', 'Pengeluaran', 8, 120000, 'Beli ATK tambahan', 1),
(39, '2025-02-23', 'Pemasukan', 3, 4400000, 'Pembayaran project redesign UI', 2),
(40, '2025-01-03', 'Pemasukan', 4, 2000000, 'Penjualan aplikasi laporan stok', 1),
(41, '2025-01-05', 'Pengeluaran', 8, 750000, 'Beli kertas HVS & tinta', 2),
(42, '2025-01-07', 'Pemasukan', 3, 3000000, 'Pembuatan website UMKM fashion', 3),
(43, '2025-01-10', 'Pengeluaran', 13, 1200000, 'Langganan plugin & tools', 1),
(44, '2025-01-12', 'Pemasukan', 4, 2500000, 'Penjualan sistem laundry', 1),
(45, '2025-01-15', 'Pengeluaran', 10, 3000000, 'Biaya pelatihan digital marketing', 3),
(46, '2025-01-18', 'Pemasukan', 12, 2700000, 'Bayaran app absensi toko bangunan', 2),
(47, '2025-01-21', 'Pengeluaran', 14, 1000000, 'Perpanjang hosting tahunan', 1),
(48, '2025-01-23', 'Pengeluaran', 8, 950000, 'Beli peralatan kerja baru', 3),
(49, '2025-01-27', 'Pemasukan', 3, 1500000, 'Jual landing page UMKM kue rumahan', 1),
(50, '2024-11-02', 'Pemasukan', 3, 3000000, 'Jual script toko online sederhana', 2),
(51, '2024-11-04', 'Pengeluaran', 8, 500000, 'Beli meja kerja baru', 3),
(52, '2024-11-07', 'Pemasukan', 4, 4500000, 'Penjualan sistem keuangan koperasi', 1),
(53, '2024-11-10', 'Pengeluaran', 13, 700000, 'Langganan Figma & Notion', 2),
(54, '2024-11-12', 'Pemasukan', 12, 6000000, 'Project website company profile', 1),
(55, '2024-11-14', 'Pengeluaran', 10, 3200000, 'Kegiatan pelatihan digitalisasi', 3),
(56, '2024-11-17', 'Pemasukan', 4, 2000000, 'Penjualan software pembukuan sederhana', 1),
(57, '2024-11-20', 'Pengeluaran', 8, 400000, 'Beli perlengkapan kantor', 3),
(58, '2024-11-22', 'Pengeluaran', 14, 900000, 'Perpanjangan domain + hosting', 2),
(59, '2024-11-25', 'Pemasukan', 3, 2500000, 'Pembuatan desain UI/UX aplikasi UMKM', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
