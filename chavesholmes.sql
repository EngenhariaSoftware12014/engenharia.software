-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: May 26, 2014 at 06:00 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `chavesholmes`
--

-- --------------------------------------------------------

--
-- Table structure for table `armas`
--

CREATE TABLE `armas` (
  `idarmas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idarmas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `armas`
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
-- Table structure for table `cenarios`
--

CREATE TABLE `cenarios` (
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
-- Table structure for table `comodos`
--

CREATE TABLE `comodos` (
  `idcomodos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `position_x` int(12) NOT NULL,
  `postion_y` int(12) NOT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idcomodos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `comodos`
--

INSERT INTO `comodos` (`idcomodos`, `nome`, `imagem`, `position_x`, `postion_y`, `delete_2`) VALUES
(3, 'Casa Dona Florinda', 'florinda_casa.png', 0, 0, NULL),
(4, 'Casa Bruxa do 71', 'bruxa_casa.png', 0, 0, NULL),
(5, 'Casa Seu Madruga', 'madruga_casa.png', 0, 0, NULL),
(6, 'Pátio', 'patio.png', 0, 0, NULL),
(7, 'Fonte', 'fonte.png', 0, 0, NULL),
(8, 'Lanchonete', 'lanchonete.png', 0, 0, NULL),
(9, 'Barraca de Churros', 'barraca_churros.png', 0, 0, NULL),
(10, 'Escola', 'escola.png', 0, 0, NULL),
(11, 'Terreno Baldio', 'terreno_badio.png', 0, 0, NULL),
(12, 'Entrada', 'entrada_vila.png', 0, 0, NULL),
(14, 'Mercado', 'mercado.png', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partidas`
--

CREATE TABLE `partidas` (
  `idpartida` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL COMMENT 'status: 0 - partida aberta; 1 - partida iniciada; 2 - partida execução; 3 - partida encerrada;',
  `vencedor` int(10) DEFAULT NULL,
  PRIMARY KEY (`idpartida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patente`
--

CREATE TABLE `patente` (
  `idpatente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scorepatentemin` decimal(11,2) DEFAULT NULL,
  `scorepatentemax` decimal(11,2) NOT NULL,
  `descrpatente` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpatente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `patente`
--

INSERT INTO `patente` (`idpatente`, `scorepatentemin`, `scorepatentemax`, `descrpatente`) VALUES
(1, 0.00, 9.00, 'NOOB'),
(2, 10.00, 19.00, 'RECRUTA'),
(3, 20.00, 49.00, 'VETERANO'),
(4, 50.00, 99.00, 'EXPERT'),
(5, 100.00, 10000.00, 'SHERLOCK');

-- --------------------------------------------------------

--
-- Table structure for table `suspeitos`
--

CREATE TABLE `suspeitos` (
  `idsuspeitos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `comodo_idcomodo` int(12) NOT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idsuspeitos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `suspeitos`
--

INSERT INTO `suspeitos` (`idsuspeitos`, `nome`, `imagem`, `comodo_idcomodo`, `delete_2`) VALUES
(2, 'Bruxa do 71', 'bruxa.png', 4, NULL),
(3, 'Chaves', 'chaves.png', 6, NULL),
(4, 'Chiquinha', 'chiquinha.png', 7, NULL),
(5, 'Dona Florinda', 'florinda.png', 3, NULL),
(6, 'Prof. Girafales', 'girafales.png', 10, NULL),
(7, 'Seu Madruga', 'madruga.png', 5, NULL),
(8, 'Nhonho', 'nhonho.png', 8, NULL),
(9, 'Quico', 'quico.png', 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
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
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `sobrenome`, `email`, `senha`, `status_2`, `perfil`, `imagem`, `patente`, `pontuacao`) VALUES
(1, 'Chapolin', 'Colorado', 'chapolin@sigameosbons.com', '123', '1', '0', '', '', 0),
(8, 'Hanna', 'Mariano', 'hanna@yahoo.com', 'teste', '1', '2', '', '', 0),
(9, 'Erica', 'Mitsuishi', 'erica@yahoo.com', 'teste', '1', '2', '', '', 0),
(10, 'Eduardo', 'Vicente', 'eduardo@yahoo.com', 'teste', '1', '2', '', '', 0),
(11, 'Pedro', 'Silva', 'pedro@yahoo.com', 'teste', '1', '2', '', '', 0);
