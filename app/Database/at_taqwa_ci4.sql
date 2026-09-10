-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: at_taqwa_ci4
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `link_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_notifikasi`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifikasi`
--

LOCK TABLES `notifikasi` WRITE;
/*!40000 ALTER TABLE `notifikasi` DISABLE KEYS */;
INSERT INTO `notifikasi` VALUES (1,2,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(2,3,'Alhamdulillah tabungan qurban Anda telah mencapai target (Lunas). Semoga berkah!',0,'warga/history','2026-09-10 11:48:51'),(3,4,'Alhamdulillah tabungan qurban Anda telah mencapai target (Lunas). Semoga berkah!',0,'warga/history','2026-09-10 11:48:51'),(4,5,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(5,6,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(6,7,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(7,8,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(8,9,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(9,10,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(10,11,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(11,12,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(12,13,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(13,14,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(14,15,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(15,16,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(16,17,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(17,18,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(18,19,'Alhamdulillah tabungan qurban Anda telah mencapai target (Lunas). Semoga berkah!',0,'warga/history','2026-09-10 11:48:51'),(19,20,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(20,21,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(21,22,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(22,23,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(23,24,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(24,25,'Setoran rutin bulan berjalan telah tercatat di kas pengurus. Cek riwayat tabungan Anda.',0,'warga/history','2026-09-10 11:48:51'),(25,26,'Alhamdulillah tabungan qurban Anda telah mencapai target (Lunas). Semoga berkah!',0,'warga/history','2026-09-10 11:48:51');
/*!40000 ALTER TABLE `notifikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setoran`
--

DROP TABLE IF EXISTS `setoran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setoran` (
  `id_setoran` int(11) NOT NULL AUTO_INCREMENT,
  `id_warga` int(11) NOT NULL,
  `kode_trx` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `metode` varchar(50) NOT NULL DEFAULT 'Transfer bank',
  `nominal` decimal(12,2) NOT NULL,
  `status` enum('Berhasil','Pending','Ditolak') NOT NULL DEFAULT 'Berhasil',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_setoran`),
  UNIQUE KEY `kode_trx` (`kode_trx`),
  KEY `id_warga` (`id_warga`),
  CONSTRAINT `setoran_ibfk_1` FOREIGN KEY (`id_warga`) REFERENCES `warga` (`id_warga`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setoran`
--

LOCK TABLES `setoran` WRITE;
/*!40000 ALTER TABLE `setoran` DISABLE KEYS */;
INSERT INTO `setoran` VALUES (1,1,'TRX-26041001','2026-04-12','Setoran awal April','Transfer BSI',350000.00,'Berhasil','2026-04-12 04:20:34'),(2,1,'TRX-26051002','2026-05-10','Setoran rutin Mei','Transfer BSI',350000.00,'Berhasil','2026-05-10 05:27:49'),(3,1,'TRX-26061003','2026-06-11','Setoran rutin Juni','Transfer BSI',350000.00,'Berhasil','2026-06-11 09:59:35'),(4,1,'TRX-26071004','2026-07-09','Setoran rutin Juli','Transfer BSI',350000.00,'Berhasil','2026-07-09 10:39:56'),(5,1,'TRX-26081005','2026-08-10','Setoran rutin Agustus','Transfer BSI',350000.00,'Berhasil','2026-08-10 05:55:53'),(6,1,'TRX-26091006','2026-09-08','Setoran rutin September','Transfer BSI',350000.00,'Berhasil','2026-09-08 02:43:33'),(7,2,'TRX-26041007','2026-04-05','Setoran pembuka April','Transfer BSI',5000000.00,'Berhasil','2026-04-05 02:43:45'),(8,2,'TRX-26051008','2026-05-02','Setoran Mei','Transfer BSI',5000000.00,'Berhasil','2026-05-02 08:14:37'),(9,2,'TRX-26061009','2026-06-03','Setoran Juni','Transfer BSI',5000000.00,'Berhasil','2026-06-03 10:55:31'),(10,2,'TRX-26071010','2026-07-04','Setoran Juli','Transfer BSI',5000000.00,'Berhasil','2026-07-04 06:52:59'),(11,2,'TRX-26081011','2026-08-01','Pelunasan Agustus','Transfer BSI',5000000.00,'Berhasil','2026-08-01 02:31:42'),(12,3,'TRX-26041012','2026-04-15','Setoran April','Tunai ke Pengurus',1000000.00,'Berhasil','2026-04-15 02:51:29'),(13,3,'TRX-26051013','2026-05-18','Setoran Mei','Tunai ke Pengurus',1000000.00,'Berhasil','2026-05-18 01:27:22'),(14,3,'TRX-26061014','2026-06-15','Setoran Juni','Tunai ke Pengurus',1000000.00,'Berhasil','2026-06-15 03:32:34'),(15,3,'TRX-26071015','2026-07-20','Pelunasan Juli','Tunai ke Pengurus',500000.00,'Berhasil','2026-07-20 04:40:30'),(16,4,'TRX-26041016','2026-04-20','Setoran awal','Transfer BSI',700000.00,'Berhasil','2026-04-20 03:36:11'),(17,4,'TRX-26051017','2026-05-20','Setoran Mei','Transfer BSI',700000.00,'Berhasil','2026-05-20 01:27:32'),(18,4,'TRX-26061018','2026-06-20','Setoran Juni','Transfer BSI',700000.00,'Berhasil','2026-06-20 09:16:17'),(19,4,'TRX-26071019','2026-07-20','Setoran Juli','Transfer BSI',700000.00,'Berhasil','2026-07-20 09:39:22'),(20,5,'TRX-26041020','2026-04-14','Setoran April','Transfer BSI',500000.00,'Berhasil','2026-04-14 10:52:24'),(21,5,'TRX-26051021','2026-05-14','Setoran Mei','Transfer BSI',500000.00,'Berhasil','2026-05-14 07:34:45'),(22,5,'TRX-26061022','2026-06-14','Setoran Juni','Transfer BSI',500000.00,'Berhasil','2026-06-14 04:37:24'),(23,5,'TRX-26071023','2026-07-14','Setoran Juli','Transfer BSI',500000.00,'Berhasil','2026-07-14 06:26:55'),(24,6,'TRX-26051024','2026-05-05','Tabungan Mei','Transfer BSI',500000.00,'Berhasil','2026-05-05 09:13:50'),(25,6,'TRX-26061025','2026-06-05','Tabungan Juni','Transfer BSI',500000.00,'Berhasil','2026-06-05 03:38:18'),(26,6,'TRX-26071026','2026-07-05','Tabungan Juli','Transfer BSI',500000.00,'Berhasil','2026-07-05 10:21:58'),(27,6,'TRX-26081027','2026-08-05','Tabungan Agustus','Transfer BSI',500000.00,'Berhasil','2026-08-05 04:55:17'),(28,6,'TRX-26091028','2026-09-05','Tabungan September','Transfer BSI',500000.00,'Berhasil','2026-09-05 02:27:30'),(29,7,'TRX-26041029','2026-04-25','Setoran 1','Transfer BSI',600000.00,'Berhasil','2026-04-25 08:22:46'),(30,7,'TRX-26051030','2026-05-25','Setoran 2','Transfer BSI',600000.00,'Berhasil','2026-05-25 07:58:37'),(31,7,'TRX-26061031','2026-06-25','Setoran 3','Transfer BSI',600000.00,'Berhasil','2026-06-25 09:18:36'),(32,7,'TRX-26071032','2026-07-25','Setoran 4','Transfer BSI',600000.00,'Berhasil','2026-07-25 09:22:27'),(33,7,'TRX-26081033','2026-08-25','Setoran 5','Transfer BSI',600000.00,'Berhasil','2026-08-25 10:24:10'),(34,8,'TRX-26051034','2026-05-12','Setoran Mei','Transfer BSI',500000.00,'Berhasil','2026-05-12 08:18:23'),(35,8,'TRX-26061035','2026-06-12','Setoran Juni','Transfer BSI',500000.00,'Berhasil','2026-06-12 04:34:26'),(36,8,'TRX-26071036','2026-07-12','Setoran Juli','Transfer BSI',500000.00,'Berhasil','2026-07-12 06:16:38'),(37,8,'TRX-26091037','2026-09-09','Setoran rutin September','Transfer BSI',350000.00,'Pending','2026-09-09 05:39:32'),(38,9,'TRX-26061038','2026-06-10','Setoran Juni','Tunai ke Pengurus',500000.00,'Berhasil','2026-06-10 08:32:12'),(39,9,'TRX-26071039','2026-07-10','Setoran Juli','Tunai ke Pengurus',500000.00,'Berhasil','2026-07-10 03:41:44'),(40,9,'TRX-26081040','2026-08-10','Setoran Agustus','Tunai ke Pengurus',500000.00,'Berhasil','2026-08-10 05:51:39'),(41,10,'TRX-26051041','2026-05-15','Setoran 1','Transfer BSI',500000.00,'Berhasil','2026-05-15 06:49:42'),(42,10,'TRX-26061042','2026-06-15','Setoran 2','Transfer BSI',500000.00,'Berhasil','2026-06-15 01:55:35'),(43,10,'TRX-26071043','2026-07-15','Setoran 3','Transfer BSI',500000.00,'Berhasil','2026-07-15 04:57:26'),(44,11,'TRX-26061044','2026-06-08','Setoran Juni','Transfer BSI',350000.00,'Berhasil','2026-06-08 01:43:56'),(45,11,'TRX-26071045','2026-07-08','Setoran Juli','Transfer BSI',350000.00,'Berhasil','2026-07-08 01:36:31'),(46,11,'TRX-26081046','2026-08-08','Setoran Agustus','Transfer BSI',350000.00,'Berhasil','2026-08-08 09:37:25'),(47,12,'TRX-26071047','2026-07-12','Setoran Juli','Transfer BSI',500000.00,'Berhasil','2026-07-12 06:28:32'),(48,12,'TRX-26081048','2026-08-12','Setoran Agustus','Transfer BSI',500000.00,'Berhasil','2026-08-12 07:54:25'),(49,13,'TRX-26041049','2026-04-18','Setoran awal April','Tunai ke Pengurus',500000.00,'Berhasil','2026-04-18 06:35:58'),(50,14,'TRX-26051050','2026-05-02','Setoran awal Mei','Transfer BSI',400000.00,'Berhasil','2026-05-02 02:39:37'),(51,15,'TRX-26051051','2026-05-19','Setoran awal Mei','Transfer BSI',350000.00,'Berhasil','2026-05-19 06:20:54'),(52,16,'TRX-26051052','2026-05-22','Setoran Mei','Transfer BSI',500000.00,'Berhasil','2026-05-22 10:37:24'),(53,16,'TRX-26061053','2026-06-22','Setoran Juni','Transfer BSI',500000.00,'Berhasil','2026-06-22 07:45:51'),(54,16,'TRX-26071054','2026-07-22','Setoran Juli','Transfer BSI',500000.00,'Berhasil','2026-07-22 07:56:32'),(55,16,'TRX-26081055','2026-08-22','Setoran Agustus','Transfer BSI',500000.00,'Berhasil','2026-08-22 09:22:57'),(56,17,'TRX-26041056','2026-04-28','Setoran April','Transfer BSI',500000.00,'Berhasil','2026-04-28 07:37:12'),(57,17,'TRX-26051057','2026-05-28','Setoran Mei','Transfer BSI',500000.00,'Berhasil','2026-05-28 06:48:30'),(58,17,'TRX-26061058','2026-06-28','Setoran Juni','Transfer BSI',500000.00,'Berhasil','2026-06-28 09:59:36'),(59,17,'TRX-26071059','2026-07-28','Setoran Juli','Transfer BSI',500000.00,'Berhasil','2026-07-28 02:36:43'),(60,17,'TRX-26091060','2026-09-10','Setoran September','Transfer BSI',500000.00,'Pending','2026-09-10 08:39:10'),(61,18,'TRX-26041061','2026-04-10','Setoran 1','Transfer BSI',1000000.00,'Berhasil','2026-04-10 03:15:27'),(62,18,'TRX-26051062','2026-05-10','Setoran 2','Transfer BSI',1000000.00,'Berhasil','2026-05-10 06:57:18'),(63,18,'TRX-26061063','2026-06-10','Setoran 3','Transfer BSI',1000000.00,'Berhasil','2026-06-10 05:35:46'),(64,18,'TRX-26071064','2026-07-10','Pelunasan','Transfer BSI',500000.00,'Berhasil','2026-07-10 09:14:45'),(65,19,'TRX-26041065','2026-04-17','Setoran 1','Transfer BSI',700000.00,'Berhasil','2026-04-17 02:31:10'),(66,19,'TRX-26051066','2026-05-17','Setoran 2','Transfer BSI',700000.00,'Berhasil','2026-05-17 05:22:37'),(67,19,'TRX-26061067','2026-06-17','Setoran 3','Transfer BSI',700000.00,'Berhasil','2026-06-17 01:52:32'),(68,19,'TRX-26071068','2026-07-17','Setoran 4','Transfer BSI',700000.00,'Berhasil','2026-07-17 10:14:30'),(69,19,'TRX-26091069','2026-09-10','Setoran rutin September','Transfer BSI',350000.00,'Pending','2026-09-10 09:29:38'),(70,20,'TRX-26051070','2026-05-04','Tabungan Mei','Transfer BSI',600000.00,'Berhasil','2026-05-04 08:51:25'),(71,20,'TRX-26061071','2026-06-04','Tabungan Juni','Transfer BSI',600000.00,'Berhasil','2026-06-04 06:10:54'),(72,20,'TRX-26071072','2026-07-04','Tabungan Juli','Transfer BSI',600000.00,'Berhasil','2026-07-04 08:39:35'),(73,20,'TRX-26091073','2026-09-09','Setoran tunai September','Tunai ke Pengurus',300000.00,'Pending','2026-09-09 02:17:54'),(74,21,'TRX-26041074','2026-04-02','Setoran 1','Transfer BSI',3500000.00,'Berhasil','2026-04-02 02:15:22'),(75,21,'TRX-26051075','2026-05-02','Setoran 2','Transfer BSI',3500000.00,'Berhasil','2026-05-02 08:54:52'),(76,21,'TRX-26061076','2026-06-02','Setoran 3','Transfer BSI',3500000.00,'Berhasil','2026-06-02 07:55:55'),(77,21,'TRX-26071077','2026-07-02','Setoran 4','Transfer BSI',3500000.00,'Berhasil','2026-07-02 09:27:29'),(78,21,'TRX-26081078','2026-08-02','Setoran 5','Transfer BSI',3500000.00,'Berhasil','2026-08-02 08:25:13'),(79,22,'TRX-26051079','2026-05-16','Setoran Mei','Transfer BSI',700000.00,'Berhasil','2026-05-16 04:15:25'),(80,22,'TRX-26061080','2026-06-16','Setoran Juni','Transfer BSI',700000.00,'Berhasil','2026-06-16 03:51:49'),(81,22,'TRX-26071081','2026-07-16','Setoran Juli','Transfer BSI',700000.00,'Berhasil','2026-07-16 08:52:58'),(82,23,'TRX-26061082','2026-06-07','Setoran Juni','Transfer BSI',700000.00,'Berhasil','2026-06-07 03:37:15'),(83,23,'TRX-26071083','2026-07-07','Setoran Juli','Transfer BSI',700000.00,'Berhasil','2026-07-07 05:44:50'),(84,24,'TRX-26061084','2026-06-18','Setoran 1','Transfer BSI',300000.00,'Berhasil','2026-06-18 05:36:15'),(85,24,'TRX-26071085','2026-07-18','Setoran 2','Transfer BSI',300000.00,'Berhasil','2026-07-18 07:47:26'),(86,24,'TRX-26081086','2026-08-18','Setoran 3','Transfer BSI',300000.00,'Berhasil','2026-08-18 09:21:53'),(87,25,'TRX-26041087','2026-04-14','Setoran April','Transfer BSI',1000000.00,'Berhasil','2026-04-14 02:47:50'),(88,25,'TRX-26051088','2026-05-14','Setoran Mei','Transfer BSI',1000000.00,'Berhasil','2026-05-14 03:50:58'),(89,25,'TRX-26061089','2026-06-14','Setoran Juni','Transfer BSI',1000000.00,'Berhasil','2026-06-14 07:38:33'),(90,25,'TRX-26071090','2026-07-14','Pelunasan Juli','Transfer BSI',500000.00,'Berhasil','2026-07-14 05:47:26');
/*!40000 ALTER TABLE `setoran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','warga') NOT NULL DEFAULT 'warga',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$yc9VbVNoYYK.l76VD/99AuhA9VllCnpZFniNljZz..T5alHHrzgV2','Pak Fauzan','admin','2026-08-20 03:25:43'),(2,'warga','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Ahmad Syafi\'i','warga','2026-09-10 11:48:51'),(3,'rahmat','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','H. Rahmat Hidayat','warga','2026-09-10 11:48:51'),(4,'nurul','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Hj. Nurul Hidayati','warga','2026-09-10 11:48:51'),(5,'bambang','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Bambang Pratama','warga','2026-09-10 11:48:51'),(6,'hendra','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Hendra Kurniawan','warga','2026-09-10 11:48:51'),(7,'dewi','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Dewi Lestari','warga','2026-09-10 11:48:51'),(8,'ridwan','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Muhammad Ridwan','warga','2026-09-10 11:48:51'),(9,'eko','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Eko Wahyudi','warga','2026-09-10 11:48:51'),(10,'sri','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Sri Wahyuni','warga','2026-09-10 11:48:51'),(11,'agus','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Agus Supriyadi','warga','2026-09-10 11:48:51'),(12,'handoko','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Tri Handoko','warga','2026-09-10 11:48:51'),(13,'rina','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Rina Kusuma','warga','2026-09-10 11:48:51'),(14,'dedi','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Dedi Supriadi','warga','2026-09-10 11:48:51'),(15,'maya','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Maya Anggraini','warga','2026-09-10 11:48:51'),(16,'fajar','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Fajar Nugroho','warga','2026-09-10 11:48:51'),(17,'yuni','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Yuni Astuti','warga','2026-09-10 11:48:51'),(18,'arif','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Arif Wibowo','warga','2026-09-10 11:48:51'),(19,'fitri','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Fitri Rahmawati','warga','2026-09-10 11:48:51'),(20,'danang','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Danang Prasetyo','warga','2026-09-10 11:48:51'),(21,'indah','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Indah Permatasari','warga','2026-09-10 11:48:51'),(22,'slamet','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Slamet Riyadi','warga','2026-09-10 11:48:51'),(23,'anisa','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Anisa Putri','warga','2026-09-10 11:48:51'),(24,'suryono','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Suryono','warga','2026-09-10 11:48:51'),(25,'ratna','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Ratna Sari','warga','2026-09-10 11:48:51'),(26,'teguh','$2y$10$Y/4qyVZ6zThJ.SvWIhGW5e2AkuReu9a6IpL4pjH.LCDWekE2yTNuO','Teguh Iman','warga','2026-09-10 11:48:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warga`
--

DROP TABLE IF EXISTS `warga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warga` (
  `id_warga` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `rt_rw` varchar(20) NOT NULL DEFAULT 'RT 04',
  `saldo_tabungan` decimal(12,2) NOT NULL DEFAULT 0.00,
  `target_qurban` decimal(12,2) NOT NULL DEFAULT 12500000.00,
  `jenis_qurban` varchar(50) NOT NULL DEFAULT 'Sapi Kolektif',
  `status` enum('Aktif','Lunas','Perlu diingatkan') NOT NULL DEFAULT 'Aktif',
  PRIMARY KEY (`id_warga`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `warga_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warga`
--

LOCK TABLES `warga` WRITE;
/*!40000 ALTER TABLE `warga` DISABLE KEYS */;
INSERT INTO `warga` VALUES (1,2,'081234567890','RT 04',2100000.00,3500000.00,'Sapi Kolektif','Aktif'),(2,3,'081298765432','RT 01',25000000.00,25000000.00,'Sapi Utuh','Lunas'),(3,4,'081345678901','RT 02',3500000.00,3500000.00,'Kambing','Lunas'),(4,5,'081223344556','RT 03',2800000.00,3500000.00,'Sapi Kolektif','Aktif'),(5,6,'081334455667','RT 04',2000000.00,3500000.00,'Sapi Kolektif','Aktif'),(6,7,'081445566778','RT 01',2500000.00,3000000.00,'Kambing','Aktif'),(7,8,'081556677889','RT 02',3000000.00,3500000.00,'Kambing','Aktif'),(8,9,'081667788990','RT 03',1500000.00,3500000.00,'Sapi Kolektif','Aktif'),(9,10,'081778899001','RT 05',1500000.00,3000000.00,'Kambing','Aktif'),(10,11,'081889900112','RT 04',1500000.00,3500000.00,'Sapi Kolektif','Aktif'),(11,12,'081990011223','RT 02',1050000.00,3500000.00,'Sapi Kolektif','Aktif'),(12,13,'081112233445','RT 06',1000000.00,3000000.00,'Kambing','Aktif'),(13,14,'081223344550','RT 03',500000.00,3500000.00,'Kambing','Perlu diingatkan'),(14,15,'081334455661','RT 05',400000.00,3000000.00,'Kambing','Perlu diingatkan'),(15,16,'081445566772','RT 02',350000.00,3500000.00,'Sapi Kolektif','Perlu diingatkan'),(16,17,'081556677883','RT 06',2000000.00,3000000.00,'Kambing','Aktif'),(17,18,'081667788994','RT 04',2000000.00,3500000.00,'Sapi Kolektif','Aktif'),(18,19,'081778899005','RT 01',3500000.00,3500000.00,'Kambing','Lunas'),(19,20,'081889900116','RT 03',2800000.00,3500000.00,'Sapi Kolektif','Aktif'),(20,21,'081990011227','RT 05',1800000.00,3000000.00,'Kambing','Aktif'),(21,22,'081112233448','RT 02',17500000.00,25000000.00,'Sapi Utuh','Aktif'),(22,23,'081223344559','RT 04',2100000.00,3500000.00,'Kambing','Aktif'),(23,24,'081334455660','RT 06',1400000.00,3500000.00,'Sapi Kolektif','Aktif'),(24,25,'081445566771','RT 01',900000.00,3000000.00,'Kambing','Aktif'),(25,26,'081556677882','RT 03',3500000.00,3500000.00,'Sapi Kolektif','Lunas');
/*!40000 ALTER TABLE `warga` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-10 18:51:25
