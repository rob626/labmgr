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
-- Table structure for table `global_defaults`
--

DROP TABLE IF EXISTS `global_defaults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_defaults` (
  `default_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `value` text,
  `create_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update_timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`default_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `global_defaults`
--

LOCK TABLES `global_defaults` WRITE;
/*!40000 ALTER TABLE `global_defaults` DISABLE KEYS */;
INSERT INTO `global_defaults` VALUES (2,'documentation_link','/documentation/index.html','2016-09-02 17:10:44',NULL),(3,'labmgr_link_1','http://ibm.biz/labmgr1','2016-09-02 17:11:30','2016-09-05 01:08:32'),(4,'labmgr_link_2','http://ibm.biz/labmgr2','2016-09-02 17:11:33','2016-09-05 01:08:47'),(5,'labmgr_link_3','http://ibm.biz/labmgr3','2016-09-02 17:11:35','2016-09-05 01:09:22'),(6,'labmgr_link_4','http://ibm.biz/labmgr4','2016-09-02 17:11:37','2016-09-05 01:09:52'),(7,'lab_root','C:\\Labs','2016-09-02 17:11:52',NULL),(8,'torrent_username','admin','2016-12-20 19:31:09','2016-12-20 19:57:42'),(9,'torrent_password','passw0rd','2016-12-20 19:31:22','2016-12-20 19:57:55'),(10,'torrent_port','27555','2016-12-20 19:45:08',NULL),(11,'labmgr-wd','c:/labmgr-wd','2016-12-20 20:01:19',NULL);
/*!40000 ALTER TABLE `global_defaults` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-21 14:05:59
