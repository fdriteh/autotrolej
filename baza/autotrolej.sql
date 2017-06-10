-- MySQL dump 10.13  Distrib 5.6.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Autotrolej
-- ------------------------------------------------------
-- Server version	5.6.31-0ubuntu0.15.10.1

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
-- Table structure for table `Autobus`
--

DROP TABLE IF EXISTS `Autobus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Autobus` (
  `id` int(11) NOT NULL,
  `id_linija` int(11) DEFAULT NULL,
  `vrijeme` int(11) NOT NULL,
  `max_vrijeme` int(11) NOT NULL,
  `smjer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_linija` (`id_linija`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Autobus`
--

LOCK TABLES `Autobus` WRITE;
/*!40000 ALTER TABLE `Autobus` DISABLE KEYS */;
INSERT INTO `Autobus` VALUES (1,1,1,25,0);
/*!40000 ALTER TABLE `Autobus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Karta`
--

DROP TABLE IF EXISTS `Karta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Karta` (
  `id_Karta` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(32) CHARACTER SET utf32 COLLATE utf32_croatian_ci NOT NULL,
  `Cijena` float NOT NULL,
  PRIMARY KEY (`id_Karta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Karta`
--

LOCK TABLES `Karta` WRITE;
/*!40000 ALTER TABLE `Karta` DISABLE KEYS */;
INSERT INTO `Karta` VALUES (1,'Mjesečna karta',110),(3,'Dnevna karta',15),(5,'Studentska',53),(6,'UÄeniÄka',53.5);
/*!40000 ALTER TABLE `Karta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Linija`
--

DROP TABLE IF EXISTS `Linija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Linija` (
  `id` int(11) NOT NULL,
  `id_stanica_pol` int(11) NOT NULL,
  `id_stanica_odr` int(11) NOT NULL,
  `br` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_stanica_pol` (`id_stanica_pol`),
  KEY `id_stanica_odr` (`id_stanica_odr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Linija`
--

LOCK TABLES `Linija` WRITE;
/*!40000 ALTER TABLE `Linija` DISABLE KEYS */;
INSERT INTO `Linija` VALUES (1,2,1,5),(4,0,0,4),(6,3,2,6);
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
  KEY `id_stanica` (`id_stanica`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LinijaStanica`
--

LOCK TABLES `LinijaStanica` WRITE;
/*!40000 ALTER TABLE `LinijaStanica` DISABLE KEYS */;
INSERT INTO `LinijaStanica` VALUES (1,2),(1,5),(1,8),(1,11),(1,16),(4,20),(4,22),(4,23),(4,24),(4,28),(4,30),(4,34),(6,60),(6,62),(6,64),(6,66),(6,68);
/*!40000 ALTER TABLE `LinijaStanica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Objava`
--

DROP TABLE IF EXISTS `Objava`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Objava` (
  `Vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Naslov` varchar(32) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `Tekst` varchar(1024) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  PRIMARY KEY (`Vrijeme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Objava`
--

LOCK TABLES `Objava` WRITE;
/*!40000 ALTER TABLE `Objava` DISABLE KEYS */;
/*!40000 ALTER TABLE `Objava` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Stanica`
--

DROP TABLE IF EXISTS `Stanica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Stanica` (
  `id` int(11) NOT NULL,
  `geo_duzina` double NOT NULL,
  `geo_sirina` double NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `vrijeme_polazak` int(11) NOT NULL,
  `vrijeme_povratak` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Stanica`
--

LOCK TABLES `Stanica` WRITE;
/*!40000 ALTER TABLE `Stanica` DISABLE KEYS */;
INSERT INTO `Stanica` VALUES (2,14.4457941,45.3256496,'Jelačić',0,25),(5,14.4333319,45.3306995,'Brajda',4,21),(8,14.4275549,45.3399393,'Osječka',8,17),(11,14.4195905,45.3520037,'Škurinje1',15,10),(16,14.4250032,45.3570211,'Drenova',25,0),(20,14.4468694,45.3264335,'Fiumara',0,0),(22,14.437725,45.3279484,'Žabica',0,0),(23,14.4333319,45.3306995,'Brajda2',0,0),(24,14.4334429,45.3333696,'Prvomajska',0,0),(28,14.4463297,45.3331745,'Kozala1',0,0),(30,14.4406687,45.3424592,'Brašćine',0,0),(34,14.4468744,45.3265017,'Fiumara2',0,0),(60,14.474803,45.320813,'Podvežica',0,0),(62,14.4468694,45.3264335,'Fiumara_6',0,0),(64,14.4309287,45.3315626,'KBC-Rijeka',0,0),(66,14.4156372,45.3412283,'Vukovarska',0,0),(68,14.3969073,45.3430934,'Novo naselje',0,0);
/*!40000 ALTER TABLE `Stanica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kartica`
--

DROP TABLE IF EXISTS `kartica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kartica` (
  `brojkartice` varchar(45) NOT NULL,
  `idkorisnik` int(255) DEFAULT NULL,
  `datum_obnove` date DEFAULT NULL,
  PRIMARY KEY (`brojkartice`),
  UNIQUE KEY `idkorisnik` (`idkorisnik`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kartica`
--

LOCK TABLES `kartica` WRITE;
/*!40000 ALTER TABLE `kartica` DISABLE KEYS */;
INSERT INTO `kartica` VALUES ('1234 5678 9876',1,'2017-04-12'),(' 5139 2010 1742 2402 ',2,'2017-04-27'),(' 2663 9435 4918 5063 ',3,NULL),('1234',22,NULL);
/*!40000 ALTER TABLE `kartica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ime` varchar(30) COLLATE utf8_croatian_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_croatian_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (1,'Kristijan','Blecic','Milutina Bataje 6','+385917926501','kristijanblecic@gmail.com','proba'),(22,'Karlo','Blecic','Milutina Bataje 6','091 123 456','bankariznica@gmail.com','a');
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privremeni`
--

DROP TABLE IF EXISTS `privremeni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privremeni` (
  `brojkartice` varchar(40) NOT NULL,
  `ime` varchar(15) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `prezime` varchar(15) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `adresa` varchar(40) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `telefon` varchar(15) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `kod` int(255) DEFAULT NULL,
  PRIMARY KEY (`brojkartice`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privremeni`
--

LOCK TABLES `privremeni` WRITE;
/*!40000 ALTER TABLE `privremeni` DISABLE KEYS */;
/*!40000 ALTER TABLE `privremeni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transakcija`
--

DROP TABLE IF EXISTS `transakcija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transakcija` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `idkorisnik` int(255) NOT NULL,
  `kartica` int(255) NOT NULL,
  `datum` date NOT NULL,
  `zona` int(255) NOT NULL,
  `cijena` varchar(15) NOT NULL,
  `QR` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `QR` (`QR`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transakcija`
--

LOCK TABLES `transakcija` WRITE;
/*!40000 ALTER TABLE `transakcija` DISABLE KEYS */;
INSERT INTO `transakcija` VALUES (11,1,1,'2017-05-31',1,'110kn',0);
/*!40000 ALTER TABLE `transakcija` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-05 19:39:50
