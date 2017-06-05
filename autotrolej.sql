-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2017 at 02:26 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autotrolej`
--

-- --------------------------------------------------------

--
-- Table structure for table `kartica`
--

CREATE TABLE `kartica` (
  `brojkartice` varchar(45) NOT NULL,
  `idkorisnik` int(255) DEFAULT NULL,
  `datum_obnove` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartica`
--

INSERT INTO `kartica` (`brojkartice`, `idkorisnik`, `datum_obnove`) VALUES
('1234 5678 9876', 1, '2017-04-12'),
(' 5139 2010 1742 2402 ', 2, '2017-04-27'),
(' 2663 9435 4918 5063 ', 3, NULL),
('1234', 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Autobus`
--

CREATE TABLE `Autobus` (
  `id` int(11) NOT NULL,
  `id_linija` int(11) DEFAULT NULL,
  `vrijeme` int(11) NOT NULL,
  `max_vrijeme` int(11) NOT NULL,
  `smjer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_linija` (`id_linija`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Autobus`
--

INSERT INTO `Autobus` (`id`, `id_linija`, `vrijeme`, `max_vrijeme`, `smjer`) VALUES
(1, 1, 1, 25, 0);
-- -------------------------------------------------------

--
-- Table structure for table `Linija`
--

CREATE TABLE`Linija` (
  `id` int(11) NOT NULL,
  `id_stanica_pol` int(11) NOT NULL,
  `id_stanica_odr` int(11) NOT NULL,
  `br` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_stanica_pol` (`id_stanica_pol`),
  KEY `id_stanica_odr` (`id_stanica_odr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Linija`
--

INSERT INTO `Linija` (`id`, `id_stanica_pol`, `id_stanica_odr`, `br`) VALUES
(1, 2, 1, 5),
(4, 0, 0, 4),
(6, 3, 2, 6);
-- -------------------------------------------------------

--
-- Table structure for table `LinijaStanica`
--

CREATE TABLE `LinijaStanica` (
  `id_linija` int(11) NOT NULL,
  `id_stanica` int(11) NOT NULL,
  PRIMARY KEY (`id_linija`,`id_stanica`),
  KEY `id_stanica` (`id_stanica`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `Stanica`
--

CREATE TABLE IF NOT EXISTS `Stanica` (
  `id` int(11) NOT NULL,
  `geo_duzina` double NOT NULL,
  `geo_sirina` double NOT NULL,
  `naziv` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `vrijeme_polazak` int(11) NOT NULL,
  `vrijeme_povratak` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

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

-- ---------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(255) NOT NULL,
  `ime` varchar(30) COLLATE utf8_croatian_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_croatian_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `lozinka` varchar(30) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `adresa`, `telefon`, `email`, `lozinka`) VALUES
(1, 'Kristijan', 'Blecic', 'Milutina Bataje 6', '+385917926501', 'kristijanblecic@gmail.com', 'proba'),
(22, 'Karlo', 'Blecic', 'Milutina Bataje 6', '091 123 456', 'bankariznica@gmail.com', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `privremeni`
--

CREATE TABLE `privremeni` (
  `brojkartice` varchar(40) NOT NULL,
  `ime` varchar(15) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `prezime` varchar(15) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `adresa` varchar(40) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `telefon` varchar(15) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `kod` int(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transakcija`
--

CREATE TABLE `transakcija` (
  `id` int(255) NOT NULL,
  `idkorisnik` int(255) NOT NULL,
  `kartica` int(255) NOT NULL,
  `datum` date NOT NULL,
  `zona` int(255) NOT NULL,
  `cijena` varchar(15) NOT NULL,
  `QR` int(255) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transakcija`
--

INSERT INTO `transakcija` (`id`, `idkorisnik`, `kartica`, `datum`, `zona`, `cijena`, `QR`) VALUES
(11, 1, 1, '2017-05-31', 1, '110kn', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kartica`
--
ALTER TABLE `kartica`
  ADD PRIMARY KEY (`brojkartice`),
  ADD UNIQUE KEY `idkorisnik` (`idkorisnik`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privremeni`
--
ALTER TABLE `privremeni`
  ADD PRIMARY KEY (`brojkartice`);

--
-- Indexes for table `transakcija`
--
ALTER TABLE `transakcija`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `transakcija`
--
ALTER TABLE `transakcija`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
