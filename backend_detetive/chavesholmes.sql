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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `armas`
--

INSERT INTO `armas` (`idarmas`, `nome`, `imagem`, `delete_2`) VALUES
(1, 'teste', '../cartas/bbc358c5add290f6c19ae80fe6311bce.jpg', '1'),
(2, 'testearma', '../cartas/e5bbeedfd57f8ced05bb5fbe5f41a812.jpg', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `comodos`
--

INSERT INTO `comodos` (`idcomodos`, `nome`, `imagem`, `delete_2`) VALUES
(2, 'Gorila', '../cartas/e90ce4acb91a0836d35d29edecad45c3.jpg', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `suspeitos`
--

INSERT INTO `suspeitos` (`idsuspeitos`, `nome`, `imagem`, `delete_2`) VALUES
(1, 'teste suspeito', '../cartas/6ceafc7eac75e9248a668a3d57ad2c2d.jpg', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `sobrenome`, `email`, `senha`, `status_2`, `perfil`, `imagem`, `patente`, `pontuacao`) VALUES
(6, 'Teste', 'adfasd', 'teste@testes.com.br', 'teste', '1', '1', '', '', 0),
(8, 'Eduardo', 'Vicente', 'teste@yahoo.com', 'teste', '1', '2', '', '', 0),
(15, '', '', '', '', '1', '2', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
