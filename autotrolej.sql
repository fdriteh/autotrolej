-- MySQL dump 10.16  Distrib 10.1.23-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: autotrolej
-- ------------------------------------------------------
-- Server version	10.1.23-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Administrator`
--

DROP TABLE IF EXISTS `Administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Administrator` (
  `id_korisnik` int(11) NOT NULL,
  PRIMARY KEY (`id_korisnik`),
  CONSTRAINT `Administrator_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `Korisnik` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Administrator`
--

LOCK TABLES `Administrator` WRITE;
/*!40000 ALTER TABLE `Administrator` DISABLE KEYS */;
/*!40000 ALTER TABLE `Administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Autobus`
--

DROP TABLE IF EXISTS `Autobus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Autobus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vozac` int(11) DEFAULT NULL,
  `id_linija` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vozac` (`id_vozac`),
  KEY `id_linija` (`id_linija`),
  CONSTRAINT `Autobus_ibfk_1` FOREIGN KEY (`id_vozac`) REFERENCES `Vozac` (`id`),
  CONSTRAINT `Autobus_ibfk_2` FOREIGN KEY (`id_linija`) REFERENCES `Linija` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Autobus`
--

LOCK TABLES `Autobus` WRITE;
/*!40000 ALTER TABLE `Autobus` DISABLE KEYS */;
/*!40000 ALTER TABLE `Autobus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Favorit`
--

DROP TABLE IF EXISTS `Favorit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Favorit` (
  `id_korisnik` int(11) NOT NULL,
  `id_linija` int(11) NOT NULL,
  PRIMARY KEY (`id_korisnik`,`id_linija`),
  KEY `id_linija` (`id_linija`),
  CONSTRAINT `Favorit_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `Korisnik` (`id`),
  CONSTRAINT `Favorit_ibfk_2` FOREIGN KEY (`id_linija`) REFERENCES `Linija` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Favorit`
--

LOCK TABLES `Favorit` WRITE;
/*!40000 ALTER TABLE `Favorit` DISABLE KEYS */;
/*!40000 ALTER TABLE `Favorit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Korisnik`
--

DROP TABLE IF EXISTS `Korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Korisnik`
--

LOCK TABLES `Korisnik` WRITE;
/*!40000 ALTER TABLE `Korisnik` DISABLE KEYS */;
/*!40000 ALTER TABLE `Korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Linija`
--

DROP TABLE IF EXISTS `Linija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Linija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stanica_pol` int(11) NOT NULL,
  `id_stanica_odr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_stanica_pol` (`id_stanica_pol`),
  KEY `id_stanica_odr` (`id_stanica_odr`),
  CONSTRAINT `Linija_ibfk_1` FOREIGN KEY (`id_stanica_pol`) REFERENCES `Stanica` (`id`),
  CONSTRAINT `Linija_ibfk_2` FOREIGN KEY (`id_stanica_odr`) REFERENCES `Stanica` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Linija`
--

LOCK TABLES `Linija` WRITE;
/*!40000 ALTER TABLE `Linija` DISABLE KEYS */;
/*!40000 ALTER TABLE `Linija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LinijaStanica`
--

DROP TABLE IF EXISTS `LinijaStanica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LinijaStanica` (
  `id_linija` int(11) NOT NULL,
  `id_stanica` int(11) NOT NULL,
  PRIMARY KEY (`id_linija`,`id_stanica`),
  KEY `id_stanica` (`id_stanica`),
  CONSTRAINT `LinijaStanica_ibfk_1` FOREIGN KEY (`id_linija`) REFERENCES `Linija` (`id`),
  CONSTRAINT `LinijaStanica_ibfk_2` FOREIGN KEY (`id_stanica`) REFERENCES `Stanica` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LinijaStanica`
--

LOCK TABLES `LinijaStanica` WRITE;
/*!40000 ALTER TABLE `LinijaStanica` DISABLE KEYS */;
/*!40000 ALTER TABLE `LinijaStanica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pozicija`
--

DROP TABLE IF EXISTS `Pozicija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pozicija` (
  `id_autobus` int(11) NOT NULL AUTO_INCREMENT,
  `geo_duzina` double NOT NULL,
  `geo_sirina` double NOT NULL,
  PRIMARY KEY (`id_autobus`),
  CONSTRAINT `Pozicija_ibfk_1` FOREIGN KEY (`id_autobus`) REFERENCES `Autobus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pozicija`
--

LOCK TABLES `Pozicija` WRITE;
/*!40000 ALTER TABLE `Pozicija` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pozicija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sesija`
--

DROP TABLE IF EXISTS `Sesija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sesija` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_korisnik` int(11) NOT NULL,
  `vrijeme` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_korisnik` (`id_korisnik`),
  CONSTRAINT `Sesija_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `Korisnik` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sesija`
--

LOCK TABLES `Sesija` WRITE;
/*!40000 ALTER TABLE `Sesija` DISABLE KEYS */;
/*!40000 ALTER TABLE `Sesija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Stanica`
--

DROP TABLE IF EXISTS `Stanica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Stanica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `geo_duzina_pol` double NOT NULL,
  `geo_sirina_pol` double NOT NULL,
  `vrijeme_od_pol` int(11) NOT NULL,
  `geo_duzina_pov` double NOT NULL,
  `geo_sirina_pov` double NOT NULL,
  `vrijeme_od_odr` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Stanica`
--

LOCK TABLES `Stanica` WRITE;
/*!40000 ALTER TABLE `Stanica` DISABLE KEYS */;
/*!40000 ALTER TABLE `Stanica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vozac`
--

DROP TABLE IF EXISTS `Vozac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vozac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oib` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vozac`
--

LOCK TABLES `Vozac` WRITE;
/*!40000 ALTER TABLE `Vozac` DISABLE KEYS */;
/*!40000 ALTER TABLE `Vozac` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-16 10:31:32
