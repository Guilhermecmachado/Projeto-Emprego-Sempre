-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.24-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para emprego_sempre
DROP DATABASE IF EXISTS `emprego_sempre`;
CREATE DATABASE IF NOT EXISTS `emprego_sempre` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `emprego_sempre`;

-- Copiando estrutura para tabela emprego_sempre.adm
DROP TABLE IF EXISTS `adm`;
CREATE TABLE IF NOT EXISTS `adm` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `email_adm` varchar(100) NOT NULL DEFAULT '',
  `senha_adm` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_adm`),
  UNIQUE KEY `email_adm` (`email_adm`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='tabela de cadastro de adms\r\n';

-- Copiando dados para a tabela emprego_sempre.adm: ~2 rows (aproximadamente)
INSERT INTO `adm` (`id_adm`, `email_adm`, `senha_adm`) VALUES
	(5, 'admin@adm.com', '202cb962ac59075b964b07152d234b70'),
	(6, 'guiadmin@admin.com', '202cb962ac59075b964b07152d234b70');

-- Copiando estrutura para tabela emprego_sempre.area_vagas
DROP TABLE IF EXISTS `area_vagas`;
CREATE TABLE IF NOT EXISTS `area_vagas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nome_area` varchar(50) NOT NULL,
  PRIMARY KEY (`id_area`) USING BTREE,
  UNIQUE KEY `nome_area` (`nome_area`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='tabela para especificar as areas na qual o usuario quer procurar o emprego';

-- Copiando dados para a tabela emprego_sempre.area_vagas: ~6 rows (aproximadamente)
INSERT INTO `area_vagas` (`id_area`, `nome_area`) VALUES
	(4, 'Adminstração'),
	(3, 'Arquitetura'),
	(2, 'Eletrônica'),
	(6, 'Medicina'),
	(5, 'Publicidade'),
	(1, 'Ti-Técnologia da Informação'),
	(7, 'Veterinaria');

-- Copiando estrutura para tabela emprego_sempre.cadastro_vagas
DROP TABLE IF EXISTS `cadastro_vagas`;
CREATE TABLE IF NOT EXISTS `cadastro_vagas` (
  `id_cadastro_vagas` int(11) NOT NULL AUTO_INCREMENT,
  `praso_incial` datetime NOT NULL DEFAULT current_timestamp(),
  `nome_vagas` varchar(100) NOT NULL DEFAULT '',
  `id_area` int(11) NOT NULL DEFAULT 0,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `desc_vagas` varchar(250) NOT NULL DEFAULT '',
  `email_envio` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_cadastro_vagas`),
  KEY `id_area` (`id_area`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `FK_cadastro_vagas_area_vagas` FOREIGN KEY (`id_area`) REFERENCES `area_vagas` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cadastro_vagas_usuario_empresa` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_empresa` (`Id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COMMENT='Tabela das vagas cadastradas pelo usuario ou pela empresa';

-- Copiando dados para a tabela emprego_sempre.cadastro_vagas: ~14 rows (aproximadamente)
INSERT INTO `cadastro_vagas` (`id_cadastro_vagas`, `praso_incial`, `nome_vagas`, `id_area`, `id_usuario`, `desc_vagas`, `email_envio`, `status`) VALUES
	(15, '2022-08-25 19:34:27', 'olawddaaabbbdwd', 3, 9, 'olawdwswdwdbbbwdw', 'olawddaasssa@gmail.com', 0),
	(16, '2022-08-25 19:42:37', 'desenvolve algo', 1, 9, 'desenvolvemos so não sabemos oq', 'dev@gmail.com', 1),
	(17, '2022-08-25 19:45:53', 'blas', 5, 9, 'seja um robo wdwd', 'empwwww@gmail.com', 1),
	(18, '2022-08-25 19:46:50', 'empresa1', 5, 9, 'sla', 'emp1@gmail.com', 1),
	(19, '2022-08-25 19:51:06', 'ola', 3, 9, 'seded', 'nha@gmail.com', 0),
	(20, '2022-08-25 19:56:24', 'desde', 6, 10, 'deded', 'des@gmail.com', 0),
	(21, '2022-08-25 22:11:56', 'Estagio de desenvolvedor full stack', 1, 11, 'Estagiarios de desenvolvimento full stack', 'wind@micro.com', 0),
	(22, '2022-08-26 19:00:29', 'Estagio de administração', 4, 12, 'procuramos alguem para estagio que esteja ou ja cursou curso de adminstração', 'addm@gmail.com', 0),
	(23, '2022-08-27 20:07:24', 'pedro precisa de ajuda', 6, 13, 'pedrin quer que vc seja um robo', 'pedrinrh@gmail.com', 0),
	(24, '2022-08-31 20:03:13', 'dwdwdw', 2, 14, 'wdwdw', 'guizin@gmail.com', 0),
	(25, '2022-09-05 19:10:06', 'Pet med', 7, 15, 'precisamos de um médico e um especialista em banho e tosa', 'petmed@gmail.com', 1),
	(26, '2022-09-05 19:11:14', 'Pet love', 7, 15, 'precisamos de um especialista em banho e tosa somente para gatos', 'lovepet@gmail.com', 1),
	(27, '2022-09-08 20:19:35', 'buscas vida', 1, 10, 'preciso de um astronomo bom com computadores', 'busvida@gmail.com', 1),
	(28, '2022-09-08 20:35:55', 'teste', 3, 12, 'wddwd', 'teste@gmail.com', 1);

-- Copiando estrutura para tabela emprego_sempre.escolaridade
DROP TABLE IF EXISTS `escolaridade`;
CREATE TABLE IF NOT EXISTS `escolaridade` (
  `id_ensino` int(11) NOT NULL AUTO_INCREMENT,
  `nome_ensino` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ensino`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='tabela de fitlro para nivel de escolaridade do usuario que vai enviar o curriculo';

-- Copiando dados para a tabela emprego_sempre.escolaridade: ~8 rows (aproximadamente)
INSERT INTO `escolaridade` (`id_ensino`, `nome_ensino`) VALUES
	(1, 'Ensino-fundamental-completo'),
	(2, 'Ensino-fundamental-incompleto'),
	(3, 'Ensino-médio-completo'),
	(4, 'Ensino-médio-incompleto'),
	(5, 'Ensino-médio-técnico-completo'),
	(6, 'Ensino-médio-técnico-incompleto'),
	(7, 'Ensino-superior-completo'),
	(8, 'Ensino-superior-incompleto');

-- Copiando estrutura para tabela emprego_sempre.usuario_curri
DROP TABLE IF EXISTS `usuario_curri`;
CREATE TABLE IF NOT EXISTS `usuario_curri` (
  `id_usuario_curri` int(11) NOT NULL AUTO_INCREMENT,
  `email_usuario` varchar(100) NOT NULL,
  `desc_usuario` varchar(200) NOT NULL,
  `nome` varchar(100) NOT NULL DEFAULT '',
  `id_ensino` int(11) NOT NULL,
  `id_zona` int(11) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id_usuario_curri`) USING BTREE,
  UNIQUE KEY `email_usuario` (`email_usuario`),
  KEY `FK_usuario_curri_escolaridade` (`id_ensino`),
  KEY `FK_usuario_curri_zona` (`id_zona`),
  CONSTRAINT `FK_usuario_curri_escolaridade` FOREIGN KEY (`id_ensino`) REFERENCES `escolaridade` (`id_ensino`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_curri_zona` FOREIGN KEY (`id_zona`) REFERENCES `zona` (`id_zona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='tabela de cadastro do usuario para envio de curriculos';

-- Copiando dados para a tabela emprego_sempre.usuario_curri: ~0 rows (aproximadamente)
INSERT INTO `usuario_curri` (`id_usuario_curri`, `email_usuario`, `desc_usuario`, `nome`, `id_ensino`, `id_zona`, `senha`) VALUES
	(3, 'zepicadinho@gmail.com', 'bla', 'Zé do picadinho', 5, 4, '202cb962ac59075b964b07152d234b70'),
	(4, 'gui@gmail.com', 'bla', 'Guilherme Campos Mechado', 5, 4, '202cb962ac59075b964b07152d234b70');

-- Copiando estrutura para tabela emprego_sempre.usuario_empresa
DROP TABLE IF EXISTS `usuario_empresa`;
CREATE TABLE IF NOT EXISTS `usuario_empresa` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nome_empresa` varchar(75) NOT NULL DEFAULT '',
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `dat_cad_aterado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  UNIQUE KEY `Email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='tabela de usuarios para cadastrar as vagas';

-- Copiando dados para a tabela emprego_sempre.usuario_empresa: ~8 rows (aproximadamente)
INSERT INTO `usuario_empresa` (`id_usuario`, `email`, `senha`, `nome_empresa`, `data_cadastro`, `dat_cad_aterado`) VALUES
	(9, 'oracldwdw@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Oracledwdw', '2022-08-25 19:20:07', NULL),
	(10, 'nha@gmail.com', '202cb962ac59075b964b07152d234b70', 'nha', '2022-08-25 19:55:57', NULL),
	(11, 'micro@soft.com', '202cb962ac59075b964b07152d234b70', 'Microsoft', '2022-08-25 22:10:31', NULL),
	(12, 'lol@gmail.com', '202cb962ac59075b964b07152d234b70', 'lol', '2022-08-26 18:58:36', NULL),
	(13, 'pedrin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'pedro não sei', '2022-08-27 20:06:13', NULL),
	(14, 'gui@gmail.com', '202cb962ac59075b964b07152d234b70', 'gui teste', '2022-08-31 20:02:24', NULL),
	(15, 'pets@gmail.com', '202cb962ac59075b964b07152d234b70', 'Petzin', '2022-09-05 19:09:09', NULL),
	(17, 'bo@gmail.com', '202cb962ac59075b964b07152d234b70', 'bo', '2022-09-08 19:47:43', NULL),
	(18, 'gudwdwi@gmail.com', '202cb962ac59075b964b07152d234b70', 'gui testeswd', '2022-09-08 19:59:47', NULL);

-- Copiando estrutura para tabela emprego_sempre.zona
DROP TABLE IF EXISTS `zona`;
CREATE TABLE IF NOT EXISTS `zona` (
  `id_zona` int(11) NOT NULL AUTO_INCREMENT,
  `nome_zona` varchar(50) NOT NULL,
  PRIMARY KEY (`id_zona`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='tabela das zonas de são jose dos campos';

-- Copiando dados para a tabela emprego_sempre.zona: ~6 rows (aproximadamente)
INSERT INTO `zona` (`id_zona`, `nome_zona`) VALUES
	(1, 'Zona-leste'),
	(2, 'Zona-oeste'),
	(3, 'Zona-sul'),
	(4, 'Zona-norte'),
	(5, 'Centro'),
	(6, 'Sudeste');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
