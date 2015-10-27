-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2015 at 11:55 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sikp`
--

-- --------------------------------------------------------

--
-- Table structure for table `akademik`
--

CREATE TABLE IF NOT EXISTS `akademik` (
  `idakademik` int(11) NOT NULL,
  `tahun_akademik` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idakademik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(45) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE IF NOT EXISTS `kehadiran` (
  `idkehadiran` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(11) DEFAULT NULL,
  `waktu_masuk` time DEFAULT NULL,
  `waktu_keluar` time DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `keterangan` text,
  `nip` varchar(25) NOT NULL,
  `idakademik` int(11) NOT NULL,
  PRIMARY KEY (`idkehadiran`,`nip`,`idakademik`),
  KEY `fk_kehadiran_pegawai1_idx` (`nip`),
  KEY `fk_kehadiran_akademik1_idx` (`idakademik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ketetapan_jam`
--

CREATE TABLE IF NOT EXISTS `ketetapan_jam` (
  `idketetapan_jam` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah_jam` int(25) DEFAULT NULL,
  `keterangan` text,
  `nip` varchar(25) NOT NULL,
  `idakademik` int(11) NOT NULL,
  `idoperasional` int(11) NOT NULL,
  PRIMARY KEY (`idketetapan_jam`,`nip`,`idakademik`,`idoperasional`),
  KEY `fk_ketetapan_jam_pegawai1_idx` (`nip`),
  KEY `fk_ketetapan_jam_akademik1_idx` (`idakademik`),
  KEY `fk_ketetapan_jam_operasional1_idx` (`idoperasional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `operasional`
--

CREATE TABLE IF NOT EXISTS `operasional` (
  `idoperasional` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_operasional` date DEFAULT NULL,
  `keterangan` text,
  `idakademik` int(11) NOT NULL,
  PRIMARY KEY (`idoperasional`,`idakademik`),
  KEY `fk_operasional_akademik1_idx` (`idakademik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `nip` varchar(25) NOT NULL,
  `nama_pegawai` varchar(45) DEFAULT NULL,
  `jenis_kelamin` varchar(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `alamat_pegawai` text,
  `no_telepon` varchar(15) DEFAULT NULL,
  `tempat_lahir` varchar(25) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `id_jabatan` int(11) NOT NULL,
  PRIMARY KEY (`nip`,`id_jabatan`),
  KEY `fk_pegawai_jabatan1_idx` (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(45) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `fk_kehadiran_akademik1` FOREIGN KEY (`idakademik`) REFERENCES `akademik` (`idakademik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kehadiran_pegawai1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ketetapan_jam`
--
ALTER TABLE `ketetapan_jam`
  ADD CONSTRAINT `fk_ketetapan_jam_akademik1` FOREIGN KEY (`idakademik`) REFERENCES `akademik` (`idakademik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ketetapan_jam_operasional1` FOREIGN KEY (`idoperasional`) REFERENCES `operasional` (`idoperasional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ketetapan_jam_pegawai1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `operasional`
--
ALTER TABLE `operasional`
  ADD CONSTRAINT `fk_operasional_akademik1` FOREIGN KEY (`idakademik`) REFERENCES `akademik` (`idakademik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_pegawai_jabatan1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
