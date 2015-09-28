-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: labmgr
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `machine`
--

DROP TABLE IF EXISTS `machine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `machine` (
  `machine_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `seat` varchar(45) DEFAULT NULL,
  `mac_address` varchar(45) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `operating_system` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `torrent_client_id` int(11) DEFAULT NULL,
  `transport_type` varchar(45) DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`machine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machine`
--

LOCK TABLES `machine` WRITE;
/*!40000 ALTER TABLE `machine` DISABLE KEYS */;
INSERT INTO `machine` VALUES (4,3,'6','2345243','192.168.15.106','Windows 7','administrator','web1sphere',1,'ssh','2015-09-22 22:19:38','2015-09-24 00:13:08'),(5,3,'','','192.168.15.107','','','',1,'','2015-09-22 22:19:45','2015-09-24 00:11:33'),(6,3,'','','192.168.15.108','','','',1,'','2015-09-22 22:19:50','2015-09-24 00:11:39'),(7,3,'','','192.168.15.109','','','',1,'','2015-09-22 22:19:56','2015-09-24 00:11:46'),(10,3,'5','','192.168.15.105','Windows 7','administrator','web1sphere',1,'','2015-09-23 23:34:48','2015-09-24 00:11:17'),(11,1,'45','','192.168.15.190','Windows 7','','',1,'','2015-09-24 20:14:28',NULL),(12,3,'','','192.168.15.103','Windows 7','','',1,'','2015-09-24 21:28:04',NULL);
/*!40000 ALTER TABLE `machine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration` (
  `registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_id` int(11) DEFAULT NULL,
  `torrent_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `vm_id` int(11) DEFAULT NULL,
  `script_id` int(11) DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`registration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration`
--

LOCK TABLES `registration` WRITE;
/*!40000 ALTER TABLE `registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,'H100','Raleigh Lab Main Room','2015-09-22 18:05:14','2015-09-23 19:24:37'),(3,'Q Branch','Q Branch Lab inside H100','2015-09-24 00:10:23',NULL);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `script`
--

DROP TABLE IF EXISTS `script`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `script` (
  `script_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `path` varchar(100) DEFAULT NULL,
  `parameter` varchar(45) DEFAULT NULL,
  `os` varchar(45) DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`script_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `script`
--

LOCK TABLES `script` WRITE;
/*!40000 ALTER TABLE `script` DISABLE KEYS */;
INSERT INTO `script` VALUES (1,'Test','Test script','/home/robert/test.sh','','Linux','2015-09-23 22:35:37',NULL);
/*!40000 ALTER TABLE `script` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torrent`
--

DROP TABLE IF EXISTS `torrent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `torrent` (
  `torrent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`torrent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torrent`
--

LOCK TABLES `torrent` WRITE;
/*!40000 ALTER TABLE `torrent` DISABLE KEYS */;
INSERT INTO `torrent` VALUES (1,'Ubuntu_64-bit.52.torrent',NULL,'/home/robert/labmgr/uploads/Ubuntu_64-bit.52.torrent','2015-09-23 16:44:45',NULL),(3,'Ubuntu_64-bit.53.torrent',NULL,'/home/robert/labmgr/uploads/Ubuntu_64-bit.53.torrent','2015-09-24 19:47:45',NULL),(5,'AL2.torrent',NULL,'/home/robert/labmgr/uploads/AL2.torrent','2015-09-24 21:17:44',NULL),(6,'AL3.torrent',NULL,'/home/robert/labmgr/uploads/AL3.torrent','2015-09-24 21:17:49',NULL),(7,'AL4.torrent',NULL,'/home/robert/labmgr/uploads/AL4.torrent','2015-09-24 21:17:58',NULL),(8,'AL5.torrent',NULL,'/home/robert/labmgr/uploads/AL5.torrent','2015-09-24 21:18:02',NULL),(9,'AL12.torrent','1EA36AFEB77DF013AC80F03243761FD4773ED128','/home/robert/labmgr/uploads/AL12.torrent','2015-09-25 00:21:45',NULL),(10,'Ubuntu_64-bit.54.torrent','3798819A90FE09CA7B0F515A76E3CFDF7EB0D9CA','/home/robert/labmgr/uploads/Ubuntu_64-bit.54.torrent','2015-09-25 02:37:37',NULL);
/*!40000 ALTER TABLE `torrent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torrent_client`
--

DROP TABLE IF EXISTS `torrent_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `torrent_client` (
  `torrent_client_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`torrent_client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torrent_client`
--

LOCK TABLES `torrent_client` WRITE;
/*!40000 ALTER TABLE `torrent_client` DISABLE KEYS */;
INSERT INTO `torrent_client` VALUES (1,'uTorrent','sdfgdfg','2015-09-23 15:42:49','2015-09-23 15:45:43');
/*!40000 ALTER TABLE `torrent_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vm`
--

DROP TABLE IF EXISTS `vm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vm` (
  `vm_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `hypervisor` varchar(45) DEFAULT NULL,
  `snapshot` varchar(100) DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vm`
--

LOCK TABLES `vm` WRITE;
/*!40000 ALTER TABLE `vm` DISABLE KEYS */;
/*!40000 ALTER TABLE `vm` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-28 14:12:05
