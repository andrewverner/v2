-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: eveservice
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `character_route`
--

DROP TABLE IF EXISTS `character_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) NOT NULL,
  `route` text,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `hash` varchar(64) DEFAULT NULL,
  `share` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_route`
--

LOCK TABLES `character_route` WRITE;
/*!40000 ALTER TABLE `character_route` DISABLE KEYS */;
/*!40000 ALTER TABLE `character_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hash`
--

DROP TABLE IF EXISTS `hash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `value` varchar(32) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expired` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hash`
--

LOCK TABLES `hash` WRITE;
/*!40000 ALTER TABLE `hash` DISABLE KEYS */;
INSERT INTO `hash` VALUES (1,1,1,'fad909d112c4e8ebea5256fa8e58b041',0,'2018-12-21 09:34:36','2018-12-22 09:34:36');
/*!40000 ALTER TABLE `hash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1545373117),('m181002_114839_create_token_table',1545373121),('m181003_102954_create_user_table',1545373121),('m181003_163750_create_hash_table',1545373121),('m181004_111535_create_scope_table',1545373121),('m181004_111833_create_scope_group_table',1545373121),('m181004_113533_populate_scopes',1545373121),('m181004_142412_add_refresh_token_to_token_table',1545373121),('m181004_143409_add_access_token_to_token_table',1545373121),('m181004_194222_alter_refresh_token_column',1545373121),('m181102_193002_create_character_route_table',1545373121),('m181103_145120_add_hash_column_to_character_route_table',1545373121),('m181122_142554_create_pi_commodity_table',1545373122),('m181123_060447_create_pi_planet_table',1545373122),('m181123_060509_create_pi_planet_commodity_table',1545373122),('m181123_060523_create_pi_schematic_table',1545373122),('m181123_070833_create_pi_schematic_input_table',1545373123);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pi_commodity`
--

DROP TABLE IF EXISTS `pi_commodity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pi_commodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pi_commodity`
--

LOCK TABLES `pi_commodity` WRITE;
/*!40000 ALTER TABLE `pi_commodity` DISABLE KEYS */;
INSERT INTO `pi_commodity` VALUES (1,2310,0),(2,2270,0),(3,2305,0),(4,2272,0),(5,2308,0),(6,2306,0),(7,2311,0),(8,2073,0),(9,2309,0),(10,2286,0),(11,2267,0),(12,2288,0),(13,2287,0),(14,2307,0),(15,2268,0),(16,3683,1),(17,2399,1),(18,2397,1),(19,2400,1),(20,2389,1),(21,2401,1),(22,2392,1),(23,2393,1),(24,2390,1),(25,3779,1),(26,2398,1),(27,2396,1),(28,2395,1),(29,9828,1),(30,3645,1),(31,2319,2),(32,2312,2),(33,2463,2),(34,3693,2),(35,9836,2),(36,2321,2),(37,44,2),(38,2327,2),(39,2329,2),(40,9842,2),(41,9838,2),(42,3695,2),(43,15317,2),(44,9840,2),(45,3775,2),(46,3691,2),(47,3689,2),(48,9830,2),(49,3828,2),(50,2328,2),(51,2317,2),(52,9832,2),(53,3697,2),(54,3725,2),(55,2358,3),(56,2367,3),(57,2352,3),(58,2344,3),(59,9846,3),(60,2349,3),(61,17136,3),(62,2360,3),(63,2354,3),(64,17898,3),(65,28974,3),(66,2366,3),(67,2351,3),(68,12836,3),(69,2346,3),(70,17392,3),(71,9848,3),(72,2361,3),(73,9834,3),(74,2345,3),(75,2348,3),(76,2867,4),(77,2868,4),(78,2871,4),(79,2875,4),(80,2876,4),(81,2869,4),(82,2870,4),(83,2872,4);
/*!40000 ALTER TABLE `pi_commodity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pi_planet`
--

DROP TABLE IF EXISTS `pi_planet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pi_planet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `mask` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pi_planet`
--

LOCK TABLES `pi_planet` WRITE;
/*!40000 ALTER TABLE `pi_planet` DISABLE KEYS */;
INSERT INTO `pi_planet` VALUES (1,11,'Planet (Temperate)',1),(2,12,'Planet (Ice)',2),(3,13,'Planet (Gas)',4),(4,2014,'Planet (Oceanic)',8),(5,2015,'Planet (Lava)',16),(6,2016,'Planet (Barren)',32),(7,2017,'Planet (Storm)',64),(8,2063,'Planet (Plasma)',128);
/*!40000 ALTER TABLE `pi_planet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pi_planet_commodity`
--

DROP TABLE IF EXISTS `pi_planet_commodity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pi_planet_commodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planet_type_id` int(11) NOT NULL,
  `commodity_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pi_planet_commodity`
--

LOCK TABLES `pi_planet_commodity` WRITE;
/*!40000 ALTER TABLE `pi_planet_commodity` DISABLE KEYS */;
INSERT INTO `pi_planet_commodity` VALUES (1,2016,2268),(2,2016,2267),(3,2016,2288),(4,2016,2073),(5,2016,2270),(6,13,2268),(7,13,2267),(8,13,2309),(9,13,2310),(10,13,2311),(11,12,2268),(12,12,2272),(13,12,2073),(14,12,2310),(15,12,2286),(16,2015,2267),(17,2015,2307),(18,2015,2272),(19,2015,2306),(20,2015,2308),(21,2014,2268),(22,2014,2288),(23,2014,2287),(24,2014,2073),(25,2014,2286),(26,2063,2267),(27,2063,2272),(28,2063,2270),(29,2063,2306),(30,2063,2308),(31,2017,2268),(32,2017,2267),(33,2017,2309),(34,2017,2310),(35,2017,2308),(36,11,2268),(37,11,2305),(38,11,2288),(39,11,2287),(40,11,2073);
/*!40000 ALTER TABLE `pi_planet_commodity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pi_schematic`
--

DROP TABLE IF EXISTS `pi_schematic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pi_schematic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `output_type_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pi_schematic`
--

LOCK TABLES `pi_schematic` WRITE;
/*!40000 ALTER TABLE `pi_schematic` DISABLE KEYS */;
INSERT INTO `pi_schematic` VALUES (1,3683,40),(2,2399,40),(3,2397,40),(4,2400,40),(5,2389,40),(6,2401,40),(7,2392,40),(8,2393,40),(9,2390,40),(10,3779,40),(11,2398,40),(12,2396,40),(13,2395,40),(14,9828,40),(15,3645,40),(16,2319,5),(17,2312,5),(18,2463,5),(19,3693,5),(20,9836,5),(21,2321,5),(22,44,5),(23,2327,5),(24,2329,5),(25,9842,5),(26,9838,5),(27,3695,5),(28,15317,5),(29,9840,5),(30,3775,5),(31,3691,5),(32,3689,5),(33,9830,5),(34,3828,5),(35,2328,5),(36,2317,5),(37,9832,5),(38,3697,5),(39,3725,5),(40,2358,3),(41,2367,3),(42,2352,3),(43,2344,3),(44,9846,3),(45,2349,3),(46,17136,3),(47,2360,3),(48,2354,3),(49,17898,3),(50,28974,3),(51,2366,3),(52,2351,3),(53,12836,3),(54,2346,3),(55,17392,3),(56,9848,3),(57,2361,3),(58,9834,3),(59,2345,3),(60,2348,3),(61,2867,1),(62,2868,1),(63,2871,1),(64,2875,1),(65,2876,1),(66,2869,1),(67,2870,1),(68,2872,1);
/*!40000 ALTER TABLE `pi_schematic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pi_schematic_input`
--

DROP TABLE IF EXISTS `pi_schematic_input`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pi_schematic_input` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `output_type_id` int(11) NOT NULL,
  `input_type_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pi_schematic_input`
--

LOCK TABLES `pi_schematic_input` WRITE;
/*!40000 ALTER TABLE `pi_schematic_input` DISABLE KEYS */;
INSERT INTO `pi_schematic_input` VALUES (1,3683,2310,3000),(2,2399,2270,3000),(3,2397,2305,3000),(4,2400,2272,3000),(5,2389,2308,3000),(6,2401,2306,3000),(7,2392,2311,3000),(8,2393,2073,3000),(9,2390,2309,3000),(10,3779,2286,3000),(11,2398,2267,3000),(12,2396,2288,3000),(13,2395,2287,3000),(14,9828,2307,3000),(15,3645,2268,3000),(16,2319,2393,40),(17,2319,3645,40),(18,2312,3683,40),(19,2312,3779,40),(20,2463,2393,40),(21,2463,2398,40),(22,3693,2393,40),(23,3693,2395,40),(24,9836,2400,40),(25,9836,2401,40),(26,2321,2392,40),(27,2321,2397,40),(28,44,2399,40),(29,44,2400,40),(30,2327,2397,40),(31,2327,9828,40),(32,2329,2396,40),(33,2329,2399,40),(34,9842,2401,40),(35,9842,9828,40),(36,9838,2389,40),(37,9838,3645,40),(38,3695,2396,40),(39,3695,2397,40),(40,15317,2395,40),(41,15317,3779,40),(42,9840,2389,40),(43,9840,2401,40),(44,3775,2393,40),(45,3775,3779,40),(46,3691,2390,40),(47,3691,3683,40),(48,3689,2398,40),(49,3689,2399,40),(50,9830,2389,40),(51,9830,2390,40),(52,3828,2398,40),(53,3828,2400,40),(54,2328,2398,40),(55,2328,3645,40),(56,2317,2392,40),(57,2317,3683,40),(58,9832,2390,40),(59,9832,3645,40),(60,3697,2392,40),(61,3697,9828,40),(62,2329,2396,40),(63,2329,2399,40),(64,3828,2398,40),(65,3828,2400,40),(66,9836,2400,40),(67,9836,2401,40),(68,9832,2390,40),(69,9832,3645,40),(70,44,2399,40),(71,44,2400,40),(72,3693,2393,40),(73,3693,2395,40),(74,15317,2395,40),(75,15317,3779,40),(76,3725,2395,40),(77,3725,2396,40),(78,3689,2398,40),(79,3689,2399,40),(80,2327,2397,40),(81,2327,9828,40),(82,9842,2401,40),(83,9842,9828,40),(84,2463,2393,40),(85,2463,2398,40),(86,2317,2392,40),(87,2317,3683,40),(88,2321,2392,40),(89,2321,2397,40),(90,3695,2396,40),(91,3695,2397,40),(92,9830,2389,40),(93,9830,2390,40),(94,3697,2392,40),(95,3697,9828,40),(96,9838,2389,40),(97,9838,3645,40),(98,2312,3683,40),(99,2312,3779,40),(100,3691,2390,40),(101,3691,3683,40),(102,2319,2393,40),(103,2319,3645,40),(104,9840,2389,40),(105,9840,2401,40),(106,3775,2393,40),(107,3775,3779,40),(108,2328,2398,40),(109,2328,3645,40),(110,2358,2463,10),(111,2358,3725,10),(112,2358,3828,10),(113,2345,3697,10),(114,2345,9830,10),(115,2344,2317,10),(116,2344,9832,10),(117,2367,2319,10),(118,2367,3691,10),(119,2367,3693,10),(120,17392,2312,10),(121,17392,2327,10),(122,2348,2317,10),(123,2348,2329,10),(124,2348,9838,10),(125,9834,2328,10),(126,9834,9840,10),(127,2366,3695,10),(128,2366,3775,10),(129,2366,9840,10),(130,2361,2321,10),(131,2361,15317,10),(132,17898,2321,10),(133,17898,9840,10),(134,2360,3693,10),(135,2360,3695,10),(136,2354,2329,10),(137,2354,3697,10),(138,2352,44,10),(139,2352,2327,10),(140,9846,2312,10),(141,9846,3689,10),(142,9846,9842,10),(143,9848,3689,10),(144,9848,9836,10),(145,2351,3828,10),(146,2351,9842,10),(147,2349,2328,10),(148,2349,9832,10),(149,2349,9836,10),(150,2346,2312,10),(151,2346,2319,10),(152,12836,2329,10),(153,12836,2463,10),(154,17136,3691,10),(155,17136,9838,10),(156,28974,3725,10),(157,28974,3775,10),(158,2867,2354,6),(159,2867,17392,6),(160,2867,17898,6),(161,2868,2348,6),(162,2868,2366,6),(163,2868,9846,6),(164,2869,2360,6),(165,2869,2398,40),(166,2869,17136,6),(167,2870,2344,6),(168,2870,2393,40),(169,2870,9848,6),(170,2871,2346,6),(171,2871,9834,6),(172,2871,12836,6),(173,2872,2345,6),(174,2872,2352,6),(175,2872,2361,6),(176,2875,2351,6),(177,2875,3645,40),(178,2875,28974,6),(179,2876,2349,6),(180,2876,2358,6),(181,2876,2367,6);
/*!40000 ALTER TABLE `pi_schematic_input` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scope`
--

DROP TABLE IF EXISTS `scope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scope` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scope`
--

LOCK TABLES `scope` WRITE;
/*!40000 ALTER TABLE `scope` DISABLE KEYS */;
INSERT INTO `scope` VALUES (1,'esi-calendar.respond_calendar_events.v1','Allows updating of a character\'s calendar event responses',1,NULL),(2,'esi-calendar.read_calendar_events.v1','Allows reading a character\'s calendar, including corporation events',1,NULL),(3,'esi-location.read_location.v1','Allows reading of a character\'s active ship location',1,NULL),(4,'esi-location.read_ship_type.v1','Allows reading of a character\'s active ship class',1,NULL),(5,'esi-mail.organize_mail.v1','Allows updating the character\'s mail labels and unread status. Also allows deleting of the character\'s mail.',1,NULL),(6,'esi-mail.read_mail.v1','Allows reading of the character\'s inbox and mails.',1,NULL),(7,'esi-mail.send_mail.v1','Allows sending of mail on the character\'s behalf.',1,NULL),(8,'esi-skills.read_skills.v1','Allows reading of a character\'s currently known skills.',1,NULL),(9,'esi-skills.read_skillqueue.v1','Allows reading of a character\'s currently training skill queue.',1,NULL),(10,'esi-wallet.read_character_wallet.v1','Allows reading of a character\'s wallet, journal and transaction history.',1,NULL),(11,'esi-wallet.read_corporation_wallet.v1','EVE Mobile legacy scope',1,NULL),(12,'esi-search.search_structures.v1','Allows searching over all structures that a character can see in the structure browser.',1,NULL),(13,'esi-clones.read_clones.v1','Allows reading the locations of a character\'s jump clones and their implants.',1,NULL),(14,'esi-characters.read_contacts.v1','Allows reading of a characters contacts list, and calculation of CSPA charges',1,NULL),(15,'esi-universe.read_structures.v1','Allows querying the location and type of structures that the character has docking access at.',1,NULL),(16,'esi-bookmarks.read_character_bookmarks.v1','Allows reading of a character\'s bookmarks and bookmark folders',1,NULL),(17,'esi-killmails.read_killmails.v1','Allows reading of a character\'s kills and losses',1,NULL),(18,'esi-corporations.read_corporation_membership.v1','Allows reading a list of the ID\'s and roles of a character\'s fellow corporation members',1,NULL),(19,'esi-assets.read_assets.v1','Allows reading a list of assets that the character owns',1,NULL),(20,'esi-planets.manage_planets.v1','Allows reading a list of a characters planetary colonies, and the details of those colonies',1,NULL),(21,'esi-fleets.read_fleet.v1','Allows reading information about fleets',1,NULL),(22,'esi-fleets.write_fleet.v1','Allows manipulating fleets',1,NULL),(23,'esi-ui.open_window.v1','Allows open window in game client remotely',1,NULL),(24,'esi-ui.write_waypoint.v1','Allows manipulating waypoints in game client remotely',1,NULL),(25,'esi-characters.write_contacts.v1','Allows management of contacts',1,NULL),(26,'esi-fittings.read_fittings.v1','Allows reading information about fittings',1,NULL),(27,'esi-fittings.write_fittings.v1','Allows manipulating fittings',1,NULL),(28,'esi-markets.structure_markets.v1','Allows reading market data from a structure, if the user has market access to that structure',1,NULL),(29,'esi-corporations.read_structures.v1','Allows reading a character\'s corporation\'s structure information',1,NULL),(30,'esi-corporations.write_structures.v1','Allows updating a character\'s corporation\'s structure information',1,NULL),(31,'esi-characters.read_loyalty.v1','Allows reading a character\'s loyalty points',1,NULL),(32,'esi-characters.read_opportunities.v1','Allows reading opportunities of a character',1,NULL),(33,'esi-characters.read_chat_channels.v1','Allows reading a character\'s chat channels',1,NULL),(34,'esi-characters.read_medals.v1','Allows reading a character\'s medals',1,NULL),(35,'esi-characters.read_standings.v1','Allows reading a character\'s standings',1,NULL),(36,'esi-characters.read_agents_research.v1','Allows reading a character\'s research status with agents',1,NULL),(37,'esi-industry.read_character_jobs.v1','Allows reading a character\'s industry jobs',1,NULL),(38,'esi-markets.read_character_orders.v1','Allows reading a character\'s market orders',1,NULL),(39,'esi-characters.read_blueprints.v1','Allows reading a character\'s blueprints',1,NULL),(40,'esi-characters.read_corporation_roles.v1','Allows reading the character\'s corporation roles',1,NULL),(41,'esi-location.read_online.v1','Allows reading a character\'s online status',1,NULL),(42,'esi-contracts.read_character_contracts.v1','Allows reading a character\'s contracts',1,NULL),(43,'esi-clones.read_implants.v1','Allows reading a character\'s active clone\'s implants',1,NULL),(44,'esi-characters.read_fatigue.v1','Allows reading a character\'s jump fatigue information',1,NULL),(45,'esi-killmails.read_corporation_killmails.v1','Allows reading of a corporation\'s kills and losses',1,NULL),(46,'esi-corporations.track_members.v1','Allows tracking members\' activities in a corporation',1,NULL),(47,'esi-wallet.read_corporation_wallets.v1','Allows reading of a character\'s corporation\'s wallets, journal and transaction history, if the character has roles to do so.',1,NULL),(48,'esi-characters.read_notifications.v1','Allows reading a character\'s pending contact notifications',1,NULL),(49,'esi-corporations.read_divisions.v1','Allows reading of a character\'s corporation\'s division names, if the character has roles to do so.',1,NULL),(50,'esi-corporations.read_contacts.v1','Allows reading of a character\'s corporation\'s contacts, if the character has roles to do so.',1,NULL),(51,'esi-assets.read_corporation_assets.v1','Allows reading of a character\'s corporation\'s assets, if the character has roles to do so.',1,NULL),(52,'esi-corporations.read_titles.v1','Allows reading of a character\'s corporation\'s titles, if the character has roles to do so.',1,NULL),(53,'esi-corporations.read_blueprints.v1','Allows reading a corporation\'s blueprints',1,NULL),(54,'esi-bookmarks.read_corporation_bookmarks.v1','Allows reading of a corporations\'s bookmarks and bookmark folders',1,NULL),(55,'esi-contracts.read_corporation_contracts.v1','Allows reading a corporation\'s contracts',1,NULL),(56,'esi-corporations.read_standings.v1','Allows reading a corporation\'s standings',1,NULL),(57,'esi-corporations.read_starbases.v1','Allows reading of a character\'s corporation\'s starbase (POS) information, if the character has roles to do so.',1,NULL),(58,'esi-industry.read_corporation_jobs.v1','Allows reading of a character\'s corporation\'s industry jobs, if the character has roles to do so.',1,NULL),(59,'esi-markets.read_corporation_orders.v1','Allows reading of a character\'s corporation\'s market orders, if the character has roles to do so.',1,NULL),(60,'esi-corporations.read_container_logs.v1','Allows reading of a corporation\'s ALSC logs',1,NULL),(61,'esi-industry.read_character_mining.v1','Allows reading a character\'s personal mining activity',1,NULL),(62,'esi-industry.read_corporation_mining.v1','Allows reading and observing a corporation\'s mining activity',1,NULL),(63,'esi-planets.read_customs_offices.v1','Allow reading of corporation owned customs offices',1,NULL),(64,'esi-corporations.read_facilities.v1','Allows reading a corporation\'s facilities',1,NULL),(65,'esi-corporations.read_medals.v1','Allows reading medals created and issued by a corporation',1,NULL),(66,'esi-characters.read_titles.v1','Allows reading titles given to a character',1,NULL),(67,'esi-alliances.read_contacts.v1','Allows reading of an alliance\'s contact list and standings',1,NULL),(68,'esi-characters.read_fw_stats.v1','Allows reading of a character\'s faction warfare statistics',1,NULL),(69,'esi-corporations.read_fw_stats.v1','Allows reading of a corporation\'s faction warfare statistics',1,NULL),(70,'esi-corporations.read_outposts.v1','Allows read access for listing and seeing details about a corporation\'s outposts',1,NULL),(71,'esi-characterstats.read.v1','Allows reading a characters aggregated statistics from the past year.',1,NULL);
/*!40000 ALTER TABLE `scope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scope_group`
--

DROP TABLE IF EXISTS `scope_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scope_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scope_group`
--

LOCK TABLES `scope_group` WRITE;
/*!40000 ALTER TABLE `scope_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `scope_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) NOT NULL,
  `character_name` varchar(255) NOT NULL,
  `expires_on` datetime NOT NULL,
  `token_type` varchar(255) DEFAULT NULL,
  `character_owner_hash` varchar(255) DEFAULT NULL,
  `intellectual_property` varchar(255) DEFAULT NULL,
  `scopes` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `scope_mask` int(11) DEFAULT NULL,
  `refresh_token` varchar(512) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (1,656916134,'Andrew Verner','2018-12-21 07:50:56','Character','PzHoyXjl6yi5Ty8iWUniDUKbwRo=','EVE','a:46:{i:0;s:39:\"esi-calendar.respond_calendar_events.v1\";i:1;s:36:\"esi-calendar.read_calendar_events.v1\";i:2;s:29:\"esi-location.read_location.v1\";i:3;s:30:\"esi-location.read_ship_type.v1\";i:4;s:25:\"esi-mail.organize_mail.v1\";i:5;s:21:\"esi-mail.read_mail.v1\";i:6;s:21:\"esi-mail.send_mail.v1\";i:7;s:25:\"esi-skills.read_skills.v1\";i:8;s:29:\"esi-skills.read_skillqueue.v1\";i:9;s:35:\"esi-wallet.read_character_wallet.v1\";i:10;s:31:\"esi-search.search_structures.v1\";i:11;s:25:\"esi-clones.read_clones.v1\";i:12;s:31:\"esi-characters.read_contacts.v1\";i:13;s:31:\"esi-universe.read_structures.v1\";i:14;s:41:\"esi-bookmarks.read_character_bookmarks.v1\";i:15;s:31:\"esi-killmails.read_killmails.v1\";i:16;s:25:\"esi-assets.read_assets.v1\";i:17;s:29:\"esi-planets.manage_planets.v1\";i:18;s:24:\"esi-fleets.read_fleet.v1\";i:19;s:25:\"esi-fleets.write_fleet.v1\";i:20;s:21:\"esi-ui.open_window.v1\";i:21;s:24:\"esi-ui.write_waypoint.v1\";i:22;s:32:\"esi-characters.write_contacts.v1\";i:23;s:29:\"esi-fittings.read_fittings.v1\";i:24;s:30:\"esi-fittings.write_fittings.v1\";i:25;s:32:\"esi-markets.structure_markets.v1\";i:26;s:30:\"esi-characters.read_loyalty.v1\";i:27;s:36:\"esi-characters.read_opportunities.v1\";i:28;s:36:\"esi-characters.read_chat_channels.v1\";i:29;s:29:\"esi-characters.read_medals.v1\";i:30;s:32:\"esi-characters.read_standings.v1\";i:31;s:38:\"esi-characters.read_agents_research.v1\";i:32;s:35:\"esi-industry.read_character_jobs.v1\";i:33;s:36:\"esi-markets.read_character_orders.v1\";i:34;s:33:\"esi-characters.read_blueprints.v1\";i:35;s:27:\"esi-location.read_online.v1\";i:36;s:41:\"esi-contracts.read_character_contracts.v1\";i:37;s:27:\"esi-clones.read_implants.v1\";i:38;s:30:\"esi-characters.read_fatigue.v1\";i:39;s:36:\"esi-characters.read_notifications.v1\";i:40;s:39:\"esi-corporations.read_container_logs.v1\";i:41;s:37:\"esi-industry.read_character_mining.v1\";i:42;s:35:\"esi-planets.read_customs_offices.v1\";i:43;s:29:\"esi-characters.read_titles.v1\";i:44;s:31:\"esi-characters.read_fw_stats.v1\";i:45;s:26:\"esi-characterstats.read.v1\";}','2018-12-21 09:43:36','2018-12-21 10:30:56',1,NULL,'pMcvqHaRjOnxTd9DpnoxHuTLF7nfJhdz2l4ReyG3B01NPB8yWfyqlG1SGer7OAY2feVdWaERpc2BooyhwfXjwM7fxJ0pgf7fKlptRxskWyl7BvMLhscEEKjkY4hY6FXmV8UF3tLFE67XBHPiSBEXqFzL7v0Glu0JIrWbnTq_tBxMJ32YWsgvX2BfArEL4O-LyyCklbjRMxG1Ta7V94mEgdjJF8Ly6nGq_U620PiaDYbXvzhMSdjfZWEo1uCge12gtk4hmRQewkRKhZiFOE5cOdH0fv9mRJ_U3X71cf3HpRA1','fpUj8fMC92a8CSZGqAabvpBxxRRJ57Qr5iMLRzCQyMTbBWXg7it_VB4H9hqhQTB0UcehKlMhwXqnMdCD7D_E9A2'),(2,523375194,'Iweta Kendal','2018-12-21 07:54:01','Character','knX7219EdvCaxDPHqczbyhpKHKc=','EVE','a:46:{i:0;s:39:\"esi-calendar.respond_calendar_events.v1\";i:1;s:36:\"esi-calendar.read_calendar_events.v1\";i:2;s:29:\"esi-location.read_location.v1\";i:3;s:30:\"esi-location.read_ship_type.v1\";i:4;s:25:\"esi-mail.organize_mail.v1\";i:5;s:21:\"esi-mail.read_mail.v1\";i:6;s:21:\"esi-mail.send_mail.v1\";i:7;s:25:\"esi-skills.read_skills.v1\";i:8;s:29:\"esi-skills.read_skillqueue.v1\";i:9;s:35:\"esi-wallet.read_character_wallet.v1\";i:10;s:31:\"esi-search.search_structures.v1\";i:11;s:25:\"esi-clones.read_clones.v1\";i:12;s:31:\"esi-characters.read_contacts.v1\";i:13;s:31:\"esi-universe.read_structures.v1\";i:14;s:41:\"esi-bookmarks.read_character_bookmarks.v1\";i:15;s:31:\"esi-killmails.read_killmails.v1\";i:16;s:25:\"esi-assets.read_assets.v1\";i:17;s:29:\"esi-planets.manage_planets.v1\";i:18;s:24:\"esi-fleets.read_fleet.v1\";i:19;s:25:\"esi-fleets.write_fleet.v1\";i:20;s:21:\"esi-ui.open_window.v1\";i:21;s:24:\"esi-ui.write_waypoint.v1\";i:22;s:32:\"esi-characters.write_contacts.v1\";i:23;s:29:\"esi-fittings.read_fittings.v1\";i:24;s:30:\"esi-fittings.write_fittings.v1\";i:25;s:32:\"esi-markets.structure_markets.v1\";i:26;s:30:\"esi-characters.read_loyalty.v1\";i:27;s:36:\"esi-characters.read_opportunities.v1\";i:28;s:36:\"esi-characters.read_chat_channels.v1\";i:29;s:29:\"esi-characters.read_medals.v1\";i:30;s:32:\"esi-characters.read_standings.v1\";i:31;s:38:\"esi-characters.read_agents_research.v1\";i:32;s:35:\"esi-industry.read_character_jobs.v1\";i:33;s:36:\"esi-markets.read_character_orders.v1\";i:34;s:33:\"esi-characters.read_blueprints.v1\";i:35;s:27:\"esi-location.read_online.v1\";i:36;s:41:\"esi-contracts.read_character_contracts.v1\";i:37;s:27:\"esi-clones.read_implants.v1\";i:38;s:30:\"esi-characters.read_fatigue.v1\";i:39;s:36:\"esi-characters.read_notifications.v1\";i:40;s:39:\"esi-corporations.read_container_logs.v1\";i:41;s:37:\"esi-industry.read_character_mining.v1\";i:42;s:35:\"esi-planets.read_customs_offices.v1\";i:43;s:29:\"esi-characters.read_titles.v1\";i:44;s:31:\"esi-characters.read_fw_stats.v1\";i:45;s:26:\"esi-characterstats.read.v1\";}','2018-12-21 10:34:02','2018-12-21 10:34:02',1,NULL,'ri-qzre4FPZabMdkg2hBMwnLqbbY4gkv4Zt-y8YuIs146JdeKNBHhZXbopgXw6ahweDUoOM4_6WfvmtrES44tRo6oHOu8B2SE8n9c-JUMbukKOMj49TM0lFGtFS-6EXyxziplQX2w9VFkpD1xmZCkazv2Td5IBmbGdM8Afmh9-am0VB0_R_-D6pCoHf7DM1Qep-wpA-OThiRFDIsBZ3Q50RRq-zv12WRovpgxbP5fs3GEYe1W6c2M4dXDqOrH7vXOOT1_Uvou9G5dWoc4m1wtO_0Jw8KxGxzlGsQsjIiWCU1','k3835NSw9ibBMcVM1SRbLZZ4i5wjBnOoeDWRTMO_fva0cdf3Q7MFaGYkz3oYynHYI3B77JF-BaJHi1ZUnYRlKA2');
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'andrewverner','e68f14b720cfa48c5e7ba04fe3ba740c','denis.khodakovskiy@gmail.com',1,'2018-12-21 09:34:35');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-01 18:12:10
