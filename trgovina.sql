-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for trgovina
CREATE DATABASE IF NOT EXISTS `trgovina` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `trgovina`;


-- Dumping structure for table trgovina.djelatnici
CREATE TABLE IF NOT EXISTS `djelatnici` (
  `sifra_djelatnika` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `broj_trgovine` int(11) NOT NULL,
  `telefon` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`sifra_djelatnika`),
  KEY `broj_trgovine` (`broj_trgovine`),
  CONSTRAINT `djelatnici_ibfk_1` FOREIGN KEY (`broj_trgovine`) REFERENCES `trgovine` (`broj_trgovine`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table trgovina.djelatnici: ~4 rows (approximately)
/*!40000 ALTER TABLE `djelatnici` DISABLE KEYS */;
INSERT INTO `djelatnici` (`sifra_djelatnika`, `ime`, `prezime`, `broj_trgovine`, `telefon`, `email`) VALUES
	(2, 'Pero', 'Perić', 1, 91999889, 'pero@gmail.com'),
	(3, 'Jozo', 'Bozo', 2, 1446778, 'jbozo@net.hr'),
	(5, 'Marko', 'Marković', 3, 99876423, 'mmarkovic@net.hr');
/*!40000 ALTER TABLE `djelatnici` ENABLE KEYS */;


-- Dumping structure for table trgovina.proizvodi
CREATE TABLE IF NOT EXISTS `proizvodi` (
  `sifra_proizvoda` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cijena` float NOT NULL,
  `broj_trgovine` int(11) NOT NULL,
  PRIMARY KEY (`sifra_proizvoda`),
  KEY `fkkk` (`broj_trgovine`),
  CONSTRAINT `fkkk` FOREIGN KEY (`broj_trgovine`) REFERENCES `trgovine` (`broj_trgovine`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table trgovina.proizvodi: ~4 rows (approximately)
/*!40000 ALTER TABLE `proizvodi` DISABLE KEYS */;
INSERT INTO `proizvodi` (`sifra_proizvoda`, `naziv`, `cijena`, `broj_trgovine`) VALUES
	(1, 'kruh', 5.99, 1),
	(2, 'mlijeko', 6.86, 1),
	(3, 'šećer', 10.99, 2),
	(5, 'televizor', 1500, 3);
/*!40000 ALTER TABLE `proizvodi` ENABLE KEYS */;


-- Dumping structure for table trgovina.trgovine
CREATE TABLE IF NOT EXISTS `trgovine` (
  `broj_trgovine` int(11) NOT NULL,
  `postanski_broj` int(11) NOT NULL,
  `mjesto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`broj_trgovine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table trgovina.trgovine: ~3 rows (approximately)
/*!40000 ALTER TABLE `trgovine` DISABLE KEYS */;
INSERT INTO `trgovine` (`broj_trgovine`, `postanski_broj`, `mjesto`, `adresa`) VALUES
	(1, 31000, 'Osijek', 'Europske Avenije 22'),
	(2, 10000, 'Zagreb', 'Ilica 15'),
	(3, 21000, 'Split', 'Riva 7');
/*!40000 ALTER TABLE `trgovine` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
