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
INSERT INTO `accounts` VALUES (1,'Rotary Club Langata','2021-09-08 11:00:33','2021-09-08 11:00:33');
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
INSERT INTO `affiliation_member` VALUES (1,1,NULL,NULL),(1,3,NULL,NULL),(1,5,NULL,NULL),(1,6,NULL,NULL),(1,7,NULL,NULL),(1,9,NULL,NULL),(1,10,NULL,NULL),(1,13,NULL,NULL),(1,22,NULL,NULL),(1,24,NULL,NULL),(1,25,NULL,NULL),(1,28,NULL,NULL),(1,32,NULL,NULL),(1,33,NULL,NULL),(1,35,NULL,NULL),(1,41,NULL,NULL),(1,42,NULL,NULL),(1,45,NULL,NULL),(1,49,NULL,NULL),(1,58,NULL,NULL),(1,65,NULL,NULL),(1,69,NULL,NULL),(1,71,NULL,NULL),(1,72,NULL,NULL),(1,74,NULL,NULL),(1,80,NULL,NULL),(1,85,NULL,NULL),(1,91,NULL,NULL),(1,92,NULL,NULL),(1,93,NULL,NULL),(1,94,NULL,NULL),(1,97,NULL,NULL),(1,105,NULL,NULL),(1,106,NULL,NULL),(1,107,NULL,NULL),(1,108,NULL,NULL),(1,109,NULL,NULL),(1,111,NULL,NULL),(1,112,NULL,NULL),(1,118,NULL,NULL),(2,2,NULL,NULL),(2,4,NULL,NULL),(2,11,NULL,NULL),(2,17,NULL,NULL),(2,19,NULL,NULL),(2,21,NULL,NULL),(2,23,NULL,NULL),(2,27,NULL,NULL),(2,29,NULL,NULL),(2,30,NULL,NULL),(2,36,NULL,NULL),(2,39,NULL,NULL),(2,44,NULL,NULL),(2,47,NULL,NULL),(2,48,NULL,NULL),(2,51,NULL,NULL),(2,54,NULL,NULL),(2,55,NULL,NULL),(2,59,NULL,NULL),(2,61,NULL,NULL),(2,62,NULL,NULL),(2,63,NULL,NULL),(2,64,NULL,NULL),(2,67,NULL,NULL),(2,77,NULL,NULL),(2,78,NULL,NULL),(2,82,NULL,NULL),(2,84,NULL,NULL),(2,87,NULL,NULL),(2,95,NULL,NULL),(2,98,NULL,NULL),(2,100,NULL,NULL),(2,104,NULL,NULL),(2,113,NULL,NULL),(2,114,NULL,NULL),(2,116,NULL,NULL),(2,117,NULL,NULL),(3,8,NULL,NULL),(3,12,NULL,NULL),(3,14,NULL,NULL),(3,15,NULL,NULL),(3,16,NULL,NULL),(3,18,NULL,NULL),(3,20,NULL,NULL),(3,26,NULL,NULL),(3,31,NULL,NULL),(3,34,NULL,NULL),(3,37,NULL,NULL),(3,38,NULL,NULL),(3,40,NULL,NULL),(3,43,NULL,NULL),(3,46,NULL,NULL),(3,50,NULL,NULL),(3,52,NULL,NULL),(3,53,NULL,NULL),(3,56,NULL,NULL),(3,57,NULL,NULL),(3,60,NULL,NULL),(3,66,NULL,NULL),(3,68,NULL,NULL),(3,70,NULL,NULL),(3,73,NULL,NULL),(3,75,NULL,NULL),(3,76,NULL,NULL),(3,79,NULL,NULL),(3,81,NULL,NULL),(3,83,NULL,NULL),(3,86,NULL,NULL),(3,88,NULL,NULL),(3,89,NULL,NULL),(3,90,NULL,NULL),(3,96,NULL,NULL),(3,99,NULL,NULL),(3,101,NULL,NULL),(3,102,NULL,NULL),(3,103,NULL,NULL),(3,110,NULL,NULL),(3,115,NULL,NULL),(3,119,NULL,NULL),(3,120,NULL,NULL);
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
INSERT INTO `affiliations` VALUES (1,'Rotarian','Rotarian','2021-09-08 11:00:34','2021-09-08 11:00:34'),(2,'Rotaractor','Rotaractor','2021-09-08 11:00:34','2021-09-08 11:00:34'),(3,'Guest','Guest','2021-09-08 11:00:34','2021-09-08 11:00:34');
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
INSERT INTO `contacts` VALUES (1,1,87,'Neoma','Carter','deborah37@example.net','(877) 978-5912','5808 Lesly Lights Apt. 448','East Adalberto','Indiana','US','15552','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(2,1,91,'Jacey','Padberg','tavares.becker@example.com','800-897-7137','1353 Trantow Radial','Reillyburgh','Oklahoma','US','21405-1137','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(3,1,49,'Ciara','Mosciski','sokeefe@example.com','(866) 988-0234','53102 Hand Isle Apt. 522','Lake Ramona','Florida','US','22886','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(4,1,9,'Madelyn','Volkman','tristian04@example.com','1-888-226-7420','6588 Rohan Fields Suite 292','South Madonnahaven','Michigan','US','14774-8790','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(5,1,27,'Clarabelle','Dach','tatum76@example.org','1-888-247-2909','821 Keeling Shoal Apt. 447','West Makennaborough','Delaware','US','99638-5495','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(6,1,9,'Kasandra','Blanda','lvandervort@example.org','1-888-281-1762','7121 Rick Dale Suite 719','North Tavares','Alaska','US','85465','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(7,1,90,'Makenna','Willms','cecile98@example.net','844.727.8300','324 Buck Mountains','North Deontemouth','Massachusetts','US','87069-7327','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(8,1,47,'Wellington','McKenzie','arlo.stiedemann@example.org','(855) 765-1778','348 Crona Cape Apt. 557','New Emerson','Nevada','US','72103','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(9,1,18,'Lera','Romaguera','roberta14@example.net','844.242.5340','4135 Cade Unions','Frederickfurt','Maryland','US','06497','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(10,1,39,'Okey','Satterfield','steve39@example.net','888-238-1238','4766 Leuschke Trace','East Tillman','Pennsylvania','US','35431','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(11,1,32,'Dasia','Cummerata','effie06@example.net','800.425.7882','3576 Lottie Pine Suite 672','East Clintonstad','New York','US','20754-2389','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(12,1,73,'Arvel','Murazik','immanuel09@example.net','800-258-2667','269 Lenny Park Suite 708','North Kristin','New Hampshire','US','15363','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(13,1,30,'Mabel','Ward','swift.cecil@example.com','844-960-6457','65325 Joesph Cliff Suite 753','North Athena','Louisiana','US','59906-8050','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(14,1,33,'Nora','Sporer','janelle.gibson@example.com','(844) 722-0751','68298 Mayert Port Apt. 743','Port Sheila','Tennessee','US','79295-5749','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(15,1,13,'Bernice','Block','brady37@example.org','888-740-4121','89112 Dessie Neck','Lake Maceyberg','Washington','US','19915','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(16,1,8,'Earline','Donnelly','luettgen.jefferey@example.com','855.680.1062','9656 Jones Lakes Suite 952','Schusterburgh','West Virginia','US','55263','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(17,1,95,'Dimitri','Legros','ihauck@example.com','888.821.4375','48534 Orn Center','Karenchester','Wisconsin','US','50845-1596','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(18,1,80,'Micaela','Hermiston','rosenbaum.gerda@example.com','844-716-1866','938 Sawayn Ferry Apt. 771','Oberbrunnerview','Hawaii','US','84334-5181','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(19,1,91,'Gonzalo','Rolfson','reuben.nikolaus@example.org','1-866-598-0693','81704 Emery Way Apt. 859','Lebsackhaven','Vermont','US','05134-2504','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(20,1,12,'Clovis','Beahan','reagan.auer@example.org','877-903-3388','26340 Louie Club Suite 082','Williamburgh','Virginia','US','68986-9308','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(21,1,89,'Theodora','Baumbach','caleigh14@example.org','(855) 470-5900','64209 Moore Unions Apt. 995','Mitchellstad','Georgia','US','83912-0813','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(22,1,87,'Sylvan','Shields','mariana.zboncak@example.com','844-960-1523','5229 Maggio Knolls','Lake Alizeside','Oregon','US','64107','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(23,1,14,'Kamren','Hirthe','vmccullough@example.com','855.397.0764','83940 Alfredo Brooks Suite 139','Edwinaberg','Maine','US','39488-1390','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(24,1,71,'Frida','Mills','spencer.kirsten@example.net','866-418-6877','370 Charlie Locks','Wainotown','Kentucky','US','39197','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(25,1,99,'Dane','Stoltenberg','balistreri.wilhelmine@example.com','(877) 385-4541','8390 Kovacek Stravenue','Bashirianberg','Vermont','US','13974-9419','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(26,1,33,'Chaz','Jerde','paxton27@example.com','844-642-9632','88481 Hattie Avenue Suite 533','East Darianaland','California','US','89985-1301','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(27,1,65,'Elenor','Brown','zella.quitzon@example.org','877-635-9520','869 Matt Isle Apt. 370','New Christophermouth','Alabama','US','97194-6710','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(28,1,29,'Monroe','Williamson','willms.jacinthe@example.org','(855) 703-9262','57141 Isabell Plains','Adamsfurt','Michigan','US','94339-2637','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(29,1,37,'Keenan','Sanford','eunice.mante@example.org','888.963.3916','5975 Jed Inlet','Yostchester','Mississippi','US','62996-8506','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(30,1,86,'Ferne','Bernhard','wbednar@example.org','(877) 908-0002','7335 Chadd Stravenue Apt. 592','South Alize','Mississippi','US','35375-3461','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(31,1,87,'Damian','Rath','pfeffer.garth@example.com','1-800-261-7236','2194 Winfield Row','Kristyfort','New York','US','70665','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(32,1,1,'Chaim','McDermott','lemke.kaylah@example.org','(844) 212-6178','27988 Aglae Roads','Hellerside','North Dakota','US','69216','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(33,1,13,'Jackeline','Kuhn','marquardt.leonel@example.org','877-988-6832','71122 Marisa Highway Apt. 992','Hyattstad','Minnesota','US','54779','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(34,1,93,'Rosalia','Stark','murray.josie@example.net','(844) 476-0129','3871 Alayna Plaza Suite 165','North Dina','Colorado','US','79552','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(35,1,28,'Melyssa','Murazik','ed31@example.net','800.585.9544','3485 Mose Ranch','Jacklynview','Pennsylvania','US','80619-2535','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(36,1,10,'Marcellus','Witting','josiane74@example.com','855.877.5368','77108 Jayde Path Apt. 613','New Alleneview','Minnesota','US','02138-6462','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(37,1,17,'Bruce','White','cora87@example.org','(844) 629-2450','951 Wilson Terrace','Mantechester','District of Columbia','US','04691-5834','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(38,1,62,'William','Grimes','jayce10@example.org','888-843-9105','745 Leann Views','Bauchfort','New York','US','43103','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(39,1,77,'Nelson','Rodriguez','xwilliamson@example.org','877.228.6908','1946 Marvin Drive Apt. 028','North Grayceland','Alabama','US','97583-3902','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(40,1,46,'Sherwood','Dickinson','kameron.schinner@example.net','877.406.4372','82632 Cronin Wells','New Vidaberg','Colorado','US','94845-5136','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(41,1,76,'Florida','Beahan','lily.tromp@example.org','(866) 241-3058','29909 Duncan Drive','Alfton','Colorado','US','80277-0477','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(42,1,79,'Retta','Kilback','hlehner@example.net','(800) 754-8560','52041 Spencer Courts Suite 135','Terrencefurt','Georgia','US','99545-3132','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(43,1,2,'Jack','Hahn','anissa.kohler@example.org','(866) 703-6258','4519 Laverna Meadow Suite 162','Schinnerside','Nevada','US','32941-1338','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(44,1,83,'Monserrate','Ondricka','hhegmann@example.com','866.877.8614','5789 Halle Track Suite 195','Port Cyrus','Indiana','US','75068','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(45,1,70,'Tod','Stiedemann','jvandervort@example.org','866.971.5929','8843 Stanford Way','Marvinton','South Carolina','US','84110','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(46,1,15,'Braeden','Corwin','cummerata.camren@example.com','888-518-5941','3164 Sanford Route','Anastacioport','New York','US','53061-4156','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(47,1,82,'Karianne','Hermann','egoodwin@example.org','1-866-253-1866','331 Laurel Parkways','Ondrickashire','West Virginia','US','18202','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(48,1,40,'Mollie','Jerde','eli57@example.com','877.697.3244','43605 Jayme Stravenue','East Emmettshire','Arkansas','US','65759-4991','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(49,1,14,'Pedro','Koch','jrenner@example.com','(855) 607-6598','4994 Daugherty Orchard','West Lorenzomouth','Illinois','US','67751','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(50,1,25,'Joanny','Satterfield','gbuckridge@example.com','800.994.4765','666 Casper Gateway Suite 604','Dickimouth','Arkansas','US','78600','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(51,1,60,'Garret','Walsh','gilda.schiller@example.com','1-855-701-9859','84431 Monte Stream Suite 024','Gislasonmouth','Washington','US','24365','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(52,1,10,'Karolann','Waelchi','conn.maddison@example.net','1-855-743-5129','1563 Klein Courts Apt. 154','Yundtview','New Mexico','US','74804','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(53,1,86,'Felicita','Kutch','anderson.princess@example.com','(855) 412-2189','13319 Lura Ferry','Adolfbury','Arkansas','US','99227','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(54,1,54,'Nikko','Farrell','arlene.dicki@example.org','1-888-930-6235','3759 Fadel Track Suite 330','East Kristopher','Alaska','US','91652-0466','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(55,1,46,'Viva','Mante','steuber.elisa@example.net','1-844-509-0269','98935 Harris Station Suite 707','Mallieside','Pennsylvania','US','65268','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(56,1,78,'Tomasa','Barrows','billie43@example.com','1-866-749-9362','86539 Murray Roads Suite 207','Monahanville','Louisiana','US','14262','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(57,1,10,'Mabelle','Zemlak','reggie51@example.org','(855) 440-1853','8671 Beulah Way Suite 067','North Lonnymouth','New Jersey','US','52918-5974','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(58,1,21,'Caroline','Moore','mosciski.sonny@example.org','1-800-537-4624','75408 Mayer Circle Suite 790','New Dedrick','New Jersey','US','89570','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(59,1,41,'Buck','Von','little.linwood@example.net','855-909-3387','6743 Myrtice Junction','Oralhaven','Mississippi','US','26037','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(60,1,45,'Billie','Frami','earline60@example.org','(888) 774-8006','88957 Ida Circle','North Justine','Rhode Island','US','59172-5658','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(61,1,15,'Michael','Little','fbayer@example.org','(855) 609-3650','74850 Claudia Valley Apt. 357','Rohanside','Georgia','US','66440','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(62,1,61,'Amely','Kuhic','hhoeger@example.net','1-877-919-6758','56841 Pfeffer Prairie Suite 902','New Damian','Wyoming','US','27722','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(63,1,7,'Chelsea','Durgan','gerhard.kris@example.com','866-816-9557','22054 Lind Light','Weimannport','Texas','US','59380','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(64,1,56,'Giuseppe','Little','garrison71@example.net','877.402.6094','413 Ocie Vista Suite 199','Levishire','New Jersey','US','76996-6941','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(65,1,89,'Lauretta','Schroeder','parisian.zoie@example.com','866.443.7506','14735 Murphy Pike Apt. 547','New Malikafurt','Wisconsin','US','97268-8898','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(66,1,66,'Clyde','Thiel','connelly.monserrat@example.net','(844) 886-6105','44417 Birdie Village Suite 560','Port Maxiefort','South Carolina','US','28508-8953','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(67,1,58,'Jermaine','Lindgren','marilie45@example.net','1-888-354-0455','816 Hilpert Curve Apt. 065','Port Garret','Texas','US','42069-8466','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(68,1,99,'Isai','Johnston','mbrakus@example.org','866-826-8860','68413 Irma Rest Suite 307','Harrisside','Minnesota','US','22910-9591','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(69,1,50,'Bryana','Kunze','thea13@example.com','800-680-5667','78736 Gorczany Ports','Lake Odellchester','Iowa','US','42159','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(70,1,28,'Lois','Hodkiewicz','shannon18@example.org','(800) 584-7351','14848 Justina Oval Apt. 423','West Alison','Connecticut','US','09503','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(71,1,78,'Millie','Hickle','rubie.dubuque@example.net','877.772.3657','19628 Kertzmann Prairie Apt. 173','West Dovie','Delaware','US','79110','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(72,1,61,'Amani','Brekke','elna18@example.net','800-635-3359','816 Toy Springs Suite 340','Allenfurt','Virginia','US','83828-6263','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(73,1,97,'Olga','Boyle','schmidt.collin@example.org','(844) 331-4141','477 Crystal Port Apt. 143','North Aliza','South Carolina','US','68107','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(74,1,85,'Brooklyn','Wolf','serena.daniel@example.org','(866) 688-2968','92211 Wiza Wells Suite 473','Ziemeton','South Carolina','US','38308-1654','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(75,1,91,'Rosemarie','Wisoky','cking@example.org','(866) 854-8449','14729 Flatley Tunnel Apt. 855','West Megane','Washington','US','91354','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(76,1,87,'Magnolia','Rutherford','mfeil@example.net','800-416-4265','74345 Kulas Island Suite 692','Lake Telly','Colorado','US','20104','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(77,1,88,'Neil','Sanford','katelyn50@example.net','888.653.4430','9903 Cloyd Parks Suite 889','East Vestaport','Arkansas','US','43916-7982','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(78,1,1,'Rebeka','Prohaska','herman.alisha@example.com','866.827.4861','73504 Conner Knoll','South Laneport','South Dakota','US','53905-7044','2021-09-08 11:00:33','2021-09-08 11:00:34',NULL),(79,1,68,'Florian','Mayert','umonahan@example.org','(866) 671-6086','8491 Daugherty Circle Suite 020','New Annabelle','Nebraska','US','23334-8021','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(80,1,50,'Teresa','Dickinson','nsimonis@example.net','(844) 442-8339','54486 Mitchell Rue','West Angela','Florida','US','62259-0795','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(81,1,38,'Sarah','Frami','emclaughlin@example.com','(888) 614-8944','6027 Tito Manor','Clairefort','New York','US','15480','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(82,1,16,'Jewel','Kertzmann','darlene.nader@example.org','1-888-288-2848','23934 Wolf Coves Apt. 637','Ornside','South Dakota','US','88483-6449','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(83,1,40,'Davonte','Kessler','white.mavis@example.org','(844) 855-9507','1214 Legros Forges Suite 320','Port Jennings','New Mexico','US','40165','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(84,1,78,'Palma','Heidenreich','brandy.cruickshank@example.org','(877) 328-3657','804 Schiller Estate','Gabeland','Michigan','US','91591-3498','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(85,1,7,'Emilia','Hoppe','rupert50@example.com','866.806.6625','25607 Rowe Corners Apt. 952','Lake Maximilian','Indiana','US','04838-2273','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(86,1,61,'Riley','Crona','hirthe.carter@example.net','888-501-5359','94145 Medhurst Underpass Suite 310','East Fletcher','Rhode Island','US','86015-0809','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(87,1,75,'Randi','Daniel','keeling.rudy@example.net','844.905.0674','9289 Gwen Island Apt. 015','Hattieshire','Idaho','US','90973','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(88,1,52,'Geovany','Larkin','wgoldner@example.net','(888) 442-6139','7094 Grace Drives','Lake Napoleonberg','Connecticut','US','09944','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(89,1,17,'Jefferey','Daniel','glen11@example.net','844.372.8931','74396 Hermiston Station Apt. 568','Starkland','Utah','US','97632-3673','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(90,1,22,'Yesenia','Hermann','boehm.arvel@example.org','844-841-4209','58718 Korbin Underpass','Davidbury','Florida','US','06683-7302','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(91,1,68,'Marlene','Herman','kyle64@example.net','888.702.9344','809 Heaney Forges','North Emily','California','US','34705-9767','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(92,1,69,'Granville','Doyle','csporer@example.net','877.817.3103','448 Garrison Throughway','Funktown','Kentucky','US','83145','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(93,1,68,'Stephany','Kuhic','qlittel@example.org','866.653.9872','39749 Brekke Cliff','Anthonyland','Illinois','US','13095-8109','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(94,1,92,'Lon','VonRueden','tom20@example.net','1-877-388-0471','642 Deborah Plaza','East Sydnieborough','Mississippi','US','23069-5879','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(95,1,43,'Isaias','Lynch','brakus.ena@example.net','1-877-605-1228','67675 Rogelio Trafficway','Gleasonport','Connecticut','US','23081-9642','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(96,1,69,'Shanie','Franecki','akub@example.com','877.792.6733','6651 Favian Underpass Apt. 210','New Courtney','Florida','US','02273-5981','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(97,1,99,'Jan','Huels','gerlach.lavonne@example.org','1-888-962-7343','57290 Birdie Tunnel Suite 418','Jakubowskiport','Arizona','US','26079-9382','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(98,1,24,'Emery','Wehner','antonietta.batz@example.com','844.355.7936','1621 Ward Estate Apt. 433','East Oniemouth','Rhode Island','US','98290','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(99,1,38,'Emory','Stehr','cordia.shields@example.net','888.948.4592','985 Natalia Isle','East Chaddshire','Arkansas','US','39536-0230','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL),(100,1,57,'Austen','Monahan','isaac.marks@example.com','877-416-7764','30203 Harvey Courts Apt. 205','North Malcolm','New Jersey','US','20138','2021-09-08 11:00:34','2021-09-08 11:00:34',NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `makeups`
--

LOCK TABLES `makeups` WRITE;
/*!40000 ALTER TABLE `makeups` DISABLE KEYS */;
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
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_speaker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `duration` int DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `meetings_meeting_id_unique` (`meeting_id`),
  UNIQUE KEY `meetings_uuid_unique` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (1,'e4b80494-58c3-38a9-96ac-ec9bf02be3e2','P10001','et-incidunt-corrupti-tempore-aut-velit','Dr. Tito Powlowski','harum',1,'2021-09-08 15:45:13',152,'Africa/Nairobi','',1,'2021-09-06 01:24:29','2021-09-08 11:00:35'),(2,'ff0728c4-2c74-3b62-87c7-5dd78830477d','P10002','fugiat-eaque-suscipit-explicabo-sit-necessitatibus','Prof. Dr. Wiley Shields','minima',1,'2021-09-06 07:50:44',65,'Africa/Nairobi','',1,'2021-09-07 16:07:24','2021-09-08 11:00:35'),(3,'f4b1a45d-583a-3808-af16-b17b779e3b2a','P10003','sapiente-fugiat-ut-in-ipsa','Dr. Cheyanne Dietrich','magnam',1,'2021-09-05 02:19:11',69,'Africa/Nairobi','',1,'2021-09-06 14:53:59','2021-09-08 11:00:35'),(4,'004d05c5-7e19-396e-ba9c-02354b76db6b','P10004','iusto-veritatis-ad-aut-magni','Mr. Mr. Robbie Koelpin','temporibus',1,'2021-09-05 10:15:17',50,'Africa/Nairobi','',1,'2021-09-04 08:40:49','2021-09-08 11:00:35'),(5,'c87ea047-5f8b-35c6-896c-3c0e22f5fb2b','P10005','incidunt-quaerat-tempore-ipsam','Miss Armand Bergstrom','deserunt',1,'2021-09-08 15:06:56',137,'Africa/Nairobi','',1,'2021-09-08 03:34:16','2021-09-08 11:00:35'),(6,'e8643bec-3c3a-3744-9c43-849fe2ecfe6f','P10006','odio-eius-labore-in-repellendus-sit-dolorem-in','Miss Haven Nicolas','explicabo',1,'2021-09-07 20:07:00',148,'Africa/Nairobi','',1,'2021-09-07 00:59:08','2021-09-08 11:00:35'),(7,'0e0bf590-c2ed-3bdb-b3b6-ea76377ac8f3','P10007','ab-nostrum-distinctio-enim-quae','Ms. Demario Rowe Jr.','sunt',1,'2021-09-07 10:24:00',158,'Africa/Nairobi','',1,'2021-09-06 20:19:24','2021-09-08 11:00:35'),(8,'a614702c-fe9f-330a-8c64-04816acf4692','P10008','veritatis-corrupti-qui-impedit-quo','Dr. Fay Nader','deleniti',1,'2021-09-07 18:24:56',98,'Africa/Nairobi','',1,'2021-09-08 05:01:57','2021-09-08 11:00:35'),(9,'a61b203b-818b-3910-826c-9e487a199aee','P10009','debitis-assumenda-enim-occaecati-reiciendis-ipsa-optio-et','Mr. Cordie Koelpin','ab',1,'2021-09-06 03:51:54',90,'Africa/Nairobi','',1,'2021-09-08 13:28:59','2021-09-08 11:00:35'),(10,'023bf7ca-660e-3d1d-bddb-0abb5f3e46f4','P10010','ut-vel-provident-praesentium-facilis','Mrs. Vivienne Mraz Jr.','veritatis',1,'2021-09-05 01:14:59',61,'Africa/Nairobi','',1,'2021-09-06 14:17:08','2021-09-08 11:00:35'),(11,'e97d63dd-7762-3801-a70e-815d8a3d17d8','P10011','inventore-occaecati-consequuntur-beatae-et-sit','Prof. Dr. Tristian McLaughlin II','quis',1,'2021-09-07 22:10:55',88,'Africa/Nairobi','',1,'2021-09-07 21:21:14','2021-09-08 11:00:35'),(12,'ef0e4369-5002-30b3-b2a7-c0c66d75a198','P10012','temporibus-odio-et-reprehenderit-eveniet-iste','Dr. Derick Runolfsson','debitis',1,'2021-09-03 23:16:25',92,'Africa/Nairobi','',1,'2021-09-08 11:42:24','2021-09-08 11:00:35');
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
INSERT INTO `member_type` VALUES (1,1,NULL,NULL),(2,1,NULL,NULL),(3,1,NULL,NULL),(4,1,NULL,NULL),(5,1,NULL,NULL),(6,1,NULL,NULL),(7,1,NULL,NULL),(8,2,NULL,NULL),(9,1,NULL,NULL),(10,1,NULL,NULL),(11,1,NULL,NULL),(12,2,NULL,NULL),(13,1,NULL,NULL),(14,2,NULL,NULL),(15,2,NULL,NULL),(16,2,NULL,NULL),(17,1,NULL,NULL),(18,2,NULL,NULL),(19,1,NULL,NULL),(20,2,NULL,NULL),(21,1,NULL,NULL),(22,1,NULL,NULL),(23,1,NULL,NULL),(24,1,NULL,NULL),(25,1,NULL,NULL),(26,2,NULL,NULL),(27,1,NULL,NULL),(28,1,NULL,NULL),(29,1,NULL,NULL),(30,1,NULL,NULL),(31,2,NULL,NULL),(32,1,NULL,NULL),(33,1,NULL,NULL),(34,2,NULL,NULL),(35,1,NULL,NULL),(36,1,NULL,NULL),(37,2,NULL,NULL),(38,2,NULL,NULL),(39,1,NULL,NULL),(40,2,NULL,NULL),(41,1,NULL,NULL),(42,1,NULL,NULL),(43,2,NULL,NULL),(44,1,NULL,NULL),(45,1,NULL,NULL),(46,2,NULL,NULL),(47,1,NULL,NULL),(48,1,NULL,NULL),(49,1,NULL,NULL),(50,2,NULL,NULL),(51,1,NULL,NULL),(52,2,NULL,NULL),(53,2,NULL,NULL),(54,1,NULL,NULL),(55,1,NULL,NULL),(56,2,NULL,NULL),(57,2,NULL,NULL),(58,1,NULL,NULL),(59,1,NULL,NULL),(60,2,NULL,NULL),(61,1,NULL,NULL),(62,1,NULL,NULL),(63,1,NULL,NULL),(64,1,NULL,NULL),(65,1,NULL,NULL),(66,2,NULL,NULL),(67,1,NULL,NULL),(68,2,NULL,NULL),(69,1,NULL,NULL),(70,2,NULL,NULL),(71,1,NULL,NULL),(72,1,NULL,NULL),(73,2,NULL,NULL),(74,1,NULL,NULL),(75,2,NULL,NULL),(76,2,NULL,NULL),(77,1,NULL,NULL),(78,1,NULL,NULL),(79,2,NULL,NULL),(80,1,NULL,NULL),(81,2,NULL,NULL),(82,1,NULL,NULL),(83,2,NULL,NULL),(84,1,NULL,NULL),(85,1,NULL,NULL),(86,2,NULL,NULL),(87,1,NULL,NULL),(88,2,NULL,NULL),(89,2,NULL,NULL),(90,2,NULL,NULL),(91,1,NULL,NULL),(92,1,NULL,NULL),(93,1,NULL,NULL),(94,1,NULL,NULL),(95,1,NULL,NULL),(96,2,NULL,NULL),(97,1,NULL,NULL),(98,1,NULL,NULL),(99,2,NULL,NULL),(100,1,NULL,NULL),(101,2,NULL,NULL),(102,2,NULL,NULL),(103,2,NULL,NULL),(104,1,NULL,NULL),(105,1,NULL,NULL),(106,1,NULL,NULL),(107,1,NULL,NULL),(108,1,NULL,NULL),(109,1,NULL,NULL),(110,2,NULL,NULL),(111,1,NULL,NULL),(112,1,NULL,NULL),(113,1,NULL,NULL),(114,1,NULL,NULL),(115,2,NULL,NULL),(116,1,NULL,NULL),(117,1,NULL,NULL),(118,1,NULL,NULL),(119,2,NULL,NULL),(120,2,NULL,NULL);
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
  `member_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Preston Schuppe','RCL262105','emmerich.rosalind@example.com','+1 (878) 510-2064',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(2,'Rebeca Stiedemann I','RCL545895','hoppe.kara@example.net','+1-669-415-8517',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(3,'Javon Feeney','RCL290565','heaney.lindsay@example.com','1-573-743-0660',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(4,'Dorian Borer I','RCL581494','jerde.ottis@example.org','+19259675162',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(5,'Abbigail Metz','RCL13176','zwhite@example.org','+1-618-760-0508',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(6,'Ryann Kohler MD','RCL942451','wilkinson.magdalen@example.net','279.518.7108',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(7,'Ms. Kara Bashirian','RCL260842','sprice@example.org','+1.305.615.9561',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(8,'Judson Schultz III','RCL589654','erdman.keshawn@example.com','(631) 724-6455',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(9,'Paula Barton','RCL999071','christa.pollich@example.net','+1.856.870.6061',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(10,'Aniya Wilderman','RCL432970','ahagenes@example.net','+15803054875',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(11,'Martine Parker II','RCL509543','gschuster@example.net','917-712-4334',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(12,'Katarina Gerlach','RCL670551','wiza.helmer@example.org','+16053301407',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(13,'Clovis Grant','RCL588677','ukutch@example.org','1-314-384-9053',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(14,'Dr. Earline Johnson','RCL512191','wchamplin@example.com','(580) 352-8560',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(15,'Morton Franecki','RCL905393','hmitchell@example.net','+1-754-772-1328',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(16,'Prof. Adelbert Russel','RCL252664','hickle.jose@example.net','719.715.5468',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(17,'Alyce Kiehn','RCL969011','yheller@example.net','+17705444695',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(18,'Mateo Morar','RCL280043','qhagenes@example.net','1-586-279-1407',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(19,'Mrs. Wanda Heidenreich Jr.','RCL538244','cbosco@example.org','1-361-298-7967',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(20,'Ansel Gulgowski Sr.','RCL736338','leuschke.friedrich@example.org','(251) 848-9761',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(21,'Tressa Cummerata','RCL402304','braun.queen@example.net','+13519532492',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(22,'Mrs. Antonette Hane DVM','RCL918219','aiden14@example.org','317-957-0955',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(23,'Prof. Citlalli Bernhard V','RCL439536','kathlyn.cruickshank@example.com','+1-510-761-7850',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(24,'August Orn','RCL855475','wiza.eleonore@example.org','1-706-857-1406',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(25,'Santa Breitenberg','RCL313562','al.bode@example.org','1-248-714-8409',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(26,'Schuyler Marquardt','RCL313586','sebastian63@example.com','+1.917.475.4170',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(27,'Davonte Schamberger','RCL757273','jacobi.darrell@example.org','1-701-817-3244',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(28,'Bonita Kunze DVM','RCL871986','dwight84@example.net','1-434-708-8503',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(29,'Prof. Sheridan Larkin PhD','RCL690698','ihomenick@example.com','+1-628-581-9291',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(30,'Iliana Pagac','RCL662355','ernestine.purdy@example.com','+19283866443',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(31,'Danny Cronin','RCL186698','herman.joyce@example.org','1-341-447-2861',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(32,'Dr. Johann Cartwright','RCL682731','john.rolfson@example.net','+1.814.478.1985',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(33,'Emma Bashirian','RCL467514','baylee81@example.com','+1-769-403-1514',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(34,'Quincy Shanahan','RCL519846','lebsack.kaley@example.com','+1-520-950-1754',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(35,'Arjun Oberbrunner','RCL803576','dahlia30@example.net','(610) 752-5042',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(36,'Prof. Geovanni Denesik','RCL307619','bart.kuhn@example.org','801-556-4690',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(37,'Gussie Eichmann','RCL729265','emmalee.quigley@example.net','+1-843-510-4927',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(38,'Torrance Greenfelder','RCL275872','carissa95@example.com','(234) 819-7293',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(39,'Adrien Bahringer','RCL318702','gilberto.nienow@example.net','+1-828-234-3054',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(40,'Amy Bergnaum','RCL323966','tad77@example.net','+1-716-700-7233',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(41,'Roosevelt Padberg DVM','RCL663414','diana15@example.net','1-947-410-7818',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(42,'Cassandre Hirthe','RCL957817','scarlett52@example.net','+1-641-853-4670',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(43,'Sanford Heidenreich V','RCL956138','monroe.kshlerin@example.org','+1-623-802-2383',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(44,'Marcel Bechtelar','RCL897110','gbuckridge@example.org','+1 (218) 212-0965',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(45,'Gust Rice','RCL939169','howard.franecki@example.com','779-745-8326',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(46,'Marisol Cartwright Sr.','RCL405171','sawayn.stacey@example.org','+1-325-853-2701',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(47,'Gerardo Nolan','RCL291925','xfunk@example.org','901-646-2401',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(48,'Abdullah Nienow','RCL252618','qberge@example.com','(281) 485-9963',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(49,'Ms. Julianne Huel','RCL504809','eileen.schuster@example.com','1-615-683-1061',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(50,'Juvenal Brekke','RCL256306','conroy.gail@example.net','+16289546575',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(51,'Prof. Imani Lehner III','RCL851228','ucarroll@example.org','662.622.0109',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(52,'Santino Rolfson I','RCL248755','metz.chaim@example.net','1-870-801-2408',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(53,'Daphne Stanton','RCL493017','leannon.eriberto@example.com','+1.781.796.7614',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(54,'Paige Gleason','RCL160651','mariane.bogan@example.com','1-910-716-8602',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(55,'Zola Erdman','RCL487144','xturcotte@example.com','1-573-876-7554',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(56,'Torrey Spinka I','RCL279982','madge.zemlak@example.com','445.867.4727',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(57,'Luella Christiansen','RCL47175','lilian51@example.net','(202) 373-4279',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(58,'Prof. Mylene Bartell','RCL502800','remington69@example.net','+1-806-813-2320',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(59,'Brenda Kertzmann','RCL903459','breanne02@example.net','+12677224528',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(60,'Rocio Nader','RCL243295','camille.schultz@example.com','+1.956.623.3331',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(61,'Verona Windler','RCL283616','dspencer@example.org','337-414-0458',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(62,'Eliza Collier','RCL786312','gilbert50@example.com','727.543.4028',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(63,'Leola Abbott V','RCL284206','jamel21@example.net','562-926-7204',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(64,'Alfred Koepp MD','RCL518767','carmela25@example.net','1-820-217-2727',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(65,'Edwin Mills','RCL646800','jalon.stanton@example.org','+1-603-201-4788',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(66,'Eveline Cummings','RCL898167','abbey.glover@example.org','+18584558853',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(67,'Jalyn Konopelski','RCL800757','nienow.ron@example.com','530.715.9453',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(68,'Macie Kshlerin','RCL584423','alysson.hackett@example.com','+18289860683',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(69,'Iliana Fahey V','RCL904504','emelie.lueilwitz@example.net','1-706-382-3070',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(70,'Broderick Lowe','RCL769578','onikolaus@example.com','575.456.4588',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(71,'Dr. Harley Goyette','RCL329740','bednar.araceli@example.net','838.212.6881',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(72,'Mattie Moore','RCL268697','gutmann.keyon@example.org','321.906.8259',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(73,'Laney Bergnaum','RCL724524','micah.wolf@example.com','1-386-579-1483',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(74,'Brenden Kunde II','RCL852371','jermain.krajcik@example.org','978-645-5063',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(75,'Alanis Botsford','RCL974869','imogene68@example.net','+1.801.291.7436',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(76,'Lester Hills','RCL120782','linnie77@example.com','+1.951.424.2094',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(77,'Karen Satterfield','RCL443989','stamm.janae@example.net','205.683.8218',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(78,'Cade Breitenberg','RCL518171','eichmann.hillary@example.net','651.885.9656',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(79,'Marcel Hackett','RCL658625','merritt87@example.net','+1 (820) 809-6490',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(80,'Gabriella Heller','RCL70187','gcrooks@example.net','+1.559.753.2722',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(81,'Prof. Dimitri Kautzer DDS','RCL214858','prudence86@example.org','1-661-446-4874',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(82,'Cyrus Rippin','RCL284925','hilda63@example.net','1-570-693-2054',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(83,'Josiane Collins','RCL604496','zelda06@example.com','(303) 858-2547',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(84,'Elroy Jacobson','RCL751443','christop09@example.net','+18459980008',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(85,'Alden Quitzon','RCL753713','nlangosh@example.com','865.877.0776',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(86,'D\'angelo Conn','RCL791263','wilma16@example.org','+1 (502) 809-0540',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(87,'Dr. Camden Lubowitz','RCL968527','lokeefe@example.com','+1-573-941-5742',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(88,'Stephon Heidenreich','RCL628562','shirley19@example.org','+1-479-890-5132',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(89,'Lenore White','RCL428510','fbernhard@example.com','(458) 284-7313',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(90,'Marjolaine Treutel','RCL391386','keeling.lauren@example.org','1-870-742-3081',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(91,'Melyna Bernier','RCL381733','parisian.bessie@example.net','470-517-2052',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(92,'Stewart Leuschke','RCL145495','xkunde@example.net','+1-678-265-0181',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(93,'Samir Dicki','RCL584696','fbailey@example.org','1-602-808-5432',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(94,'Brenna Zieme','RCL305030','mgraham@example.com','336-258-3496',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(95,'Guadalupe Nienow','RCL624802','bergnaum.mohamed@example.org','952.214.1089',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(96,'Darian Bergnaum','RCL597358','bbatz@example.org','949.790.0478',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(97,'Dr. Kyla Zulauf','RCL522037','zkreiger@example.net','+1.806.280.5330',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(98,'Lue Aufderhar','RCL583545','fredy79@example.net','267-272-9261',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(99,'Annalise Dickinson','RCL849951','jonatan94@example.org','1-743-814-1481',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(100,'Madaline Huel','RCL318698','gkohler@example.com','1-561-231-7606',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(101,'Mariah Walter','RCL222618','onader@example.com','+1 (832) 677-7309',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(102,'Miss Florida Mante','RCL34918','nia.thiel@example.net','341-544-1922',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(103,'Guido Konopelski','RCL549253','egoldner@example.org','+1 (838) 687-3657',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(104,'Carroll Kling','RCL319007','lorenzo22@example.org','+1-539-620-9142',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(105,'Jada Nader','RCL563591','bconroy@example.net','+1.806.902.1192',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(106,'Dr. Darwin Halvorson II','RCL298615','derick82@example.net','+15592087056',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(107,'Dr. Jerrod Walter','RCL401818','leannon.javier@example.net','940-532-0716',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(108,'Amely Gusikowski','RCL315627','mhammes@example.org','(765) 557-9420',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(109,'Angelo Williamson Sr.','RCL914999','kory45@example.com','+1 (925) 239-9230',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(110,'Ms. Letitia Mitchell I','RCL627986','wturner@example.net','(361) 868-8778',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(111,'Colleen Hyatt IV','RCL120600','parisian.allan@example.com','+14697807760',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(112,'Prof. Sedrick Kuhn V','RCL572178','enader@example.net','+1-760-671-4850',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(113,'Wilfred Ruecker','RCL347741','bryana.gulgowski@example.net','+18084866080',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(114,'Ernest Block','RCL122584','rdach@example.net','1-845-275-1161',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(115,'Mr. Gunner Flatley','RCL861197','jerde.rudolph@example.org','+1-234-810-3804',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(116,'Emerald Prosacco','RCL937056','pmuller@example.com','+1-669-246-3106',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(117,'Diana Franecki','RCL963279','tcasper@example.com','+1 (442) 721-7542',2,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(118,'Vincenzo Hagenes','RCL961896','leatha97@example.com','351.914.6156',1,1,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(119,'Prof. Terrence Marks Jr.','RCL61910','fhegmann@example.com','+1 (480) 212-1019',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL),(120,'Arne Morar DVM','RCL438958','chanel.gutmann@example.net','+17579128675',3,2,'2021-09-08 11:00:34','2021-09-08 11:00:34',0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2020_01_01_000001_create_password_resets_table',1),(2,'2020_01_01_000002_create_failed_jobs_table',1),(3,'2020_01_01_000003_create_accounts_table',1),(4,'2020_01_01_000004_create_users_table',1),(5,'2020_01_01_000005_create_organizations_table',1),(6,'2020_01_01_000006_create_contacts_table',1),(7,'2021_08_25_014800_create_members_table',1),(8,'2021_08_25_020432_create_types_table',1),(9,'2021_08_25_020451_create_affiliations_table',1),(10,'2021_08_25_020856_create_member_type_pivot_table',1),(11,'2021_08_25_020907_create_affiliation_member_pivot_table',1),(12,'2021_08_25_064644_add_active_to_members_table',1),(13,'2021_08_25_074711_add_soft_delete_to_members',1),(14,'2021_08_28_103942_create_setup_table',1),(15,'2021_08_29_074131_create_table_zoom_users',1),(16,'2021_08_29_123619_create_zoom_tokens_table',1),(17,'2021_08_29_164918_create_meetings_table',1),(18,'2021_08_30_204030_create_makeups_table',1),(19,'2021_08_31_062814_create_registrants_table',1),(20,'2021_09_03_104114_create_participants_table',1);
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
INSERT INTO `organizations` VALUES (1,1,'Lakin, Daugherty and Roberts','jhagenes@gorczany.org','855.551.3403','9800 Hamill Station','West Makaylashire','Alabama','US','04004-7961','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(2,1,'Nikolaus Ltd','hmuller@hessel.com','844.773.9764','3364 Hattie Parkways','Leonelborough','Michigan','US','06551-8278','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(3,1,'Langworth-Fadel','flarson@ankunding.net','800.318.2609','59325 Stephan Hollow Apt. 716','Liachester','Virginia','US','11972-2249','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(4,1,'Wiegand, Auer and Bode','kilback.blaze@crist.net','888-959-0965','228 Okuneva Landing Suite 852','Hettingermouth','Oklahoma','US','01433-6904','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(5,1,'Reichel PLC','luther.dibbert@jones.org','(888) 799-0068','74423 O\'Kon Wells','Kianview','Mississippi','US','11097-9833','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(6,1,'Hermann-Wiza','cgreenfelder@boyle.com','844-228-5801','9348 Emard Island','New Corrine','Wyoming','US','34264-9410','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(7,1,'Wolf-Tillman','dstiedemann@brakus.com','(888) 504-7015','686 Greyson Union Apt. 810','South Reecehaven','Hawaii','US','18847','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(8,1,'Jerde, Mayer and Kris','oren.waters@ferry.info','(888) 360-0824','41634 Corwin Isle','Stehrburgh','North Carolina','US','29015','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(9,1,'Hegmann-Terry','elody.hermiston@murazik.com','800-727-5276','638 Devin Camp Apt. 216','Florenciohaven','Oregon','US','88308','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(10,1,'Ratke-Rohan','gebert@murray.com','(855) 713-2739','471 Medhurst Viaduct','Port Destinee','Utah','US','24166-9069','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(11,1,'Herman PLC','paucek.elizabeth@pollich.info','1-877-817-4586','6201 Sauer Lights','Alysonborough','Minnesota','US','21037','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(12,1,'Stamm, Bergnaum and Johnson','jpadberg@connelly.com','855-292-1919','6067 Rice Fields','Angusport','Wyoming','US','44773-6404','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(13,1,'Spinka-Cremin','dicki.effie@rogahn.com','(877) 946-1539','338 Mills Ports','Bartolettiburgh','Washington','US','62618','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(14,1,'Luettgen-Witting','luna84@lind.info','855-747-5268','851 Joanie Terrace','Gislasonstad','Nevada','US','96112-1834','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(15,1,'Mertz, Huels and Krajcik','april43@leffler.com','1-855-585-0903','921 Lyda Centers','North Samaraville','North Dakota','US','72604-5877','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(16,1,'Casper, Roberts and Streich','juston65@schulist.org','866-201-5921','54630 Cassin Ways Apt. 006','Huelsberg','Washington','US','08362-4937','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(17,1,'Medhurst, Swaniawski and Rohan','jamar81@dietrich.net','800-201-5796','2961 Jenkins Port','Ortizborough','Arizona','US','52071','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(18,1,'Johns Inc','eichmann.brandyn@kub.com','877.620.7213','8973 Harber Bridge','Port Vergie','Indiana','US','60785-3598','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(19,1,'Lakin-Murray','otho75@welch.net','877-528-2871','491 Freda Squares Apt. 881','West Idella','California','US','43575','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(20,1,'Mayert LLC','nweissnat@hettinger.com','866.423.4070','16315 Rippin Skyway','Naderton','Missouri','US','26375','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(21,1,'Gottlieb-Walker','kathleen.kovacek@klein.com','(855) 773-0461','52119 Amari Square','South Zoilabury','Kansas','US','94784','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(22,1,'Koepp, Purdy and O\'Hara','cecil.mueller@turcotte.net','(888) 301-6069','6930 Breitenberg Circles','Connellyton','Maine','US','36215','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(23,1,'Dach Group','dax93@okeefe.info','800-431-8543','4814 Terry Ridges Suite 289','East Hymanton','Virginia','US','26695-5263','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(24,1,'Morissette-Hermann','laron08@legros.com','888-924-2617','3522 Keeling Mountain Suite 862','Obiefort','Missouri','US','18596-7200','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(25,1,'Thiel, Marvin and Oberbrunner','norma.pollich@schaefer.com','(866) 861-1078','12537 Runolfsson Drives','West Treva','Minnesota','US','21661-2944','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(26,1,'Purdy LLC','zritchie@donnelly.com','877.674.0511','47383 Adela Harbors','Auerburgh','Idaho','US','66890-4720','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(27,1,'Kuhic, Emard and Willms','twila.crona@medhurst.com','855.315.1962','4496 Isabella Forges','Lake Yoshikoville','Kansas','US','37949','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(28,1,'Jast PLC','connelly.arnold@goodwin.biz','(866) 327-1275','5388 Emmerich Ford','Imeldatown','Connecticut','US','20009','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(29,1,'Harvey LLC','joey99@smith.org','800-267-8147','837 Dwight Stream','Cruickshankbury','Maryland','US','36557','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(30,1,'Sawayn, Sawayn and Hamill','nella91@prosacco.com','1-800-715-9576','14381 Feeney Lodge','Kamrenstad','New York','US','13630-3421','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(31,1,'Altenwerth, Murphy and Lindgren','bogan.hassan@kuhn.biz','844-356-4532','1498 Pattie Manor','Parisianville','Washington','US','77206','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(32,1,'Kemmer Group','sheldon53@erdman.com','800.758.3372','834 Eduardo Track','Hermannfurt','Tennessee','US','11536','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(33,1,'Towne Ltd','marcia.breitenberg@christiansen.com','(888) 451-2105','12258 Runolfsson Squares','Raulbury','Pennsylvania','US','97058-9427','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(34,1,'Ebert Group','larkin.madilyn@gutmann.com','1-866-971-0209','8569 Konopelski Ferry Suite 271','Winnifredmouth','Arizona','US','92203','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(35,1,'Metz-VonRueden','lroob@simonis.com','(800) 936-0348','457 Reece Ports','New Casperhaven','Virginia','US','16079','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(36,1,'Glover-Shields','berge.hailey@hilpert.com','800-868-5252','976 Sawayn Ridge Apt. 293','Cullenchester','Wisconsin','US','77340','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(37,1,'Lindgren, Nienow and Marquardt','ldietrich@bernhard.com','866.801.2153','36247 Hester Hollow','West Carli','Florida','US','60372-4833','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(38,1,'Christiansen and Sons','elouise12@wilderman.com','844-393-2695','2529 Skiles Ports Suite 858','South Oswald','Texas','US','43584','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(39,1,'Steuber and Sons','oberbrunner.joesph@konopelski.com','1-844-397-9473','159 Towne Flats','West Orantown','North Carolina','US','02266-8740','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(40,1,'Hirthe-Fritsch','vgoyette@welch.com','866.392.8574','69361 Marian Shoals Suite 062','Lake Alvena','District of Columbia','US','97419-4378','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(41,1,'Koelpin-Johns','oceane.kovacek@rempel.com','1-877-859-2891','133 Wilbert Points Apt. 266','East Ona','Kentucky','US','04754','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(42,1,'Farrell-Fay','kelton96@bergnaum.com','(800) 529-9111','14855 Regan Orchard','Hermannbury','California','US','29279','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(43,1,'Parisian, Dietrich and Bailey','schowalter.cortney@hoppe.com','888-991-8077','982 Dawson Inlet','South Isabell','Mississippi','US','49986-7388','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(44,1,'Bailey Ltd','charris@marquardt.com','(877) 831-5771','3255 Berge Garden Apt. 499','Collinshire','Indiana','US','55674-7708','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(45,1,'Johns-Becker','zemlak.eda@mitchell.com','844.318.4079','339 Lindgren Road Suite 639','East Paris','Wisconsin','US','51333-1970','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(46,1,'Feil-Macejkovic','mateo87@schimmel.com','866.879.8817','68143 Kreiger Orchard','Larkinfort','Illinois','US','62870','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(47,1,'Jones and Sons','adolphus25@bergstrom.com','855.452.9178','6186 Aubrey Stream Suite 951','Lake Montanafurt','Wisconsin','US','51606','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(48,1,'Boyer PLC','kklocko@green.net','(877) 534-7226','637 Modesta Ville Apt. 715','Tatyanaside','Kentucky','US','59182','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(49,1,'Abbott LLC','ernest36@pfeffer.com','(800) 712-5442','2379 Carter Gateway','Lefflermouth','Iowa','US','76792','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(50,1,'Keebler, Harris and Lind','drew27@stroman.net','844.354.9478','296 Marilou Mission','South Roxanneburgh','Oklahoma','US','04248-8247','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(51,1,'Kerluke-Mills','daniel.jennifer@eichmann.com','1-844-401-8741','634 Muller Common Suite 589','Dellfort','Rhode Island','US','72354-9796','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(52,1,'Parisian-Terry','leo32@kreiger.com','(800) 985-5346','885 Cole Viaduct','Jarrellhaven','South Dakota','US','31555-0505','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(53,1,'Reilly, Gleason and Abernathy','rubye47@okuneva.biz','855.971.7752','555 Medhurst Isle','Simonisfort','Missouri','US','27966-2108','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(54,1,'Wisozk-Fritsch','dubuque.vivien@dare.com','(877) 358-5833','86531 Kulas Pass Suite 401','Hicklestad','Texas','US','20291','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(55,1,'Schaden, Cremin and Mann','lenny78@stiedemann.com','(855) 505-2391','407 Reynold Bypass','Port Elissa','Kentucky','US','13286','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(56,1,'Kerluke, Price and Halvorson','pacocha.tyrique@prosacco.info','(800) 487-1570','79384 Leonor Harbor','Erwinberg','Alaska','US','86011','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(57,1,'Deckow-Reinger','rau.junius@mann.org','(855) 667-8971','93421 Casandra Street','West Eloisaborough','Illinois','US','74185-9809','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(58,1,'Pfeffer-Sawayn','conn.mozelle@schultz.com','844.679.3441','715 Jacobs Mills Suite 246','Shermanchester','Colorado','US','46692-3995','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(59,1,'Auer-Frami','dkirlin@mcglynn.biz','(855) 484-7048','4618 Emilie Isle Suite 983','New Wade','Illinois','US','58888','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(60,1,'Simonis-Rodriguez','stracke.constance@conroy.com','1-888-312-6346','261 Gutmann Village Apt. 399','North Lyda','Nevada','US','42794','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(61,1,'Wyman, Barton and Schmidt','amanda.morar@wolf.net','1-844-527-4452','9108 King Trafficway Apt. 675','Kerlukeview','Maine','US','95188','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(62,1,'Gutkowski, Hermiston and McCullough','bernadette.friesen@murphy.biz','844-234-5074','89440 Harley Flats Suite 659','Clarissaview','District of Columbia','US','63616-0896','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(63,1,'Considine, Gusikowski and Nicolas','nyasia.kunze@little.com','877-348-1415','990 Schowalter Landing','Lake Jovani','Louisiana','US','11834-7191','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(64,1,'Kilback-Boyle','bogan.adelia@runte.com','(888) 836-1473','6321 Bauch Mall','Stantonville','Montana','US','99029-8969','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(65,1,'Hansen Group','rglover@dibbert.com','866-649-7683','410 Romaguera Points','Parisianmouth','Oregon','US','48989-5036','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(66,1,'Gleason Ltd','gschaefer@bahringer.net','800-887-8476','9974 Rosina Locks','South Zakaryshire','Arkansas','US','96404-6135','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(67,1,'Cummerata LLC','rowan46@stroman.com','(855) 834-8179','516 Josue Square','Geovannytown','New Jersey','US','12834','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(68,1,'Feil-VonRueden','cstanton@oconner.com','1-888-787-0311','67710 Abshire Haven Suite 496','Beershire','California','US','84509-9861','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(69,1,'Rath-Wisozk','xziemann@marquardt.biz','844.710.0230','3495 Marvin Streets','Simoneborough','Virginia','US','09456','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(70,1,'Miller PLC','uhyatt@durgan.com','844-670-0518','994 Nikolaus Court','West Mylesbury','Alabama','US','49396','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(71,1,'Mante PLC','bret74@kunze.org','1-800-584-4253','55706 White Circles Apt. 043','West Ethel','California','US','65859-6658','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(72,1,'Leannon-Gislason','celia.swaniawski@stracke.com','877.655.1853','31504 Alphonso Centers','South Carolanne','Kansas','US','95110','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(73,1,'Hills-Howell','mitchel98@hermiston.com','877-417-3334','3409 Howell Cliff Apt. 496','South Della','Kentucky','US','08685-7150','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(74,1,'Schuppe LLC','qrowe@will.info','866.752.8195','20096 Marcos Causeway Apt. 343','Elyseside','Maine','US','08520','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(75,1,'Murray LLC','aufderhar.alfonzo@berge.com','855.969.8327','591 Claude Junctions Apt. 779','Russchester','Virginia','US','67673-4474','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(76,1,'Kuvalis Group','wuckert.mae@casper.net','(855) 293-5774','664 Hayes Brook','Delphineton','Mississippi','US','83345','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(77,1,'Kiehn-Hagenes','jake.schmeler@maggio.com','800-898-8746','229 Elva Islands','Agustinside','Delaware','US','98095-3560','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(78,1,'Donnelly, Kertzmann and White','allene.kuhic@schneider.biz','(800) 433-3959','423 Block Alley Apt. 749','Pietrobury','Michigan','US','06917','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(79,1,'Wisoky, Cruickshank and Kilback','sylvan04@effertz.com','844.537.8084','883 Tremaine Estates','Lake Angie','Wisconsin','US','89910','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(80,1,'Kub Inc','vbosco@larson.com','1-855-918-2768','50596 McClure Prairie Suite 937','Lake Walter','Alaska','US','45303','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(81,1,'McDermott PLC','hilpert.zita@kozey.com','855.942.1575','566 Pagac Road','New Nathan','North Carolina','US','26726','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(82,1,'Abshire Ltd','bernard.mraz@ondricka.info','(800) 233-5391','697 Gislason Wall Suite 637','North Ahmedfurt','Vermont','US','26710-7532','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(83,1,'Bailey-Wunsch','cummerata.trey@hills.com','800-767-2939','856 Grayce Shore','New Rosie','Kentucky','US','95876','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(84,1,'O\'Conner-Walter','sdickinson@hintz.com','1-800-226-3741','31448 Cummings Station','Nickolaston','Oregon','US','00330','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(85,1,'Donnelly, Lindgren and Vandervort','magnus58@heidenreich.com','(855) 768-5874','44990 Foster Haven','West Calebtown','New Mexico','US','68291','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(86,1,'Mayer, Roberts and Greenholt','alexandria.witting@hudson.com','866.465.9897','57870 Janelle Walk','South Janetmouth','Connecticut','US','65078','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(87,1,'Kshlerin PLC','wterry@glover.com','1-800-349-8367','490 King Creek Apt. 382','Zboncakville','New Jersey','US','70925','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(88,1,'Kunze-Dooley','pbailey@bergstrom.com','(844) 989-5664','44625 Mara Mission','Langland','Indiana','US','42742-9302','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(89,1,'Johnson, Wyman and Jaskolski','sofia43@weber.com','1-844-386-5776','1834 Queenie Curve Suite 110','Lake Averyton','California','US','00612-6645','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(90,1,'Lakin Group','ibechtelar@glover.com','800-314-0407','5752 Waters Junctions Suite 794','Volkmanside','New Hampshire','US','92881','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(91,1,'Tremblay, Fisher and West','wsatterfield@nicolas.org','(888) 495-9256','32643 Orn Hill Suite 540','Port Ursulaview','Arkansas','US','28702','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(92,1,'Windler-Rolfson','gvonrueden@white.com','800-285-9289','99058 Ortiz Lakes Suite 571','Emardbury','Indiana','US','26734','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(93,1,'Lesch-Sipes','megane32@schultz.com','(800) 717-0643','64229 Jakayla Knoll','Priceville','South Carolina','US','28458','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(94,1,'Zieme-McKenzie','omayer@mayert.biz','800-332-2869','89225 Rempel Unions Suite 679','East Arnaldoville','Kentucky','US','66641-7024','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(95,1,'Kihn PLC','virginia.ruecker@rolfson.com','855-418-6253','20303 Nader Forge','Camilaville','Arizona','US','84956-3044','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(96,1,'Sanford-Dibbert','hboehm@considine.com','844-887-2569','566 Ora Radial Apt. 598','Predovicmouth','New Mexico','US','22172-4104','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(97,1,'Dietrich LLC','talia98@champlin.com','800-819-3167','6854 Strosin Brooks Suite 895','Lake Celiastad','New Mexico','US','93531-1008','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(98,1,'Jast, Heathcote and Conn','leone90@dubuque.org','877.507.0442','1504 Pagac Center Suite 473','Tillmanshire','Kentucky','US','51188','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(99,1,'Stanton-Streich','violette34@pacocha.com','877.402.8548','86480 Flavie Springs','South Andre','Hawaii','US','44847-3524','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(100,1,'Casper-Bode','hailee89@herzog.info','1-877-876-7538','8734 Cassandre Walks Suite 034','Rubyemouth','Nebraska','US','36477','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL);
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meeting_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `participant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_time` datetime NOT NULL,
  `leave_time` datetime NOT NULL,
  `duration` int NOT NULL,
  `registrant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
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
  `meeting_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `meeting_prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_meeting_no` int NOT NULL,
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
INSERT INTO `setup` VALUES (1,'88qbzpueTkGI66J9dKWd1g','3ZNpHxlheBOPr1NpqWB8fFTLX4BasWwM','https://localhost/show','local','P',10012,1,'2021-09-08 11:00:34','2021-09-08 11:00:35'),(2,'88qbzpueTkGI66J9dKWd1g','3ZNpHxlheBOPr1NpqWB8fFTLX4BasWwM','https://club.minorharmony.com/show','production','P',10000,0,'2021-09-08 11:00:34','2021-09-08 11:00:34');
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
INSERT INTO `types` VALUES (1,'Member','Full Member','2021-09-08 11:00:34','2021-09-08 11:00:34'),(2,'Inductee','On induction for 12 meetings','2021-09-08 11:00:34','2021-09-08 11:00:34');
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
INSERT INTO `users` VALUES (1,1,'John','Doe','johndoe@example.com','2021-09-08 11:00:33','$2y$10$SVRJVi8/QqJlzXkU9UlhT.ELvn5wEAJZwb33zH7UxGuXnbjnRTvsy',1,NULL,'oRnASmDIa4','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(2,1,'Eldridge','Stokes','sandy42@example.net','2021-09-08 11:00:33','$2y$10$f0hJBg4SewtM2mD27U0Oh..k/OT3Yjoe9RlQSkaK9W59ZZJphGHVK',0,NULL,'brT0G38YAb','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(3,1,'Arthur','Wiegand','zdare@example.net','2021-09-08 11:00:33','$2y$10$i1B.WRW3.d4/u6hy5UfL7OcN7YNFnNHf0mXKBEnZEqF5dpNDDibHq',0,NULL,'sszfCljwSq','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(4,1,'Kiara','Mayer','emma.cassin@example.com','2021-09-08 11:00:33','$2y$10$jFolEcTSVlI6sdxWBLoU3Om3TVIHfUh.AtDIZitmPdSxvawL7soWy',0,NULL,'1n9GfphGdn','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(5,1,'Tyshawn','Kulas','king33@example.com','2021-09-08 11:00:33','$2y$10$dQilU7G3BwQ3JJWz2VLLvOoUawjeuyCx2m8DbZdfRuu1GfMoN4CRG',0,NULL,'3OnEZNAdul','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL),(6,1,'Ken','Murazik','khalil76@example.com','2021-09-08 11:00:33','$2y$10$EIH67OXwySbC9EjEJHZmUOMwazV3tW.d/Xzj9AdQ91aoydquHLRzi',0,NULL,'FN4wZq7epm','2021-09-08 11:00:33','2021-09-08 11:00:33',NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zoom_users`
--

LOCK TABLES `zoom_users` WRITE;
/*!40000 ALTER TABLE `zoom_users` DISABLE KEYS */;
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

-- Dump completed on 2021-09-08 17:01:13
