-- MySQL dump 10.13  Distrib 8.3.0, for Win64 (x86_64)
--
-- Host: localhost    Database: db_agenda
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `agendas`
--

DROP TABLE IF EXISTS `agendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agendas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoomlink` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slidolink` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pelaksanaan` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `poster` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `certificate_template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linksertifikat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `att_daftarhadir_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agendas_slug_unique` (`slug`),
  KEY `agendas_kum_instansi_id_foreign` (`att_daftarhadir_id`),
  CONSTRAINT `agendas_kum_instansi_id_foreign` FOREIGN KEY (`att_daftarhadir_id`) REFERENCES `att_daftarhadirs` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
INSERT INTO `agendas` VALUES (3,'Pelatihan simpegnas','pelatihan-simpegnas','coba',NULL,NULL,'2025-06-18 10:09:39','2025-06-20 16:09:46','poster/RTO7nAyn5DmCTGK1It8AmdZpaxayzl-metadGVzLmpwZw==-.jpg','2025-06-16 07:10:04','2025-06-23 06:32:19',NULL,NULL,'vb/lRmXbzIV3YSyGDiqqp654K75rJ9CF6-metaSW1hZ2UyMDI1MDUyMzEwNTYwMC5qcGc=-.jpg',2),(4,'Bimtek E-kinerja Pemerintah Kab. Manokwari','bimtek-e-kinerja-pemerintah-kab-manokwari','ehem',NULL,NULL,'2025-06-23 05:56:56','2025-06-27 20:57:02',NULL,'2025-06-23 11:57:23','2025-06-25 01:33:39',NULL,NULL,NULL,2);
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `att_daftarhadirs`
--

DROP TABLE IF EXISTS `att_daftarhadirs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `att_daftarhadirs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duplikat` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `att_daftarhadirs`
--

LOCK TABLES `att_daftarhadirs` WRITE;
/*!40000 ALTER TABLE `att_daftarhadirs` DISABLE KEYS */;
INSERT INTO `att_daftarhadirs` VALUES (2,'Wilayah kerja kanreg','Wilayah Kerja Kantor Regional XIV BKN',0,'2025-06-23 01:28:07','2025-06-24 11:08:53'),(3,'khusus kanreg','kusususususu',0,'2025-06-23 13:21:08','2025-06-24 11:08:51');
/*!40000 ALTER TABLE `att_daftarhadirs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `instansis`
--

DROP TABLE IF EXISTS `instansis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instansis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `att_id` bigint unsigned NOT NULL,
  `nama_instansi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `att_id` (`att_id`) USING BTREE,
  CONSTRAINT `kum_instansi_id_foreign` FOREIGN KEY (`att_id`) REFERENCES `att_daftarhadirs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instansis`
--

LOCK TABLES `instansis` WRITE;
/*!40000 ALTER TABLE `instansis` DISABLE KEYS */;
INSERT INTO `instansis` VALUES (8,2,'Kanreg XIV BKN','2025-06-23 01:29:22','2025-06-23 01:32:00'),(9,2,'Pemerintah Kab. Manokwari','2025-06-23 01:32:21','2025-06-23 01:32:21'),(10,2,'Pemerintah Kab. Pegunungan Arfak','2025-06-23 01:32:44','2025-06-23 01:32:44'),(11,2,'Pemerintah Kota Sorong','2025-06-23 01:33:00','2025-06-23 01:33:00'),(12,2,'Pemerintah Provinsi Papua Barat','2025-06-23 01:33:19','2025-06-23 01:33:19');
/*!40000 ALTER TABLE `instansis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_adds`
--

DROP TABLE IF EXISTS `link_adds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `link_adds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agenda_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `link_adds_agenda_id_foreign` (`agenda_id`),
  CONSTRAINT `link_adds_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_adds`
--

LOCK TABLES `link_adds` WRITE;
/*!40000 ALTER TABLE `link_adds` DISABLE KEYS */;
INSERT INTO `link_adds` VALUES (1,3,'Link Absensi','https://forms.gle/PDAbra59kByLP4KbA',NULL,0,'2025-06-18 07:13:58','2025-06-18 07:29:01'),(2,3,'download materi','https://drive.google.com/file/d/1PHICcZZ546EWuYaCqOvoY9kQhOCUkBKZ/view?usp=sharing',NULL,1,'2025-06-18 07:28:44','2025-06-18 07:29:00'),(3,3,'Link download','google.drive',NULL,0,'2025-06-18 23:25:13','2025-06-18 23:26:32'),(4,4,'Video kegiatan','link','heroicon-o-video-camera',1,'2025-06-28 05:57:34','2025-07-04 07:33:24'),(5,4,'tambahan','https://www.youtube.com/watch?v=oiWnN1xpEaY&list=RDoiWnN1xpEaY&index=1','heroicon-o-globe-alt',1,'2025-07-09 02:42:59','2025-07-09 02:46:58');
/*!40000 ALTER TABLE `link_adds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materis`
--

DROP TABLE IF EXISTS `materis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agenda_id` bigint unsigned NOT NULL,
  `nama_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materis_agenda_id_foreign` (`agenda_id`),
  CONSTRAINT `materis_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materis`
--

LOCK TABLES `materis` WRITE;
/*!40000 ALTER TABLE `materis` DISABLE KEYS */;
/*!40000 ALTER TABLE `materis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_02_04_042341_create_agendas_table',1),(6,'2025_02_04_043850_create_materis_table',1),(7,'2025_02_06_043045_create_pemateris_table',1),(8,'2025_02_06_043117_create_pesertas_table',1),(9,'2025_02_08_142040_create_permission_tables',1),(10,'2025_02_14_131454_create_notifications_table',1),(11,'2025_02_15_153122_create_surveys_table',1),(12,'2025_02_15_153222_create_survey_questions_table',1),(13,'2025_02_15_153308_create_survey_responses_table',1),(14,'2025_04_09_105414_add_certificate_template_to_agendas_table',1),(15,'2025_04_16_083715_add_linksertifikat_to_agendas_table',1),(16,'2025_06_14_131839_add_harapan_to_pesertas',2),(17,'2025_06_18_123746_add_linkVB_to_agendas_table',3),(18,'2025_06_18_123746_add_vb_to_agendas_table',4),(19,'2025_06_18_154953_create_link_adds_table',5),(20,'2025_06_19_111341_create_kum_instansis_table',6),(21,'2025_06_19_111914_create_instansis_table',6),(22,'2025_06_19_231335_add_kum_instansi_id_to_agendas_table',7),(23,'2025_06_21_095707_create_att_daftarhadirs_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(3,'App\\Models\\User',2),(3,'App\\Models\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('14dec36d-c01f-4538-b6c4-61a6d5e11d1e','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',2,'{\"actions\":[{\"name\":\"lihat\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Lihat\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/agendas\\/2\",\"view\":\"filament-actions::button-action\"}],\"body\":\"Agenda \'Agenda 2\' telah ditambahkan. Segera daftarkan diri anda!\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"title\":\"Agenda Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2025-06-16 05:06:39','2025-06-16 05:06:39'),('2efb455b-7639-4809-b2f3-070be6f92648','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',2,'{\"actions\":[{\"name\":\"lihat\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Lihat\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/agendas\\/4\",\"view\":\"filament-actions::button-action\"}],\"body\":\"Agenda \'Bimtek E-kinerja Pemerintah Kab. Manokwari\' telah ditambahkan. Segera daftarkan diri anda!\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"title\":\"Agenda Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2025-06-23 11:57:24','2025-06-23 11:57:24'),('70d6eb84-2264-4b1c-97d3-4128c7c65235','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',3,'{\"actions\":[{\"name\":\"lihat\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Lihat\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/agendas\\/2\",\"view\":\"filament-actions::button-action\"}],\"body\":\"Agenda \'Agenda 2\' telah ditambahkan. Segera daftarkan diri anda!\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"title\":\"Agenda Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2025-06-16 05:06:39','2025-06-16 05:06:39'),('73fd8368-075f-46b8-912c-b4e531717ebe','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',3,'{\"actions\":[{\"name\":\"lihat\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Lihat\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/agendas\\/3\",\"view\":\"filament-actions::button-action\"}],\"body\":\"Agenda \'Pelatihan simpegnas\' telah ditambahkan. Segera daftarkan diri anda!\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"title\":\"Agenda Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2025-06-16 07:10:04','2025-06-16 07:10:04'),('912d9a7a-91a1-4592-853a-c261e46db9d6','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',3,'{\"actions\":[{\"name\":\"lihat\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Lihat\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/agendas\\/4\",\"view\":\"filament-actions::button-action\"}],\"body\":\"Agenda \'Bimtek E-kinerja Pemerintah Kab. Manokwari\' telah ditambahkan. Segera daftarkan diri anda!\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"title\":\"Agenda Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2025-06-23 11:57:24','2025-06-23 11:57:24'),('923fc65a-abdd-42cb-a880-a36c2afeb8e4','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',2,'{\"actions\":[{\"name\":\"lihat\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Lihat\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/agendas\\/1\",\"view\":\"filament-actions::button-action\"}],\"body\":\"Agenda \'Pelatihan e-Kinerja\' telah ditambahkan. Segera daftarkan diri anda!\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"title\":\"Agenda Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2025-06-12 05:20:11','2025-06-12 05:20:11'),('d2d09f1d-49ff-4d1c-83f3-aefe1c8117e5','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',3,'{\"actions\":[{\"name\":\"lihat\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Lihat\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/agendas\\/1\",\"view\":\"filament-actions::button-action\"}],\"body\":\"Agenda \'Pelatihan e-Kinerja\' telah ditambahkan. Segera daftarkan diri anda!\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"title\":\"Agenda Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2025-06-12 05:20:11','2025-06-12 05:20:11'),('f65db11f-baef-45aa-815d-79db3360bba6','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',2,'{\"actions\":[{\"name\":\"lihat\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Lihat\",\"shouldClose\":false,\"shouldMarkAsRead\":true,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/agendas\\/3\",\"view\":\"filament-actions::button-action\"}],\"body\":\"Agenda \'Pelatihan simpegnas\' telah ditambahkan. Segera daftarkan diri anda!\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"title\":\"Agenda Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2025-06-16 07:10:04','2025-06-16 07:10:04');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemateris`
--

DROP TABLE IF EXISTS `pemateris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pemateris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `agenda_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pemateris_agenda_id_foreign` (`agenda_id`),
  KEY `pemateris_user_id_foreign` (`user_id`),
  CONSTRAINT `pemateris_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pemateris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemateris`
--

LOCK TABLES `pemateris` WRITE;
/*!40000 ALTER TABLE `pemateris` DISABLE KEYS */;
/*!40000 ALTER TABLE `pemateris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view users','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(2,'create users','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(3,'edit users','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(4,'delete users','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(5,'restore users','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(6,'force delete users','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(7,'view roles','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(8,'create roles','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(9,'edit roles','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(10,'delete roles','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(11,'restore roles','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(12,'force delete roles','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(13,'view permission','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(14,'create permission','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(15,'edit permission','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(16,'delete permission','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(17,'restore permission','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(18,'force delete permission','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(19,'view agenda','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(20,'create agenda','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(21,'edit agenda','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(22,'delete agenda','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(23,'restore agenda','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(24,'force delete agenda','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(25,'view materi','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(26,'create materi','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(27,'edit materi','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(28,'delete materi','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(29,'restore materi','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(30,'force delete materi','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(31,'view survey','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(32,'create survey','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(33,'edit survey','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(34,'delete survey','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(35,'restore survey','web','2025-06-12 05:19:02','2025-06-12 05:19:02'),(36,'force delete survey','web','2025-06-12 05:19:02','2025-06-12 05:19:02');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesertas`
--

DROP TABLE IF EXISTS `pesertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pesertas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `agenda_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harapan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pesertas_agenda_id_foreign` (`agenda_id`),
  KEY `pesertas_user_id_foreign` (`user_id`),
  CONSTRAINT `pesertas_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pesertas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesertas`
--

LOCK TABLES `pesertas` WRITE;
/*!40000 ALTER TABLE `pesertas` DISABLE KEYS */;
INSERT INTO `pesertas` VALUES (4,NULL,3,'2025-06-16 08:07:42','2025-06-16 08:07:42','199308012022031001','Taufik Iriando','Pemerintah Kab. Manokwari','Analis Sistem informasi dan Jaringan','082393101841','admin@gmail.com','adsfsadf'),(5,NULL,3,'2025-06-16 08:17:00','2025-06-16 08:17:00','198201062008032002','Dian Violora Nainggolan','Badan Kepegawaian Negara RI','Analis Sistem informasi dan Jaringan','082393101841','martajambuani@gmail.com','fasdf'),(6,NULL,3,'2025-06-19 14:31:46','2025-06-19 14:31:46','198910132015032005','Muslimin','Pemerintah Provinsi Papua Barat','Kepala Seksi','082393101841','muslimin@gmail.com','mantap'),(7,NULL,3,'2025-06-19 15:21:45','2025-06-19 15:21:45','199308012022041002','Rina','Kantor Regional XIV BKN Manokwari','Penata kelola Arsip','082393101841','rina@bkn.go.id','Apa sih?'),(8,NULL,4,'2025-06-23 12:39:49','2025-06-23 12:39:49','199308012022031001','Ledi Riyani Ayhuan','Pemerintah Kota Sorong','Kepala Seksi','082393101841','admin@examples','jjjjj'),(9,NULL,4,'2025-06-23 12:49:45','2025-06-23 12:49:45','199702092019022005','Rina','Pemerintah Kab. Pegunungan Arfak','Pengadministrasi umum','082393101841','rina@bkn.go.id','Joss!'),(10,NULL,4,'2025-06-23 12:58:20','2025-06-23 12:58:20','199308012022031001','Ledi Riyani Ayhuan','Pemerintah Kota Sorong','Kepala Seksi','082393101841','taufik.iriando@bkn.go.id','kjkjnkj');
/*!40000 ALTER TABLE `pesertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(19,2),(22,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(19,3),(25,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2025-06-12 05:19:01','2025-06-12 05:19:01'),(2,'pemateri','web','2025-06-12 05:19:01','2025-06-12 05:19:01'),(3,'peserta','web','2025-06-12 05:19:01','2025-06-12 05:19:01');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_questions`
--

DROP TABLE IF EXISTS `survey_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `survey_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `survey_id` bigint unsigned NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','multiple_choice','rating','checkbox') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `options` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_questions_survey_id_foreign` (`survey_id`),
  CONSTRAINT `survey_questions_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_questions`
--

LOCK TABLES `survey_questions` WRITE;
/*!40000 ALTER TABLE `survey_questions` DISABLE KEYS */;
INSERT INTO `survey_questions` VALUES (5,5,'Anda puas?','multiple_choice','\"[\\\"puas\\\",\\\" tidak puas\\\"]\"','2025-06-16 07:11:06','2025-06-16 07:11:06'),(6,5,'kritik dan saran?','text',NULL,'2025-06-16 07:11:25','2025-06-16 07:11:25'),(7,6,'penghasilan anda?','multiple_choice','\"[\\\"1\\\",\\\"2\\\",\\\"3\\\"]\"','2025-06-16 07:12:35','2025-06-16 07:12:35'),(8,7,'Salah satu hal yang tidak terdapat di PermenPANRB Nomor 6 Tahun 2022 tentang Pengelolaan Kinerja Pegawai ASN yaitu ….','multiple_choice','\"[\\\"Ekspetasi pimpinan\\\",\\\" ekspektasi bawahan\\\",\\\" dialog kinerja\\\",\\\" penyusunan secara top-down\\\"]\"','2025-06-24 00:07:26','2025-06-24 00:07:26'),(9,7,'Dalam penyusunan SKP berdasarkan PermenPANRB Nomor 6 Tahun 2022 tentang Pengelolaan Kinerja Pegawai ASN, bahasa indikator kinerja harus ….','multiple_choice','\"[\\\"Bahasa aktivitas\\\",\\\" Bahasa output\\\",\\\" Bahasa teknis internal\\\",\\\" Bahasa naratif\\\"]\"','2025-06-24 00:08:01','2025-06-24 00:08:01'),(10,7,'Perilaku kerja pegawai dalam PermenPANRB Nomor 6 Tahun 2022 tentang Pengelolaan Kinerja Pegawai ASN disingkat dengan sebutan …','multiple_choice','\"[\\\"ANEKA\\\",\\\" Kinerja\\\",\\\" SKP\\\",\\\" BERAKHLAK\\\"]\"','2025-06-24 00:09:10','2025-06-24 00:09:10');
/*!40000 ALTER TABLE `survey_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_responses`
--

DROP TABLE IF EXISTS `survey_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `survey_responses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `survey_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `question_id` bigint unsigned NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_responses_survey_id_foreign` (`survey_id`),
  KEY `survey_responses_user_id_foreign` (`user_id`),
  KEY `survey_responses_question_id_foreign` (`question_id`),
  CONSTRAINT `survey_responses_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `survey_questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `survey_responses_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  CONSTRAINT `survey_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_responses`
--

LOCK TABLES `survey_responses` WRITE;
/*!40000 ALTER TABLE `survey_responses` DISABLE KEYS */;
INSERT INTO `survey_responses` VALUES (2,5,NULL,5,'puas','2025-06-16 07:56:54','2025-06-16 07:56:54'),(3,5,NULL,6,'asdfdasf','2025-06-16 07:56:54','2025-06-16 07:56:54'),(4,6,NULL,7,'1','2025-06-16 08:00:03','2025-06-16 08:00:03'),(5,5,NULL,5,'puas','2025-06-23 13:24:23','2025-06-23 13:24:23'),(6,5,NULL,6,'bla bla bla','2025-06-23 13:24:23','2025-06-23 13:24:23'),(7,7,NULL,8,'ekspektasi bawahan','2025-06-24 00:11:50','2025-06-24 00:11:50'),(8,7,NULL,9,'Bahasa output','2025-06-24 00:11:50','2025-06-24 00:11:50'),(9,7,NULL,10,'ANEKA','2025-06-24 00:11:50','2025-06-24 00:11:50');
/*!40000 ALTER TABLE `survey_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `surveys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agenda_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `surveys_slug_unique` (`slug`),
  KEY `surveys_agenda_id_foreign` (`agenda_id`),
  CONSTRAINT `surveys_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (5,4,'Survey kepuasan peserta','survey-kepuasan-peserta','d',1,'2025-06-16 07:10:30','2025-06-23 13:24:04'),(6,3,'Survey Kesejahteraan','survey-kesejahteraan','penghasilan anda?',0,'2025-06-16 07:12:02','2025-06-18 00:48:52'),(7,4,'Post Test Bimtek','post-test-bimtek','untuk mengetes pengetahuan peserta',1,'2025-06-24 00:05:00','2025-06-24 00:10:21');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_nip_unique` (`nip`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','199308012022031001','taufik.iriando@gmail.com',NULL,'$2y$12$0trr9uI8KB7LjhQHCb4pQuj5d0yAGj8oyKqvjuFzXG0l4o.uUPOlK',NULL,'2025-06-12 05:19:01','2025-06-12 05:19:01'),(2,'dian','199008012022032001','dian@gmail.com',NULL,'$2y$12$82tHHtGhdu0cLb.GpKjJHu2M5bo1s2IOQ9zwkPQmRbjZjqlrB0CtC',NULL,'2025-06-12 05:19:01','2025-06-12 05:19:01'),(3,'hendra','198702012018011001','hendra@gmail.com',NULL,'$2y$12$eibYnA.jNI1FDz0xsLEuIu42WJvfT3Ea/bPfcSBNcwDGxIcJarwmO',NULL,'2025-06-12 05:19:02','2025-06-12 05:19:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-09 12:17:59
