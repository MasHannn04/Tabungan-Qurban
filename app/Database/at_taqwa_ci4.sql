-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2026 at 05:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `at_taqwa_ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `link_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `pesan`, `is_read`, `link_to`, `created_at`) VALUES
(1, 2, 'Bulan baru telah tiba, mari rutinkan kembali tabungan qurban Anda!', 0, 'warga/saving', '2026-08-24 01:35:47'),
(2, 4, 'Bulan baru telah tiba, mari rutinkan kembali tabungan qurban Anda!', 0, 'warga/saving', '2026-08-24 01:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `setoran`
--

CREATE TABLE `setoran` (
  `id_setoran` int(11) NOT NULL,
  `id_warga` int(11) NOT NULL,
  `kode_trx` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `metode` varchar(50) NOT NULL DEFAULT 'Transfer bank',
  `nominal` decimal(12,2) NOT NULL,
  `status` enum('Berhasil','Pending','Ditolak') NOT NULL DEFAULT 'Berhasil',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setoran`
--

INSERT INTO `setoran` (`id_setoran`, `id_warga`, `kode_trx`, `tanggal`, `keterangan`, `metode`, `nominal`, `status`, `created_at`) VALUES
(1, 1, 'TRX-26081201', '2026-08-12', 'Setoran rutin Agustus', 'BSI ?? 7171 8800 42', 500000.00, 'Berhasil', '2026-08-20 03:25:43'),
(2, 1, 'TRX-26071002', '2026-07-10', 'Setoran rutin Juli', 'BSI ?? 7171 8800 42', 500000.00, 'Berhasil', '2026-08-20 03:25:43'),
(3, 1, 'TRX-26061103', '2026-06-11', 'Setoran rutin Juni', 'BSI ?? 7171 8800 42', 500000.00, 'Berhasil', '2026-08-20 03:25:43'),
(4, 1, 'TRX-26050804', '2026-05-08', 'Setoran rutin Mei', 'BSI ?? 7171 8800 42', 450000.00, 'Berhasil', '2026-08-20 03:25:43'),
(5, 1, 'TRX-260820401', '2026-08-20', 'Setoran rutin', 'BSI ?? 7171 8800 42', 500000.00, 'Berhasil', '2026-08-20 03:26:42'),
(6, 5, 'TRX-260820587', '2026-08-20', 'Setoran rutin', 'BSI ?? 7171 8800 42', 500000.00, 'Berhasil', '2026-08-20 04:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','warga') NOT NULL DEFAULT 'warga',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$wE99Y0M0JqZ.y61nQG4zJ.Y1Wp1o/o.rS4a5b6c7d8e9f0', 'Pak Fauzan', 'admin', '2026-08-20 03:25:43'),
(2, 'warga', '$2y$10$wE99Y0M0JqZ.y61nQG4zJ.Y1Wp1o/o.rS4a5b6c7d8e9f0', 'Ahmad Syafi\'i', 'warga', '2026-08-20 03:25:43'),
(3, 'budi', '$2y$10$8OfmpivV6yugcR55NOQ0beZtFHVh2NCrNU0Yh/1ctmFqVZpX1bADu', 'Budi Santoso', 'warga', '2026-08-20 03:53:36'),
(4, 'siti', '$2y$10$.HzXwFoOTDr1Vxml/1KfT.eJ13hwSQ7wNO8M5htkvmUpQv0mddtrq', 'Siti Aminah', 'warga', '2026-08-20 03:53:36'),
(5, 'joko', '$2y$10$nh5TF8NP4LIrMe0uA750aOkKmwqbu5mo8i789unxSrnjLh9H338n2', 'Joko Widodo', 'warga', '2026-08-20 03:53:36'),
(6, 'adit', '$2y$10$Xc8Dzi9wj05Ns5I2K1LHAuNBJBV37lugDD9fYITMgkQzJE9c1GNi.', 'Adit', 'warga', '2026-08-20 04:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id_warga` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `rt_rw` varchar(20) NOT NULL DEFAULT 'RT 04',
  `saldo_tabungan` decimal(12,2) NOT NULL DEFAULT 0.00,
  `target_qurban` decimal(12,2) NOT NULL DEFAULT 12500000.00,
  `jenis_qurban` varchar(50) NOT NULL DEFAULT 'Sapi Kolektif',
  `status` enum('Aktif','Lunas','Perlu diingatkan') NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id_warga`, `id_user`, `no_hp`, `rt_rw`, `saldo_tabungan`, `target_qurban`, `jenis_qurban`, `status`) VALUES
(1, 2, '081234567890', 'RT 04', 2450000.00, 12500000.00, 'Sapi Kolektif', 'Aktif'),
(2, 3, '08123456789', 'RT 01', 15000000.00, 15000000.00, 'Sapi Kolektif', 'Lunas'),
(3, 4, '08123456789', 'RT 01', 5000000.00, 12500000.00, 'Sapi Kolektif', 'Aktif'),
(4, 5, '08123456789', 'RT 01', 1000000.00, 12500000.00, 'Sapi Kolektif', 'Perlu diingatkan'),
(5, 6, '081829137482', 'RT05', 500000.00, 12500000.00, 'Sapi Kolektif', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`id_setoran`),
  ADD UNIQUE KEY `kode_trx` (`kode_trx`),
  ADD KEY `id_warga` (`id_warga`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id_warga`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setoran`
--
ALTER TABLE `setoran`
  MODIFY `id_setoran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warga`
--
ALTER TABLE `warga`
  MODIFY `id_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `setoran`
--
ALTER TABLE `setoran`
  ADD CONSTRAINT `setoran_ibfk_1` FOREIGN KEY (`id_warga`) REFERENCES `warga` (`id_warga`) ON DELETE CASCADE;

--
-- Constraints for table `warga`
--
ALTER TABLE `warga`
  ADD CONSTRAINT `warga_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
