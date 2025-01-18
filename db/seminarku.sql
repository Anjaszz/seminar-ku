-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2025 at 01:27 PM
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
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id_bank` int(8) NOT NULL,
  `nama_bank` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id_bank`, `nama_bank`) VALUES
(1, 'BCA'),
(2, 'MANDIRI'),
(3, 'BNI'),
(4, 'BRI'),
(5, 'PERMATA BANK'),
(6, 'UOB');

-- --------------------------------------------------------

--
-- Table structure for table `chat_komunitas`
--

CREATE TABLE `chat_komunitas` (
  `id_chat` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `id_seminar` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `pesan` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `tipe_file` enum('text','image','document') DEFAULT 'text',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_komunitas`
--

INSERT INTO `chat_komunitas` (`id_chat`, `id_vendor`, `id_seminar`, `id_mahasiswa`, `pesan`, `file_path`, `tipe_file`, `created_at`) VALUES
(1, 1, 14, 42, 'hiii', NULL, 'text', '2025-01-12 20:34:39'),
(2, 1, 14, 42, 'gimana kabar', NULL, 'text', '2025-01-12 20:36:55'),
(3, 1, 14, 42, 'hj', NULL, 'text', '2025-01-13 07:07:43'),
(4, 1, 14, 42, 'we', NULL, 'text', '2025-01-13 07:13:58'),
(5, 1, 14, 42, 'sdss', NULL, 'text', '2025-01-13 07:16:36'),
(6, 1, 14, 42, 'kau', NULL, 'text', '2025-01-14 22:34:12'),
(7, 1, 14, 46, 'jkllkl', NULL, 'text', '2025-01-15 13:46:34'),
(8, 1, 14, 42, 'Ffhy', NULL, 'text', '2025-01-15 13:48:18'),
(9, 1, 14, 42, 'woy', NULL, 'text', '2025-01-15 16:35:57'),
(10, 1, 14, 42, 'minta no hp nya dong\r\n', NULL, 'text', '2025-01-15 17:00:13'),
(11, 1, 14, 42, 'kintil', NULL, 'text', '2025-01-15 17:04:26'),
(12, 1, 14, 46, 'lagi apa bang\r\n', NULL, 'text', '2025-01-15 17:04:55'),
(13, 1, 14, 42, 'iya', NULL, 'text', '2025-01-15 20:48:13'),
(14, 1, 16, 42, 'hiiiuj', NULL, 'text', '2025-01-15 21:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` tinyint(2) NOT NULL,
  `kode_fakultas` varchar(4) NOT NULL,
  `nama_fakultas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `kode_fakultas`, `nama_fakultas`) VALUES
(1, 'SD', 'Sekolah Dasar'),
(2, 'SMP', 'Sekolah Menengah Pertama'),
(3, 'SMA', 'Sekolah Menengah Akhir'),
(4, 'S1', 'Strata 1'),
(5, 'Umum', 'Umum');

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
  `id_admin` int(11) NOT NULL,
  `id_seminar` int(11) NOT NULL,
  `nama_seminar` varchar(255) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `tanggal_pelaksanaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_seminar`
--

INSERT INTO `history_seminar` (`id_history`, `id_admin`, `id_seminar`, `nama_seminar`, `id_mahasiswa`, `nama_mahasiswa`, `tanggal_pelaksanaan`) VALUES
(44, 0, 17, 'seminar onlin', 46, 'kurni', '2025-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_seminar`
--

CREATE TABLE `jenis_seminar` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_seminar`
--

INSERT INTO `jenis_seminar` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Online'),
(2, 'Offline');

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
-- Table structure for table `kategori_seminar`
--

CREATE TABLE `kategori_seminar` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_seminar`
--

INSERT INTO `kategori_seminar` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Teknologi'),
(2, 'Pendidikan'),
(3, 'Politik'),
(4, 'Kesehatan'),
(5, 'Bisnis'),
(6, 'Keuangan'),
(7, 'Hukum'),
(8, 'Seni dan Budaya'),
(9, 'Lingkungan'),
(10, 'Psikologi'),
(11, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `komunitas`
--

CREATE TABLE `komunitas` (
  `id` int(11) NOT NULL,
  `id_seminar` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id`, `id_seminar`, `id_mahasiswa`, `id_vendor`) VALUES
(3, 14, 42, 1),
(4, 14, 46, 1),
(6, 16, 42, 1);

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
-- Table structure for table `lokasi_seminar`
--

CREATE TABLE `lokasi_seminar` (
  `id_lokasi` int(11) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_seminar`
--

INSERT INTO `lokasi_seminar` (`id_lokasi`, `nama_provinsi`) VALUES
(1, 'Aceh'),
(2, 'Bali'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'DI Yogyakarta'),
(6, 'DKI Jakarta'),
(7, 'Gorontalo'),
(8, 'Jambi'),
(9, 'Jawa Barat'),
(10, 'Jawa Tengah'),
(11, 'Jawa Timur'),
(12, 'Kalimantan Barat'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Timur'),
(16, 'Kalimantan Utara'),
(17, 'Kepulauan Bangka Belitung'),
(18, 'Kepulauan Riau'),
(19, 'Lampung'),
(20, 'Maluku'),
(21, 'Maluku Utara'),
(22, 'Nusa Tenggara Barat'),
(23, 'Nusa Tenggara Timur'),
(24, 'Papua'),
(25, 'Papua Barat'),
(26, 'Papua Pegunungan'),
(27, 'Papua Selatan'),
(28, 'Papua Tengah'),
(29, 'Riau'),
(30, 'Sulawesi Barat'),
(31, 'Sulawesi Selatan'),
(32, 'Sulawesi Tengah'),
(33, 'Sulawesi Tenggara'),
(34, 'Sulawesi Utara'),
(35, 'Sumatera Barat'),
(36, 'Sumatera Selatan'),
(37, 'Sumatera Utara'),
(38, 'Online Zoom');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nim` int(8) NOT NULL,
  `foto` varchar(266) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `id_fakultas` tinyint(2) NOT NULL,
  `id_prodi` tinyint(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `tanggal_lahir` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `id_admin`, `nim`, `foto`, `nama_mhs`, `id_fakultas`, `id_prodi`, `email`, `no_telp`, `tanggal_lahir`) VALUES
(39, 0, 2412001, '', 'Ridwa', 3, 9, 'y@gmail.com', '081295101633', 2025),
(40, 0, 2412002, '', 'Ridwan Saputra', 3, 8, 'testing@gmail.com', '0845457557576', 20),
(41, 0, 2412003, '', 'Ridwan', 4, 19, 'testing1@gmail.com', '0845457557576', 30),
(42, 0, 2412004, 'tes.png', 'user', 1, 2, 'user@gmail.com', '090099990099', 22),
(43, 0, 2501001, '', 'opopo', 3, 11, 'opopo@gmail.com', '888888888888', 2025),
(44, 0, 2501002, '', 'pukul', 4, 22, 'pukul@gmail.com', '777777777777', 2025),
(45, 0, 2501003, '', 'hamid', 4, 19, 'hamid@gmail.com', '88888888888_', 2025),
(46, 0, 2501004, '', 'kurni', 2, 5, 'kurni@gmail.com', '2122212121212', 21),
(47, 0, 2501005, '', 'mansur', 2, 5, 'mansur@gmail.com', '081295101633', 22),
(48, 0, 2501006, '', 'mansurs', 3, 5, 'mansur1@gmail.com', '081295101633', 22),
(49, 0, 2501007, '', 'kurnie', 1, 2, 'kurnie@gmail.com', '2122212121212', 21),
(50, 0, 2501008, '', 'maskur', 1, 2, 'maskur@gmail.com', '081388481245', 20),
(51, 0, 2501009, '', 'maskur', 1, 2, 'maskur1@gmail.com', '081388481245', 20),
(52, 0, 2501010, '', 'maskur', 1, 2, 'maskur2@gmail.com', '081388481245', 22),
(53, 0, 2501011, '', 'maskur', 2, 3, 'masku6r2@gmail.com', '081388481245', 22),
(54, 0, 2501012, '', 'maskur', 2, 3, 'masku6r62@gmail.com', '081388481245', 22),
(55, 0, 2501013, '', 'maskur', 3, 7, 'mask1u6r62@gmail.com', '081388481245', 22);

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
  `id_vendor` int(11) NOT NULL,
  `nama_pembicara` varchar(150) NOT NULL,
  `latar_belakang` varchar(100) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembicara`
--

INSERT INTO `pembicara` (`id_pembicara`, `id_vendor`, `nama_pembicara`, `latar_belakang`, `id_seminar`, `foto`) VALUES
(13, 1, 'khania Saputri S.T, M.T', 'Co founder', 3, '5b79623d771e51631a0baea7eba9178e.jpg'),
(14, 0, 'Rayhan dava', 'founder', 4, '82e5c14b19f6d209be54848f44cc42fd.jpg'),
(15, 1, 'jhhhhjjhjhjh', 'jkkkj', 14, '1df9dcfed2c8c662f402f6618b25959f.png'),
(16, 0, 'kjkjkjkj', 'jkkkjkj', 14, 'dabcf774d9d26cdc369ba2873ddadded.png');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_seminar`
--

CREATE TABLE `pendaftaran_seminar` (
  `id_pendaftaran` int(10) NOT NULL,
  `id_vendor` int(11) NOT NULL,
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
  `id_admin` int(11) NOT NULL,
  `nomor_induk` int(15) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `tgl_khd` date NOT NULL,
  `jam_khd` time NOT NULL,
  `id_stskhd` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi_seminar`
--

INSERT INTO `presensi_seminar` (`id_presensi`, `id_mahasiswa`, `id_admin`, `nomor_induk`, `id_seminar`, `tgl_khd`, `jam_khd`, `id_stskhd`) VALUES
(157, 46, 0, 2501004, 17, '2025-01-18', '04:02:26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `kode_prodi` varchar(4) NOT NULL,
  `nama_prodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_fakultas`, `kode_prodi`, `nama_prodi`) VALUES
(1, 5, 'UMUM', 'UMUM'),
(2, 1, 'SD', 'Sekolah Dasar'),
(3, 2, 'SMP', 'Sekolah Menengah Pertama'),
(4, 3, 'SMA', 'IPS'),
(5, 3, 'SMA', 'Bahasa'),
(6, 3, 'SMA', 'Agama'),
(7, 3, 'SMA', 'Seni dan Budaya'),
(8, 3, 'SMA', 'Teknologi Informasi dan Komuni'),
(9, 3, 'SMA', 'Olahraga'),
(10, 3, 'SMA', 'Pariwisata'),
(11, 3, 'SMA', 'Pendidikan Kewirausahaan'),
(12, 3, 'SMA', 'Kesehatan dan Keperawatan'),
(14, 4, 'S1', 'Teknik Informatika'),
(15, 4, 'S1', 'Sistem Informasi'),
(16, 4, 'S1', 'Ilmu Komputer'),
(17, 4, 'S1', 'Teknik Elektro'),
(18, 4, 'S1', 'Teknik Sipil'),
(19, 4, 'S1', 'Teknik Mesin'),
(20, 4, 'S1', 'Teknik Industri'),
(21, 4, 'S1', 'Matematika'),
(22, 4, 'S1', 'Fisika'),
(23, 4, 'S1', 'Kimia'),
(24, 4, 'S1', 'Biologi'),
(25, 4, 'S1', 'Kedokteran'),
(26, 4, 'S1', 'Farmasi'),
(27, 4, 'S1', 'Keperawatan'),
(28, 4, 'S1', 'Hukum'),
(29, 4, 'S1', 'Ekonomi'),
(30, 4, 'S1', 'Manajemen'),
(31, 4, 'S1', 'Akuntansi'),
(32, 4, 'S1', 'Psikologi'),
(33, 4, 'S1', 'Ilmu Komunikasi'),
(34, 4, 'S1', 'Hubungan Internasional'),
(35, 4, 'S1', 'Sastra Inggris'),
(36, 4, 'S1', 'Sastra Indonesia'),
(37, 4, 'S1', 'Pendidikan Guru Sekolah Dasar'),
(38, 4, 'S1', 'Pendidikan Bahasa Inggris'),
(39, 4, 'S1', 'Pendidikan Matematika'),
(40, 4, 'S1', 'Ilmu Politik'),
(41, 4, 'S1', 'Sosiologi'),
(42, 4, 'S1', 'Antropologi');

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE `seminar` (
  `id_seminar` int(3) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `id_scan` int(3) NOT NULL,
  `nama_seminar` varchar(50) NOT NULL,
  `deskripsi` varchar(562) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `lokasi` varchar(260) NOT NULL,
  `tgl_pelaksana` datetime NOT NULL,
  `lampiran` varchar(64) NOT NULL,
  `link_seminar` varchar(255) NOT NULL,
  `sertifikat` varchar(258) NOT NULL,
  `file` varchar(258) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seminar`
--

INSERT INTO `seminar` (`id_seminar`, `id_jenis`, `id_vendor`, `id_kategori`, `id_fakultas`, `id_scan`, `nama_seminar`, `deskripsi`, `id_lokasi`, `lokasi`, `tgl_pelaksana`, `lampiran`, `link_seminar`, `sertifikat`, `file`) VALUES
(3, 0, 2, 3, 1, 0, 'How To Build Enterprise', 'dsfsfsdfs', 2, 'kjkjkkjjkkj', '2024-11-15 03:55:00', '35df26df19ce5a4a6911e1e2af4357af.jpg', '', 'sertifikat_1727833891.png', 'file_How_To_Build_Enterprise.sql'),
(4, 0, 0, 0, 0, 0, 'Mastering the art of copywriting', '', 0, '', '2024-10-31 08:00:00', '5298c246a085775e215020733e1bd1c2.jpg', '', '', 'file_Mastering_the_art_of_copywriting.zip'),
(8, 0, 0, 0, 0, 0, 'semianr bisnis digital', '', 0, '', '2025-02-25 08:00:00', 'a7fd84bf9361a0c2ede1824816d4e1c0.png', '', 'sertifikat_1729688502.jpg', 'file_semianr_bisnis_digital.zip'),
(9, 0, 0, 2, 3, 0, 'sda', 'dadasdasd', 11, 'dasdsa', '2024-11-23 22:22:00', '/uploads/poster/5cec8f803549197062b6a5929ae0af5c.jpg', '', '', ''),
(10, 0, 0, 3, 2, 0, 'dsds', 'sdada', 9, 'sasdsa', '2024-11-22 21:22:00', 'cbc73f295a7ba1478b5128a50be45ad4.jpg', '', '', ''),
(11, 0, 1, 4, 2, 0, 'dfdggd', 'hkkkkh', 7, 'dfddfdfdffd', '2024-11-29 08:08:00', '64794a39a1c6f74cad59b2625e34cc0b.jpg', '', '', ''),
(12, 0, 1, 3, 4, 0, 'khkjkj', 'hkhk', 12, 'hkhk', '2024-11-23 04:04:00', '48f27a01a8c46b497ef6fd2cfcf7698f.jpg', '', '', ''),
(13, 0, 0, 3, 3, 0, 'dasdasda', 'asfsa', 9, 'adasda', '2024-11-30 11:11:00', '', '', '', ''),
(14, 0, 1, 1, 3, 0, 'ppp', 'pp', 9, 'pp', '2024-11-29 08:08:00', 'cab63fd5e47cb2ce49ef89da16873d6b.jpg', '', '', ''),
(15, 0, 1, 1, 3, 0, 'kl', 'kk', 8, 'ds', '2024-11-30 11:11:00', '4bbf74aa397bdcb937c08f824fef1b64.jpg', '', '', ''),
(16, 1, 1, 3, 3, 0, 'testing chat', 'hhhjkhkhkhkhkhkhkhjjjh', 38, 'Seminar Online', '2025-01-16 10:03:00', 'c76c1699f16e04877a4f3d1ea37e5ed9.jpg', 'http://localhost/seminar-ku/seminar/add', '', ''),
(17, 1, 1, 3, 3, 1, 'seminar onlin', 'sdaasfasfasfdasfdfdd', 38, 'Seminar Online', '2025-01-17 11:11:00', '4fffbad783ac2e14c4a8d19baa86f037.jpg', 'http://localhost/seminar-ku/seminar/add', '', ''),
(18, 2, 1, 9, 2, 0, 'testing chat off', 'fdsdsafdsfd', 18, 'hhhkhkhkhk', '1111-11-22 12:22:00', 'b138c4725054e0a864dd9b29416c8c3d.png', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `id_sponsor` tinyint(3) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `nama_sponsor` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id_sponsor`, `id_vendor`, `nama_sponsor`, `gambar`, `id_seminar`) VALUES
(8, 1, 'Teh botol sosro', 'f77f72030d9b8bc4460a70a6741790ad.jpg', 14),
(9, 1, 'Nutragen', '29625b88acc99c9a8a3b74b44c0c338c.jpg', 3),
(10, 0, 'Binary Indonesia', '861dda7fd02729eda0b36350337c4b50.jpg', 4),
(12, 1, 'jkjkjkjkjjkjkjjkkjkj', 'ef3a7cacf28dcd3bdd7450aba131b984.png', 14);

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
  `id_vendor` int(11) NOT NULL,
  `id_seminar` tinyint(3) NOT NULL,
  `harga_tiket` bigint(15) NOT NULL,
  `slot_tiket` int(5) NOT NULL,
  `lampiran_tiket` varchar(100) NOT NULL,
  `tiket_terjual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_vendor`, `id_seminar`, `harga_tiket`, `slot_tiket`, `lampiran_tiket`, `tiket_terjual`) VALUES
(6, 0, 3, 50000, 200, '', 29),
(7, 2, 4, 30000, 300, '', 15),
(13, 1, 8, 55000, 200, '', 2),
(14, 0, 14, 0, 22, '', 1),
(15, 0, 12, 23333, 223, '', 0),
(16, 1, 16, 0, 666, '', 0),
(17, 1, 11, 0, 5, '', 0),
(18, 1, 17, 0, 77, '', 0),
(19, 1, 18, 28, 56, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_master`
--

CREATE TABLE `transaksi_master` (
  `id_transaksi` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jumlah_masuk` float NOT NULL,
  `jumlah_keluar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_master`
--

INSERT INTO `transaksi_master` (`id_transaksi`, `id_vendor`, `tgl_transaksi`, `jumlah_masuk`, `jumlah_keluar`) VALUES
(121, 3, '2024-12-24', 12000, 0),
(1222, 2, '2024-12-03', 23000, 0),
(6771, 37, '2024-12-30', 70000, 0),
(67706, 28, '2024-12-29', 50000, 0),
(677066, 1, '2024-12-29', 50000, 0),
(677070, 30, '2024-12-29', 50000, 0),
(677067974, 1, '2024-12-29', 50000, 0),
(2147483647, 31, '2024-12-29', 70000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_user`
--

CREATE TABLE `transaksi_user` (
  `id_transaksi` int(11) NOT NULL,
  `id_admin` int(28) NOT NULL,
  `id_seminar` int(10) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `jumlah` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_user`
--

INSERT INTO `transaksi_user` (`id_transaksi`, `id_admin`, `id_seminar`, `id_mahasiswa`, `tgl_transaksi`, `jumlah`) VALUES
(1, 1, 14, 37, '2024-11-28 17:20:40', 50000);

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
  `no_rekening` varchar(255) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `tgl_subs` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `active` int(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_vendor`, `nama_vendor`, `password`, `email`, `no_telp`, `no_rekening`, `id_bank`, `tgl_subs`, `tgl_berakhir`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `active`) VALUES
(1, 'Universitas Nusa Mandiri', '$2y$12$RsDIoS9EpYmBywqcvlYAsOYWc8AYGdpTJbNYf/eyWHVMY.VDg/uC6', 'sistemmanajemenseminar@gmail.com', 2147483, '123455', 1, '2024-12-27', '2024-12-28', NULL, '', NULL, NULL, NULL, NULL, NULL, 1);

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
  `id_admin` int(11) NOT NULL,
  `nim` varchar(36) NOT NULL,
  `foto` varchar(266) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(36) NOT NULL,
  `id_reset` int(36) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `expiry_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_mhs`
--

INSERT INTO `user_mhs` (`id_mahasiswa`, `id_admin`, `nim`, `foto`, `email`, `password`, `id_reset`, `reset_token`, `expiry_time`) VALUES
(1, 0, '12345678', '', 'Rid@g.com', 'be60d5acf94273e503e12944ba730d51', 1, NULL, NULL),
(39, 0, '2412001', '', 'y@gmail.com', '3d4f25a6c633a2122dc6aed0565ac0d0', 0, NULL, NULL),
(40, 0, '2412002', '', 'testing@gmail.com', 'ae2b1fca515949e5d54fb22b8ed95575', 0, NULL, NULL),
(41, 0, '2412003', '', 'testing1@gmail.com', '6b7330782b2feb4924020cc4a57782a9', 0, NULL, NULL),
(42, 0, '2412004', 'tes.png', 'user@gmail.com', '5a30c9609b52fe348fb6925896e061de', 0, NULL, NULL),
(45, 0, '2501003', '', 'hamid@gmail.com', 'ec2b3dfc15048614548fc885fd5a5838', 0, NULL, NULL),
(46, 0, '2501004', '', 'kurni@gmail.com', '52e41e24229040a08127ea523ea66f63', 0, NULL, NULL),
(47, 0, '2501005', '', 'mansur@gmail.com', '4f003caba1533568b048bd5511a7c4a8', 0, NULL, NULL),
(48, 0, '2501006', '', 'mansur1@gmail.com', '9311458354d09c269e0feb2d8167a6d9', 0, NULL, NULL),
(49, 0, '2501007', '', 'kurnie@gmail.com', '52e41e24229040a08127ea523ea66f63', 0, NULL, NULL),
(50, 0, '2501008', '', 'maskur@gmail.com', 'a62dc57257a68232e97d73a01738e777', 0, NULL, NULL),
(51, 0, '2501009', '', 'maskur1@gmail.com', 'a62dc57257a68232e97d73a01738e777', 0, NULL, NULL),
(52, 0, '2501010', '', 'maskur2@gmail.com', '5a30c9609b52fe348fb6925896e061de', 0, NULL, NULL),
(53, 0, '2501011', '', 'masku6r2@gmail.com', '5a30c9609b52fe348fb6925896e061de', 0, NULL, NULL),
(54, 0, '2501012', '', 'masku6r62@gmail.com', '9311458354d09c269e0feb2d8167a6d9', 0, NULL, NULL),
(55, 0, '2501013', '', 'mask1u6r62@gmail.com', '3ab9fc44676cd696802656874abe4dc4', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `chat_komunitas`
--
ALTER TABLE `chat_komunitas`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_seminar` (`id_seminar`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

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
-- Indexes for table `kategori_seminar`
--
ALTER TABLE `kategori_seminar`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_seminar`
--
ALTER TABLE `lokasi_seminar`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_prodi` (`id_fakultas`,`id_prodi`);

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
-- Indexes for table `transaksi_master`
--
ALTER TABLE `transaksi_master`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_user`
--
ALTER TABLE `transaksi_user`
  ADD PRIMARY KEY (`id_transaksi`);

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
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_komunitas`
--
ALTER TABLE `chat_komunitas`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_seminar`
--
ALTER TABLE `history_seminar`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id_jenjang` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_seminar`
--
ALTER TABLE `kategori_seminar`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lokasi_seminar`
--
ALTER TABLE `lokasi_seminar`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
  MODIFY `id_pembicara` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pendaftaran_seminar`
--
ALTER TABLE `pendaftaran_seminar`
  MODIFY `id_pendaftaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT for table `presensi_seminar`
--
ALTER TABLE `presensi_seminar`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id_seminar` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id_sponsor` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id_tiket` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaksi_master`
--
ALTER TABLE `transaksi_master`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `transaksi_user`
--
ALTER TABLE `transaksi_user`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_vendor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_komunitas`
--
ALTER TABLE `chat_komunitas`
  ADD CONSTRAINT `chat_komunitas_ibfk_1` FOREIGN KEY (`id_seminar`) REFERENCES `seminar` (`id_seminar`),
  ADD CONSTRAINT `chat_komunitas_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

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
