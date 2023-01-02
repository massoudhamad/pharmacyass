CREATE DATABASE  IF NOT EXISTS `aspire_pharmacy` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `aspire_pharmacy`;
-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: aspire_pharmacy
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

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
-- Table structure for table `despencing`
--

DROP TABLE IF EXISTS `despencing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `despencing` (
  `despencingID` int NOT NULL AUTO_INCREMENT,
  `specification` varchar(100) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  `quantity_type` int DEFAULT NULL,
  `prediscribed_quantity` int DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  PRIMARY KEY (`despencingID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despencing`
--

LOCK TABLES `despencing` WRITE;
/*!40000 ALTER TABLE `despencing` DISABLE KEYS */;
INSERT INTO `despencing` VALUES (1,NULL,'2023-01-02 19:17:14','2023-01-02 19:17:14',1,NULL,20,6),(2,NULL,'2023-01-02 19:18:09','2023-01-02 19:18:09',1,NULL,20,6);
/*!40000 ALTER TABLE `despencing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `district` (
  `districtID` int NOT NULL AUTO_INCREMENT,
  `districtCode` varchar(50) NOT NULL,
  `districtName` varchar(250) NOT NULL,
  `regionCode` varchar(45) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`districtID`),
  KEY `fk_distric_zone_idx` (`regionCode`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'REMwMg==','Mkoani','UkM1NQ==','2020-12-27 17:33:11','2020-12-27 17:33:11',20),(2,'REMwMQ==','Chake chake','UkM1NQ==','2020-12-27 17:33:11','2020-12-27 17:33:11',20),(3,'REMwMw==','Wete','UkM1NA==','2020-12-27 17:33:11','2020-12-27 17:33:11',20),(4,'REMwNA==','Micheweni','UkM1NA==','2020-12-27 17:33:11','2020-12-27 17:33:11',20),(5,'REMwNg==','Magharibi B','UkM1MA==','2020-12-27 17:33:11','2020-12-27 17:33:11',20),(6,'REMwNQ==','Magharibi A','UkM1MA==','2020-12-27 17:33:11','2020-12-27 17:33:11',20),(7,'REMwNw==','Mjini','UkM1MA==','2020-12-27 17:33:11','2020-12-27 17:33:11',20),(8,'REMwOA==','Kusini','UkM1Mg==','2020-12-27 17:33:11','2020-12-27 17:33:11',20),(9,'REMwOQ==','Kati','UkM1Mg==','2020-12-27 17:33:12','2020-12-27 17:33:12',20),(10,'REMxMA==','Kaskazini A','UkM1MQ==','2020-12-27 17:33:12','2020-12-27 17:33:12',20),(11,'REMxMQ==','Kaskazini B','UkM1MQ==','2020-12-27 17:33:12','2020-12-27 17:33:12',20);
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imsx_dispensing_entity`
--

DROP TABLE IF EXISTS `imsx_dispensing_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imsx_dispensing_entity` (
  `entityID` int NOT NULL,
  `entityName` varchar(50) NOT NULL,
  `contactPerson` varchar(70) NOT NULL,
  `location` varchar(70) NOT NULL,
  `status` int NOT NULL,
  `createdBy` int NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `createdDate` datetime NOT NULL,
  `phoneNo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`entityID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imsx_dispensing_entity`
--

LOCK TABLES `imsx_dispensing_entity` WRITE;
/*!40000 ALTER TABLE `imsx_dispensing_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `imsx_dispensing_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imsx_issue`
--

DROP TABLE IF EXISTS `imsx_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imsx_issue` (
  `issueID` int NOT NULL,
  `productID` int NOT NULL,
  `qtyIssued` int NOT NULL,
  `issuedDate` date NOT NULL,
  `customerName` varchar(150) NOT NULL,
  `status` int NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `createdBy` int NOT NULL,
  `issuedFrom` int NOT NULL,
  `issuedBy` int NOT NULL,
  PRIMARY KEY (`issueID`),
  KEY `productID_idx` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imsx_issue`
--

LOCK TABLES `imsx_issue` WRITE;
/*!40000 ALTER TABLE `imsx_issue` DISABLE KEYS */;
/*!40000 ALTER TABLE `imsx_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imsx_product_category`
--

DROP TABLE IF EXISTS `imsx_product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imsx_product_category` (
  `categoryID` int NOT NULL,
  `categoryName` varchar(45) NOT NULL,
  `description` text,
  `status` int NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `createdBy` int NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imsx_product_category`
--

LOCK TABLES `imsx_product_category` WRITE;
/*!40000 ALTER TABLE `imsx_product_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `imsx_product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imsx_product_type`
--

DROP TABLE IF EXISTS `imsx_product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imsx_product_type` (
  `typeID` int NOT NULL,
  `typeName` varchar(145) NOT NULL,
  `description` text NOT NULL,
  `status` int NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `createdBy` int NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imsx_product_type`
--

LOCK TABLES `imsx_product_type` WRITE;
/*!40000 ALTER TABLE `imsx_product_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `imsx_product_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imsx_product_unit`
--

DROP TABLE IF EXISTS `imsx_product_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imsx_product_unit` (
  `unitID` int NOT NULL,
  `unitCode` varchar(45) NOT NULL,
  `unitName` varchar(150) NOT NULL,
  `status` int NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `createdBy` int NOT NULL,
  PRIMARY KEY (`unitID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imsx_product_unit`
--

LOCK TABLES `imsx_product_unit` WRITE;
/*!40000 ALTER TABLE `imsx_product_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `imsx_product_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manufacturer` (
  `manufacturer_id` int NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(150) NOT NULL,
  `status` int NOT NULL,
  `address_man` varchar(150) NOT NULL,
  `man_phone_no` varchar(150) NOT NULL,
  `man_website` varchar(150) DEFAULT NULL,
  `man_person` varchar(145) DEFAULT NULL,
  `man_email` varchar(45) NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `createdBy` int NOT NULL,
  `createdDate` datetime NOT NULL,
  PRIMARY KEY (`manufacturer_id`),
  UNIQUE KEY `manufacturer_id_UNIQUE` (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturer`
--

LOCK TABLES `manufacturer` WRITE;
/*!40000 ALTER TABLE `manufacturer` DISABLE KEYS */;
INSERT INTO `manufacturer` VALUES (1,'Ngozi Pharmaceticial Company',1,'Mombasa','0778398441',NULL,NULL,'abdulmajeedhajji@gmail.com','2022-12-24 18:32:56',1,'2022-12-24 18:32:56');
/*!40000 ALTER TABLE `manufacturer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_type` (
  `product_type_id` int NOT NULL AUTO_INCREMENT,
  `product_type_name` varchar(45) DEFAULT NULL,
  `product_type_description` varchar(145) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `createdDate` varchar(45) DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`product_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_type`
--

LOCK TABLES `product_type` WRITE;
/*!40000 ALTER TABLE `product_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quantity_type`
--

DROP TABLE IF EXISTS `quantity_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quantity_type` (
  `quantityTypeId` int NOT NULL AUTO_INCREMENT,
  `quantityType` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`quantityTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quantity_type`
--

LOCK TABLES `quantity_type` WRITE;
/*!40000 ALTER TABLE `quantity_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `quantity_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recieved_items`
--

DROP TABLE IF EXISTS `recieved_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recieved_items` (
  `recieved_items_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int DEFAULT NULL,
  `supplier_id` int DEFAULT '1',
  `manufacturer_id` int DEFAULT '1',
  `manufactured_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `item_type` varchar(45) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `medi_type` varchar(45) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `price` int DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`recieved_items_id`),
  UNIQUE KEY `item_id_UNIQUE` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recieved_items`
--

LOCK TABLES `recieved_items` WRITE;
/*!40000 ALTER TABLE `recieved_items` DISABLE KEYS */;
INSERT INTO `recieved_items` VALUES (1,1,1,1,'2022-12-23','2022-12-27','Others',340,'','2022-12-24 18:40:37',500,'2022-12-24 18:40:37',1,1),(2,6,1,1,'2023-01-01','2023-01-03','Non Medical Item',400,'','2023-01-02 19:02:16',2500,'2023-01-02 19:02:16',1,1);
/*!40000 ALTER TABLE `recieved_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `region` (
  `regionCode` varchar(45) NOT NULL,
  `zoneCode` varchar(45) DEFAULT NULL,
  `regionName` varchar(145) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`regionCode`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES ('UkM1MA==','WjAwMQ==','Mjini Magharibi','2020-12-27 17:33:08','2020-12-27 17:33:08',20,1),('UkM1Mg==','WjAwMQ==','Kusini Unguja','2020-12-27 17:33:08','2020-12-27 17:33:08',20,2),('UkM1MQ==','WjAwMQ==','Kaskazini Unguja','2020-12-27 17:33:08','2020-12-27 17:33:08',20,3),('UkM1NA==','WjAwMg==','Kaskazini Pemba','2020-12-27 17:33:09','2020-12-27 17:33:09',20,4),('UkM1NQ==','WjAwMg==','Kusini Pemba','2020-12-27 17:33:09','2020-12-27 17:33:09',20,5);
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `roleCode` varchar(45) NOT NULL,
  `role` varchar(100) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`roleCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES ('1','Super Administrator',NULL,NULL,NULL),('2','Administrator',NULL,NULL,NULL),('3','Seller',NULL,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shehia`
--

DROP TABLE IF EXISTS `shehia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shehia` (
  `shehiaID` int NOT NULL AUTO_INCREMENT,
  `shehiaCode` varchar(50) DEFAULT NULL,
  `shehiaName` varchar(250) DEFAULT NULL,
  `districtCode` varchar(45) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`shehiaID`)
) ENGINE=InnoDB AUTO_INCREMENT=402 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shehia`
--

LOCK TABLES `shehia` WRITE;
/*!40000 ALTER TABLE `shehia` DISABLE KEYS */;
INSERT INTO `shehia` VALUES (1,'MjEzOA==','Mchakwe','REMwMg==','2020-12-27 17:33:12','2020-12-27 17:33:12',20),(2,'MjQzMQ==','Chole','REMwMg==','2020-12-27 17:33:12','2020-12-27 17:33:12',20),(3,'MTIzNA==','Tironi','REMwMg==','2020-12-27 17:33:12','2020-12-27 17:33:12',20),(4,'MzIxNw==','Dodo','REMwMg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(5,'OTkx','Gando','REMwMw==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(6,'OTky','Maruhubi','REMwNw==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(7,'QjEwMDI=','Chunga','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(8,'QjEwMjI=','Mbweni','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(9,'QjEwMTI=','Kiembesamaki','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(10,'QjEwMzI=','Mombasa','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(11,'QjEwNDI=','Michungwani','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(12,'QjEwNjI=','Kisauni','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(13,'QjEwNTI=','Kwa Mchina','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(14,'QjEwNzI=','Tomondo','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(15,'QjEwODI=','Chukwani','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(16,'QjEwOTI=','Shakani','REMwNg==','2020-12-27 17:33:13','2020-12-27 17:33:13',20),(17,'QjExMDI=','Magogoni','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(18,'QjExMg==','Jitimai','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(19,'QjExMjI=','Sokoni','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(20,'QjExNDI=','Mwanakwerekwe','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(21,'QjExNjI=','Mnarani','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(22,'QjExNTI=','MuembeMajogoo','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(23,'QjExNzI=','Kinuni','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(24,'QjExODI=','Pangawe','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(25,'QjExOTI=','Melinne','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(26,'QjEyMDI=','Taveta','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(27,'QjEyMjI=','Kijitoupele','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(28,'QjEyMTI=','Uzi','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(29,'Qjg5Mg==','Fumba','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(30,'Qjk0Mg==','Maungani','REMwNg==','2020-12-27 17:33:14','2020-12-27 17:33:14',20),(31,'Qjk1Mg==','Uwandani','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(32,'Qjk2Mg==','Kibondeni','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(33,'Qjk3Mg==','Fuoni kipungani','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(34,'Qjk4Mg==','Fuoni Migombani','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(35,'Qjk5Mg==','Mambosasa','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(36,'QjkwMg==','Bweleo','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(37,'QjkxMg==','Dimani','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(38,'QjkyMg==','Nyamanzi','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(39,'QjkzMg==','Kombeni','REMwNg==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(40,'QTc0Mg==','Michikichini','REMwNQ==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(41,'QTc1Mg==','Mtoni Kidatu','REMwNQ==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(42,'QTc2Mg==','Mtoni chemchem','REMwNQ==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(43,'QTc3Mg==','Munduli','REMwNQ==','2020-12-27 17:33:15','2020-12-27 17:33:15',20),(44,'QTc4Mg==','Mtopepo','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(45,'QTc5Mg==','Mwakaje','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(46,'QTcwMg==','Mbuzini','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(47,'QTcxMg==','Mfenesini','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(48,'QTcyMg==','Muembemchomeke','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(49,'QTczMg==','Mtofaani','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(50,'QTg0Mg==','Masingini','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(51,'QTg1Mg==','Uholanzi','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(52,'QTg2Mg==','Sharifumsa','REMwNQ==','2020-12-27 17:33:16','2020-12-27 17:33:16',20),(53,'QTg3Mg==','Welezo','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(54,'QTg4Mg==','Mtoni','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(55,'QTgxMg==','Mwanyanya','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(56,'QTgyMg==','Kwa goa','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(57,'QTgzMg==','Mwera','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(58,'QTU3Mg==','Bububu','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(59,'QTU4Mg==','Bumbwisudi','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(60,'QTU5Mg==','Chuini','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(61,'QTY0Mg==','Kianga','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(62,'QTY1Mg==','Kikaangoni','REMwNQ==','2020-12-27 17:33:17','2020-12-27 17:33:17',20),(63,'QTY2Mg==','Kibweni','REMwNQ==','2020-12-27 17:33:18','2020-12-27 17:33:18',20),(64,'QTY3Mg==','Kihinani','REMwNQ==','2020-12-27 17:33:18','2020-12-27 17:33:18',20),(65,'QTY4Mg==','Kijichi','REMwNQ==','2020-12-27 17:33:18','2020-12-27 17:33:18',20),(66,'QTY5Mg==','Kizimbani','REMwNQ==','2020-12-27 17:33:18','2020-12-27 17:33:18',20),(67,'QTYwMg==','Chemchem','REMwNQ==','2020-12-27 17:33:18','2020-12-27 17:33:18',20),(68,'QTYxMg==','Dole','REMwNQ==','2020-12-27 17:33:18','2020-12-27 17:33:18',20),(69,'QTYyMg==','Hawaii','REMwNQ==','2020-12-27 17:33:19','2020-12-27 17:33:19',20),(70,'QTYzMg==','Kama','REMwNQ==','2020-12-27 17:33:19','2020-12-27 17:33:19',20),(71,'QzA0Mg==','Malindi','REMwNw==','2020-12-27 17:33:19','2020-12-27 17:33:19',20),(72,'QzA1Mg==','Mchangani','REMwNw==','2020-12-27 17:33:19','2020-12-27 17:33:19',20),(73,'QzA2Mg==','Mlandege','REMwNw==','2020-12-27 17:33:19','2020-12-27 17:33:19',20),(74,'QzA3Mg==','Muembeladu','REMwMDE=','2020-12-27 17:33:20','2020-12-27 17:33:20',20),(75,'QzA4Mg==','Gulioni','REMwNw==','2020-12-27 17:33:20','2020-12-27 17:33:20',20),(76,'QzA5Mg==','Makadara','REMwNw==','2020-12-27 17:33:20','2020-12-27 17:33:20',20),(77,'QzAxMg==','Shangani','REMwNw==','2020-12-27 17:33:20','2020-12-27 17:33:20',20),(78,'QzAyMg==','Mkunazini','REMwNw==','2020-12-27 17:33:20','2020-12-27 17:33:20',20),(79,'QzAzMg==','Kiponda','REMwNw==','2020-12-27 17:33:20','2020-12-27 17:33:20',20),(80,'QzE0Mg==','Kilimahewa juu','REMwNw==','2020-12-27 17:33:20','2020-12-27 17:33:20',20),(81,'QzE1Mg==','Amani','REMwNw==','2020-12-27 17:33:20','2020-12-27 17:33:20',20),(82,'QzE2Mg==','Nyerere','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(83,'QzE3Mg==','Sebleni','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(84,'QzE4Mg==','Magomeni','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(85,'QzE5Mg==','Mpendae','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(86,'QzEwMg==','Shaurimoyo','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(87,'QzExMg==','Mwembemakumbi','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(88,'QzEyMg==','Chumbuni','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(89,'QzEzMg==','Kwamtipura','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(90,'QzI0Mg==','Kikwajuni Bondeni','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(91,'QzI1Mg==','KisimaMajongoo','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(92,'QzI2Mg==','Vikokotoni','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(93,'QzI3Mg==','Muembetanga','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(94,'QzI4Mg==','Mwembeshauri','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(95,'QzI5Mg==','Rahaleo','REMwNw==','2020-12-27 17:33:21','2020-12-27 17:33:21',20),(96,'QzIwMg==','Urusi','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(97,'QzIxMg==','Kilimani','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(98,'QzIyMg==','Miembeni','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(99,'QzM0Mg==','Sogea','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(100,'QzM1Mg==','Jangombe','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(101,'QzM2Mg==','Kidongo Chekundu','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(102,'QzM4Mg==','Kwahani','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(103,'QzM5Mg==','Kwaalinatu','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(104,'QzMwMg==','Kwaalimsha','REMwNw==','2020-12-27 17:33:22','2020-12-27 17:33:22',20),(105,'QzMxMg==','Mikunguni','REMwNw==','2020-12-27 17:33:23','2020-12-27 17:33:23',20),(106,'QzMyMg==','Mkele','REMwNw==','2020-12-27 17:33:23','2020-12-27 17:33:23',20),(107,'QzMzMg==','Muungano','REMwNw==','2020-12-27 17:33:23','2020-12-27 17:33:23',20),(108,'QzQ0Mg==','Meya','REMwNw==','2020-12-27 17:33:23','2020-12-27 17:33:23',20),(109,'QzQ1Mg==','Kiswandui','REMwNw==','2020-12-27 17:33:23','2020-12-27 17:33:23',20),(110,'QzQ2Mg==','Banko','REMwNw==','2020-12-27 17:33:23','2020-12-27 17:33:23',20),(111,'QzQ3Mg==','Masumbani','REMwNw==','2020-12-27 17:33:24','2020-12-27 17:33:24',20),(112,'QzQ4Mg==','Muembemadema','REMwNw==','2020-12-27 17:33:24','2020-12-27 17:33:24',20),(113,'QzQ5Mg==','Mboriborini','REMwNw==','2020-12-27 17:33:24','2020-12-27 17:33:24',20),(114,'QzQwMg==','Karakana','REMwNw==','2020-12-27 17:33:24','2020-12-27 17:33:24',20),(115,'QzQxMg==','Kilimahewa Bondeni','REMwNw==','2020-12-27 17:33:24','2020-12-27 17:33:24',20),(116,'QzQyMg==','Kwa Wazee','REMwNw==','2020-12-27 17:33:24','2020-12-27 17:33:24',20),(117,'QzQzMg==','Migombani','REMwNw==','2020-12-27 17:33:24','2020-12-27 17:33:24',20),(118,'QzU0Mg==','Mnazimmoja','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(119,'QzU1Mg==','Mapinduzi','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(120,'QzU2Mg==','Kwa Mtumwajeni','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(121,'QzU3Mg==','Matarumbeta','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(122,'QzU4Mg==','Mwembeladu','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(123,'QzU5Mg==','Kikwajuni Juu','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(124,'QzUwMg==','Saateni','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(125,'QzUyMg==','Kwabintiamrani','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(126,'QzUzMg==','Mitiulaya','REMwNw==','2020-12-27 17:33:25','2020-12-27 17:33:25',20),(127,'RDA0MQ==','Machui','REMwOQ==','2020-12-27 17:33:26','2020-12-27 17:33:26',20),(128,'RDA1MQ==','Kiboje Mwembeshauri','REMwOQ==','2020-12-27 17:33:26','2020-12-27 17:33:26',20),(129,'RDA2MQ==','Miwani','REMwOQ==','2020-12-27 17:33:26','2020-12-27 17:33:26',20),(130,'RDA3MQ==','Kiboje Mkwajuni','REMwOQ==','2020-12-27 17:33:26','2020-12-27 17:33:26',20),(131,'RDA4MQ==','Ghana','REMwOQ==','2020-12-27 17:33:26','2020-12-27 17:33:26',20),(132,'RDA5Mw==','Koani','REMwOQ==','2020-12-27 17:33:26','2020-12-27 17:33:26',20),(133,'RDAxMw==','Dunga Bweni','REMwOQ==','2020-12-27 17:33:26','2020-12-27 17:33:26',20),(134,'RDAyMQ==','Ubago','REMwOQ==','2020-12-27 17:33:27','2020-12-27 17:33:27',20),(135,'RDAzMQ==','Kidimni','REMwOQ==','2020-12-27 17:33:27','2020-12-27 17:33:27',20),(136,'RDE0MQ==','Bambi','REMwOQ==','2020-12-27 17:33:27','2020-12-27 17:33:27',20),(137,'RDE1MQ==','Pagali','REMwOQ==','2020-12-27 17:33:27','2020-12-27 17:33:27',20),(138,'RDE2MQ==','Umbuji','REMwOQ==','2020-12-27 17:33:27','2020-12-27 17:33:27',20),(139,'RDE3MQ==','Mchangani','REMwOQ==','2020-12-27 17:33:27','2020-12-27 17:33:27',20),(140,'RDE4MQ==','Dunga Kiembeni','REMwOQ==','2020-12-27 17:33:27','2020-12-27 17:33:27',20),(141,'RDE5MQ==','Ndijani Mseweni','REMwOQ==','2020-12-27 17:33:27','2020-12-27 17:33:27',20),(142,'RDEwMQ==','Mgeni Haji','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(143,'RDExMQ==','Uzini','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(144,'RDEyMQ==','Mitakawani','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(145,'RDEzMQ==','Tunduni','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(146,'RDI0MQ==','Pongwe','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(147,'RDI1Mw==','Jumbi','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(148,'RDI2MQ==','Tunguu','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(149,'RDI3MQ==','Binguni','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(150,'RDI4MQ==','Cheju','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(151,'RDI5MQ==','Bungi','REMwOQ==','2020-12-27 17:33:28','2020-12-27 17:33:28',20),(152,'RDIwMQ==','Jendele','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(153,'RDIxMQ==','Chwaka','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(154,'RDIyMQ==','Marumbi','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(155,'RDIzMQ==','Uroa','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(156,'RDM0MQ==','Charawe','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(157,'RDM1MQ==','Ukongoroni','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(158,'RDM3MQ==','Mpapa','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(159,'RDM4MQ==','Unguja Ukuu Tindini','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(160,'RDM5MQ==','Ndijani Mwembepunda','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(161,'RDMwMQ==','Unguja Ukuu Kaepwani','REMwOQ==','2020-12-27 17:33:29','2020-12-27 17:33:29',20),(162,'RDMxMQ==','Kikungwi','REMwOQ==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(163,'RDMyMQ==','Uzi','REMwOQ==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(164,'RDMzMQ==','Ng\'ambwa','REMwOQ==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(165,'RDQ0MQ==','Cheju Zawiyani','REMwOQ==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(166,'RDQ1MQ==','Unguja Ukuu Kaebona','REMwOQ==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(167,'RDQwMg==','Pete','REMwOQ==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(168,'RDQzMQ==','Kijibwemtu','REMwOQ==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(169,'RjA0MQ==','Kivunge','REMxMA==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(170,'RjA1MQ==','Tumbatu Gomani','REMxMA==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(171,'RjA2MQ==','Tumbatu Jongowe','REMxMA==','2020-12-27 17:33:30','2020-12-27 17:33:30',20),(172,'RjA3MQ==','Mkwajuni','REMxMA==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(173,'RjA4MQ==','Kibeni','REMxMA==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(174,'RjA5MQ==','Muwange','REMxMA==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(175,'RjAwNQ==','Chaani Mcheza Shauri','REMxMA==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(176,'RjAxMw==','Mkokotoni','REMxMA==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(177,'RjAyMQ==','Mto wa Pwani','REMxMA==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(178,'RjAzMQ==','Pale','REMxMA==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(179,'RjE0MQ==','Tazari','REMwNQ==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(180,'RjE1MQ==','Kigunda','REMxMA==','2020-12-27 17:33:31','2020-12-27 17:33:31',20),(181,'RjE4MQ==','Kijini','REMxMA==','2020-12-27 17:33:32','2020-12-27 17:33:32',20),(182,'RjE5MQ==','Pwani Mchangani','REMxMA==','2020-12-27 17:33:32','2020-12-27 17:33:32',20),(183,'RjEwMQ==','Pitanazako','REMxMA==','2020-12-27 17:33:32','2020-12-27 17:33:32',20),(184,'RjExMQ==','Potoa','REMxMA==','2020-12-27 17:33:32','2020-12-27 17:33:32',20),(185,'RjEyMQ==','Fukuchani','REMxMA==','2020-12-27 17:33:32','2020-12-27 17:33:32',20),(186,'RjEzMQ==','Kidoti','REMxMA==','2020-12-27 17:33:32','2020-12-27 17:33:32',20),(187,'RjI0MQ==','Chaani Kubwa','REMxMA==','2020-12-27 17:33:32','2020-12-27 17:33:32',20),(188,'RjI1MQ==','Kikobweni','REMxMA==','2020-12-27 17:33:33','2020-12-27 17:33:33',20),(189,'RjI2MQ==','Bandamaji','REMxMA==','2020-12-27 17:33:33','2020-12-27 17:33:33',20),(190,'RjI3MQ==','Kinyasini','REMxMA==','2020-12-27 17:33:33','2020-12-27 17:33:33',20),(191,'RjI4MQ==','Kandwi','REMxMA==','2020-12-27 17:33:33','2020-12-27 17:33:33',20),(192,'RjI5MQ==','Chutama','REMxMA==','2020-12-27 17:33:33','2020-12-27 17:33:33',20),(193,'RjIwMw==','Gamba','REMxMA==','2020-12-27 17:33:33','2020-12-27 17:33:33',20),(194,'RjIxMQ==','Moga','REMxMA==','2020-12-27 17:33:33','2020-12-27 17:33:33',20),(195,'RjIyMQ==','Chaani Masingini','REMxMA==','2020-12-27 17:33:34','2020-12-27 17:33:34',20),(196,'RjIzMQ==','Mcheza Shauri','REMxMA==','2020-12-27 17:33:34','2020-12-27 17:33:34',20),(197,'RjM0MQ==','Kidombo','REMxMA==','2020-12-27 17:33:34','2020-12-27 17:33:34',20),(198,'RjM1MQ==','Bwereu','REMxMA==','2020-12-27 17:33:34','2020-12-27 17:33:34',20),(199,'RjM2Mg==',' Kigomani','REMxMA==','2020-12-27 17:33:34','2020-12-27 17:33:34',20),(200,'RjM3MQ==','Muwanda','REMxMA==','2020-12-27 17:33:34','2020-12-27 17:33:34',20),(201,'RjM4MQ==','Kipange','REMxMA==','2020-12-27 17:33:34','2020-12-27 17:33:34',20),(202,'RjM5MQ==','Mtakuja','REMxMA==','2020-12-27 17:33:34','2020-12-27 17:33:34',20),(203,'RjMxMQ==','Kilindi','REMwNQ==','2020-12-27 17:33:35','2020-12-27 17:33:35',20),(204,'RjMyMQ==','Kilimani','REMxMA==','2020-12-27 17:33:35','2020-12-27 17:33:35',20),(205,'RjMzMQ==','Tumbatu Uvivini','REMxMA==','2020-12-27 17:33:35','2020-12-27 17:33:35',20),(206,'RjQ0MQ==','Matemwe kaskazini','REMxMA==','2020-12-27 17:33:35','2020-12-27 17:33:35',20),(207,'RjQ1MQ==','Jugakuu','REMxMA==','2020-12-27 17:33:35','2020-12-27 17:33:35',20),(208,'RjQ2MQ==','Donge mchangani','REMxMA==','2020-12-27 17:33:35','2020-12-27 17:33:35',20),(209,'RjQ3MQ==','Mbuyu Tende','REMxMA==','2020-12-27 17:33:35','2020-12-27 17:33:35',20),(210,'RjQwMQ==','Kiungani','REMxMA==','2020-12-27 17:33:35','2020-12-27 17:33:35',20),(211,'RjQxMQ==','Bandakuu','REMxMA==','2020-12-27 17:33:36','2020-12-27 17:33:36',20),(212,'RjQyMQ==','Kigongoni','REMxMA==','2020-12-27 17:33:36','2020-12-27 17:33:36',20),(213,'RjQzMQ==','Matemwe kusini','REMxMA==','2020-12-27 17:33:36','2020-12-27 17:33:36',20),(214,'RTA0MQ==','Kajengwa','REMwOA==','2020-12-27 17:33:36','2020-12-27 17:33:36',20),(215,'RTA1MQ==','Jambiani kikadini','REMwOA==','2020-12-27 17:33:36','2020-12-27 17:33:36',20),(216,'RTA2MQ==','Mtende','REMwOA==','2020-12-27 17:33:36','2020-12-27 17:33:36',20),(217,'RTA3MQ==','Kibuteni','REMwOA==','2020-12-27 17:33:36','2020-12-27 17:33:36',20),(218,'RTA4MQ==','Kizimkazi Dimbani','REMwOA==','2020-12-27 17:33:36','2020-12-27 17:33:36',20),(219,'RTA5','Kizimkazi mkunguni','REMwOA==','2020-12-27 17:33:37','2020-12-27 17:33:37',20),(220,'RTAxMQ==','Nganani','REMwOA==','2020-12-27 17:33:37','2020-12-27 17:33:37',20),(221,'RTAyMg==','Kijini','REMwOA==','2020-12-27 17:33:37','2020-12-27 17:33:37',20),(222,'RTAzMQ==','Mzuri','REMwOA==','2020-12-27 17:33:37','2020-12-27 17:33:37',20),(223,'RTE0MQ==','Muungoni','REMwOA==','2020-12-27 17:33:37','2020-12-27 17:33:37',20),(224,'RTE1MQ==','Paje','REMwOA==','2020-12-27 17:33:37','2020-12-27 17:33:37',20),(225,'RTE2MQ==','Jambiani kibigija','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(226,'RTE3MQ==','Bwejuu','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(227,'RTE4MQ==','Kitogani','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(228,'RTE5Mg==','Kiongoni','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(229,'RTEwMQ==','Muyuni \'A\'','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(230,'RTExMQ==','Muyuni \'B\'','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(231,'RTEyMQ==','Muyuni \'C\'','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(232,'RTIwMQ==','Tasani','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(233,'RTIxMQ==','Dongwe','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(234,'RTM2MQ==','Michamvi','REMwOA==','2020-12-27 17:33:38','2020-12-27 17:33:38',20),(235,'RzA0MQ==','Fujoni','REMxMQ==','2020-12-27 17:33:39','2020-12-27 17:33:39',20),(236,'RzA1MQ==','Kiombamvua','REMxMQ==','2020-12-27 17:33:39','2020-12-27 17:33:39',20),(237,'RzA3MQ==','Mkadini','REMxMQ==','2020-12-27 17:33:39','2020-12-27 17:33:39',20),(238,'RzA4MQ==','Zingwezingwe','REMxMQ==','2020-12-27 17:33:39','2020-12-27 17:33:39',20),(239,'RzA5MQ==','Kitope','REMxMQ==','2020-12-27 17:33:39','2020-12-27 17:33:39',20),(240,'RzAxMQ==','Misufini','REMxMQ==','2020-12-27 17:33:39','2020-12-27 17:33:39',20),(241,'RzAyMQ==','Makoba','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(242,'RzAzMQ==','Mangapwani','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(243,'RzE0MQ==','Karange','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(244,'RzE0NA==','Tazari','REMxMA==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(245,'RzE1MQ==','Mbiji','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(246,'RzE3MQ==','Vijibweni','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(247,'RzE4Mg==','Mikarafuuni','REMwNg==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(248,'RzE4MQ==','Upenja','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(249,'RzE5MQ==','Kiwengwa','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(250,'RzEwMQ==','Kiongo Kidogo','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(251,'RzEwMw==','Mahonda','REMxMQ==','2020-12-27 17:33:40','2020-12-27 17:33:40',20),(252,'RzExMQ==','Mnyimbi','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(253,'RzEyMQ==','Mtambile','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(254,'RzEzMQ==','Kinduni','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(255,'RzI0MQ==','Matetema','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(256,'RzI1MQ==','Kidanzini','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(257,'RzI2MQ==','Mbaleni','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(258,'RzI3MQ==','Mafufuni','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(259,'RzI4Mw==','Mkataleni','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(260,'RzI5MQ==','Njia ya Mtoni','REMxMQ==','2020-12-27 17:33:41','2020-12-27 17:33:41',20),(261,'RzIwMQ==','Pangeni','REMxMQ==','2020-12-27 17:33:42','2020-12-27 17:33:42',20),(262,'RzIxMQ==','Kilombero','REMxMQ==','2020-12-27 17:33:42','2020-12-27 17:33:42',20),(263,'RzIyMQ==','Mgambo','REMxMQ==','2020-12-27 17:33:42','2020-12-27 17:33:42',20),(264,'RzMwMQ==','Kisongoni','REMxMQ==','2020-12-27 17:33:42','2020-12-27 17:33:42',20),(265,'RzMxMQ==','Donge Majenzi','REMxMQ==','2020-12-27 17:33:42','2020-12-27 17:33:42',20),(266,'RzMyMQ==','Kwagube','REMxMQ==','2020-12-27 17:33:42','2020-12-27 17:33:42',20),(267,'RzMzMQ==','Donge Pwani','REMxMQ==','2020-12-27 17:33:42','2020-12-27 17:33:42',20),(268,'SDA0MQ==','Ziwani','REMwMQ==','2020-12-27 17:33:42','2020-12-27 17:33:42',20),(269,'SDA1MQ==','Ndagoni','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(270,'SDA2MQ==','Kwale','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(271,'SDA3MQ==','Vitongoji','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(272,'SDA4Mw==','Ng\'ambwa','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(273,'SDA5MQ==','Shungi','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(274,'SDAwMg==','Mjini Ole','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(275,'SDAxMw==','Chanjaani','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(276,'SDAyMQ==','Wawi','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(277,'SDAzMg==','Gombani','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(278,'SDAzMQ==','Pujini','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(279,'SDE0Mg==','Chachani','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(280,'SDE1Mg==','Wara','REMwMQ==','2020-12-27 17:33:43','2020-12-27 17:33:43',20),(281,'SDE2MQ==','Mvumoni','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(282,'SDE3MQ==','Matale','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(283,'SDE4MQ==','Wesha','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(284,'SDE5MQ==','Uwandani','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(285,'SDExMQ==','Mgelema','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(286,'SDExNw==','Ole','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(287,'SDEyMQ==','Kilindi','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(288,'SDEyMw==','Chinga','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(289,'SDEzMg==','Tibirinzi','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(290,'SDI0MQ==','Michungwani','REMwMQ==','2020-12-27 17:33:44','2020-12-27 17:33:44',20),(291,'SDI1MQ==','Kibokoni','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(292,'SDI2Mg==','Kichungwani','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(293,'SDI3Mg==','Misingini','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(294,'SDI4Mg==','Mkoroshoni','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(295,'SDI5MQ==','Mfikiwa','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(296,'SDIwMg==','Madungu','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(297,'SDIxMQ==','Mgogoni','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(298,'SDIyMQ==','Dodo','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(299,'SDIzMQ==','Mbuzini','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(300,'SDM2NA==','Mchanga Mrima','REMwMQ==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(301,'SjAxMg==','Kipangani','REMwNA==','2020-12-27 17:33:45','2020-12-27 17:33:45',20),(302,'SjAxMQ==','Kisiwani','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(303,'SjAxMw==','Ukunjwi','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(304,'SjAxNA==','Pandani','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(305,'SjAxNg==','Bopwe','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(306,'SjAxNQ==','Shengejuu','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(307,'SjAxNw==','Utaani','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(308,'SjAxOA==','Mtambwe Kusini','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(309,'SjAxOQ==','Selem','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(310,'SjAyMA==','Kinyikani','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(311,'SjAyMg==','Maziwani','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(312,'SjAyMQ==','Chwale','REMwMw==','2020-12-27 17:33:46','2020-12-27 17:33:46',20),(313,'SjAyMw==','Mpambani','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(314,'SjAyNA==','Mjini Ole','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(315,'SjAyNg==','Mzambaru takau','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(316,'SjAyNQ==','Kiuyu Kigongoni','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(317,'SjAyNw==','Junguni','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(318,'SjAyOA==','Kiungoni','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(319,'SjAyOQ==','Pembeni','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(320,'SjAzMA==','Kizimbani','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(321,'SjAzMg==','Jadida','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(322,'SjAzMQ==','Limbani','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(323,'SjAzMw==','Mlindo','REMwMw==','2020-12-27 17:33:47','2020-12-27 17:33:47',20),(324,'SjAzNA==','Mlindo','REMwMw==','2020-12-27 17:33:48','2020-12-27 17:33:48',20),(325,'SjExMA==','Piki','REMwMw==','2020-12-27 17:33:48','2020-12-27 17:33:48',20),(326,'SjExMg==','Mtambwe Kaskazini','REMwMw==','2020-12-27 17:33:48','2020-12-27 17:33:48',20),(327,'SjExMQ==','Kipangani','REMwMw==','2020-12-27 17:33:48','2020-12-27 17:33:48',20),(328,'SjExMw==','Fundo','REMwMw==','2020-12-27 17:33:48','2020-12-27 17:33:48',20),(329,'SjExNA==','Mchanga mdogo','REMwMw==','2020-12-27 17:33:48','2020-12-27 17:33:48',20),(330,'SjExNg==','Kojani','REMwMw==','2020-12-27 17:33:48','2020-12-27 17:33:48',20),(331,'SjExNQ==','Kambini','REMwMw==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(332,'SjExOA==','Kangagani','REMwMw==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(333,'SjExOQ==','Kiuyu minungwini','REMwMw==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(334,'STA0MQ==','Shidi','REMwMg==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(335,'STA1MQ==','Mkanyageni','REMwMg==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(336,'STA2MQ==','Michenzani','REMwMg==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(337,'STA3MQ==','Chokocho','REMwMg==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(338,'STA4MQ==','Kisiwa Panza','REMwMg==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(339,'STA5MQ==','Kangani','REMwMg==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(340,'STAxMg==','Ng\'ombeni','REMwMg==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(341,'STAyMQ==','Makombeni','REMwMg==','2020-12-27 17:33:49','2020-12-27 17:33:49',20),(342,'STAzMQ==','Makoongwe','REMwMg==','2020-12-27 17:33:50','2020-12-27 17:33:50',20),(343,'STE0MQ==','Mzingani','REMwMg==','2020-12-27 17:33:50','2020-12-27 17:33:50',20),(344,'STE1MQ==','Ngwachani','REMwMg==','2020-12-27 17:33:50','2020-12-27 17:33:50',20),(345,'STE2MQ==','Chambani','REMwMg==','2020-12-27 17:33:50','2020-12-27 17:33:50',20),(346,'STE3MQ==','Wambaa','REMwMg==','2020-12-27 17:33:50','2020-12-27 17:33:50',20),(347,'STE4Mw==','Mbuguani','REMwMg==','2020-12-27 17:33:50','2020-12-27 17:33:50',20),(348,'STE5Mg==','Uweleni','REMwMg==','2020-12-27 17:33:50','2020-12-27 17:33:50',20),(349,'STEwMw==','Kengeja','REMwMg==','2020-12-27 17:33:51','2020-12-27 17:33:51',20),(350,'STExMQ==','Muambe','REMwMg==','2020-12-27 17:33:51','2020-12-27 17:33:51',20),(351,'STEyMQ==','Kiwani','REMwMg==','2020-12-27 17:33:51','2020-12-27 17:33:51',20),(352,'STEzMw==','Mtambile','REMwMg==','2020-12-27 17:33:51','2020-12-27 17:33:51',20),(353,'STI0MQ==','Stahabu','REMwMg==','2020-12-27 17:33:51','2020-12-27 17:33:51',20),(354,'STI1MQ==','Kuukuu','REMwMg==','2020-12-27 17:33:51','2020-12-27 17:33:51',20),(355,'STI2MQ==','Mjimbini','REMwMg==','2020-12-27 17:33:52','2020-12-27 17:33:52',20),(356,'STI3MQ==','Shamiani','REMwMg==','2020-12-27 17:33:52','2020-12-27 17:33:52',20),(357,'STI4MQ==','Jombwe','REMwMg==','2020-12-27 17:33:52','2020-12-27 17:33:52',20),(358,'STI5MQ==','Kendwa','REMwMg==','2020-12-27 17:33:52','2020-12-27 17:33:52',20),(359,'STIwMQ==','Mtangani','REMwMg==','2020-12-27 17:33:52','2020-12-27 17:33:52',20),(360,'STIxMQ==','Ukutini','REMwMg==','2020-12-27 17:33:53','2020-12-27 17:33:53',20),(361,'STIyMQ==','Chumbageni','REMwMg==','2020-12-27 17:33:53','2020-12-27 17:33:53',20),(362,'STIzMg==','Mbuyuni','REMwMg==','2020-12-27 17:33:53','2020-12-27 17:33:53',20),(363,'STMwMQ==','Minazini','REMwMg==','2020-12-27 17:33:53','2020-12-27 17:33:53',20),(364,'STMxMQ==','Mgagadu','REMwMg==','2020-12-27 17:33:53','2020-12-27 17:33:53',20),(365,'STMyMQ==','Mkungu','REMwMg==','2020-12-27 17:33:53','2020-12-27 17:33:53',20),(366,'STMzMw==','Changaweni','REMwMg==','2020-12-27 17:33:54','2020-12-27 17:33:54',20),(367,'SzAwMTM=','Micheweni','REMwNA==','2020-12-27 17:33:54','2020-12-27 17:33:54',20),(368,'SzAxMA==','Mlindo','REMwNA==','2020-12-27 17:33:54','2020-12-27 17:33:54',20),(369,'SzAxMg==','Wingwi Mapofu','REMwNA==','2020-12-27 17:33:54','2020-12-27 17:33:54',20),(370,'SzAxMjE=','Wingwi Njuguni','REMwNA==','2020-12-27 17:33:54','2020-12-27 17:33:54',20),(371,'SzAxMQ==','Msuka Magharibi','REMwNA==','2020-12-27 17:33:54','2020-12-27 17:33:54',20),(372,'SzAxMTE=','Makangale','REMwNA==','2020-12-27 17:33:54','2020-12-27 17:33:54',20),(373,'SzAxMw==','Finya','REMwMw==','2020-12-27 17:33:54','2020-12-27 17:33:54',20),(374,'SzAxMzE=','Shumba Mjini','REMwNA==','2020-12-27 17:33:55','2020-12-27 17:33:55',20),(375,'SzAxNA==','Tumbe Magharibi','REMwNA==','2020-12-27 17:33:55','2020-12-27 17:33:55',20),(376,'SzAxNDI=','Majenzi','REMwNA==','2020-12-27 17:33:55','2020-12-27 17:33:55',20),(377,'SzAxNDM=','Kijogoo','REMwNA==','2020-12-27 17:33:55','2020-12-27 17:33:55',20),(378,'SzAxNg==','shumba viamboni','REMwNA==','2020-12-27 17:33:55','2020-12-27 17:33:55',20),(379,'SzAxNQ==','Konde','REMwNA==','2020-12-27 17:33:55','2020-12-27 17:33:55',20),(380,'SzAxNTE=','Mjini wingwi','REMwNA==','2020-12-27 17:33:55','2020-12-27 17:33:55',20),(381,'SzAxNw==','Mgogoni','REMwMw==','2020-12-27 17:33:55','2020-12-27 17:33:55',20),(382,'SzAxOA==','Tumbe Mashariki','REMwNA==','2020-12-27 17:33:56','2020-12-27 17:33:56',20),(383,'SzAxOQ==','Kinowe','REMwNA==','2020-12-27 17:33:56','2020-12-27 17:33:56',20),(384,'SzAyMDE=','Kinyasini','REMwMw==','2020-12-27 17:33:56','2020-12-27 17:33:56',20),(385,'SzAyMjE=','Kifundi','REMwNA==','2020-12-27 17:33:56','2020-12-27 17:33:56',20),(386,'SzAyMQ==','Msuka Mashariki','REMwNA==','2020-12-27 17:33:56','2020-12-27 17:33:56',20),(387,'SzAyMTE=','Mihogoni','REMwNA==','2020-12-27 17:33:56','2020-12-27 17:33:56',20),(388,'SzAyMzE=','Maziwa Ngombe','REMwNA==','2020-12-27 17:33:56','2020-12-27 17:33:56',20),(389,'SzAyMzI=','Kilindi','REMxMA==','2020-12-27 17:33:56','2020-12-27 17:33:56',20),(390,'SzE1NQ==','Chamboni','REMwNA==','2020-12-27 17:33:57','2020-12-27 17:33:57',20),(391,'SzE5MQ==','Sizini','REMwNA==','2020-12-27 17:33:57','2020-12-27 17:33:57',20),(392,'SzEwMQ==','Kiuyu Mbuyuni','REMwNA==','2020-12-27 17:33:57','2020-12-27 17:33:57',20),(393,'SzExMg==','Mtemani','REMwMw==','2020-12-27 17:33:57','2020-12-27 17:33:57',20),(394,'SzExMQ==','Mjananza','REMwMw==','2020-12-27 17:33:57','2020-12-27 17:33:57',20),(395,'SzExMw==','Tondooni','REMwNA==','2020-12-27 17:33:57','2020-12-27 17:33:57',20),(396,'SzExNQ==','Chimba','REMwNA==','2020-12-27 17:33:57','2020-12-27 17:33:57',20),(397,'SzExOQ==','Shanake','REMwNA==','2020-12-27 17:33:57','2020-12-27 17:33:57',20),(398,'SzIyMQ==','Kipange','REMwNA==','2020-12-27 17:33:58','2020-12-27 17:33:58',20),(399,'SzIzMw==','Kinowejiso','REMwNA==','2020-12-27 17:33:58','2020-12-27 17:33:58',20),(400,'SzQzNQ==','Wingwi Mtemani','REMwNA==','2020-12-27 17:33:58','2020-12-27 17:33:58',20),(401,'U2hhbmdhbmk=','C012','REMwNw==','2020-12-27 17:33:58','2020-12-27 17:33:58',20);
/*!40000 ALTER TABLE `shehia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `staffId` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `physicalAddress` varchar(100) NOT NULL,
  `dateofbirth` varchar(100) NOT NULL,
  `tell` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `eduLevel` varchar(45) DEFAULT NULL,
  `award` varchar(45) DEFAULT NULL,
  `graduationDate` datetime DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `staffId` (`staffId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'Ali','Juma','Makame','Mombasa','2022-12-20','255778909090','abdulmajeedhajji@gmail.com','618118.','Certification','Pharmacist','2022-12-13 00:00:00','2022-12-21 18:06:00','2022-12-21 18:06:00',1);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(145) DEFAULT NULL,
  `item_description` varchar(145) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `store_quantity` varchar(245) DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id_UNIQUE` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (1,'Panadol','This si Panadol Description',1,'340',NULL,'2022-12-24 14:28:43','2022-12-24 18:40:37',1),(2,'Citrozen','Speacila Medicine Item for Sleeping',1,NULL,NULL,'2022-12-24 14:32:50','2022-12-24 14:32:50',1),(3,'Magnezium','Medicine Spacial for Gas in the stomach',1,NULL,NULL,'2022-12-24 14:37:15','2022-12-24 14:37:15',1),(4,'Nivea Deoderant','Deodorant form body odor',1,NULL,NULL,'2022-12-24 14:37:57','2022-12-24 14:37:57',1),(6,'Panadol (Kenya)','This si Panadol from kenya',1,'380','2023-01-03 00:00:00','2023-01-02 19:00:49','2023-01-02 19:18:09',1);
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(145) DEFAULT NULL,
  `contact_person` varchar(145) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`supplier_id`),
  UNIQUE KEY `supplier_id_UNIQUE` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'Izmir Suppliers LImited','Juma Makme Haji','Mombasa','abdulmajeedhajji@gmail.com','0778398441','2022-12-24 18:22:05','2022-12-24 18:22:05',1,1);
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `password` varchar(150) NOT NULL,
  `firstName` varchar(150) NOT NULL,
  `middleName` varchar(150) NOT NULL,
  `lastName` varchar(150) NOT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `roleCode` varchar(45) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `login` int DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'79f3107220fc4d38d31fcf24001a16e720b9cf08585871f33','Abdulmajeed','Hajji','Hassan','M','+255778398441','abdulmajeedhajjii@gmail.com','1',1,1,NULL,'2022-12-22 22:57:20',1),(2,'eb1366e23f2849b74fe0e2c42d6fb91890d9846052a4d247b','Ali','Juma','Makame',NULL,NULL,'abdulmajeedhajji@gmail.com','2',1,1,'2022-12-21 18:06:00','2022-12-21 18:06:00',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zone` (
  `zoneID` int NOT NULL AUTO_INCREMENT,
  `zoneCode` varchar(50) NOT NULL,
  `zoneName` varchar(250) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`zoneID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zone`
--

LOCK TABLES `zone` WRITE;
/*!40000 ALTER TABLE `zone` DISABLE KEYS */;
INSERT INTO `zone` VALUES (1,'WjAwMQ==','Unguja','2020-12-27 17:33:08','2020-12-27 17:33:08',20),(2,'WjAwMg==','Pemba','2020-12-27 17:33:08','2020-12-27 17:33:08',20);
/*!40000 ALTER TABLE `zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'aspire_pharmacy'
--

--
-- Dumping routines for database 'aspire_pharmacy'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-02 19:53:20
