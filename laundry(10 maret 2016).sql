-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2016 at 05:25 
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
('ALL', 'Campuran'),
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
-- Table structure for table `list_cucian`
--

CREATE TABLE `list_cucian` (
  `id` int(11) NOT NULL,
  `kode_resi` varchar(20) NOT NULL,
  `kode_barang` varchar(3) NOT NULL,
  `kode_layanan` varchar(3) NOT NULL,
  `kode_jenis` varchar(3) NOT NULL,
  `kode_ukuran` varchar(5) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_cucian`
--

INSERT INTO `list_cucian` (`id`, `kode_resi`, `kode_barang`, `kode_layanan`, `kode_jenis`, `kode_ukuran`, `qty`, `harga`) VALUES
(8, '228864656', 'ALL', 'CBS', 'KLN', 'ALL', 1, 7000);

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
('RGR', 'Reguler', 3, '0');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `kode_resi` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `tanggal_daftar` varchar(50) DEFAULT NULL,
  `tanggal_ambil` varchar(50) DEFAULT NULL,
  `kode_pengiriman` varchar(3) NOT NULL,
  `kode_paket` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `no_telepon`, `alamat`, `kode_resi`, `status`, `tanggal_daftar`, `tanggal_ambil`, `kode_pengiriman`, `kode_paket`) VALUES
(8, 'Abimanyu', '089671907680', 'Jalan condet batu ampar', '228864656', 'PND', '03/09/2016 11:22:56', '03/10/2016 11:19:24', 'AJT', 'ISW');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `kode_resi` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `user_bayar` int(11) NOT NULL,
  `tanggal_bayar` varchar(50) DEFAULT NULL,
  `uang_kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `kode_resi`, `nama_pelanggan`, `harga_total`, `user_bayar`, `tanggal_bayar`, `uang_kembali`) VALUES
(8, '228864656', 'Abimanyu', 14000, 15000, '03/10/2016 11:19:24', 1000);

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
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `namaperusahaan` varchar(15) NOT NULL,
  `notelepon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `namaperusahaan`, `notelepon`, `email`, `alamat`, `deskripsi`) VALUES
(1, 'MM - Laundry', '021998722', 'laundryapp@gmail.com', 'jalan panca warga no 2132132', 'adfdasf');

-- --------------------------------------------------------

--
-- Table structure for table `rakit_harga`
--

CREATE TABLE `rakit_harga` (
  `kode_rakit` varchar(10) NOT NULL,
  `kode_layanan` varchar(3) NOT NULL,
  `kode_jenis` varchar(3) NOT NULL,
  `kode_barang` varchar(3) NOT NULL,
  `kode_ukuran` varchar(3) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rakit_harga`
--

INSERT INTO `rakit_harga` (`kode_rakit`, `kode_layanan`, `kode_jenis`, `kode_barang`, `kode_ukuran`, `harga`) VALUES
('CBS-001', 'CBS', 'KLN', 'ALL', 'ALL', '7000'),
('CBS-002', 'CBS', 'STN', 'MKM', 'BSR', '6000'),
('CKS-001', 'CKS', 'KLN', 'ALL', 'ALL', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `status_data`
--

CREATE TABLE `status_data` (
  `kode_status` varchar(3) NOT NULL,
  `nama_status` varchar(20) NOT NULL,
  `default_input` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_data`
--

INSERT INTO `status_data` (`kode_status`, `nama_status`, `default_input`) VALUES
('PND', 'Pending', 'yes'),
('PRS', 'Proses', 'no'),
('SLS', 'Selesai', 'no');

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
('KG', 'Kilogram'),
('PCS', 'Item');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran_benda`
--

CREATE TABLE `ukuran_benda` (
  `kode_ukuran` varchar(5) NOT NULL,
  `nama_ukuran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukuran_benda`
--

INSERT INTO `ukuran_benda` (`kode_ukuran`, `nama_ukuran`) VALUES
('ALL', 'Semua Ukuran'),
('BSR', 'Besar'),
('KCL', 'Kecil');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `password_word` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tentang` text,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `namalengkap`, `username`, `password`, `password_word`, `email`, `tentang`, `status`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin123', 'admin@webmaster.com', 'Developer cool', 'admin'),
(2, 'Operator', 'operator1', '2407bd807d6ca01d1bcd766c730cec9a', 'operator123', '', '', 'OP'),
(3, 'Kasir', 'kasir1', 'de28f8f7998f23ab4194b51a6029416f', 'kasir123', '', '', 'KS'),
(4, 'Pencuci', 'pencuci1', '3037287e74b0cf365f6782d3d8be99d3', 'pencuci123', '', '', 'PC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kode_kategori` (`kode_kategori`);

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
-- Indexes for table `list_cucian`
--
ALTER TABLE `list_cucian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_layanan` (`kode_layanan`),
  ADD KEY `kode_jenis` (`kode_jenis`),
  ADD KEY `kode_ukuran` (`kode_ukuran`);

--
-- Indexes for table `paket_kerja`
--
ALTER TABLE `paket_kerja`
  ADD PRIMARY KEY (`kode_paket`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`kode_pengiriman`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rakit_harga`
--
ALTER TABLE `rakit_harga`
  ADD PRIMARY KEY (`kode_rakit`),
  ADD KEY `kode_layanan` (`kode_layanan`),
  ADD KEY `kode_jenis` (`kode_jenis`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_ukuran` (`kode_ukuran`);

--
-- Indexes for table `status_data`
--
ALTER TABLE `status_data`
  ADD PRIMARY KEY (`kode_status`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`kode_ukuran`);

--
-- Indexes for table `ukuran_benda`
--
ALTER TABLE `ukuran_benda`
  ADD PRIMARY KEY (`kode_ukuran`),
  ADD KEY `kode_ukuran` (`kode_ukuran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_cucian`
--
ALTER TABLE `list_cucian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori_barang` (`kode_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jenis_cucian`
--
ALTER TABLE `jenis_cucian`
  ADD CONSTRAINT `jenis_cucian_ibfk_1` FOREIGN KEY (`kode_ukuran`) REFERENCES `ukuran` (`kode_ukuran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `list_cucian`
--
ALTER TABLE `list_cucian`
  ADD CONSTRAINT `list_cucian_ibfk_1` FOREIGN KEY (`kode_ukuran`) REFERENCES `ukuran_benda` (`kode_ukuran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `list_cucian_ibfk_2` FOREIGN KEY (`kode_jenis`) REFERENCES `jenis_cucian` (`kode_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `list_cucian_ibfk_3` FOREIGN KEY (`kode_layanan`) REFERENCES `layanan` (`kode_layanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `list_cucian_ibfk_4` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status_data` (`kode_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rakit_harga`
--
ALTER TABLE `rakit_harga`
  ADD CONSTRAINT `rakit_harga_ibfk_1` FOREIGN KEY (`kode_layanan`) REFERENCES `layanan` (`kode_layanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rakit_harga_ibfk_2` FOREIGN KEY (`kode_jenis`) REFERENCES `jenis_cucian` (`kode_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rakit_harga_ibfk_4` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rakit_harga_ibfk_5` FOREIGN KEY (`kode_ukuran`) REFERENCES `ukuran_benda` (`kode_ukuran`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
