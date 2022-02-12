-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ppob_listrik
CREATE DATABASE IF NOT EXISTS `ppob_listrik` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ppob_listrik`;

-- Dumping structure for table ppob_listrik.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_admin` varchar(255) DEFAULT NULL,
  `id_level` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_level` (`id_level`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.admin: ~3 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`, `id_level`) VALUES
	(8, 'admin', '$2y$10$fso5eU9gz4iyah9WRIzqEO8UFWRDo6CySzkB.xfZHNB8YKIVTo53W', 'Administrator', 1),
	(15, 'manager', '$2y$10$BggAe/wfgwXIHYlqnN2G1.gU.breK9P4bdGzcT6naevHBjCqVqoFa', 'Manager', 7),
	(16, 'bank', '$2y$10$P69wgT.nW72f/M2z6/cuEOWtdeA5YcAgzlMXlBWQuFK7.Y63So2c6', 'Bank', 2),
	(17, 'agung', '$2y$10$JRXny1D0AvXahs/e82o9vOEp94JIfITuhag3ORPnr8pCS4ES3h/ci', 'Agung', 9);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.level
CREATE TABLE IF NOT EXISTS `level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.level: ~4 rows (approximately)
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` (`id_level`, `nama_level`) VALUES
	(1, 'Administrator'),
	(2, 'Bank'),
	(7, 'Manager'),
	(9, 'Customer Service');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nomor_kwh` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_tarif` int(11) NOT NULL,
  PRIMARY KEY (`id_pelanggan`),
  KEY `id_tarif` (`id_tarif`),
  CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.pelanggan: ~1 rows (approximately)
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `password`, `nomor_kwh`, `nama_pelanggan`, `alamat`, `id_tarif`) VALUES
	(2, 'asep', '$2y$10$NJgrnKF.lkf1CqDafwOCPOMO9ZDafgbe9jWmgJxtAVI91MdZjdvQa', 12345, 'Asep', 'Perumahan Tiban Indah', 1),
	(4, 'budi', '$2y$10$1lg9.wa4S01Bg8JjzK/B3eeQCp4NRhj3KHn9UAzMeOPI.ynk9BTjC', 12345678, 'Budi', 'Bengkong Harapan 2', 1),
	(5, 'firman', '$2y$10$Hy7qoPEQ3VnFlq6QulkozeYQXXxWzEdPaBKn63KbZJcMGfzYpqLRO', 0, 'Firman', 'Tiban Kampung', 1);
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_tagihan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `bulan_bayar` int(11) DEFAULT NULL,
  `biaya_admin` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `id_admin` (`id_admin`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_tagihan` (`id_tagihan`),
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.pembayaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.penggunaan
CREATE TABLE IF NOT EXISTS `penggunaan` (
  `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `meter_awal` int(11) DEFAULT NULL,
  `meter_akhir` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penggunaan`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.penggunaan: ~0 rows (approximately)
/*!40000 ALTER TABLE `penggunaan` DISABLE KEYS */;
INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
	(1, 2, 1, '2022', 100, 150);
/*!40000 ALTER TABLE `penggunaan` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.tagihan
CREATE TABLE IF NOT EXISTS `tagihan` (
  `id_tagihan` int(11) NOT NULL AUTO_INCREMENT,
  `id_penggunaan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `jumlah_meter` int(11) DEFAULT NULL,
  `status` enum('belum_lunas','lunas','','') NOT NULL,
  PRIMARY KEY (`id_tagihan`),
  KEY `id_penggunaan` (`id_penggunaan`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagihan_ibfk_2` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.tagihan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tagihan` DISABLE KEYS */;
INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES
	(1, 1, 2, 1, '2022', 50, 'belum_lunas');
/*!40000 ALTER TABLE `tagihan` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.tarif
CREATE TABLE IF NOT EXISTS `tarif` (
  `id_tarif` int(11) NOT NULL AUTO_INCREMENT,
  `daya` int(11) DEFAULT NULL,
  `tarifperkwh` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.tarif: ~0 rows (approximately)
/*!40000 ALTER TABLE `tarif` DISABLE KEYS */;
INSERT INTO `tarif` (`id_tarif`, `daya`, `tarifperkwh`) VALUES
	(1, 65, 5000);
/*!40000 ALTER TABLE `tarif` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
