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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machine`
--

LOCK TABLES `machine` WRITE;
/*!40000 ALTER TABLE `machine` DISABLE KEYS */;
INSERT INTO `machine` VALUES (24,7,'1','','192.168.15.131','Windows 7','Admin','web1sphere',1,'SSH','2015-10-23 21:02:16','2015-10-27 18:35:36'),(25,7,'2','','192.168.15.121','Windows 7','Admin','web1sphere',1,'SSH','2015-10-23 21:04:05','2015-10-27 18:36:10'),(26,7,'3','','192.168.15.120','Windows 7','Admin','web1sphere',1,'SSH','2015-10-23 21:05:30','2015-10-27 18:36:23'),(27,7,'4','','192.168.15.110','Windows 7','Admin','web1sphere',1,'SSH','2015-10-23 21:06:08','2015-10-24 18:03:33'),(28,8,'1','','192.168.15.109','Windows 7','Admin','web1sphere',1,'SSH','2015-10-23 21:06:38','2015-10-24 18:01:27'),(29,8,'2','','192.168.15.107','Windows 7','Admin','web1sphere',1,'SSH','2015-10-23 21:07:11','2015-10-24 18:01:35'),(30,8,'3','','192.168.15.106','Windows 7','Admin','web1sphere',1,'SSH','2015-10-23 21:07:50','2015-10-24 18:01:41'),(32,10,'1','','192.168.15.104','Windows 7','Admin','web1sphere',1,'SSH','2015-10-24 23:56:12',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (7,'Room 1','','2015-10-23 20:20:15','2015-10-24 22:55:11'),(8,'Room 2','','2015-10-23 21:14:01','2015-10-24 22:54:57'),(10,'Room 3','','2015-10-24 23:55:36',NULL);
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
INSERT INTO `script` VALUES (1,'Test','Test script','/home/robert/test.sh','test','Linux','2015-09-23 22:35:37','2015-10-08 18:54:35');
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torrent`
--

LOCK TABLES `torrent` WRITE;
/*!40000 ALTER TABLE `torrent` DISABLE KEYS */;
INSERT INTO `torrent` VALUES (4,'A114','25FC990845388AC5435926E1879F4BD3CD130D28','/home/robert/labmgr/uploads/A114.torrent','2015-10-23 21:14:14',NULL),(5,'A178','27D45CA533AA8AE133331A99CF5E60030D7794F9','/home/robert/labmgr/uploads/A178.torrent','2015-10-23 21:14:33',NULL),(6,'A179','670C264009195BCAD61F8637E914E965AD3EA4C1','/home/robert/labmgr/uploads/A179.torrent','2015-10-23 21:15:00',NULL),(7,'A180','C9C5ED3B71FF7B213687F03E57DD078D5825E305','/home/robert/labmgr/uploads/A180.torrent','2015-10-23 21:15:20',NULL),(8,'A226','FC29083C145CEB46DBDAFA37FCB6A355A4D8AEEA','/home/robert/labmgr/uploads/A226.torrent','2015-10-23 21:15:26',NULL),(9,'A230','25E348913F47C56380CEEE5BB284250E7217EB98','/home/robert/labmgr/uploads/A230.torrent','2015-10-23 21:15:46',NULL),(10,'A248','B47B6155864BBFC651CC5C0889E9ECDEB781EBFE','/home/robert/labmgr/uploads/A248.torrent','2015-10-23 21:15:55',NULL),(11,'A298','E0E4082967DA18E67DEBB87983EDD765C88E16A0','/home/robert/labmgr/uploads/A298.torrent','2015-10-23 21:16:52',NULL),(12,'A377','8EC0CE8892909FCF4984EB35DCA879DD252D4AFA','/home/robert/labmgr/uploads/A377.torrent','2015-10-23 21:16:59',NULL),(13,'C20','9565055EBA6B81AF82C896BD830254A8336B046F','/home/robert/labmgr/uploads/C20.torrent','2015-10-23 21:17:11',NULL),(14,'C136','EA2F44D8DE9C1C4DCC86608D178311753865A648','/home/robert/labmgr/uploads/C136.torrent','2015-10-23 21:17:15',NULL),(15,'C208','A9D6F049A73B055505334A9211875F8DD4FD9EA3','/home/robert/labmgr/uploads/C208.torrent','2015-10-23 21:17:23',NULL),(16,'C278','B4C5C481DE3A268391E2D35DAD9276ED4869FE9F','/home/robert/labmgr/uploads/C278.torrent','2015-10-23 21:17:34',NULL),(17,'C279','474D70BAE28AA03835FC00967A2C19BFD03E2D37','/home/robert/labmgr/uploads/C279.torrent','2015-10-23 21:17:41',NULL),(18,'C344','D385224B46BE317B12E4AD402555EF21FE8FE03A','/home/robert/labmgr/uploads/C344.torrent','2015-10-23 21:17:47',NULL),(19,'I97','2B54E243F0CEE8943F724C69624D00B3879C0EA2','/home/robert/labmgr/uploads/I97.torrent','2015-10-23 21:17:59',NULL),(20,'I295','72A8DA2ED79E86256D89A1FDAC99B67D23E4F82A','/home/robert/labmgr/uploads/I295.torrent','2015-10-23 21:18:06',NULL),(21,'I326','C25F36602B0C4AC1E8EF7177BED25CD293117EF5','/home/robert/labmgr/uploads/I326.torrent','2015-10-23 21:18:18',NULL),(22,'I329','AA9B20FE9866971CAB5C1A4DD69F28D3037D9FF3','/home/robert/labmgr/uploads/I329.torrent','2015-10-23 21:18:58',NULL),(23,'M238','21FFC177E1A9F339D44C5CF57E06FCEC5C2AF3BF','/home/robert/labmgr/uploads/M238.torrent','2015-10-23 21:19:06',NULL),(24,'M239','143C0766455D590F839CBEB3ECB714788D756727','/home/robert/labmgr/uploads/M239.torrent','2015-10-23 21:19:12',NULL),(25,'I330','63210683F7BAE6144704912502F3B678E98AD568','/home/robert/labmgr/uploads/I330.torrent','2015-10-23 21:38:54',NULL),(26,'I331','3A27C5343B1D615B363B938DE51629761AF57921','/home/robert/labmgr/uploads/I331.torrent','2015-10-23 21:39:04',NULL),(27,'S148','7896CC3A107F42A04E61C5010F0AE37DE27BCCA5','/home/robert/labmgr/uploads/S148.torrent','2015-10-23 21:43:17',NULL),(28,'S349','54FBF9941947DBFFEB7670DFA5CDE00E7FC3F203','/home/robert/labmgr/uploads/S349.torrent','2015-10-23 21:43:25',NULL),(29,'S351','BF1C05E1A7BBB6533F69CA665E69212B591E09E6','/home/robert/labmgr/uploads/S351.torrent','2015-10-23 21:43:37',NULL),(30,'Z1','828877D6EA32BCF3E81AA3CCFAFDFBDDC9707497','/home/robert/labmgr/uploads/Z1.torrent','2015-10-24 23:23:31',NULL),(31,'A001','CE36DFD72EE7C6CC3B9AE6DF25FD7C41E0C3E180','/home/robert/labmgr/uploads/A001.torrent','2015-10-25 00:00:00',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vm`
--

LOCK TABLES `vm` WRITE;
/*!40000 ALTER TABLE `vm` DISABLE KEYS */;
INSERT INTO `vm` VALUES (6,'A114','C:\\Labs\\A114\\vm1\\InterconnectLab.vmx','','clean','2015-10-23 23:39:09',NULL),(7,'A178','C:\\Labs\\A178\\vm1\\A178.vmx','','clean','2015-10-23 23:39:28',NULL),(8,'A179','C:\\Labs\\A179\\vm1\\RHEL64-32bit.vmx','','clean','2015-10-24 00:27:04',NULL),(9,'A180','C:\\Labs\\A180\\vm1\\WTU2015-Lab-A180.vmx','','clean','2015-10-24 00:27:25',NULL),(10,'A226','C:\\Labs\\A226\\vm1\\MQ_LAB.vmx','','clean','2015-10-24 00:29:29',NULL),(11,'A230','C:\\Labs\\A230\\vm1\\A230-MQ-Light.vmx','','clean','2015-10-24 00:29:50',NULL),(12,'A248','C:\\Labs\\A248\\vm1\\Session_A248.vmx','','clean','2015-10-24 00:30:11',NULL),(13,'A298-1','C:\\Labs\\A298\\vm1\\Workstation.vmx','','clean','2015-10-24 00:30:35',NULL),(14,'A298-2','C:\\Labs\\A298\\vm2\\Template.vmx','','clean','2015-10-24 00:30:53',NULL),(15,'A298-3','C:\\Labs\\A298\\vm3\\Server.vmx','','clean','2015-10-24 00:31:09',NULL),(16,'A377-1','C:\\Labs\\A377\\vm1\\base-win7-x64-vm.vmx','','clean','2015-10-24 00:31:25',NULL),(17,'A377-2','C:\\Labs\\A377\\vm2\\IBM_MQ_Appliance_M2000.vmx','','clean','2015-10-24 00:31:39',NULL),(18,'C136','C:\\Labs\\C136\\vm1\\Clone of Session C136 Windows 8 32-bit.vmx','','clean','2015-10-24 00:32:00',NULL),(19,'I97','C:\\Labs\\I97\\vm1\\RHEL64-64bit.vmx','','clean','2015-10-24 22:37:40',NULL),(20,'C20','C:\\Labs\\C20\\vm1\\base-win7-x64-vm.vmx','','clean','2015-10-24 22:38:01',NULL),(21,'A001','C:\\Labs\\A001\\vm1\\RHEL64-32bit.vmx','','clean','2015-10-25 00:06:21',NULL);
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

-- Dump completed on 2015-10-27 15:32:31
