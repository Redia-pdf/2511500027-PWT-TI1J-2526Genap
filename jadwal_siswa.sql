-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2026 at 09:51 AM
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
-- Database: `jadwal_siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_jadwal`
--

CREATE TABLE `detail_jadwal` (
  `id_jadwal` int(11) DEFAULT NULL,
  `kd_mapel` varchar(20) DEFAULT NULL,
  `kd_guru` varchar(30) DEFAULT NULL,
  `hari` varchar(15) DEFAULT NULL,
  `jam_mulai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_jadwal`
--

INSERT INTO `detail_jadwal` (`id_jadwal`, `kd_mapel`, `kd_guru`, `hari`, `jam_mulai`) VALUES
(7001, 'M-001', 'G-001', 'Senin', '08.00-09.30'),
(7001, 'M-001', 'G-002', 'Selasa', '08.00-10.00');

-- --------------------------------------------------------

--
-- Table structure for table `ektrakurikuler`
--

CREATE TABLE `ektrakurikuler` (
  `kd_ekskul` varchar(5) NOT NULL,
  `nm_ekskul` varchar(40) NOT NULL,
  `pembimbing_1` varchar(100) NOT NULL,
  `pembimbing_2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ektrakurikuler`
--

INSERT INTO `ektrakurikuler` (`kd_ekskul`, `nm_ekskul`, `pembimbing_1`, `pembimbing_2`) VALUES
('E-002', 'renang', 'G-001', '-'),
('E-003', 'Marching Band', 'G-004', 'G-001'),
('E-004', 'Basket', 'G-005', 'G-002');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `kd_guru` varchar(5) NOT NULL,
  `nm_guru` varchar(50) NOT NULL,
  `jenkel` varchar(10) NOT NULL,
  `pend_terakhir` varchar(20) NOT NULL,
  `hp` varchar(13) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`kd_guru`, `nm_guru`, `jenkel`, `pend_terakhir`, `hp`, `alamat`) VALUES
('G-001', 'Burham Mahapati', 'Perempuan', 'S1 MB', '087042342423', 'Kampung Keramat'),
('G-002', 'Siti Hamidah', 'Perempuan', 'SI - SI', '088822321121', 'Semabung Lama'),
('G-003', 'delpiah', 'Perempuan', 'S1 - SI', '086735632544', 'uioytefgbhfbhfhf'),
('G-004', 'Imannuel ', 'Laki-laki', 'S1  - Pd', '085758260955', 'jl. Sudirman kelurahan Air Mawar'),
('G-005', 'Budiansyah rwar', 'Laki-laki', 'S1 M', '087754322345', 'pasir putih'),
('G-006', 'Feryn ', 'Perempuan', 'S1 BD', '085212344321', 'jl. surga pasti tetap');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kelas`
--

CREATE TABLE `jadwal_kelas` (
  `id_jadwal` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `thn_ajaran` varchar(20) NOT NULL,
  `semester` enum('ganjil','genap') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_kelas`
--

INSERT INTO `jadwal_kelas` (`id_jadwal`, `id_kelas`, `thn_ajaran`, `semester`) VALUES
(7001, 12002, '2023/2024', 'ganjil');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nm_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nm_kelas`) VALUES
(12002, 'IPA-1'),
(12003, 'IPA-2'),
(12004, 'IPS-2'),
(12005, 'IPS-1');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kd_mapel` varchar(5) NOT NULL,
  `nm_mapel` varchar(35) NOT NULL,
  `kkm` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nm_mapel`, `kkm`) VALUES
('M-001', 'Bahasa Indonesia', 75),
('M-002', 'Matematika', 70),
('M-003', 'Bahasa Inggris', 75),
('M-004', 'Pendidikan Pancasila', 75),
('M-005', 'Seni Budaya', 75),
('M-006', 'Pendidikan Jasmani (PENJASKES)', 75),
('M-007', 'Agama', 75);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(10) NOT NULL,
  `judul_pengumuman` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_guru` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul_pengumuman`, `deskripsi`, `tanggal`, `id_guru`) VALUES
(1001, 'KIAMAT SUDAH DEKAT !!', 'Bagi Bapak/Ibu guru dan para siswa yang saya kasihi... kiranya kita banyak banyak berdoa kepada tuhan yang maha esa.. .agar terhindar dari segala malapetaka.', '2012-12-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(10) NOT NULL,
  `nm_siswa` varchar(50) NOT NULL,
  `jenkel` varchar(10) NOT NULL,
  `hp` varchar(13) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nm_siswa`, `jenkel`, `hp`, `id_kelas`) VALUES
('S-004', 'Angel Supriantos', 'Perempuan', '087754322345', 12004),
('S-005', 'Jefri Nichol', 'Laki-laki', '085212344321', 12005),
('S-006', 'Cika Jericho', 'Perempuan', '088822321121', 12005),
('S-007', 'Redia Tjandring', 'Perempuan', '085758260955', 12004),
('S-008', 'Kai Tjandroe', 'Laki-laki', '087042342423', 12002),
('S-009', 'Angela timoti', 'Perempuan', '08704234242', 12002),
('S-010', 'Danu Anwar', 'Laki-laki', '088822321121', 12003),
('S-011', 'Anwar Sagala', 'Laki-laki', '895328636750', 12003);

-- --------------------------------------------------------

--
-- Table structure for table `skripsi_2511500027`
--

CREATE TABLE `skripsi_2511500027` (
  `id_skripsi_027` varchar(5) NOT NULL,
  `judul_skripsi_027` varchar(50) NOT NULL,
  `topik_skripsi_027` varchar(20) NOT NULL,
  `semester_027` varchar(20) NOT NULL,
  `thn_ajaran_027` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skripsi_2511500027`
--

INSERT INTO `skripsi_2511500027` (`id_skripsi_027`, `judul_skripsi_027`, `topik_skripsi_027`, `semester_027`, `thn_ajaran_027`) VALUES
('SK001', 'cara jadi Pak Prabowo Subianto', 'Politik', 'Ganjil', '2026/2027'),
('SK002', 'Hidup', 'cara hidup dan mati', 'Ganjil', '2022/2023'),
('SK003', 'kaka', 'kiki', 'Ganjil', '2022/2023'),
('SK004', 'ggbbfgfnhgg', 'tgfgfghf', 'Ganjil', '2022/2023');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', '12345', 'admin'),
(7, 'S-004', '12346', 'siswa'),
(9, 'S-005', '12347', 'siswa'),
(10, 'S-006', '12348', 'siswa'),
(17, 'G-001', '12346', 'guru'),
(18, 'G-002', '12345678', 'guru'),
(19, 'G-003', '87654321', 'guru'),
(20, 'G-004', '33333333', 'guru'),
(21, 'S-007', '44444444', 'siswa'),
(22, 'S-008', '1234', 'siswa'),
(23, 'S-009', '22222222', 'siswa'),
(24, 'S-010', '1234', 'siswa'),
(25, 'S-011', '1234', 'siswa'),
(26, 'G-005', '1234', 'guru'),
(27, 'G-006', '1234', 'guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `kd_mapel` (`kd_mapel`),
  ADD KEY `kd_guru` (`kd_guru`);

--
-- Indexes for table `ektrakurikuler`
--
ALTER TABLE `ektrakurikuler`
  ADD PRIMARY KEY (`kd_ekskul`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`kd_guru`);

--
-- Indexes for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD PRIMARY KEY (`id_jadwal`) USING BTREE;

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `skripsi_2511500027`
--
ALTER TABLE `skripsi_2511500027`
  ADD PRIMARY KEY (`id_skripsi_027`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  ADD CONSTRAINT `detail_jadwal_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_kelas` (`id_jadwal`),
  ADD CONSTRAINT `detail_jadwal_ibfk_2` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`),
  ADD CONSTRAINT `detail_jadwal_ibfk_3` FOREIGN KEY (`kd_guru`) REFERENCES `guru` (`kd_guru`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
