CREATE DATABASE  IF NOT EXISTS `RapidsCemetery` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `RapidsCemetery`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: RapidsCemetery
-- ------------------------------------------------------
-- Server version	5.1.73

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
  `idContact` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `description` blob,
  `phone` varchar(80) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idContact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contact`
--

LOCK TABLES `Contact` WRITE;
/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
INSERT INTO `Contact` VALUES (1,'Test Human','test@human.com','I am a test human.','750285028','title'),(2,'Test Person','test@person.com','I am a test person.','750285020','title');
/*!40000 ALTER TABLE `Contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Event`
--

DROP TABLE IF EXISTS `Event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Event` (
  `idEvent` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` blob,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `idWiderAreaMap` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `fk_Event_WiderAreaMap1_idx` (`idWiderAreaMap`),
  CONSTRAINT `fk_Event_WiderAreaMap1` FOREIGN KEY (`idWiderAreaMap`) REFERENCES `WiderAreaMap` (`idWiderAreaMap`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Event`
--

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;
INSERT INTO `Event` VALUES (1,'Spring Festival Picnic','The Spring Festival Picnic is a tradition we have where we have people enjoy the day with others','9999-12-31 23:59:59','9999-12-31 23:59:59',2);
/*!40000 ALTER TABLE `Event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FAQ`
--

DROP TABLE IF EXISTS `FAQ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FAQ` (
  `idFAQ` int(11) NOT NULL,
  `question` varchar(300) DEFAULT NULL,
  `answer` blob,
  PRIMARY KEY (`idFAQ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FAQ`
--

LOCK TABLES `FAQ` WRITE;
/*!40000 ALTER TABLE `FAQ` DISABLE KEYS */;
INSERT INTO `FAQ` VALUES (1,'How do I ask a question on this?',' I don\'t know how do I get an anwser.'),(2,'What do I need to remember to escape?','Apsotophes can be an issue at times');
/*!40000 ALTER TABLE `FAQ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Grave`
--

DROP TABLE IF EXISTS `Grave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Grave` (
  `idGrave` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grave`
--

LOCK TABLES `Grave` WRITE;
/*!40000 ALTER TABLE `Grave` DISABLE KEYS */;
INSERT INTO `Grave` VALUES (1,'Spongebob','Something','Squarepants','1962-02-21','1989-02-21','he lived in a pineapple under the sea',2),(2,'Squidward','Something','Nopants','1755-02-23','1777-12-02','smallest grave in the cemetery',1),(3,'Patrick','Something','Star','1845-11-11','1869-01-14','A pair of graves near the vegetation',2);
/*!40000 ALTER TABLE `Grave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Group`
--

DROP TABLE IF EXISTS `Group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Group` (
  `idGroup` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` blob,
  PRIMARY KEY (`idGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Group`
--

LOCK TABLES `Group` WRITE;
/*!40000 ALTER TABLE `Group` DISABLE KEYS */;
INSERT INTO `Group` VALUES (1,'Doctor Lady','Big grave that show the doctor lady'),(2,'Oakley Family','Oakley family is here. Not the sun glasses people.'),(3,'Ballintine Family','The had a lot of sick children');
/*!40000 ALTER TABLE `Group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HistoricFilter`
--

DROP TABLE IF EXISTS `HistoricFilter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HistoricFilter` (
  `idHistoricFilter` int(11) NOT NULL,
  `historicFilterName` varchar(100) DEFAULT NULL,
  `dateStart` date DEFAULT NULL,
  `dateEnd` date DEFAULT NULL,
  `description` blob,
  `buttonColor` varchar(45) DEFAULT '#bdc3c7',
  PRIMARY KEY (`idHistoricFilter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HistoricFilter`
--

LOCK TABLES `HistoricFilter` WRITE;
/*!40000 ALTER TABLE `HistoricFilter` DISABLE KEYS */;
INSERT INTO `HistoricFilter` VALUES (1,'Civil War','1861-04-12','1865-05-13','The civil was fought in the US over slavery','#bdc3c7'),(2,'American Revolutionary War','1775-04-19','1783-09-03','This was was also known as the american war of independence','#bdc3c7');
/*!40000 ALTER TABLE `HistoricFilter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MiscObject`
--

DROP TABLE IF EXISTS `MiscObject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MiscObject` (
  `idMisc` int(11) NOT NULL,
  `name` varchar(75) DEFAULT NULL,
  `description` blob,
  `isHazard` enum('Yes','No') NOT NULL,
  PRIMARY KEY (`idMisc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MiscObject`
--

LOCK TABLES `MiscObject` WRITE;
/*!40000 ALTER TABLE `MiscObject` DISABLE KEYS */;
INSERT INTO `MiscObject` VALUES (1,'Bee Hive','Oh boy, don\'t get stunnggg','No'),(2,'Random Hole','Disclaimer: There is a hole around this area. Now you cant sue','Yes');
/*!40000 ALTER TABLE `MiscObject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NaturalHistory`
--

DROP TABLE IF EXISTS `NaturalHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NaturalHistory` (
  `idNaturalHistory` int(11) NOT NULL,
  `commonName` varchar(100) DEFAULT NULL,
  `scientificName` varchar(150) DEFAULT NULL,
  `description` blob,
  PRIMARY KEY (`idNaturalHistory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NaturalHistory`
--

LOCK TABLES `NaturalHistory` WRITE;
/*!40000 ALTER TABLE `NaturalHistory` DISABLE KEYS */;
INSERT INTO `NaturalHistory` VALUES (1,'Forget-Me-Not','scientificName','grows on tall, hairy stems which reach two feet in height. Blue blooms with yellow centers'),(2,'Black Raspberries','scientificName','This plant is native to eastern North America. Black seeded looking fruit'),(3,'Walnut Trees','scientificName','These trees grow walnuts, a walnut is the seed of a drupe or drupaceous nut these fall from up high');
/*!40000 ALTER TABLE `NaturalHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TrackableObject`
--

DROP TABLE IF EXISTS `TrackableObject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TrackableObject` (
  `idTrackableObject` int(11) NOT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `qrCode` varchar(45) DEFAULT NULL,
  `hint` varchar(100) DEFAULT NULL,
  `imageDescription` varchar(100) DEFAULT NULL,
  `imageLocation` varchar(5000) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrackableObject`
--

LOCK TABLES `TrackableObject` WRITE;
/*!40000 ALTER TABLE `TrackableObject` DISABLE KEYS */;
INSERT INTO `TrackableObject` VALUES (1,43.129362,-77.639403,'qrCode','He was #1','imageDescription','imageLocation',1,1,NULL,NULL,3),(2,43.129434,-77.639395,'qrCode','He was always angry','imageDescription','imageLocation',1,2,NULL,NULL,2),(3,43.129518,-77.639398,'qrCode','I guess Ill eat it know.','imageDescription','imageLocation',1,3,NULL,NULL,3),(4,43.129539,-77.639636,'qrCode','Look at allllll those flowerrss','imageDescription','imageLocation',2,NULL,1,NULL,2),(5,43.129545,-77.639701,'qrCode','Look at allllll those treessss','imageDescription','imageLocation',2,NULL,2,NULL,2),(6,43.129607,-77.639348,'qrCode','Look at allllll thattt grassss','imageDescription','imageLocation',2,NULL,3,NULL,2),(7,43.129617,-77.638936,'qrCode','3','imageDescription','imageLocation',2,NULL,NULL,2,1),(8,43.129617,-77.639403,'qrCode','3','imageDescription','imageLocation',1,NULL,NULL,1,2);
/*!40000 ALTER TABLE `TrackableObject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TypeFilter`
--

DROP TABLE IF EXISTS `TypeFilter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TypeFilter` (
  `idTypeFilter` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `pinDesign` varchar(500) DEFAULT NULL,
  `buttonColor` varchar(45) DEFAULT '#bdc3c7',
  PRIMARY KEY (`idTypeFilter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TypeFilter`
--

LOCK TABLES `TypeFilter` WRITE;
/*!40000 ALTER TABLE `TypeFilter` DISABLE KEYS */;
INSERT INTO `TypeFilter` VALUES (1,'Grave','http://maps.google.com/mapfiles/ms/icons/blue-dot.png','#6991FD'),(2,'Natural History','http://maps.google.com/mapfiles/ms/icons/green-dot.png','#00E54C'),(3,'Miscellaneous','http://maps.google.com/mapfiles/ms/icons/purple-dot.png','#bdc3c7');
/*!40000 ALTER TABLE `TypeFilter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `idUser` int(11) NOT NULL,
  `firstName` varchar(80) DEFAULT NULL,
  `lastName` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Brianna','Jones','bfj5889@g.rit.edu','hashedPWD'),(2,'Cole','Johnson','cj3421@g.rit.edu','hashedPWD'),(3,'Daniel','Quackenbush','dqvcdsv9@g.rit.edu','hashedPWD'),(4,'Test','Test','test@gmail.com','test');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WiderAreaMap`
--

DROP TABLE IF EXISTS `WiderAreaMap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WiderAreaMap` (
  `idWiderAreaMap` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WiderAreaMap`
--

LOCK TABLES `WiderAreaMap` WRITE;
/*!40000 ALTER TABLE `WiderAreaMap` DISABLE KEYS */;
INSERT INTO `WiderAreaMap` VALUES (1,'Susan B Anthony Home','Home girl lived here','www.google.com',43.153200,77.628100,'17 Madison St, Rochester','Rochester','NY',14608),(2,'Fredick Duglass Home','Home boy lived here','www.google.com',43.128700,77.620700,'1133 Mt Hope Ave, Rochester','Rochester','NY',14620),(3,'Highland Park','People run here','www.google.com',43.128700,77.620700,'180 Reservoir Ave, Rochester','Rochester','NY',14620);
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

-- Dump completed on 2018-02-20 20:26:56
