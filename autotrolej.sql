-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2017 at 10:10 PM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `autotrolej`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administrator`
--

CREATE TABLE IF NOT EXISTS `Administrator` (
  `id_korisnik` int(11) NOT NULL,
  PRIMARY KEY (`id_korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Autobus`
--

CREATE TABLE IF NOT EXISTS `Autobus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_linija` int(11) DEFAULT NULL,
  `vrijeme` int(11) NOT NULL,
  `max_vrijeme` int(11) NOT NULL,
  `smjer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_linija` (`id_linija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Autobus`
--

INSERT INTO `Autobus` (`id`, `id_linija`, `vrijeme`, `max_vrijeme`, `smjer`) VALUES
(1, 1, 1, 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Favorit`
--

CREATE TABLE IF NOT EXISTS `Favorit` (
  `id_korisnik` int(11) NOT NULL,
  `id_linija` int(11) NOT NULL,
  PRIMARY KEY (`id_korisnik`,`id_linija`),
  KEY `id_linija` (`id_linija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Korisnik`
--

CREATE TABLE IF NOT EXISTS `Korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Linija`
--

CREATE TABLE IF NOT EXISTS `Linija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stanica_pol` int(11) NOT NULL,
  `id_stanica_odr` int(11) NOT NULL,
  `br` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_stanica_pol` (`id_stanica_pol`),
  KEY `id_stanica_odr` (`id_stanica_odr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Linija`
--

INSERT INTO `Linija` (`id`, `id_stanica_pol`, `id_stanica_odr`, `br`) VALUES
(1, 2, 1, 5),
(4, 0, 0, 4),
(6, 3, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `LinijaStanica`
--

CREATE TABLE IF NOT EXISTS `LinijaStanica` (
  `id_linija` int(11) NOT NULL,
  `id_stanica` int(11) NOT NULL,
  PRIMARY KEY (`id_linija`,`id_stanica`),
  KEY `id_stanica` (`id_stanica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `LinijaStanica`
--

INSERT INTO `LinijaStanica` (`id_linija`, `id_stanica`) VALUES
(1, 2),
(1, 5),
(1, 8),
(1, 11),
(1, 16),
(4, 20),
(4, 22),
(4, 23),
(4, 24),
(4, 28),
(4, 30),
(4, 34),
(6, 60),
(6, 62),
(6, 64),
(6, 66),
(6, 68);

-- --------------------------------------------------------

--
-- Table structure for table `Pozicija`
--

CREATE TABLE IF NOT EXISTS `Pozicija` (
  `id_autobus` int(11) NOT NULL AUTO_INCREMENT,
  `geo_duzina` double NOT NULL,
  `geo_sirina` double NOT NULL,
  PRIMARY KEY (`id_autobus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Stanica`
--

CREATE TABLE IF NOT EXISTS `Stanica` (
  `id` int(11) NOT NULL,
  `geo_duzina` double NOT NULL,
  `geo_sirina` double NOT NULL,
  `naziv` varchar(50) COLLATE utf8_bin NOT NULL,
  `vrijeme_polazak` int(11) NOT NULL,
  `vrijeme_povratak` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Stanica`
--

INSERT INTO `Stanica` (`id`, `geo_duzina`, `geo_sirina`, `naziv`, `vrijeme_polazak`, `vrijeme_povratak`) VALUES
(2, 14.4457941, 45.3256496, 'Jelačić', 0, 25),
(5, 14.4333319, 45.3306995, 'Brajda', 4, 21),
(8, 14.4275549, 45.3399393, 'Osječka', 8, 17),
(11, 14.4195905, 45.3520037, 'Škurinje1', 15, 10),
(16, 14.4250032, 45.3570211, 'Drenova', 25, 0),
(20, 14.4468694, 45.3264335, 'Fiumara', 0, 0),
(22, 14.437725, 45.3279484, 'Žabica', 0, 0),
(23, 14.4333319, 45.3306995, 'Brajda2', 0, 0),
(24, 14.4334429, 45.3333696, 'Prvomajska', 0, 0),
(28, 14.4463297, 45.3331745, 'Kozala1', 0, 0),
(30, 14.4406687, 45.3424592, 'Brašćine', 0, 0),
(34, 14.4468744, 45.3265017, 'Fiumara2', 0, 0),
(60, 14.474803, 45.320813, 'Podvežica', 0, 0),
(62, 14.4468694, 45.3264335, 'Fiumara_6', 0, 0),
(64, 14.4309287, 45.3315626, 'KBC-Rijeka', 0, 0),
(66, 14.4156372, 45.3412283, 'Vukovarska', 0, 0),
(68, 14.3969073, 45.3430934, 'Novo naselje', 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Administrator`
--
ALTER TABLE `Administrator`
  ADD CONSTRAINT `Administrator_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `Korisnik` (`id`);

--
-- Constraints for table `Autobus`
--
ALTER TABLE `Autobus`
  ADD CONSTRAINT `Autobus_ibfk_2` FOREIGN KEY (`id_linija`) REFERENCES `Linija` (`id`);

--
-- Constraints for table `Favorit`
--
ALTER TABLE `Favorit`
  ADD CONSTRAINT `Favorit_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `Korisnik` (`id`),
  ADD CONSTRAINT `Favorit_ibfk_2` FOREIGN KEY (`id_linija`) REFERENCES `Linija` (`id`);

--
-- Constraints for table `LinijaStanica`
--
ALTER TABLE `LinijaStanica`
  ADD CONSTRAINT `LinijaStanica_ibfk_1` FOREIGN KEY (`id_linija`) REFERENCES `Linija` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `LinijaStanica_ibfk_2` FOREIGN KEY (`id_stanica`) REFERENCES `Stanica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Pozicija`
--
ALTER TABLE `Pozicija`
  ADD CONSTRAINT `Pozicija_ibfk_1` FOREIGN KEY (`id_autobus`) REFERENCES `Autobus` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
