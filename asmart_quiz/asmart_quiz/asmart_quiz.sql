-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 07:15 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asmart_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nama_guru` varchar(60) DEFAULT NULL,
  `nokp_guru` varchar(12) NOT NULL,
  `katalaluan_guru` varchar(30) DEFAULT NULL,
  `tahap` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nama_guru`, `nokp_guru`, `katalaluan_guru`, `tahap`) VALUES
('amir', '123', '123', 'ADMIN'),
('nur zahra imani', '123123123122', '123', 'ADMIN'),
('amna insyirah', '123123123123', '123', 'GURU'),
('umar', '123123123199', '123', 'GURU');

-- --------------------------------------------------------

--
-- Table structure for table `jawapan_murid`
--

CREATE TABLE `jawapan_murid` (
  `id_jawapan` int(11) NOT NULL,
  `no_soalan` int(11) DEFAULT NULL,
  `jawapan` varchar(100) DEFAULT NULL,
  `catatan` varchar(100) DEFAULT NULL,
  `nokp_murid` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawapan_murid`
--

INSERT INTO `jawapan_murid` (`id_jawapan`, `no_soalan`, `jawapan`, `catatan`, `nokp_murid`) VALUES
(237, 20, 'jawapan_a', 'BETUL', '123'),
(238, 15, 'jawapan_a', 'BETUL', '123'),
(239, 16, 'jawapan_a', 'BETUL', '123'),
(240, 18, 'jawapan_b', 'SALAH', '123'),
(241, 37, 'tidak jawab', 'SALAH', '123'),
(242, 38, 'jawapan_d', 'SALAH', '123'),
(243, 39, 'jawapan_d', 'SALAH', '123'),
(244, 36, 'jawapan_d', 'SALAH', '123');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(3) NOT NULL,
  `ting` varchar(2) DEFAULT NULL,
  `nama_kelas` varchar(30) DEFAULT NULL,
  `nokp_guru` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `ting`, `nama_kelas`, `nokp_guru`) VALUES
(1, '1', 'AMAN', '123123123122'),
(2, '2', 'BERSIH', '123123123123'),
(5, '3', 'DEDIKASI', '123'),
(6, '1', 'CEKAL', '123123123199');

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `nama_murid` varchar(60) DEFAULT NULL,
  `nokp_murid` varchar(12) NOT NULL,
  `katalaluan_murid` varchar(30) DEFAULT NULL,
  `id_kelas` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`nama_murid`, `nokp_murid`, `katalaluan_murid`, `id_kelas`) VALUES
('Wan Wani', '111111111122', '11122', 1),
('leman bin lemin', '111222333444', '1234', 6),
('Si Nopal', '123', '123', 5),
('muhammad umar fawwaz\'', '222222222222', '111', 5);

-- --------------------------------------------------------

--
-- Table structure for table `set_soalan`
--

CREATE TABLE `set_soalan` (
  `no_set` int(9) NOT NULL,
  `topik` varchar(60) DEFAULT NULL,
  `arahan` varchar(250) DEFAULT NULL,
  `jenis` varchar(250) DEFAULT NULL,
  `tarikh` date DEFAULT NULL,
  `masa` varchar(50) DEFAULT NULL,
  `nokp_guru` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_soalan`
--

INSERT INTO `set_soalan` (`no_set`, `topik`, `arahan`, `jenis`, `tarikh`, `masa`, `nokp_guru`) VALUES
(5, 'Operasi tambah', 'Jawap semua seoalan yang diberikan..', 'Latihan', '2020-08-15', 'Tiada', '123'),
(6, 'Operasi Tolak', 'Jawap Semua soalan yang diberikan,', 'Latihan', '2020-08-01', 'Tiada', '123'),
(7, 'operasi bahagi', 'jawap semua soalan yang diberikan', 'Kuiz', '2020-09-08', '2', '123'),
(9, 'Operasi darab', 'jawap semua soalan yang diberikan', 'Kuiz', '2020-09-10', '13', '123'),
(10, 'wewe', 'wewe', 'Latihan', '2021-05-23', 'Tiada', '123');

-- --------------------------------------------------------

--
-- Table structure for table `soalan`
--

CREATE TABLE `soalan` (
  `no_soalan` int(11) NOT NULL,
  `no_set` int(9) DEFAULT NULL,
  `soalan` varchar(250) DEFAULT NULL,
  `gambar` varchar(60) DEFAULT NULL,
  `jawapan_a` varchar(60) DEFAULT NULL,
  `jawapan_b` varchar(60) DEFAULT NULL,
  `jawapan_c` varchar(60) DEFAULT NULL,
  `jawapan_d` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soalan`
--

INSERT INTO `soalan` (`no_soalan`, `no_set`, `soalan`, `gambar`, `jawapan_a`, `jawapan_b`, `jawapan_c`, `jawapan_d`) VALUES
(15, 5, 'Tukar 81% kepada nombor\r\nperpuluhan', ' ', '0.81', '8.10', '81.000', '0.0820'),
(16, 5, '0.5 + 0.02 = __________%', ' ', '52', '51', '53', '54'),
(18, 5, 'Ai Ling berupaya menjawab 38\r\ndaripada 40 soalan dalam suatu ujian\r\nSains dengan betul. Apakah peratusan\r\nsoalan yang betul dijawab oleh Ai\r\nLing?', ' ', '95%', '93%', '94%', '96%'),
(20, 5, '0.14 = __________%', ' ', '14', '12', '13', '15'),
(36, 7, '4/2', '../images/2020-09-08.jpg', '2', '3', '4', '5'),
(37, 7, '5/2', ' ', '2.5', '2', '3', '4'),
(38, 7, '9/3', ' ', '3', '4', '5', '2'),
(39, 7, '12\'/3', ' ', '4', '5', '6', '7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nokp_guru`);

--
-- Indexes for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  ADD PRIMARY KEY (`id_jawapan`),
  ADD UNIQUE KEY `no_soalan` (`no_soalan`,`nokp_murid`),
  ADD KEY `FK_jawapan_pelajar_murid` (`nokp_murid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `FK_kelas_guru` (`nokp_guru`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`nokp_murid`),
  ADD KEY `FK_murid_kelas` (`id_kelas`);

--
-- Indexes for table `set_soalan`
--
ALTER TABLE `set_soalan`
  ADD PRIMARY KEY (`no_set`),
  ADD KEY `FK_set_soalan_guru` (`nokp_guru`);

--
-- Indexes for table `soalan`
--
ALTER TABLE `soalan`
  ADD PRIMARY KEY (`no_soalan`),
  ADD KEY `FK_latihan_set_soalan` (`no_set`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  MODIFY `id_jawapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `set_soalan`
--
ALTER TABLE `set_soalan`
  MODIFY `no_set` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `soalan`
--
ALTER TABLE `soalan`
  MODIFY `no_soalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawapan_murid`
--
ALTER TABLE `jawapan_murid`
  ADD CONSTRAINT `FK_jawapan_pelajar_latihan` FOREIGN KEY (`no_soalan`) REFERENCES `soalan` (`no_soalan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_jawapan_pelajar_murid` FOREIGN KEY (`nokp_murid`) REFERENCES `murid` (`nokp_murid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `FK_kelas_guru` FOREIGN KEY (`nokp_guru`) REFERENCES `guru` (`nokp_guru`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `murid`
--
ALTER TABLE `murid`
  ADD CONSTRAINT `FK_murid_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `set_soalan`
--
ALTER TABLE `set_soalan`
  ADD CONSTRAINT `FK_set_soalan_guru` FOREIGN KEY (`nokp_guru`) REFERENCES `guru` (`nokp_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soalan`
--
ALTER TABLE `soalan`
  ADD CONSTRAINT `FK_latihan_set_soalan` FOREIGN KEY (`no_set`) REFERENCES `set_soalan` (`no_set`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
