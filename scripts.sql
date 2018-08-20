update atividade__periodos ap 
  set ap.float = (select a.float from atividades a where ap.atividade_id = a.id), 
      ap.float_hora = (select float_hora from atividades a where ap.atividade_id = a.id) 
where ap.periodo_id = (select max(id) from periodos)

;

--trigger after update tabela atividades
update atividade__periodos ap
    set ap.user_id = new.usuario_id,
    ap.float = new.float,
    ap.float_hora = new.float_hora
    where atividade_id = new.id
    and periodo_id = (select max(id) from periodos)


--


DELIMITER ;;
CREATE TRIGGER atividade_periodo_after_ins AFTER INSERT ON periodos FOR EACH ROW 

   INSERT INTO atividade__periodos
   ( periodo_id,
	 atividade_id,
     user_id,
     atividade__periodos.float,
     float_hora,
     created_at
     )
    select p.id, a.id, a.usuario_id, a.float, a.float_hora, SYSDATE() 
   from periodos p , atividades a
   where p.id = new.id
   and a.deleted_at is null;
DELIMITER ;


--
DELETE FROM `atividade__periodos` WHERE `atividade__periodos`.`periodo_id` = 8

--
DELETE FROM `periodos` WHERE `periodos`.`id` = 8





--





--trigger after insert tabela atividades
    INSERT INTO atividade__periodos
   ( periodo_id,
	   atividade_id,
     user_id, 
     float,
     float_hora,
     conclusao
   )
    select (select max(periodo_id) from atividade__periodos) periodo, 
    
    a.id, a.usuario_id, a.float, a.float_hora, 0 
   from atividades a
   where a.id = new.id
   and a.deleted_at is null



   

-- LOG OLD - REMOVER
begin
	if new.user_id = old.user_id then
		INSERT INTO econtabildb.logs
		(nome,
		 user_id,
		 atividade_id, 
		 tipo,
		 created_at
		 )
		 select 'ativ-perio', 
         case when atp.concluido_user_id is null then users.id
         else atp.concluido_user_id end, atp.atividade_id,
         case when atp.concluido_user_id is null then 'postergou'
         else 'concluiu tarefa' end, SYSDATE() 
		 from atividade__periodos atp, users users
		 where atp.id = new.id and users.id = atp.user_id;
 	else
 		INSERT INTO econtabildb.logs
		(nome,
		 user_id,
		 atividade_id, 
		 tipo,
		 created_at
		 )
		 select 'ativ-perio', user_id, atp.atividade_id,
		 'alterou o responsavel', SYSDATE() 
		 from atividade__periodos atp, users users
		 where atp.id = new.id and users.id = atp.user_id;
    end if;

END

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `atividade_periodo_id` int(10) unsigned NOT NULL,
  `tipo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_atividade_periodo_id_foreign` (`atividade_periodo_id`),
  KEY `logs_user_id_foreign` (`user_id`),
  CONSTRAINT `logs_atividade_periodo_id_foreign` FOREIGN KEY (`atividade_periodo_id`) REFERENCES `atividade__periodos` (`id`),
  CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=353 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;











DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `atividade_periodo_id` int(10) unsigned NOT NULL,
  `tipo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_atividade_id_foreign` (`atividade_id`),
  KEY `logs_user_id_foreign` (`user_id`),
  CONSTRAINT `logs_atividade_periodo_id_foreign` FOREIGN KEY (`atividade_periodo_id`) REFERENCES `atividade__periodos` (`id`),
  CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=353 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (30,'ativ-perio',1,16,'postergou','2018-02-01 14:26:43',NULL,NULL),(31,'ativ-perio',1,17,'postergou','2018-02-01 14:26:51',NULL,NULL),(32,'ativ-perio',1,18,'postergou','2018-02-01 14:26:58',NULL,NULL),(33,'ativ-perio',1,19,'postergou','2018-02-01 14:27:05',NULL,NULL),(34,'ativ-perio',1,20,'postergou','2018-02-01 14:27:13',NULL,NULL),(35,'ativ-perio',1,16,'concluiu tarefa','2018-02-01 16:34:26',NULL,NULL),(36,'ativ-perio',1,17,'concluiu tarefa','2018-02-01 16:40:17',NULL,NULL),(37,'ativ-perio',6,20,'alterou o responsavel','2018-02-01 16:42:03',NULL,NULL),(38,'ativ-perio',7,24,'postergou','2018-02-01 18:52:55',NULL,NULL),(39,'ativ-perio',7,24,'concluiu tarefa','2018-02-01 18:52:58',NULL,NULL),(40,'ativ-perio',1,25,'concluiu tarefa','2018-02-07 19:11:05',NULL,NULL),(41,'ativ-perio',1,25,'concluiu tarefa','2018-03-01 18:58:42',NULL,NULL),(42,'ativ-perio',1,20,'concluiu tarefa','2018-03-01 18:59:36',NULL,NULL),(43,'ativ-perio',1,16,'postergou','2018-03-05 18:58:54',NULL,NULL),(44,'ativ-perio',11,32,'concluiu tarefa','2018-03-05 19:05:32',NULL,NULL),(45,'ativ-perio',11,33,'concluiu tarefa','2018-03-05 19:05:37',NULL,NULL),(46,'ativ-perio',11,34,'concluiu tarefa','2018-03-05 19:05:37',NULL,NULL),(47,'ativ-perio',11,36,'concluiu tarefa','2018-03-05 19:05:38',NULL,NULL),(48,'ativ-perio',11,39,'concluiu tarefa','2018-03-05 19:05:40',NULL,NULL),(49,'ativ-perio',11,41,'concluiu tarefa','2018-03-05 19:05:42',NULL,NULL),(50,'ativ-perio',11,43,'concluiu tarefa','2018-03-05 19:05:50',NULL,NULL),(51,'ativ-perio',10,28,'concluiu tarefa','2018-03-05 19:06:25',NULL,NULL),(52,'ativ-perio',10,29,'concluiu tarefa','2018-03-05 19:06:26',NULL,NULL),(53,'ativ-perio',10,30,'concluiu tarefa','2018-03-05 19:06:29',NULL,NULL),(54,'ativ-perio',10,31,'concluiu tarefa','2018-03-05 19:06:30',NULL,NULL),(55,'ativ-perio',10,35,'concluiu tarefa','2018-03-05 19:06:31',NULL,NULL),(56,'ativ-perio',10,37,'concluiu tarefa','2018-03-05 19:06:42',NULL,NULL),(57,'ativ-perio',10,38,'concluiu tarefa','2018-03-05 19:06:45',NULL,NULL),(58,'ativ-perio',10,40,'concluiu tarefa','2018-03-05 19:06:48',NULL,NULL),(59,'ativ-perio',10,42,'concluiu tarefa','2018-03-05 19:06:49',NULL,NULL),(60,'ativ-perio',10,47,'concluiu tarefa','2018-03-05 19:06:59',NULL,NULL),(61,'ativ-perio',10,52,'concluiu tarefa','2018-03-05 19:07:04',NULL,NULL),(62,'ativ-perio',10,60,'concluiu tarefa','2018-03-05 19:07:12',NULL,NULL),(63,'ativ-perio',11,44,'concluiu tarefa','2018-03-05 19:08:54',NULL,NULL),(64,'ativ-perio',11,46,'concluiu tarefa','2018-03-05 19:08:59',NULL,NULL),(65,'ativ-perio',11,49,'concluiu tarefa','2018-03-05 19:09:10',NULL,NULL),(66,'ativ-perio',11,50,'concluiu tarefa','2018-03-05 19:09:13',NULL,NULL),(67,'ativ-perio',10,54,'postergou','2018-03-05 19:14:46',NULL,NULL),(68,'ativ-perio',1,16,'concluiu tarefa','2018-03-05 20:05:22',NULL,NULL),(69,'ativ-perio',1,18,'concluiu tarefa','2018-03-05 20:05:26',NULL,NULL),(70,'ativ-perio',10,53,'concluiu tarefa','2018-03-05 20:06:06',NULL,NULL),(71,'ativ-perio',10,45,'concluiu tarefa','2018-03-05 20:23:38',NULL,NULL),(72,'ativ-perio',11,55,'concluiu tarefa','2018-03-05 20:28:51',NULL,NULL),(73,'ativ-perio',11,56,'concluiu tarefa','2018-03-05 20:28:54',NULL,NULL),(74,'ativ-perio',10,57,'postergou','2018-03-05 20:34:12',NULL,NULL),(75,'ativ-perio',10,54,'concluiu tarefa','2018-03-05 20:41:22',NULL,NULL),(76,'ativ-perio',11,48,'concluiu tarefa','2018-03-06 11:54:02',NULL,NULL),(77,'ativ-perio',11,58,'concluiu tarefa','2018-03-06 11:54:08',NULL,NULL),(78,'ativ-perio',11,65,'concluiu tarefa','2018-03-06 11:54:13',NULL,NULL),(79,'ativ-perio',10,64,'concluiu tarefa','2018-03-06 17:18:23',NULL,NULL),(80,'ativ-perio',11,61,'concluiu tarefa','2018-03-06 17:46:03',NULL,NULL),(81,'ativ-perio',11,74,'concluiu tarefa','2018-03-06 18:49:16',NULL,NULL),(82,'ativ-perio',11,66,'concluiu tarefa','2018-03-06 18:50:37',NULL,NULL),(83,'ativ-perio',11,51,'concluiu tarefa','2018-03-06 19:05:14',NULL,NULL),(84,'ativ-perio',10,57,'concluiu tarefa','2018-03-06 20:06:13',NULL,NULL),(85,'ativ-perio',1,17,'concluiu tarefa','2018-03-06 20:09:02',NULL,NULL),(86,'ativ-perio',11,67,'concluiu tarefa','2018-03-06 20:55:43',NULL,NULL),(87,'ativ-perio',11,62,'concluiu tarefa','2018-03-07 14:15:40',NULL,NULL),(88,'ativ-perio',10,59,'concluiu tarefa','2018-03-07 19:38:32',NULL,NULL),(89,'ativ-perio',10,75,'concluiu tarefa','2018-03-07 20:25:23',NULL,NULL),(90,'ativ-perio',11,63,'concluiu tarefa','2018-03-07 20:42:17',NULL,NULL),(91,'ativ-perio',10,71,'concluiu tarefa','2018-03-07 20:48:48',NULL,NULL),(92,'ativ-perio',10,69,'concluiu tarefa','2018-03-07 20:58:56',NULL,NULL),(93,'ativ-perio',10,70,'concluiu tarefa','2018-03-07 21:01:17',NULL,NULL),(94,'ativ-perio',10,72,'concluiu tarefa','2018-03-07 21:06:50',NULL,NULL),(95,'ativ-perio',10,73,'concluiu tarefa','2018-03-07 21:25:52',NULL,NULL),(96,'ativ-perio',10,68,'concluiu tarefa','2018-03-07 21:40:17',NULL,NULL),(97,'ativ-perio',10,76,'concluiu tarefa','2018-03-09 12:07:28',NULL,NULL),(98,'ativ-perio',1,19,'postergou','2018-03-19 20:11:32',NULL,NULL),(99,'ativ-perio',1,19,'postergou','2018-03-19 20:12:22',NULL,NULL),(100,'ativ-perio',1,19,'concluiu tarefa','2018-03-19 20:19:49',NULL,NULL),(101,'ativ-perio',8,22,'concluiu tarefa','2018-03-20 19:44:17',NULL,NULL),(102,'ativ-perio',1,18,'concluiu tarefa','2018-03-27 18:27:08',NULL,NULL),(103,'ativ-perio',1,25,'concluiu tarefa','2018-03-27 18:27:25',NULL,NULL),(104,'ativ-perio',1,16,'concluiu tarefa','2018-03-27 20:02:50',NULL,NULL),(105,'ativ-perio',1,17,'concluiu tarefa','2018-03-27 20:02:57',NULL,NULL),(106,'ativ-perio',1,19,'concluiu tarefa','2018-03-27 20:03:00',NULL,NULL),(107,'ativ-perio',1,20,'concluiu tarefa','2018-03-27 20:03:03',NULL,NULL),(108,'ativ-perio',1,21,'postergou','2018-03-27 20:03:06',NULL,NULL),(109,'ativ-perio',8,22,'concluiu tarefa','2018-03-27 20:03:09',NULL,NULL),(110,'ativ-perio',1,23,'postergou','2018-03-27 20:03:12',NULL,NULL),(111,'ativ-perio',7,24,'postergou','2018-03-27 20:03:17',NULL,NULL),(112,'ativ-perio',1,26,'postergou','2018-03-27 20:03:20',NULL,NULL),(113,'ativ-perio',1,27,'postergou','2018-03-27 20:03:31',NULL,NULL),(114,'ativ-perio',65,98,'concluiu tarefa','2018-03-29 17:26:20',NULL,NULL),(115,'ativ-perio',37,164,'concluiu tarefa','2018-03-29 19:42:11',NULL,NULL),(116,'ativ-perio',16,113,'concluiu tarefa','2018-03-29 21:41:48',NULL,NULL),(117,'ativ-perio',16,185,'concluiu tarefa','2018-03-29 21:42:03',NULL,NULL),(118,'ativ-perio',94,203,'concluiu tarefa','2018-04-02 12:39:08',NULL,NULL),(119,'ativ-perio',16,114,'concluiu tarefa','2018-04-02 15:13:44',NULL,NULL),(120,'ativ-perio',10,29,'concluiu tarefa','2018-04-02 16:49:27',NULL,NULL),(121,'ativ-perio',72,198,'concluiu tarefa','2018-04-02 17:59:54',NULL,NULL),(122,'ativ-perio',72,199,'concluiu tarefa','2018-04-02 17:59:55',NULL,NULL),(123,'ativ-perio',72,200,'concluiu tarefa','2018-04-02 18:00:02',NULL,NULL),(124,'ativ-perio',72,201,'concluiu tarefa','2018-04-02 18:00:47',NULL,NULL),(125,'ativ-perio',72,202,'concluiu tarefa','2018-04-02 18:00:48',NULL,NULL),(126,'ativ-perio',16,115,'concluiu tarefa','2018-04-02 18:50:52',NULL,NULL),(127,'ativ-perio',11,32,'concluiu tarefa','2018-04-02 19:12:27',NULL,NULL),(128,'ativ-perio',11,33,'concluiu tarefa','2018-04-02 19:15:06',NULL,NULL),(129,'ativ-perio',16,112,'concluiu tarefa','2018-04-02 19:36:37',NULL,NULL),(130,'ativ-perio',37,150,'concluiu tarefa','2018-04-02 19:47:17',NULL,NULL),(131,'ativ-perio',37,151,'concluiu tarefa','2018-04-02 19:47:20',NULL,NULL),(132,'ativ-perio',37,152,'concluiu tarefa','2018-04-02 19:47:23',NULL,NULL),(133,'ativ-perio',37,153,'concluiu tarefa','2018-04-02 19:47:26',NULL,NULL),(134,'ativ-perio',37,154,'concluiu tarefa','2018-04-02 19:47:28',NULL,NULL),(135,'ativ-perio',37,155,'concluiu tarefa','2018-04-02 19:47:31',NULL,NULL),(136,'ativ-perio',16,106,'concluiu tarefa','2018-04-02 19:55:25',NULL,NULL),(137,'ativ-perio',22,104,'postergou','2018-04-02 20:10:09',NULL,NULL),(138,'ativ-perio',22,131,'concluiu tarefa','2018-04-02 20:10:58',NULL,NULL),(139,'ativ-perio',37,149,'concluiu tarefa','2018-04-02 20:11:17',NULL,NULL),(140,'ativ-perio',22,104,'concluiu tarefa','2018-04-02 20:19:08',NULL,NULL),(141,'ativ-perio',22,130,'postergou','2018-04-02 20:38:37',NULL,NULL),(142,'ativ-perio',10,28,'concluiu tarefa','2018-04-02 20:38:37',NULL,NULL),(143,'ativ-perio',10,30,'concluiu tarefa','2018-04-02 20:48:16',NULL,NULL),(144,'ativ-perio',22,129,'concluiu tarefa','2018-04-02 20:52:23',NULL,NULL),(145,'ativ-perio',22,135,'concluiu tarefa','2018-04-02 20:57:21',NULL,NULL),(146,'ativ-perio',22,79,'concluiu tarefa','2018-04-02 21:02:43',NULL,NULL),(147,'ativ-perio',16,117,'concluiu tarefa','2018-04-02 22:25:55',NULL,NULL),(148,'ativ-perio',22,130,'concluiu tarefa','2018-04-03 12:19:39',NULL,NULL),(149,'ativ-perio',10,31,'concluiu tarefa','2018-04-03 12:22:56',NULL,NULL),(150,'ativ-perio',22,138,'concluiu tarefa','2018-04-03 12:50:15',NULL,NULL),(151,'ativ-perio',22,137,'concluiu tarefa','2018-04-03 12:58:25',NULL,NULL),(152,'ativ-perio',30,143,'concluiu tarefa','2018-04-03 13:28:20',NULL,NULL),(153,'ativ-perio',10,35,'concluiu tarefa','2018-04-03 13:35:25',NULL,NULL),(154,'ativ-perio',11,36,'concluiu tarefa','2018-04-03 13:45:59',NULL,NULL),(155,'ativ-perio',22,132,'concluiu tarefa','2018-04-03 14:08:51',NULL,NULL),(156,'ativ-perio',22,80,'concluiu tarefa','2018-04-03 14:34:20',NULL,NULL),(158,'ativ-perio',51,92,'concluiu tarefa','2018-04-03 15:39:57',NULL,NULL),(161,'ativ-perio',22,136,'concluiu tarefa','2018-04-03 17:49:19',NULL,NULL),(162,'ativ-perio',22,133,'concluiu tarefa','2018-04-03 18:08:20',NULL,NULL),(163,'ativ-perio',20,124,'concluiu tarefa','2018-04-03 18:49:22',NULL,NULL),(164,'ativ-perio',11,46,'concluiu tarefa','2018-04-03 18:54:39',NULL,NULL),(165,'ativ-perio',137,215,'concluiu tarefa','2018-04-03 19:39:57',NULL,NULL),(166,'ativ-perio',32,145,'concluiu tarefa','2018-04-03 19:52:37',NULL,NULL),(167,'ativ-perio',65,94,'concluiu tarefa','2018-04-03 20:03:13',NULL,NULL),(168,'ativ-perio',65,95,'concluiu tarefa','2018-04-03 20:03:16',NULL,NULL),(169,'ativ-perio',65,181,'concluiu tarefa','2018-04-03 20:03:25',NULL,NULL),(170,'ativ-perio',65,180,'concluiu tarefa','2018-04-03 20:03:33',NULL,NULL),(171,'ativ-perio',11,41,'concluiu tarefa','2018-04-03 20:38:12',NULL,NULL),(172,'ativ-perio',10,38,'concluiu tarefa','2018-04-03 20:39:48',NULL,NULL),(173,'ativ-perio',10,37,'concluiu tarefa','2018-04-03 20:41:44',NULL,NULL),(174,'ativ-perio',10,40,'concluiu tarefa','2018-04-03 20:46:56',NULL,NULL),(175,'ativ-perio',20,123,'concluiu tarefa','2018-04-03 20:47:51',NULL,NULL),(176,'ativ-perio',22,134,'concluiu tarefa','2018-04-03 20:59:42',NULL,NULL),(177,'ativ-perio',10,42,'concluiu tarefa','2018-04-03 21:00:55',NULL,NULL),(178,'ativ-perio',11,34,'postergou','2018-04-03 21:13:09',NULL,NULL),(179,'ativ-perio',11,39,'postergou','2018-04-03 21:16:33',NULL,NULL),(180,'ativ-perio',16,116,'postergou','2018-04-03 21:18:38',NULL,NULL),(181,'ativ-perio',16,116,'concluiu tarefa','2018-04-03 21:58:03',NULL,NULL),(182,'ativ-perio',10,64,'concluiu tarefa','2018-04-04 13:07:37',NULL,NULL),(183,'ativ-perio',57,93,'concluiu tarefa','2018-04-04 13:28:01',NULL,NULL),(184,'ativ-perio',11,39,'concluiu tarefa','2018-04-04 13:35:44',NULL,NULL),(185,'ativ-perio',11,43,'concluiu tarefa','2018-04-04 13:45:31',NULL,NULL),(186,'ativ-perio',10,47,'concluiu tarefa','2018-04-04 14:08:13',NULL,NULL),(187,'ativ-perio',10,52,'concluiu tarefa','2018-04-04 14:21:01',NULL,NULL),(188,'ativ-perio',22,82,'concluiu tarefa','2018-04-04 14:32:36',NULL,NULL),(189,'ativ-perio',22,81,'postergou','2018-04-04 14:34:52',NULL,NULL),(190,'ativ-perio',22,83,'postergou','2018-04-04 14:35:23',NULL,NULL),(191,'ativ-perio',22,84,'postergou','2018-04-04 14:35:52',NULL,NULL),(192,'ativ-perio',65,97,'concluiu tarefa','2018-04-04 15:01:52',NULL,NULL),(193,'ativ-perio',65,182,'concluiu tarefa','2018-04-04 15:01:59',NULL,NULL),(194,'ativ-perio',11,34,'postergou','2018-04-04 16:30:27',NULL,NULL),(195,'ativ-perio',22,100,'concluiu tarefa','2018-04-04 16:31:01',NULL,NULL),(196,'ativ-perio',11,49,'concluiu tarefa','2018-04-04 17:11:42',NULL,NULL),(197,'ativ-perio',22,139,'concluiu tarefa','2018-04-04 17:20:41',NULL,NULL),(198,'ativ-perio',22,81,'postergou','2018-04-04 17:28:28',NULL,NULL),(199,'ativ-perio',22,83,'postergou','2018-04-04 17:28:46',NULL,NULL),(200,'ativ-perio',22,84,'postergou','2018-04-04 17:29:04',NULL,NULL),(201,'ativ-perio',22,102,'postergou','2018-04-04 17:29:43',NULL,NULL),(202,'ativ-perio',10,45,'concluiu tarefa','2018-04-04 17:32:24',NULL,NULL),(203,'ativ-perio',22,101,'concluiu tarefa','2018-04-04 17:54:25',NULL,NULL),(204,'ativ-perio',11,44,'concluiu tarefa','2018-04-04 18:01:20',NULL,NULL),(205,'ativ-perio',11,55,'concluiu tarefa','2018-04-04 18:19:44',NULL,NULL),(206,'ativ-perio',11,58,'concluiu tarefa','2018-04-04 18:30:31',NULL,NULL),(207,'ativ-perio',22,99,'postergou','2018-04-04 18:32:02',NULL,NULL),(208,'ativ-perio',11,65,'concluiu tarefa','2018-04-04 18:38:43',NULL,NULL),(209,'ativ-perio',22,81,'concluiu tarefa','2018-04-04 18:48:49',NULL,NULL),(210,'ativ-perio',22,84,'concluiu tarefa','2018-04-04 18:49:07',NULL,NULL),(211,'ativ-perio',22,83,'concluiu tarefa','2018-04-04 18:52:28',NULL,NULL),(212,'ativ-perio',22,102,'concluiu tarefa','2018-04-04 19:06:39',NULL,NULL),(213,'ativ-perio',65,111,'postergou','2018-04-04 19:35:21',NULL,NULL),(214,'ativ-perio',65,183,'postergou','2018-04-04 19:36:02',NULL,NULL),(215,'ativ-perio',65,184,'postergou','2018-04-04 19:36:24',NULL,NULL),(216,'ativ-perio',65,187,'postergou','2018-04-04 19:36:58',NULL,NULL),(217,'ativ-perio',11,50,'concluiu tarefa','2018-04-04 19:38:49',NULL,NULL),(218,'ativ-perio',39,169,'concluiu tarefa','2018-04-04 19:49:32',NULL,NULL),(219,'ativ-perio',18,120,'concluiu tarefa','2018-04-04 19:50:58',NULL,NULL),(220,'ativ-perio',18,121,'concluiu tarefa','2018-04-04 19:51:02',NULL,NULL),(221,'ativ-perio',22,108,'concluiu tarefa','2018-04-04 19:58:22',NULL,NULL),(222,'ativ-perio',16,190,'concluiu tarefa','2018-04-04 20:09:10',NULL,NULL),(223,'ativ-perio',11,48,'concluiu tarefa','2018-04-04 20:12:03',NULL,NULL),(224,'ativ-perio',22,107,'postergou','2018-04-04 20:17:32',NULL,NULL),(225,'ativ-perio',22,107,'postergou','2018-04-04 20:17:56',NULL,NULL),(226,'ativ-perio',30,144,'postergou','2018-04-04 20:25:46',NULL,NULL),(227,'ativ-perio',57,176,'concluiu tarefa','2018-04-04 20:28:15',NULL,NULL),(228,'ativ-perio',47,171,'concluiu tarefa','2018-04-04 20:29:03',NULL,NULL),(229,'ativ-perio',54,175,'concluiu tarefa','2018-04-04 20:29:04',NULL,NULL),(230,'ativ-perio',47,172,'concluiu tarefa','2018-04-04 20:29:05',NULL,NULL),(231,'ativ-perio',54,174,'postergou','2018-04-04 20:30:13',NULL,NULL),(232,'ativ-perio',49,173,'postergou','2018-04-04 20:32:33',NULL,NULL),(233,'ativ-perio',59,178,'postergou','2018-04-04 20:40:31',NULL,NULL),(234,'ativ-perio',44,170,'concluiu tarefa','2018-04-04 20:49:15',NULL,NULL),(235,'ativ-perio',11,51,'concluiu tarefa','2018-04-04 21:08:28',NULL,NULL),(236,'ativ-perio',94,195,'concluiu tarefa','2018-04-04 21:11:08',NULL,NULL),(237,'ativ-perio',10,53,'postergou','2018-04-04 21:17:42',NULL,NULL),(238,'ativ-perio',10,54,'postergou','2018-04-04 21:18:10',NULL,NULL),(239,'ativ-perio',10,57,'postergou','2018-04-04 21:18:42',NULL,NULL),(240,'ativ-perio',19,122,'concluiu tarefa','2018-04-04 21:19:31',NULL,NULL),(241,'ativ-perio',22,141,'concluiu tarefa','2018-04-04 21:57:02',NULL,NULL),(242,'ativ-perio',10,60,'concluiu tarefa','2018-04-04 22:02:44',NULL,NULL),(243,'ativ-perio',22,140,'postergou','2018-04-04 22:17:41',NULL,NULL),(244,'ativ-perio',11,34,'concluiu tarefa','2018-04-04 22:29:19',NULL,NULL),(245,'ativ-perio',22,99,'postergou','2018-04-04 22:41:38',NULL,NULL),(246,'ativ-perio',11,56,'postergou','2018-04-04 22:45:26',NULL,NULL),(247,'ativ-perio',22,99,'concluiu tarefa','2018-04-04 23:06:03',NULL,NULL),(248,'ativ-perio',88,204,'concluiu tarefa','2018-04-05 00:56:49',NULL,NULL),(249,'ativ-perio',94,207,'concluiu tarefa','2018-04-05 02:32:27',NULL,NULL),(250,'ativ-perio',65,183,'concluiu tarefa','2018-04-05 11:27:19',NULL,NULL),(251,'ativ-perio',20,125,'concluiu tarefa','2018-04-05 12:17:13',NULL,NULL),(252,'ativ-perio',33,146,'concluiu tarefa','2018-04-05 12:33:40',NULL,NULL),(253,'ativ-perio',33,148,'concluiu tarefa','2018-04-05 12:33:56',NULL,NULL),(254,'ativ-perio',33,147,'postergou','2018-04-05 12:35:42',NULL,NULL),(255,'ativ-perio',22,140,'concluiu tarefa','2018-04-05 12:40:35',NULL,NULL),(256,'ativ-perio',30,144,'postergou','2018-04-05 12:40:49',NULL,NULL),(257,'ativ-perio',59,178,'postergou','2018-04-05 12:48:41',NULL,NULL),(258,'ativ-perio',20,127,'concluiu tarefa','2018-04-05 13:16:33',NULL,NULL),(259,'ativ-perio',20,126,'concluiu tarefa','2018-04-05 13:16:53',NULL,NULL),(260,'ativ-perio',37,91,'concluiu tarefa','2018-04-05 13:53:15',NULL,NULL),(261,'ativ-perio',37,109,'concluiu tarefa','2018-04-05 13:53:43',NULL,NULL),(262,'ativ-perio',37,110,'concluiu tarefa','2018-04-05 13:53:57',NULL,NULL),(263,'ativ-perio',37,156,'concluiu tarefa','2018-04-05 13:54:12',NULL,NULL),(264,'ativ-perio',37,157,'concluiu tarefa','2018-04-05 13:54:26',NULL,NULL),(265,'ativ-perio',37,158,'concluiu tarefa','2018-04-05 13:54:35',NULL,NULL),(266,'ativ-perio',37,159,'concluiu tarefa','2018-04-05 13:54:41',NULL,NULL),(267,'ativ-perio',37,160,'concluiu tarefa','2018-04-05 13:54:47',NULL,NULL),(268,'ativ-perio',37,161,'concluiu tarefa','2018-04-05 13:54:56',NULL,NULL),(269,'ativ-perio',37,188,'concluiu tarefa','2018-04-05 13:55:09',NULL,NULL),(270,'ativ-perio',37,189,'concluiu tarefa','2018-04-05 13:55:20',NULL,NULL),(271,'ativ-perio',37,191,'concluiu tarefa','2018-04-05 13:55:27',NULL,NULL),(272,'ativ-perio',16,119,'concluiu tarefa','2018-04-05 14:13:41',NULL,NULL),(273,'ativ-perio',30,144,'concluiu tarefa','2018-04-05 14:42:56',NULL,NULL),(274,'ativ-perio',65,111,'concluiu tarefa','2018-04-05 14:55:50',NULL,NULL),(275,'ativ-perio',65,184,'concluiu tarefa','2018-04-05 14:56:04',NULL,NULL),(276,'ativ-perio',59,178,'postergou','2018-04-05 14:58:06',NULL,NULL),(277,'ativ-perio',54,174,'concluiu tarefa','2018-04-05 15:17:24',NULL,NULL),(278,'ativ-perio',57,177,'concluiu tarefa','2018-04-05 15:33:14',NULL,NULL),(279,'ativ-perio',16,118,'concluiu tarefa','2018-04-05 16:20:12',NULL,NULL),(280,'ativ-perio',49,173,'concluiu tarefa','2018-04-05 17:09:05',NULL,NULL),(281,'ativ-perio',33,147,'concluiu tarefa','2018-04-05 17:14:30',NULL,NULL),(282,'ativ-perio',10,54,'concluiu tarefa','2018-04-05 17:17:57',NULL,NULL),(283,'ativ-perio',11,61,'concluiu tarefa','2018-04-05 17:18:43',NULL,NULL),(284,'ativ-perio',11,66,'concluiu tarefa','2018-04-05 17:19:52',NULL,NULL),(285,'ativ-perio',11,56,'concluiu tarefa','2018-04-05 18:12:51',NULL,NULL),(286,'ativ-perio',65,103,'postergou','2018-04-05 18:14:45',NULL,NULL),(287,'ativ-perio',65,105,'postergou','2018-04-05 18:15:30',NULL,NULL),(288,'ativ-perio',65,103,'concluiu tarefa','2018-04-05 18:24:24',NULL,NULL),(289,'ativ-perio',10,53,'concluiu tarefa','2018-04-05 18:34:17',NULL,NULL),(290,'ativ-perio',10,57,'concluiu tarefa','2018-04-05 18:55:39',NULL,NULL),(291,'ativ-perio',35,96,'postergou','2018-04-05 19:17:16',NULL,NULL),(292,'ativ-perio',37,186,'postergou','2018-04-05 19:24:08',NULL,NULL),(293,'ativ-perio',88,193,'postergou','2018-04-05 19:56:35',NULL,NULL),(294,'ativ-perio',88,196,'concluiu tarefa','2018-04-05 19:56:49',NULL,NULL),(295,'ativ-perio',37,163,'concluiu tarefa','2018-04-05 20:02:35',NULL,NULL),(296,'ativ-perio',22,90,'concluiu tarefa','2018-04-05 20:10:34',NULL,NULL),(297,'ativ-perio',22,107,'concluiu tarefa','2018-04-05 20:11:05',NULL,NULL),(298,'ativ-perio',22,85,'concluiu tarefa','2018-04-05 20:15:00',NULL,NULL),(299,'ativ-perio',22,142,'concluiu tarefa','2018-04-05 20:30:16',NULL,NULL),(300,'ativ-perio',11,63,'postergou','2018-04-05 20:32:46',NULL,NULL),(301,'ativ-perio',11,62,'postergou','2018-04-05 20:33:18',NULL,NULL),(302,'ativ-perio',11,67,'postergou','2018-04-05 20:33:48',NULL,NULL),(303,'ativ-perio',11,74,'postergou','2018-04-05 20:34:34',NULL,NULL),(304,'ativ-perio',22,87,'concluiu tarefa','2018-04-05 20:42:42',NULL,NULL),(305,'ativ-perio',22,88,'concluiu tarefa','2018-04-05 20:42:59',NULL,NULL),(306,'ativ-perio',59,178,'postergou','2018-04-05 21:04:20',NULL,NULL),(307,'ativ-perio',59,179,'postergou','2018-04-05 21:05:04',NULL,NULL),(308,'ativ-perio',20,128,'concluiu tarefa','2018-04-05 22:00:30',NULL,NULL),(309,'ativ-perio',94,206,'concluiu tarefa','2018-04-05 23:02:53',NULL,NULL),(310,'ativ-perio',35,96,'concluiu tarefa','2018-04-06 11:44:42',NULL,NULL),(311,'ativ-perio',59,178,'concluiu tarefa','2018-04-06 11:44:58',NULL,NULL),(312,'ativ-perio',59,179,'concluiu tarefa','2018-04-06 11:47:29',NULL,NULL),(313,'ativ-perio',37,162,'concluiu tarefa','2018-04-06 12:11:11',NULL,NULL),(314,'ativ-perio',65,187,'concluiu tarefa','2018-04-06 12:24:55',NULL,NULL),(315,'ativ-perio',94,194,'concluiu tarefa','2018-04-06 13:16:36',NULL,NULL),(316,'ativ-perio',94,205,'postergou','2018-04-06 13:18:58',NULL,NULL),(317,'ativ-perio',11,62,'concluiu tarefa','2018-04-06 14:14:48',NULL,NULL),(318,'ativ-perio',22,86,'concluiu tarefa','2018-04-06 14:32:55',NULL,NULL),(319,'ativ-perio',136,210,'concluiu tarefa','2018-04-06 14:44:45',NULL,NULL),(320,'ativ-perio',136,211,'concluiu tarefa','2018-04-06 14:51:53',NULL,NULL),(321,'ativ-perio',10,59,'concluiu tarefa','2018-04-06 14:52:00',NULL,NULL),(322,'ativ-perio',136,212,'concluiu tarefa','2018-04-06 14:53:01',NULL,NULL),(323,'ativ-perio',136,213,'concluiu tarefa','2018-04-06 14:53:58',NULL,NULL),(324,'ativ-perio',136,214,'concluiu tarefa','2018-04-06 14:55:28',NULL,NULL),(325,'ativ-perio',94,205,'concluiu tarefa','2018-04-06 15:43:20',NULL,NULL),(326,'ativ-perio',37,186,'concluiu tarefa','2018-04-06 16:55:47',NULL,NULL),(327,'ativ-perio',65,105,'concluiu tarefa','2018-04-06 18:17:16',NULL,NULL),(328,'ativ-perio',10,75,'concluiu tarefa','2018-04-06 18:17:30',NULL,NULL),(329,'ativ-perio',11,63,'concluiu tarefa','2018-04-06 19:44:36',NULL,NULL),(330,'ativ-perio',10,71,'concluiu tarefa','2018-04-06 22:01:22',NULL,NULL),(331,'ativ-perio',14,165,'concluiu tarefa','2018-04-06 23:46:39',NULL,NULL),(332,'ativ-perio',14,168,'concluiu tarefa','2018-04-06 23:47:04',NULL,NULL),(333,'ativ-perio',14,167,'concluiu tarefa','2018-04-06 23:47:40',NULL,NULL),(334,'ativ-perio',14,166,'concluiu tarefa','2018-04-06 23:47:57',NULL,NULL),(335,'ativ-perio',14,77,'concluiu tarefa','2018-04-06 23:48:13',NULL,NULL),(336,'ativ-perio',11,74,'concluiu tarefa','2018-04-09 11:58:36',NULL,NULL),(337,'ativ-perio',10,69,'concluiu tarefa','2018-04-09 12:11:50',NULL,NULL),(338,'ativ-perio',10,70,'concluiu tarefa','2018-04-09 12:13:41',NULL,NULL),(339,'ativ-perio',10,73,'concluiu tarefa','2018-04-09 12:46:41',NULL,NULL),(340,'ativ-perio',10,72,'concluiu tarefa','2018-04-09 12:52:07',NULL,NULL),(341,'ativ-perio',22,89,'concluiu tarefa','2018-04-09 13:03:19',NULL,NULL),(342,'ativ-perio',10,68,'concluiu tarefa','2018-04-09 13:18:46',NULL,NULL),(343,'ativ-perio',88,193,'concluiu tarefa','2018-04-09 14:10:43',NULL,NULL),(344,'ativ-perio',71,192,'concluiu tarefa','2018-04-09 14:18:19',NULL,NULL),(345,'ativ-perio',94,197,'postergou','2018-04-09 14:20:42',NULL,NULL),(346,'ativ-perio',94,209,'postergou','2018-04-09 14:20:56',NULL,NULL),(347,'ativ-perio',11,67,'concluiu tarefa','2018-04-09 16:58:42',NULL,NULL),(348,'ativ-perio',64,78,'concluiu tarefa','2018-04-09 18:18:12',NULL,NULL),(349,'ativ-perio',94,197,'concluiu tarefa','2018-04-09 23:57:22',NULL,NULL),(350,'ativ-perio',94,209,'concluiu tarefa','2018-04-09 23:57:30',NULL,NULL),(351,'ativ-perio',9,76,'concluiu tarefa','2018-04-10 14:21:31',NULL,NULL),(352,'ativ-perio',72,208,'concluiu tarefa','2018-04-11 17:06:05',NULL,NULL);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;