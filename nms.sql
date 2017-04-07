-- MySQL dump 10.13  Distrib 5.7.14, for Win64 (x86_64)
--
-- Host: localhost    Database: nms
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Current Database: `nms`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `nms` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `nms`;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `newsID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `Content` text COLLATE utf8_bin,
  `addTime` int(11) DEFAULT NULL,
  `clickCount` int(11) DEFAULT '0',
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`newsID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'截至今日，新安人才网热点新闻管理系统正式上线运营，欢迎访问','欢迎访问、测试，给与意\n\n见！',1478255785,0,1),(2,'把握时尚浪潮，针别科技动态，新安人才网新闻管理系统一网打尽，你还等什么？','欢迎访问、测试，给与意\n\n见啊！',1478255786,0,2),(3,'新安人才网新闻管理系统一网打尽，我身边的互联网信息专家','欢迎访问、测试，给与意见\n\n吧！',1478255786,0,1);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsreplies`
--

DROP TABLE IF EXISTS `newsreplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsreplies` (
  `nrID` int(11) NOT NULL AUTO_INCREMENT,
  `newsID` int(11) DEFAULT NULL,
  `replyID` int(11) DEFAULT NULL,
  PRIMARY KEY (`nrID`),
  KEY `newsID` (`newsID`),
  KEY `replyID` (`replyID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsreplies`
--

LOCK TABLES `newsreplies` WRITE;
/*!40000 ALTER TABLE `newsreplies` DISABLE KEYS */;
INSERT INTO `newsreplies` VALUES (1,1,1),(2,1,2),(3,3,3);
/*!40000 ALTER TABLE `newsreplies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reply` (
  `replyID` int(11) NOT NULL AUTO_INCREMENT,
  `replyContent` text COLLATE utf8_bin,
  `replyTime` int(11) DEFAULT NULL,
  `replyStatus` int(11) DEFAULT '1',
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`replyID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reply`
--

LOCK TABLES `reply` WRITE;
/*!40000 ALTER TABLE `reply` DISABLE KEYS */;
INSERT INTO `reply` VALUES (1,'测试回复1',1478255786,1,1),(2,'测试回复2',1478255787,0,2),(3,'测试回复3',1478255788,1,2);
/*!40000 ALTER TABLE `reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(32) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'管理员'),(2,'普通用户');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `loginid` varchar(32) COLLATE utf8_bin NOT NULL,
  `pwd` varchar(32) COLLATE utf8_bin NOT NULL,
  `userName` varchar(32) COLLATE utf8_bin NOT NULL,
  `userSex` char(2) COLLATE utf8_bin DEFAULT '男',
  `userColor` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `userBirthday` int(11) DEFAULT NULL,
  `userImage` varchar(128) COLLATE utf8_bin DEFAULT 'images/nophoto.jpg',
  `userFavorite` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `userDescribe` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `roleID` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `roleID` (`roleID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','3cf108a4e0a498347a5a75a792f23212','天涯的海风','男','blue',410486400,'images/admin.jpg','玩电脑','人在天涯心即海，不如听海风',1),(2,'test','6f4b726238e4edac373d1264dcb6f890','测试帐号昵称','女','red',726105600,'images/nophoto.jpg','看书','测试个人帐号个人简介',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-07  9:16:43
