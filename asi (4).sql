-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2026 at 09:48 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bayi`
--

CREATE TABLE `bayi` (
  `id_bayi` int(11) NOT NULL,
  `nm_bayi` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `id_ibu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayi`
--

INSERT INTO `bayi` (`id_bayi`, `nm_bayi`, `tanggal_lahir`, `jenis_kelamin`, `id_ibu`) VALUES
(3001, 'kain', '2007-07-06', 'Perempuan', 1001),
(3002, 'habel', '2006-07-07', 'Laki-laki', 1002),
(3003, 'frans fries', '2008-12-12', 'Laki-laki', 1003),
(3004, 'dini', '2008-07-06', 'Perempuan', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemantauan_berat_badan`
--

CREATE TABLE `detail_pemantauan_berat_badan` (
  `id_detail` int(11) NOT NULL,
  `id_pemantauan` int(11) NOT NULL,
  `tanggal_pantau` date NOT NULL,
  `berat_badan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pemantauan_berat_badan`
--

INSERT INTO `detail_pemantauan_berat_badan` (`id_detail`, `id_pemantauan`, `tanggal_pantau`, `berat_badan`) VALUES
(3, 6001, '2007-03-17', '3.5 kg'),
(4, 6001, '2008-03-31', '4 kg'),
(10, 6003, '2009-02-12', '5 kg'),
(11, 6003, '2009-03-12', '4.5 kg'),
(12, 6002, '2008-03-12', '6.5 kg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemberian_asi`
--

CREATE TABLE `detail_pemberian_asi` (
  `id_detail` int(11) NOT NULL,
  `id_asi` int(11) NOT NULL,
  `tanggal_pengisian` date NOT NULL,
  `jumlah_pemberian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pemberian_asi`
--

INSERT INTO `detail_pemberian_asi` (`id_detail`, `id_asi`, `tanggal_pengisian`, `jumlah_pemberian`) VALUES
(18, 4003, '2009-02-12', '6x pemberian'),
(21, 4002, '2008-10-12', '7x pemberian'),
(22, 4002, '2008-11-12', '5x pemberian'),
(26, 4001, '2007-09-21', '8X pemberian'),
(27, 4001, '2007-10-21', '5x pemberian');

-- --------------------------------------------------------

--
-- Table structure for table `ibu`
--

CREATE TABLE `ibu` (
  `id_ibu` int(11) NOT NULL,
  `nm_ibu` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `nohp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ibu`
--

INSERT INTO `ibu` (`id_ibu`, `nm_ibu`, `alamat`, `nohp`) VALUES
(1001, 'redia tjan', 'kampung keramat', '0857598260955'),
(1002, 'kau kenal veronica ko', 'tepikong semabung', '0895328636751'),
(1003, 'meiriana', 'tepikong semabung lama', '081123145432');

-- --------------------------------------------------------

--
-- Table structure for table `pemantauan_berat_badan`
--

CREATE TABLE `pemantauan_berat_badan` (
  `id_pemantauan` int(11) NOT NULL,
  `id_bayi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemantauan_berat_badan`
--

INSERT INTO `pemantauan_berat_badan` (`id_pemantauan`, `id_bayi`) VALUES
(6002, 3001),
(6001, 3002),
(6003, 3003);

-- --------------------------------------------------------

--
-- Table structure for table `pemberian_asi`
--

CREATE TABLE `pemberian_asi` (
  `id_asi` int(11) NOT NULL,
  `id_bayi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemberian_asi`
--

INSERT INTO `pemberian_asi` (`id_asi`, `id_bayi`) VALUES
(4002, 3001),
(4001, 3002),
(4003, 3003);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` enum('admin','ibu') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', '12345', 'admin'),
(2, '1001', '11111111', 'ibu'),
(4, '1002', '22222222', 'ibu'),
(5, '1003', '1234', 'ibu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bayi`
--
ALTER TABLE `bayi`
  ADD PRIMARY KEY (`id_bayi`),
  ADD KEY `id_ibu` (`id_ibu`);

--
-- Indexes for table `detail_pemantauan_berat_badan`
--
ALTER TABLE `detail_pemantauan_berat_badan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `detail_pemberian_asi`
--
ALTER TABLE `detail_pemberian_asi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `ibu`
--
ALTER TABLE `ibu`
  ADD PRIMARY KEY (`id_ibu`);

--
-- Indexes for table `pemantauan_berat_badan`
--
ALTER TABLE `pemantauan_berat_badan`
  ADD PRIMARY KEY (`id_pemantauan`),
  ADD KEY `id_bayi` (`id_bayi`);

--
-- Indexes for table `pemberian_asi`
--
ALTER TABLE `pemberian_asi`
  ADD PRIMARY KEY (`id_asi`),
  ADD KEY `id_bayi` (`id_bayi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bayi`
--
ALTER TABLE `bayi`
  MODIFY `id_bayi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3005;

--
-- AUTO_INCREMENT for table `detail_pemantauan_berat_badan`
--
ALTER TABLE `detail_pemantauan_berat_badan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_pemberian_asi`
--
ALTER TABLE `detail_pemberian_asi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemantauan_berat_badan`
--
ALTER TABLE `pemantauan_berat_badan`
  ADD CONSTRAINT `pemantauan_berat_badan_ibfk_1` FOREIGN KEY (`id_bayi`) REFERENCES `bayi` (`id_bayi`);

--
-- Constraints for table `pemberian_asi`
--
ALTER TABLE `pemberian_asi`
  ADD CONSTRAINT `pemberian_asi_ibfk_1` FOREIGN KEY (`id_bayi`) REFERENCES `bayi` (`id_bayi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
