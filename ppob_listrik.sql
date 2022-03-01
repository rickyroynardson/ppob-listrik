-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
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

-- Dumping data for table ppob_listrik.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`, `id_level`) VALUES
	(8, 'admin', '$2y$10$fso5eU9gz4iyah9WRIzqEO8UFWRDo6CySzkB.xfZHNB8YKIVTo53W', 'Administrator', 1),
	(16, 'bank', '$2y$10$P69wgT.nW72f/M2z6/cuEOWtdeA5YcAgzlMXlBWQuFK7.Y63So2c6', 'Bank', 2);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.level
CREATE TABLE IF NOT EXISTS `level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.level: ~2 rows (approximately)
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` (`id_level`, `nama_level`) VALUES
	(1, 'Administrator'),
	(2, 'Bank');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.pelanggan: ~3 rows (approximately)
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `password`, `nomor_kwh`, `nama_pelanggan`, `alamat`, `id_tarif`) VALUES
	(6, 'doddyferdiansyah', '$2y$10$MbyxiIIjamix.4eMEG2H9.2L6WjDbF5fQNIpgMyNgxkv9uJXIFWgi', 99856, 'Doddy Ferdiansyah', 'Bengkong', 1),
	(7, 'albet', '$2y$10$yE0uZTBAYDCsSfWiXPy9VeDmew4p/Xg4IymLXK1IUMhaAzvecW0Xq', 78451, 'Albet', 'Tiban', 2),
	(8, 'heru', '$2y$10$mWV4u1kxAgXv7E87le3JBeBjEM18rxx3FhAk5jWNLz3EIpTTD8nei', 11569, 'Heru', 'Melcem', 3);
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
  `status_bayar` enum('Verifikasi','Lunas') DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `id_admin` (`id_admin`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_tagihan` (`id_tagihan`),
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.pembayaran: ~2 rows (approximately)
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `id_pelanggan`, `tanggal_pembayaran`, `bulan_bayar`, `biaya_admin`, `total_bayar`, `id_admin`, `status_bayar`) VALUES
	(1, 2, 6, '2022-03-01', 1, 5000, 505000, 8, 'Lunas'),
	(2, 3, 6, '2022-03-01', 2, 5000, 255000, 16, 'Lunas');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.penggunaan
CREATE TABLE IF NOT EXISTS `penggunaan` (
  `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `meter_awal` int(11) DEFAULT NULL,
  `meter_akhir` int(11) DEFAULT NULL,
  `is_tagihan` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_penggunaan`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.penggunaan: ~2 rows (approximately)
/*!40000 ALTER TABLE `penggunaan` DISABLE KEYS */;
INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`, `is_tagihan`) VALUES
	(2, 6, 1, '2022', 0, 100, 0),
	(3, 6, 2, '2022', 100, 150, 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.tagihan: ~2 rows (approximately)
/*!40000 ALTER TABLE `tagihan` DISABLE KEYS */;
INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES
	(2, 2, 6, 1, '2022', 100, 'lunas'),
	(3, 3, 6, 2, '2022', 50, 'lunas');
/*!40000 ALTER TABLE `tagihan` ENABLE KEYS */;

-- Dumping structure for table ppob_listrik.tarif
CREATE TABLE IF NOT EXISTS `tarif` (
  `id_tarif` int(11) NOT NULL AUTO_INCREMENT,
  `daya` int(11) DEFAULT NULL,
  `tarifperkwh` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ppob_listrik.tarif: ~3 rows (approximately)
/*!40000 ALTER TABLE `tarif` DISABLE KEYS */;
INSERT INTO `tarif` (`id_tarif`, `daya`, `tarifperkwh`) VALUES
	(1, 70, 5000),
	(2, 100, 8000),
	(3, 150, 10000);
/*!40000 ALTER TABLE `tarif` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
