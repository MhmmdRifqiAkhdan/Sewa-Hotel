-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2022 at 05:06 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewahotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `nama_admin` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(5, 'denny', 'denny123', '34814f45c5b89ee4ea7e77662747a0e6');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(5) NOT NULL,
  `id_tipe` int(5) NOT NULL,
  `nama_kamar` varchar(35) NOT NULL,
  `no_kamar` int(5) NOT NULL,
  `tipe_kasur` enum('Single Bed','Twin Bed','Double Bed') NOT NULL,
  `lokasi` enum('Lantai 1','Lantai 2','Lantai 3') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tgl_input` date NOT NULL,
  `harga_kamar` int(20) NOT NULL,
  `status_kamar` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_tipe`, `nama_kamar`, `no_kamar`, `tipe_kasur`, `lokasi`, `gambar`, `tgl_input`, `harga_kamar`, `status_kamar`) VALUES
(1, 1, 'Adipati', 101, 'Single Bed', 'Lantai 1', 'gambar1544332691.jpg', '2022-10-06', 400000, '1'),
(2, 3, 'Kanjeng', 301, 'Double Bed', 'Lantai 3', 'gambar1544332354.jpg', '2022-10-06', 1000000, '0'),
(6, 2, 'Raden', 201, 'Twin Bed', 'Lantai 2', 'gambar1544514756.jpg', '2022-10-06', 700000, '1'),
(5, 3, 'Kanjeng', 302, 'Double Bed', 'Lantai 3', 'gambar1544363768.jpg', '2022-10-06', 1000000, '0'),
(7, 2, 'Patih', 303, 'Twin Bed', 'Lantai 3', 'gambar1544529342.jpg', '2022-10-06', 800000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(5) NOT NULL,
  `nama_pelanggan` varchar(45) NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `gender`, `no_telp`, `alamat`, `email`, `password`) VALUES
(17, 'Denny', 'Laki-Laki', '08754301234', 'Kalideres', 'dennycaknan@gmail.com', '202cb962ac59075b964b07152d234b70'),
(16, 'Rifqi', 'Laki-Laki', '085643278', 'Tanah Seratus', 'rifqiajah@gmail.com', '202cb962ac59075b964b07152d234b70'),
(15, 'Rahmat', 'Laki-Laki', '0898765432', 'Tangerang', 'rahmatzain@gmail.com', '202cb962ac59075b964b07152d234b70'),
(14, 'Bagas', 'Laki-Laki', '0888812344', 'Poris', 'bagasss@gmail.com', '202cb962ac59075b964b07152d234b70'),
(13, 'Agung', 'Laki-Laki', '0812345678', 'Ciledug', 'agungnp@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_sewa` int(5) NOT NULL,
  `tgl_sewa` datetime NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `tgl_cekin` date NOT NULL,
  `tgl_cekout` date NOT NULL,
  `total_extend` double NOT NULL DEFAULT 0,
  `status_bayar` enum('0','1') DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipekamar`
--

CREATE TABLE `tipekamar` (
  `id_tipe` int(5) NOT NULL,
  `tipe_kamar` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipekamar`
--

INSERT INTO `tipekamar` (`id_tipe`, `tipe_kamar`) VALUES
(1, 'Standar'),
(2, 'Deluxe'),
(3, 'Premium Suite');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_sewa` int(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `id_pelanggan` int(4) NOT NULL,
  `id_kamar` int(4) NOT NULL,
  `tgl_cekin` date NOT NULL,
  `tgl_cekout` date NOT NULL,
  `extend` double NOT NULL,
  `tgl_extend` date NOT NULL,
  `total_extend` double NOT NULL,
  `status_penyewaan` varchar(15) NOT NULL,
  `status_pembayaran` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_sewa`, `tgl_bayar`, `id_pelanggan`, `id_kamar`, `tgl_cekin`, `tgl_cekout`, `extend`, `tgl_extend`, `total_extend`, `status_penyewaan`, `status_pembayaran`) VALUES
(23, '2022-10-06 04:49:13', 17, 1, '2022-10-01', '2022-10-02', 400000, '2022-10-02', 400000, '1', '1'),
(24, '2022-10-06 04:49:59', 14, 7, '2022-10-08', '2022-10-09', 800000, '2022-10-09', 800000, '1', '1'),
(25, '2022-10-06 04:50:31', 16, 2, '2022-10-04', '2022-10-05', 1000000, '2022-10-05', 1000000, '1', '1'),
(26, '2022-10-06 04:50:54', 15, 6, '2022-10-14', '2022-10-15', 700000, '2022-10-15', 700000, '1', '1'),
(28, '2022-10-06 05:01:56', 13, 2, '2022-10-21', '2022-10-22', 1000000, '0000-00-00', 0, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indexes for table `tipekamar`
--
ALTER TABLE `tipekamar`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_sewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_sewa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tipekamar`
--
ALTER TABLE `tipekamar`
  MODIFY `id_tipe` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
