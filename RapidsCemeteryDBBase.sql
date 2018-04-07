CREATE DATABASE  IF NOT EXISTS `RapidsCemetery` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `RapidsCemetery`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: RapidsCemetery
-- ------------------------------------------------------
-- Server version 5.1.73

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
-- Table structure for table `Contact`
--

DROP TABLE IF EXISTS `Contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contact` (
  `idContact` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `description` blob,
  `phone` varchar(80) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idContact`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contact`
--

LOCK TABLES `Contact` WRITE;
/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `Contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Event`
--

DROP TABLE IF EXISTS `Event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Event` (
  `idEvent` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` blob,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `idWiderAreaMap` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `fk_Event_WiderAreaMap1_idx` (`idWiderAreaMap`),
  CONSTRAINT `fk_Event_WiderAreaMap1` FOREIGN KEY (`idWiderAreaMap`) REFERENCES `WiderAreaMap` (`idWiderAreaMap`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Event`
--

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;
/*!40000 ALTER TABLE `Event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FAQ`
--

DROP TABLE IF EXISTS `FAQ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FAQ` (
  `idFAQ` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(300) DEFAULT NULL,
  `answer` blob,
  PRIMARY KEY (`idFAQ`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FAQ`
--

LOCK TABLES `FAQ` WRITE;
/*!40000 ALTER TABLE `FAQ` DISABLE KEYS */;
/*!40000 ALTER TABLE `FAQ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Grave`
--

DROP TABLE IF EXISTS `Grave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Grave` (
  `idGrave` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(75) DEFAULT NULL,
  `middleName` varchar(75) DEFAULT NULL,
  `lastName` varchar(75) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `death` date DEFAULT NULL,
  `description` blob,
  `idHistoricFilter` int(11) DEFAULT NULL,
  PRIMARY KEY (`idGrave`),
  KEY `fk_GraveDetail_HistoricFilter1_idx` (`idHistoricFilter`),
  CONSTRAINT `fk_GraveDetail_HistoricFilter1` FOREIGN KEY (`idHistoricFilter`) REFERENCES `HistoricFilter` (`idHistoricFilter`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grave`
--

LOCK TABLES `Grave` WRITE;
/*!40000 ALTER TABLE `Grave` DISABLE KEYS */;
INSERT INTO `Grave` VALUES (1,'James','H','McGuckin','1841-01-01','1885-01-01','His service was prestigious',1),(2,'','','Oakley','1841-01-01','1885-01-01','The Oakley family is mean to be a representative of the early pioneer families. Research suggests that the first generation had a Revolutionary War vetern; the second generation fought in the War of 1812 and the next generation, Monroe Oakley, fought in the Civil War.',0),(3,'','','Potter\'s Field','1841-01-01','1885-01-01','The Potter\'s Field area is desolate (foreground) and proceeds along the sidewalk towards the four posts of the cemetery enterance. The \"poorest of the poor\" were located here, most likely buried in a simple shroud with no burial marker.',0),(4,'','','Ballintine','1841-01-01','1885-01-01','This was the Ballintine Family Plot',0);
/*!40000 ALTER TABLE `Grave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Group`
--

DROP TABLE IF EXISTS `Group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Group` (
  `idGroup` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` blob,
  PRIMARY KEY (`idGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Group`
--

LOCK TABLES `Group` WRITE;
/*!40000 ALTER TABLE `Group` DISABLE KEYS */;
/*!40000 ALTER TABLE `Group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HistoricFilter`
--

DROP TABLE IF EXISTS `HistoricFilter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HistoricFilter` (
  `idHistoricFilter` int(11) NOT NULL AUTO_INCREMENT,
  `historicFilterName` varchar(100) DEFAULT NULL,
  `dateStart` date DEFAULT NULL,
  `dateEnd` date DEFAULT NULL,
  `description` blob,
  `buttonColor` varchar(45) DEFAULT '#bdc3c7',
  PRIMARY KEY (`idHistoricFilter`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HistoricFilter`
--

LOCK TABLES `HistoricFilter` WRITE;
/*!40000 ALTER TABLE `HistoricFilter` DISABLE KEYS */;
INSERT INTO `HistoricFilter` VALUES (0,'No Historic Filter','','','No Historic Filter','#bdc3c7'),(1,'Civil War','1861-04-12','1865-05-13','The American Civil War was a civil war that was fought in the United States from 1861 to 1865. War broke out as a result of the long-standing controversy over slavery.','#bdc3c7'),(2,'American Revolutionary War','1775-04-19','1783-09-03','This was also known as the American War of Independence. This was a global war that began as a conflict between Great Britain and it\'s Thirteen Colonies which declared independence as the United States of America.','#bdc3c7'),(3,'War of 1812','1812-06-18','1815-02-15','The War of 1812 was a conflict fought between the United States, the United Kingdom, and their respective allies.','#bdc3c7'),(4,'Spanish-American War','1898-04-21','1898-07-17','The Spanish-American War was fought between the United States and Spain in 1898. Hostilities began in the aftermath of the internal explosion of the USS Maine in Cuba, leading to U.S. intervention in the Cuban War of Independence.','#bdc3c7');
/*!40000 ALTER TABLE `HistoricFilter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MiscObject`
--

DROP TABLE IF EXISTS `MiscObject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MiscObject` (
  `idMisc` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `description` blob,
  `isHazard` enum('Yes','No') NOT NULL,
  PRIMARY KEY (`idMisc`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MiscObject`
--

LOCK TABLES `MiscObject` WRITE;
/*!40000 ALTER TABLE `MiscObject` DISABLE KEYS */;
INSERT INTO `MiscObject` VALUES (1,'Amphitheater seating','The amphitheater is used for events at the cemetery','No');
/*!40000 ALTER TABLE `MiscObject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NaturalHistory`
--

DROP TABLE IF EXISTS `NaturalHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NaturalHistory` (
  `idNaturalHistory` int(11) NOT NULL AUTO_INCREMENT,
  `commonName` varchar(100) DEFAULT NULL,
  `scientificName` varchar(150) DEFAULT NULL,
  `description` blob,
  PRIMARY KEY (`idNaturalHistory`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NaturalHistory`
--

LOCK TABLES `NaturalHistory` WRITE;
/*!40000 ALTER TABLE `NaturalHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `NaturalHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TrackableObject`
--

DROP TABLE IF EXISTS `TrackableObject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TrackableObject` (
  `idTrackableObject` int(11) NOT NULL AUTO_INCREMENT,
  `longitude` decimal(9,6) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `qrCode` varchar(45) DEFAULT NULL,
  `hint` varchar(100) DEFAULT NULL,
  `imageDescription` varchar(100) DEFAULT NULL,
  `imageLocation` varchar(5000) DEFAULT '/images/pins/default.png',
  `idTypeFilter` int(11) NOT NULL,
  `idGrave` int(11) DEFAULT NULL,
  `idNaturalHistory` int(11) DEFAULT NULL,
  `idMisc` int(11) DEFAULT NULL,
  `idGroup` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTrackableObject`,`idTypeFilter`),
  KEY `fk_TrackableObject_TypeFilter1_idx` (`idTypeFilter`),
  KEY `fk_TrackableObject_GraveDetail1_idx` (`idGrave`),
  KEY `fk_TrackableObject_VegetationDetail1_idx` (`idNaturalHistory`),
  KEY `fk_TrackableObject_MiscDetail1_idx` (`idMisc`),
  KEY `fk_TrackableObject_PlotDetail1_idx` (`idGroup`),
  CONSTRAINT `fk_TrackableObject_TypeFilter1` FOREIGN KEY (`idTypeFilter`) REFERENCES `TypeFilter` (`idTypeFilter`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_GraveDetail1` FOREIGN KEY (`idGrave`) REFERENCES `Grave` (`idGrave`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_VegetationDetail1` FOREIGN KEY (`idNaturalHistory`) REFERENCES `NaturalHistory` (`idNaturalHistory`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_MiscDetail1` FOREIGN KEY (`idMisc`) REFERENCES `MiscObject` (`idMisc`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_PlotDetail1` FOREIGN KEY (`idGroup`) REFERENCES `Group` (`idGroup`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrackableObject`
--

LOCK TABLES `TrackableObject` WRITE;
/*!40000 ALTER TABLE `TrackableObject` DISABLE KEYS */;
INSERT INTO `TrackableObject` VALUES (1,43.129581,-77.638892,'qrCode','This is where people will sit for the Amphitheater','Image of the Amphitheater Seating','/images/pins/amp.jpeg',3,NULL,NULL,1,NULL),(2,43.129361,-77.639027,'qrCode',NULL,'Image of McGuckin\'s tombstone','/images/pins/mcguckin.jpeg',1,1,NULL,NULL,NULL),(3,43.129387,-77.639330,'qrCode',NULL,'Image is of the Oakley hotel','/images/pins/oakleyhotel.jpeg',1,2,NULL,NULL,NULL),(4,43.129301,-77.639521,'qrCode',NULL,'Image of Potter\'s Field', '/images/pins/potters.jpeg',1,3,NULL,NULL,NULL),(5,43.129356,-77.638774,'qrCode',NULL,'Image of the Ballintine\'s family plot','/images/pins/ballintine_family.jpeg',1,4,NULL,NULL,NULL);
/*!40000 ALTER TABLE `TrackableObject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TypeFilter`
--

DROP TABLE IF EXISTS `TypeFilter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TypeFilter` (
  `idTypeFilter` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `pinDesign` varchar(500) DEFAULT 'images/pins/orangeMarker.png' NOT NULL,
  `buttonColor` varchar(45) DEFAULT '#bdc3c7',
  PRIMARY KEY (`idTypeFilter`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TypeFilter`
--

LOCK TABLES `TypeFilter` WRITE;
/*!40000 ALTER TABLE `TypeFilter` DISABLE KEYS */;
INSERT INTO `TypeFilter` VALUES (1,'Grave','images/pins/blueMarker.png','#6991FD'),(2,'Natural History','images/pins/greenMarker.png','#00E54C'),(3,'Miscellaneous','images/pins/purpleMarker.png','#8E67FD'), (4,'Hazard','images/pins/redMarker.png','#FD7567');
/*!40000 ALTER TABLE `TypeFilter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(80) DEFAULT NULL,
  `lastName` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (6,'Admin','User','admin@admin.com','d033e22ae348aeb5660fc2140aec35850c4da997');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WiderAreaMap`
--

DROP TABLE IF EXISTS `WiderAreaMap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WiderAreaMap` (
  `idWiderAreaMap` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` blob,
  `url` varchar(2083) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  PRIMARY KEY (`idWiderAreaMap`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WiderAreaMap`
--

LOCK TABLES `WiderAreaMap` WRITE;
/*!40000 ALTER TABLE `WiderAreaMap` DISABLE KEYS */;
/*!40000 ALTER TABLE `WiderAreaMap` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-15 16:06:33
