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
-- Table structure for table `conference`
--

DROP TABLE IF EXISTS `conference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conference` (
  `conference_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`conference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conference`
--

LOCK TABLES `conference` WRITE;
/*!40000 ALTER TABLE `conference` DISABLE KEYS */;
INSERT INTO `conference` VALUES (1,'InterConnect 2016','Get the most out of your existing investments with hands-on training in cloud and mobile solutions built for security, powered by cognitive, and equipped with advanced analytics. Start by designing and building a truly cognitive, customer-driven digital enterprise. Outthink any limits and transform your business at InterConnect 2016.',NULL,'2016-02-13 21:55:28');
/*!40000 ALTER TABLE `conference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `machine`
--

DROP TABLE IF EXISTS `machine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `machine` (
  `machine_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL,
  `mac_address` varchar(45) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `os_id` int(11) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `torrent_client_id` int(11) DEFAULT NULL,
  `transport_type` varchar(45) DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`machine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machine`
--

LOCK TABLES `machine` WRITE;
/*!40000 ALTER TABLE `machine` DISABLE KEYS */;
INSERT INTO `machine` VALUES (53,2,1,'54:ee:75:65:3e:61','9.44.159.103',1,'admin','web1sphere',1,'SSH','2016-02-23 19:29:32','2016-04-06 21:01:32'),(54,2,2,'Unable to get MAC Address.','9.44.159.105',1,'admin','web1sphere',1,'SSH','2016-03-24 14:16:25',NULL),(55,2,2,'Unable to get MAC Address.','9.44.159.108',1,'admin','web1sphere',1,'SSH','2016-03-24 14:30:32','2016-04-06 20:55:43'),(56,2,4,'38:c9:86:26:25:2b','172.16.32.17',1,'admin','web1sphere',1,'SSH','2016-03-24 14:40:16','2016-04-04 21:00:34'),(57,2,5,'Unable to get MAC Address.','9.44.159.87',1,'admin','web1sphere',1,'SSH','2016-03-24 18:37:54',NULL),(58,3,1,'5c:c5:d4:a5:1a:9f','192.168.0.20',2,'admin','web1sphere',1,'SSH','2016-04-01 19:38:41','2016-04-01 19:46:06'),(59,3,2,'60:f8:1d:c1:f9:58','192.168.0.19',3,'admin','web1sphere',1,'SSH','2016-04-01 19:39:15','2016-04-01 19:46:35'),(60,4,1,'ac:87:a3:1b:bf:10','172.16.32.12',3,'admin','web1sphere',1,'SSH','2016-04-04 17:47:02',NULL),(61,4,2,'0c:4d:e9:cb:71:24','172.16.32.13',3,'admin','web1sphere',1,'SSH','2016-04-04 17:47:42',NULL),(62,2,6,'54:ee:75:42:f9:1b','172.16.32.11',1,'admin','web1sphere',1,'SSH','2016-04-04 20:03:29',NULL),(63,2,7,'54:ee:75:42:f8:97','172.16.32.10',1,'admin','web1sphere',1,'SSH','2016-04-04 20:04:01',NULL),(64,2,8,'54:ee:75:0f:17:c3','172.16.32.9',1,'admin','web1sphere',1,'SSH','2016-04-04 20:04:31',NULL),(65,2,9,'54:ee:75:0b:a8:0f','172.16.32.8',1,'admin','web1sphere',1,'SSH','2016-04-04 20:05:05','2016-04-06 18:45:29'),(66,2,10,'54:ee:75:0f:18:e1','172.16.32.2',1,'admin','web1sphere',1,'SSH','2016-04-04 20:06:19',NULL),(67,2,10,'54:ee:75:0f:17:85','172.16.32.3',1,'admin','web1sphere',1,'SSH','2016-04-04 20:07:33',NULL),(68,2,10,'54:ee:75:42:f7:02','172.16.32.6',1,'admin','web1sphere',1,'SSH','2016-04-04 20:08:23','2016-04-06 18:54:50'),(69,2,10,'54:ee:75:0f:19:16','172.16.32.7',1,'admin','web1sphere',1,'SSH','2016-04-04 20:08:49','2016-04-06 18:54:50'),(70,4,3,'ac:87:a3:1b:bf:10','172.16.32.12',3,'admin','web1sphere',1,'SSH','2016-04-05 18:40:28','2016-04-05 21:43:59'),(72,4,5,'38:c9:86:14:3a:9f','172.16.32.14',3,'admin','web1sphere',1,'SSH','2016-04-05 18:41:49','2016-04-05 21:43:59');
/*!40000 ALTER TABLE `machine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `os`
--

DROP TABLE IF EXISTS `os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `os` (
  `os_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`os_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `os`
--

LOCK TABLES `os` WRITE;
/*!40000 ALTER TABLE `os` DISABLE KEYS */;
INSERT INTO `os` VALUES (1,'Windows 7 ','Microsoft Windows 7 corporate license','2015-11-13 18:05:40',NULL),(2,'Ubuntu Linux','Ubuntu 14.04','2016-04-01 19:42:56',NULL),(3,'Mac OS X','El Capitan 10.11.3','2016-04-01 19:43:43',NULL);
/*!40000 ALTER TABLE `os` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,'Test 1','','2016-02-19 23:57:23',NULL),(2,'302','Scheduled Lab room 302','2016-02-23 19:29:13',NULL),(3,'Wake Forest Lab','','2016-04-01 19:38:01',NULL),(4,'ICT Lab - Macs','','2016-04-04 17:46:35',NULL),(5,'888','','2016-04-06 18:25:00',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `script`
--

LOCK TABLES `script` WRITE;
/*!40000 ALTER TABLE `script` DISABLE KEYS */;
INSERT INTO `script` VALUES (1,'Test','Test script','/home/robert/test.sh','test','Linux','2015-09-23 22:35:37','2015-10-08 18:54:35');
/*!40000 ALTER TABLE `script` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server`
--

DROP TABLE IF EXISTS `server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server` (
  `server_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server`
--

LOCK TABLES `server` WRITE;
/*!40000 ALTER TABLE `server` DISABLE KEYS */;
INSERT INTO `server` VALUES (1,'Server 1 ','asdfjlasdf','2016-02-13 22:11:22',NULL);
/*!40000 ALTER TABLE `server` ENABLE KEYS */;
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
  `torrent_file` blob,
  `torrent_version` int(11) DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`torrent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torrent`
--

LOCK TABLES `torrent` WRITE;
/*!40000 ALTER TABLE `torrent` DISABLE KEYS */;
INSERT INTO `torrent` VALUES (4,'A114','25FC990845388AC5435926E1879F4BD3CD130D28','/home/robert/labmgr/uploads/A114.torrent',NULL,NULL,'2015-10-23 21:14:14',NULL),(5,'A178','27D45CA533AA8AE133331A99CF5E60030D7794F9','/home/robert/labmgr/uploads/A178.torrent',NULL,NULL,'2015-10-23 21:14:33',NULL),(7,'A180','C9C5ED3B71FF7B213687F03E57DD078D5825E305','/home/robert/labmgr/uploads/A180.torrent',NULL,NULL,'2015-10-23 21:15:20',NULL),(8,'A226','FC29083C145CEB46DBDAFA37FCB6A355A4D8AEEA','/home/robert/labmgr/uploads/A226.torrent',NULL,NULL,'2015-10-23 21:15:26',NULL),(9,'A230','25E348913F47C56380CEEE5BB284250E7217EB98','/home/robert/labmgr/uploads/A230.torrent',NULL,NULL,'2015-10-23 21:15:46',NULL),(10,'A248','B47B6155864BBFC651CC5C0889E9ECDEB781EBFE','/home/robert/labmgr/uploads/A248.torrent',NULL,NULL,'2015-10-23 21:15:55',NULL),(11,'A298','E0E4082967DA18E67DEBB87983EDD765C88E16A0','/home/robert/labmgr/uploads/A298.torrent',NULL,NULL,'2015-10-23 21:16:52',NULL),(12,'A377','8EC0CE8892909FCF4984EB35DCA879DD252D4AFA','/home/robert/labmgr/uploads/A377.torrent',NULL,NULL,'2015-10-23 21:16:59',NULL),(13,'C20','9565055EBA6B81AF82C896BD830254A8336B046F','/home/robert/labmgr/uploads/C20.torrent',NULL,NULL,'2015-10-23 21:17:11',NULL),(14,'C136','EA2F44D8DE9C1C4DCC86608D178311753865A648','/home/robert/labmgr/uploads/C136.torrent',NULL,NULL,'2015-10-23 21:17:15',NULL),(15,'C208','A9D6F049A73B055505334A9211875F8DD4FD9EA3','/home/robert/labmgr/uploads/C208.torrent',NULL,NULL,'2015-10-23 21:17:23',NULL),(16,'C278','B4C5C481DE3A268391E2D35DAD9276ED4869FE9F','/home/robert/labmgr/uploads/C278.torrent',NULL,NULL,'2015-10-23 21:17:34',NULL),(17,'C279','474D70BAE28AA03835FC00967A2C19BFD03E2D37','/home/robert/labmgr/uploads/C279.torrent',NULL,NULL,'2015-10-23 21:17:41',NULL),(18,'C344','D385224B46BE317B12E4AD402555EF21FE8FE03A','/home/robert/labmgr/uploads/C344.torrent',NULL,NULL,'2015-10-23 21:17:47',NULL),(19,'I97','2B54E243F0CEE8943F724C69624D00B3879C0EA2','/home/robert/labmgr/uploads/I97.torrent',NULL,NULL,'2015-10-23 21:17:59',NULL),(20,'I295','72A8DA2ED79E86256D89A1FDAC99B67D23E4F82A','/home/robert/labmgr/uploads/I295.torrent',NULL,NULL,'2015-10-23 21:18:06',NULL),(21,'I326','C25F36602B0C4AC1E8EF7177BED25CD293117EF5','/home/robert/labmgr/uploads/I326.torrent',NULL,NULL,'2015-10-23 21:18:18',NULL),(22,'I329','AA9B20FE9866971CAB5C1A4DD69F28D3037D9FF3','/home/robert/labmgr/uploads/I329.torrent',NULL,NULL,'2015-10-23 21:18:58',NULL),(23,'M238','21FFC177E1A9F339D44C5CF57E06FCEC5C2AF3BF','/home/robert/labmgr/uploads/M238.torrent',NULL,NULL,'2015-10-23 21:19:06',NULL),(24,'M239','143C0766455D590F839CBEB3ECB714788D756727','/home/robert/labmgr/uploads/M239.torrent',NULL,NULL,'2015-10-23 21:19:12',NULL),(25,'I330','63210683F7BAE6144704912502F3B678E98AD568','/home/robert/labmgr/uploads/I330.torrent',NULL,NULL,'2015-10-23 21:38:54',NULL),(26,'I331','3A27C5343B1D615B363B938DE51629761AF57921','/home/robert/labmgr/uploads/I331.torrent',NULL,NULL,'2015-10-23 21:39:04',NULL),(27,'S148','7896CC3A107F42A04E61C5010F0AE37DE27BCCA5','/home/robert/labmgr/uploads/S148.torrent',NULL,NULL,'2015-10-23 21:43:17',NULL),(28,'S349','54FBF9941947DBFFEB7670DFA5CDE00E7FC3F203','/home/robert/labmgr/uploads/S349.torrent',NULL,NULL,'2015-10-23 21:43:25',NULL),(29,'S351','BF1C05E1A7BBB6533F69CA665E69212B591E09E6','/home/robert/labmgr/uploads/S351.torrent',NULL,NULL,'2015-10-23 21:43:37',NULL),(30,'Z1','828877D6EA32BCF3E81AA3CCFAFDFBDDC9707497','/home/robert/labmgr/uploads/Z1.torrent',NULL,NULL,'2015-10-24 23:23:31',NULL),(31,'A001','CE36DFD72EE7C6CC3B9AE6DF25FD7C41E0C3E180','/home/robert/labmgr/uploads/A001.torrent',NULL,NULL,'2015-10-25 00:00:00',NULL),(32,'AL81','2F49122D80C85C7D637CC70FD42F9FF38FA1E68C','/home/robert/labmgr/uploads/AL81.torrent','AL81.torrent',NULL,'2015-10-30 19:43:18',NULL),(35,'A1796','670C264009195BCAD61F8637E914E965AD3EA4C1','/home/robert/labmgr/uploads/A1796.torrent','d10:created by14:uTorrent/3.4.513:creation datei1447172793e8:encoding5:UTF-84:infod5:filesld6:lengthi950927360e4:pathl3:vm122:RHEL64-32bit-s001.vmdkeed6:lengthi774307840e4:pathl3:vm122:RHEL64-32bit-s016.vmdkeed6:lengthi748748800e4:pathl3:vm122:RHEL64-32bit-s006.vmdkeed6:lengthi362676224e4:pathl3:vm122:RHEL64-32bit-s002.vmdkeed6:lengthi323223552e4:pathl3:vm122:RHEL64-32bit-s017.vmdkeed6:lengthi250150912e4:pathl3:vm122:RHEL64-32bit-s020.vmdkeed6:lengthi247726080e4:pathl3:vm122:RHEL64-32bit-s012.vmdkeed6:lengthi246349824e4:pathl3:vm122:RHEL64-32bit-s018.vmdkeed6:lengthi182976512e4:pathl3:vm122:RHEL64-32bit-s007.vmdkeed6:lengthi163774464e4:pathl3:vm122:RHEL64-32bit-s022.vmdkeed6:lengthi159645696e4:pathl3:vm122:RHEL64-32bit-s010.vmdkeed6:lengthi159252480e4:pathl3:vm122:RHEL64-32bit-s019.vmdkeed6:lengthi159055872e4:pathl3:vm122:RHEL64-32bit-s021.vmdkeed6:lengthi138805248e4:pathl3:vm122:RHEL64-32bit-s013.vmdkeed6:lengthi100270080e4:pathl3:vm122:RHEL64-32bit-s025.vmdkeed6:lengthi78446592e4:pathl3:vm122:RHEL64-32bit-s009.vmdkeed6:lengthi77856768e4:pathl3:vm122:RHEL64-32bit-s024.vmdkeed6:lengthi75300864e4:pathl3:vm122:RHEL64-32bit-s008.vmdkeed6:lengthi60555264e4:pathl3:vm122:RHEL64-32bit-s011.vmdkeed6:lengthi58851328e4:pathl3:vm122:RHEL64-32bit-s015.vmdkeed6:lengthi27066368e4:pathl3:vm122:RHEL64-32bit-s023.vmdkeed6:lengthi27066368e4:pathl3:vm122:RHEL64-32bit-s004.vmdkeed6:lengthi7471104e4:pathl3:vm122:RHEL64-32bit-s014.vmdkeed6:lengthi2424832e4:pathl3:vm122:RHEL64-32bit-s026.vmdkeed6:lengthi1763366e4:pathl50:COPIES_19_ROOM-18__A179-lab-instructions_FINAL.PDFeed6:lengthi917504e4:pathl3:vm122:RHEL64-32bit-s027.vmdkeed6:lengthi655360e4:pathl3:vm122:RHEL64-32bit-s003.vmdkeed6:lengthi655360e4:pathl3:vm122:RHEL64-32bit-s005.vmdkeed6:lengthi393216e4:pathl3:vm122:RHEL64-32bit-s028.vmdkeed6:lengthi393216e4:pathl3:vm122:RHEL64-32bit-s029.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s030.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s007.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s028.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s008.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s029.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s027.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s024.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s026.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s006.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s016.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s018.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s017.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s025.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s009.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s005.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s015.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s023.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s022.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s019.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s003.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s002.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s014.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s001.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s013.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s012.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s021.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s011.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s010.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s020.vmdkeed6:lengthi327680e4:pathl3:vm129:RHEL64-32bit-000002-s004.vmdkeed6:lengthi327680e4:pathl3:vm122:RHEL64-32bit-s030.vmdkeed6:lengthi277979e4:pathl3:vm112:vmware-0.logeed6:lengthi239081e4:pathl3:vm112:vmware-1.logeed6:lengthi208343e4:pathl3:vm112:vmware-2.logeed6:lengthi196345e4:pathl3:vm110:vmware.logeed6:lengthi65536e4:pathl3:vm129:RHEL64-32bit-000002-s031.vmdkeed6:lengthi65536e4:pathl3:vm122:RHEL64-32bit-s031.vmdkeed6:lengthi28593e4:pathl3:vm127:RHEL64-32bit-Snapshot3.vmsneed6:lengthi8684e4:pathl3:vm118:RHEL64-32bit.nvrameed6:lengthi5635e4:pathl3:vm115:vprintproxy.logeed6:lengthi3117e4:pathl3:vm116:RHEL64-32bit.vmxeed6:lengthi3098e4:pathl3:vm117:vprintproxy-2.logeed6:lengthi2301e4:pathl3:vm117:vprintproxy-1.logeed6:lengthi2287e4:pathl3:vm117:vprintproxy-0.logeed6:lengthi2182e4:pathl3:vm117:RHEL64-32bit.vmdkeed6:lengthi1781e4:pathl3:vm124:RHEL64-32bit-000002.vmdkeed6:lengthi422e4:pathl3:vm117:RHEL64-32bit.vmsdeed6:lengthi370e4:pathl3:vm117:RHEL64-32bit.vmxfeee4:name4:A17912:piece lengthi8388608e6:pieces12880:�Jm����ub�s��(V)�����=��л�Q�r|�E뿿vԍ�gس�Ժ��U<5FCz9����:�I�P{X�*��t����B&�ԁ�]C�y�Vz?�AU��BO�?D����J����xK�4���*\Z�\r%��~kj���Z�q�L���W���^��M�q�����5�)�P!���M���`R(W����0�! ul�d�\"�߹���5�K��d��w�C�\\��r֦���+���8��\Z���ч}��C\"���7�J� ��P^t�Jn#�]���ո�ˊD§�w�L��\"i3�l\Zt`�rX?��A�_B�����8���a_B7��X�\r$z��lRy[Z�\0;t��b�O��? �!��Ynog��ˍEv A>\r$��TZ�?�	�����)����S���{$�tj��6�\n_\'�|0vX<��Z��>��F�5b&[�w��\r��ɛc5���ϱ8�~܅7�|6N� hT\"��a�j���7�\"W���ǟ9Q\\9�WQ:�@�yS��L$_i�����D�B��I~���oc��%���M7=m]���#N.i�݊�u���:\r�)>�nf�ŦPe����V������o���B,9&Yv=��|�zB����Y�۷[�h��Jg؆h#DhA3��\n��b3��.����-u)3���a !�cW{�k��Ե{�X\rb��o��#��G\r��h�h�\"�[5۱�.t)��~�`of�K䊟���Fxy�0���5�?�E���ٛ��`�2Y�*�W�4�4�#��:���X�J`�����j\0�+r�\n=L���N��东�L	��۾Zd�4��c6�ga��\rЯ9 �������\'$>�kVY4&h�y\\�� E�G,�2##�M?�k�F�\Z�e�CF�����#�v<g\'_pi�1*��7 !׿�-������\"�B��u`$���ǩ�Ł&��({R^��Z|���o��\\F��\\Ԋ9q��%��:��k6P��e/F��A[\"�q��R��F���m[nb<�b�`��( �4���)Z-L�.�HOo�](�[��	\nNp���Z[{a��H�� ���}����	�~.I���v6s��7X�X{��p��wM������O�c��u�ɬp�6�uC`�k���w#�����*~>������wv����~�t/�.�J�����[p���#�H�$�ǋx�eS�s���w$|��b��[�����#\"4J}��V!(�۶ !J��5G�<���|����J&�����\0<��:�K)���A�D(�qmy���m�����]�b{X��m�4�7�2~�%���is�ߣX#�$�)�\ZFv�h���=.#�U��5�m���絤ʷ���_��CBJ��*T��X\\H\0qF\r��N�|��r�5\\2$z�)9���z겏D/3�2����%�c>�5`.�&��˾@@�(0ġ�$��i~Ftő.�?�|&BAe����_�}X\\Kj��.�4H�l[��T�����7]�����c�4��M�����>�D�S�Y��&��;���D��B8V��D�ψ���[\Z\"e���G�	���.�5��olz���i���s�\'	S�M�t���|�-����������	v��l���q�yW�XJ�`(E�|{dn�6�\n�.B��B�^�M�!�9m�ѡJ�\0�<m�[U�>��\'�V�u�y�ʽ����P�7�^K���N��h��1�����$�������_�.Z*#Np_ʇ\n�Q��k`\"|�9+����)U?5 e,�)c�5@`�KZE�d�H�����]n�)�M��n��7#�f�\n�:̩��	X��_��$�\\�nq\'ca��hxT�5�f5g�w��$T���l�{n�:�+;b�P��`<�4�Q�e���(���:O_��q҂�����#���(�-m�Ջc)p��u`�s�+�#����&V��z�x��BX�T�མA������UI>9��9ss6B����ԏ0�%�ӧ�\"kdCe�|U9��R��Q\\�s�g]?��T�\\���m�)=�Z��>�T��?q��@�i+���ig�FkI���Қ���C�QH�!E��b�A1�r�\Z넓����s�B��G3�x�UG��D\\�X�\'ߪ�n�Mu96�Q�\\;n���U�!�h�l����8{���φ�0㧔L`Ț��K�:{+��i(�$$%Ϩ��+�����\0\"m�s��E�I_3�\\ʜ��� �M9��ؒ��Z.�+�;g�\0�כG�+Z¤A�q�[�hA2�Fl�Cg�6>���h�w�-�*� �<�d���2K[�k��C9�c��?֚�a�@���h��J`��g�\0\'J�R�#zg����L6\\\Z�W�(�>&b�}��֮�>cYf��ײf�M�_K�i���|Aj��.ַ���mq@D�i����;����*}D��r�tw�r��@^�-�.^1&����xOc��FM�G�?�4E1�dI5���#�Ox��*?i$57ܛ�N\'���t;Q+[�\r1��<�\'n@0ǃ?aV��J��}�*�L�85L=��������0�ə�P}5\"��(��.rG��˯�!f|�)]�uvB6\n�e�ULP�r�oT���c�3ڊݧ/�\\�VE�F��b ��:\r���0Gۀz��d���ͳ%��ȩ��-�\'8�b]<ͱ�V�#_bK���}e\"�oO[xNʮ��N�\n[�b�}<Q�@L_�KD���\"���gN��?���\Z�ϵ�$�Y7�I_�V��\\�+�cF^��ɴݖU,�s���5�q��+����p�Q�G%�ϖ�[�H%�뼂�:�$J��\09t*�Ԋ���,���I�>���xD$p��:�9yQk�a�_al�-�X��)\"=����=�i��Cs����?tt97�l8���/tq�b�PUË*U�y�K��h��Q(K���zIAc�WP�ۏ�BQ�(�vgq8ʫ`>��r�&-�7Hij;�G}V��g���#�dω_&���r^���L����(�/&[����:\r��f�D�cbRa��ܺ�1�x3ΉA��_u�4� ��N�c�M�]���AJ�{t�e�Al��5�$�iW�~H�S͍��}0�x�xYK�O���܆�_b|Y)��V0~�|���F<jX�A�Tq�/;P�6u���/�Ԇn�����Q����Z����\Z\0�\Z]L��D���5M���7,;ck;��xz�X�Ɣ��٧N\'u_+Ecq��: �Mpr\"�����H�0\Z���@�j2�Q�O�,E�ye��AǛ$|�H��]���m_�VF�P�(&L��3A����Z���Ԫ��N���{\Z��OmEyAd3<,)�;�\r���\Z=��̦Dܥ���v��@h�Y�x�E�W���\ZR��yLi\Z����~�.��L��-��վ� x\">��¾T}\Z<VF�f� (\"����X�����d�C �k�Y�0D�8��18\"����\\����9�����&4b=3U��$�s�}��T�]�Vf�hO�R��mS�i��P�<��Z�Ets�_Ħ�PK��Q���VͰ	�� �BMY�\'�q��0]=#��)��R����hoE[�,j-�\n��yY�#�tG�2jDk/���\Z ].����͟�\Z�ywu�K,��q�Z���ޥA�)�W�����MG�\n�?�H��N��]��p��F�8���q|�]Wܬ����||����k�f�s�/��n�a�1k��o���r>��M���v,�$�����[۬����9�%�����A�g��V��c��vo�w���n�S���DU�� �_�`\Zk{Qͷ��/�\"&kG,m�uѮA�A��%�@y����� 4����I��X�S�7Jp�8��\\\"��@3:������\'hL�H��>�v��dx׳���(wߩݐ�J����GIw�Ϙ��F�ˠ\0+=ygHg�SX����\n�߀5��,{v�}N��m��\Z��H�G�Lz��=��e��W�����\'8�v�Qn�K\n�f%�L;��u~��m+in3�b8�ć~U�{���֧���CME^(S��\Z$���4��Xa,��d�EJ�7U-K��|����VD)I�&>��L�O�҃U�o�	1of��j����b�N��\'��~���#�(�V&�����v\0rDw��x����=�g=��9�D�#e\"�o�3J>��bV�#A41]�a�\"6z�/�=�<ƹ�j�=S��ǝ:_�d��<�&vλ�I����*���F���KX��^���g���c��R��=�f��r���a �\nt���ce��.j������뮴A��o�D�9��܊]|�P���)�DF�S��d�e�s���av�tOH�f]ʐC��������=6ת�#�>~��4	�^���Q�_�����;���M���*\'�����r��k�5��4����Գ�O*�u PӈV��f>8�F��85�o��,��H%<�a�0�%\'<{�;�\r�6��Ƶj]<���~+�5�ZK5\0�������He�K�\r�L���D���^�:a���}�����1{��z_�o1�?��Y� ����Ԕ㋟��[���\0��]˘^L�	�c=�ﰋ1B˼\\s1�~�<�D,p�7T�x@��23��d*_ ��4���=��Y��#����������堡\r`����Qs��h�cB��v�l�������+���7�W��A��{m����0��|�z�����a�Z/&e��b�p��c��fJCZ��Wv��Q?vv����wp�˷�o�/���\'K��joS�Z@H��_��x��6I|d:�X�\08�Qz����b�˶X$�4Չg��p�_\n�b.�<���)�P�w_D��Y��g��>^,�Ö<�d��<�;2 C\\I�D\Z��]�кh�\0)��W\\7~���N��Ny�%�vyƪ\'���\nN�����B͟\\���<}������h�r��@�/��Q�r�)�W����ds�Րl&�nv8Ӌ�ik>f�\Z�y	�R����¹�I�����R���*h�-�h)���|`R������R)x��sK����^��e�������\\��\"�4x}E��_n>8�Uq�QZ�+v�&�m�3L�1m��\\������.��jT�_l2���<+\r̡�?<\Z\n���V�[�/K{�ӆPϤަ��	�����l~*O��3� E�P���3��h��^�᥷�`���fO$r�P�s��$yT�A��n_-:v���*hR�+���Ay/���+�Ҭ��p���r�բ=T@h�/�X$��Ш2i9Z��-X��?7�b�{�j�w��c`��(/��_��&2� �C�-�|��͍Bu?8R�O��_��7z���(��G<p��>0M��+�Nؿ[��lq?������q!�\"��35w�j������Ё�����K��H���������@Q�5.G�Y͙�6Ú�l����eh.��:�<|�W��@����6u�4̧&rG�\0�Yb�\ZQ���ԐK}Ak�5Ǯ�؉Ŏ��8���P�7���g�F����[���G�uG׻��۶��n�:�� �(��s�쩭���������^@㨡����m4��Phx�����=\n�����u�K��)p5\n�ۀ`Las��\0�5�3�\"�=-\\�2/\Zq�(�c3�qM�eƇ�FH6�7h�;B���ɓ�g�h���~Ho��ܗ����X�����T�	$��]AP���v��K˚Cŏ��@P �%	��D|&D��^�/\'-Z\\�XI�F-�uy���~��W�@��Cض�������W$2���T�5�(y�\r����Ŵ�2�rL����Pa�/ra��D\r�[����H�Ygp��1�数&I�P� �)�n )�����<2��=�R*��5S;8 �F�]\"���C=I][2�鲠���*Fth��roC��#�oa��YV]l���+�F�(�\rv�x�F�}`�W���.��(�N��sk��y:,M5�Y\Z+g��r��!�?D�u�L���A��.I��f�3�u�wf��������0Q6�AǛ�k�C�c~�K�Ȭe<ݙ9��j�T�ӎ:@��u.�4b$�\"Iv�\"w�����b��%��/��籶�A�����+*�Q!o�A�P���o��Q;R���a8��$2���/�y�XC%mkj4������J�6͍���w�l1ߡ�W�z��[P?i=����- Uq��Ahuo�&]��E<����^<���� ���,D��iCfo����A[X/6��x�`s�9^k��\'���o�f´��#�t�,9n��#٪~���K`W�Ӗw�j���YI(N�7b=J�J��I�urz6}*N��0(�<x:7�� �K�t�y8*R�6`����}�:N��8j7U�J�v:Y@��ǺR)�m��6��\0\ZW��,T?��8��\np5�[���g\'�C(�J���0(���-2�ÖR\0ۇ|M=p��ߝ��]��^�\r6�\Z��`C�+�,̃�����~(:�eM��َ1�`��*���mif�G���#Fnb��;8��@��3�::Ψ���97c��;#��W��YSe����,vdײ��6A�*��,}*��6�Pb���^����x뷊��\r��PX����ɽ�G��mS6��5���\r�Q �����^M����XwY�l&,��8��?��%K�ìy��5��M~t7��:ZZ�L1o�\\�h��cߛ�e\'x$�:פu�9���3���k���:�elNŵCH0�4�]z�c�Y��=K�e��f��)�l�!���)<�6#�c����*�@X0�j�j\n@�0}��s&آ���,K^�9�����#�KZ����ĳ�6�$�\\�㉇L�PV-��~���(V/�g�ka�V��.��ڢAx����u��T1���D37�^gߴ-�M�,�����O�l�v|��j��=�r�6��i^zb�-�g/l�_����9�6\\V��h�P!����3c�v�:;5�ⷷ,ٰi,߁�q#a8����˝⠹\"�����H��-:�2͎&��\0R-\r��:EBr�e�x+;A@+��j10%������*�Y� K_���j���P���4�dR�7�*b��lb�+�z�?�^{!�� #��@�j�.͔��Ђ*���qCA&�~�&1�:�|j����=۾o����xm_�q�D\"Q������1��:��`�d���uh�33l�(�s�,�i��(�Ś���yN\\��CG�\r{�j�H�)h�oiz�9�X��?z��A(C�Đ�\\7��;?*ސ�V�H���W�^&(ۚ�\0w3����;��V����7w��R�t�S����Vݍ��[d<�zY���,��\0ƨ����c��{�����ʇ��N6������q�(ʗr�y�t L��cnv��g�l��V��D�8�o\\xL	(��,�a��\Z�^l�����4H�\'1�tS��2k�����=�&6�)�i�/K�2/�%�A��,���T�-�\0��B��^v`T�jw���?���a~�rD���ɺR����_G\"���	�R����5B��`�Յ��\0z��u0�ӁNi<U�&�B�4^?�uS�)���?S^���6U�s];x��OŬ�2+�	�I�s��W&�_T%�C\nO-+�yǘe�?Ǽu_i����/*�&�|�.AoY����B�goZ)�	�5w�z�����\Z��������VK���S�-(}��>�]T����(jHl��	�呷;t�k�z��sG�>��t з��K0�Bi�qzz�V���Vl�/�j�|\'�x[����$f�0�c��A���c�c�^ϱN7�p��OeY�\"��q~�Ŀ��Mj�?�\'�4��w�W�;RQPD��ɻ��ٻ0=�pYy��::��&c�v���|�`���iR�M���e�.�{�������EӚ��_G��,�cq���\'l噱0\Z�I.�\Z��p�ƇdlvXf�&F�w;Ĺ��RQ��U�F�ũ��m�P\ZI�L��?��3r�&�ސ�tO&=��KՏ.s�e\Z��g��i���[6�vc��f��1�_>P�ѥ�Hj�H�\0��2�����&	�����=P9�î�hJ=G{2Q\r�B\\V�.j�_��2�ks���:ȉ�_ם$a����W�:���g��D\Z��Ru�x}pk����]�|���v	�b]uy�J<z��F�\r���$�:�P	&��{mCr}�=!�˂�����?�%�����ǎ��}v�&�9`t��m{�q��� �\r>��-�<�F�I9�˘m����Yq��G|�Y>�HQ���\rH6���E�+\\�.���VjJ>H�w�|��l�����}�t��}f^R��|bW�\\6�}�Bo�ew����)�1@@J�5�hI��B\\P��5�xH�3���%jK��G,�3�щ �G4:�R���oE8�P���8G�%r��6�p9�YO�*�ft�a�d���k�*�[\rh�e紧��䑂�\0j�K�Q*e�5�w�����,Bm�4E�O�f^-����\0o]�>���0��I���n��55��ɨ7\Z2f9��e%��-~0��{\r���:�T�$�����7��a|��{��컚���X�1�n� ;��*v��X�v��i��I�����Qodz����Cr�P�Xz��J�LM�\r۴��5���\"��H�N����\0��Lv+�4��a�0�C�y��;��t�Z+�5�\'�¦;mct�g����8\0EW��J�;�5Q�����2�q\"A)����w�����{�5ԡГ��Q*a5���u��ј�<7m]���U@�2PϦ�\\�[�x�c�n3x&���9)@�<��o�|������Q�D���K��z��Q�~�����J%r\"�㫪��*3���+�<A�,�F�˃v�s ���7�6�O��O{���	2�\0/�v�-S�����v�&{R�g��3l��g��`M{D��`\"�׮���I��\"���F�#���K�(/;*4�4�	�u�+:�d�^���O�pf4�D\"p��b��/?|\'�0��饐��p���(��԰���,��p�I\r���uc��X�A�&�$Z�ӈ�����$ï��D�0�iQ�,\r0�؛����ID~��t&m)���$��}��)Qc�_�\\c��#\Z�d��ӊAk��N��{�e�i�``��91qx�Fi��y.Fc�B�0�$3�t�����Xکy�n8;�\rz-P�~�Pf:���b��N��}K].�!��x�蟌��{N�ga=�v#\n��{Ĩ��[1N�\0�����2�j0k肾&e�x�����:B�@�x�:�3�|��(��.	���A�~��W\n��[pWX������v�����Zgo?\\a��ڵ�6�iY�P�!�@KTwfFB̑��(?\Z˻�܄���y��%_,��ɝP�\"��0cԴ��N�g]�)��@�ǐ\nq��D4�N�6;mza�]\n�~���\"[�����B$l�{)�d�;y�Њ�|JV[��(\Z�P(���g�u��q^bHxk��mG�^����\'p��:�����]�A�c��mX���D�s�ʅ�Gq�V\Z��J�5�N�()%���IxZ7	��SWT�����\"�-t�Ub1�c�$��~����B�4�Wgz���u��ь����� )Q�5L����x}�1�a���.ժ<����&7G�s��_}�N�Z�e}k�\"&��We�1�w�!5E���Z0�����c0>���A1h̃�8�A��-�L)}}]A{Axx�u%U���ܻڅ���s?������?�eZ<f�e$c���\'@>>����?�n?F�aC�-�䧨��dt�.7�f����{0��W��?{�͝J�)��~�wf\0�̃��?i;߁�U�12�Ԙ��!��y���?�\'X��-�)m`��!,�G�	\\B�ؐ���2u��R�\"z0�����p���B�n���2�����\\¹؉^���I��\'��{�F���<P���d hŎ�c)���`��zj����f|LC�鷉�u�d-\n/:ፙv��H~��vI�!�������/��9��u�hGo?rѥ3�UUj�	�F��n���ZEo�[\\\Z��e�F�\0\r]i�GFϓ�X8���sqn�;,f!@�(�A5~��܋\r��n�D��l��$:�dH%t�}�Sy�,�<F/�DZq\Z�\no�1<M��1�̾5��}��و�T�EN��D�\\�_�4��.9P�Shw�� 9�`?o~�r]󆤧�צN�Ȝ�5�J*T�����2�w(�Q	�F�^b2��h�,f0�h��9=T��OR���7Ѡ���@�7h������T��z�?��,�����z�m��iuAomQ�뮌ſ�R�L��ZYɀ\njIM�.j��LQ;����lB(�o���!�<\Z��4^��)4!;]��\n^�j�S��su��;}�4�L#z:��h��9���P�L`�c2\"�c���t��%SE��ɘ5�5b%�]���FCH$,[\'���u�JS��]�\nG���F&Z����Mb:P0�Ǚ�l�Uq�W:�#�5Ym�ݶi������N�X���w��x˩������|&3���Q�r(�q�kP�\\w�Q&R.uq�in�H����\rO��#4����2W��\\\n���m�4*m�\ZT.J1귵����\Z�W�|���\n�U�iw���0%A��%1�TC�\rN�SnՔ.]�Ϫ�۞���DTJ�\"l�}Qp�}��uM�S$[u<2u�����u&�ڼ@/�j(��3ε苆j�t*`@[��x�g�zĺ�3�|�X��\r�U��`\n�6�;�$^�+�&O��1$8���[�Q~?�g�f!�z+/\r�k�_s�ⷎ�Nyz*��.(����)�&j�n�����Cy��� 8k�TwSF���2>@�Q�#_DWZ��[`_G\Z$���	��i����\\4�Ɉ������d�ͅ���l�r�yX����#�3/�����fL�����O��(��׃и��W�i��sZ���[]?�$��!G�+���O����\Z<?-�@ʭ=jt��F�>�x�+��(��K G\\�1g��m�E�_�c\\�:6��o˓G8d�b#`�k��A�oT�\0#$�q�OG�@���7)ļv���\ZE���#�����H�>�Ԍ� �탸���-\Zm�Q�5��1u<�\Z�w/�o��y�Ae�<$��?q���J@�\\�^V{���xi5V<i��MM���3��/��h� ��2Ƴe�P1��������պ��<C�9��n�\\k�)�C���R���a�#[�z߲4��i�ͧ�z!�NQ#�X�_�a���wO���;�%�)�����h�_+��$���7�����j��JLo��E�i���7x0-U�ؒ�����n�Pj��Dp�y��z��#�0&E��ǚ���^�%-8\"9Y����Jx4uk\nnz7�>�|�����2�p>�E���=��vg\n�m�T�t���$�Fl��\'��د��J�\\����W:��V]�a��>���I{AP����t�~9��n�\n��m&�?�y�Q���\0pU5�w��7p7�I�O�l�_M�ױ����;4&Tꑾ��m\"�5IJ�o꫾`))��6��de�ɫ1\r4�R�)�C�o�T�;%��\'�S*t�tH��r��E�R�\nl�wj�vs��H(8\"��t��W/E�愝��(;K*~��X*ho(pO	��3��혫�����I)s4Jw�1�������U��ty��l�l̨�J�t�>I��ߔq\Z���B\'���6� ��}`�,�pQ�����~A�Ko�|I	��u���x�_5JYw@n\n��r�F�O+�nR~!�Pjvy~X�r���x���^���]t�\'߄�)4d�����9堧LN�����4��B�̹P��v�dK!`�ޚf��_��XZ��o�_|�R�WE3����*��<=u��0�k��[J�jH��;���<�_�G\n��7:_�dW���0�,�S��/��;�c�q�u��3��I,H���(#�RS��Sl��.�<vAރ���:l�҈n����ќ��b[*u�������tP�o�ȍ-�Z��Ω�!;���Ti����ri�H�6�}1\"]i .�E�J6��\0�`}<�:���@ɋ(;7\r��Ě�4� �h��-�WXH\"��=6�g�C�u�p���n��k�#��OVtG4`B�fLC��B2#���=���37ڈ=�V�8��3���0*Uq��d,\Z=�W�|�pR��7��1)�Z�uoE=a���2�3��.ަ�2�oET�+�lv����=̻�t|�\'t9]���H5� :W�+�cx! �B���(������g[�!L�J�����**b���s�KN-O������7�l���n��.�ߗ�4�^�K��?�@��h�z̽�^�[!����8EV��;OH\Zb�H����`��7�X��*�c�_����:\\�Piڿ����l��m/�Ȝ`�l�7�:?V0D\Z�IjDH���� ��c���};pO�S���*3����Q�`n]���O���M�aÒ3��N����O����)1�܃�������T?�e3�nc}�4�[���\rR��#�dx$�|*)Z�I.��v�u���G�1]����G�R$�\0���|h�lYހa�9�kJ&A�W�\'T���H�L}�|��`�I �¨3z��@�gU�žs�|����$6�W��7h+�\Z���G��t��z�3X<HfPX�>^GqRޏ��L�8_U�c���8wee',NULL,'2016-04-05 15:03:49',NULL),(39,'AL7','A1D19A6178A65ECD53D27C29AFEA9739C970964F','./torrents/AL7.torrent','',1,'2016-04-05 19:24:56',NULL),(40,'Ubuntu_64-bit.5','3798819A90FE09CA7B0F515A76E3CFDF7EB0D9CA','/home/robert/labmgr/uploads/570411297df34/Ubuntu_64-bit.5.torrent','d10:created by14:uTorrent/3.4.513:creation datei1443018670e8:encoding5:UTF-84:infod5:filesld6:lengthi4294967296e4:pathl28:Ubuntu 64-bit-Snapshot2.vmemeed6:lengthi1195769856e4:pathl23:Ubuntu 64-bit-s001.vmdkeed6:lengthi1062141952e4:pathl30:Ubuntu 64-bit-000002-s001.vmdkeed6:lengthi817823744e4:pathl23:Ubuntu 64-bit-s016.vmdkeed6:lengthi782368768e4:pathl23:Ubuntu 64-bit-s010.vmdkeed6:lengthi347078656e4:pathl30:Ubuntu 64-bit-000002-s002.vmdkeed6:lengthi318479061e4:pathl28:Ubuntu 64-bit-Snapshot2.vmsneed6:lengthi302841856e4:pathl23:Ubuntu 64-bit-s012.vmdkeed6:lengthi229441536e4:pathl23:Ubuntu 64-bit-s014.vmdkeed6:lengthi222822400e4:pathl23:Ubuntu 64-bit-s013.vmdkeed6:lengthi214040576e4:pathl23:Ubuntu 64-bit-s019.vmdkeed6:lengthi211943424e4:pathl30:Ubuntu 64-bit-000002-s024.vmdkeed6:lengthi202506240e4:pathl23:Ubuntu 64-bit-s004.vmdkeed6:lengthi201719808e4:pathl23:Ubuntu 64-bit-s011.vmdkeed6:lengthi181141504e4:pathl23:Ubuntu 64-bit-s026.vmdkeed6:lengthi179830784e4:pathl30:Ubuntu 64-bit-000002-s025.vmdkeed6:lengthi139722752e4:pathl30:Ubuntu 64-bit-000002-s014.vmdkeed6:lengthi111673344e4:pathl23:Ubuntu 64-bit-s018.vmdkeed6:lengthi109379584e4:pathl30:Ubuntu 64-bit-000002-s003.vmdkeed6:lengthi103874560e4:pathl23:Ubuntu 64-bit-s020.vmdkeed6:lengthi97583104e4:pathl30:Ubuntu 64-bit-000002-s016.vmdkeed6:lengthi90636288e4:pathl30:Ubuntu 64-bit-000002-s019.vmdkeed6:lengthi89718784e4:pathl23:Ubuntu 64-bit-s005.vmdkeed6:lengthi82182144e4:pathl23:Ubuntu 64-bit-s017.vmdkeed6:lengthi78315520e4:pathl23:Ubuntu 64-bit-s015.vmdkeed6:lengthi65208320e4:pathl30:Ubuntu 64-bit-000002-s018.vmdkeed6:lengthi64749568e4:pathl30:Ubuntu 64-bit-000002-s029.vmdkeed6:lengthi63504384e4:pathl30:Ubuntu 64-bit-000002-s004.vmdkeed6:lengthi63045632e4:pathl30:Ubuntu 64-bit-000002-s026.vmdkeed6:lengthi48365568e4:pathl30:Ubuntu 64-bit-000002-s020.vmdkeed6:lengthi46530560e4:pathl30:Ubuntu 64-bit-000002-s017.vmdkeed6:lengthi42244096e4:pathl12:autoinst.isoeed6:lengthi34930688e4:pathl23:Ubuntu 64-bit-s006.vmdkeed6:lengthi28114944e4:pathl30:Ubuntu 64-bit-000002-s005.vmdkeed6:lengthi17104896e4:pathl23:Ubuntu 64-bit-s021.vmdkeed6:lengthi14024704e4:pathl30:Ubuntu 64-bit-000002-s013.vmdkeed6:lengthi13893632e4:pathl30:Ubuntu 64-bit-000002-s021.vmdkeed6:lengthi7733248e4:pathl23:Ubuntu 64-bit-s022.vmdkeed6:lengthi7733248e4:pathl23:Ubuntu 64-bit-s029.vmdkeed6:lengthi7077888e4:pathl30:Ubuntu 64-bit-000002-s023.vmdkeed6:lengthi5963776e4:pathl23:Ubuntu 64-bit-s003.vmdkeed6:lengthi5636096e4:pathl30:Ubuntu 64-bit-000002-s022.vmdkeed6:lengthi5505024e4:pathl23:Ubuntu 64-bit-s023.vmdkeed6:lengthi4128768e4:pathl30:Ubuntu 64-bit-000002-s010.vmdkeed6:lengthi3801088e4:pathl23:Ubuntu 64-bit-s024.vmdkeed6:lengthi3407872e4:pathl30:Ubuntu 64-bit-000002-s011.vmdkeed6:lengthi2883584e4:pathl30:Ubuntu 64-bit-000002-s012.vmdkeed6:lengthi1769472e4:pathl30:Ubuntu 64-bit-000002-s015.vmdkeed6:lengthi851968e4:pathl30:Ubuntu 64-bit-000002-s006.vmdkeed6:lengthi718264e4:pathl12:vmware-0.logeed6:lengthi655360e4:pathl23:Ubuntu 64-bit-s008.vmdkeed6:lengthi655360e4:pathl23:Ubuntu 64-bit-s009.vmdkeed6:lengthi611561e4:pathl10:vmware.logeed6:lengthi589824e4:pathl23:Ubuntu 64-bit-s007.vmdkeed6:lengthi589824e4:pathl23:Ubuntu 64-bit-s025.vmdkeed6:lengthi589824e4:pathl23:Ubuntu 64-bit-s027.vmdkeed6:lengthi579762e4:pathl12:vmware-2.logeed6:lengthi524288e4:pathl23:Ubuntu 64-bit-s002.vmdkeed6:lengthi393216e4:pathl30:Ubuntu 64-bit-000002-s027.vmdkeed6:lengthi393216e4:pathl30:Ubuntu 64-bit-000002-s007.vmdkeed6:lengthi393216e4:pathl30:Ubuntu 64-bit-000002-s009.vmdkeed6:lengthi393216e4:pathl23:Ubuntu 64-bit-s028.vmdkeed6:lengthi393216e4:pathl30:Ubuntu 64-bit-000002-s008.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s015.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000002-s028.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s023.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s024.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s025.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s020.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s019.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s018.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s026.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s027.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s028.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s017.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000002-s030.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s022.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s014.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s013.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s012.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s011.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s010.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s009.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s008.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s007.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s006.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s005.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s029.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s030.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s021.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s004.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s016.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s002.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s003.vmdkeed6:lengthi327680e4:pathl23:Ubuntu 64-bit-s030.vmdkeed6:lengthi327680e4:pathl30:Ubuntu 64-bit-000001-s001.vmdkeed6:lengthi303070e4:pathl12:vmware-1.logeed6:lengthi65536e4:pathl23:Ubuntu 64-bit-s031.vmdkeed6:lengthi65536e4:pathl30:Ubuntu 64-bit-000001-s031.vmdkeed6:lengthi65536e4:pathl30:Ubuntu 64-bit-000002-s031.vmdkeed6:lengthi31573e4:pathl28:Ubuntu 64-bit-Snapshot1.vmsneed6:lengthi13124e4:pathl15:vprintproxy.logeed6:lengthi8684e4:pathl19:Ubuntu 64-bit.nvrameed6:lengthi3098e4:pathl17:Ubuntu 64-bit.vmxeed6:lengthi1894e4:pathl25:Ubuntu 64-bit-000002.vmdkeed6:lengthi1843e4:pathl18:Ubuntu 64-bit.vmdkeed6:lengthi1820e4:pathl25:Ubuntu 64-bit-000001.vmdkeed6:lengthi866e4:pathl18:Ubuntu 64-bit.vmsdeed6:lengthi512e4:pathl21:Ubuntu 64-bit.vmx.lck10:M38168.lckeed6:lengthi371e4:pathl18:Ubuntu 64-bit.vmxfeee4:name13:Ubuntu 64-bit12:piece lengthi8388608e6:pieces29200:�;0��o��W9^m�n��J��qF\\\0��U���8�����n�\n�4^&�m��-|������U����!o���f%�>�����͐\Z���R_�u|)����M��6O���:��>�0:��3M��q�S���S��z}��#�	сh�S�bX\'Rs�z\'�Vhq��i#�LQ�#�hñ@W��h����\n\Z��U/��\nT3�\Z�!R0�Qn!|��J	��ڝv�,8��\\f�Iy�1�E��N��;U\"�Ѝ���A����F͡H�\0���L^��`�ev��z���~.\'�[�E�\"iS�}>>��}��.���taX�6�y2ō?�#?�޵��\r�Zf�Z���K��|f|�\n�DΝz]�_�S�,��l�O!�ݧ:g�A�I������j�1g$F�R�����;���(��t����^�F_��\\��NQ�������������y��3oI?)�\\x�u9|������췛��5�H��\r���.|�a�Y�s�@(N1�h��K+�ʜ��)�`�-3��aY4�`���~f�\\@�qD &#�d9���gO\"��ȉ�!<㵰��\n���~ft~�iƦF.�4�W��{��z}�+z\"��ᙂ�!�a��`y<�+�6��,�G������h���Z	��u&�z�+�N�A�ߌ�|�u���0@բ��U�m/�H�>��(K�ɞ�������9]��!:%��պ�\'�.e\ZE!lvď��������d�&���\0��`�����I��G#�����\"f�,�N���i�k ��ɯ��5̕���y�k�	�K�����qW�b>@��`Χu���g\01q48��d\"����f$��腕��8^C�4��H\0^c�y��@���Yo�M�w��Ng0i\nzl�O_�$�I�?T�����-�>]Ux����m�h�xģ��l�~�خf�y���HE�gFxj3ib7R `0y\rDR+�\rn��g%����7L����8U�SNrV�)���A	m	oCU�����2X�!x����P��X�\\+P�N8\Zp�w��cww��]�Bpv���ꌢ)�x�b\n�X�]��ش���7����+[���&���4�oK|XгLDV�%�=��,b�Ч*��!ʱD�}_�sn�%g��@y�(�+�	M�;!������ܲ�߇�������W��m�;_B���PZ���R�\n�?�E)x�i��km�[/m��E��u\Z�[��a#�\'�7�h�/�\r|\"\"���ϖ#�W���2���\Z�z[*��~��݆A7^NL�3e�EM����{a����GK=�A�f��U!]/K^�M�ݷd��b��bEP�M4�͋:����o�Q�_�������r�*NKM������ø�j���s���������C��!�@y��ٿ��F��=u�#%��U�L��X��%��.lli�鹀�� ;$�n4̅����N�ӓ�e@c�J�e�e��Ay-�¾����NͲ�&B���|�(0[J�#[���<#��F��n娂]�9�\'�����k�o+���z�z$�e\r�j����������u�4��By2{��a�j�Ʊ@��zf��AEY�(�W�(�F_��\\��@s1O�^=A���kJ��[�����,�ҋ֦_��9d�m=��dmU��1�zڜlגˊA��&R�9L|ނ)n�K{m�\n��V\r뾢>	�����k��M���E�x���jR�Q�d��ϤF�X�[4W�]ω����R�6U5}>�<�U��m`A7��W\rP�h���?��-\Z�:pB�-��gR��ǎt>Z1)ӔE�_�blnNo�R�1�J*@�2���^9rL�-pEQ�<�0�Ynm�w9u�K�T֋���8���q=�4�Ⱥy�,�\n��DLy��]������ZW��fs�~��<*��=\r-�~3[��\0R�.�4��Bf��_��p��C�?B�:F����Ѫ�l�����䤮Lɩ���5�b:���tâ��5\Z��^+er�����&�V�~\ZM�<~���q��*��8��\"3Ν�`�\\���s��_�x�v|�jZP��󸭙���7�;+}1�M?S,�L�t�����η�*d�$jj��n��F	����5\0D���f�i�L��G[���O_��I@��9x\nP&T?��ķE�u�7�B�N��B�Z@�0}�k�pQ�$[�����qP��$�z�r�\n�3o��K&�Q�V�A�og\\���7�Z��}�7���f,�[ү)�7B�$c\r�,�g^iJ$k�u�C��d�ͼ�YGV�\"v\n_��G9�5���8�s�gwG�7�Id�\0~#Ċ��&:L\0�冶�ݢ�jޙ�\'���Ld|���٥�_90,�ê�ܸ/~u���{r�2�\'�����Io�A���qH��g2�C��Y&ۇ�,0���I�����|6\Z� gň���m�3�S����@;~m{�<���&w��R�|6@g�cja�,�4&a[���2�$l����P��[#���e<����wK�ӕ����z�[�[�pҢҨ��������ډ<6ë���.�|��~������h�-�+\\NP=�hC�]�\"TnڪU�~��-��]Cɟ�0��h%[Ğ2��\'�O�L|@�5�x5~�+6��=G�Ϥ+�� ?��_��~D����Jv��ՠ��7����u�E\r?	�B��!�j���|:\'�\n_x����G�[��!�?��\Z��xt�l�H\0?��\\�Cm6?*ђx���#�c���J��*\"��!i�:����|͊�����6W���;:oyɐS(�p��b7�!ŒP� � �H+�ۦT\\�6FSaK�$�Q���!N�J�m�S�rK�����K�ShVe=!TO��4����>q�{�ķ��O���]ۂb	h��\ro��h��Ƙ��2�p6Z�>��	bE[0�n:W�kw�H�a��6aI��������F\'���^��w�H�7Z_�5v�P��1�>a�]�/x	\Zׯ�X\'��])��`�4����$�^��4\"b^.��h���:��M\"Q��i��1�e4s�1���+̉x�`���6@P�/�9E�b��Z@d{������Mb:{-\"��Ke��gD�Zf1\'�_�oϴE���9O��4п�T;��)&���r�ѩ��$��B\n�\ZxQ�t��t����D.;�v�;����GVe�>ݑ\"�Y�p��Ŷ���kn��1�s�xp��4�χ���)�����g���Ni���WG����h��p�-v�|���N{��\rc�p�V,IMj⿽$H���D\Z�Wχ�=�e��#Z��VU4k1Է\Z�ׂ:�l����\\�Ѥ������b,�*��c�G=O��UE���&*�uR0\ZL����4���v����\Z��m��x���D�H����0�V�/zJw��)���y���8�v��ǚ��x�*�������l�M���K	2����(&���47Y0J������e7�[H��\\��ֹ��x�/�\'Z�xlqT_�`w\\.������:&�|�æ���Z��)\0��0�\0���c���{4���f�\0�y/F��aa�D�a����A�����r�����\'�M�`s����rԾ�l*7����H(��˩�������<�9��%�m�b�*R� 6���a������k�-�.Ķ�]�a��78�rA򏙄1oi%�>CR����ݏ���5@w�^�\0{,��y�ݔ���$�}d{_G�B�)P�\Z�rf��*��EQ�$��i���W9�x\n b����w/$���Z�y����qS�\r�Wq�;3��9�d]pBl�%�1[�\Z�	L�]��Z��KRX�|ɴa\'ZO���Ru����͞/K��3�wN�K�y@g����z�{�����2��orB�3m�钬v�B\'<7o@��b_�:� ��@�H����T�|p�ݽ&���<7vj_�@\n6 ��)���P˽2�d<q�y�l����=;\0���$�1�J�x����zC��k����Q���j�7M��f�ZI��殛�vIJ*���<LJ��߮(��[� ����!.(*&��br������V�	A��L�t>e_�B�\r\Z���@���Ԣ�X s]��W�|���J�&�N?�\n)���_��8���_?b7�m�++fxQgzoB����WۯԠ_Z�p��a�Tcj������ٳ�nk��TQ����[n�Л��;\r�A��靹Y��z�\"7T%�.#�Kb\"Oڿ���%�\'㓻AC�U$-3�PF,\0�k�ȮY��X�&R������=J3tbv���y��iw4��t>��.��֐T/t��\n8{��K�MF�)0���Q�k�f��r��Tz;�����f`eg��چ`�}z\0���)i`%�U��p\"���KOwʴ0~}%�v�2*��,�����к���J��]�*ZNqp�q$gT2{�R��ˮ�ڎ�%Op:�0�X⷗��蟟d���gI�m����p�H�y�@�[��Hw�g:�*ʨ�y�Q*��ٓ���y�avE�(κa�L�q��?T����ۛ��Îb���ƦJAn M��P}w:�,�\'*9]Q�,\Z�%���v3�d��\\����R�ʸ柶��X\\Y#�v��QKG�b���oM�Vlʬ�2�ቒ����˨��@!kg������o���un=f�0i���	�S�c~�iU�H	u:�`�i@4���o�h������P���͝��rY�kD�NQ�?��}���������h�>��ey�d�6��\r��\Zm�їnM�X�~M��a5��\r2!�ܦ����D����ш\\��F�\0������ ����6�J̬���	���מ�k`���^�x?�ߠ��ӺT<�pЭ�\'�� D������)P7��!�B-��5az@�U2<�m[�����L�\'�K�����6T/�j�5`���|>�$���COR�持���?��Ɛ��j\Z�=8ZV6�K����0�>�tbRMJ�)l�m�f��ե��A{�a�vK#�1��Ư�c���\'ѐ��i7�Jc��C�$*��_�ʐ�R���?�Ǒ�\'wRʽ->X`+.�.�_�2����,��_:�0HK��Tn��&V��ڤ�����9���p�����f邥m�,z�&��~��\r�PG�_Y��D�S����\r���S����Ʌ��IP)�kZґ����_���)� �7��s���\\ur[���SҮ��^�\"��a�?��Fo�T��DR���F��c�^:�m�;�[��	�g���u;f-��V�P;�ť��s�Գv\Z�#[j�ӣq��P�m��<�<��a�d@ő6����0���_^4d��V��Ho�H?��%���Kf�17�)&�;��\Zk?�[��Np�c�z+K�F���G��^��H#S �F�7�Ƣfv�\ZP�-�R,m픠hLg���s���Ley�x����뼵�v��A#�(G�Y�Xi�a�#��!B��V�n7�vH[�=��J߲k�]��&h��/�	}��������$�9��_��r���y�oɛp��X$�E��\'�N�\Zl��://��NeU�/��ɪ�`	�B�U��()^E��Ø+�i����gp�7�N�|O�Ŗt�}9�02�8>�`&���dF�RN�c���è����T���������z���m$�z�����QE��;ZV��׫.L���ğ����>t\0�m�br�K\"�X��b���mc�I]��뭣#��9L���@�H�C�T���&�.�J�G,\n�3���7Y��ǫv���z�*�-��O�����H�Ր��ƝM�/�R H�U�t��(9i����w��+�AWx{�OT�y}ɭaE؃	��]c���H#�1��R�G\\��Y����Ęۦ?�\0TȈ\\�WJ���_�������������ŋ�GD�\'4#��h������z��p�\"�3qkԳ1[�	ki�w�QU�B�ώ��ǈH,����������/	U7MCc�Z�ě>ŝ=Ar\"D-�L�j�Vj=m�S%�S�%mF\\]��|	\ZI9+0�޷���2\\V)��y�/:JxT �`�ce\\m�R^�aAe����َw��@�ԗ�iy�mi���\Z�\\�E.n��|��2�o�a����>Y�@M7 _�-�̢�����cZkj���_��Ra��Ե��\Z����Y(���%8W)�[�?T0�[D{5ҩ[�e�P��yo����U�J����H���r��\'��D8[�iS�^��`~�Dvm\"�y��Y�%���u��Ֆ �=\"��|ޅ}�^{��y�I�4��!��u*��-�����M�S\Z�ld���R�����]#�����[�s%�&pnd<(���)���{X[�|�����>ȧ�J���k΢�$.�JtB����v�2ڱ�6���d�(���Ɉ����S��\nS���#4����XjN1\Zv���<�}�nhKqM_{^rdό�����*����r�;�+.#���!�������q7|�������ִS�\nz{\0�-��)���E(�Rs�lg\Zt��ܜo!ȦA�4g�_X?zu��!�TB�~�v ���7��莘�Wþ>�X��`���p龷�jI�A;?�1��턫a������@�d��&�D�2��4��@�\'��7΃a�&/fn�����B��9T��ţ@d;G+��g�F!�\Z��/���2�P��L\0*<��R^�\'�Uͱ��CPa�\\��ic�	�a�\"�ڜ^�\\��t����dH�<��@Y�����}u}��#H%�{\n�A^���`k��Kݒ�X��J�v���V*5�:J�V��\Z#��ڑ��u\'\"�@�@|�s��5H���V��:�|�\0<�Zs�e�SF(݌UwM�ZC(�Yy#z��Qtr5�f�j�ɚ�0��:�5��\'MT���^d~$��,��a1H���0\Z�S:��oP��ް����p��:Q7!��Ǫ���p{C�lm�	�4Ma�R�ĸ��j;����+��X��}����y|q������������tj��@j����/y�D���ҺfS��{c�UT���*�|��8n³���6>�cc�\"�P����d�Ҧ�}�t\"�h��nf~΃�0~%\0�̀���R$�\rJ��R�~u�ةC���Jl���b�V��YR[\r�fϏS������0�M�\r�h�t��GsM�:Nu�,F��*�;�{=M�㔚�Rx�����Ϳ@QIX/U�M�Uq\"rIc]C\\P��;��k�JD��,l�X×I�쫷Gr�\0�����6�>�ve���4!��!ao���\ZIUAѦ�P�]���*�i���<}�F�+�����rs�c�\"h�oTl\nÁ�nŞ��\'�\"62�qي�5��b�iB�V�݁���&psB+Z��$���\0\r6NI��噏c�E��\\7�W:�3zT_�9�3�4��JP�ا���(��S��`�]�r��k��B���z�b4���+(lT72kgү�{~�J!�����R)������0�<�R,cC\Z�A��Wm\Z��fb/\\P�$���e��f��m	�D��h.b�W��ō׏ph<�u`��x�[���p��&7���md>}�BC�������v�%ı��fo�Le���S�=4�Ў��-�����=���3�t�i��~Ǿ�Лw?>�>���+�7k\0��q�gN_�b�p���A�?��8�P�����q���\"<3gח|�=������ \ZQ���]X��1e=���_�kWU�Fmb�d���챼?����&�G�L->��$�Q��L�2���������7�-3�D����!�%��1�ү�w�_J�\'����:���#�.4WLv�\'�ұ;����y��ع�Ptͤ�ý7��J����F�;�3�F��.Y�$��f�d�Ji��\Z��T���W>N�p�Ɲ���MOg�n����b����%7���y�\n_E�w/���I.��u�?l�����$�^K��a�^�o�O��r#��z�WAo�:�vnaE8G��mi�=o�K���Ǖ��>�P7�TRPq�n|i��w�H�V���ەq�$�UG�w+HX�/�\r;�*<��\'�CGN���#c�m�{�MC�ڨ�l%S�5�҉��ռGc��?h�U�ڎ���%.��0�Ve:F���=�iyz���t.b��d�&�	�F�\Zn^���\\��[h�mE��K�Q��X *�*n�-<N7)`ǛRt94j�/�6�\0v��:����y-����3�7X�=z�kX�[xI�$�������Cu}�E^+1rF~`}Z��TT���~��H�<�����\\*p�Wi�k�WE�@�v��oX�kO�$�+�\0vc���\r��\Z�	�e�:U��QdQ%��W<ۚ�\Z�2o]��\Z�� DV�ߊ~җuɍ.�v1��d�㚉l�	�3����7�:!n���Gh����r���}�	����>�d�!���\'��9iI�P��i���U��79����U{���U�ʱ���b���)8�3��rwХ�D��/���~k�bg�(�c��*ڔ�`��/�r�����YcΖ�W_헋e5C���X�|�:��s6�7�t�jvt�5&T^߆Ϸ�ّ�&L��ȹ+ ���?u��.�<j��ݻfeX�	q3��g��|�˽\"�0&5*�G\"��q�F�s�dy�������\"�_�)WکH���m%�7�\"�&�/C\0 ��y��X��Eb�aV����F�XF�\0�:��P�n#��\niz��D6,z���>bOaC�\r���c~�j��V<kE#6��e��/���[ӷ�U}E\'u^ԧ���8p篂��_��L�=����]��\\q�Zk[���|���pbz�\n�/��<�Κ6q��\0❷G�O%Υ���9E���c���5�a�ڴb��3�:-O�r�q��������o>PK�������`��Y\'�v�-?ҳmb�E|���w�l0)�v�Ȱe�b[�O��D�*J.F�w��,:C�ٯ��a>6�KG���p�U�=xΘw���i(=y�(����K�M�r�۫\\�:+J��L�D\Z0CCtQ{���sd�Q�īK)e�z�k��������V[��\Z�M�T�$�n��\0�#�)P����Z�lM�L\Z��j�ꫪG5?��m���Y���1\r�\\��po>�2�\"�2g\Zv9�U`Q��R���?I(<�!\r&W�}��\Z`�,�ǿZ2��$B������s��T��6W�z�`\\<ӂ-�T��= ���F<���l�;iz�I�7w�FdeO�D��2\"���]���K����3�pG�3�c;W%�t������\\�����*�����J�|T3���D�޸�%LțO��N����6��;���k�<�a��%K��9�ȡ ��4\\�)����\0=�=���gUP����@�\0_W%B�էÄ�8nD�����PA�bκC:P��x�Gȧ��7���^�Z�ͺ\'oV�^Sًۆ���\ZP�ZGY�J�@�0Ə6�ɫ����Rl��0��\n\\H@��/�&��#��]��pP����iB\r�����,�޸����á��,���N���j���p�v�9H�^AS,��B5�T¤��6#�)��+���V�j�)7,���@��=��S�؋7�+^�`�uЧ��8�Y���S��aM)B��Y���׮�D��ӱ�N\Z����<}�ra�\"Y���ϯ�qs�j�����x���o��G2B{X^�K�g(6sBh%����]�x�P�qQ���B�A��#M	P�Bs��nju����¢9�L���q�֧���V��	W�5xi	���T���T2���QȂ����Sy5�=�]�/}1��P��d׼��8�|#�	�D�W�Ӏ���Y�}GSB�8R��uS�����X\r��	����L639DN�J��-`�Q#���nX��?Ҟ�\Zt/���G������h-�4�u����]�↖��\r�M��+y[f�4��b���h�`�\0)�6��{tS{΋��2�r���u��,϶Ǟ<���iVD�.7��A�S���4�|�m�8����痸�i1ȥ�+�����\0�!�^��Dq�A���g������Lm�������I\0#�!�a�݆Z]R��O{��v��R稄��r�T���j��h�J> ��z�-���b+��zj� r������i���l��1���R�*�&|�oŀ��N�q��V�4�����!Ա��;&�^��-�P8\"�:���=��&T�#�\n�O-��Ć^a��U���ӠW�19�]�A|mL��k����\\�Hq�x�Nꡀ>7�������SV�><L9:���N��H܈��L�I�`��AW��u�ﾈ�J���*���|�}��o-�c��q�]�ӏ��UxV�5���T[p�uǝ��}���)��OW:*��H��I/���^��W[�����ɜ���I���|2�6Y���,�⁄?�$�_���!ߴ\Z�թe�q�i���\0����L�~��T*Eo�?u;���&&7��T�8StMPҍX���\rHM����$�|=J/[��#�{�C�eIU*J���sFH��}�C�g�u��\0,��]�o��ag\"��	�G[��#JX��	��v^Wu�\Z�4v���O��O@�8zݞ�9ww)f����\04z��P�|(���O�;\'���<(k*�CKjȧ��Ε�����V)��e�mK�n|%�����N���͝&\0v=�xDg�������ғ��6�9Ej��)��^����lMȍ.�K:��YtX�{8��M�im�x��g�?\'��ˆ��Ǹ@�w�}R�\Z-e!�R�\r�ċ[F�H��~ �K�@6\'�>-%�	�`0x�D�Q!�Z����] h�l�q�@<U���ZD\Z��Go<٨\'a��J�2C�}XPI��̓��Փ �ΩՅa�15Xk��K��3�U��Y,����D=��xB]}5��.�N	/$��c)�z�7�h��Q�m1y����F�`Ae����p�0�q��]�lm�V�5g\\� ݼ��d�+��\r&�$��\'��s����3��rꢉ�z�͚ӕ�,t����Ze\'�ѥ���HW��x,qY2�_��!��8����\"�5���3�h��W�y�Z�F�g����[��P	�e����+/��8r�BGnPn�Y�4�\r�5��N������	AA��]A���E�u�xr�z ��UtȘ\Z�]����y������q7�dO��5)�|�k���֗�[��J������ph���ĔH(�jA�\n:k�^�-Y�v���bLO��`6\'�� �*�vV:�a�M�P[j�2��/#�pٙ�ӖY=��Hǣ����$\";<03m\n�f޸ڡ���#����f�t\\}N���ƍ�/�?��&���r�0�WɌe�^hA(��x�P\\�N{��@��*/0�,��\"��m��y�`�Fϡ����-��ȋ_S.�w7��\r�-%�f}�1���0������Ia��Z�������D�qr�T0��>)�Y�q���N�*��$Ocs�n#9��i����l����߁Z��A`�9<w�r|P�&d(*e�M�1V���Ԙi���_�G�ӧ(����G�Q�<Q���,�<X9�L\")JA(�-)���Ma�����q��ئ��ƿ�\'�-��[�n�#��`���!V�&ݣG+������R����Ҭ�tu��J\0\'`�m��H�>�HPOq�2sDc�A u4R�\nAVh�	[<�ߗ���љ��A���l�J��Uˢ��&��@r�G�����&�O�,\"�_�B7��ѧ�GFD�M�-����d��q�N�(�~g�\"�=��l��}:�x�x��6IQ�8�eԚe��Z\r�u�ᘧ���tGj]L��`���4��0ͽ��\0�� �B Dw�����M��2��ز&��*R�Y獋a�9)n�o��!���uȸ*�cɋl����x�0=8I��:X�3�d����R�q*��5Y�f~�[���[ވ%`!�<��dÌ�|4�c�\r~Ю���qv��v��E����\0��<x�z����&��{�$� jB��\"MQ��w9u�1�F�m�l�E3���B���W�.�� lJF�7���9F~�R\0V�|�\"E\0y2��&�.���c����e����!���\"��|\0\n�b.�w(��o�7.������ԯ�n��?��Q	b_�J��8=��-쯝�hì+�	Q�o�ɵ��v��|,�wU�$ƺ\'��o�em�����\n�r�dV�ň�(���\\��Gl���I�c%���x\n���M�ٰ0k�܋���&�ʒwL<�>���),�<�\'�s@�BvT;,9ó�27d�kB�r����\n�N\n�(\\W~�5��Qt�II#����8b�j1^O�N���l�@6���RK�\0�p��d��ȻI7��|b��D�çQY>�)�u��Z+�i���=(��s��n`��鼍�ӄ������m�uK����fqW^����0��Ù$���B.ۡ�>�V<4�\"7o�?�;>�y�9I܈㱚��W0�@�a���\0�8�_l	��U&�U=I�����	n^�K��M׸_Nr5��XkN��}�M�#Y�+H�~L+R�B��	�������~ϸ��:��-��w�9Xà�KT`��(C0j���ᵌ�*l���Y��@�� �J�\"�N�DK`HN�Yx��&G\0�/Jo��gJ+��/?B���t�fl�^�lY1$w��]|J9�U6מw�UI�H`���%b(�\Z����q���\Z���j�����9<	r#�\"W�k{3_-���Wۀ�6F/*HEv�<k(����s����?���B���g�����~gMP�j��i�p<�k|�3�ׅ����j�.�1gS�oX����*����g���0.W�r]6D\'�v|j�S���<��A�i5��t-��a�W��Xg�����\'B>�\"n@�C�\"G��2�o(Q��,�Wf[��-�q���S��ѽ��v�Q2g$r=tZ	l.-ȟ�-ӯ�(͟ȇ�/�n���֏���M�	>}6}��@���vt�u\05�oϷ�Zl�8�j�+\Z3.g��z����?�)W�������ֵ�+W	u��uǧ�oq1g\'�,Bn��}�\0�D$o`�+t��N8F�q��^m�E(G������r��o���c\rf,�DP�\"��´<�iOd�z��B�0h\r��\"�q�J	m���$҅,��b�����5ȟo ��\\�\ZA�9��r��щ�\Z9aM��=P������w�4}FD�C��)YL��T+�AO��j� H���7�]8��Z�V�����T�/���3���M��~I(���+�$�7��MV����=VVmńI�s�0�T`j��B��T4a\\z��i-����s��G�r�GZu� �\r�����c0�u���ڧ�\'j|tE$d%(�]E9��c?K���5?�Q�T��\'��?��o�4���)�-����)�[��flc�-�j����P��)�7t*E�\\9����ͦ�n��Ǣ��q�\\�t�é�3{A#n��O�G۝�d�\Z�!8�y��_�6/�w�5����Z����u�ل�q�gb�!y{����Td��]�u�����#W�O{�H�����6�19�u����V�`��\0v�@�Ks%�n�q������;p�:;�Tg�=n�(��58�?i����o�+};@���\\%=��-=heOr���C/�ۑ����L �D�cgߕz[?��p(�|~�s.�ix�h�̇�ʀ5�<��M�5f��tcˢ.Jי㟺���g_6�9`H�T\"}4o�C�o�\Z�R��c6���� ��#SXz�<B�ˡ��MϞ^�q�%��cb�Mnɯh�Ĉ��l-6:��ң���-$�yCٽe`}0����Y#}ϣޔ�SK0�\"����+�ٷX��X����m�~6�S)a\'v�x<QA`e\0�h^����\'Y-���;qi�K�\\���s�9v!��u;g��aP悖�C�����\"��������N~w��,\r�̣?\\h$�\0PJ����T�Ǒ�Lnq����}�����ﭩ�3�(Ъ����\nH��8!F�i���HNw�*��\\tl���h[ofBSs�U�9؞\'�1\"3�,�����Խ�Cb��o\r�}�8�UZ�\\wYJ��-�����Ͽ�lz���fk����4;]R��hET�C�fCL��&k�z�냈�LX0�N�r��x`��):$א]U�� #�d���4��f#���*�o;�`W�\n}L\\�\"j�O���U������_�a�m0�١!�\\3������2���L���7)s�B9�����;&��f�c̸�(l�d��v,���q��IhJrx�jD�l	G`DA(XGgTˮ��r���]�i��J���%�)z~w��8�wS��f��\'����}i���(A�?���c���-u����@�u�<\'�L�А���+Sk�\n��;�g�*�2���4�r��y_�O��G�v!L�ƛQ|x�B�p\0pLA>�1�G�;pD.2t%zǆ�9�9⁶Ɲ/dk\0J�T�\rƠ�%YP��0��, ��|��A�\n���ݡF�8��wA��x7e���<��u�Ap.��<0���G)U�Kp�2R�G��x�� ���\Z���E�Y�R�l��&�:3ImO�g��ZC/�|=v�,�h1E�P�1��;^�]�;�\\����+��Hu���M�0���M���1�JwQk���t���1=�#��,wz�)	�4F�\Z�|$�x�s=41�j�I0��wݧ�+7����e�����!��2����\"fƕT\\8,^kF@l(:Z�\0_Sn�5K�sz�\r1��$�M����w�ٓ��T0���z)����T�}�K�����K�A�e��M�5I͖Q 8�{�9�,�N�a�������GSr���q�y���w��m�)���@�63��@xD�br��)��	�.d�_6\\l\Zj��n�j�3\r{vP�����u����H�}�\'�\\�>��9Z�9���ĵ�6!n�jZ��r}P�p�p�C���7)2�^�����}��ܑ(�s\Z�ij�HzёK@��LB��Ï�\'e%�\"e�$~M�V>�����A2�h9�2�k���a,��<�N8��I=�t��r�vz�tG{��F+,��G�Q��H�_���jy!=+B����=��md���ȇ!I!ࢥ������Ͽ���u̾\rT�#�%6|o�ށ�_߭Dx�/������ٞ��!�!�5�,��>Vo\Zz����Dpژ��0��1�����S�ec	K-�\"��=Z=�7+%p3�� �r����(�׃�����ewq+NN�@uߓF[�L��~�l_�Zq�S�����f������bT�Y9࣎Q9kt�ȟJ�T���F�4����޻��ONV\ng�~�_@��MyE������ͱ�QZ�\Z�cB�>������%��~a��`������lV�Z�r�-A�|�3&į��G�I�ZB�1��d�Xkڡ�9K\naߏ�B]�b�r)�v�e�<|ʪ������+Kz�v�p\',,z��fI��c[��Ѣ\ZT�m�gT\Z[��ܵ�FU��}�B�����\n➏d7��5�O���r�GL���\ZWV���}��#���,?�M��\0g_Y�-��p�/o��Ǎ(!nn]��\0��Zk� -,lz8\0ٝ���j+��Sm-�_���s���1mLO\0�c9�2�k��|��\01\\��Pn����yR�(L�O�8�K�ؘE_�`�\"GV%rْ�y���i�1%��ܪ�\r�A)D�QCT?��n���A�С�mV��ܺA^\"��g�B\"�fI%�w�U-�+H��W@cr��f��DhI:��U��N�,��rO��_��]�e�K�h\"�?`3�;Ӈ�M�^}�A4�iEU#�6c�܀>����\r:����|�.���0{�X�c �6�����!��>�Ȱ3ᣙ�X׋�(�y��ispȣG�l�=cb�a�΂�*���d�$���Kt��%��CG�������\\ �S�m���>��ΫȬC�No�������5T!�Rz�����#�\0��A|��44up�Z^��Yh80�.,\r�;/3t��m�A��Y�0F���7w�W������tl�`�X�]���,f�^�j�$ȫ�N�-X�-�A	3�OD�:��թ�6����%�Ph>�&{�U��Dې���O[��}�$V�[�Rb��=F��󒚴�\Z&oN�N�8������\"�y ��Ʃ�v�w3����bX8�H�HL�a�8T{���py3.�/�I�Cɶ��^�{�l�$����)��> �OU O�w<w��fc�-�y�`��H�Wk���M�z�I���Ė��Y�F�)\'`q\\ؔ�m��AH{Q�C|0l϶\"W�iO�]�dU���?07�<����N\Z�p��	[\r�\Z\n��\\xoB��r�|;.�X�����s�88.g_q�=љͳZ����O�C�<���;�}w��E5\"��6&0����I�AR��\0����6#��t9ε� ?�����CaWnNu��2���e8~�[  ��:�De���4jDЬ��;�V�d޷pua�sU2HR����G5*PL\"7]���|�F��|������~Q����1}�M���h��$:�6,�\'!��&��@�6zQ{eHτ؅� wJ��]���J\"~�E�=\Zg޶��\n�h�����M@ \Z�, ,�Ι�\'�0�1v1�AZ�X�`��q�����:x$B܊��o���VD��c�\n�����Gs.^\'n��N���tu���qܳ J0*@���k�B򄑙A�P�����דXM���a����S/ú��8o�� 4�R\\�4��>�\'(�C�`8��275�0��V��k��%lY������xy�5��Ԅ��hm6v&8b�J�oD����p[c�u�UF��%ꓥ\\S��)-��vq� P��s�	!���\"Ok������e�P*���^x��o9��]�=;���X��� ����w����s�����ߊF?�����ژ8Z>�������cW��S�+u\n�����<�_V�	��if@�5�f�aڬ}���jR/tPFXMK�/�n1G�ZD̅�n�H��\0@ʓ�2O�}�&��y���qè_��tb��Nd�&��4�0C�k�>Ɓ�Y3��Z��/��<՚�6BR���>������P��=��Xl��M;�-W�xJ����3U�\rs)m�$�Sza�<�`�ti+��H���Z�0��!TFv.���`��@��Y�@R��J;k⋉vN\"���`ʤUUD!�Y1l~����2�$wU��@�\0��&���h����ˉ�����T�\0���rb��%��SȔ�p�1dv�f�w�G��aN�\"���?yF�t���l�������S����-^1�\r0�Gr��}�Z�1O��J��l?]%�ø\Z3����T��.sIzA���nY���מb%R\n�W���uљs�Ml�7�п���Hzc6oS��Ʉ���_�za�zm�эM㑫=_z0[�,���#��F��I�kQ��Ν�� �c�����P!��P��ͯ*\Z�!�1i�1 	���w��#�ۗ�[)��Cp�#9�+�ȫ���Ί�?ҷ�L�O��C1>\rP(_a\Z8�M/^|���M@����|l�� F}\r���GlOXfs �l5t��w�K�	A�ݨyLNӑ7�栁�C7�4�:i����|;HC��Gd���kFś��K\Zӭ�h�h;F/�$�^aP�و��1bh�#�z0��Z+��꣸�,�x7zɠ��p\"+�*)q��Q�:s;�)��6f�\n�T�!?.mc��rPK������ך���|�y��UtT�D��u�Z��Bq�d�C?��E�����j�\"95���{�ƈ���W{�ZM��(.i�W})�4YMO{}L?0E�&��;���ٛ\'�C�\\X��m�b����b�r�NȘ�{xD���x6����c�\0�ݏ4�M���p$��֓(����v��X2>�`�@�-�<�pRy[�����LLh�Zds�aEA@޹Z�#���U�7�\\���-̀��ݙM��7��2l�l�{>~Bԉ�C�2�\r�D��$�g�_��Ы��D�.�[@�}����b�+��fHe$kX����t���9�[=�Ⱥ^������0��G�k�\r�b${�Yf����І,���S�9��,�{Ev������p�(���\'R��7w\Z2\\a��aj�e��R�������zKU,5�I�P����8_<,�8���\Z$f,$Օ���4����J��{��!8#sӏ�O�V���Z�E۲$q�i��a�?���l�N�W:!�7�.xȭ<z\0\\�EIi�O� ���Ҋu�-��\r��MMI�\"�QM�H�2Hkp\\�e����G���a�V|��Z�_��g��Pd�b�nY^͇tÌ��������n�7d�\0���r	����ʦv~naOJܮ�mB�ɭ����ʭ\n�y�/#x����JsTF� �c��\\�D�\Z��P�c{�u�]�_3�H���ُϪ@�mF�*i��r�M��w���Q�Q9�Omj�d01kn~P�* }\"����$:e[\"�	.�I�/A�#�{%�h�X��N�21<���xߗ]Y�P��~�vyF�B����N��猎�.-��Wcɼk�R���H#����T���\'\"�BS	��n�i����q��қV�Ȧ]a\'�{�}֕{���b��Hߨ��q�W��w� �	�!��q���?Gm�X�*ށDҼ�bIB�^$�&L8����o�t-�4�J[4o#&2\nذ�񥍟�Y�C��@�	�@�k�[QYa���hOƣ��KL`�<�D:��[P��-���6	�P�s�r3/ �S�2���~���ܝX����~{\0GI������)����4#Ɋ)�A.�4�I��>�0�X�6j��^,���Lń�*-��C�\\9�2UAD\"�ONȡ�w��-�+��V�e�|fW��I�l��	��Na�\"�\0垷\Zo,�*o/=�9,Ա\ra���6��x�d9�ASP(dL�O�O�_��H���ͣlt��@<i���y]둝n(�}|܁�6��hP��~߫�x�w���X����Y��[�Gn�.\n�̭�,u�-�^e�&\\�YJOp�rw79\0�%��<�B����(�݉���!�z5�s]�)�7���pa�~���b��u�|�{+�;K�X�&^s����[��[��B1`*�@h��b���S5��O~�<[-)x\r5�g)�z\"8��)�6����� ��ˬ�\"���M�B�oHV��˗v��\Z��\0���A����U�(�Mff\\y�z�_2�\"�����s�\n���T9�!\"Ƅ���m����l:��{��E\Z?���\'0x\n���P���	(�d}ٺp��\'\ZX�K7�zd�D����p&xF�ű/\'�~�5B�O��\rm�$k�Ƥ�)��?�O[�OsBH���ݎ7>����邎��b]�a:q���W}j\'C>D3g2\'�W�9������\'V�g�|.�<��Xׇڞ����W\'^�����S�G)��9~���0�d�q��g>b̹,\Z�C�����eu�\ZQ�ʕ$�V48�����3R�2�*\\6���V����q\'P;��I���<�AZh��S�ӆ:i��IMY�U*��P������[�1ɵ�J?�h�w\'vZf��O�e�to��ܠ�>2��3����v���K~N��7}���7�~��v^�j�j]?���L�ش�y�Q��ymJ�e����\\�1FT��!�L�G���y�J�HG��J���].�\n\04�kD*sB�\n9�L1��5̵�m�uE�_�G��U��\Z�2��;��<���|����KW[듎��iV��J{���V�hp�ӊcQ4����Z�$�C:��,O\Z��:{\Z	���G�\\�<uT��]c\\D��VU���\r����Y{Yj$�MR�:�e��h�\Z���\Z��K� �\rsp����u�&eD_E�+��Df���9�0\"��&�ʀ޺9^~�I�:�*~�_r��p��`$V��\n�\'�s0���X��������pq��b�M��m�F�����\0��07��at�JY�>\Z�.n��:�i������L��Kds������	~�;�4Z%���ϔP�9n͐ٓ�\0$F�ۤ��:n_~��τ����7#�j?�<�1��_�Z��W��pr����0��A�&k	6�V3;M�\'��U�ʼ^�B�3���ns����V�7On�V����_��`>ef�\r��ȼ̰DԮ��Q�XE�Ʊ��B�혈�<}�;\n5=>\0_xjDg��i۱?ߪMe��i	��\'�e�����v$]���i\n�C��~_��`>ef�\r��ȼ̰DԮ_��`>ef�\r��ȼ̰DԮ_��`>ef�\r��ȼ̰DԮ_��`>ef�\r��ȼ̰DԮ�u�Z��+�B�o�-�zFKƝ�<\'��^\'��9�M ̧�f�F��D\Z׊-�88�=�>wL�:�tRH��-/���}7�=6�֧�m0&7�G�J������B�>\n_)R�����<U�K#Ňq��\"u@�4���p�H�V%돚w���\\�k�6-[t���˖~���3�[s�*���Zcp*|A����u��G�)R!3_�XiC�\r�p���N��W��ET��7Z���H�6���6F�>�Vu�	����8�c�Rn�����D����o�3��߰y�+e&e0��Y�cB��)4���#l�!m��ʔ�?�G�le$��# �?�hG�\0��E�H]@k}����o�1�y���PŹ\"Eh�ܿ�do8��UW�\\ľ]<�8c�o}�c�+�f�+�b�.6��	��O\Z]\Z���Rc��=�Md7Ѡ\r�G�*8y�1;�(^���*xaR�����%���0�uVk���)�J����/B�����zԿ�6��P!<ooKOv&����/��6�.C5*}:�\0�M~�E9wh~�		�J0L~V;�������H�J[�N�8��V6TѰ?)�\"!0i�{w��s�	��PK�;�K�����$�,?�И�����Te{�ֶ6}@U��Ï��K����C�I��=�f�=����\"�U��p���C�P���w�Kصڻރ���7@h���\"�~=@N�$�A��x\0)���(s������Q\n�hBz��t�РM\\�p��K����1����$*�ܙ�H\\�\Z�2��gE����y�G�z�h4Y�$2˄�$ml�0 c��GXgI�\Zqs�UzX���T�]��[��\0j%�>I�po�$�e=�LH�lT!�3��}�J�kO�&��C0��a�e��x��\n�Q�%�O�XA�W>Z�M��l��\"�+�\\�z�d�N��\\�@\\�#�R����5Ƭ�װ\"����I�^LcS�3i<���\n��k`$�a��Nїx561]R��4=�ܷ���O,�w&�b�/�tv���F�/�e4]�_�oȹH������K��]��aU/��)�|=hPX���ߨ�\\3�碉j�6�����\'xy��I���1#0��\r��Բ������J,	Nh�He�����\01��DE�A�\"w	������F��l1?��66�K���>�|c�W�Ӯ�o���x�h4Q�w��u�d�皱\rM�}��6O!��Lvi�^D�VL��L.��U}�n3��O���\\�َ�\r�4��oS�~�+�R4�)3|�c/���r�>�Fy�6�2͵�ʠ�����{���{�;\'�h3�V�)���*a���NW��\Z���ÉF�Q1����\'����~?\'�?��J�*���a��yBW�6B�{>TNܕ��|I��9����]9��_d;)4��\nĀ�2��a7�N�e�]�|��~�툍�T;3�ƨ���6������ \Z�d���Wx�$N�;?=�)\ZK���\np��������cM�4U�H��	;��?��Y���ME���@:G-/�r���\\��lf� �^�Az\\�%�zI\0�vƾnw��sKCL���w�|��������Mכs˾��[�8-�Qs�V[¯C0t��)J�zdʡ#����r�e[o����N�c0�bv�:���Y{����8]+S��k�(�\Z:g�\n�����}Ԝ��1ٶ|���2��aZ{�#����2��;ţ���ǝ�5��([�[�x)Zޯ�-�J���I\0�����-	�Y�z����M)e�<�qQ*z�y[�/P�l�g�޶�����R���\0��V;Eǐ�f���C�xK�\"L>;�c��]qU��ȇ�󫴯\'y ������8�1�x	�Cn�A����eOY�JG�u��:�Z���o���w�Ce�Ӧ>�ȨM�����\Z���5C��콥TZ1������8�H\'6c+T��}\'\r}���@��\0���4�JL��6�]b8l�VnƧ�ѽ��L���I��k�з�X~Ѓf\r�[�(��\0,��cm�M�$�\\�aE�u��\n��\0�s+\ZT|�Ⳳ�\\M��:\n��VTS�p��g��<d�p�<�6\'��i�2Z������$Um�.b��-��{�2/�%�Mlmު֖��=�/������\"#�m�0O������ԩ�����Y܄�UXyy��K�㝲�V���g���j���70���a���P]����\Z�	�ʘ�]��]*\nO\Zu��YFz����2�ؖɯ����\n�_��:\r��5�굮\r�\\]/�wEƤ�\nw�XB��̽��e�$��|z��������k\Z�~��dQ��6X��WG��X���;K2�Ҏ�u�蠀,���?�а�Y�ȼ�.�ANV��͢��k��!���9�	tµv�h[�	ɜ�r�1���=j��[pk�\'��ْ�1\Z\\��hd{�\n+��c�5�3��LE�<�쑣Bq���U��F2���� �H� MV����ǀ_��C0f�g=��3���iG�:G3�Wܛ	)��g�������չ6���|̫�I������P�b�2}����\0��� ƴ���.�	�k��8�C����~�ƛ�T��\\�u���&r���G���i0Ή��u~��-Ch�i��e���\nQt�����!G*�SzYB�W�Z��5���#�`�Dɾ�\r �}��(]����w�Q�u������(���\n\'$V��ۛ��m[*�(�.��(-��b3|�~�/�^8�t��ڰ5�o���uzvka���&��=�tw�eʣ�x��<bRV��+%�\rx�B��0��RUػH^n:\Z]o3	���]/��|�����S�R��Bқ�	l���C��s4��9��4Kv�4� c)\0�5�0HF<��O8ڝ�\"v��#^����.�q�J�O@=�vj�oDX�����4=��j�\0BqW�ҙ U\"����Y)��;�$�1<Lu���S@��z����f,K�� -	��]͉T*r��&)���Y�Ii�4X��﷮/�^|�u���	FG*h��͗�@)h�ʹ2��h�C��a-�d�J�W_Œ���w�E�2�+�~��΢��g̲G	xI�\Z�_2>�Ц���W���:���%�L�.�1�Y!����[B¹��IzVn9i��4!�3^5Jv�0�;OgB)*�`���9U1���iȗFg�r]�{w��m88�iY�W�E�ݮ���Z��6I^R������f�>>H�`ל��EB�\n��ʊb�Л&:�&Z�ES�8H�u������F�ŻZt��`���.�$�|\"(����.�/�M���1M5�	t���ˮ��f|�q�����:��-Vnu� �qb�?h�AE���B�;kͽ���\0R\Z��1lз~�H�ī]Jet3�k�(��&kƇ[�̩�(KU��#�����d��B}���4�V[I���`��Y���$��z9䋊�ހ�����Q��x�\"A�^P��:�\r2�gF;3��m�VӊGP���x\r��4g��q��_*��csCRd���\\i�W)�w[O1��9�@���ֳ;[�ZT��<��Tzy�e1�w^h��1�V,��\r\n�)��H�`V��&�͠ .?D[��ߏ�O��Oo�o�\\�r�gMy�x�ok���k3���4[��z���m\"VFF�4�XC���%}>7>�o �^���;��ŝ�+ ��H��Xlf�\ZK�\\(,ᰮ�_�S��OId�<��g��Y����m)�y�����<�v�w4�<�d\rK�-x�a��wب!�A�Aj�*pzpa�\']\n�i[��!p�LmM$giY�T� ҧ�L�Ea{Q�~Xv���u\"��2ӑN�@���^�\"��Rm�ڢ��e1>�\Z�lt�(�>[n��>�,��T�Ħ�d�0�)�9��̐��r�JUHO˧Q�Q�і%):\"��9o^��U0���ZS\'du�x<\\զ��2�U�rޝa����:g{@��l��C����k\"6�����`���h\r��bؖ�h�1:w�`C�;Qh��CguVo�$Q(�F�ӳ������ܰ�3�ɑ%����\\񑺘f(�?ަ�YV�r���;f�9B�wt�	,e̪�,�x�\n3PĆ��8J��&of>�J����3y�ϠU����1�ee�eZ�@Sz6���k(z����4�į7|ʐW��7��dL�X\"�?�~<$FBZUZ��B��ބ�M�]�����5\0S �*T$�7_r2��8�b����b����Y�%10|�`��yە޾|H�j����G5��\r�F>��Xϋ�W;,�/�49�0��̶�,ZKɲ\\�\\ZE���B�}k�IM��ԯ�7��4B���/������J��3{� =\nt0��E��d�c���>�����#fg�?,݋))4�~���p٬�k�:NQ���A[��R��]H�7�8SxG�:�3Kp�(���7���U�����k���+:Y|�w��Ev͟������RӠ�V����.h��D$��5$�(?ׅhX(�.��7rH=�$v�%;��ŗH���N������s�N�[6�8J+��N\n�LǉC1���XZ�]@iN?^,J�*D��v=����8�{�g\'@ ˊ	~f�k�Ǚ:Ӎ�U\Z�wH1�*W5������6H<9qt�r((gGo�sDv�Li:��y]:�Y1��f�\nne\0�G6��ǉ\nK�HwP\'q1/����j���uoW�ǽ���e\0Z��(�\r��Ɠ���\"�� }�\\���X*�������H�!\0O.I��]��{]�;�_�\r��е���b��\0	��y=�)<y^F���c\r��f�Q-}�9�)ހ�{��v�`�w�\0V�������hޥ�g�rE*A�|C�d�)η��;w��+%׮��3��#��<-a��@^>�6���x\r_�\0it\r<�F���n[mZ	>��;�\r���12���$2�ǎ؇�%gr/r�g���w�Q��Hgn��*�Z�����hD�����&�}����@Nq�\\%50˵@�Ii�`�NH�����a狯�1��y+��Y���D��&�������㳈�,f	����A��hO��X����7��)\n�X�t��9a�H�H���G�RV/�ȮZ���#�ck\0S��=zC��G��s��X�X���T&<�(�#3��pH�\rx�@�#̭ZF�����e�rӅ��г�>����{����)���_:6��ޒ���b*�N����uj4��q�u[�$��7��\'\Z�U9��g���^�4��A�MT��;�*��]:]���M��b�c���Ձ+��t�r��YT��F��AȞS���Gb6\Zk}4�>˻U�G&0]�M��n�%��`�s�\'�D���;���Xs��nȐ_8~:l��Ӭ����o���� �f\07��������Y@C�d�R�[u������m�\"ݟ:n��J�!܀�c�)$��kº�/$PaZ%a���!>��?�$22<^�E�N���3|�.��P���J ��M	?��잟X$��ګ��R ���J\r���83J�-۞�G63Z��J����]�V�`�s��W�[\\��+g=�ò��)LQ�����Xp���G��w�T��B���S��}QU��+T�WHEX�m	��Pʾ}ee��dD�X)��ωo1j�\"д�4�qO��ڪX�������O�RV[zװ�N_B��lm)ؓ\0$i��Y�po��D��7��8]��a��x\'��G��Iܳ��7+Ǿ��,�r����_�`�\\e�	j@wfn@\n�G�7<K�M�4]��)�����l���ч(\\v�I\"��9d�{�n��a1��9j\'�r�T,���օ/���z\n��hS\\��u�\r��)��9cR�5%9]��d�-��c�\r2��JM`��P�P�F��Şҡ\r�:��µ谘.�B�ݶ\r�\0!}���_��E����Ixe���e4��أ����P��{C�4_Q��{�k��뇘	_�<���;`�]��}�:�Hd[sF�\'.������=-m���D������	a0��=v�%�����n8�[[T�Z�n}\'=��\'s��2�o�&��pG�-�X�Һ��bV��1�����j�f��m��ڱ��\Z����!�e݀����r�͔�GJ�fd-�R�饬5׊���zV���\"h<���ʁݷ���e�up��o\Z˅hM�{��c�ܺH?#�Sxs���\0\"$t47\"AG��@\n{�m;Wb��\"��/�Y6��QChً5�������Y��\\����ʪ�1��:0\\н����2A�\'����]�@�zO�C�d$�t�\\}W��/��2(��mG��?G�u��H�w��2�Ս��Bu��d�~qw�i-�%-�*	;~,��~�����.��r@����g�UU�$����MҺ)\Z/ڷ�4h�n븶jf�qYV6G�9NΪO��`0�P�\'�e5g��ma�Ȟ��ۚ.��9!����3]��S��d�ד\Z@\Z$8^�}�J�w�\'�w7;iUr����+��Ys&��O슑�$>n�Eɷ�qx�e���]���/�\05/s���%2:\n�BI��R��ζ�I�@����%fe�<ѼE���n��t}�=0Q�Ai�}5�8o#�^�I�#<K蓨Y\Zv�;}^����*�;�������)�F��%�``!�e����:O��],�6H$li!���C�;pG��	����10.�t���c��ԓ*3L�K87�;-��\n��f3��UFs��ѷFj�Y�-T!�8���H%��x�pz匑���U�\"�mO�`�#���L����q)ąO`�S�?e Ojk���U�̭�/��.2��D�q�Ӟ����-sm��t�_[�I�X���� �����?M���E�l��7I�/(�R���<sX*S�*��?��3ڰ7�k�5�QXQ�m�Y�+i�BND���������\0�,_�{֧�i\n,r�0�7��\ZB�\n��Ҿ�M���@��m}�2�d����b;�z��up����Ϋ_��\\:��\r=ב���1�Xz�t��5\'?�,V\"����7�3���N�\Z].��W��\r���.\r>�qszU��X��K(��$^1U����i[�����������u9�Y��5���a]\n���w�|���-����\\Q\n\'��]~(�s��rҽ�p��f{!��j�ͷ�9)@�q�T��x�)fK���Tvd�㽍a�� �}5�+\"S��ۦ��Y��3Hx�^���GS�h%�hV��w\\�/\n�\'\r�ʡ�{Q�#�ذC�yTQ�04�S\"p�$�ǁqy���K\Z��K������֊�D��Ի�G��)��\n�~�謙ű���3\'g22ßY�%t���z�@�;�d1���.)p������+����Y���.yV�:�X~�]>J���i��C�\n����;G@��!�Tb��?��b�,�:ʓ�#�:���� BE��o���޻����G�����* >�5�lě�/���Rn��RG1@M�����n�A)V�El�_���\'�ݴ��a/Gp���6%����k1�C�3VC\r��T�)�eG��%���F�n�Nm��M�Q�\r�����d8O]�F�Ć�,\r5r�}�q�w��^w-}��7�b�va�谘h�$\"�$��2�]�.=>{��>\r|@Q��@�	\nEҙ��dY��ʆ���ɉY땨�)S��[q�f���3QĽ�*�w(��v��}ǦL�A�N�E�����w;`��oއ^��W���3��x3���9����?�a\'���B�!���\"a]t1�(N>����%\'�e�cȘ�\0�>���d{OZ\n+��S��	{���\0l�o)XB����[�oڹ��k�����ڔ�2��)��3@c�/@̧;E����i����(��[�_��=`���[P�G��#1��I��O<�*��mL\"����LN�O��xTm���Tԃ<\Z�Kˋ�n3w�������	�6?��]�����O�g��0GF^�Ӽ�v��o�ue��%���V`�2����bP��q�G�a(�CY���`�M�R������]�@��M�8��)���+ņˑ�W�A8��ɶCۍ�-�l�:!�Y��PA������H��Mg�}t����!�cu�P�3��P�a@�)Y;������v�k�u���Iу`-:Ag�]����&�Jc��u }<�5\"$r�Ien]�P���Y�`�\r�*n1�زCk�ԶqL�\r\n�-�t��sr��$��2\\kʿ\0@�qMS���/��m^�����	���z�1�.�Yu����?�w��ө֜�14���eA�ێ�$/\Z�xe֟���_GkLmG��c�5*B}���#eI��r*z�G�D5�1�T#c(���̵��q�w�����u]�������0S���q`M��b��r��6�)!A�������Y�A�G���5�c_\"�?_��\Z�J�}�o�u��o���yհCi�t�+5�l?���{N��X&Ѳ��B[;��4h���b,�D��v����h*��C\"�;�k&�.�p˶{�EF����$���.u�Id�g\0�1nS\Z\"PI]3���m�a������+�����\rA��T���\\ee',1,'2016-04-05 19:25:29',NULL);
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
-- Table structure for table `twitter`
--

DROP TABLE IF EXISTS `twitter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `twitter` (
  `twitter_id` varchar(45) NOT NULL,
  `twitter_enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`twitter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `twitter`
--

LOCK TABLES `twitter` WRITE;
/*!40000 ALTER TABLE `twitter` DISABLE KEYS */;
INSERT INTO `twitter` VALUES ('1',0);
/*!40000 ALTER TABLE `twitter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'rabush@us.ibm.com','8f0e2f76e22b43e2855189877e7dc1e1e7d98c226c95db247cd1d547928334a9','Admin','Robert','Bush','2015-11-23 17:39:09','2015-11-23 17:39:09'),(2,'InterConnect 2016','3b03694a2648e768dd4a8e129c71987395a22427dd679bbb947553e6583f07d4',NULL,NULL,NULL,'2016-02-13 21:54:45','2016-02-13 21:54:45');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vm`
--

LOCK TABLES `vm` WRITE;
/*!40000 ALTER TABLE `vm` DISABLE KEYS */;
INSERT INTO `vm` VALUES (6,'A114','C:\\Labs\\A114\\vm1\\InterconnectLab.vmx','','clean','2015-10-23 23:39:09',NULL),(7,'A178','C:\\Labs\\A178\\vm1\\A178.vmx','','clean','2015-10-23 23:39:28',NULL),(8,'A179','C:\\Labs\\A179\\vm1\\RHEL64-32bit.vmx','','clean','2015-10-24 00:27:04',NULL),(9,'A180','C:\\Labs\\A180\\vm1\\WTU2015-Lab-A180.vmx','','clean','2015-10-24 00:27:25',NULL),(10,'A226','C:\\Labs\\A226\\vm1\\MQ_LAB.vmx','','clean','2015-10-24 00:29:29',NULL),(11,'A230','C:\\Labs\\A230\\vm1\\A230-MQ-Light.vmx','','clean','2015-10-24 00:29:50',NULL),(12,'A248','C:\\Labs\\A248\\vm1\\Session_A248.vmx','','clean','2015-10-24 00:30:11',NULL),(13,'A298-1','C:\\Labs\\A298\\vm1\\Workstation.vmx','','clean','2015-10-24 00:30:35',NULL),(14,'A298-2','C:\\Labs\\A298\\vm2\\Template.vmx','','clean','2015-10-24 00:30:53',NULL),(15,'A298-3','C:\\Labs\\A298\\vm3\\Server.vmx','','clean','2015-10-24 00:31:09',NULL),(16,'A377-1','C:\\Labs\\A377\\vm1\\base-win7-x64-vm.vmx','','clean','2015-10-24 00:31:25',NULL),(17,'A377-2','C:\\Labs\\A377\\vm2\\IBM_MQ_Appliance_M2000.vmx','','clean','2015-10-24 00:31:39',NULL),(18,'C136','C:\\Labs\\C136\\vm1\\Clone of Session C136 Windows 8 32-bit.vmx','','clean','2015-10-24 00:32:00',NULL),(19,'I97','C:\\Labs\\I97\\vm1\\RHEL64-64bit.vmx','','clean','2015-10-24 22:37:40',NULL),(20,'C20','C:\\Labs\\C20\\vm1\\base-win7-x64-vm.vmx','','clean','2015-10-24 22:38:01',NULL),(21,'A001','C:\\Labs\\A001\\vm1\\RHEL64-32bit.vmx','','clean','2015-10-25 00:06:21',NULL),(25,'ZZ123','C:\\blah.vmx','','clean','2015-10-28 00:20:30',NULL),(26,'ZZ345','C:\\blah345.vmx','','clean','2015-10-28 00:21:32',NULL),(27,'Win 7','C:\\labs\\VM_Win7-base\\Win7-base.vmx','','startlab','2016-02-23 20:44:27','2016-02-23 22:08:49');
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

-- Dump completed on 2016-04-08 12:42:25
