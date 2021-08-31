-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: localhost    Database: club
-- ------------------------------------------------------
-- Server version	8.0.25

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'Rotary Club Langata','2021-08-26 06:00:52','2021-08-26 06:00:52');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `affiliation_member`
--

DROP TABLE IF EXISTS `affiliation_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `affiliation_member` (
  `affiliation_id` bigint unsigned NOT NULL,
  `member_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`affiliation_id`,`member_id`),
  KEY `affiliation_member_affiliation_id_index` (`affiliation_id`),
  KEY `affiliation_member_member_id_index` (`member_id`),
  CONSTRAINT `affiliation_member_affiliation_id_foreign` FOREIGN KEY (`affiliation_id`) REFERENCES `affiliations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `affiliation_member_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affiliation_member`
--

LOCK TABLES `affiliation_member` WRITE;
/*!40000 ALTER TABLE `affiliation_member` DISABLE KEYS */;
INSERT INTO `affiliation_member` VALUES (1,2,NULL,NULL),(1,3,NULL,NULL),(1,4,NULL,NULL),(1,8,NULL,NULL),(1,9,NULL,NULL),(1,14,NULL,NULL),(1,20,NULL,NULL),(1,25,NULL,NULL),(1,32,NULL,NULL),(1,35,NULL,NULL),(1,39,NULL,NULL),(1,50,NULL,NULL),(1,53,NULL,NULL),(1,54,NULL,NULL),(1,56,NULL,NULL),(1,65,NULL,NULL),(1,67,NULL,NULL),(1,68,NULL,NULL),(1,73,NULL,NULL),(1,77,NULL,NULL),(1,80,NULL,NULL),(1,81,NULL,NULL),(1,86,NULL,NULL),(1,91,NULL,NULL),(1,94,NULL,NULL),(1,95,NULL,NULL),(1,97,NULL,NULL),(1,113,NULL,NULL),(1,117,NULL,NULL),(2,6,NULL,NULL),(2,10,NULL,NULL),(2,11,NULL,NULL),(2,12,NULL,NULL),(2,13,NULL,NULL),(2,16,NULL,NULL),(2,17,NULL,NULL),(2,18,NULL,NULL),(2,19,NULL,NULL),(2,21,NULL,NULL),(2,23,NULL,NULL),(2,24,NULL,NULL),(2,26,NULL,NULL),(2,28,NULL,NULL),(2,29,NULL,NULL),(2,33,NULL,NULL),(2,34,NULL,NULL),(2,37,NULL,NULL),(2,40,NULL,NULL),(2,43,NULL,NULL),(2,45,NULL,NULL),(2,46,NULL,NULL),(2,47,NULL,NULL),(2,48,NULL,NULL),(2,49,NULL,NULL),(2,51,NULL,NULL),(2,63,NULL,NULL),(2,70,NULL,NULL),(2,71,NULL,NULL),(2,72,NULL,NULL),(2,75,NULL,NULL),(2,76,NULL,NULL),(2,78,NULL,NULL),(2,85,NULL,NULL),(2,88,NULL,NULL),(2,90,NULL,NULL),(2,92,NULL,NULL),(2,93,NULL,NULL),(2,98,NULL,NULL),(2,100,NULL,NULL),(2,103,NULL,NULL),(2,104,NULL,NULL),(2,106,NULL,NULL),(2,108,NULL,NULL),(2,109,NULL,NULL),(2,111,NULL,NULL),(2,112,NULL,NULL),(2,118,NULL,NULL),(3,1,NULL,NULL),(3,5,NULL,NULL),(3,7,NULL,NULL),(3,15,NULL,NULL),(3,22,NULL,NULL),(3,27,NULL,NULL),(3,30,NULL,NULL),(3,31,NULL,NULL),(3,36,NULL,NULL),(3,38,NULL,NULL),(3,41,NULL,NULL),(3,42,NULL,NULL),(3,44,NULL,NULL),(3,52,NULL,NULL),(3,55,NULL,NULL),(3,57,NULL,NULL),(3,58,NULL,NULL),(3,59,NULL,NULL),(3,60,NULL,NULL),(3,61,NULL,NULL),(3,62,NULL,NULL),(3,64,NULL,NULL),(3,66,NULL,NULL),(3,69,NULL,NULL),(3,74,NULL,NULL),(3,79,NULL,NULL),(3,82,NULL,NULL),(3,83,NULL,NULL),(3,84,NULL,NULL),(3,87,NULL,NULL),(3,89,NULL,NULL),(3,96,NULL,NULL),(3,99,NULL,NULL),(3,101,NULL,NULL),(3,102,NULL,NULL),(3,105,NULL,NULL),(3,107,NULL,NULL),(3,110,NULL,NULL),(3,114,NULL,NULL),(3,115,NULL,NULL),(3,116,NULL,NULL),(3,119,NULL,NULL),(3,120,NULL,NULL);
/*!40000 ALTER TABLE `affiliation_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `affiliations`
--

DROP TABLE IF EXISTS `affiliations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `affiliations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `affiliations_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affiliations`
--

LOCK TABLES `affiliations` WRITE;
/*!40000 ALTER TABLE `affiliations` DISABLE KEYS */;
INSERT INTO `affiliations` VALUES (1,'Rotarian','Rotarian','2021-08-26 06:00:53','2021-08-26 06:00:53'),(2,'Rotaractor','Rotaractor','2021-08-26 06:00:53','2021-08-26 06:00:53'),(3,'Guest','Guest','2021-08-26 06:00:53','2021-08-26 06:00:53');
/*!40000 ALTER TABLE `affiliations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `organization_id` int DEFAULT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_account_id_index` (`account_id`),
  KEY `contacts_organization_id_index` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,1,35,'Jacquelyn','Brown','cielo15@example.net','1-800-571-6006','23532 Moore Falls','Kenyafurt','Kentucky','US','21533-0904','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(2,1,15,'Damaris','Maggio','lynch.leanne@example.net','800.824.1094','9768 Zander Streets','Barrettfort','California','US','16036-3429','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(3,1,61,'Stacey','Roberts','corbin.schaden@example.com','(866) 235-7134','10262 Waylon Knolls','Fritschland','Colorado','US','66980-5825','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(4,1,30,'Kailee','Little','candido.lowe@example.com','(800) 435-0839','84973 Ledner Mount','Jedidiahland','Wyoming','US','78505','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(5,1,80,'Amaya','Leannon','evangeline.herzog@example.net','(877) 897-3568','237 Ona Meadow','West Johannabury','South Carolina','US','26633','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(6,1,36,'Marta','Dare','witting.albertha@example.org','855-418-5609','785 Stroman Forge Suite 868','North Jermey','Hawaii','US','79680','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(7,1,11,'Aurore','O\'Reilly','lgutmann@example.org','800-964-5270','31618 Leuschke Mall Apt. 324','Jacksonburgh','South Dakota','US','83763-2242','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(8,1,37,'Idell','Bauch','bartholome16@example.org','(800) 497-9832','6455 Amelia Roads','Kundeberg','Florida','US','29749','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(9,1,84,'Barrett','Wintheiser','ujohnston@example.com','877-361-2862','685 Juana Stream Apt. 574','Hackettview','Montana','US','98351','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(10,1,100,'Monica','Bogan','skyla.purdy@example.com','(877) 568-6485','352 Williamson Neck Suite 034','Weissnatview','Hawaii','US','49932','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(11,1,49,'Davin','Boehm','sryan@example.net','866.295.3633','446 Cummerata Mall','Xzavierbury','West Virginia','US','90822-4314','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(12,1,71,'Eugene','Rau','jeremy.gorczany@example.com','(888) 480-0667','7731 Bernhard Mill','East Arnoldberg','South Carolina','US','92832-7993','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(13,1,9,'Kylee','Schultz','rudy.corkery@example.net','877.224.7418','17096 Hackett Springs','West Jeradhaven','Wyoming','US','80853-0033','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(14,1,17,'Randi','Marquardt','dorcas.langworth@example.org','855.337.8883','293 Mitchell Grove','South Toby','Nevada','US','70619-3559','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(15,1,22,'Susanna','Lebsack','hoyt27@example.com','877-316-3550','6503 Goldner Inlet Suite 249','New Sarina','Florida','US','03486','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(16,1,73,'Aracely','Cruickshank','wunsch.isabelle@example.org','866.555.0833','663 Hartmann Branch Apt. 322','Yazmintown','New Jersey','US','01406','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(17,1,51,'Piper','Wolf','dianna.medhurst@example.org','1-800-968-9821','4097 Quinten Stream Apt. 884','West Elainaville','Vermont','US','36420','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(18,1,54,'Deonte','Corwin','karelle80@example.com','(866) 582-5787','42253 Robin Bypass','Jacobsonmouth','Kansas','US','04216-2724','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(19,1,59,'Dimitri','Wisoky','danyka44@example.org','1-877-683-1961','77184 Zane Plains Suite 421','Port Urielhaven','New York','US','94042','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(20,1,44,'Duane','Olson','ryder.cummerata@example.com','1-877-739-1738','96263 Jolie Knoll Suite 250','Connellyburgh','New Hampshire','US','81776','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(21,1,7,'Anya','Daniel','gconsidine@example.net','1-866-708-2879','2403 Scot Fords Suite 998','Lake Marcelleland','Pennsylvania','US','72894','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(22,1,54,'Christine','Greenfelder','gwen27@example.com','866.473.4867','19021 Grant Greens Suite 529','New Emily','New Jersey','US','61654-0188','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(23,1,24,'Marjorie','Parker','connelly.francesco@example.net','(866) 831-0171','196 Ryann Ridges Apt. 029','Kingburgh','Delaware','US','77166-8798','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(24,1,33,'Jan','Medhurst','ejohnston@example.com','(855) 663-9508','2519 Cassin Glen','Beerchester','Nevada','US','43818-5240','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(25,1,100,'Shanny','Stanton','koreilly@example.com','(888) 503-9406','13980 Sam Street','Lake Shad','New Hampshire','US','80606','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(26,1,96,'Maye','Ernser','matt04@example.net','877.642.7894','4038 Kautzer Loop','McDermottville','Montana','US','90135-8237','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(27,1,3,'Margarita','Smith','fredrick.jast@example.net','1-888-712-3847','28723 Goyette Plaza Suite 587','East Deshawnbury','Florida','US','53044','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(28,1,98,'Erin','O\'Reilly','samara.schamberger@example.net','(877) 782-9082','46684 Elnora Ports','West Geovany','Hawaii','US','32025-6801','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(29,1,60,'Jacquelyn','Kautzer','kub.thad@example.com','1-855-616-5703','163 Gabriella Square','Stammton','Ohio','US','50532-2605','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(30,1,22,'Elena','Dibbert','saul.swaniawski@example.org','855.461.5412','521 Jerde Orchard Suite 750','South Justonport','New Hampshire','US','27782-6212','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(31,1,39,'Leanna','DuBuque','ycollins@example.org','1-866-390-4221','80050 Conroy Mission','Denesikfurt','Hawaii','US','59635','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(32,1,22,'Wilbert','Cruickshank','zena16@example.com','(866) 704-2588','562 Beahan Burgs Apt. 001','Lake Katlynland','Vermont','US','88149','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(33,1,66,'Tiffany','Ferry','joshua34@example.com','(855) 652-7961','569 Wiza Cliff Suite 068','North Viviennemouth','Louisiana','US','43538-6671','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(34,1,72,'Katrine','Gerlach','lupe04@example.org','1-866-252-5942','3568 Nicolette Plain Apt. 725','Alishafurt','Tennessee','US','09354','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(35,1,61,'Kattie','Hansen','bonnie.frami@example.org','(888) 331-1997','22467 Rohan Estate Suite 211','Sigmundborough','Minnesota','US','25128-3560','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(36,1,81,'Frederic','Denesik','kcruickshank@example.com','844.901.6428','112 Maxime Pass Apt. 551','South Jovanyberg','New Jersey','US','72628','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(37,1,22,'Cloyd','Walter','eldora33@example.com','877.834.3687','340 Aditya Forges Suite 946','Bernierburgh','Arizona','US','08961-0343','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(38,1,27,'Ray','Yost','will.ayana@example.net','(800) 417-7954','288 Beer Isle','Domenicahaven','Rhode Island','US','43935','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(39,1,89,'Edward','Treutel','ulices.ohara@example.org','(855) 345-9570','223 Schmeler Wells','East Nya','West Virginia','US','37942-8833','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(40,1,1,'Maci','Torphy','devante.kuhic@example.org','1-844-696-5838','4480 Sipes Stravenue Apt. 443','Alfbury','Pennsylvania','US','19947-4065','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(41,1,59,'Llewellyn','Wolff','brady.feeney@example.org','800.215.3748','11574 Haag Ferry','Connellyburgh','Kentucky','US','77039','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(42,1,78,'Kallie','Grant','rahul74@example.com','1-800-812-6797','4352 Halvorson Common Suite 056','East Bethany','Connecticut','US','58618','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(43,1,19,'Thaddeus','Friesen','annabel.roob@example.com','1-866-516-6035','39171 Robel Highway Suite 769','South Janie','Missouri','US','72351','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(44,1,49,'Misael','Emard','oconner.helen@example.com','(877) 507-5398','709 Considine Viaduct','Lake Olliemouth','Rhode Island','US','17882','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(45,1,22,'Hallie','Herman','demario.lowe@example.org','866-289-5672','749 Wiley Drives','Mattiestad','Oklahoma','US','64152-4417','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(46,1,79,'Bailey','Lubowitz','ansel.tromp@example.net','855.246.9258','620 Vivian Park Apt. 675','Jaleelview','Nebraska','US','58003-7913','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(47,1,44,'Fleta','Volkman','davis.hal@example.net','866.759.0402','260 Cronin Haven Suite 943','Jacklynside','Nevada','US','33910','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(48,1,32,'Zachary','Torphy','jameson45@example.net','844-838-3595','5590 Thiel Villages Apt. 159','Denesikside','Wisconsin','US','27651-8083','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(49,1,87,'Dana','Parisian','veum.dillon@example.com','(855) 918-8796','5772 Bertrand Common','Casperchester','Texas','US','55841','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(50,1,97,'Wendy','Berge','ghaag@example.org','888-474-3641','98544 Van Drive Suite 353','West Robin','Nebraska','US','16492','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(51,1,76,'Estevan','Hintz','kennedy.ledner@example.org','(855) 771-4463','6369 Denesik Manor Apt. 595','West Zellaland','North Dakota','US','41573-2549','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(52,1,14,'Evalyn','McGlynn','elinor.ruecker@example.org','800-241-6168','33207 Adonis Shores','Lake Rogerfurt','Florida','US','80729','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(53,1,54,'Zachary','Boyer','muller.taya@example.net','1-800-764-7780','3514 Reilly Shore Apt. 083','Jimmystad','Kentucky','US','87584','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(54,1,73,'Alexanne','Waelchi','tspinka@example.org','1-800-231-7613','20597 Amaya Roads','Nanniemouth','Rhode Island','US','19317','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(55,1,58,'Destiny','Powlowski','willy83@example.com','1-877-336-1143','999 Margret Forge Suite 870','Lavernside','North Carolina','US','63206','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(56,1,46,'Lonny','Hagenes','adriel.morar@example.net','1-888-681-6205','970 Paucek Turnpike','North Osborne','South Carolina','US','69369-9710','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(57,1,69,'Mina','Fisher','filomena76@example.net','(844) 739-8829','480 Giovanni Fords','Reynoldsstad','South Carolina','US','58819-4291','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(58,1,92,'Dayna','Dicki','bhansen@example.com','844.936.2482','1238 Maria Lake Suite 297','Blanchefurt','Maine','US','49912','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(59,1,30,'Dianna','Yost','tyreek.konopelski@example.com','877.202.3992','45955 Ankunding Rapid','North Dan','North Carolina','US','77850-2125','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(60,1,95,'Emily','Murphy','lcrist@example.com','1-877-442-6326','853 Zula Ramp','South Justusstad','Louisiana','US','03403-5985','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(61,1,55,'Mustafa','Schultz','kyra02@example.org','1-877-701-9500','40782 Schneider Brooks Apt. 064','Breitenbergside','North Dakota','US','97332-1523','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(62,1,66,'Dale','Russel','lexie86@example.net','800-491-0799','70539 Goldner Drive','Lake Genesisport','South Dakota','US','80506','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(63,1,78,'Elsa','Reichert','raphaelle88@example.net','877.883.6700','370 Sporer Summit','Maeberg','Nevada','US','33941-8695','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(64,1,13,'Wilfred','Cartwright','rgraham@example.org','1-888-984-9235','4786 Bennie Junctions Suite 456','Port Domingo','New York','US','14331','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(65,1,9,'Guiseppe','Shanahan','tomasa.orn@example.org','(877) 607-3853','776 Harvey Junction Apt. 478','Amyaport','Oklahoma','US','41393-1023','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(66,1,39,'Jed','Maggio','hoeger.mylene@example.net','866.841.5797','9824 Delaney Mill Suite 026','Alliefurt','Alaska','US','50830-2860','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(67,1,19,'Rocky','Schaefer','camylle99@example.net','888-945-3008','3513 Yundt Squares Apt. 330','Goodwinbury','New Jersey','US','52744-0519','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(68,1,15,'Abe','White','ubeer@example.net','855.366.6835','4248 Howell Islands Apt. 017','South Hailieborough','Maryland','US','36734-6434','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(69,1,73,'Agnes','Lehner','brionna.collier@example.com','(866) 925-2602','24678 Laron Hollow','Roselynhaven','Tennessee','US','86023','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(70,1,54,'Danny','Medhurst','wayne48@example.net','888.935.7865','508 Schinner Roads Suite 879','East Jaqueline','Maryland','US','27514-1836','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(71,1,59,'Jamarcus','Hudson','carolyn16@example.org','866-658-8257','6819 Cormier Station','Port Baron','California','US','28777','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(72,1,53,'Gaston','Mills','casimir.lynch@example.org','866-982-0453','51855 Auer Keys Apt. 757','Bodemouth','Nebraska','US','81882-4893','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(73,1,2,'Tyson','Hammes','ehowe@example.net','(800) 754-6985','432 Hoppe Valley','Malliechester','North Carolina','US','41008-7653','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(74,1,59,'Orpha','Marks','leif.boehm@example.net','1-877-350-0255','81679 Newell Road Apt. 658','Edaside','Alaska','US','68917','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(75,1,46,'Connor','Collier','ypouros@example.org','(888) 877-4891','44634 Feest Path Apt. 486','Bednarborough','Idaho','US','95076-4101','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(76,1,24,'Lucas','Fadel','meredith.jakubowski@example.com','877.379.4511','6119 Emie Cliffs Apt. 055','New Frederikmouth','Kansas','US','25164-2446','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(77,1,71,'Moshe','Boyer','abshire.gregorio@example.org','800.363.1010','1550 Jaden Path','Marcosside','Utah','US','32253','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(78,1,9,'Jordan','Bauch','fhoppe@example.org','(866) 676-6630','473 Doyle Summit','Lake Coby','Missouri','US','51706','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(79,1,89,'Sven','Stoltenberg','wiegand.lorenza@example.com','(866) 436-8922','775 Beth Highway','East Chadrick','Massachusetts','US','60829-4648','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(80,1,75,'Cathrine','Kozey','whermann@example.net','1-844-462-7022','6581 Abdul Park Apt. 406','South Eudora','Georgia','US','43383-6458','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(81,1,24,'Augustine','Reinger','ronny41@example.net','(844) 339-9287','5666 Skye Prairie','South Nicklausfort','Nevada','US','84855','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(82,1,7,'Samir','Lang','kbailey@example.net','888-407-9422','18177 Ruecker Way Suite 650','Merlberg','Arkansas','US','63251','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(83,1,14,'Jazlyn','Green','stella.maggio@example.org','1-866-768-8872','98359 Bernardo Mall Apt. 821','East Lorna','Wisconsin','US','52989','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(84,1,81,'Cale','Conroy','hill.ludie@example.org','877.745.3547','1728 Arvilla Plain Apt. 844','Larkinberg','North Dakota','US','90662','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(85,1,5,'Maverick','Lubowitz','berta.collins@example.org','800-895-8240','4394 Kemmer Junction Apt. 319','Kihntown','Alaska','US','44909','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(86,1,39,'Kaleigh','Monahan','toy.ed@example.org','888-697-7358','4850 McClure Spring Suite 108','Bernierhaven','New York','US','32672','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(87,1,26,'Jason','Thompson','sbosco@example.org','(877) 815-3607','48047 Cremin Trail Suite 570','West Jayde','Maine','US','52730','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(88,1,68,'Albin','Considine','ohackett@example.net','1-866-783-6445','45234 Hills Mission','New Melyssa','Arizona','US','13116','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(89,1,22,'Maxine','Zieme','hrosenbaum@example.org','1-800-235-2284','962 Larkin Fords','East Lura','Arizona','US','08832','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(90,1,97,'Antonietta','Frami','delta.spencer@example.org','844-466-6162','72343 Hill Curve Apt. 287','East Brant','Wyoming','US','88316','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(91,1,46,'Joy','Donnelly','humberto.gaylord@example.net','1-888-879-3144','7096 Mitchell Pass Apt. 149','Fritschview','Tennessee','US','01577','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(92,1,9,'Shayne','Altenwerth','elvie60@example.net','800-553-0034','7215 Tromp Place','Jadeton','Florida','US','03129-8326','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(93,1,79,'Alicia','Hudson','velma.kirlin@example.org','(800) 650-9850','68765 Adams Prairie','Helenaville','New York','US','62059-4460','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(94,1,22,'Laurie','Becker','mathias27@example.net','(844) 991-5106','91462 Reed Drives','Wittingland','Virginia','US','34254-1850','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(95,1,78,'Gilbert','Kunde','zachariah80@example.com','(888) 501-2235','48796 Heller Shores Suite 788','South Alifurt','Nebraska','US','56649','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(96,1,71,'Wilfrid','Roob','anderson.norris@example.com','855-909-4400','7434 Elsa Square','Terryville','West Virginia','US','02801-4259','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(97,1,37,'Nayeli','White','orin55@example.net','1-800-842-9765','3285 Russel Landing Suite 345','South Jonathon','West Virginia','US','20831-5882','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(98,1,8,'Darrin','Johns','agreenholt@example.com','1-866-906-7738','3929 Vandervort Canyon Apt. 708','Hesselchester','Rhode Island','US','08597','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(99,1,42,'Pascale','Grant','veum.anjali@example.com','1-877-723-6317','732 Murray Burg Apt. 232','Bobbyville','New Hampshire','US','77115-8831','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(100,1,18,'Jace','Pacocha','ullrich.river@example.com','800.325.2774','709 Elton Burg Suite 480','O\'Keefeview','Virginia','US','64706-2357','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `makeups`
--

DROP TABLE IF EXISTS `makeups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `makeups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `makeup_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `makeups`
--

LOCK TABLES `makeups` WRITE;
/*!40000 ALTER TABLE `makeups` DISABLE KEYS */;
INSERT INTO `makeups` VALUES (1,'eric.muga@gmail.com','Eric Muga',1,'2021-08-31','Tree Planing Karura',NULL,NULL,'2021-08-30 19:05:52','2021-08-30 19:05:52',NULL),(2,'eric.muga@gmail.com','Eric Muga',1,'2021-08-24','Tree Planing Karura2',NULL,NULL,'2021-08-30 19:09:36','2021-08-30 19:09:36',NULL);
/*!40000 ALTER TABLE `makeups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL,
  `start_time` datetime NOT NULL,
  `duration` int NOT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `meetings_uuid_unique` (`uuid`),
  UNIQUE KEY `meetings_meeting_id_unique` (`meeting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (1,'niUTAhd4S5apuF5Js7qrjQ==','78849359013','cqoMhDjPQrOemFG-orgX-g','OBU RAP ',3,'2020-09-20 03:00:00',765,'Africa/Nairobi','https://us04web.zoom.us/j/78849359013?pwd=ckN1QmdDYjVJVEJYUnVoNS9leGxSZz09','Zoom','2020-09-17 13:51:47','2021-08-29 18:51:33'),(2,'Qo8ONHNcRkmyTT+a1CxJZw==','73009889228','cqoMhDjPQrOemFG-orgX-g','Family catching up',2,'2020-05-28 18:15:00',15,'Africa/Nairobi','https://us04web.zoom.us/j/73009889228?pwd=VGRFVTVVUVh5MWVVTXNsWlZVd0kwUT09','Zoom','2020-05-28 14:36:39','2021-08-29 18:51:33'),(4,'jJc7QvrWTLKSmZCj5Dhgjg==','76388405870','cqoMhDjPQrOemFG-orgX-g','My Meeting',2,'2021-08-05 09:00:00',60,'Africa/Nairobi','https://us04web.zoom.us/j/76388405870?pwd=MkpqT0VEbnYydE8xZDFreUxUQU9FZz09','Zoom','2021-08-05 00:16:30','2021-08-29 18:51:34'),(5,'8EzYlDxeSU+H504K79BSnA==','72909158483','cqoMhDjPQrOemFG-orgX-g','Rotary Attendance App',2,'2021-08-05 13:15:00',30,'Africa/Nairobi','https://us04web.zoom.us/j/72909158483?pwd=MmM5WlNrVW52RWt6TWFoeCtnL0NpQT09','Zoom','2021-08-05 09:01:08','2021-08-29 18:51:34'),(6,'Ejyx0w1bTZyq81NaLS8gIg==','75740136976','cqoMhDjPQrOemFG-orgX-g','Eric Muga\'s Zoom Meeting',2,'2021-08-05 13:15:00',25,'Africa/Nairobi','https://us04web.zoom.us/j/75740136976?pwd=ckd3b2ZpcG1DMzJnQUlFMmRaeWd1dz09','Zoom','2021-08-05 08:59:27','2021-08-29 18:51:34'),(7,'VBXfriz2QBS2UhMfLs0GKA==','76639585747','cqoMhDjPQrOemFG-orgX-g','Rotary App Discussion',2,'2021-08-07 17:00:00',60,'Africa/Nairobi','https://us04web.zoom.us/j/76639585747?pwd=Y014Snk2WlY0bG1ieUJmMTV2UGduUT09','Zoom','2021-08-07 14:02:31','2021-08-29 18:51:35'),(10,'ShQ7n5xDSzy+rNTwMB8SYg==','71593176031','cqoMhDjPQrOemFG-orgX-g','Attendance App review',2,'2021-08-04 17:00:00',60,'Africa/Nairobi','https://us04web.zoom.us/j/71593176031?pwd=Mjl4clQ2RmtleUgzUUpGVFZySWxiZz09','Zoom','2021-08-04 06:46:07','2021-08-30 16:58:53'),(11,'RLMf7znuTNaPeg6Ca09HAQ==','78594309483','cqoMhDjPQrOemFG-orgX-g','Rotary App Meeting 3',2,'2021-08-08 16:00:00',60,'Africa/Nairobi','https://us04web.zoom.us/j/78594309483?pwd=TGViTThkNE1aZGN1Y1BMVjJVTFVDUT09','Zoom','2021-08-08 12:57:56','2021-08-30 16:58:56');
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_type`
--

DROP TABLE IF EXISTS `member_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_type` (
  `member_id` bigint unsigned NOT NULL,
  `type_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`member_id`,`type_id`),
  KEY `member_type_member_id_index` (`member_id`),
  KEY `member_type_type_id_index` (`type_id`),
  CONSTRAINT `member_type_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `member_type_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_type`
--

LOCK TABLES `member_type` WRITE;
/*!40000 ALTER TABLE `member_type` DISABLE KEYS */;
INSERT INTO `member_type` VALUES (1,2,NULL,NULL),(2,1,NULL,NULL),(3,2,NULL,NULL),(4,2,NULL,NULL),(5,1,NULL,NULL),(6,2,NULL,NULL),(7,1,NULL,NULL),(8,1,NULL,NULL),(9,2,NULL,NULL),(10,1,NULL,NULL),(11,2,NULL,NULL),(12,1,NULL,NULL),(13,1,NULL,NULL),(14,1,NULL,NULL),(15,2,NULL,NULL),(16,2,NULL,NULL),(17,2,NULL,NULL),(18,2,NULL,NULL),(19,2,NULL,NULL),(20,1,NULL,NULL),(21,2,NULL,NULL),(22,1,NULL,NULL),(23,1,NULL,NULL),(24,1,NULL,NULL),(25,1,NULL,NULL),(26,2,NULL,NULL),(27,1,NULL,NULL),(28,2,NULL,NULL),(29,1,NULL,NULL),(30,1,NULL,NULL),(31,1,NULL,NULL),(32,2,NULL,NULL),(33,1,NULL,NULL),(34,2,NULL,NULL),(35,2,NULL,NULL),(36,2,NULL,NULL),(37,1,NULL,NULL),(38,1,NULL,NULL),(39,1,NULL,NULL),(40,1,NULL,NULL),(41,2,NULL,NULL),(42,1,NULL,NULL),(43,2,NULL,NULL),(44,2,NULL,NULL),(45,2,NULL,NULL),(46,1,NULL,NULL),(47,1,NULL,NULL),(48,2,NULL,NULL),(49,1,NULL,NULL),(50,1,NULL,NULL),(51,2,NULL,NULL),(52,1,NULL,NULL),(53,1,NULL,NULL),(54,2,NULL,NULL),(55,1,NULL,NULL),(56,2,NULL,NULL),(57,2,NULL,NULL),(58,1,NULL,NULL),(59,2,NULL,NULL),(60,1,NULL,NULL),(61,1,NULL,NULL),(62,2,NULL,NULL),(63,2,NULL,NULL),(64,1,NULL,NULL),(65,2,NULL,NULL),(66,2,NULL,NULL),(67,2,NULL,NULL),(68,1,NULL,NULL),(69,1,NULL,NULL),(70,2,NULL,NULL),(71,2,NULL,NULL),(72,1,NULL,NULL),(73,1,NULL,NULL),(74,1,NULL,NULL),(75,1,NULL,NULL),(76,1,NULL,NULL),(77,1,NULL,NULL),(78,2,NULL,NULL),(79,2,NULL,NULL),(80,1,NULL,NULL),(81,2,NULL,NULL),(82,2,NULL,NULL),(83,1,NULL,NULL),(84,2,NULL,NULL),(85,1,NULL,NULL),(86,2,NULL,NULL),(87,1,NULL,NULL),(88,1,NULL,NULL),(89,1,NULL,NULL),(90,1,NULL,NULL),(91,1,NULL,NULL),(92,2,NULL,NULL),(93,2,NULL,NULL),(94,1,NULL,NULL),(95,2,NULL,NULL),(96,2,NULL,NULL),(97,1,NULL,NULL),(98,1,NULL,NULL),(99,2,NULL,NULL),(100,2,NULL,NULL),(101,2,NULL,NULL),(102,1,NULL,NULL),(103,2,NULL,NULL),(104,1,NULL,NULL),(105,2,NULL,NULL),(106,1,NULL,NULL),(107,1,NULL,NULL),(108,2,NULL,NULL),(109,1,NULL,NULL),(110,2,NULL,NULL),(111,1,NULL,NULL),(112,1,NULL,NULL),(113,1,NULL,NULL),(114,2,NULL,NULL),(115,1,NULL,NULL),(116,2,NULL,NULL),(117,2,NULL,NULL),(118,2,NULL,NULL),(119,1,NULL,NULL),(120,2,NULL,NULL);
/*!40000 ALTER TABLE `member_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affiliation_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_email_unique` (`email`),
  UNIQUE KEY `members_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Dorthy Bartell','nitzsche.holly@hotmail.com','+1.650.448.6791',3,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(2,'Cali Kuphal','baumbach.alexzander@deckow.net','+1-704-500-6904',1,1,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(3,'Keith Jast','cebert@walter.com','1-213-231-3285',1,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(4,'Janiya Rosenbaum','lwelch@hotmail.com','(251) 440-2293',1,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(5,'Arthur Kautzer','wlubowitz@russel.com','+1-310-358-3714',3,1,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(6,'Dr. Lazaro Towne DVM','filomena.cartwright@langworth.com','+1 (715) 207-9742',2,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(7,'Bill Predovic','spaucek@hotmail.com','+1-912-945-3359',3,1,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(8,'Neva Nienow III','frances09@rippin.com','984.572.6216',1,1,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(9,'Justice Funk','rfay@zieme.com','+1-260-416-1266',1,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(10,'Dr. Jaqueline Rowe','darwin29@price.net','(856) 442-7587',2,1,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(11,'Ian Mertz','bborer@yahoo.com','1-574-986-7232',2,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(12,'Dr. Antonio Greenfelder','kyler.bernhard@thiel.com','1-551-254-5052',2,1,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(13,'Amparo Crooks V','janie39@tillman.com','+16168523624',2,1,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(14,'Dr. Zelda D\'Amore','aaron09@hotmail.com','(707) 426-9067',1,1,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(15,'Magdalena Reichert','christiansen.robert@spencer.org','+1-586-641-8083',3,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(16,'Nedra Yundt','justen.hirthe@gmail.com','724.757.0168',2,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(17,'Alejandrin Bergnaum','blynch@yahoo.com','321.581.3422',2,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(18,'Mr. Vladimir Cremin DDS','bhackett@stroman.com','+1 (818) 788-3520',2,2,'2021-08-26 06:00:53','2021-08-26 06:00:53',0,NULL),(19,'Felipe Schaefer V','klocko.lloyd@hotmail.com','947.812.5250',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(20,'Prof. Jeff Altenwerth','danny21@nienow.com','(845) 389-5530',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(21,'Belle Crooks Sr.','kadin.mcdermott@hintz.net','(458) 227-0272',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(22,'Prof. Monte Strosin Sr.','gabriel.reichel@mann.biz','(424) 575-5385',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(23,'Lorna Hickle','abbey.gerhold@langosh.net','+15035499834',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(24,'Kobe Russel','kbartoletti@mann.com','+1-385-813-5826',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(25,'Kellen Cummerata I','austyn25@gmail.com','667-355-2772',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(26,'Miss Kathleen Bernhard','ella.kertzmann@smith.com','747.801.3045',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(27,'Dr. Janick Hyatt','roscoe.cartwright@gorczany.com','(585) 557-7264',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(28,'Jose Schoen','kyle18@friesen.biz','+1-214-415-8462',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(29,'Shyann Kemmer','adolph50@hotmail.com','551-637-7293',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(30,'Mr. Hailey Anderson V','orville67@pollich.info','878-406-7325',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(31,'Donato Jenkins','beatty.esperanza@hotmail.com','1-630-619-7670',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(32,'Kaylie Brakus','saufderhar@feest.net','+16369617909',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(33,'Charlie Fadel','turner11@gmail.com','(724) 674-6251',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(34,'Aubree Bernhard','rodolfo94@padberg.com','(458) 320-2279',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(35,'Lazaro Lind','johnson.marilyne@hotmail.com','(385) 793-9774',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(36,'Ms. Yasmin Vandervort V','nmayert@gleason.com','1-310-496-8332',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(37,'Ada Strosin','marisa.mckenzie@yahoo.com','+1 (505) 307-4424',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(38,'Prof. Pearlie Koch','rdibbert@hagenes.org','913-222-5467',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(39,'Alessia Schmitt II','esta27@yahoo.com','1-972-993-6103',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(40,'Mallie Kuhic IV','cleo.okon@yahoo.com','+17134383444',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(41,'Althea Ryan','vnader@hotmail.com','1-470-561-1644',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(42,'Cassandra Marquardt','lourdes73@yahoo.com','+14124066046',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(43,'Celia Luettgen','pasquale.considine@bernier.com','(458) 612-7015',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(44,'Mr. Lamont Rippin I','lillian14@boyle.info','+17342728372',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(45,'Dr. Sid Blanda V','shields.zachariah@hotmail.com','+13314433286',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(46,'Mrs. Clarissa Kessler','vincenza.bailey@corwin.com','+1 (574) 270-6502',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(47,'Marlen Quigley','dudley39@gmail.com','520.320.6962',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(48,'Adriel Moen PhD','lowe.sterling@dietrich.org','+1.603.829.1233',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(49,'Elroy Mosciski','vernie.homenick@prohaska.com','+1-239-221-8048',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(50,'Melvin Dietrich','alena.emard@gmail.com','(351) 331-6706',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(51,'Miracle Dach','lysanne43@yahoo.com','1-605-523-6800',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(52,'Vivianne Howell','matilde.zemlak@hotmail.com','+1 (989) 882-6716',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(53,'Anna Witting IV','shawn07@schowalter.com','(646) 621-7724',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(54,'Vernon Keeling','crystal13@bechtelar.com','+1 (850) 773-1836',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(55,'Prof. Keyshawn Langworth','baylee13@gulgowski.com','(478) 229-5753',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(56,'Natasha Wiza','guadalupe.haley@hand.net','832-795-7588',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(57,'Ms. Sabina Treutel MD','vbrakus@ebert.com','346-780-4811',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(58,'Emil Waters','weimann.agustin@windler.com','(267) 216-4789',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(59,'Emmalee Larkin','freeman.hettinger@hotmail.com','1-573-450-8202',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(60,'Hollis O\'Conner','barrows.cade@lakin.com','347-221-3201',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(61,'Avis Heller','larson.modesto@yahoo.com','(409) 684-3575',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(62,'Lauren Keebler II','reva.fay@hotmail.com','717-622-9044',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(63,'Henri Flatley','evan79@haley.com','443-806-8651',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(64,'Prof. Myles Upton','lura.blanda@yahoo.com','310.355.5973',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(65,'Josiane Rippin','daniel.lemuel@schumm.org','1-609-816-9196',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(66,'Palma Fadel','rashad07@gmail.com','(347) 275-2033',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(67,'Yoshiko Sauer','ohackett@murazik.com','341.632.0110',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(68,'Alberto Hills','kgusikowski@zieme.com','678.987.1714',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(69,'Mrs. Mariana Langworth V','jakubowski.maeve@hotmail.com','+1.205.651.6880',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(70,'Gerson Green','juliana78@hotmail.com','+1-347-563-6878',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(71,'Prof. Lula Will I','neva.hill@rohan.com','425.519.7975',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(72,'Brenden Grady','echristiansen@kertzmann.biz','+1-667-671-3494',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(73,'Ubaldo Roberts','colleen93@miller.com','+1.682.803.7488',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(74,'Prof. Conor Daugherty I','elliot49@hayes.com','+1-339-430-0808',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(75,'Wava Ankunding','frank22@koepp.org','828-742-6180',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(76,'Prof. Merlin Strosin Jr.','rowe.adeline@johns.com','+1 (847) 301-8522',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(77,'Douglas Wisozk','morar.kira@stroman.info','(951) 530-3827',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(78,'Rocio Morar DVM','tremaine.williamson@windler.com','308.787.4830',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(79,'Randi Corkery','gcronin@harber.com','+17702950350',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(80,'Rosalyn Ledner','delfina.huel@ratke.com','(972) 532-7316',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(81,'Laverne Cremin','gust64@jakubowski.com','1-912-980-8776',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(82,'Prof. Karianne Cummings','zita67@hill.net','940-864-5182',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(83,'Jacynthe Gutkowski','bogan.everett@gutmann.com','854-546-3535',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(84,'Amie Halvorson Sr.','davion70@hotmail.com','+1.414.878.9468',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(85,'Geraldine Gutkowski','vdurgan@kreiger.com','+1 (682) 481-9899',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(86,'Ms. Sallie Hahn I','sankunding@dickinson.biz','(551) 964-2351',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(87,'Vita Considine','amosciski@torp.info','1-434-652-7172',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(88,'Phoebe Connelly','lillie14@hotmail.com','+19514181732',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(89,'Marques Nikolaus MD','ntorp@dicki.com','1-930-375-9331',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(90,'Gus Powlowski','gibson.reva@hotmail.com','(534) 605-1708',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(91,'Maybell Monahan','mharber@yahoo.com','(503) 695-4232',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(92,'Prof. Kyle Doyle V','daisha31@hotmail.com','856-306-0339',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(93,'Mr. Randy Beer MD','lueilwitz.denis@hotmail.com','+1.252.916.3674',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(94,'Jorge Huels','kellie.king@hotmail.com','+16099906495',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(95,'Maia Emard','pgoodwin@yost.com','+1-951-394-2880',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(96,'Dolly Witting IV','kdicki@kutch.com','+19513431116',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(97,'Joseph Kreiger','odach@borer.com','+13322897435',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(98,'Josie Bosco','avery49@durgan.com','(854) 725-1209',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(99,'Dr. Abelardo Powlowski III','feil.kenna@hotmail.com','534-351-8753',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(100,'Miss Shaylee Reynolds','sadye25@yahoo.com','(351) 312-1641',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(101,'Elliott Reichert','eva.dibbert@hotmail.com','+1 (989) 524-1164',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(102,'Claire Powlowski MD','jerrell.cassin@hotmail.com','+1-986-215-2546',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(103,'Prof. Alfonso Roberts','oconner.robert@hotmail.com','+1-313-479-8694',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(104,'Mr. Joe Bahringer','fadel.effie@hotmail.com','+1 (916) 483-9811',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(105,'Allen Lowe','schuppe.hank@gmail.com','+1-931-280-1118',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(106,'Rafaela Kris','dicki.delaney@yahoo.com','(629) 641-3859',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(107,'Prof. Cordell Beier III','king.vernon@hotmail.com','463-781-7840',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(108,'Emma Denesik','tillman.herbert@gmail.com','(551) 209-3002',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(109,'Dr. Jeffrey Bartell DVM','rcronin@yahoo.com','838-439-6603',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(110,'Miss Jaclyn Spencer','melvin.mcclure@gmail.com','(678) 712-8668',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(111,'Terrance Ebert','crunolfsson@oconner.com','+1-760-822-8256',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(112,'Ms. Addison Jakubowski PhD','vwisoky@hodkiewicz.biz','+17546563722',2,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(113,'Anabelle Feest','princess.stark@labadie.info','1-314-791-7314',1,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(114,'Idella Labadie MD','cora72@welch.com','+1 (682) 397-3486',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(115,'Dr. Vince Hauck III','jamey81@green.net','(725) 692-9543',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(116,'Prof. Art Ferry','swaniawski.jonathon@feest.com','623.849.5680',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(117,'Olga Bode Sr.','larue.kuvalis@hotmail.com','+18504750742',1,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(118,'Alexandrine Macejkovic','walter.hill@gmail.com','+1 (360) 978-6557',2,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(119,'Dr. Litzy Lesch','hintz.kenton@hotmail.com','(256) 613-1721',3,1,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(120,'Heidi Tremblay','christiansen.abigail@gmail.com','+1-714-294-2028',3,2,'2021-08-26 06:00:54','2021-08-26 06:00:54',0,NULL),(121,'Eric Muga','eric.muga@gmail.com','0720816931',1,1,'2021-08-26 09:15:50','2021-08-26 09:15:50',1,NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2020_01_01_000001_create_password_resets_table',1),(2,'2020_01_01_000002_create_failed_jobs_table',1),(3,'2020_01_01_000003_create_accounts_table',1),(4,'2020_01_01_000004_create_users_table',1),(5,'2020_01_01_000005_create_organizations_table',1),(6,'2020_01_01_000006_create_contacts_table',1),(7,'2021_08_25_014800_create_members_table',1),(8,'2021_08_25_020432_create_types_table',1),(9,'2021_08_25_020451_create_affiliations_table',1),(10,'2021_08_25_020856_create_member_type_pivot_table',1),(11,'2021_08_25_020907_create_affiliation_member_pivot_table',1),(12,'2021_08_25_064644_add_active_to_members_table',1),(13,'2021_08_25_074711_add_soft_delete_to_members',1),(16,'2021_08_28_103942_create_setup_table',2),(22,'2021_08_29_074131_create_table_zoom_users',3),(23,'2021_08_29_123619_create_zoom_tokens_table',3),(31,'2021_08_29_164918_create_meetings_table',4),(37,'2021_08_30_204030_create_makeups_table',5),(38,'2021_08_31_062814_create_registrants_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organizations_account_id_index` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
INSERT INTO `organizations` VALUES (1,1,'Schimmel PLC','bettye74@huels.com','(877) 701-2510','134 Emory Station Suite 860','Port Sydney','Ohio','US','09083-4556','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(2,1,'Gutkowski-Kassulke','alexandrea99@kozey.biz','866.793.2550','1008 Ankunding Spur Suite 880','Rathchester','Illinois','US','26440-5342','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(3,1,'Barrows-Kozey','ugraham@connelly.biz','866-722-3736','62492 Zemlak Unions Apt. 304','Blazeberg','Massachusetts','US','02829-1811','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(4,1,'Simonis-Dare','payton48@steuber.com','800-703-0283','8526 Margarette Brooks Suite 172','West Johnathanmouth','Nevada','US','23726','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(5,1,'Howe, Torphy and Boyle','rodger72@schmidt.com','877.278.7821','6078 Bauch Crossing Suite 858','Libbyport','New York','US','02356-1587','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(6,1,'Sipes, Gottlieb and Murphy','zoey28@kirlin.com','(877) 948-0122','51921 Hayes Lodge Apt. 985','New Myafort','Arkansas','US','28832-0743','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(7,1,'Sawayn, Wintheiser and Considine','monroe.larson@friesen.net','1-866-881-9329','48634 Amos Crossing Apt. 743','Laceymouth','Wyoming','US','78604-1816','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(8,1,'Hyatt-Johnston','antone12@keeling.com','(844) 278-9623','4185 Vern Ports','Croninmouth','Missouri','US','30407-9342','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(9,1,'Kautzer, Deckow and Kohler','marguerite.powlowski@altenwerth.com','888.527.0919','28287 Dooley Dam Suite 108','Langoshbury','New Hampshire','US','73679','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(10,1,'Stehr Ltd','osteuber@tillman.com','844-371-9750','72813 Ethel Loaf','Sistermouth','Maine','US','07317','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(11,1,'Graham-Koss','monte23@pagac.info','(800) 622-6760','96216 Murazik Street Suite 186','Lake Alanistown','Wyoming','US','00995-9054','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(12,1,'Doyle PLC','colleen.williamson@gleason.com','855.849.9353','78968 Alana Glens Suite 989','South Mireyashire','Virginia','US','82912','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(13,1,'Baumbach, Carroll and Ziemann','libbie58@swift.net','1-800-997-5590','466 Otho Green Suite 767','West Brandy','Utah','US','01150','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(14,1,'Casper PLC','donavon75@white.com','(844) 534-7102','682 Denesik Plaza','Hirtheville','Illinois','US','66667-8784','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(15,1,'Halvorson-Lehner','xfeest@vonrueden.com','(888) 502-0997','8161 Bernhard Drive','North Eddiehaven','Wisconsin','US','36183-6867','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(16,1,'Shanahan-Halvorson','kyra60@schulist.com','(844) 207-5002','987 Gulgowski Passage','Port Fanny','North Dakota','US','94674','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(17,1,'Koelpin-Zieme','lesch.letha@schamberger.com','866.660.2919','7159 Reinger Circle','Dessiefort','Montana','US','25032-7002','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(18,1,'Stiedemann-Hansen','schulist.clara@zemlak.biz','844.748.3445','9018 Tromp Views Suite 160','Lake Armandborough','Pennsylvania','US','32961','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(19,1,'Hahn, Nader and Hane','haag.haylie@hane.com','(844) 414-9824','1262 Kuhic Cliff Suite 542','North Daija','Maryland','US','37048','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(20,1,'Weissnat, Fritsch and McLaughlin','svon@leuschke.com','1-888-348-2700','2875 Cummings Shoal Apt. 569','New Fanny','Georgia','US','38142','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(21,1,'Ledner, Prosacco and Heller','gerardo42@russel.com','866.690.9809','39235 Beau Row','Lake Craig','North Carolina','US','54521-1207','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(22,1,'Herzog Group','emohr@feil.info','1-866-843-0083','1534 Borer Harbor Suite 507','Lake Payton','Arkansas','US','82157-7002','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(23,1,'Hammes-Stoltenberg','randi.block@hessel.com','1-844-540-2809','8065 Glenda Station Suite 960','Keltonstad','Washington','US','31954-1761','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(24,1,'Buckridge PLC','meagan.mertz@daugherty.com','(855) 544-7326','52642 Tyrell Mountains','Gracieview','Idaho','US','01521','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(25,1,'Dicki, Wuckert and Leffler','buddy06@heller.com','1-866-775-9865','56944 Schmeler Burg','Port Laurynburgh','Utah','US','32648-2240','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(26,1,'Jones-Homenick','tremblay.ernest@huels.com','(844) 944-5283','2820 Lonzo Camp Suite 486','West Sandyside','Washington','US','35700-1979','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(27,1,'Towne-Connelly','vhand@cummerata.biz','1-844-255-8581','44413 Quigley Brooks Apt. 486','Port Jeffry','Wyoming','US','88363-3871','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(28,1,'Kub, Reichert and Gerlach','ledner.bertrand@raynor.net','1-888-859-9072','460 Nasir Heights Suite 757','Robbview','Mississippi','US','20953','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(29,1,'Walter, Hyatt and Wehner','uolson@block.biz','(844) 435-3479','872 Osinski Villages Apt. 224','Emmetton','Illinois','US','25647','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(30,1,'Kris Inc','hills.norris@dickens.org','1-866-753-2960','30453 Padberg Manor Suite 173','Wildermanville','Maryland','US','66710-4632','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(31,1,'Swaniawski-Hoppe','lhuel@hickle.net','888-904-6383','7667 Renee Crest Apt. 772','Rodriguezshire','Mississippi','US','56444-2300','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(32,1,'O\'Kon Ltd','runolfsson.idella@ward.com','(855) 914-6823','770 Lyda Crescent Suite 157','Armanitown','Oregon','US','87025','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(33,1,'Smitham, Kessler and Mueller','kuhn.bridie@stokes.org','1-855-755-5713','514 Barney Divide Suite 672','Lindgrenland','Nebraska','US','85825-4099','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(34,1,'Dooley-Herman','chadd.stokes@donnelly.biz','844-563-1086','488 Nils Park','Adalbertostad','South Carolina','US','89973-1022','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(35,1,'Emmerich Inc','larson.gwen@farrell.net','866-584-1331','259 Dickens Village Apt. 533','Lake Zetta','Iowa','US','86917','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(36,1,'Moore-Halvorson','carmela86@botsford.com','(866) 966-7862','95260 Niko Grove Apt. 442','South Javon','New York','US','23439-7517','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(37,1,'Ruecker Ltd','mosciski.meaghan@abernathy.com','866.541.3716','435 Jaydon Ville Suite 935','Tarynburgh','Illinois','US','58257','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(38,1,'Rosenbaum-Glover','kirlin.reginald@koss.com','1-800-268-3698','1535 Lockman Bridge','North Macie','Hawaii','US','35534','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(39,1,'Wyman-Bechtelar','lfritsch@hessel.info','844.560.5921','605 Carlo Forks','Boyleshire','Delaware','US','75840-4695','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(40,1,'Roob, Renner and Hartmann','ernestine82@predovic.org','1-888-453-6656','78611 Bednar Hill Apt. 955','Lake Jess','Utah','US','57633','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(41,1,'Mayer-Paucek','crystel35@lemke.com','877-937-8463','13691 Lottie Route','North Maximilianton','Colorado','US','81295-5228','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(42,1,'Volkman Inc','zion95@crona.info','800-303-1193','6993 Predovic Isle Suite 071','Maryseland','Alaska','US','85336-5571','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(43,1,'O\'Hara-Murphy','glenna.marquardt@hamill.com','(866) 444-3367','53242 Burnice Rapids Apt. 178','Gregoriaville','Vermont','US','86957-5819','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(44,1,'Lang, Kuphal and Parker','rachael47@doyle.net','(844) 490-9196','6378 Jude Vista Suite 735','Port Reedville','Pennsylvania','US','10648-5564','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(45,1,'Lockman-Reynolds','narciso44@kreiger.com','1-855-286-8844','86704 Emard Expressway Apt. 721','Murraychester','Tennessee','US','85799-9078','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(46,1,'Monahan, Maggio and Fahey','meda.brekke@ledner.com','1-866-385-7421','703 King Row Apt. 875','Jasminstad','Colorado','US','22497-8189','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(47,1,'Shields, Collier and Johnson','marvin.alberta@tremblay.com','800-559-0412','483 McGlynn Vista','North Leannfort','Kansas','US','21993','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(48,1,'Frami-Kuhic','corkery.elmer@schultz.com','(866) 601-9677','6469 Donnelly Cliff','Rathmouth','Delaware','US','71948-2330','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(49,1,'Reilly, Stark and Price','lueilwitz.delia@bailey.com','(855) 965-1403','14314 Pamela Burgs Apt. 376','Wunschfort','Alaska','US','40217-7639','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(50,1,'Predovic and Sons','lorenzo.moore@kuhic.net','(866) 763-5683','32140 Turcotte Loop','Lake Jarretbury','North Dakota','US','98762-8565','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(51,1,'Flatley-Jaskolski','dangelo.rodriguez@lubowitz.com','1-877-286-7298','36175 Omer Glen Apt. 293','East Lillaberg','Wisconsin','US','84513','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(52,1,'Rowe-Pouros','oreilly.lourdes@rowe.org','855.303.4805','318 Fritsch Crossroad Suite 178','Alfborough','Indiana','US','48806','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(53,1,'Davis, Parker and Spencer','rachel97@schamberger.com','(877) 600-6578','448 Russel Flat Apt. 473','Port Zelma','Indiana','US','86214-6448','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(54,1,'Kutch, Dare and Mann','davion12@mohr.com','844.324.5539','9075 Smith Motorway','South Torrey','Wisconsin','US','27959-4323','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(55,1,'Schinner LLC','rowe.philip@kulas.com','1-855-337-5076','4129 Gregoria Turnpike Apt. 792','South Brandonborough','Pennsylvania','US','06063-0076','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(56,1,'Kiehn, Senger and Windler','adrienne.sporer@klein.com','844-739-5603','52383 Franecki Lights Suite 761','Patrickport','Pennsylvania','US','17633','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(57,1,'Hickle Group','xander93@leuschke.com','855.340.6465','743 Hagenes Curve Suite 959','Lulaville','Nevada','US','64107','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(58,1,'O\'Connell, Wilkinson and West','jmurray@nader.com','1-844-644-7528','6086 Predovic Lakes','West Kenyatta','Utah','US','90590-0129','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(59,1,'Goldner-Metz','schumm.josefa@beer.com','855.846.5791','85407 Selina Orchard Apt. 271','South Dayanachester','Vermont','US','29245-2016','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(60,1,'Kreiger Group','oparker@strosin.com','(866) 317-7408','16718 Yost Avenue','Lake Jerometown','West Virginia','US','95889-8449','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(61,1,'Wyman-Schulist','bridie60@batz.com','877.781.4189','106 Schneider Station','Gretaport','Maryland','US','37044-4228','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(62,1,'Lind LLC','hansen.newton@hyatt.org','(877) 724-3638','269 Collin Summit','Rolfsonborough','Delaware','US','59934','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(63,1,'Kerluke, Thiel and Littel','vauer@berge.com','855-218-6610','9623 Runte Locks Suite 082','West Samara','Colorado','US','27981','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(64,1,'Roob, Effertz and Wehner','funk.conor@morar.org','1-877-486-8833','99402 Colby Center Suite 014','Christopherport','Illinois','US','97105','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(65,1,'Runolfsson-Hermann','inicolas@cruickshank.com','866.526.6120','8177 Pacocha Spur','New Zariamouth','Iowa','US','81964-9740','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(66,1,'Stark, Moore and Shanahan','lizzie.keeling@gibson.com','877.630.7286','58581 Gilberto Mountains','Hicklefort','Rhode Island','US','82754','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(67,1,'Strosin-Funk','felipe54@robel.com','(844) 834-3722','73453 Welch Plains','South Akeem','Idaho','US','58492-4378','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(68,1,'Koch Group','elyse79@littel.biz','800-964-1649','83131 Madalyn Plains','Port Maybellport','Utah','US','14720-5339','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(69,1,'Hoppe-Beatty','bethany13@kutch.org','866-567-6592','3031 Yvette Extensions Suite 292','New Justinemouth','Rhode Island','US','99200-1279','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(70,1,'Rippin, Strosin and Ernser','yrussel@torphy.com','855-548-8271','78507 Adolf Pass Apt. 412','East Jessyville','Vermont','US','26821-7504','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(71,1,'Jacobs Inc','breitenberg.keira@kohler.com','1-800-539-2347','253 Mandy Plain','Aufderharchester','Nebraska','US','40882','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(72,1,'Cronin, Russel and Fadel','krajcik.barrett@kuphal.com','888.874.4209','5122 Telly Mall Apt. 194','New Pat','Maryland','US','53056-1916','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(73,1,'McLaughlin and Sons','brittany08@emard.org','844.208.6146','4855 Funk Camp Suite 604','North Roscoe','Maryland','US','96896-2758','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(74,1,'Hayes-Christiansen','abrakus@medhurst.com','1-844-822-4382','38680 Donnie Plains Suite 769','Hillchester','Oregon','US','72028-8658','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(75,1,'Steuber and Sons','mac.koss@abernathy.biz','866.337.3047','4622 Lebsack Passage Apt. 404','Sengerburgh','Georgia','US','25120-0111','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(76,1,'Kunze, Abshire and Wilkinson','howe.elaina@kuhn.com','(855) 670-0733','572 Peyton Oval Apt. 991','Naderchester','Nevada','US','68632','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(77,1,'Gislason-Lindgren','jschamberger@goldner.com','877-848-7871','62172 Tillman Underpass Suite 584','North Jordi','Vermont','US','25896','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(78,1,'Kshlerin-Moen','ufeil@jacobson.info','800-407-4622','94839 Nolan Via Apt. 611','North Carolinashire','Rhode Island','US','76836-1014','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(79,1,'Reynolds PLC','bergnaum.maida@stroman.com','(866) 860-0932','772 Jaylan Junction','Darianaland','Maine','US','64751','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(80,1,'Labadie and Sons','yhamill@lueilwitz.com','888-557-2828','66819 Harris Via','North Robb','Maryland','US','56308','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(81,1,'Hickle, Lindgren and Senger','kemmer.nadia@bogisich.org','1-877-393-4857','39306 Lakin Passage','New Marianneport','South Dakota','US','22551','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(82,1,'Stroman, Romaguera and Altenwerth','ibrahim53@gerhold.com','(866) 262-4585','8328 Leffler Unions','Considinebury','Louisiana','US','09532','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(83,1,'Nicolas-Buckridge','josephine72@monahan.biz','1-844-420-1209','5708 Eduardo Drive Apt. 568','Roweberg','Pennsylvania','US','25722-4703','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(84,1,'Waelchi-Farrell','xkerluke@quitzon.org','(866) 218-0043','249 Naomi Harbor Suite 001','West Jordane','Indiana','US','63437-8520','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(85,1,'Jakubowski LLC','caroline.tillman@cronin.com','866.512.5120','2791 Deon Cliffs','Bergnaummouth','Montana','US','39211','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(86,1,'Hickle, Powlowski and Funk','reyes.hill@ziemann.com','(888) 454-8633','48466 Noemie Manor Apt. 055','Hagenesborough','South Carolina','US','23279-2867','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(87,1,'Roberts-Hansen','windler.virginia@little.biz','1-866-447-6771','550 Nader Wall','New Owenport','New Hampshire','US','18130-9604','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(88,1,'Kihn Group','ookeefe@donnelly.com','888.746.4547','2615 Hansen Locks','Lake Germaine','Alaska','US','03693-4210','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(89,1,'Gislason, Grimes and Koelpin','sammy.parisian@metz.org','(844) 390-5661','984 Retha Roads Apt. 471','Tituschester','Tennessee','US','66388-5704','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(90,1,'Anderson-Herman','armstrong.jadon@spencer.com','855.420.2471','1940 Naomie Isle','Schadenshire','New Mexico','US','30886-1943','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(91,1,'Abbott-Kiehn','xullrich@harvey.com','1-844-658-0580','687 Rowe Harbor Suite 942','West Jaylonbury','Georgia','US','46335','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(92,1,'Graham Ltd','towne.madie@upton.com','(800) 872-9744','146 Gerlach River Apt. 560','New Genesischester','Oklahoma','US','89421','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(93,1,'Schuster-Abshire','toy88@bailey.net','844-962-0985','9041 Witting Burgs','Port Cade','Washington','US','02445-2479','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(94,1,'Lowe, Barrows and Satterfield','barbara49@ryan.org','888-707-0481','115 Reichert Point Apt. 827','Mikaylafort','Mississippi','US','38557-4931','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(95,1,'Cronin, Weissnat and Stoltenberg','verdie.stoltenberg@mclaughlin.info','800-313-2864','5362 Danielle Turnpike','South Bradenport','District of Columbia','CA','12485','2021-08-26 06:00:53','2021-08-26 18:47:38',NULL),(96,1,'Bednar-Schneider','russel.koelpin@bednar.com','844.323.9279','1152 Ida Plains Suite 668','Muellerfort','Idaho','US','86068-4059','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(97,1,'Champlin Inc','fjones@larkin.info','855-745-8880','4179 Letha Route Suite 851','Harveyborough','Connecticut','US','62925','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(98,1,'Douglas Group','kuphal.nels@krajcik.biz','866.488.5516','783 Grimes Brook','West Serenity','North Dakota','US','24356-6157','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(99,1,'Gusikowski, Kuhic and Gutmann','clifford.robel@casper.com','800-820-1167','534 Mann Way Apt. 277','Port Rorybury','Nebraska','US','73972','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(100,1,'Nader, Bauch and McClure','odooley@moore.com','800.947.8794','146 Jones Passage Suite 369','Ortizborough','Missouri','US','64171-5935','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL);
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrants`
--

DROP TABLE IF EXISTS `registrants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meeting_id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `club_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invited_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registrants_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrants`
--

LOCK TABLES `registrants` WRITE;
/*!40000 ALTER TABLE `registrants` DISABLE KEYS */;
/*!40000 ALTER TABLE `registrants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup`
--

DROP TABLE IF EXISTS `setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setup` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `callback_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `environment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup`
--

LOCK TABLES `setup` WRITE;
/*!40000 ALTER TABLE `setup` DISABLE KEYS */;
INSERT INTO `setup` VALUES (1,'88qbzpueTkGI66J9dKWd1g','3ZNpHxlheBOPr1NpqWB8fFTLX4BasWwM','https://localhost/show','local',1,'2021-08-28 08:17:58','2021-08-29 09:46:09'),(2,'88qbzpueTkGI66J9dKWd1g','3ZNpHxlheBOPr1NpqWB8fFTLX4BasWwM','https://localhost/show','production',0,'2021-08-28 08:17:58','2021-08-28 08:17:58');
/*!40000 ALTER TABLE `setup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `types_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Member','Full Member','2021-08-26 06:00:53','2021-08-26 06:00:53'),(2,'Inductee','On induction for 12 meetings','2021-08-26 06:00:53','2021-08-26 06:00:53');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` tinyint(1) NOT NULL DEFAULT '0',
  `photo_path` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_account_id_index` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'John','Doe','johndoe@example.com','2021-08-26 06:00:52','$2y$10$Cvd9gVnXLwhLBSXaftgPbuFq4An7lVpzMCaiqOgxaaMRng21YLzMa',1,NULL,'rQWdiSPrJyTQL0IrumNvepN2bJMZxY3YhEwd3tIDufbBkTnKK3iCSCpUj4np','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(2,1,'Idell','Anderson','djohnston@example.net','2021-08-26 06:00:53','$2y$10$f.yVHAYebIycdZo916VJN.oHV6zaijkMQGAFSDe5IqCdoIrd87WSu',1,NULL,'9G7ZYhiwgk','2021-08-26 06:00:53','2021-08-29 00:04:09',NULL),(3,1,'Darrion','Hahn','christy92@example.org','2021-08-26 06:00:53','$2y$10$Z8iWB5S0vsreK.UfLYLPn.JrWfwQznFZ9VOZLQE.0D2ZnTmKbkiLC',0,NULL,'5oJiAwPr9P','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(4,1,'Mustafa','Von','alexandre49@example.org','2021-08-26 06:00:53','$2y$10$zesOABtTUjaW8JjdpsbQz.11OmKl6zF9tUAyydRcLDwzYsjr4OOQG',0,NULL,'I5BgCCuxYZ','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(5,1,'Madelynn','Satterfield','griffin67@example.org','2021-08-26 06:00:53','$2y$10$na.sEZ.fPkZc8wSHKJIaTuo6yT/ccDdjYVRQPfo3EtzBJGVRhYqJa',0,NULL,'uHhV7PKun4','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL),(6,1,'Giovanni','Ledner','ritchie.melody@example.net','2021-08-26 06:00:53','$2y$10$.72DFvVthVGjG0IgJpFQs.Dbhg5oZYlTlOYaYIkntlXIbR6yeKyqO',0,NULL,'izBYJm8QLi','2021-08-26 06:00:53','2021-08-26 06:00:53',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zoom_tokens`
--

DROP TABLE IF EXISTS `zoom_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zoom_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zoom_tokens`
--

LOCK TABLES `zoom_tokens` WRITE;
/*!40000 ALTER TABLE `zoom_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `zoom_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zoom_users`
--

DROP TABLE IF EXISTS `zoom_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zoom_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int DEFAULT NULL,
  `pmi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dept` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `zoom_users_user_id_unique` (`user_id`),
  UNIQUE KEY `zoom_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zoom_users`
--

LOCK TABLES `zoom_users` WRITE;
/*!40000 ALTER TABLE `zoom_users` DISABLE KEYS */;
INSERT INTO `zoom_users` VALUES (1,'cqoMhDjPQrOemFG-orgX-g','Eric','Muga','eric.muga@gmail.com',1,'5613091720','','2021-08-29 17:29:30','','active','0','2020-05-05 10:08:18','2021-08-29 19:17:14');
/*!40000 ALTER TABLE `zoom_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-31 15:07:58
