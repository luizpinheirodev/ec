SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

USE econtabildb;

DROP TABLE IF EXISTS atividades;
CREATE TABLE IF NOT EXISTS atividades (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(255) COLLATE latin1_general_ci NOT NULL,
  `float` int(11) DEFAULT NULL,
  float_hora time DEFAULT NULL,
  duracao int(11) DEFAULT NULL,
  usuario_id int(10) UNSIGNED DEFAULT NULL,
  gerencia_id int(10) UNSIGNED DEFAULT NULL,
  empresa_id int(10) UNSIGNED DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY atividades_gerencia_id_foreign (gerencia_id),
  KEY atividades_empresa_id_foreign (empresa_id),
  KEY atividades_usuario_id_foreign (usuario_id)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;


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

DROP TABLE IF EXISTS atividade__periodos;
CREATE TABLE IF NOT EXISTS atividade__periodos (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  periodo_id int(10) UNSIGNED NOT NULL,
  atividade_id int(10) UNSIGNED NOT NULL,
  user_id int(10) UNSIGNED NOT NULL,
  conclusao tinyint(1) NOT NULL DEFAULT 0,
  concluido_user_id int(10) UNSIGNED DEFAULT NULL,
  previsao datetime DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY atividade__periodos_periodo_id_foreign (periodo_id),
  KEY atividade__periodos_atividade_id_foreign (atividade_id),
  KEY atividade__periodos_concluido_user_id_foreign (concluido_user_id),
  KEY atividade__periodos_user_id_foreign (user_id)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;

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

DROP TABLE IF EXISTS comentarios;
CREATE TABLE IF NOT EXISTS comentarios (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  texto longtext COLLATE latin1_general_ci NOT NULL,
  usuario_id int(10) UNSIGNED NOT NULL,
  atividade_periodo_id int(10) UNSIGNED DEFAULT NULL,
  resposta_id int(10) UNSIGNED DEFAULT NULL,
  anexo varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY comentarios_atividade_periodo_id_foreign (atividade_periodo_id),
  KEY comentarios_usuario_id_foreign (usuario_id),
  KEY comentarios_resposta_id_foreign (resposta_id)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS dependencias;
CREATE TABLE IF NOT EXISTS dependencias (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  atividade_id1 int(10) UNSIGNED NOT NULL,
  atividade_id2 int(10) UNSIGNED NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY dependencias_atividade_id1_foreign (atividade_id1),
  KEY dependencias_atividade_id2_foreign (atividade_id2)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS empresas;
CREATE TABLE IF NOT EXISTS empresas (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(255) COLLATE latin1_general_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;

INSERT INTO empresas (id, nome, created_at, updated_at, deleted_at) VALUES
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

DROP TABLE IF EXISTS feriados;
CREATE TABLE IF NOT EXISTS feriados (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(255) COLLATE latin1_general_ci NOT NULL,
  data date NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;

INSERT INTO feriados (id, nome, `data`, created_at, updated_at, deleted_at) VALUES
(2, 'Finados', '2017-11-02', '2017-11-16 13:37:09', '2017-11-16 13:37:09', NULL),
(3, 'Ano Novo', '2018-01-01', '2017-11-16 18:19:37', '2017-11-16 18:19:37', NULL);

DROP TABLE IF EXISTS gerencias;
CREATE TABLE IF NOT EXISTS gerencias (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(255) COLLATE latin1_general_ci NOT NULL,
  sigla varchar(255) COLLATE latin1_general_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;

DROP TABLE IF EXISTS logs;
CREATE TABLE IF NOT EXISTS `logs` (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  user_id int(10) UNSIGNED NOT NULL,
  atividade_id int(10) UNSIGNED NOT NULL,
  tipo varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY logs_atividade_id_foreign (atividade_id),
  KEY logs_user_id_foreign (user_id)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;

DROP TABLE IF EXISTS migrations;
CREATE TABLE IF NOT EXISTS migrations (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  migration varchar(255) COLLATE latin1_general_ci NOT NULL,
  batch int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;

INSERT INTO migrations (id, migration, batch) VALUES
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

DROP TABLE IF EXISTS password_resets;
CREATE TABLE IF NOT EXISTS password_resets (
  email varchar(255) COLLATE latin1_general_ci NOT NULL,
  token varchar(255) COLLATE latin1_general_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  KEY password_resets_email_index (email)
) ENGINE=InnoDB DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;

DROP TABLE IF EXISTS periodos;
CREATE TABLE IF NOT EXISTS periodos (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(255) COLLATE latin1_general_ci NOT NULL,
  resultado tinyint(1) DEFAULT 0,
  periodo tinyint(1) DEFAULT 0,
  bool tinyint(1) DEFAULT 0,
  diasfechamento int(11) DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;


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

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome varchar(255) COLLATE latin1_general_ci NOT NULL,
  email varchar(255) COLLATE latin1_general_ci NOT NULL,
  password varchar(255) COLLATE latin1_general_ci NOT NULL,
  ramal varchar(255) COLLATE latin1_general_ci NOT NULL,
  gerencia_id int(10) UNSIGNED NOT NULL,
  gerente_id int(10) UNSIGNED DEFAULT NULL,
  nivel int(11) NOT NULL,
  foto varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  remember_token varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email),
  KEY users_gerencia_id_foreign (gerencia_id),
  KEY users_gerente_id_foreign (gerente_id)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=Latin1 COLLATE=latin1_general_ci;

INSERT INTO users (id, nome, email, `password`, ramal, gerencia_id, gerente_id, nivel, foto, remember_token, created_at, updated_at, deleted_at) VALUES
(1, 'Luiz Geraldo Pinheiro', 'luizpinheiro.rs@gmail.com', '$2y$10$zhfNOmXxmJzSzCgza7ZgguRrsuzmzJ/cDbVLmRzy8ElSjhD8a2GjW', '8308', 1, 1, 1, NULL, '66ogMSLIjRSLsvVA94JITCYjo2224kDh0X3zK6p4dIBLB0PzItD0nLTqP9KS', '2017-09-14 23:45:23', '2017-12-03 13:46:05', NULL);


ALTER TABLE atividades
  ADD CONSTRAINT atividades_empresa_id_foreign FOREIGN KEY (empresa_id) REFERENCES empresas (id),
  ADD CONSTRAINT atividades_gerencia_id_foreign FOREIGN KEY (gerencia_id) REFERENCES gerencias (id),
  ADD CONSTRAINT atividades_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES `users` (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE atividade__periodos
  ADD CONSTRAINT atividade__periodos_atividade_id_foreign FOREIGN KEY (atividade_id) REFERENCES atividades (id),
  ADD CONSTRAINT atividade__periodos_concluido_user_id_foreign FOREIGN KEY (concluido_user_id) REFERENCES `users` (id),
  ADD CONSTRAINT atividade__periodos_periodo_id_foreign FOREIGN KEY (periodo_id) REFERENCES periodos (id),
  ADD CONSTRAINT atividade__periodos_user_id_foreign FOREIGN KEY (user_id) REFERENCES `users` (id);

ALTER TABLE comentarios
  ADD CONSTRAINT comentarios_atividade_periodo_id_foreign FOREIGN KEY (atividade_periodo_id) REFERENCES atividade__periodos (id),
  ADD CONSTRAINT comentarios_resposta_id_foreign FOREIGN KEY (resposta_id) REFERENCES comentarios (id),
  ADD CONSTRAINT comentarios_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES `users` (id);

ALTER TABLE dependencias
  ADD CONSTRAINT dependencias_atividade_id1_foreign FOREIGN KEY (atividade_id1) REFERENCES atividades (id),
  ADD CONSTRAINT dependencias_atividade_id2_foreign FOREIGN KEY (atividade_id2) REFERENCES atividades (id);

ALTER TABLE `logs`
  ADD CONSTRAINT logs_atividade_id_foreign FOREIGN KEY (atividade_id) REFERENCES atividades (id),
  ADD CONSTRAINT logs_user_id_foreign FOREIGN KEY (user_id) REFERENCES `users` (id);

ALTER TABLE users
  ADD CONSTRAINT users_gerencia_id_foreign FOREIGN KEY (gerencia_id) REFERENCES gerencias (id),
  ADD CONSTRAINT users_gerente_id_foreign FOREIGN KEY (gerente_id) REFERENCES `users` (id);
COMMIT;

