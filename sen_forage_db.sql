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
  `numero` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `habitant_id` int DEFAULT NULL,
  `attribution_id` int DEFAULT NULL,
  `dateAbo` date NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`numero`),
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
INSERT INTO `abonnement` VALUES ('AB22020001',5,1,NULL,'2022-02-19','nouvelle abonnement de thiam',1),('AB22020002',5,2,3,'2022-02-15','front de tete',1),('AB22020003',5,4,NULL,'2022-02-15','pop\'s',1),('AB22020004',5,3,NULL,'2022-02-15','',1);
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
  `numero_compteur` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_abonnement` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateAttribution` date NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C751ED49EC15DCB5` (`numero_compteur`),
  UNIQUE KEY `UNIQ_C751ED4955EFF518` (`numero_abonnement`),
  KEY `IDX_C751ED49A76ED395` (`user_id`),
  CONSTRAINT `FK_C751ED4955EFF518` FOREIGN KEY (`numero_abonnement`) REFERENCES `abonnement` (`numero`),
  CONSTRAINT `FK_C751ED49A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_C751ED49EC15DCB5` FOREIGN KEY (`numero_compteur`) REFERENCES `compteur` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attribution`
--

LOCK TABLES `attribution` WRITE;
/*!40000 ALTER TABLE `attribution` DISABLE KEYS */;
INSERT INTO `attribution` VALUES (1,'CO22020001','AB22020001','2022-02-15',2),(2,'CO22020002','AB22020003','2022-02-15',2),(3,'CO22020003','AB22020002','2022-02-15',2);
/*!40000 ALTER TABLE `attribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compteur`
--

DROP TABLE IF EXISTS `compteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compteur` (
  `numero` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `attribution_id` int DEFAULT NULL,
  `cumul` int NOT NULL,
  `lastCumul` int NOT NULL,
  `etat` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`numero`),
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
INSERT INTO `compteur` VALUES ('CO22020001',2,NULL,0,0,'Ouvert'),('CO22020002',2,NULL,0,0,'Ouvert'),('CO22020003',2,3,0,0,'Ouvert'),('CO22020004',2,NULL,0,0,'Ouvert'),('CO22020005',2,NULL,0,0,'Ouvert'),('CO22020006',2,NULL,0,0,'Ouvert'),('CO22020007',2,NULL,0,0,'Ouvert');
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
  `numero_compteur` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateConsommation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_F993F0A2A76ED395` (`user_id`),
  KEY `IDX_F993F0A2EC15DCB5` (`numero_compteur`),
  CONSTRAINT `FK_F993F0A2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F993F0A2EC15DCB5` FOREIGN KEY (`numero_compteur`) REFERENCES `compteur` (`numero`)
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
  `numero` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `consommation_id` int DEFAULT NULL,
  `montantFacture` int NOT NULL,
  `dateFacture` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `numero_reglement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`numero`),
  KEY `IDX_FE866410A76ED395` (`user_id`),
  KEY `IDX_FE866410C1076F84` (`consommation_id`),
  KEY `IDX_FE866410A6F7B7D3` (`numero_reglement`),
  CONSTRAINT `FK_FE866410A6F7B7D3` FOREIGN KEY (`numero_reglement`) REFERENCES `reglement` (`numero`),
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitant`
--

LOCK TABLES `habitant` WRITE;
/*!40000 ALTER TABLE `habitant` DISABLE KEYS */;
INSERT INTO `habitant` VALUES (1,3,5,'Mohamed Thiam','yeumbeul',772733300,1),(2,4,5,'beatrice','parcelle',775684999,1),(3,1,5,'ma ablaye ndour','Ndourenne',773568787,1),(4,2,5,'Ndiour','Pop\'s',774670984,1);
/*!40000 ALTER TABLE `habitant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `numero`
--

DROP TABLE IF EXISTS `numero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `numero` (
  `nom` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `periode` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `numero` int NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `numero`
--

LOCK TABLES `numero` WRITE;
/*!40000 ALTER TABLE `numero` DISABLE KEYS */;
INSERT INTO `numero` VALUES ('abo','2202',4),('com','2202',7),('fac','0',0);
/*!40000 ALTER TABLE `numero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reglement`
--

DROP TABLE IF EXISTS `reglement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reglement` (
  `numero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int DEFAULT NULL,
  `dateReglement` date NOT NULL,
  `montantReglement` int NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`numero`),
  KEY `IDX_EBE4C14C6B3CA4B` (`id_user`),
  CONSTRAINT `FK_EBE4C14C6B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
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
INSERT INTO `user` VALUES (1,1,'Faye','Youssoupha','fayeyousso@gmail.com','$2y$10$UPg6sjO8YzVWR3VMDTVro.ZUboHc2yIfoqAc23lTQOd9AQH5tXO72',1,'jpeg'),(2,2,'Diop','Mamadou Isshaga','presi@gmail.com','$2y$10$zhGrB6qkUF3LkiQqs4RZLuLGPdNBzpvyk9QPYvC6ysEuI3jshhKhS',1,'jpeg'),(3,3,'Thiam','Mbourou Coumba','Mbourou@gmail.com','$2y$10$EJurrB58a1CwWnaXrMZBFueglTpa1XulPTIkOEFw0Su7f4ijT9d22',1,'jpeg'),(5,4,'Niang','Ibrahima','ibouniang@outlook.fr','$2y$10$ilfKZVZnmW7nySQKLHXBBOk0tSVnRl025cb9Q5pyOcNMaFhRP2L0e',1,'jpeg'),(6,2,'Thiam','mohamed','mothiam@gmail.com','$2y$10$FduZgfoVrtWS4tpkhuvsvO7MVEprxMTOyrIG7a7v0MSRKNIlRKAmO',1,'jpeg'),(7,3,'Assane','Anida','Anasa@gmail.com','$2y$10$hZAGlPVr/o0sREXet08kxOnJhMGlywk3DaopljYBCYmps6JXLSISC',1,'jpeg'),(8,3,'Kane','Maguette','makane@gmail.com','$2y$10$XsAfWmCuuqhWCxhzS5PCwuFm9BcLaN0C2vUe8zVaW1R.mtxDQnbri',1,'jpeg');
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
INSERT INTO `village` VALUES (1,5,'Guereo',1,3),(2,5,'Popenguine',1,NULL),(3,5,'Somone',1,NULL),(4,5,'Kignabour',1,NULL),(5,5,'Thiafra',1,NULL);
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

-- Dump completed on 2022-02-16  7:45:46
