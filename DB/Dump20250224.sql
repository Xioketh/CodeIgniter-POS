-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: noche_kitchen
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'BURGERS',NULL,1),(2,'WRAPS',NULL,1),(3,'HOTDOGS',NULL,1),(4,'VEG',NULL,1),(5,'VEGAN',NULL,1),(6,'MUNCHEES',NULL,1),(7,'THIRSTY',NULL,1),(8,'ADD ON',NULL,1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foods` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` double(10,2) DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foods`
--

LOCK TABLES `foods` WRITE;
/*!40000 ALTER TABLE `foods` DISABLE KEYS */;
INSERT INTO `foods` VALUES (1,'Crispy Chicken',1000.00,1,1),(2,'Double Crispy Chicken',1500.00,1,1),(3,'Beef 100g',1400.00,1,1),(4,'Double Beef 200g',1600.00,1,1),(5,'Veggie Mix',900.00,1,1),(6,'Omelette',600.00,1,1),(7,'Crispy Chicken',1000.00,1,2),(8,'Double Crispy Chicken',1500.00,1,2),(9,'Beef 100g',1300.00,1,2),(10,'Double Beef 200g',1600.00,1,2),(11,'Veggie Mix',900.00,1,2),(12,'Full Avocado',700.00,1,2),(13,'Scramble Eggs',600.00,1,2),(14,'Avocado & Scramble Eggs',900.00,1,2),(15,'Cow Cheese, Tomato, Pepper',850.00,1,2),(16,'Chicken Sausage',1000.00,1,3),(17,'Crispy Chicken',1000.00,1,3),(18,'Beef 100g',1400.00,1,3),(19,'Scramble Eggs',600.00,1,3),(20,'Veggie Mix Burger',900.00,1,4),(21,'Omelette Burger',600.00,1,4),(22,'Veggie Mix Wrap',900.00,1,4),(23,'Full Avocado Wrap',700.00,1,4),(24,'Scramble Eggs Wrap',600.00,1,4),(25,'Avocado & Scramble Eggs Wrap',900.00,1,4),(26,'Scramble Eggs Hotdog',600.00,1,4),(27,'Veggie Mix Burger',900.00,1,5),(28,'Veggie Mix Wrap',900.00,1,5),(29,'Full Avocado Wrap',700.00,1,5),(30,'Special Wrap',1200.00,1,6),(31,'Water Bottle (500ml)',100.00,1,7),(32,'Coca Cola',150.00,1,7),(33,'Fresh Coffee',200.00,1,7),(34,'One Egg',100.00,1,8),(35,'Extra Cheese',200.00,1,8);
/*!40000 ALTER TABLE `foods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025-02-21-090756','App\\Database\\Migrations\\CreateCategoriesTable','default','App',1740398525,1),(2,'2025-02-22-074130','App\\Database\\Migrations\\CreateFoodsTable','default','App',1740398525,1),(3,'2025-02-22-074147','App\\Database\\Migrations\\CreateOrdersTable','default','App',1740398525,1),(4,'2025-02-22-074154','App\\Database\\Migrations\\CreateOrderItemsTable','default','App',1740398525,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `food_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `food_id` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `order_id` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,'Crispy Chicken','1',2,1000.00,2000.00,'ORD0001'),(2,'One Egg','34',2,100.00,200.00,'ORD0001'),(3,'Extra Cheese','35',1,200.00,200.00,'ORD0001'),(4,'Full Avocado','12',1,700.00,700.00,'ORD0001'),(5,'Crispy Chicken','7',2,1000.00,2000.00,'ORD0002'),(6,'Full Avocado','12',2,700.00,1400.00,'ORD0002'),(7,'Beef 100g','18',2,1400.00,2800.00,'ORD0002'),(8,'Double Crispy Chicken','8',2,1500.00,3000.00,'ORD0002'),(9,'Special Wrap','30',1,1200.00,1200.00,'ORD0002'),(10,'Chicken Sausage','16',1,1000.00,1000.00,'ORD0002'),(11,'Chicken Sausage','16',2,1000.00,2000.00,'ORD0003'),(12,'Crispy Chicken','7',2,1000.00,2000.00,'ORD0003'),(13,'Extra Cheese','35',2,200.00,400.00,'ORD0003');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_date` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `tot_qty` int NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `order_id` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'2025-02-24 12:05:55',6,3100.00,'ORD0001',1),(2,'2025-02-24 12:06:31',10,11400.00,'ORD0002',1),(3,'2025-02-24 12:07:06',6,4400.00,'ORD0003',1);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-24 17:42:56
