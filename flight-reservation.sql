CREATE DATABASE  IF NOT EXISTS `flight_reservation` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `flight_reservation`;
-- MySQL dump 10.13  Distrib 8.0.20, for macos10.15 (x86_64)
--
-- Host: localhost    Database: flight_reservation
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'PENDING',
  `role` varchar(45) NOT NULL DEFAULT 'USER',
  `token` varchar(45) NOT NULL,
  `token_created_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (2,'hanja','hanja@hanja.com','hanja','PENDING','USER','',NULL),(3,'kenan','kenan@bektas.me','kenanxd','PENDING','USER','',NULL),(4,'dino','dino@bektas.ch','dinoxd','PENDING','USER','',NULL),(5,'amina','amina@mehic.ba','amina3','PENDING','USER','',NULL),(7,'Aaaasja','asja@m.ba','assja1','ACTIVE','USER','',NULL),(9,'belmin','bela@trle.xd','belabela','PENDING','USER','',NULL),(10,'emina','emina@mehic.xd','emina6','PENDING','USER','',NULL),(11,'haki','hako@hako.xd','haki2','ACTIVE','USER','',NULL),(34,'Dino Bektas','dino@bekta.me','90e78af990b2cc66b23f3948f29f250e','ACTIVE','USER','',NULL),(40,'Amina Mehic','mehicamina7@gmail.com','9399e7797b2953f82a3169174cd5fb3c','ACTIVE','USER','1bd3ed28c3cb22fe2c573fa8caf94724','2021-04-07 11:15:41'),(42,'Faris Bektas','farisbektas0@gmail.com','202cb962ac59075b964b07152d234b70','ACTIVE','ADMIN','327c1d89de30539e903508e4d0870b6b',NULL),(43,'Beka','faris@bekta.me','827ccb0eea8a706c4c34a16891f84e7b','ACTIVE','USER','73ccaf6751ef7debd458a474810e4131',NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `airports` (
  `airportid` int NOT NULL AUTO_INCREMENT,
  `airport_city` varchar(45) NOT NULL,
  `airport_name` varchar(45) NOT NULL,
  PRIMARY KEY (`airportid`),
  UNIQUE KEY `airportid_UNIQUE` (`airportid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airports`
--

LOCK TABLES `airports` WRITE;
/*!40000 ALTER TABLE `airports` DISABLE KEYS */;
INSERT INTO `airports` VALUES (1,'Sarajevo','International Airport Sarajevo'),(2,'Mostar','Mostar International Airport'),(3,'Visoko','Visoko Airport'),(4,'Prijedor','Prijedor Urije Airport'),(5,'Tuzla','Tuzla International Airport'),(6,'Bihac','Bihac Golubic Airport'),(7,'Banja Luka','Banja Luka International Airport'),(8,'Livno','Livno Airport'),(10,'Doboj','Doboj Airport'),(11,'Trebinje','Trebinje Airport');
/*!40000 ALTER TABLE `airports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `flight_id` int NOT NULL,
  `account_id` int NOT NULL,
  `payement_id` int DEFAULT NULL,
  `payement_price` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id_UNIQUE` (`id`),
  KEY `flight_id_key_idx` (`flight_id`),
  KEY `account_id_key_idx` (`account_id`),
  KEY `payement_id_key_idx` (`payement_id`),
  CONSTRAINT `account_id_key` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `flight_id_key` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flightid`),
  CONSTRAINT `payement_id_key` FOREIGN KEY (`payement_id`) REFERENCES `payements` (`payementid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,1,4,NULL,200),(2,1,2,NULL,100);
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flights` (
  `flightid` int NOT NULL AUTO_INCREMENT,
  `flight_direction` varchar(45) NOT NULL,
  `airport_id` int NOT NULL,
  `flight_class` varchar(45) NOT NULL,
  `flight_origin` varchar(45) NOT NULL,
  `accountid` int DEFAULT NULL,
  PRIMARY KEY (`flightid`),
  UNIQUE KEY `flightid_UNIQUE` (`flightid`),
  KEY `airport_id_key_idx` (`airport_id`),
  KEY `accountid_key_idx` (`accountid`),
  CONSTRAINT `accountid_key` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`id`),
  CONSTRAINT `airport_id_key` FOREIGN KEY (`airport_id`) REFERENCES `airports` (`airportid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flights`
--

LOCK TABLES `flights` WRITE;
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
INSERT INTO `flights` VALUES (1,'Basel',5,'First class','nepostoji',NULL),(2,'Paris',1,'Economic class','nista',NULL),(3,'London',1,'Economic class','nistax3',NULL),(4,'Istanbul',1,'Economic class','or1',42);
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payements`
--

DROP TABLE IF EXISTS `payements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payements` (
  `payementid` int NOT NULL AUTO_INCREMENT,
  `payement_method` varchar(45) NOT NULL,
  `card_number` int NOT NULL,
  `expiration_year` int NOT NULL,
  `expiration_date` int NOT NULL,
  `userid` int NOT NULL,
  PRIMARY KEY (`payementid`),
  UNIQUE KEY `payementid_UNIQUE` (`payementid`),
  KEY `user_id_key_idx` (`userid`),
  CONSTRAINT `user_id_key` FOREIGN KEY (`userid`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payements`
--

LOCK TABLES `payements` WRITE;
/*!40000 ALTER TABLE `payements` DISABLE KEYS */;
INSERT INTO `payements` VALUES (1,'Credit Card',53515321,2023,13,3);
/*!40000 ALTER TABLE `payements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-27 10:01:11
