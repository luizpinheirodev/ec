SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

USE `econtabil`;

DROP TABLE IF EXISTS `atividades`;
CREATE TABLE IF NOT EXISTS `atividades` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `float` int(11) DEFAULT NULL,
  `float_hora` time DEFAULT NULL,
  `duracao` int(11) DEFAULT NULL,
  `usuario_id` int(10) UNSIGNED DEFAULT NULL,
  `gerencia_id` int(10) UNSIGNED DEFAULT NULL,
  `empresa_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `atividades_gerencia_id_foreign` (`gerencia_id`),
  KEY `atividades_empresa_id_foreign` (`empresa_id`),
  KEY `atividades_usuario_id_foreign` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `atividades` (`id`, `nome`, `float`, `float_hora`, `duracao`, `usuario_id`, `gerencia_id`, `empresa_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Crédito Tributário', 1, '18:00:00', 5, 4, 2, 7, '2017-09-15 01:04:01', '2017-09-15 01:06:04', NULL),
(2, 'Conferência Conta Corrente', 1, '18:00:00', 3, 1, 1, 3, '2017-09-15 13:04:55', '2017-09-15 13:04:55', NULL),
(3, 'Envio dos valores para contabilização dos Juros Divida Subordinada IFC', 1, '12:00:00', 2, 4, 3, 3, '2017-09-15 13:05:52', '2017-11-25 11:35:02', NULL),
(4, 'Enviar lançamentos da dívida subordinada passiva', -1, '18:00:00', 3, 5, 3, 1, '2017-09-15 13:07:00', '2017-09-15 13:07:00', NULL),
(5, 'Conciliação dos Passivos Contingentes', 2, '18:00:00', 4, 1, 1, 4, '2017-09-15 13:08:05', '2017-09-15 13:08:05', NULL),
(6, 'Contabilização dos Passivos ( recurso repassado)', 3, '18:00:00', 6, 1, 1, 1, '2017-09-15 13:09:25', '2017-09-15 13:09:25', NULL),
(7, 'Teste6', 5, '21:20:00', 5, 1, 1, 4, '2017-09-17 15:07:25', '2017-09-17 15:07:25', NULL),
(8, 'asasas', 2, '12:00:00', 3, 1, 3, 4, '2017-10-09 17:45:15', '2017-10-09 17:45:15', NULL),
(9, 'Atividade teste trigger', 2, '18:00:00', 5, 4, 4, 8, '2017-10-26 16:05:20', '2017-11-25 13:13:08', NULL),
(10, 'Outra atividade', 5, '18:00:00', NULL, 1, 2, 9, '2017-10-26 16:07:42', '2017-11-25 11:12:16', NULL),
(11, 'Atividade Outra', -2, '12:00:00', NULL, 4, 1, 6, '2017-10-26 16:08:40', '2017-10-26 16:08:40', NULL),
(12, 'Ultima atividade', 2, '14:09:00', NULL, 5, 4, 10, '2017-10-26 16:09:50', '2017-10-26 16:44:20', NULL),
(13, 'aqaqaqaqaqaq', -2, '03:02:00', NULL, 3, 4, 1, '2017-10-26 19:02:43', '2017-11-25 11:38:59', NULL),
(14, 'Ativ Penultimo dia', -2, '18:00:00', NULL, 5, 1, 1, '2017-11-16 18:23:17', '2017-11-25 11:34:07', NULL),
(15, 'Envio dos termos', 1, '18:00:00', NULL, 1, 2, 1, '2017-12-08 20:05:31', '2017-12-08 20:05:31', NULL);
DROP TRIGGER IF EXISTS `atividade_after_ins`;

CREATE TRIGGER `atividade_after_ins` AFTER INSERT ON `atividades` FOR EACH ROW BEGIN

   INSERT INTO atividade__periodos
   ( periodo_id,
	 atividade_id,
     user_id, 
     conclusao
     )
    select (select max(periodo_id) from atividade__periodos) periodo, 
    
    a.id, a.usuario_id, 0 
   from atividades a
   where a.id = new.id;
   

END

;
DROP TRIGGER IF EXISTS `atividade_after_up`;

CREATE TRIGGER `atividade_after_up` AFTER UPDATE ON `atividades` FOR EACH ROW BEGIN

	update atividade__periodos 
    set user_id = new.usuario_id
    where atividade_id = new.id
    and periodo_id = (select max(id) from periodos);
       

END

;

DROP TABLE IF EXISTS `atividade__periodos`;
CREATE TABLE IF NOT EXISTS `atividade__periodos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `atividade_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `conclusao` tinyint(1) NOT NULL DEFAULT '0',
  `concluido_user_id` int(10) UNSIGNED DEFAULT NULL,
  `previsao` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `atividade__periodos_periodo_id_foreign` (`periodo_id`),
  KEY `atividade__periodos_atividade_id_foreign` (`atividade_id`),
  KEY `atividade__periodos_concluido_user_id_foreign` (`concluido_user_id`),
  KEY `atividade__periodos_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `atividade__periodos` (`id`, `periodo_id`, `atividade_id`, `user_id`, `conclusao`, `concluido_user_id`, `previsao`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 1, 1, NULL, NULL, '2017-10-26 19:04:55', NULL),
(2, 1, 5, 1, 0, NULL, NULL, NULL, NULL, NULL),
(3, 1, 6, 1, 0, NULL, '2017-10-27 17:08:00', NULL, '2017-10-26 19:08:29', NULL),
(4, 1, 1, 4, 0, NULL, NULL, NULL, NULL, NULL),
(5, 1, 3, 5, 1, 5, NULL, NULL, '2017-10-26 19:05:43', NULL),
(6, 1, 4, 5, 1, 5, NULL, NULL, '2017-10-26 19:05:58', NULL),
(7, 1, 9, 1, 1, 1, NULL, NULL, '2017-10-26 17:55:46', NULL),
(8, 1, 10, 4, 0, NULL, NULL, NULL, NULL, NULL),
(9, 1, 11, 4, 0, NULL, NULL, NULL, NULL, NULL),
(10, 1, 12, 5, 1, 5, NULL, NULL, '2017-10-26 17:19:29', NULL),
(11, 1, 13, 5, 0, NULL, '2017-11-01 18:00:00', NULL, '2017-11-07 19:15:42', NULL),
(27, 3, 2, 1, 1, 1, NULL, NULL, '2017-11-07 19:10:13', NULL),
(28, 3, 5, 1, 0, NULL, NULL, NULL, NULL, NULL),
(29, 3, 6, 1, 0, NULL, NULL, NULL, NULL, NULL),
(30, 3, 7, 1, 1, 1, NULL, NULL, '2017-11-01 16:36:34', NULL),
(31, 3, 8, 1, 1, 1, NULL, NULL, '2017-11-11 10:31:56', NULL),
(32, 3, 9, 1, 1, 1, NULL, NULL, '2017-11-11 10:34:10', NULL),
(33, 3, 1, 4, 0, NULL, NULL, NULL, NULL, NULL),
(34, 3, 10, 4, 0, NULL, NULL, NULL, NULL, NULL),
(35, 3, 11, 4, 0, NULL, NULL, NULL, NULL, NULL),
(36, 3, 3, 5, 0, NULL, NULL, NULL, NULL, NULL),
(37, 3, 4, 5, 0, NULL, NULL, NULL, NULL, NULL),
(38, 3, 12, 5, 0, NULL, NULL, NULL, NULL, NULL),
(39, 3, 13, 5, 0, NULL, NULL, NULL, NULL, NULL),
(40, 4, 2, 1, 1, 1, '2017-12-05 18:00:00', NULL, '2017-12-04 17:11:48', NULL),
(41, 4, 5, 1, 0, NULL, NULL, NULL, NULL, NULL),
(42, 4, 6, 1, 0, NULL, NULL, NULL, NULL, NULL),
(43, 4, 7, 1, 1, 1, '2017-12-05 06:59:00', NULL, '2017-12-04 16:44:54', NULL),
(44, 4, 8, 1, 1, 1, '2017-12-27 18:30:00', NULL, '2017-12-08 20:07:21', NULL),
(45, 4, 9, 4, 0, NULL, NULL, NULL, NULL, NULL),
(46, 4, 1, 4, 0, NULL, NULL, NULL, NULL, NULL),
(47, 4, 10, 4, 0, NULL, NULL, NULL, NULL, NULL),
(48, 4, 11, 4, 0, NULL, NULL, NULL, NULL, NULL),
(49, 4, 3, 4, 0, NULL, NULL, NULL, NULL, NULL),
(50, 4, 4, 5, 0, NULL, NULL, NULL, NULL, NULL),
(51, 4, 12, 5, 0, NULL, NULL, NULL, NULL, NULL),
(52, 4, 13, 3, 1, 1, NULL, NULL, '2017-11-25 12:56:18', NULL),
(55, 4, 14, 5, 0, NULL, NULL, NULL, NULL, NULL),
(56, 4, 15, 1, 0, NULL, '2017-12-08 12:00:00', NULL, '2017-12-08 20:06:55', NULL);
DROP TRIGGER IF EXISTS `atividade_periodo_log`;

CREATE TRIGGER `atividade_periodo_log` AFTER UPDATE ON `atividade__periodos` FOR EACH ROW BEGIN

	if new.user_id = old.user_id then

		INSERT INTO fechamento.logs
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
    
		INSERT INTO fechamento.logs
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

;

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `texto` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `atividade_periodo_id` int(10) UNSIGNED DEFAULT NULL,
  `resposta_id` int(10) UNSIGNED DEFAULT NULL,
  `anexo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comentarios_atividade_periodo_id_foreign` (`atividade_periodo_id`),
  KEY `comentarios_usuario_id_foreign` (`usuario_id`),
  KEY `comentarios_resposta_id_foreign` (`resposta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comentarios` (`id`, `texto`, `usuario_id`, `atividade_periodo_id`, `resposta_id`, `anexo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mussum Ipsum, cacilds vidis litro abertis. In elementis mé pra quem é amistosis quis leo. Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo! Viva Forevis aptent taciti sociosqu ad litora torquent. Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget.\r\nManduma pindureta quium dia nois paga. Cevadis im ampola pa arma uma pindureta. Suco de cevadiss deixa as pessoas mais interessantis. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.', 5, 2, NULL, '5 2017-09-16 10-02-19 arquser extras.txt', '2017-09-16 13:02:19', '2017-09-16 13:02:19', NULL),
(2, 'Mussum Ipsum, cacilds vidis litro abertis. In elementis mé pra quem é amistosis quis leo. Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo! Viva Forevis aptent taciti sociosqu ad litora torquent. Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget.', 5, 5, NULL, '5 2017-09-16 10-18-19 arquser Tempo Gasto.xlsx', '2017-09-16 13:18:19', '2017-09-16 13:18:19', NULL),
(3, 'Viva Forevis aptent taciti sociosqu ad litora torquent. Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget.', 1, NULL, 1, NULL, '2017-09-16 13:19:47', '2017-09-16 13:19:47', NULL),
(4, 'Rateio', 1, 1, NULL, '1 2017-10-09 14-50-35 arquser RJ.xlsx', '2017-10-09 17:50:35', '2017-10-09 17:50:35', NULL),
(5, 'asasasa', 1, NULL, 4, NULL, '2017-10-09 17:51:00', '2017-10-09 17:51:00', NULL),
(6, 'alksajlskjakjas alksjalk sjasa', 1, 9, NULL, NULL, '2017-10-26 19:11:20', '2017-10-26 19:11:20', NULL),
(8, 'teste 25 de nov', 1, NULL, NULL, NULL, '2017-11-25 13:55:03', '2017-11-25 13:55:03', NULL),
(9, 'z\\mzn,\\mnz,\\mnz\\j', 1, 4, NULL, '1 2017-11-27 14-10-54 arquser RJ-Despesas.xlsx', '2017-11-27 16:10:54', '2017-11-27 16:10:54', NULL),
(10, 'sasasas', 1, NULL, 9, NULL, '2017-12-01 16:47:35', '2017-12-01 16:47:35', NULL),
(11, 'Segue composição dos fundos', 1, 1, NULL, NULL, '2017-12-08 20:09:01', '2017-12-08 20:09:01', NULL),
(12, 'siahsiauhsiuahsiuahijcasn asi aiush aish iah sia  aihsa', 1, NULL, 2, NULL, '2017-12-08 20:09:29', '2017-12-08 20:09:29', NULL);

DROP TABLE IF EXISTS `dependencias`;
CREATE TABLE IF NOT EXISTS `dependencias` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `atividade_id1` int(10) UNSIGNED NOT NULL,
  `atividade_id2` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dependencias_atividade_id1_foreign` (`atividade_id1`),
  KEY `dependencias_atividade_id2_foreign` (`atividade_id2`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dependencias` (`id`, `atividade_id1`, `atividade_id2`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 3, '2017-09-15 13:13:55', '2017-09-15 13:13:55', NULL),
(2, 5, 3, '2017-09-15 14:18:40', '2017-09-15 14:18:40', NULL),
(3, 6, 4, '2017-10-26 17:29:15', '2017-10-26 17:29:15', NULL);

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `empresas` (`id`, `nome`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cooperativas', '2017-09-15 00:23:10', '2017-09-15 00:23:10', NULL),
(2, 'Centrais', '2017-09-15 00:23:26', '2017-09-15 00:23:26', NULL),
(3, 'Banco', '2017-09-15 00:23:36', '2017-09-15 00:23:36', NULL),
(4, 'Confederação', '2017-09-15 00:23:51', '2017-09-15 00:23:51', NULL),
(5, 'Corretora', '2017-09-15 00:24:04', '2017-09-15 00:24:04', NULL),
(6, 'Consórcio', '2017-09-15 00:24:11', '2017-09-15 00:24:11', NULL),
(7, 'Cartões', '2017-09-15 00:24:20', '2017-09-15 00:24:20', NULL),
(8, 'Fundos', '2017-09-15 00:24:27', '2017-09-15 00:24:27', NULL),
(9, 'Adm. de Bens', '2017-09-15 00:31:10', '2017-10-26 16:22:58', NULL),
(10, 'Fundação', '2017-09-15 00:31:21', '2017-09-15 00:31:21', NULL);

DROP TABLE IF EXISTS `feriados`;
CREATE TABLE IF NOT EXISTS `feriados` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `feriados` (`id`, `nome`, `data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Finados', '2017-11-02', '2017-11-16 13:37:09', '2017-11-16 13:37:09', NULL),
(3, 'Ano Novo', '2018-01-01', '2017-11-16 18:19:37', '2017-11-16 18:19:37', NULL);

DROP TABLE IF EXISTS `gerencias`;
CREATE TABLE IF NOT EXISTS `gerencias` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `gerencias` (`id`, `nome`, `sigla`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gerência Contábil', 'GCT', '2017-09-14 23:42:04', '2017-09-14 23:42:04', NULL),
(2, 'Gerência Fiscal', 'GFI', '2017-09-15 00:21:00', '2017-09-15 00:21:00', NULL),
(3, 'Gerência de Controladoria', 'GCO', '2017-09-15 00:27:23', '2017-09-15 00:27:23', NULL),
(4, 'Serviço de Gestão de Pessoas', 'SGP', '2017-09-15 00:27:35', '2017-09-15 00:27:35', NULL);

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `atividade_id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_atividade_id_foreign` (`atividade_id`),
  KEY `logs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `logs` (`id`, `nome`, `user_id`, `atividade_id`, `tipo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ativ-perio', 1, 9, '', '2017-10-26 17:55:46', NULL, NULL),
(2, 'ativ-perio', 1, 2, '', '2017-10-26 19:04:55', NULL, NULL),
(3, 'ativ-perio', 5, 3, '', '2017-10-26 19:05:43', NULL, NULL),
(4, 'ativ-perio', 5, 4, '', '2017-10-26 19:05:58', NULL, NULL),
(5, 'ativ-perio', 1, 6, '', '2017-10-26 19:08:29', NULL, NULL),
(6, 'ativ-perio', 1, 7, '', '2017-11-01 16:36:34', NULL, NULL),
(7, 'ativ-perio', 1, 2, '', '2017-11-07 19:10:13', NULL, NULL),
(8, 'ativ-perio', 5, 13, '', '2017-11-07 19:15:42', NULL, NULL),
(9, 'ativ-perio', 1, 8, '', '2017-11-11 10:31:56', NULL, NULL),
(10, 'ativ-perio', 1, 9, '', '2017-11-11 10:34:10', NULL, NULL),
(11, 'ativ-perio', 5, 14, '', '2017-11-25 11:34:07', NULL, NULL),
(12, 'ativ-perio', 4, 3, '', '2017-11-25 11:35:02', NULL, NULL),
(13, 'ativ-perio', 4, 13, '', '2017-11-25 11:38:47', NULL, NULL),
(14, 'ativ-perio', 3, 13, '', '2017-11-25 11:38:59', NULL, NULL),
(15, 'ativ-perio', 4, 9, 'alterou o responsavel', '2017-11-25 12:43:27', NULL, NULL),
(16, 'ativ-perio', 3, 13, 'concluiu tarefa', '2017-11-25 12:46:37', NULL, NULL),
(17, 'ativ-perio', 3, 13, 'concluiu tarefa', '2017-11-25 12:52:36', NULL, NULL),
(18, 'ativ-perio', 3, 13, 'concluiu tarefa', '2017-11-25 12:52:49', NULL, NULL),
(19, 'ativ-perio', 3, 13, 'concluiu tarefa', '2017-11-25 12:53:25', NULL, NULL),
(20, 'ativ-perio', 1, 13, 'concluiu tarefa', '2017-11-25 12:56:18', NULL, NULL),
(21, 'ativ-perio', 1, 9, 'alterou o responsavel', '2017-11-25 13:04:41', NULL, NULL),
(22, 'ativ-perio', 4, 9, 'alterou o responsavel', '2017-11-25 13:13:08', NULL, NULL),
(23, 'ativ-perio', 1, 7, 'concluiu tarefa', '2017-11-27 16:07:49', NULL, NULL),
(25, 'ativ-perio', 1, 7, 'concluiu tarefa', '2017-12-04 16:44:54', NULL, NULL),
(26, 'ativ-perio', 1, 8, 'postergou', '2017-12-04 17:08:03', NULL, NULL),
(27, 'ativ-perio', 1, 2, 'concluiu tarefa', '2017-12-04 17:11:48', NULL, NULL),
(28, 'ativ-perio', 1, 15, 'postergou', '2017-12-08 20:06:55', NULL, NULL),
(29, 'ativ-perio', 1, 8, 'concluiu tarefa', '2017-12-08 20:07:21', NULL, NULL);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_06_23_023644_create_gerencias_table', 1),
(2, '2017_06_23_023645_create_users_table', 1),
(3, '2017_06_23_023646_create_password_resets_table', 1),
(4, '2017_06_23_023702_create_empresas_table', 1),
(5, '2017_06_23_023717_create_periodos_table', 1),
(6, '2017_06_23_023719_create_atividades_table', 1),
(7, '2017_06_23_023753_create_atividade__periodos_table', 1),
(8, '2017_06_23_023813_create_dependencias_table', 1),
(9, '2017_08_10_002842_create_logs_table', 1),
(10, '2017_09_09_123328_create_comentarios_table', 1),
(11, '2017_09_11_100806_create_feriados_table', 1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `periodos`;
CREATE TABLE IF NOT EXISTS `periodos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado` tinyint(1) DEFAULT '0',
  `periodo` tinyint(1) DEFAULT '0',
  `bool` tinyint(1) DEFAULT '0',
  `diasfechamento` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `periodos` (`id`, `nome`, `resultado`, `periodo`, `bool`, `diasfechamento`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '06/2016', 0, 0, 0, 5, '2017-09-15 13:17:24', '2017-10-26 19:14:19', NULL),
(3, '06/2017', 0, 0, 0, 4, '2017-11-01 14:07:14', '2017-11-01 14:07:14', NULL),
(4, '10/2017', 0, 0, 0, 0, '2017-11-16 13:36:24', '2017-11-16 13:36:24', NULL);
DROP TRIGGER IF EXISTS `atividade_periodo_after_up`;

CREATE TRIGGER `atividade_periodo_after_up` AFTER INSERT ON `periodos` FOR EACH ROW BEGIN

   INSERT INTO atividade__periodos
   ( periodo_id,
	 atividade_id,
     user_id,
     created_at
     )
    select p.id, a.id, a.usuario_id, SYSDATE() 
   from periodos p , atividades a
   where p.id = new.id;
   

END

;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ramal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gerencia_id` int(10) UNSIGNED NOT NULL,
  `gerente_id` int(10) UNSIGNED DEFAULT NULL,
  `nivel` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_gerencia_id_foreign` (`gerencia_id`),
  KEY `users_gerente_id_foreign` (`gerente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `nome`, `email`, `password`, `ramal`, `gerencia_id`, `gerente_id`, `nivel`, `foto`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Luiz Geraldo Pinheiro', 'luizpinheiro.rs@gmail.com', '$2y$10$zhfNOmXxmJzSzCgza7ZgguRrsuzmzJ/cDbVLmRzy8ElSjhD8a2GjW', '8308', 1, 1, 1, NULL, '66ogMSLIjRSLsvVA94JITCYjo2224kDh0X3zK6p4dIBLB0PzItD0nLTqP9KS', '2017-09-14 23:45:23', '2017-12-03 13:46:05', NULL),
(2, 'Gerente do Fiscal', 'gerentefiscal@gerentefiscal.com.br', '$2y$10$a3L8IaqVnlwkR4MgW97.v.xOF8AsztGQakthGhlLK9UjtEnbystUO', '1234', 2, 1, 3, NULL, NULL, '2017-09-15 00:42:41', '2017-09-15 00:42:41', NULL),
(3, 'Gerente da controladoria', 'gercontroladoria@controladoria.com.br', '$2y$10$zIscULu2I/Itjdd.eMm7/.pH0Byemnls.nSwjdTmnMMPB02Hx6kkm', '4321', 3, 1, 3, NULL, NULL, '2017-09-15 00:43:47', '2017-09-15 00:49:33', NULL),
(4, 'Fulano do Fiscal', 'fulandodofiscal@fiscal.com.br', '$2y$10$7o6YRAEiUXM1qUeAyVfCPuNGbeZmABc/ax7JJQa2W7SDjEAhA0ovW', '1111', 2, 2, 4, NULL, NULL, '2017-09-15 00:52:33', '2017-09-15 00:52:33', NULL),
(5, 'Beltrano da Controladoria', 'beltranodacontro@control.com.br', '$2y$10$0/pL9NEvoRLY9B3C2unw8uXWCqcfcTG1lcmusWoKDyYZGsLpEs4oC', '2222', 3, 3, 4, NULL, 'Duy681El1L7R6uG5ka1qPZUvcdLXk2rQHZbpswJ3GL1ByzmZwj7NcMAR0KWN', '2017-09-15 00:53:28', '2017-11-17 19:40:36', NULL);


ALTER TABLE `atividades`
  ADD CONSTRAINT `atividades_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `atividades_gerencia_id_foreign` FOREIGN KEY (`gerencia_id`) REFERENCES `gerencias` (`id`),
  ADD CONSTRAINT `atividades_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `atividade__periodos`
  ADD CONSTRAINT `atividade__periodos_atividade_id_foreign` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`),
  ADD CONSTRAINT `atividade__periodos_concluido_user_id_foreign` FOREIGN KEY (`concluido_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `atividade__periodos_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`),
  ADD CONSTRAINT `atividade__periodos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_atividade_periodo_id_foreign` FOREIGN KEY (`atividade_periodo_id`) REFERENCES `atividade__periodos` (`id`),
  ADD CONSTRAINT `comentarios_resposta_id_foreign` FOREIGN KEY (`resposta_id`) REFERENCES `comentarios` (`id`),
  ADD CONSTRAINT `comentarios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

ALTER TABLE `dependencias`
  ADD CONSTRAINT `dependencias_atividade_id1_foreign` FOREIGN KEY (`atividade_id1`) REFERENCES `atividades` (`id`),
  ADD CONSTRAINT `dependencias_atividade_id2_foreign` FOREIGN KEY (`atividade_id2`) REFERENCES `atividades` (`id`);

ALTER TABLE `logs`
  ADD CONSTRAINT `logs_atividade_id_foreign` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`),
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `users`
  ADD CONSTRAINT `users_gerencia_id_foreign` FOREIGN KEY (`gerencia_id`) REFERENCES `gerencias` (`id`),
  ADD CONSTRAINT `users_gerente_id_foreign` FOREIGN KEY (`gerente_id`) REFERENCES `users` (`id`);
COMMIT;

