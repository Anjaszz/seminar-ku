-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2024 pada 15.18
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` tinyint(2) NOT NULL,
  `kode_fakultas` varchar(3) NOT NULL,
  `nama_fakultas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `kode_fakultas`, `nama_fakultas`) VALUES
(1, 'FTI', 'Fakultas Teknologi Informasi'),
(2, 'FEB', 'Fakultas Ekonomi dan Bisnis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenjang`
--

CREATE TABLE `jenjang` (
  `id_jenjang` tinyint(2) NOT NULL,
  `kode_jenjang` varchar(3) NOT NULL,
  `nama_jenjang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenjang`
--

INSERT INTO `jenjang` (`id_jenjang`, `kode_jenjang`, `nama_jenjang`) VALUES
(1, 'D3', 'Diploma-3'),
(2, 'S1', 'Strata-1'),
(3, 'S2', 'Strata-2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `id_fakultas` tinyint(2) NOT NULL,
  `id_prodi` tinyint(2) NOT NULL,
  `id_jenjang` tinyint(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama_mhs`, `id_fakultas`, `id_prodi`, `id_jenjang`, `email`, `no_telp`) VALUES
(169, 12220107, 'Anjas Rani', 1, 2, 2, 'anjaszzz04@gmail.com', '082258040148'),
(173, 12220094, 'Ridwan Saputra', 1, 2, 2, 'ridwansaputra@gmail.com', '085726262628'),
(175, 12220136, 'Nabil Irwansyah', 1, 2, 2, 'NabilIrwansyah@gmail.com', '085726262628'),
(176, 12220073, 'Yovela Kalista Avansa', 1, 2, 2, 'YovelaKalista@gmail.com', '085726262621'),
(177, 12220097, 'Annisa nur amelia', 1, 2, 2, 'annisanuramelia@gmail.com', '085726262624');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode` tinyint(2) NOT NULL,
  `nama_metode` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode`, `nama_metode`) VALUES
(1, 'Cash'),
(2, 'Transfer'),
(3, 'Belum Bayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembicara`
--

CREATE TABLE `pembicara` (
  `id_pembicara` tinyint(3) NOT NULL,
  `nama_pembicara` varchar(150) NOT NULL,
  `latar_belakang` varchar(100) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembicara`
--

INSERT INTO `pembicara` (`id_pembicara`, `nama_pembicara`, `latar_belakang`, `id_seminar`, `foto`) VALUES
(13, 'khania Saputri S.T, M.T', 'Co founder', 3, '5b79623d771e51631a0baea7eba9178e.jpg'),
(14, 'Rayhan dava', 'founder', 4, '82e5c14b19f6d209be54848f44cc42fd.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_seminar`
--

CREATE TABLE `pendaftaran_seminar` (
  `id_pendaftaran` int(10) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `jam_daftar` time NOT NULL,
  `id_stsbyr` tinyint(2) NOT NULL,
  `id_metode` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran_seminar`
--

INSERT INTO `pendaftaran_seminar` (`id_pendaftaran`, `id_seminar`, `id_mahasiswa`, `tgl_daftar`, `jam_daftar`, `id_stsbyr`, `id_metode`) VALUES
(204, 4, 169, '2024-06-14', '08:12:28', 1, 1),
(206, 3, 169, '2024-06-14', '20:13:00', 1, 1),
(210, 4, 173, '2024-06-14', '20:13:45', 1, 1),
(213, 4, 177, '2024-06-14', '20:13:45', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi_seminar`
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
-- Dumping data untuk tabel `presensi_seminar`
--

INSERT INTO `presensi_seminar` (`id_presensi`, `id_mahasiswa`, `nomor_induk`, `id_seminar`, `tgl_khd`, `jam_khd`, `id_stskhd`) VALUES
(100, 169, 12220107, 3, '2024-06-14', '20:16:13', 2),
(101, 177, 12220097, 4, '2024-06-14', '20:16:50', 2),
(102, 169, 12220107, 4, '2024-06-14', '20:17:07', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` tinyint(2) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `kode_prodi` varchar(3) NOT NULL,
  `nama_prodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_fakultas`, `kode_prodi`, `nama_prodi`) VALUES
(1, 1, 'SI', 'Sistem Infomasi'),
(2, 1, 'IF', 'Informatika'),
(3, 1, 'SD', 'Sains Data'),
(4, 2, 'MJN', 'Manajemen'),
(5, 2, 'BD', 'Bisnis Digital');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seminar`
--

CREATE TABLE `seminar` (
  `id_seminar` int(3) NOT NULL,
  `nama_seminar` varchar(50) NOT NULL,
  `tgl_pelaksana` date NOT NULL,
  `lampiran` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seminar`
--

INSERT INTO `seminar` (`id_seminar`, `nama_seminar`, `tgl_pelaksana`, `lampiran`) VALUES
(3, 'How To Build Enterprise Arsitechture', '2024-07-10', '35df26df19ce5a4a6911e1e2af4357af.jpg'),
(4, 'Mastering the art of copywriting', '2024-07-31', '5298c246a085775e215020733e1bd1c2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sponsor`
--

CREATE TABLE `sponsor` (
  `id_sponsor` tinyint(3) NOT NULL,
  `nama_sponsor` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sponsor`
--

INSERT INTO `sponsor` (`id_sponsor`, `nama_sponsor`, `gambar`, `id_seminar`) VALUES
(8, 'Teh botol sosro', 'f77f72030d9b8bc4460a70a6741790ad.jpg', 3),
(9, 'Nutragen', '29625b88acc99c9a8a3b74b44c0c338c.jpg', 3),
(10, 'Binary Indonesia', '861dda7fd02729eda0b36350337c4b50.jpg', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_kehadiran`
--

CREATE TABLE `status_kehadiran` (
  `id_stskhd` tinyint(1) NOT NULL,
  `nama_stskhd` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_kehadiran`
--

INSERT INTO `status_kehadiran` (`id_stskhd`, `nama_stskhd`) VALUES
(1, 'Tidak Hadir'),
(2, 'Hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `id_stsbyr` tinyint(2) NOT NULL,
  `nama_stsbyr` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_pembayaran`
--

INSERT INTO `status_pembayaran` (`id_stsbyr`, `nama_stsbyr`) VALUES
(2, 'Belum Lunas'),
(1, 'Sudah Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` tinyint(3) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `harga_tiket` bigint(15) NOT NULL,
  `slot_tiket` int(5) NOT NULL,
  `lampiran_tiket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_seminar`, `harga_tiket`, `slot_tiket`, `lampiran_tiket`) VALUES
(6, 3, 50000, 200, ''),
(7, 4, 30000, 300, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
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
  `active` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$giwLENK.4vMKdf.dtpHcCufVWQsr1AJ/1Gw/E5IHml0eqol0yM..6', 'sistemmanajemenseminar@gmail.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1718366550, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id_jenjang`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_prodi` (`id_fakultas`,`id_prodi`,`id_jenjang`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `pembicara`
--
ALTER TABLE `pembicara`
  ADD PRIMARY KEY (`id_pembicara`),
  ADD KEY `id_seminar` (`id_seminar`);

--
-- Indeks untuk tabel `pendaftaran_seminar`
--
ALTER TABLE `pendaftaran_seminar`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_seminar` (`id_seminar`,`id_mahasiswa`,`id_stsbyr`,`id_metode`);

--
-- Indeks untuk tabel `presensi_seminar`
--
ALTER TABLE `presensi_seminar`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `id_mahasiswa` (`id_stskhd`),
  ADD KEY `id_seminar` (`id_seminar`),
  ADD KEY `id_mahasiswa_2` (`id_mahasiswa`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indeks untuk tabel `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`id_seminar`);

--
-- Indeks untuk tabel `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id_sponsor`),
  ADD KEY `id_seminar` (`id_seminar`);

--
-- Indeks untuk tabel `status_kehadiran`
--
ALTER TABLE `status_kehadiran`
  ADD PRIMARY KEY (`id_stskhd`);

--
-- Indeks untuk tabel `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`id_stsbyr`),
  ADD KEY `nama_stsbyr` (`nama_stsbyr`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_seminar` (`id_seminar`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id_jenjang` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pembicara`
--
ALTER TABLE `pembicara`
  MODIFY `id_pembicara` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran_seminar`
--
ALTER TABLE `pendaftaran_seminar`
  MODIFY `id_pendaftaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT untuk tabel `presensi_seminar`
--
ALTER TABLE `presensi_seminar`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id_seminar` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id_sponsor` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `status_kehadiran`
--
ALTER TABLE `status_kehadiran`
  MODIFY `id_stskhd` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  MODIFY `id_stsbyr` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
