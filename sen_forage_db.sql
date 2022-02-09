-- MySQL dump 10.13  Distrib 8.0.28, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: sen_forage_db
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `abonnement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `habitant_id` int DEFAULT NULL,
  `attribution_id` int DEFAULT NULL,
  `dateAbo` date NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_351268BBEEB69F7B` (`attribution_id`),
  KEY `IDX_351268BBA76ED395` (`user_id`),
  KEY `IDX_351268BB8254716F` (`habitant_id`),
  CONSTRAINT `FK_351268BB8254716F` FOREIGN KEY (`habitant_id`) REFERENCES `habitant` (`id`),
  CONSTRAINT `FK_351268BBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_351268BBEEB69F7B` FOREIGN KEY (`attribution_id`) REFERENCES `attribution` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonnement`
--

LOCK TABLES `abonnement` WRITE;
/*!40000 ALTER TABLE `abonnement` DISABLE KEYS */;
/*!40000 ALTER TABLE `abonnement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attribution`
--

DROP TABLE IF EXISTS `attribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attribution` (
  `id` int NOT NULL AUTO_INCREMENT,
  `compteur_id` int DEFAULT NULL,
  `abonnement_id` int DEFAULT NULL,
  `dateAttribution` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C751ED49AA3B9810` (`compteur_id`),
  UNIQUE KEY `UNIQ_C751ED49F1D74413` (`abonnement_id`),
  CONSTRAINT `FK_C751ED49AA3B9810` FOREIGN KEY (`compteur_id`) REFERENCES `compteur` (`id`),
  CONSTRAINT `FK_C751ED49F1D74413` FOREIGN KEY (`abonnement_id`) REFERENCES `abonnement` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attribution`
--

LOCK TABLES `attribution` WRITE;
/*!40000 ALTER TABLE `attribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `attribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compteur`
--

DROP TABLE IF EXISTS `compteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `attribution_id` int DEFAULT NULL,
  `cumul` int NOT NULL,
  `lastCumul` int NOT NULL,
  `etat` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4D021BD5EEB69F7B` (`attribution_id`),
  KEY `IDX_4D021BD5A76ED395` (`user_id`),
  CONSTRAINT `FK_4D021BD5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_4D021BD5EEB69F7B` FOREIGN KEY (`attribution_id`) REFERENCES `attribution` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compteur`
--

LOCK TABLES `compteur` WRITE;
/*!40000 ALTER TABLE `compteur` DISABLE KEYS */;
/*!40000 ALTER TABLE `compteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consommation`
--

DROP TABLE IF EXISTS `consommation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consommation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `compteur_id` int DEFAULT NULL,
  `dateConsommation` date NOT NULL,
  `quantite` int NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_F993F0A2A76ED395` (`user_id`),
  KEY `IDX_F993F0A2AA3B9810` (`compteur_id`),
  CONSTRAINT `FK_F993F0A2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F993F0A2AA3B9810` FOREIGN KEY (`compteur_id`) REFERENCES `compteur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consommation`
--

LOCK TABLES `consommation` WRITE;
/*!40000 ALTER TABLE `consommation` DISABLE KEYS */;
/*!40000 ALTER TABLE `consommation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reglement_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `consommation_id` int DEFAULT NULL,
  `montantFacture` int NOT NULL,
  `dateFacture` date NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_FE8664106A477111` (`reglement_id`),
  KEY `IDX_FE866410A76ED395` (`user_id`),
  KEY `IDX_FE866410C1076F84` (`consommation_id`),
  CONSTRAINT `FK_FE8664106A477111` FOREIGN KEY (`reglement_id`) REFERENCES `reglement` (`id`),
  CONSTRAINT `FK_FE866410A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_FE866410C1076F84` FOREIGN KEY (`consommation_id`) REFERENCES `consommation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facture`
--

LOCK TABLES `facture` WRITE;
/*!40000 ALTER TABLE `facture` DISABLE KEYS */;
/*!40000 ALTER TABLE `facture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habitant`
--

DROP TABLE IF EXISTS `habitant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habitant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `village` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9BADFD8B4E6C7FAA` (`village`),
  KEY `IDX_9BADFD8BA76ED395` (`user_id`),
  CONSTRAINT `FK_9BADFD8B4E6C7FAA` FOREIGN KEY (`village`) REFERENCES `village` (`id`),
  CONSTRAINT `FK_9BADFD8BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitant`
--

LOCK TABLES `habitant` WRITE;
/*!40000 ALTER TABLE `habitant` DISABLE KEYS */;
/*!40000 ALTER TABLE `habitant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reglement`
--

DROP TABLE IF EXISTS `reglement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reglement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `dateReglement` date NOT NULL,
  `montantReglement` int NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_EBE4C14CA76ED395` (`user_id`),
  CONSTRAINT `FK_EBE4C14CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reglement`
--

LOCK TABLES `reglement` WRITE;
/*!40000 ALTER TABLE `reglement` DISABLE KEYS */;
/*!40000 ALTER TABLE `reglement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Admin'),(2,'Gestionnaire Compteur'),(3,'Gestionnaire Commercial'),(4,'Gestionnaire Clientele');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` int DEFAULT NULL,
  `nom` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `extension` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8D93D64957698A6A` (`role`),
  CONSTRAINT `FK_8D93D64957698A6A` FOREIGN KEY (`role`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'Faye','Youssoupha','fayeyousso@gmail.com','$2y$10$UPg6sjO8YzVWR3VMDTVro.ZUboHc2yIfoqAc23lTQOd9AQH5tXO72',1,'jpeg'),(2,2,'Diop','Mamadou Isshaga','presi@gmail.com','$2y$10$zhGrB6qkUF3LkiQqs4RZLuLGPdNBzpvyk9QPYvC6ysEuI3jshhKhS',1,'jpeg'),(3,3,'Thiam','Mbourel Coumba','Mbourou@gmail.com','$2y$10$EJurrB58a1CwWnaXrMZBFueglTpa1XulPTIkOEFw0Su7f4ijT9d22',1,'jpeg'),(5,4,'Niang','Ibrahima','ibouniang@outlook.fr','$2y$10$ilfKZVZnmW7nySQKLHXBBOk0tSVnRl025cb9Q5pyOcNMaFhRP2L0e',1,'jpeg'),(6,2,'Thiam','mohamed','mothiam@gmail.com','$2y$10$FduZgfoVrtWS4tpkhuvsvO7MVEprxMTOyrIG7a7v0MSRKNIlRKAmO',1,'jpeg'),(7,3,'Assane','Anida','Anasa@gmail.com','$2y$10$hZAGlPVr/o0sREXet08kxOnJhMGlywk3DaopljYBCYmps6JXLSISC',1,'jpeg'),(8,3,'Kane','Maguette','makane@gmail.com','$2y$10$XsAfWmCuuqhWCxhzS5PCwuFm9BcLaN0C2vUe8zVaW1R.mtxDQnbri',1,'jpeg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `village`
--

DROP TABLE IF EXISTS `village`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `village` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `chefVillage` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4E6C7FAA7C4CF1CE` (`chefVillage`),
  KEY `IDX_4E6C7FAAA76ED395` (`user_id`),
  CONSTRAINT `FK_4E6C7FAA7C4CF1CE` FOREIGN KEY (`chefVillage`) REFERENCES `habitant` (`id`),
  CONSTRAINT `FK_4E6C7FAAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `village`
--

LOCK TABLES `village` WRITE;
/*!40000 ALTER TABLE `village` DISABLE KEYS */;
INSERT INTO `village` VALUES (1,5,'Guereo',1,NULL),(2,5,'Popenguine',1,NULL),(3,5,'Somone',1,NULL),(4,5,'Kignabour',1,NULL),(5,5,'Thiafra',1,NULL);
/*!40000 ALTER TABLE `village` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-09 10:58:41
