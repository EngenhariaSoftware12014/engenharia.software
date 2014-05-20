-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 10-Maio-2014 às 17:21
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `chavesholmes`
--
CREATE DATABASE IF NOT EXISTS `chavesholmes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chavesholmes`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `armas`
--

CREATE TABLE IF NOT EXISTS `armas` (
  `idarmas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idarmas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `armas`
--

INSERT INTO `armas` (`idarmas`, `nome`, `imagem`, `delete_2`) VALUES
(3, 'Casca de banana', 'banana.png', NULL),
(4, 'Barril do Chaves', 'barril.png', NULL),
(5, 'Bola Quadrada', 'bola.png', NULL),
(6, 'Ioio da Chiquinha', 'ioio.png', NULL),
(7, 'Peteca', 'peteca.png', NULL),
(8, 'Piao', 'piao.png', NULL),
(9, 'Sanduiche de Presunto', 'sanduiche.png', NULL),
(10, 'Satanás', 'satanas.png', NULL);


-- --------------------------------------------------------

--
-- Estrutura da tabela `cenarios`
--

CREATE TABLE IF NOT EXISTS `cenarios` (
  `idcenarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `armas_idarmas` int(10) unsigned NOT NULL,
  `comodos_idcomodos` int(10) unsigned NOT NULL,
  `suspeitos_idsuspeitos` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idcenarios`),
  KEY `cenarios_fkindex1` (`suspeitos_idsuspeitos`),
  KEY `cenarios_fkindex2` (`comodos_idcomodos`),
  KEY `cenarios_fkindex3` (`armas_idarmas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comodos`
--

CREATE TABLE IF NOT EXISTS `comodos` (
  `idcomodos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idcomodos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `comodos`
--

INSERT INTO `comodos` (`idcomodos`, `nome`, `imagem`, `delete_2`) VALUES
(3, 'Casa Dona Florinda', 'csflorinda.png', NULL),
(4, 'Casa Bruxa do 71', 'csbruxa.png', NULL),
(5, 'Casa Seu Madruga', 'csmadruga.png', NULL),
(6, 'Pátio', 'patio.png', NULL),
(7, 'Fonte', 'fonte.png', NULL),
(8, 'Restaurante', 'restaurante.png', NULL),
(9, 'Barraca de Churros', 'churros.png', NULL),
(10, 'Escola', 'escola.png', NULL),
(11, 'Terreno Baldio', 'terreno.png', NULL),
(12, 'Entrada', 'entrada.png', NULL),
(13, 'Casa Pati', 'cspati', NULL),
(14, 'Mercado', 'mercado.png', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `partidas`
--

CREATE TABLE IF NOT EXISTS `partidas` (
  `idpartida` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL COMMENT 'status: 0 - partida aberta; 1 - partida em execução; 2 - partida encerrada;',
  `vencedor` int(10) DEFAULT NULL,
  PRIMARY KEY (`idpartida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patente`
--

CREATE TABLE IF NOT EXISTS `patente` (
  `idpatente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scorepatentemin` decimal(11,2) DEFAULT NULL,
  `scorepatentemax` decimal(11,2) NOT NULL,
  `descrpatente` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpatente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patentexusuario`
--

CREATE TABLE IF NOT EXISTS `patentexusuario` (
  `idpatentexusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patente_idpatente` int(10) unsigned NOT NULL,
  `usuario_idusuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idpatentexusuario`,`patente_idpatente`,`usuario_idusuario`),
  KEY `patentexusuario_fkindex1` (`patente_idpatente`),
  KEY `patentexusuario_fkindex2` (`usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `suspeitos`
--

CREATE TABLE IF NOT EXISTS `suspeitos` (
  `idsuspeitos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idsuspeitos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `suspeitos`
--


INSERT INTO `suspeitos` (`idsuspeitos`, `nome`, `imagem`, `delete_2`) VALUES
(2, 'Bruxa do 71', 'bruxa.png', NULL),
(3, 'Chaves', 'chaves.png', NULL),
(4, 'Chiquinha', 'chiquinha.png', NULL),
(5, 'Dona Florinda', 'florinda.png', NULL),
(6, 'Prof. Girafales', 'girafales.png', NULL),
(7, 'Seu Madruga', 'madruga.png', NULL),
(8, 'Nhonho', 'nhonho.png', NULL),
(9, 'Quico', 'quico.png', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `status_2` char(1) DEFAULT NULL,
  `perfil` char(1) DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  `patente` varchar(100) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `sobrenome`, `email`, `senha`, `status_2`, `perfil`, `imagem`, `patente`, `pontuacao`) VALUES
(1, 'Chapolin', 'Colorado', 'chapolin@sigameosbons.com', '123', '1', '0', '', '', 0),
(8, 'Hanna', 'Mariano', 'hanna@yahoo.com', 'teste', '1', '2', '', '', 0),
(9, 'Erica', 'Mitsuishi', 'erica@yahoo.com', 'teste', '1', '2', '', '', 0),
(10, 'Eduardo', 'Vicente', 'eduardo@yahoo.com', 'teste', '1', '2', '', '', 0),
(11, 'Pedro', 'Silva', 'pedro@yahoo.com', 'teste','1','2','','',0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
