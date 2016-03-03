-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2016 at 03:55 
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(3) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kode_kategori` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `kode_kategori`) VALUES
('ALL', 'Random', 'ALL'),
('JAS', 'Jas', 'JAS'),
('MKM', 'Micky mouse', 'BNK');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cucian`
--

CREATE TABLE `jenis_cucian` (
  `kode_jenis` varchar(3) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `kode_ukuran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_cucian`
--

INSERT INTO `jenis_cucian` (`kode_jenis`, `nama_jenis`, `kode_ukuran`) VALUES
('KLN', 'Kiloan', 'KG'),
('STN', 'Satuan', 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `kode_kategori` varchar(3) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`kode_kategori`, `nama_kategori`) VALUES
('ALL', 'Semua Ukuran'),
('BNK', 'Boneka'),
('JAS', 'Jas'),
('TSH', 'T-Shirt');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `kode_layanan` varchar(3) NOT NULL,
  `nama_layanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`kode_layanan`, `nama_layanan`) VALUES
('CBS', 'Cuci Basah Sterika'),
('CKS', 'Cuci Kering Sterika'),
('SS', 'Sterika Saja');

-- --------------------------------------------------------

--
-- Table structure for table `paket_kerja`
--

CREATE TABLE `paket_kerja` (
  `kode_paket` varchar(3) NOT NULL,
  `nama_paket` varchar(20) NOT NULL,
  `waktu` int(10) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket_kerja`
--

INSERT INTO `paket_kerja` (`kode_paket`, `nama_paket`, `waktu`, `harga`) VALUES
('ISW', 'Istimewa', 1, '3000'),
('RGR', 'Reguler', 3, '2000');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `kode_pengiriman` varchar(3) NOT NULL,
  `nama_pengiriman` varchar(20) NOT NULL,
  `harga_kirim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`kode_pengiriman`, `nama_pengiriman`, `harga_kirim`) VALUES
('AJT', 'Antar Jemput', '4000'),
('ATR', 'Antar', '2000'),
('JPT', 'Jemput', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `rakit_harga`
--

CREATE TABLE `rakit_harga` (
  `kode_rakit` varchar(10) NOT NULL,
  `nama_layanan` varchar(20) NOT NULL,
  `jenis_cucian` varchar(50) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `ukuran_barang` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rakit_harga`
--

INSERT INTO `rakit_harga` (`kode_rakit`, `nama_layanan`, `jenis_cucian`, `nama_barang`, `ukuran_barang`, `harga`) VALUES
('CBS-001', 'CBS', 'KLN', 'ALL', 'ALL', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `kode_ukuran` varchar(5) NOT NULL,
  `nama_ukuran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`kode_ukuran`, `nama_ukuran`) VALUES
('ALL', 'Semua Ukuran'),
('KG', 'Kilogram'),
('PCS', 'Item');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tentang` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `namalengkap`, `username`, `password`, `email`, `tentang`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@webmaster.com', 'Developer cool');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `jenis_cucian`
--
ALTER TABLE `jenis_cucian`
  ADD PRIMARY KEY (`kode_jenis`),
  ADD KEY `kode_ukuran` (`kode_ukuran`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`kode_layanan`);

--
-- Indexes for table `paket_kerja`
--
ALTER TABLE `paket_kerja`
  ADD PRIMARY KEY (`kode_paket`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`kode_pengiriman`);

--
-- Indexes for table `rakit_harga`
--
ALTER TABLE `rakit_harga`
  ADD PRIMARY KEY (`kode_rakit`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`kode_ukuran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
