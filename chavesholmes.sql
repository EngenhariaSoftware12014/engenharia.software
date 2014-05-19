-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: May 19, 2014 at 02:18 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chavesholmes`
--

-- --------------------------------------------------------

--
-- Table structure for table `1_comentarios`
--

CREATE TABLE `1_comentarios` (
  `idcomentarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` int(10) unsigned NOT NULL,
  `partida_idpartida` int(10) unsigned NOT NULL,
  `comentario` multilinestring DEFAULT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idcomentarios`,`usuario_idusuario`,`partida_idpartida`),
  KEY `comentarios_fkindex1` (`usuario_idusuario`),
  KEY `comentarios_fkindex2` (`partida_idpartida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `1_jogadas`
--

CREATE TABLE `1_jogadas` (
  `idjogadas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` int(10) unsigned NOT NULL,
  `partida_idpartida` int(10) unsigned NOT NULL,
  `usuarioalvo_idusuario` int(10) DEFAULT NULL,
  `descricaojogada` varchar(255) DEFAULT NULL,
  `acusacao` char(1) DEFAULT NULL,
  PRIMARY KEY (`idjogadas`,`usuario_idusuario`,`partida_idpartida`),
  KEY `jogadas_fkindex1` (`usuario_idusuario`),
  KEY `jogadas_fkindex2` (`partida_idpartida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `1_partidaxusuario`
--

CREATE TABLE `1_partidaxusuario` (
  `idpartidaxusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` int(10) unsigned NOT NULL,
  `suspeito_idsuspeito` int(10) DEFAULT NULL,
  PRIMARY KEY (`idpartidaxusuario`,`usuario_idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `1_partidaxusuario`
--

INSERT INTO `1_partidaxusuario` (`idpartidaxusuario`, `usuario_idusuario`, `suspeito_idsuspeito`) VALUES
(1, 1, NULL);

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
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idcomodos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `comodos`
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
-- Table structure for table `partidas`
--

CREATE TABLE `partidas` (
  `idpartida` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cenarios_idcenarios` int(10) unsigned NOT NULL,
  `qtdminjogadores` int(10) unsigned DEFAULT NULL,
  `qtdmaxjogadores` int(10) unsigned DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `delete_2` char(1) DEFAULT NULL,
  `vencedor` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idpartida`),
  KEY `partida_fkindex1` (`cenarios_idcenarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `partidas`
--

INSERT INTO `partidas` (`idpartida`, `cenarios_idcenarios`, `qtdminjogadores`, `qtdmaxjogadores`, `status`, `delete_2`, `vencedor`) VALUES
(1, 0, NULL, NULL, '0', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patentexusuario`
--

CREATE TABLE `patentexusuario` (
  `idpatentexusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patente_idpatente` int(10) unsigned NOT NULL,
  `usuario_idusuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idpatentexusuario`,`patente_idpatente`,`usuario_idusuario`),
  KEY `patentexusuario_fkindex1` (`patente_idpatente`),
  KEY `patentexusuario_fkindex2` (`usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suspeitos`
--

CREATE TABLE `suspeitos` (
  `idsuspeitos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idsuspeitos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `suspeitos`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `sobrenome`, `email`, `senha`, `status_2`, `perfil`, `imagem`, `patente`, `pontuacao`) VALUES
(1, 'Chapolin', 'Colorado', 'chapolin@sigameosbons.com', '123', '1', '0', '', '', 0),
(8, 'Eduardo', 'Vicente', 'teste@yahoo.com', 'teste', '1', '2', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
