-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 09:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminarku`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` tinyint(2) NOT NULL,
  `kode_fakultas` varchar(3) NOT NULL,
  `nama_fakultas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `kode_fakultas`, `nama_fakultas`) VALUES
(1, 'FTI', 'Fakultas Teknologi Informasi'),
(2, 'FEB', 'Fakultas Ekonomi dan Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `history_seminar`
--

CREATE TABLE `history_seminar` (
  `id_history` int(11) NOT NULL,
  `id_seminar` int(11) NOT NULL,
  `nama_seminar` varchar(255) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `tanggal_pelaksanaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_seminar`
--

INSERT INTO `history_seminar` (`id_history`, `id_seminar`, `nama_seminar`, `id_mahasiswa`, `nama_mahasiswa`, `tanggal_pelaksanaan`) VALUES
(39, 8, 'semianr bisnis digital', 37, 'Ridwan Saputra', '2024-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `id_jenjang` tinyint(2) NOT NULL,
  `kode_jenjang` varchar(3) NOT NULL,
  `nama_jenjang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`id_jenjang`, `kode_jenjang`, `nama_jenjang`) VALUES
(1, 'D3', 'Diploma-3'),
(2, 'S1', 'Strata-1'),
(3, 'S2', 'Strata-2');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(17, '::1', 'ridwansaputra331@gmail.com', 1731790936),
(18, '::1', 'ridwansaputra331@gmail.com', 1731791253),
(19, '::1', 'ridwansaputra331@gmail.com', 1731792287),
(20, '::1', 'ridwansaputra331@gmail.com', 1731792461),
(21, '::1', 'ridwansaputra331@gmail.com', 1731792580),
(22, '::1', 'ridwansaputra331@gmail.com', 1731793031),
(23, '::1', 'ridwansaputra331@gmail.com', 1731793080),
(24, '::1', 'ridwansaputra331@gmail.com', 1731793239);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `id_fakultas` tinyint(2) NOT NULL,
  `id_prodi` tinyint(2) NOT NULL,
  `id_jenjang` tinyint(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama_mhs`, `id_fakultas`, `id_prodi`, `id_jenjang`, `email`, `no_telp`, `tanggal_lahir`) VALUES
(37, 12220094, 'Ridwan Saputra', 1, 2, 3, 'ridwansaputra331@gmail.com', '081295101633', '2024-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `master_admin`
--

CREATE TABLE `master_admin` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_admin`
--

INSERT INTO `master_admin` (`id`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES
(1, 'masteradmin', 'Masteradmin123', 'ridwansaputra331@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode` tinyint(2) NOT NULL,
  `nama_metode` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode`, `nama_metode`) VALUES
(1, 'Cash'),
(2, 'Transfer'),
(3, 'Belum Bayar');

-- --------------------------------------------------------

--
-- Table structure for table `pembicara`
--

CREATE TABLE `pembicara` (
  `id_pembicara` tinyint(3) NOT NULL,
  `nama_pembicara` varchar(150) NOT NULL,
  `latar_belakang` varchar(100) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembicara`
--

INSERT INTO `pembicara` (`id_pembicara`, `nama_pembicara`, `latar_belakang`, `id_seminar`, `foto`) VALUES
(13, 'khania Saputri S.T, M.T', 'Co founder', 3, '5b79623d771e51631a0baea7eba9178e.jpg'),
(14, 'Rayhan dava', 'founder', 4, '82e5c14b19f6d209be54848f44cc42fd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_seminar`
--

CREATE TABLE `pendaftaran_seminar` (
  `id_pendaftaran` int(10) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `jam_daftar` time NOT NULL,
  `id_stsbyr` tinyint(2) NOT NULL,
  `id_metode` tinyint(2) NOT NULL,
  `id_scan` int(8) NOT NULL,
  `sertifikat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presensi_seminar`
--

CREATE TABLE `presensi_seminar` (
  `id_presensi` int(11) NOT NULL,
  `id_mahasiswa` int(3) NOT NULL,
  `nomor_induk` int(15) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `tgl_khd` date NOT NULL,
  `jam_khd` time NOT NULL,
  `id_stskhd` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi_seminar`
--

INSERT INTO `presensi_seminar` (`id_presensi`, `id_mahasiswa`, `nomor_induk`, `id_seminar`, `tgl_khd`, `jam_khd`, `id_stskhd`) VALUES
(152, 37, 12220094, 8, '2024-11-06', '17:10:59', 2);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` tinyint(2) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `kode_prodi` varchar(3) NOT NULL,
  `nama_prodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_fakultas`, `kode_prodi`, `nama_prodi`) VALUES
(1, 1, 'SI', 'Sistem Infomasi'),
(2, 1, 'IF', 'Informatika'),
(3, 1, 'SD', 'Sains Data'),
(4, 2, 'MJN', 'Manajemen'),
(5, 2, 'BD', 'Bisnis Digital');

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE `seminar` (
  `id_seminar` int(3) NOT NULL,
  `nama_seminar` varchar(50) NOT NULL,
  `tgl_pelaksana` datetime NOT NULL,
  `lampiran` varchar(64) NOT NULL,
  `sertifikat` varchar(258) NOT NULL,
  `file` varchar(258) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seminar`
--

INSERT INTO `seminar` (`id_seminar`, `nama_seminar`, `tgl_pelaksana`, `lampiran`, `sertifikat`, `file`) VALUES
(3, 'How To Build Enterprise', '2024-10-30 09:30:00', '35df26df19ce5a4a6911e1e2af4357af.jpg', 'sertifikat_1727833891.png', 'file_How_To_Build_Enterprise.sql'),
(4, 'Mastering the art of copywriting', '2024-10-31 08:00:00', '5298c246a085775e215020733e1bd1c2.jpg', '', 'file_Mastering_the_art_of_copywriting.zip'),
(8, 'semianr bisnis digital', '2025-02-25 08:00:00', 'a7fd84bf9361a0c2ede1824816d4e1c0.png', 'sertifikat_1729688502.jpg', 'file_semianr_bisnis_digital.zip');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `id_sponsor` tinyint(3) NOT NULL,
  `nama_sponsor` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id_sponsor`, `nama_sponsor`, `gambar`, `id_seminar`) VALUES
(8, 'Teh botol sosro', 'f77f72030d9b8bc4460a70a6741790ad.jpg', 3),
(9, 'Nutragen', '29625b88acc99c9a8a3b74b44c0c338c.jpg', 3),
(10, 'Binary Indonesia', '861dda7fd02729eda0b36350337c4b50.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `status_kehadiran`
--

CREATE TABLE `status_kehadiran` (
  `id_stskhd` tinyint(1) NOT NULL,
  `nama_stskhd` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_kehadiran`
--

INSERT INTO `status_kehadiran` (`id_stskhd`, `nama_stskhd`) VALUES
(1, 'Tidak Hadir'),
(2, 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `id_stsbyr` tinyint(2) NOT NULL,
  `nama_stsbyr` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_pembayaran`
--

INSERT INTO `status_pembayaran` (`id_stsbyr`, `nama_stsbyr`) VALUES
(2, 'Belum Lunas'),
(1, 'Sudah Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` tinyint(3) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `harga_tiket` bigint(15) NOT NULL,
  `slot_tiket` int(5) NOT NULL,
  `lampiran_tiket` varchar(100) NOT NULL,
  `tiket_terjual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_seminar`, `harga_tiket`, `slot_tiket`, `lampiran_tiket`, `tiket_terjual`) VALUES
(6, 3, 50000, 200, '', 29),
(7, 4, 30000, 300, '', 15),
(13, 8, 55000, 200, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_vendor` int(11) UNSIGNED NOT NULL,
  `nama_vendor` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `no_telp` int(15) NOT NULL,
  `tgl_subs` date NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_vendor`, `nama_vendor`, `password`, `email`, `no_telp`, `tgl_subs`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `active`) VALUES
(1, 'Universitas Nusa Mandiri', '$2y$12$RsDIoS9EpYmBywqcvlYAsOYWc8AYGdpTJbNYf/eyWHVMY.VDg/uC6', 'sistemmanajemenseminar@gmail.com', 0, '0000-00-00', NULL, '', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_mhs`
--

CREATE TABLE `user_mhs` (
  `id_mahasiswa` int(22) NOT NULL,
  `nim` varchar(36) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(36) NOT NULL,
  `id_reset` int(36) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `expiry_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_mhs`
--

INSERT INTO `user_mhs` (`id_mahasiswa`, `nim`, `email`, `password`, `id_reset`, `reset_token`, `expiry_time`) VALUES
(1, '12345678', 'Rid@g.com', 'be60d5acf94273e503e12944ba730d51', 1, NULL, NULL),
(37, '12220094', 'ridwansaputra331@gmail.com', 'e9598d5e9a5569d14b08ccf7529f85fa', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_seminar`
--
ALTER TABLE `history_seminar`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_seminar` (`id_seminar`),
  ADD KEY `history_seminar_ibfk_2` (`id_mahasiswa`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id_jenjang`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_prodi` (`id_fakultas`,`id_prodi`,`id_jenjang`);

--
-- Indexes for table `master_admin`
--
ALTER TABLE `master_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `remember_selector` (`remember_selector`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indexes for table `pembicara`
--
ALTER TABLE `pembicara`
  ADD PRIMARY KEY (`id_pembicara`),
  ADD KEY `id_seminar` (`id_seminar`);

--
-- Indexes for table `pendaftaran_seminar`
--
ALTER TABLE `pendaftaran_seminar`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_seminar` (`id_seminar`,`id_mahasiswa`,`id_stsbyr`,`id_metode`);

--
-- Indexes for table `presensi_seminar`
--
ALTER TABLE `presensi_seminar`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `id_mahasiswa` (`id_stskhd`),
  ADD KEY `id_seminar` (`id_seminar`),
  ADD KEY `id_mahasiswa_2` (`id_mahasiswa`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`id_seminar`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id_sponsor`),
  ADD KEY `id_seminar` (`id_seminar`);

--
-- Indexes for table `status_kehadiran`
--
ALTER TABLE `status_kehadiran`
  ADD PRIMARY KEY (`id_stskhd`);

--
-- Indexes for table `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`id_stsbyr`),
  ADD KEY `nama_stsbyr` (`nama_stsbyr`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_seminar` (`id_seminar`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_vendor`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `user_mhs`
--
ALTER TABLE `user_mhs`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_seminar`
--
ALTER TABLE `history_seminar`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id_jenjang` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `master_admin`
--
ALTER TABLE `master_admin`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembicara`
--
ALTER TABLE `pembicara`
  MODIFY `id_pembicara` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pendaftaran_seminar`
--
ALTER TABLE `pendaftaran_seminar`
  MODIFY `id_pendaftaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `presensi_seminar`
--
ALTER TABLE `presensi_seminar`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id_seminar` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id_sponsor` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `status_kehadiran`
--
ALTER TABLE `status_kehadiran`
  MODIFY `id_stskhd` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  MODIFY `id_stsbyr` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_vendor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_seminar`
--
ALTER TABLE `history_seminar`
  ADD CONSTRAINT `history_seminar_ibfk_1` FOREIGN KEY (`id_seminar`) REFERENCES `seminar` (`id_seminar`),
  ADD CONSTRAINT `history_seminar_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_vendor`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
