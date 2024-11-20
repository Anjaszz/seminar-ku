-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2014 pada 16.12
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `restoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_paket` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_paket`, `harga`, `jumlah`, `total_harga`) VALUES
(1, 1, 'P001', 35000, 2, 70000),
(2, 1, 'P001', 35000, 3, 105000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE IF NOT EXISTS `kasir` (
  `id_kasir` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_kasir` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kasir`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `username`, `password`, `nama_kasir`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Achmad');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_makanan`
--

CREATE TABLE IF NOT EXISTS `paket_makanan` (
  `id_paket` varchar(10) NOT NULL,
  `nama_paket` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_makanan`
--

INSERT INTO `paket_makanan` (`id_paket`, `nama_paket`, `keterangan`, `harga`) VALUES
('P001', 'Super Besar2', 'Ayam, Nasi', 35000),
('P002', 'Super Besar', 'Nasi, ayam, Pepsi', 25000),
('P003', 'Chiken Big', 'Ayam, Teh Manis', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_kasir` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_kasir`, `tanggal`) VALUES
(1, 2, '2014-01-13');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
