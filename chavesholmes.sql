-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: May 27, 2014 at 03:30 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `chavesholmes`
--

-- --------------------------------------------------------

--
-- Table structure for table `1_cartas`
--

CREATE TABLE `1_cartas` (
  `id_carta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_original` int(10) unsigned NOT NULL,
  `nome_carta` varchar(45) NOT NULL,
  `caminho_carta` varchar(100) NOT NULL,
  `tipo_carta` varchar(10) NOT NULL,
  PRIMARY KEY (`id_carta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `1_cartas`
--

INSERT INTO `1_cartas` (`id_carta`, `id_original`, `nome_carta`, `caminho_carta`, `tipo_carta`) VALUES
(1, 3, 'Casca de banana', 'banana.png', 'arma'),
(2, 4, 'Barril do Chaves', 'barril.png', 'arma'),
(3, 5, 'Bola Quadrada', 'bola.png', 'arma'),
(4, 6, 'Ioio da Chiquinha', 'ioio.png', 'arma'),
(5, 7, 'Peteca', 'peteca.png', 'arma'),
(6, 8, 'Piao', 'piao.png', 'arma'),
(7, 9, 'Sanduiche de Presunto', 'sanduiche.png', 'arma'),
(8, 10, 'Satanás', 'satanas.png', 'arma'),
(9, 3, 'Casa Dona Florinda', 'florinda_casa.png', 'comodo'),
(10, 4, 'Casa Bruxa do 71', 'bruxa_casa.png', 'comodo'),
(11, 5, 'Casa Seu Madruga', 'madruga_casa.png', 'comodo'),
(12, 6, 'Pátio', 'patio.png', 'comodo'),
(13, 7, 'Fonte', 'fonte.png', 'comodo'),
(14, 8, 'Lanchonete', 'lanchonete.png', 'comodo'),
(15, 9, 'Barraca de Churros', 'barraca_churros.png', 'comodo'),
(16, 10, 'Escola', 'escola.png', 'comodo'),
(17, 11, 'Terreno Baldio', 'terreno_badio.png', 'comodo'),
(18, 12, 'Entrada', 'entrada_vila.png', 'comodo'),
(19, 14, 'Mercado', 'mercado.png', 'comodo'),
(20, 2, 'Bruxa do 71', 'bruxa.png', 'suspeito'),
(21, 3, 'Chaves', 'chaves.png', 'suspeito'),
(22, 4, 'Chiquinha', 'chiquinha.png', 'suspeito'),
(23, 5, 'Dona Florinda', 'florinda.png', 'suspeito'),
(24, 6, 'Prof. Girafales', 'girafales.png', 'suspeito'),
(25, 7, 'Seu Madruga', 'madruga.png', 'suspeito'),
(26, 8, 'Nhonho', 'nhonho.png', 'suspeito'),
(27, 9, 'Quico', 'quico.png', 'suspeito');

-- --------------------------------------------------------

--
-- Table structure for table `1_comentarios`
--

CREATE TABLE `1_comentarios` (
  `idcomentarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` int(10) unsigned NOT NULL,
  `partida_idpartida` int(10) unsigned NOT NULL,
  `comentario` multilinestring DEFAULT NULL,
  `carta_idcarta` int(10) NOT NULL,
  `carta_tipocarta` varchar(1) NOT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idcomentarios`,`usuario_idusuario`,`partida_idpartida`),
  KEY `comentarios_fkindex1` (`usuario_idusuario`),
  KEY `comentarios_fkindex2` (`partida_idpartida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `1_comentarios`
--

INSERT INTO `1_comentarios` (`idcomentarios`, `usuario_idusuario`, `partida_idpartida`, `comentario`, `carta_idcarta`, `carta_tipocarta`, `delete_2`) VALUES
(2, 9, 0, NULL, 2, 'S', NULL),
(4, 9, 0, NULL, 6, 'S', NULL),
(5, 9, 0, NULL, 4, 'S', NULL),
(8, 9, 0, NULL, 10, 'C', NULL),
(9, 9, 0, NULL, 7, 'C', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `1_partidaxusuario`
--

INSERT INTO `1_partidaxusuario` (`idpartidaxusuario`, `usuario_idusuario`, `suspeito_idsuspeito`) VALUES
(1, 9, 3),
(2, 8, 4),
(3, 10, 5),
(4, 11, 6);

-- --------------------------------------------------------

--
-- Table structure for table `1_usuario_cartas`
--

CREATE TABLE `1_usuario_cartas` (
  `id_usuario` int(10) unsigned NOT NULL,
  `id_carta` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_carta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_usuario_cartas`
--

INSERT INTO `1_usuario_cartas` (`id_usuario`, `id_carta`) VALUES
(0, 1),
(0, 14),
(0, 27),
(8, 2),
(8, 5),
(8, 9),
(8, 19),
(8, 23),
(8, 26),
(9, 3),
(9, 6),
(9, 7),
(9, 10),
(9, 13),
(9, 16),
(10, 4),
(10, 8),
(10, 11),
(10, 12),
(10, 24),
(10, 25),
(11, 15),
(11, 17),
(11, 18),
(11, 20),
(11, 21),
(11, 22);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `partidas`
--

INSERT INTO `partidas` (`idpartida`, `status`, `vencedor`) VALUES
(1, '2', NULL);

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
  `patente` int(10) NOT NULL DEFAULT '1',
  `pontuacao` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `sobrenome`, `email`, `senha`, `status_2`, `perfil`, `imagem`, `patente`, `pontuacao`) VALUES
(1, 'Chapolin', 'Colorado', 'chapolin@sigameosbons.com', '123', '1', '0', '', 1, 0),
(8, 'Hanna', 'Mariano', 'hanna@yahoo.com', 'teste', '1', '2', '', 1, 0),
(9, 'Erica', 'Mitsuishi', 'erica@yahoo.com', 'teste', '1', '2', '', 1, 0),
(10, 'Eduardo', 'Vicente', 'eduardo@yahoo.com', 'teste', '1', '2', '', 1, 0),
(11, 'Pedro', 'Silva', 'pedro@yahoo.com', 'teste', '1', '2', '', 1, 0);
