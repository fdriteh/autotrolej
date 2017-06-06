-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2017 at 02:48 PM
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
('1234 5678 9876', 1, '2017-06-04'),
(' 5139 2010 1742 2402 ', 2, '2017-04-27'),
(' 2663 9435 4918 5063 ', 3, NULL),
('1234', 22, NULL);

-- --------------------------------------------------------

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
(16, 1, 1, '2017-06-04', 1, '110kn', 0),
(15, 1, 1, '2017-06-04', 1, '110kn', 0),
(14, 1, 0, '2017-06-04', 1, '10kn', 313321),
(13, 1, 0, '2017-05-31', 3, '30kn', 550041),
(12, 1, 0, '2017-05-31', 2, '20kn', 581853),
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
