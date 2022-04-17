-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 162.250.191.248    Database: db_vegetable
-- ------------------------------------------------------
-- Server version	5.5.62-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin@admin.com','d033e22ae348aeb5660fc2140aec35850c4da997'),(2,'test@teat.com','');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderlist`
--

DROP TABLE IF EXISTS `orderlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderlist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `gid` varchar(255) DEFAULT NULL,
  `num` varchar(255) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `flag` int(11) DEFAULT '0',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderlist`
--

LOCK TABLES `orderlist` WRITE;
/*!40000 ALTER TABLE `orderlist` DISABLE KEYS */;
INSERT INTO `orderlist` VALUES (26,'123456','20@18@','1@1@',180,1,'2022-04-13 21:04:18'),(25,'123456','20@','1@',90,2,'2022-04-13 20:48:23'),(27,'','29@','8@',53,1,'2022-04-18 05:38:59');
/*!40000 ALTER TABLE `orderlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `discount` varchar(30) NOT NULL,
  `price` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `detail` varchar(1000) NOT NULL,
  `amount` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `goodname` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (19,'Vegetables','Peppers','1','0.99','upimages/20220413131333pepper.JPG','PeppersPeppersPeppersPeppers',21),(20,'Fruits','Gala Apples','1','2.29','upimages/20220413131254apples.JPG','Gala ApplesGala ApplesGala ApplesGala ApplesGala Apples',21),(21,'Fruits','Bananas','1','1.29','upimages/20220413131210banana.JPG','BananasBananasBananasBananasBananasBananasBananasBananasBananasBananasBananasBananasBananasBananasBananasBananas',21),(22,'Vegetables','Sweet Corns','1','4.99','upimages/20220413131122corn.JPG','Sweet CornsSweet CornsSweet CornsSweet CornsSweet CornsSweet CornsSweet Corns',21),(25,'Meat','Frozen Tourtiere Pie','1','6.49','upimages/20220413131418frozen_tourtiere_pie.jpg','Frozen Tourtiere PieFrozen Tourtiere PieFrozen Tourtiere PieFrozen Tourtiere PieFrozen Tourtiere Pie',21),(26,'Meat','33% Less Salt Bacon','1','7.29','upimages/2022041313154933-less-salt-bacon.jpg','33% Less Salt Bacon33% Less Salt Bacon33% Less Salt Bacon33% Less Salt Bacon',21),(27,'Fish','Atlantic Salmon','1','100','upimages/20220413131849413211700.jpg','Atlantic SalmonAtlantic SalmonAtlantic SalmonAtlantic SalmonAtlantic Salmon',21),(28,'MilkEggs','Lactantia','1','3.49','upimages/220413012235.png','LactantiaLactantiaLactantiaLactantiaLactantiaLactantiaLactantiaLactantiaLactantia',21),(29,'Fish','Pacific Salmon','3','7.29','upimages/220413012324.jfif','Pacific SalmonPacific SalmonPacific SalmonPacific Salmon',21);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Address1` varchar(255) DEFAULT NULL,
  `Address2` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `receive` int(11) NOT NULL DEFAULT '0',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (104,'1@qq.com','123456','11111111','11111111','Male','123546111','11111','11111','美国','New York','CANANDAIGUA','1111',0,'2022-04-13 04:10:06'),(109,'admin@admin.com','d033e22ae348aeb5660fc2140aec35850c4da997',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2022-04-18 05:15:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'db_vegetable'
--

--
-- Dumping routines for database 'db_vegetable'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-17 19:02:22
