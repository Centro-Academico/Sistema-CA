-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.45-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema sis_sea
--

CREATE DATABASE IF NOT EXISTS sis_sea;
USE sis_sea;

--
-- Definition of table `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
CREATE TABLE `arquivos` (
  `id` int(11) NOT NULL auto_increment,
  `caminho` varchar(45) NOT NULL,
  `materia_id` int(11) default NULL,
  `curso_id` int(11) default NULL,
  `status` tinyint(4) default '1',
  `data_registro` varchar(45) default NULL,
  `nome_arquivo` varchar(45) default NULL,
  `descricao` text,
  `tipo_aprendizagem` varchar(45) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_materia_arquivo` (`materia_id`),
  KEY `fk_curso_arquivo` (`curso_id`),
  CONSTRAINT `fk_curso_arquivo` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materia_arquivo` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arquivos`
--

/*!40000 ALTER TABLE `arquivos` DISABLE KEYS */;
INSERT INTO `arquivos` (`id`,`caminho`,`materia_id`,`curso_id`,`status`,`data_registro`,`nome_arquivo`,`descricao`,`tipo_aprendizagem`) VALUES 
 (37,'./img/1/1',1,1,1,'20/05/2015','Chrysanthemum.jpg','Introdução','teste'),
 (38,'./img/1/1',1,1,0,'13/05/2015','Desert.jpg','teste 1','teste 1'),
 (39,'./img/1/1',1,1,0,'13/05/2015','Hydrangeas.jpg','teste 2','teste 2'),
 (40,'./img/1/1',1,1,1,'20/05/2015','Chrysanthemum.jpg','Paradigma','teste'),
 (41,'./img/1/1',1,1,1,'20/05/2015','Chrysanthemum.jpg','Orientação a objeto','teste');
/*!40000 ALTER TABLE `arquivos` ENABLE KEYS */;


--
-- Definition of table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) default NULL,
  `user_agent` varchar(120) default NULL,
  `last_activity` int(10) unsigned NOT NULL,
  `user_data` text NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


--
-- Definition of table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `id` int(11) NOT NULL auto_increment,
  `area` varchar(45) default NULL,
  `sub_area` varchar(45) default NULL,
  `nome` varchar(45) NOT NULL,
  `qtd_periodo` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso`
--

/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`id`,`area`,`sub_area`,`nome`,`qtd_periodo`) VALUES 
 (1,'Ciência da Computação','Programacao','Ciência da Computação','8'),
 (2,'Agronomia','capinar','Agronomia','8');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


--
-- Definition of table `curso_materia`
--

DROP TABLE IF EXISTS `curso_materia`;
CREATE TABLE `curso_materia` (
  `id` int(11) NOT NULL auto_increment,
  `id_materia` int(11) default NULL,
  `id_curso` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_curso` (`id_curso`),
  KEY `fk_materia` (`id_materia`),
  CONSTRAINT `fk_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_materia` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso_materia`
--

/*!40000 ALTER TABLE `curso_materia` DISABLE KEYS */;
INSERT INTO `curso_materia` (`id`,`id_materia`,`id_curso`) VALUES 
 (1,1,1),
 (2,2,2),
 (3,3,1),
 (4,4,1),
 (5,5,1),
 (6,6,2),
 (7,7,1);
/*!40000 ALTER TABLE `curso_materia` ENABLE KEYS */;


--
-- Definition of table `curso_usuario`
--

DROP TABLE IF EXISTS `curso_usuario`;
CREATE TABLE `curso_usuario` (
  `id` int(11) NOT NULL auto_increment,
  `id_curso` int(11) default NULL,
  `id_usuario` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_USU` (`id_usuario`),
  KEY `FK_CUR` (`id_curso`),
  CONSTRAINT `FK_CUR` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_USU` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso_usuario`
--

/*!40000 ALTER TABLE `curso_usuario` DISABLE KEYS */;
INSERT INTO `curso_usuario` (`id`,`id_curso`,`id_usuario`) VALUES 
 (20,1,NULL),
 (21,2,NULL),
 (27,1,2),
 (28,2,2),
 (29,1,3),
 (30,1,4),
 (31,1,5),
 (32,2,5);
/*!40000 ALTER TABLE `curso_usuario` ENABLE KEYS */;


--
-- Definition of table `funcionalidade`
--

DROP TABLE IF EXISTS `funcionalidade`;
CREATE TABLE `funcionalidade` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL,
  `icone` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funcionalidade`
--

/*!40000 ALTER TABLE `funcionalidade` DISABLE KEYS */;
INSERT INTO `funcionalidade` (`id`,`nome`,`url`,`icone`) VALUES 
 (1,'Usuário','usuarios','fa fa-user'),
 (2,'Curso','cursos','fa fa-fw fa-file'),
 (3,'Enviar aula','upload','fa fa-fw fa-desktop'),
 (4,'Assistir aula','assistir_aula','fa fa-fw fa-desktop');
/*!40000 ALTER TABLE `funcionalidade` ENABLE KEYS */;


--
-- Definition of table `funcionalidade_grupo`
--

DROP TABLE IF EXISTS `funcionalidade_grupo`;
CREATE TABLE `funcionalidade_grupo` (
  `id` int(11) NOT NULL auto_increment,
  `id_funcionalidade` int(11) default NULL,
  `id_grupo` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_FUNCIONALIDADE` (`id_funcionalidade`),
  KEY `FK_GRUPO` (`id_grupo`),
  CONSTRAINT `FK_FUNCIONALIDADE` FOREIGN KEY (`id_funcionalidade`) REFERENCES `funcionalidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_GRUPO` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funcionalidade_grupo`
--

/*!40000 ALTER TABLE `funcionalidade_grupo` DISABLE KEYS */;
INSERT INTO `funcionalidade_grupo` (`id`,`id_funcionalidade`,`id_grupo`) VALUES 
 (1,1,1),
 (4,2,1),
 (6,3,1),
 (8,4,1),
 (9,4,3),
 (11,4,2),
 (12,3,2);
/*!40000 ALTER TABLE `funcionalidade_grupo` ENABLE KEYS */;


--
-- Definition of table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupo`
--

/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` (`id`,`nome`) VALUES 
 (1,'Administrador'),
 (2,'Professor'),
 (3,'Aluno');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;


--
-- Definition of table `grupo_usuario`
--

DROP TABLE IF EXISTS `grupo_usuario`;
CREATE TABLE `grupo_usuario` (
  `id` int(11) NOT NULL auto_increment,
  `id_grupo` int(11) default NULL,
  `id_usuario` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_user` (`id_usuario`),
  KEY `fk_gp` (`id_grupo`),
  CONSTRAINT `fk_gp` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupo_usuario`
--

/*!40000 ALTER TABLE `grupo_usuario` DISABLE KEYS */;
INSERT INTO `grupo_usuario` (`id`,`id_grupo`,`id_usuario`) VALUES 
 (193,3,2),
 (194,1,3),
 (195,3,3),
 (196,2,4),
 (197,1,5),
 (198,2,5),
 (199,3,5);
/*!40000 ALTER TABLE `grupo_usuario` ENABLE KEYS */;


--
-- Definition of table `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE `materia` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(45) NOT NULL,
  `id_usuario_professor` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_PROF` (`id_usuario_professor`),
  CONSTRAINT `FK_PROF` FOREIGN KEY (`id_usuario_professor`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materia`
--

/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` (`id`,`nome`,`id_usuario_professor`) VALUES 
 (1,'LP II',2),
 (2,'Hidraulica',2),
 (3,'Teoria dos Grafos',2),
 (4,'Logica Matematica',2),
 (5,'AEDII',2),
 (6,'Solos',2),
 (7,'Calculo',2);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(245) NOT NULL,
  `aprendizagem` varchar(45) default NULL,
  `logradouro` varchar(245) default NULL,
  `numero` varchar(45) default NULL,
  `cidade` varchar(50) default NULL,
  `bairro` varchar(45) default NULL,
  `estado` varchar(50) default NULL,
  `telefone` varchar(50) default NULL,
  `rg` varchar(20) default NULL,
  `matricula` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`nome`,`aprendizagem`,`logradouro`,`numero`,`cidade`,`bairro`,`estado`,`telefone`,`rg`,`matricula`,`email`,`senha`,`status`) VALUES 
 (2,'Vinicius Marangoni','Auditivo','Rua Joao','45','Guaxupe','Centro','MG','','213321321','65465465446','vinicius@example.com','12345',1),
 (3,'Joao','Visual','Muzambinho','55','Muzzza','muz','MG','','111222333','111222333','joao@example.com','12345',1),
 (4,'Prof. Paulo','Visual','Rua Loren','33','Muzambinho','Centro','MG','(35)3636-3251','5221458741','63664512','paulo@example.com','12345',1),
 (5,'Icaro Carvalho','Auditivo','Poços','3','Poços','Centro','MG','(35)3721-2222','154265874818','46598741351','icaro@example.com','12345',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
