-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: project3
-- ------------------------------------------------------
-- Server version	5.7.15-log

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `MaNguoiComment_idx` (`user_id`),
  KEY `MaBaiDang_comments_fk_idx` (`post_id`),
  CONSTRAINT `MaBaiDang_comments_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `MaNguoiComment_comments_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'toan',1,'2017-12-13 00:48:15','Hay lắm ô! Đồ án này ô gánh team hết nhé'),(2,'anhtu',1,'2017-12-13 00:48:46','OK, t gánh hết. Dễ mà :v'),(4,'huy',1,'2017-12-13 00:49:22','Nhóm này ghê vl. 3 tuần cũng làm xong đồ án 3'),(5,'anhtu',14,'2017-12-14 22:45:56','Hehehe'),(6,'anhtu',14,'2017-12-14 23:08:46','hahaha :D'),(8,'anhtu',14,'2017-12-14 23:09:16','sao vay?'),(10,'anhtu',14,'2017-12-14 23:10:54','tai sao>?'),(11,'toan',14,'2017-12-14 23:15:21','Ô ghê đấy!'),(12,'toan',14,'2017-12-14 23:15:51','Hôm nào lên TC chỉ cho t code nhé'),(13,'anhtu',14,'2017-12-14 23:15:58','OK'),(37,'anhtu',15,'2017-12-14 23:42:14','aston martin vulcan'),(38,'anhtu',15,'2017-12-14 23:42:36','Trion Nemesis'),(39,'anhtu',15,'2017-12-14 23:43:41','Lamborgini???'),(40,'anhtu',15,'2017-12-14 23:46:51','Chevoret'),(41,'anhtu',15,'2017-12-14 23:46:51','Chevoret'),(42,'anhtu',15,'2017-12-14 23:47:11','Chevoret'),(43,'anhtu',15,'2017-12-14 23:50:41','Hay vl'),(44,'anhtu',15,'2017-12-14 23:51:59','wtf'),(49,'anhtu',15,'2017-12-15 00:02:17','try it'),(50,'anhtu',15,'2017-12-16 15:37:11','Ghê vl :v'),(51,'anhtu',22,'2017-12-16 16:03:08','alo'),(58,'admin',22,'2017-12-21 00:48:11','Demo jsonp: lan thu 2'),(65,'huy',25,'2017-12-21 14:38:13','This is a demo of key event'),(66,'huy',25,'2017-12-21 14:38:31','Huy gà xem nè!'),(67,'huy',25,'2017-12-21 14:39:18','Demo khi ấn enter sẽ comment<br>This is demo, hehehe'),(68,'admin',25,'2017-12-21 14:39:47','Huy gà biến đê :v'),(69,'admin',25,'2017-12-21 14:43:32','Lets goare eao eora'),(71,'admin',25,'2017-12-21 14:56:41','fewfkoafepofefe few'),(72,'admin',25,'2017-12-21 14:58:04','this is demofewal ewaplewalf'),(73,'admin',25,'2017-12-21 14:59:01','teiwalep fekakefa feowa'),(74,'admin',25,'2017-12-21 15:03:07','afnewk kefalfle feoepw'),(75,'admin',25,'2017-12-21 15:05:18','theiwa effeplkfe'),(76,'admin',25,'2017-12-21 15:06:02','felwpaanhtu'),(77,'admin',25,'2017-12-21 15:06:07','fefaewanhtufefew'),(78,'admin',25,'2017-12-21 15:42:35','tiew fewoa anhtudwlf dlfwef'),(79,'admin',25,'2017-12-21 15:48:51','feafewanhtu'),(80,'admin',NULL,'2017-12-21 15:50:24','demoanhtu'),(81,'admin',NULL,'2017-12-21 15:50:44','demo 2anhtu'),(82,'admin',25,'2017-12-21 23:42:49','Hay chua?<br />ko hay<br />wtf!!!<br />'),(83,'admin',15,'2017-12-21 23:46:10','using regex<br />to replace new line<br />to br tag<br />'),(84,'admin',15,'2017-12-22 00:03:05','Let\'s try this\' anhtu\'<br />haha\' hehe<br />'),(85,'admin',15,'2017-12-22 00:03:22','Let\'s try this again<br />heheH<br />haha<br />'),(92,'admin',15,'2017-12-22 00:30:24','Let\'s try this again<br />heheH<br />haha<br />'),(94,'admin',15,'2017-12-22 00:32:55','Let\'s try this again<br />heheH<br />haha<br />'),(97,'admin',15,'2017-12-22 00:41:07','Let\'s try this again<br />heheH<br />haha<br />'),(101,'anhtu',22,'2017-12-22 17:55:34','demo comment<br />'),(102,'anhtu',22,'2017-12-22 17:55:38','demo'),(105,'admin',28,'2017-12-23 15:05:57','demo<br />'),(108,'admin',27,'2017-12-23 15:09:10','alo<br />'),(110,'admin',28,'2017-12-23 15:21:16','demo<br />'),(111,'admin',28,'2017-12-23 15:28:45','this is demo'),(161,'admin',23,'2017-12-23 18:09:38','demo'),(162,'admin',23,'2017-12-23 18:10:24','haha haha'),(163,'admin',23,'2017-12-23 18:15:46','heh hehe'),(164,'admin',23,'2017-12-23 18:21:32','feakfk fak'),(166,'admin',23,'2017-12-23 18:23:41','Cuối cùng cũng thành công phần insert comment!!!'),(167,'admin',23,'2017-12-23 18:23:53','Hay lắm!!!'),(170,'anhtu',27,'2017-12-24 01:04:45','hehe'),(171,'anhtu',28,'2017-12-24 16:47:54','heheeh'),(172,'anhtu',28,'2017-12-24 16:49:52','wtf???'),(173,'anhtu',28,'2017-12-24 16:49:57','haha'),(174,'anhtu',28,'2017-12-24 16:50:19','Hay lam!!!'),(175,'anhtu',11,'2017-12-24 22:06:21','what the hell are you talking about???'),(176,'admin',25,'2017-12-25 00:34:59','demo'),(177,'admin',25,'2017-12-25 00:35:55','demo'),(178,'admin',25,'2017-12-25 00:37:32','loading icon'),(179,'admin',25,'2017-12-25 00:38:19','icon'),(180,'admin',24,'2017-12-25 00:44:37','demo'),(181,'admin',24,'2017-12-25 00:48:27','demo 2'),(182,'admin',24,'2017-12-25 00:49:08','demo3'),(183,'admin',24,'2017-12-25 00:49:31','demo3'),(184,'admin',24,'2017-12-25 00:49:54','demo 5'),(185,'admin',24,'2017-12-25 00:50:10','hay VL'),(186,'admin',24,'2017-12-25 00:50:15','Hay lam!'),(187,'admin',24,'2017-12-25 00:50:20','Tuyet!'),(188,'admin',24,'2017-12-25 00:50:23','dc'),(189,'admin',24,'2017-12-25 00:50:26','OK'),(190,'admin',24,'2017-12-25 00:50:30','hehe'),(192,'admin',24,'2017-12-25 00:50:44','hehe'),(194,'admin',24,'2017-12-25 00:50:56',''),(195,'admin',24,'2017-12-25 00:51:31','error!'),(196,'admin',24,'2017-12-25 00:54:52','cmt lam vl!'),(197,'admin',24,'2017-12-25 00:54:56','hehe'),(198,'admin',28,'2017-12-25 10:32:48','today is monday!!!'),(199,'anhtu',28,'2017-12-25 11:44:06','demo'),(200,'anhtu',28,'2017-12-25 11:44:25','sao vay?'),(201,'anhtu',28,'2017-12-25 11:45:16','demo anim'),(202,'anhtu',27,'2017-12-25 11:46:03','demo'),(203,'anhtu',28,'2017-12-25 11:46:30','dc roai!'),(204,'anhtu',28,'2017-12-25 11:46:47','da them dc phan animation cho new comment'),(205,'anhtu',28,'2017-12-25 11:48:24','Hay lam!'),(206,'anhtu',27,'2017-12-25 11:48:45','demo2'),(207,'anhtu',24,'2017-12-25 12:12:00','feafeja fejwa gaepk a'),(208,'anhtu',24,'2017-12-25 12:12:15','???'),(209,'anhtu',24,'2017-12-25 12:12:16','lefw'),(210,'anhtu',24,'2017-12-25 12:12:18','wefa'),(211,'anhtu',24,'2017-12-25 12:12:20','foekga efwaok'),(212,'anhtu',24,'2017-12-25 12:12:21','feko fea'),(214,'admin',26,'2017-12-29 00:36:07','hello'),(215,'admin',26,'2017-12-29 00:36:53','wtf???'),(216,'admin',26,'2017-12-29 00:37:07','Hay lam , heheh'),(217,'admin',26,'2017-12-29 00:37:42','try again<br />anhtu<br />set'),(218,'anhtu',26,'2017-12-29 00:51:12','hay lam!!!'),(219,'anhtu',26,'2017-12-29 00:52:30','fjeaw fea'),(220,'huy',26,'2017-12-29 01:08:59','demo'),(221,'huy',25,'2017-12-29 01:21:00','demo fkeowa mfea'),(222,'huy',27,'2017-12-29 01:26:58','demo 3'),(223,'huy',27,'2017-12-29 01:27:06','Hay vl'),(224,'huy',27,'2017-12-29 01:27:08',':v'),(225,'huy',26,'2017-12-29 01:31:24','next demo'),(226,'huy',26,'2017-12-29 01:31:42','hay vc :v'),(227,'admin',26,'2017-12-29 01:31:55','hahaha'),(229,'admin',29,'2017-12-29 13:47:57','what do you want to do now?'),(231,'admin',29,'2017-12-29 13:48:14','Haha'),(232,'admin',28,'2017-12-29 13:49:15','demo'),(233,'admin',28,'2017-12-29 13:49:20','wtf>??'),(234,'admin',27,'2017-12-29 13:49:41','hay'),(235,'admin',27,'2017-12-29 13:49:47','vcl'),(236,'admin',26,'2017-12-29 13:50:01','hehe'),(237,'admin',26,'2017-12-29 13:50:07','haha'),(238,'admin',26,'2017-12-29 13:50:16','cl'),(239,'admin',26,'2017-12-29 13:50:27','fawok fkawefok kfeoa ghiaerj cjdisz fpe'),(240,'huy',25,'2017-12-29 15:44:00','alo'),(241,'huy',29,'2017-12-29 16:25:39','demo'),(242,'huy',29,'2017-12-29 16:25:47','hay chua???'),(243,'huy',29,'2017-12-29 16:29:31','demo'),(244,'huy',29,'2017-12-29 16:29:41','hay ghe'),(245,'huy',29,'2017-12-29 16:29:49','hay vl'),(246,'huy',29,'2017-12-29 16:30:11','dep me de!'),(248,'huy',29,'2017-12-29 17:45:19','hay'),(249,'huy',29,'2017-12-29 17:45:40','ok chua???'),(251,'admin',29,'2017-12-29 22:32:11','let\\\'s demo'),(252,'admin',29,'2017-12-29 22:32:45','let\\\'s do it'),(253,'admin',29,'2017-12-29 22:34:15','let\'s try again'),(254,NULL,29,'2017-12-29 22:37:09','let\'s do let\'t try'),(256,'admin',29,'2017-12-29 22:57:53','OK, happy new year'),(257,'admin',11,'2017-12-29 23:08:55','demo'),(258,'admin',11,'2017-12-29 23:09:29','sao vay???'),(259,'admin',NULL,'2017-12-29 23:13:33','sao va'),(260,'admin',11,'2017-12-29 23:14:08','error'),(261,'admin',11,'2017-12-29 23:15:26','sao vay???'),(262,'admin',11,'2017-12-29 23:18:55','sfa feaw'),(264,'admin',29,'2017-12-30 10:37:25','OK roai!!'),(266,'admin',37,'2017-12-30 16:03:24','This is demo comment to test:<br />newline<br />\"double quote\"<br />\'single quote\'<br />Does this OK???'),(267,'anhtu',37,'2017-12-30 23:56:47','demo'),(268,'anhtu',37,'2017-12-30 23:57:12','demo2'),(269,'anhtu',37,'2017-12-31 00:08:10','demo'),(270,'anhtu',37,'2017-12-31 00:21:12','demo3'),(271,'anhtu',37,'2017-12-31 00:21:39','demo4'),(272,'anhtu',37,'2017-12-31 00:22:29','demo5'),(273,'anhtu',37,'2017-12-31 00:24:27','demo6'),(274,'anhtu',36,'2017-12-31 00:25:37','DEMO7'),(275,'anhtu',NULL,'2017-12-31 13:59:49','demo'),(276,'anhtu',NULL,'2017-12-31 14:03:17','kok'),(277,'anhtu',NULL,'2017-12-31 14:03:42','l,oko iji; h;'),(278,'admin',NULL,'2017-12-31 15:23:07','demo \"quote\" \'quote\''),(279,'admin',NULL,'2017-12-31 15:31:10','demo'),(280,'admin',NULL,'2017-12-31 15:34:01','demo2'),(281,'admin',44,'2017-12-31 15:59:06','<h2>demo</h2>'),(282,'admin',44,'2017-12-31 16:01:33','&lt;div&gt;demo&lt;div&gt;'),(283,'admin',44,'2017-12-31 16:01:43','OK roai nha!!!'),(284,'admin',44,'2017-12-31 16:03:40',''),(285,'admin',44,'2017-12-31 16:04:07',''),(286,'huy',44,'2017-12-31 22:32:15','demo'),(287,'huy',44,'2017-12-31 22:32:25','hay'),(288,'huy',41,'2017-12-31 22:34:27','demo'),(289,'huy',41,'2017-12-31 22:35:00','demo2'),(290,'huy',41,'2017-12-31 22:35:37','demo'),(291,'huy',40,'2017-12-31 22:38:06','demo'),(292,'huy',40,'2017-12-31 22:38:13','hay chua???'),(293,'huy',39,'2017-12-31 22:39:55','hay ghe'),(294,'admin',43,'2017-12-31 22:51:10','demo'),(295,'admin',43,'2017-12-31 22:58:20','demo2'),(296,'admin',44,'2017-12-31 22:58:57','demo'),(297,'admin',43,'2017-12-31 22:59:19','sao vay???'),(298,'admin',41,'2017-12-31 23:03:41','???'),(300,'admin',43,'2017-12-31 23:08:08','demo'),(301,'admin',44,'2018-01-01 16:40:37','demo'),(302,'admin',43,'2018-01-01 17:46:10','demo'),(303,'huy',43,'2018-01-02 12:25:29','demo'),(304,'admin',50,'2018-01-03 16:29:48','demo'),(305,'admin',50,'2018-01-03 16:29:53','happy new year'),(306,'admin',51,'2018-01-03 22:16:53','sao la vay???'),(307,'anhtu',52,'2018-01-03 22:19:44','chrome lai dc???'),(308,'huy',52,'2018-01-03 22:20:08','nhu shit y!!!'),(309,'anhtu',52,'2018-01-03 22:23:12','demo'),(310,'huy',52,'2018-01-03 22:23:18','dc roai'),(311,'admin',51,'2018-01-04 16:53:15','wtf???');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project3`.`comments_AFTER_INSERT` AFTER INSERT ON `comments` FOR EACH ROW
BEGIN
	update posts set num_of_comments = num_of_comments + 1 where id = new.post_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project3`.`comments_AFTER_DELETE` AFTER DELETE ON `comments` FOR EACH ROW
BEGIN
	update posts set num_of_comments = num_of_comments - 1 where id = old.post_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `count_posts`
--

DROP TABLE IF EXISTS `count_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `count_posts` (
  `total_posts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`total_posts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `count_posts`
--

LOCK TABLES `count_posts` WRITE;
/*!40000 ALTER TABLE `count_posts` DISABLE KEYS */;
INSERT INTO `count_posts` VALUES (30);
/*!40000 ALTER TABLE `count_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_task`
--

DROP TABLE IF EXISTS `log_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian xảy ra hoạt động (là thời gian SV thêm/sửa/xóa task)',
  `activity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1 trong 3 giá trị: add/update/delete',
  `task_id` int(11) DEFAULT NULL COMMENT 'Ko tạo đc FK cho field này tham chiếu tới id của `task`, vì nếu có 1 task bị xóa thì id của task đó vẫn có trong 1 vài record của bảng này',
  `task_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `field` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Trường mà update, có thể là tên task, tiến độ,... Nếu field = ''task'' thì người này sẽ tạo mới 1 task, và activity = ''add''; hoặc sẽ delete 1 task, và activity = ''delete'', old_value = tên của task đó',
  `old_value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Lưu giá trị cũ trước khi update. Nếu là add thì giá trị cũ = rỗng',
  `new_value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Lưu giá trị mới sau khi update. Nếu là delete thì giá trị mới = rỗng',
  PRIMARY KEY (`id`),
  KEY `user_id_log_fk_idx` (`user_id`),
  KEY `taskID_log_task_fk_idx` (`task_id`),
  CONSTRAINT `userID_log_task_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_task`
--

LOCK TABLES `log_task` WRITE;
/*!40000 ALTER TABLE `log_task` DISABLE KEYS */;
INSERT INTO `log_task` VALUES (1,'nguyen','2017-12-16 16:27:27','add',9,'Viết báo cáo chương 2 môn xử lý ảnh','task',NULL,'Viết báo cáo chương 2 môn xử lý ảnh'),(2,'nguyen','2017-12-16 16:42:14','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','process','0','15'),(3,'huy','2017-12-16 16:43:20','update',6,'[project3] Phân tích yêu cầu chức năng và phi chức năng','process','82','92'),(5,'toan','2017-12-16 16:46:07','update',5,'Tìm hiểu về mô hình MVC','name','Tìm hiểu mô hình MVC','Tìm hiểu về mô hình MVC'),(6,'toan','2017-12-16 16:46:07','update',5,'Tìm hiểu về mô hình MVC','process','100','98'),(7,'anhtu','2017-12-16 16:46:41','update',2,'Giải pt bậc 2 dùng framework cakephp','name','Giải ptb2 dùng cakephp','Giải pt bậc 2 dùng framework cakephp'),(8,'anhtu','2017-12-16 16:46:41','update',2,'Giải pt bậc 2 dùng framework cakephp','process','89','98'),(9,'anhtu','2017-12-16 16:47:35','update',2,'Giải pt bậc 2 dùng framework cakephp','name','Giải pt bậc 2 dùng cakephp','Giải ptb2 dùng framework cakephp'),(10,'anhtu','2017-12-16 16:47:35','update',2,'Giải pt bậc 2 dùng framework cakephp','start','2017-12-11','2017-12-10'),(11,'anhtu','2017-12-16 16:47:35','update',2,'Giải pt bậc 2 dùng framework cakephp','deadline','2017-12-29','2017-12-15'),(12,'anhtu','2017-12-16 16:47:35','update',2,'Giải pt bậc 2 dùng framework cakephp','process','100','80'),(15,'huy','2017-12-16 23:25:23','update',7,'[project3] Vẽ acivity diagram (Biểu đồ hoạt động) cho GV, SV','name','[project3] Vẽ acivity diagram','[project3] Vẽ acivity diagram (Biểu đồ hoạt động) cho GV, SV'),(16,'toan','2017-12-17 00:17:40','update',3,'Tìm hiểu Oxford Dic API	','process','66','80'),(17,'nguyen','2017-12-17 15:33:25','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','name','Báo cáo chương 2, xử lý ảnh','Viết báo cáo chương 2 môn xử lý ảnh'),(18,'nguyen','2017-12-17 15:33:25','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','process','15','60'),(19,'nguyen','2017-12-18 17:03:15','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','start','2017-12-16','2017-12-21'),(20,'nguyen','2017-12-18 17:06:43','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','start','2017-12-21','2017-12-18'),(21,'nguyen','2017-12-18 17:06:43','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','deadline','2018-01-20','2018-01-22'),(22,'nguyen','2017-12-18 17:06:43','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','process','60','78'),(23,'nguyen','2017-12-18 17:09:20','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','deadline','2018-01-22','2018-01-18'),(24,'nguyen','2017-12-18 17:10:54','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','process','78','60'),(25,'nguyen','2017-12-18 17:13:17','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','process','60','62'),(26,'nguyen','2017-12-18 17:15:02','update',9,'Viết báo cáo chương 2 môn xử lý ảnh','process','62','65'),(27,'toan','2017-12-18 17:17:49','update',3,'Tìm hiểu Oxford Dic API	','name','Tìm hiểu ve Oxford Dic API	','Tìm hiểu Oxford Dic API	'),(28,'toan','2017-12-18 17:17:49','update',3,'Tìm hiểu Oxford Dic API	','process','80','85'),(29,'toan','2017-12-18 17:19:19','update',8,'Cày FIFA với Huy tối nay','start','2017-12-14','2017-12-13'),(30,'toan','2017-12-18 17:19:19','update',8,'Cày FIFA với Huy tối nay','deadline','2017-12-14','2017-12-13'),(31,'toan','2017-12-18 17:19:46','update',5,'Tìm hiểu về mô hình MVC','process','98','100'),(32,'toan','2017-12-18 17:20:42','update',4,'Tìm hiểu framework cakephp','name','Tìm hiểu framework cakephp, Toàn gà và noob lắm','Tìm hiểu framework cakephp'),(33,'toan','2017-12-18 17:20:42','update',4,'Tìm hiểu framework cakephp','deadline','2017-12-08','2017-12-09'),(34,'toan','2017-12-18 21:57:59','add',10,'[project 3] Vẽ use case','task',NULL,'[project 3] Vẽ use case'),(35,'anhtu','2017-12-18 21:58:52','add',11,'[project 3] Thiết kế mô hình thực thể liên kết','task',NULL,'[project 3] Thiết kế mô hình thực thể liên kết'),(36,'toan','2017-12-18 22:00:22','add',12,'[project 3] thiết kế Class diagram (biểu đồ lớp)','task',NULL,'[project 3] thiết kế Class diagram'),(37,'toan','2017-12-18 22:00:22','add',13,'[project 3] Thiết kế CSDL (database)','task',NULL,'[project 3] Thiết kế CSDL'),(38,'toan','2017-12-18 22:00:48','update',13,'[project 3] Thiết kế CSDL (database)','name','[project 3] Thiết kế CSDL','[project 3] Thiết kế CSDL (database)'),(39,'toan','2017-12-18 22:00:48','update',13,'[project 3] Thiết kế CSDL (database)','process','80','85'),(40,'toan','2017-12-18 22:00:48','update',12,'[project 3] thiết kế Class diagram (biểu đồ lớp)','name','[project 3] thiết kế Class diagram','[project 3] thiết kế Class diagram (biểu đồ lớp)'),(41,'toan','2017-12-18 22:00:57','update',12,'[project 3] thiết kế Class diagram (biểu đồ lớp)','process','70','82'),(42,'huy','2017-12-21 13:13:40','update',7,'[project3] Vẽ acivity diagram (Biểu đồ hoạt động) cho GV, SV','process','90','100'),(43,'huy','2017-12-21 13:51:57','update',6,'[project3] Phân tích yêu cầu chức năng và phi chức năng','start','2017-12-01','2017-12-23'),(44,'huy','2017-12-21 13:51:57','update',6,'[project3] Phân tích yêu cầu chức năng và phi chức năng','deadline','2017-12-10','2017-12-29'),(45,'anhtu','2017-12-22 17:53:56','update',1,'Tìm hiểu về Google search API','process','76','80'),(46,'anhtu','2017-12-22 22:51:18','update',1,'Tìm hiểu về Google search API','deadline','2017-12-27','2017-12-28'),(47,'anhtu','2017-12-22 22:51:18','update',1,'Tìm hiểu về Google search API','process','80','85'),(48,'anhtu','2017-12-24 00:38:27','add',14,'Code phần giao diện, task','task',NULL,'Code phần giao diện, task'),(67,'anhtu','2017-12-24 00:46:23','update',14,'Code phần giao diện, task','process','90','100'),(72,'anhtu','2017-12-24 11:25:45','update',11,'[project 3] Thiết kế mô hình thực thể liên kết','process','100','97'),(75,'anhtu','2017-12-24 16:20:14','update',11,'[project 3] Thiết kế mô hình thực thể liên kết','process','97','98'),(76,'huy','2017-12-26 16:32:01','add',27,'Thiết kế bản đồ dùng JavaFX','task',NULL,'Thiết kế bản đồ dùng JavaFX'),(77,'anhtu','2017-12-30 23:51:19','update',11,'[project 3] Thiết kế mô hình thực thể liên kết','process','98','100'),(78,'huy','2017-12-31 18:18:59','update',27,'Thiết kế bản đồ dùng JavaFX','process','70','80'),(79,'anhtu','2017-12-31 18:21:58','add',28,'This is just a demo','task',NULL,'This is just a demo'),(80,'anhtu','2017-12-31 18:22:18','add',29,'another demo','task',NULL,'another demo'),(81,'anhtu','2017-12-31 18:22:54','update',29,'another demo','process','0','11'),(82,'anhtu','2017-12-31 18:23:48','delete',29,'another demo','task','another demo',NULL),(83,'anhtu','2017-12-31 18:33:14','update',28,'This is just a demo','start','2017-12-31','2018-01-01'),(84,'anhtu','2017-12-31 18:33:14','update',28,'This is just a demo','deadline','2018-01-01','2018-01-02'),(85,'anhtu','2017-12-31 18:33:29','update',28,'This is just a demo','process','100','90'),(86,'anhtu','2017-12-31 18:33:53','delete',28,'This is just a demo','task','This is just a demo',NULL),(87,'anhtu','2017-12-31 18:35:36','add',30,'demo','task',NULL,'demo'),(88,'anhtu','2018-01-03 22:47:05','add',31,'Design, layout VLSI','task',NULL,'Design, layout VLSI'),(89,'anhtu','2018-01-03 22:49:07','update',30,'demo','deadline','2017-12-31','2018-01-04'),(90,'anhtu','2018-01-03 22:49:07','update',30,'demo','process','0','90');
/*!40000 ALTER TABLE `log_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `hashtag` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `num_of_comments` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `posterID_posts_fk_idx` (`user_id`),
  CONSTRAINT `posterID_posts_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'anhtu','Đây là bài post đầu tiên! Welcome my forum!','2017-12-12 16:05:00','first_post,',3),(2,'anhtu','Đây là bài demo nhé','2017-12-12 18:19:00','demo,',0),(11,'anhtu','Tìm hiểu về .NET: .NET Framework là nền tảng để chạy các ứng dụng viết = NNLT của Microsoft, hay gọi là môi trường lập trình, môi trường phát triển ƯD','2017-12-12 23:00:12','.NET,',6),(14,'anhtu','Cuối cùng cũng code xong phần đăng bài. Mệt vãi, phải làm cả JS, CSS nữa!','2017-12-14 18:03:13','first_post,',7),(15,'anhtu','hehehe, this is a demo!','2017-12-14 22:59:58',NULL,16),(22,'toan','Hôm nay là T6, ngon roài :)','2017-12-15 11:00:03',NULL,4),(23,'anhtu','fewa fewafewa ewa','2017-12-15 14:38:23',NULL,6),(24,'anhtu','ijiok koplo lp,,','2017-12-15 15:23:24',NULL,22),(25,'anhtu','Đang làm phần phân chia trang cho các bài đăng!','2017-12-16 00:37:27',NULL,21),(26,'anhtu','This is a post to ask everyone in our lab','2017-12-22 17:54:22',NULL,14),(27,'admin','Demo post','2017-12-22 17:57:10',NULL,9),(28,'anhtu','This is a place where you can ask everyone in lab!!','2017-12-22 22:51:48',NULL,16),(29,'admin','Hôm nay 29/12/2017, chỉ còn 2 ngày nữa là hết năm roài!!!','2017-12-29 13:47:23',NULL,16),(34,'admin','Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!','2017-12-30 15:16:52',NULL,0),(35,'admin','Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!! Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n <br>\n <br>\n Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n <br>\n Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!! Gần xong cái website này roài! Đang code nốt phần râu ria cho đẹp và friendly hơn!!!<br>\n <br>\n hay lắm!!!','2017-12-30 15:17:59',NULL,0),(36,'admin','we\'d like to let you know what we\'re doing to keep your information safe whenever you use Facebook. Your account security is important to us, so our security teams look for and catch problems before they reach your account. If we ever see anything unusual happening, we\'ll let you know.<br />\r\n<br />\r\nwe\'d like to let you know what we\'re doing to keep your information safe whenever you use Facebook. <br />\r\nYour account security is important to us, so our security teams look for and catch problems before they reach your account. <br />\r\nIf we ever see anything unusual happening, we\'ll let you know.<br />\r\n<br />\r\n- Nên dùng AJAX load comment, mỗi lần chỉ load vài cmt thôi<br />\r\n- Giao diện hơi xấu<br />\r\n- chưa có phần ảnh, file<br />\r\n- chưa có phần edit comment, post<br />\r\n- tự động tạo hashtag khi bài post có đoạn #some_thing','2017-12-30 16:00:09',NULL,1),(37,'admin','This is demo post to test:<br />\r\nnewline<br />\r\n\"double quote\"<br />\r\n\'single quote\'<br />\r\nDoes this OK???','2017-12-30 16:01:31',NULL,8),(39,'anhtu','demo add post','2017-12-31 13:55:00',NULL,1),(40,'anhtu','another demo','2017-12-31 13:56:17',NULL,2),(41,'anhtu','demo3','2017-12-31 13:58:39',NULL,4),(43,'admin','demo post:<br />\r\n- escape HTML tags as HTML entities?<br />\r\n- convert newline to &lt;br/&gt;<br />\r\n- add slash before single quote','2017-12-31 15:52:27',NULL,6),(44,'admin','demo post:<br />\r\n- &lt;div&gt;escape HTML tags as HTML entities?&lt;/div&gt;<br />\r\n- convert newline to &lt;br/&gt;<br />\r\n- add slash before single quote<br />\r\n','2017-12-31 15:53:02',NULL,9),(45,'admin','This post #demo about #hashtag','2018-01-03 11:17:04','demo,hashtag,',0),(46,'admin','This post #demo about #hashtag_demo.feaw #demo;fl #akf-da_demo fealw  feaw ear','2018-01-03 11:39:21','demo,hashtag_demo,demo,akf-da_demo,',0),(47,'admin','This post #demo about #hashtag_demo.feaw #demo;fl #akf-da_demo fealw feaw ear #demo','2018-01-03 11:44:01','demo,hashtag_demo,akf-da_demo,',0),(48,'admin','Another demo about hashtag<br />\r\n#happy_new_year<br />\r\n#2018<br />\r\n#project3','2018-01-03 14:41:19','happy_new_year,2018,project3,',0),(49,'admin','Another demo about hashtag<br />\r\n#so_hot #pms #today','2018-01-03 14:47:43','so_hot,pms,today,',0),(50,'admin','Another demo about hashtag<br />\r\n#happy_new_year #2018 #project3','2018-01-03 14:47:59','happy_new_year,2018,project3,',2),(51,'admin','demo<br />\r\n#trion_nemesis<br />\r\n#vulcan<br />\r\n#lamborghini','2018-01-03 14:55:58','trion_nemesis,vulcan,lamborghini,',2),(52,'admin','demo2<br />\r\n#chevoret<br />\r\n#Honda<br />\r\n#arash','2018-01-03 14:58:13','chevoret,Honda,arash,',4);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project3`.`posts_AFTER_INSERT` AFTER INSERT ON `posts` FOR EACH ROW
BEGIN
	update count_posts set total_posts = total_posts + 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project3`.`posts_AFTER_DELETE` AFTER DELETE ON `posts` FOR EACH ROW
BEGIN
	delete FROM `comments` WHERE `post_id` = old.id;
    update count_posts set total_posts = total_posts - 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `process` int(11) DEFAULT '0',
  `last_update` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id_fk_idx` (`user_id`),
  CONSTRAINT `user_id_task_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'anhtu','Tìm hiểu về Google search API','2017-12-11','2017-12-28',85,'2017-12-24 01:25:32'),(2,'anhtu','Giải pt bậc 2 dùng framework cakephp','2017-12-10','2017-12-15',98,'2017-12-16 23:05:22'),(3,'toan','Tìm hiểu Oxford Dic API	','2017-12-12','2017-12-19',85,'2017-12-18 17:17:49'),(4,'toan','Tìm hiểu framework cakephp','2017-12-05','2017-12-09',100,'2017-12-18 17:20:42'),(5,'toan','Tìm hiểu về mô hình MVC','2017-11-20','2017-11-29',100,'2017-12-18 17:19:46'),(6,'huy','[project3] Phân tích yêu cầu chức năng và phi chức năng','2017-12-23','2017-12-29',92,'2017-12-21 13:51:57'),(7,'huy','[project3] Vẽ acivity diagram (Biểu đồ hoạt động) cho GV, SV','2017-12-09','2017-12-19',100,'2017-12-21 13:50:52'),(8,'toan','Cày FIFA với Huy tối nay','2017-12-13','2017-12-13',100,'2017-12-18 17:19:19'),(9,'nguyen','Viết báo cáo chương 2 môn xử lý ảnh','2017-12-18','2018-01-18',65,'2017-12-18 17:15:02'),(10,'toan','[project 3] Vẽ use case','2017-12-11','2017-12-22',70,'2017-12-18 21:57:59'),(11,'anhtu','[project 3] Thiết kế mô hình thực thể liên kết','2017-12-15','2017-12-20',100,'2017-12-30 23:51:19'),(12,'toan','[project 3] thiết kế Class diagram (biểu đồ lớp)','2017-12-19','2017-12-26',82,'2017-12-18 22:00:57'),(13,'toan','[project 3] Thiết kế CSDL (database)','2017-12-22','2017-12-25',85,'2017-12-18 22:00:48'),(14,'anhtu','Code phần giao diện, task','2017-12-10','2017-12-17',100,'2017-12-31 18:45:37'),(27,'huy','Thiết kế bản đồ dùng JavaFX','2017-11-20','2017-12-30',80,'2017-12-31 18:18:59'),(30,'anhtu','demo','2017-12-29','2018-01-04',90,'2018-01-03 22:49:07'),(31,'anhtu','Design, layout VLSI','2018-01-01','2018-01-03',50,'2018-01-03 22:47:05');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project3`.`tasks_AFTER_INSERT` AFTER INSERT ON `tasks` FOR EACH ROW
BEGIN
	UPDATE users SET last_activity = now() WHERE id = NEW.user_id;
    INSERT INTO log_task (`user_id`, `activity`, `task_id`, `task_name`, `field`, `new_value`) VALUES (NEW.user_id, 'add', NEW.id, NEW.name, 'task', NEW.name);

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project3`.`tasks_BEFORE_UPDATE` BEFORE UPDATE ON `tasks` FOR EACH ROW
BEGIN
	set new.last_update = now();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project3`.`tasks_AFTER_UPDATE` AFTER UPDATE ON `tasks` FOR EACH ROW 
BEGIN
	UPDATE users SET last_activity = now() WHERE id = NEW.user_id;
    
    if OLD.name != NEW.name then
		begin
			INSERT INTO log_task(`user_id`, `activity`, `task_id`, `task_name`, `field`, `old_value`, `new_value`) VALUES (NEW.user_id, 'update', NEW.id, new.name, 'name', old.name, new.name);
		end;
    end if;
    
    if old.start != new.start then
		INSERT INTO log_task(`user_id`, `activity`, `task_id`, `task_name`, `field`, `old_value`, `new_value`) VALUES (NEW.user_id, 'update', NEW.id, new.name, 'start', old.start, new.start);
    end if;
    
    if old.deadline != new.deadline then
		INSERT INTO log_task(`user_id`, `activity`, `task_id`, `task_name`, `field`, `old_value`, `new_value`) VALUES (NEW.user_id, 'update', NEW.id, new.name, 'deadline', old.deadline, new.deadline);
    end if;
    
    if old.process != new.process then
		INSERT INTO log_task(`user_id`, `activity`, `task_id`, `task_name`, `field`, `old_value`, `new_value`) VALUES (NEW.user_id, 'update', NEW.id, new.name, 'process', old.process, new.process);
    end if;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project3`.`tasks_AFTER_DELETE` AFTER DELETE ON `tasks` FOR EACH ROW
BEGIN
	UPDATE users SET last_activity = now() WHERE id = OLD.user_id;
    INSERT INTO log_task(`user_id`, `activity`, `task_id`, `task_name`, `field`, `old_value`) VALUES (old.user_id, 'delete', old.id, old.name, 'task', old.name);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `role` int(11) DEFAULT '2' COMMENT 'role==1: admin\nrole==2: member',
  `last_activity` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Lần cuối cùng user này add/update/delete công việc',
  `wrong_pass_3_times` datetime DEFAULT '2000-01-01 00:00:01',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','b59c67bf196a4758191e42f76670ceba','Admin',1,'2017-12-16 00:51:58','2000-01-01 00:00:01'),('anhtu','b59c67bf196a4758191e42f76670ceba','SieuSaiyanTocXu',2,'2018-01-03 22:49:07','2017-12-26 00:11:00'),('huy','b59c67bf196a4758191e42f76670ceba','Huy gà',2,'2017-12-31 18:18:59','2017-12-31 00:30:22'),('nguyen','b59c67bf196a4758191e42f76670ceba','Nguyên Bka',2,'2017-12-18 17:15:02','2000-01-01 00:00:01'),('nhan','81dc9bdb52d04dc20036dbd8313ed055','Hà Nhận',2,'2017-12-16 00:51:58','2000-01-01 00:00:01'),('phanh','b59c67bf196a4758191e42f76670ceba','Phanh Lee',2,'2017-12-16 00:51:58','2000-01-01 00:00:01'),('phuong','b59c67bf196a4758191e42f76670ceba','Phuong Anh',2,'2017-12-22 22:54:31','2000-01-01 00:00:01'),('thong','b59c67bf196a4758191e42f76670ceba','Bùi Thông',2,'2017-12-16 00:51:58','2000-01-01 00:00:01'),('toan','b59c67bf196a4758191e42f76670ceba','Toàn',2,'2017-12-18 22:00:57','2017-12-26 00:32:14');
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

-- Dump completed on 2018-01-04 23:16:23
