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
  `dateAbo` date NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `id_attribution` int DEFAULT NULL,
  PRIMARY KEY (`numero`),
  UNIQUE KEY `UNIQ_351268BBDF4320BE` (`id_attribution`),
  KEY `IDX_351268BBA76ED395` (`user_id`),
  KEY `IDX_351268BB8254716F` (`habitant_id`),
  CONSTRAINT `FK_351268BB8254716F` FOREIGN KEY (`habitant_id`) REFERENCES `habitant` (`id`),
  CONSTRAINT `FK_351268BBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_351268BBDF4320BE` FOREIGN KEY (`id_attribution`) REFERENCES `attribution` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonnement`
--

LOCK TABLES `abonnement` WRITE;
/*!40000 ALTER TABLE `abonnement` DISABLE KEYS */;
INSERT INTO `abonnement` VALUES ('AB22020003',2,10,'2022-02-16','ca c\'est l\'abonnement de tala sylla',1,2),('AB22020006',2,16,'2022-02-16','ca c\'est l\'abonnement de tala sylla',1,5),('AB22020009',2,34,'2022-02-16','abonnement n amsa',1,NULL),('AB22020012',2,38,'2022-02-16','abonnement n amsa',1,NULL),('AB22020013',2,38,'2022-02-16','abonnement n amsa',1,NULL),('AB22020014',2,42,'2022-02-16','abonnement n aramae ciss paye',1,4),('AB22020015',2,24,'2022-02-16','Orelle',1,3),('AB22020016',2,4,'2022-02-16','eukeu',1,6),('AB22020017',2,22,'2022-02-16','SS',1,NULL),('AB22020018',2,35,'2022-02-16','bizrre nomm',1,NULL),('AB22020019',2,1,'2022-02-16','le best',1,NULL),('AB22020020',2,9,'2022-02-16','connait pas',1,NULL),('AB22020021',2,31,'2022-02-16','plat',1,NULL),('AB22020022',2,28,'2022-02-16','sidi rama ansou abdou',1,NULL),('AB22020023',2,20,'2022-02-16','dip doundou guiss',1,NULL),('AB22020024',2,25,'2022-02-16','desire kabila',1,NULL),('AB22020025',2,29,'2022-02-16','PHP Artist',1,NULL),('AB22020026',2,26,'2022-02-16','Lait cahier',1,NULL),('AB22020027',2,33,'2022-02-16','kairozdormu',1,NULL);
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
  `user_id` int DEFAULT NULL,
  `dateAttribution` date NOT NULL,
  `numero_compteur` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_abonnement` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_C751ED49A76ED395` (`user_id`),
  KEY `IDX_C751ED49EC15DCB5` (`numero_compteur`),
  KEY `IDX_C751ED4955EFF518` (`numero_abonnement`),
  CONSTRAINT `FK_C751ED4955EFF518` FOREIGN KEY (`numero_abonnement`) REFERENCES `abonnement` (`numero`),
  CONSTRAINT `FK_C751ED49A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_C751ED49EC15DCB5` FOREIGN KEY (`numero_compteur`) REFERENCES `compteur` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attribution`
--

LOCK TABLES `attribution` WRITE;
/*!40000 ALTER TABLE `attribution` DISABLE KEYS */;
INSERT INTO `attribution` VALUES (1,3,'2022-02-16','CO22020001','AB22020003',0),(2,3,'2022-02-16','CO22020001','AB22020003',1),(3,3,'2022-02-16','CO22020003','AB22020015',1),(4,3,'2022-02-16','CO22020004','AB22020014',1),(5,3,'2022-02-16','CO22020002','AB22020006',1),(6,3,'2022-02-16','CO22020010','AB22020016',1);
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
  `lastCumul` int NOT NULL,
  `etat` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_attribution` int DEFAULT NULL,
  PRIMARY KEY (`numero`),
  UNIQUE KEY `UNIQ_4D021BD5DF4320BE` (`id_attribution`),
  KEY `IDX_4D021BD5A76ED395` (`user_id`),
  CONSTRAINT `FK_4D021BD5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_4D021BD5DF4320BE` FOREIGN KEY (`id_attribution`) REFERENCES `attribution` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compteur`
--

LOCK TABLES `compteur` WRITE;
/*!40000 ALTER TABLE `compteur` DISABLE KEYS */;
INSERT INTO `compteur` VALUES ('CO22020001',3,0,'deleted',2),('CO22020002',3,0,'Ouvert',5),('CO22020003',3,9000,'Ouvert',3),('CO22020004',3,0,'Ouvert',4),('CO22020005',3,0,'Ouvert',NULL),('CO22020006',3,0,'Ouvert',NULL),('CO22020007',3,0,'Ouvert',NULL),('CO22020008',3,0,'Ouvert',NULL),('CO22020009',3,0,'Ouvert',NULL),('CO22020010',3,0,'Ouvert',6),('CO22020011',3,0,'Ouvert',NULL),('CO22020012',3,0,'Ouvert',NULL),('CO22020013',3,0,'Ouvert',NULL),('CO22020014',3,0,'Ouvert',NULL),('CO22020015',3,0,'Ouvert',NULL),('CO22020016',3,0,'Ouvert',NULL),('CO22020017',3,0,'Ouvert',NULL),('CO22020018',3,0,'Ouvert',NULL);
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
  `periode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `cumul` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F993F0A2A76ED395` (`user_id`),
  KEY `IDX_F993F0A2EC15DCB5` (`numero_compteur`),
  CONSTRAINT `FK_F993F0A2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F993F0A2EC15DCB5` FOREIGN KEY (`numero_compteur`) REFERENCES `compteur` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consommation`
--

LOCK TABLES `consommation` WRITE;
/*!40000 ALTER TABLE `consommation` DISABLE KEYS */;
INSERT INTO `consommation` VALUES (1,NULL,'CO22020003','0222',9000,1,9000);
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
  `numero_reglement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `consommation_id` int DEFAULT NULL,
  `montantFacture` int NOT NULL,
  `dateFacture` date NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`numero`),
  UNIQUE KEY `UNIQ_FE866410C1076F84` (`consommation_id`),
  KEY `IDX_FE866410A6F7B7D3` (`numero_reglement`),
  KEY `IDX_FE866410A76ED395` (`user_id`),
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
INSERT INTO `facture` VALUES ('FA22020002',NULL,4,1,279000,'2022-02-16',1);
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
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_9BADFD8B4E6C7FAA` (`village`),
  KEY `IDX_9BADFD8BA76ED395` (`user_id`),
  CONSTRAINT `FK_9BADFD8B4E6C7FAA` FOREIGN KEY (`village`) REFERENCES `village` (`id`),
  CONSTRAINT `FK_9BADFD8BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitant`
--

LOCK TABLES `habitant` WRITE;
/*!40000 ALTER TABLE `habitant` DISABLE KEYS */;
INSERT INTO `habitant` VALUES (1,1,2,'Youssoupha Faye','Hlm grand medine',77777777,1),(2,1,2,'ma ablaye','ndourenne',77777777,1),(3,1,2,'ousmane','loene',77777777,1),(4,1,2,'mamadou lo','loene',77777777,1),(5,1,2,'Rokhaya','thialane',77777777,1),(6,2,2,'ousmane ciss','thialane',77777777,1),(7,2,2,'pa hibou','fadfag',77777777,1),(8,3,2,'aissatou sall','fadfag',77777777,1),(9,3,2,'mbaye seck','fadfag',77777777,1),(10,3,2,'talla sylla','fadfag',77777777,1),(11,3,2,'gadir','fadfag',77777777,1),(12,4,2,'prrout','fadfag',77777777,1),(13,4,2,'path path','fadfag',77777777,1),(14,4,2,'groeung','fadfag',77777777,1),(15,5,2,'anida assane','fadfag',77777777,1),(16,5,2,'fatimata','fadfag',77777777,1),(17,5,2,'elimane lo','fadfag',77777777,1),(18,5,2,'arame seck','fadfag',77777777,1),(19,5,2,'zinedine zidane','fadfag',77777777,1),(20,6,2,'koumoun','fadfag',77777777,1),(21,6,2,'kayor','fadfag',77777777,1),(22,6,2,'saliou','fadfag',77777777,1),(23,6,2,'aminata','fadfag',77777777,1),(24,6,2,'orelle','fadfag',77777777,1),(25,6,2,'kabil','fadfag',77777777,1),(26,7,2,'mewoun','quelque part',77777777,1),(27,7,2,'marietou seck','quelque part',77777777,1),(28,7,2,'Ansou seck','quelque part',77777777,1),(29,7,2,'Ngor','quelque part',77777777,1),(30,7,2,'Maman Ley','quelque part',77777777,1),(31,7,2,'kaldoum sy','quelque part',77777777,1),(32,7,2,'Salimata ba','quelque part',77777777,1),(33,8,2,'kairoz','quelque part',77777777,1),(34,8,2,'amsata','quelque part',77777777,1),(35,8,2,'kerina','quelque part',77777777,1),(36,8,2,'pa djilene','quelque part',77777777,1),(37,8,2,'patrice ','quelque part',77777777,1),(38,8,2,'Omar ka','quelque part',77777777,1),(39,8,2,'Seynabou fall','quelque part',77777777,1),(40,8,2,'ndeye seck','quelque part',77777777,1),(41,2,2,'mbirane fall','quelque part',77777777,1),(42,2,2,'Arame ciss','quelque part',77777777,1),(43,2,2,'Fanta sene','quelque part',77777777,1),(44,2,2,'Ndiour','quelque part',77777777,1);
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
INSERT INTO `numero` VALUES ('abo','2202',27),('com','2202',18),('fac','2202',2),('pri','na',31);
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
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `extension` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8D93D64957698A6A` (`role`),
  CONSTRAINT `FK_8D93D64957698A6A` FOREIGN KEY (`role`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'Faye','Youssoupha','fayeyousso@gmail.com','$2y$10$Z5ai6rR8VEuD195PCEObn.ohtVQB3Uk3709xsa.hHMUXSkvj4AAuC',1,'jpeg'),(2,4,'Niang','ibrahima','niang@g.com','$2y$10$33DkllMftfWt.ipkfFNpZO9WzWiwBRcUH4WkK4JBy/dPALPHSij0W',1,'jpeg'),(3,2,'Diop','isshaga','pyto@p.com','$2y$10$yRKGmmm1H/R2jyrb6br4cuQk7eNdpZbJB.8pXlKsO1tblElJYH3Um',1,'jpeg'),(4,3,'thiam','mohamed','babel@b.com','$2y$10$TKKMOwAcoXsEH3TaAobIm.dY5MwtZs7M6DuhCE/8tDTKuHriJvNcm',1,'jpeg');
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
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `chefVillage` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4E6C7FAA7C4CF1CE` (`chefVillage`),
  KEY `IDX_4E6C7FAAA76ED395` (`user_id`),
  CONSTRAINT `FK_4E6C7FAA7C4CF1CE` FOREIGN KEY (`chefVillage`) REFERENCES `habitant` (`id`),
  CONSTRAINT `FK_4E6C7FAAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `village`
--

LOCK TABLES `village` WRITE;
/*!40000 ALTER TABLE `village` DISABLE KEYS */;
INSERT INTO `village` VALUES (1,2,'Guereo',1,NULL),(2,2,'Popenguine',1,NULL),(3,2,'Somone',1,NULL),(4,2,'pout',1,NULL),(5,2,'keur youssou',1,NULL),(6,2,'thiafra',1,NULL),(7,2,'guinguineo',1,NULL),(8,2,'gnakourap',1,NULL);
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

-- Dump completed on 2022-02-20 12:52:44
