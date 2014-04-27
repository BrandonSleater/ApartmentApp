CREATE DATABASE  IF NOT EXISTS `selenium` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `selenium`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: selenium
-- ------------------------------------------------------
-- Server version	5.6.14-log

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
-- Table structure for table `apartment`
--

DROP TABLE IF EXISTS `apartment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apartment` (
  `apart_pk` int(11) NOT NULL AUTO_INCREMENT,
  `build_fk` int(11) DEFAULT NULL,
  `story` int(11) DEFAULT NULL,
  `floorplan` enum('studio','1Bed','2Bed') DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `has_internet` int(11) DEFAULT NULL,
  `has_microwave` int(11) DEFAULT NULL,
  `has_patio` int(11) DEFAULT NULL,
  `has_dishwasher` int(11) DEFAULT NULL,
  `has_washdry` int(11) DEFAULT NULL,
  PRIMARY KEY (`apart_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apartment`
--

LOCK TABLES `apartment` WRITE;
/*!40000 ALTER TABLE `apartment` DISABLE KEYS */;
INSERT INTO `apartment` VALUES (1,1,1,'studio',1,500,0,1,0,0,1),(2,2,2,'1Bed',1,700,0,1,0,1,0),(3,3,3,'2Bed',1,900,1,1,1,1,1),(4,1,1,'studio',1,550,1,0,1,0,0),(5,2,1,'studio',1,625,0,1,0,1,1),(6,1,2,'1Bed',1,720,1,0,1,1,0),(7,1,2,'2Bed',1,850,1,1,0,0,1),(8,3,2,'2Bed',1,990,1,1,1,1,0),(9,1,1,'1Bed',1,760,0,0,1,1,1),(10,1,3,'studio',1,590,0,1,0,0,0),(11,3,3,'studio',1,600,1,1,0,1,0),(12,3,1,'2Bed',1,800,1,1,1,0,1),(13,3,1,'1Bed',1,600,1,0,0,1,0),(14,1,3,'1Bed',1,730,1,0,1,0,1),(15,2,1,'2Bed',1,910,0,1,1,1,0);
/*!40000 ALTER TABLE `apartment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `building` (
  `build_pk` int(11) NOT NULL AUTO_INCREMENT,
  `build_name` varchar(45) DEFAULT NULL,
  `build_address` varchar(45) DEFAULT NULL,
  `build_landlord` varchar(45) DEFAULT NULL,
  `build_city` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`build_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `building`
--

LOCK TABLES `building` WRITE;
/*!40000 ALTER TABLE `building` DISABLE KEYS */;
INSERT INTO `building` VALUES (1,'North','1192 N. Sunset Blvd.','Paco Archman','Gilbert'),(2,'East','9234 E. Rector St.','Benji Gentoo','Chandler'),(3,'West','246 W. Alma Ct.','Linus Torvec','Mesa');
/*!40000 ALTER TABLE `building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlord`
--

DROP TABLE IF EXISTS `landlord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlord` (
  `ll_pk` int(11) NOT NULL AUTO_INCREMENT,
  `ll_name` varchar(45) DEFAULT NULL,
  `ll_salary` float DEFAULT NULL,
  `ll_gender` enum('male','female') DEFAULT NULL,
  `ll_dob` datetime DEFAULT NULL,
  PRIMARY KEY (`ll_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlord`
--

LOCK TABLES `landlord` WRITE;
/*!40000 ALTER TABLE `landlord` DISABLE KEYS */;
/*!40000 ALTER TABLE `landlord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance` (
  `main_pk` int(11) NOT NULL AUTO_INCREMENT,
  `main_cost` float DEFAULT NULL,
  `main_type` varchar(45) DEFAULT NULL,
  `main_start_date` datetime DEFAULT NULL,
  `main_end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`main_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance`
--

LOCK TABLES `maintenance` WRITE;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `pay_pk` int(11) NOT NULL AUTO_INCREMENT,
  `pay_type` varchar(45) DEFAULT NULL,
  `pay_date` datetime DEFAULT NULL,
  `pay_processed` binary(1) DEFAULT NULL,
  PRIMARY KEY (`pay_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenant`
--

DROP TABLE IF EXISTS `tenant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenant` (
  `tena_pk` int(11) NOT NULL AUTO_INCREMENT,
  `tena_name` varchar(45) DEFAULT NULL,
  `tena_age` int(11) DEFAULT NULL,
  `tena_sex` enum('male','female') DEFAULT NULL,
  `tena_ssn` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`tena_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenant`
--

LOCK TABLES `tenant` WRITE;
/*!40000 ALTER TABLE `tenant` DISABLE KEYS */;
/*!40000 ALTER TABLE `tenant` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-27 12:19:56
