CREATE DATABASE  IF NOT EXISTS `web_project` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `web_project`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: web_project
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.31-MariaDB

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` char(64) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address_one` varchar(45) NOT NULL,
  `address_two` varchar(45) DEFAULT NULL,
  `city` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `fk_account_permission1_idx` (`permission_id`),
  CONSTRAINT `fk_account_permission1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,1,'Liam1','Sarsfield','liamsarsfield1499@gmail.com','f2e2c97dfaeb733bcba44a36b4bec495de8aecd52b79281cb2bf0e56dc4130e0','862384771','Reens','Ardagh','Ardagh','Munster','V42FH10','IE'),(2,3,'Liam','Sarsfield','testing@gmail.com','b822f1cd2dcfc685b47e83e3980289fd5d8e3ff3a82def24d7d1d68bb272eb32','0862384771','Reens','Ardagh','Ardagh','Munster','V42FH10','IE'),(3,2,'Liam','Sarsfield','staff@gmail.com','10176e7b7b24d317acfcf8d2064cfd2f24e154f7b5a96603077d5ef813d6a6b6','862384771','Reens','Ardagh','Ardagh','Munster','V42FH10','Ireland');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Circuits');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credit_note`
--

DROP TABLE IF EXISTS `credit_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credit_note` (
  `credit_note_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_order_id` int(11) NOT NULL,
  `total_price` decimal(6,2) NOT NULL,
  `reason` varchar(25) DEFAULT 'N/A',
  PRIMARY KEY (`credit_note_id`,`customer_order_id`),
  KEY `fk_credit_note_customer_order1_idx` (`customer_order_id`),
  CONSTRAINT `fk_credit_note_customer_order1` FOREIGN KEY (`customer_order_id`) REFERENCES `customer_order` (`customer_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credit_note`
--

LOCK TABLES `credit_note` WRITE;
/*!40000 ALTER TABLE `credit_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `credit_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `company` varchar(45) DEFAULT 'N/A',
  PRIMARY KEY (`customer_id`),
  KEY `fk_customer_account1_idx` (`account_id`),
  CONSTRAINT `fk_customer_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,1,'Company');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_invoice`
--

DROP TABLE IF EXISTS `customer_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_invoice` (
  `customer_invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_order_id` int(11) NOT NULL,
  `total_price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`customer_invoice_id`,`customer_order_id`),
  KEY `fk_customer_invoice_customer_order1_idx` (`customer_order_id`),
  CONSTRAINT `fk_customer_invoice_customer_order1` FOREIGN KEY (`customer_order_id`) REFERENCES `customer_order` (`customer_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_invoice`
--

LOCK TABLES `customer_invoice` WRITE;
/*!40000 ALTER TABLE `customer_invoice` DISABLE KEYS */;
INSERT INTO `customer_invoice` VALUES (1,8,7.00),(2,9,4.00),(3,7,3.00),(4,10,21.00),(5,11,383.00);
/*!40000 ALTER TABLE `customer_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_order`
--

DROP TABLE IF EXISTS `customer_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_order` (
  `customer_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date_ordered` date NOT NULL,
  `total_price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`customer_order_id`,`customer_id`),
  KEY `fk_customer_order_customer1_idx` (`customer_id`),
  CONSTRAINT `fk_customer_order_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_order`
--

LOCK TABLES `customer_order` WRITE;
/*!40000 ALTER TABLE `customer_order` DISABLE KEYS */;
INSERT INTO `customer_order` VALUES (7,1,'2019-02-10',3.00),(8,1,'2019-02-10',7.00),(9,1,'2019-02-10',4.00),(10,1,'2019-02-10',21.00),(11,1,'2019-02-13',383.00);
/*!40000 ALTER TABLE `customer_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_quote`
--

DROP TABLE IF EXISTS `customer_quote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_quote` (
  `customer_quote_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `description` longtext,
  `specs` varchar(45) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  PRIMARY KEY (`customer_quote_id`),
  KEY `fk_customer_quote_customer1_idx` (`customer_id`),
  CONSTRAINT `fk_customer_quote_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_quote`
--

LOCK TABLES `customer_quote` WRITE;
/*!40000 ALTER TABLE `customer_quote` DISABLE KEYS */;
INSERT INTO `customer_quote` VALUES (4,1,'1','2','3',4.00,5),(5,1,'1','2','3',4.00,0),(6,1,'dwa','dwa','21',21.00,0),(7,1,'Circuit Board for #2','I am requesting a circuit board to adhere to the protocol #2718B.','#2718B Certified board.',350.00,3);
/*!40000 ALTER TABLE `customer_quote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_data`
--

DROP TABLE IF EXISTS `login_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_data` (
  `login_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `last_login_date` date NOT NULL,
  `last_login_time` time NOT NULL,
  PRIMARY KEY (`login_id`,`account_id`),
  KEY `fk_login_data_account1_idx` (`account_id`),
  CONSTRAINT `fk_login_data_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_data`
--

LOCK TABLES `login_data` WRITE;
/*!40000 ALTER TABLE `login_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lot_traveller`
--

DROP TABLE IF EXISTS `lot_traveller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lot_traveller` (
  `lot_traveller_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `production_quantity` int(11) NOT NULL,
  `is_completed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lot_traveller_id`),
  KEY `fk_lot_traveller_product1_idx` (`product_id`),
  CONSTRAINT `fk_lot_traveller_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lot_traveller`
--

LOCK TABLES `lot_traveller` WRITE;
/*!40000 ALTER TABLE `lot_traveller` DISABLE KEYS */;
/*!40000 ALTER TABLE `lot_traveller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  PRIMARY KEY (`material_id`,`supplier_id`),
  KEY `fk_material_supplier1_idx` (`supplier_id`),
  CONSTRAINT `fk_material_supplier1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,1,'1','2',3.00,6);
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multi_credit_note_items`
--

DROP TABLE IF EXISTS `multi_credit_note_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multi_credit_note_items` (
  `credit_note_id` int(11) NOT NULL,
  `customer_quote_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  KEY `fk_customer_quote_has_credit_note_credit_note1_idx` (`credit_note_id`),
  KEY `fk_customer_quote_has_credit_note_customer_quote1_idx` (`customer_quote_id`),
  KEY `fk_multi_credit_note_items_product1_idx` (`product_id`),
  CONSTRAINT `fk_customer_quote_has_credit_note_credit_note1` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_note` (`credit_note_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_quote_has_credit_note_customer_quote1` FOREIGN KEY (`customer_quote_id`) REFERENCES `customer_quote` (`customer_quote_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_multi_credit_note_items_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multi_credit_note_items`
--

LOCK TABLES `multi_credit_note_items` WRITE;
/*!40000 ALTER TABLE `multi_credit_note_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `multi_credit_note_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multi_customers_order_items`
--

DROP TABLE IF EXISTS `multi_customers_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multi_customers_order_items` (
  `customer_order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_quote_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  KEY `fk_customer_order_has_product_product1_idx` (`product_id`),
  KEY `fk_customer_order_has_product_customer_order_idx` (`customer_order_id`),
  KEY `fk_customers_ordered_products_customer_quote1_idx` (`customer_quote_id`),
  CONSTRAINT `fk_customer_order_has_product_customer_order` FOREIGN KEY (`customer_order_id`) REFERENCES `customer_order` (`customer_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_order_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_customers_ordered_products_customer_quote1` FOREIGN KEY (`customer_quote_id`) REFERENCES `customer_quote` (`customer_quote_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multi_customers_order_items`
--

LOCK TABLES `multi_customers_order_items` WRITE;
/*!40000 ALTER TABLE `multi_customers_order_items` DISABLE KEYS */;
INSERT INTO `multi_customers_order_items` VALUES (7,1,NULL,3),(8,1,NULL,3),(8,NULL,4,5),(9,NULL,5,5),(10,NULL,6,2),(11,2,NULL,3),(11,NULL,7,3);
/*!40000 ALTER TABLE `multi_customers_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multi_sidebar_permissions`
--

DROP TABLE IF EXISTS `multi_sidebar_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multi_sidebar_permissions` (
  `sidebar_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`sidebar_id`,`permission_id`),
  KEY `fk_permissions_has_sub_side_bar_permissions1_idx` (`permission_id`),
  KEY `fk_sidebar_permissions_sidebar1_idx` (`sidebar_id`),
  CONSTRAINT `fk_permissions_has_sub_side_bar_permissions1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sidebar_permissions_sidebar1` FOREIGN KEY (`sidebar_id`) REFERENCES `sidebar` (`sidebar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multi_sidebar_permissions`
--

LOCK TABLES `multi_sidebar_permissions` WRITE;
/*!40000 ALTER TABLE `multi_sidebar_permissions` DISABLE KEYS */;
INSERT INTO `multi_sidebar_permissions` VALUES (1,1),(1,2),(1,3),(2,1),(2,2),(3,2),(3,3),(3,4),(4,2),(6,4),(7,4),(8,4),(9,4),(10,4),(11,2),(12,1),(12,2),(12,3),(13,1),(13,2),(13,3),(14,3);
/*!40000 ALTER TABLE `multi_sidebar_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multi_sub_sidebar_function_permissions`
--

DROP TABLE IF EXISTS `multi_sub_sidebar_function_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multi_sub_sidebar_function_permissions` (
  `sub_sidebar_functions_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_sidebar_functions_id`,`permission_id`),
  KEY `fk_sub_sidebar_functions_has_permission_permission1_idx` (`permission_id`),
  KEY `fk_sub_sidebar_functions_has_permission_sub_sidebar_functio_idx` (`sub_sidebar_functions_id`),
  CONSTRAINT `fk_sub_sidebar_functions_has_permission_permission1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sub_sidebar_functions_has_permission_sub_sidebar_functions1` FOREIGN KEY (`sub_sidebar_functions_id`) REFERENCES `sub_sidebar_functions` (`sub_sidebar_functions_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multi_sub_sidebar_function_permissions`
--

LOCK TABLES `multi_sub_sidebar_function_permissions` WRITE;
/*!40000 ALTER TABLE `multi_sub_sidebar_function_permissions` DISABLE KEYS */;
INSERT INTO `multi_sub_sidebar_function_permissions` VALUES (1,3),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,3),(9,2),(10,2);
/*!40000 ALTER TABLE `multi_sub_sidebar_function_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multi_sub_sidebar_permissions`
--

DROP TABLE IF EXISTS `multi_sub_sidebar_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multi_sub_sidebar_permissions` (
  `sub_sidebar_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_sidebar_id`,`permission_id`),
  KEY `fk_sub_sidebar_has_permission_permission1_idx` (`permission_id`),
  KEY `fk_sub_sidebar_permissions_sub_sidebar1_idx` (`sub_sidebar_id`),
  CONSTRAINT `fk_sub_sidebar_has_permission_permission1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sub_sidebar_permissions_sub_sidebar1` FOREIGN KEY (`sub_sidebar_id`) REFERENCES `sub_sidebar` (`sub_sidebar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multi_sub_sidebar_permissions`
--

LOCK TABLES `multi_sub_sidebar_permissions` WRITE;
/*!40000 ALTER TABLE `multi_sub_sidebar_permissions` DISABLE KEYS */;
INSERT INTO `multi_sub_sidebar_permissions` VALUES (1,1),(2,1),(2,2),(3,1),(4,1),(5,2),(5,3),(6,2),(6,3),(7,2),(8,2),(9,2),(10,2),(20,1),(21,1),(22,1),(23,2),(23,3),(24,2),(25,2),(28,2),(29,2),(30,2),(31,2),(32,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(45,2),(46,1),(47,1),(48,1),(49,2),(51,3),(52,3),(53,1);
/*!40000 ALTER TABLE `multi_sub_sidebar_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multi_supplier_order_materials`
--

DROP TABLE IF EXISTS `multi_supplier_order_materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multi_supplier_order_materials` (
  `supplier_order_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '1',
  PRIMARY KEY (`supplier_order_id`,`material_id`),
  KEY `fk_supplier_order_has_material_material1_idx` (`material_id`),
  KEY `fk_supplier_order_has_material_supplier_order1_idx` (`supplier_order_id`),
  CONSTRAINT `fk_supplier_order_has_material_material1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_supplier_order_has_material_supplier_order1` FOREIGN KEY (`supplier_order_id`) REFERENCES `supplier_order` (`supplier_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multi_supplier_order_materials`
--

LOCK TABLES `multi_supplier_order_materials` WRITE;
/*!40000 ALTER TABLE `multi_supplier_order_materials` DISABLE KEYS */;
INSERT INTO `multi_supplier_order_materials` VALUES (1,1,1);
/*!40000 ALTER TABLE `multi_supplier_order_materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `access_level` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `permission_access_UNIQUE` (`access_level`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'Customer',2),(2,'Staff',4),(3,'Admin',5),(4,'Unregistered',0);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` longtext NOT NULL,
  `specs` longtext NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `image_path` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `fk_product_category1_idx` (`category_id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,'Test Product Name','This is a test','2829',1.00,21,'/assets/images/product/klv4dv2ayjtx5.jpg'),(2,1,'MSX Titan','This is a test','12',11.00,2,'/assets/images/product/klv4dv2ayjtx6.jpg');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_material`
--

DROP TABLE IF EXISTS `product_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_material` (
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_product_has_material_material1_idx` (`material_id`),
  KEY `fk_product_has_material_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_has_material_material1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_has_material_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_material`
--

LOCK TABLES `product_material` WRITE;
/*!40000 ALTER TABLE `product_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_cart`
--

DROP TABLE IF EXISTS `shopping_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_cart` (
  `shopping_cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(45) NOT NULL,
  PRIMARY KEY (`shopping_cart_id`),
  UNIQUE KEY `session_id_UNIQUE` (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_cart`
--

LOCK TABLES `shopping_cart` WRITE;
/*!40000 ALTER TABLE `shopping_cart` DISABLE KEYS */;
INSERT INTO `shopping_cart` VALUES (16,'11sdfs81vv1p22cm09h24unrbcuu4v3v'),(13,'1vsqjcj46cg7u45ur09fm2a39f7dkh7s'),(8,'5iavjn2ejoq29kr6qsobjqns47q9ecd6'),(5,'6jmarn107lf71par4jijl1olikdp3k4e'),(12,'9nmu5gs46005mdegjsm02d60vnj4lp54'),(9,'e096midmnqi6tagbv0pnhp35gqlpopis'),(1,'fc0mnhhl8prvjd5pgknfavqgvgs9mtk0'),(3,'fqv2lg65vj64h6mtpqsn0s1tjvbmtgo9'),(11,'jrp1m5oran3ic4pd1bnoi4bgnt85ldl1'),(4,'njk4enp9tu52eju9o0a45d1c9c5e3m5o'),(6,'p754sqn1i446qcdm32ivg389jufhv92g'),(7,'qv76n2ml8a9b0gbuq1t4tdfibli8m858'),(10,'s4pvl9fnrfvoll1glvj8fpro863vba6u'),(2,'vecpir1nu4i6t9pi4jcp3e1ej2kf9a16');
/*!40000 ALTER TABLE `shopping_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_cart_items`
--

DROP TABLE IF EXISTS `shopping_cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_cart_items` (
  `product_id` int(11) NOT NULL,
  `shopping_cart_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`shopping_cart_id`),
  KEY `fk_product_has_shopping_cart_shopping_cart1_idx` (`shopping_cart_id`),
  KEY `fk_product_has_shopping_cart_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_has_shopping_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_has_shopping_cart_shopping_cart1` FOREIGN KEY (`shopping_cart_id`) REFERENCES `shopping_cart` (`shopping_cart_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_cart_items`
--

LOCK TABLES `shopping_cart_items` WRITE;
/*!40000 ALTER TABLE `shopping_cart_items` DISABLE KEYS */;
INSERT INTO `shopping_cart_items` VALUES (1,1,1),(1,2,2),(1,3,1),(1,4,2),(1,5,1),(1,6,1),(1,7,2),(1,8,1),(1,9,1),(1,10,2),(1,11,2),(1,12,1),(1,13,1),(1,16,2),(2,1,1),(2,9,3);
/*!40000 ALTER TABLE `shopping_cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sidebar`
--

DROP TABLE IF EXISTS `sidebar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sidebar` (
  `sidebar_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `class` varchar(45) DEFAULT NULL,
  `anchor_tag` varchar(45) DEFAULT NULL,
  `order_priority` int(3) DEFAULT '10',
  PRIMARY KEY (`sidebar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sidebar`
--

LOCK TABLES `sidebar` WRITE;
/*!40000 ALTER TABLE `sidebar` DISABLE KEYS */;
INSERT INTO `sidebar` VALUES (1,'Account','fa-user',NULL,2),(2,'Store','fa-user',NULL,9),(3,'Customer','fa-drivers-license-o',NULL,9),(4,'Product','fa-sitemap',NULL,9),(5,'Admin','fa-home',NULL,9),(6,'Home','fa-home','home/',1),(7,'About','fa-user','home/about',9),(8,'Contact','fa-envelope','home/contact',9),(9,'Login','fa-pencil','home/login',9),(10,'Sign Up','fa-user-plus','home/register',9),(11,'Supplier','fa-ship ','',9),(12,'Home','fa-home','dashboard/home',1),(13,'Logout','fa-user','account/logout',10),(14,'Staff','fa-user',NULL,9);
/*!40000 ALTER TABLE `sidebar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `hired_date` date NOT NULL,
  `left_date` date DEFAULT NULL,
  `position` varchar(25) NOT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `fk_staff_account1_idx` (`account_id`),
  CONSTRAINT `fk_staff_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,2,'2019-02-10','2019-02-10','2019-02-10','Staff'),(2,3,'2019-02-14','2019-02-14','2019-02-14','CEO');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_sidebar`
--

DROP TABLE IF EXISTS `sub_sidebar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_sidebar` (
  `sub_sidebar_id` int(11) NOT NULL AUTO_INCREMENT,
  `sidebar_id` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `class` varchar(45) DEFAULT NULL,
  `anchor_tag` varchar(45) NOT NULL,
  PRIMARY KEY (`sub_sidebar_id`),
  KEY `fk_sub_sidebar_sidebar1_idx` (`sidebar_id`),
  CONSTRAINT `fk_sub_sidebar_sidebar1` FOREIGN KEY (`sidebar_id`) REFERENCES `sidebar` (`sidebar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_sidebar`
--

LOCK TABLES `sub_sidebar` WRITE;
/*!40000 ALTER TABLE `sub_sidebar` DISABLE KEYS */;
INSERT INTO `sub_sidebar` VALUES (1,1,'Edit Account',NULL,'customer_account/edit_my_account'),(2,2,'View Store','fa-shopping-basket','store/view_store'),(3,2,'View Shopping Cart','fa-shopping-basket','shopping_cart/view_shopping_cart'),(4,2,'View Checkout',NULL,'store/checkout'),(5,3,'Manage Customers',NULL,'functions/view/customer'),(6,3,'Add Customer',NULL,'functions/add/customer'),(7,3,'Manage Credit Notes',NULL,'functions/view/credit_note'),(8,3,'Add Credit Note',NULL,'functions/add/credit_note'),(9,3,'Manage Customer Invoices',NULL,'functions/view/customer_invoice'),(10,4,'Manage Categories',NULL,'functions/view/category'),(11,4,'Add Category',NULL,'functions/add/category'),(12,4,'Manage Products',NULL,'functions/view/product'),(13,4,'Add Product',NULL,'functions/add/product'),(14,4,'Manage Lot Travellers',NULL,'functions/view/lot_traveller'),(15,4,'Add Lot Traveller',NULL,'functions/add/lot_traveller'),(16,3,'Manage Work Orders',NULL,'functions/view/work_order'),(17,3,'Add Work Order',NULL,'functions/add/work_order'),(18,5,'Manage Staff',NULL,'functions/view/staff'),(19,5,'Add Staff',NULL,'functions/add/staff'),(20,1,'View Customer Orders',NULL,'customer_account/view_my_customer_orders'),(21,1,'View Returns',NULL,'customer_account/view_my_customer_returns'),(22,1,'View Invoices',NULL,'customer_account/view_my_customer_invoices'),(23,1,'Edit Account',NULL,'staff_account/edit_my_account'),(24,11,'Manage Suppliers',NULL,'functions/view/supplier'),(25,11,'Manage Materials',NULL,'functions/view/material'),(28,11,'Add Suppliers',NULL,'functions/add/supplier'),(29,11,'Add Materials',NULL,'functions/add/material'),(30,4,'Add Category',NULL,'functions/add/category'),(31,4,'Manage Products',NULL,'functions/view/product'),(32,4,'Add Product',NULL,'functions/add/product'),(35,11,'Manage Supplier Orders',NULL,'functions/view/supplier_order'),(36,11,'Add Supplier Order',NULL,'functions/add/supplier_order'),(37,4,'Manage Customer Quotes',NULL,'functions/view/customer_quote'),(38,5,'Add Customer Quote',NULL,'functions/add/customer_quote'),(39,5,'Manage Work Orders',NULL,'functions/view/work_order'),(40,3,'Manage Customer Order',NULL,'functions/view/customer_order'),(41,3,'Add Customer Order',NULL,'functions/add/customer_order'),(42,1,'View my Work Orders',NULL,'staff_account/view_my_work_orders'),(43,1,'View my Lot Travellers',NULL,'staff_account/view_my_lot_traveller'),(45,1,'View Unassigned Lot Travellers',NULL,'staff_account/view_lot_travellers'),(46,2,'Customer Quote Form',NULL,'store/customer_quote_form'),(47,14,'View my Customer order',NULL,'customer_account/view_my_customer_order'),(48,14,'Pay My Order',NULL,'customer_account/pay_my_order'),(49,1,'View Unassigned Work Orders',NULL,'staff_account/view_unassigned_work_orders'),(50,1,'View My Work Orders',NULL,'staff_account/view_my_work_orders'),(51,14,'Manage Staff',NULL,'functions/view/staff'),(52,14,'Add Staff',NULL,'functions/add/staff'),(53,NULL,'Edit Customer Order',NULL,'customer_account/edit_my_customer_order');
/*!40000 ALTER TABLE `sub_sidebar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_sidebar_functions`
--

DROP TABLE IF EXISTS `sub_sidebar_functions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_sidebar_functions` (
  `sub_sidebar_functions_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_sidebar_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `anchor_tag` varchar(255) NOT NULL,
  PRIMARY KEY (`sub_sidebar_functions_id`,`sub_sidebar_id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_sub_sidebar_functions_sub_sidebar1_idx` (`sub_sidebar_id`),
  CONSTRAINT `fk_sub_sidebar_functions_sub_sidebar1` FOREIGN KEY (`sub_sidebar_id`) REFERENCES `sub_sidebar` (`sub_sidebar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_sidebar_functions`
--

LOCK TABLES `sub_sidebar_functions` WRITE;
/*!40000 ALTER TABLE `sub_sidebar_functions` DISABLE KEYS */;
INSERT INTO `sub_sidebar_functions` VALUES (1,5,'Edit Customer','customer/edit_customer'),(2,12,'Edit Product','product/edit_product'),(3,10,'Edit Category','category/edit_category'),(4,49,'Assign Work Order to me','staff_account/assign_work_order'),(5,50,'Edit Work Order','staff_account/edit_my_work_order'),(6,50,'Unassign me from Work Order','staff_account/unassign_my_work_order'),(7,50,'Complete Work Order','staff_account/complete_my_work_order'),(8,51,'Edit Staff','staff/edit_staff'),(9,24,'Edit Supplier','supplier/edit_supplier'),(10,25,'Edit Material','material/edit_material');
/*!40000 ALTER TABLE `sub_sidebar_functions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address_one` varchar(30) NOT NULL,
  `address_two` varchar(30) DEFAULT NULL,
  `city` varchar(25) NOT NULL,
  `province` varchar(25) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'9','11','3','12','sefpoji','wfepoij','wefp[oji','wef[pokj','IE');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_order`
--

DROP TABLE IF EXISTS `supplier_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_order` (
  `supplier_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`supplier_order_id`,`supplier_id`),
  KEY `fk_supplier_order_supplier1_idx` (`supplier_id`),
  CONSTRAINT `fk_supplier_order_supplier1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_order`
--

LOCK TABLES `supplier_order` WRITE;
/*!40000 ALTER TABLE `supplier_order` DISABLE KEYS */;
INSERT INTO `supplier_order` VALUES (1,1,'2019-02-10','In Progress');
/*!40000 ALTER TABLE `supplier_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_order`
--

DROP TABLE IF EXISTS `work_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_order` (
  `work_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_quote_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Accepted',
  `is_completed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`work_order_id`,`customer_quote_id`),
  KEY `fk_work_order_staff1_idx` (`staff_id`),
  KEY `fk_work_order_customer_quote1_idx` (`customer_quote_id`),
  CONSTRAINT `fk_work_order_customer_quote1` FOREIGN KEY (`customer_quote_id`) REFERENCES `customer_quote` (`customer_quote_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_order_staff1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_order`
--

LOCK TABLES `work_order` WRITE;
/*!40000 ALTER TABLE `work_order` DISABLE KEYS */;
INSERT INTO `work_order` VALUES (3,4,NULL,'Staff Assigned',1),(4,5,NULL,'Staff Assigned',1),(5,6,NULL,'Staff Assigned',0),(6,7,1,'Staff Assigned',0);
/*!40000 ALTER TABLE `work_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-14 18:38:03
