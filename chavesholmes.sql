-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: May 27, 2014 at 05:19 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `chavesholmes`
--

-- --------------------------------------------------------

--
-- Table structure for table `comodos`
--

CREATE TABLE `comodos` (
  `idcomodos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `position_x` int(12) NOT NULL,
  `position_y` int(12) NOT NULL,
  `delete_2` char(1) DEFAULT NULL,
  PRIMARY KEY (`idcomodos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `comodos`
--

INSERT INTO `comodos` (`idcomodos`, `nome`, `imagem`, `position_x`, `position_y`, `delete_2`) VALUES
(3, 'Casa Dona Florinda', 'florinda_casa.png', 3, 4, NULL),
(4, 'Casa Bruxa do 71', 'bruxa_casa.png', 4, 13, NULL),
(5, 'Casa Seu Madruga', 'madruga_casa.png', 4, 22, NULL),
(6, 'Pátio', 'patio.png', 13, 13, NULL),
(7, 'Fonte', 'fonte.png', 10, 22, NULL),
(8, 'Lanchonete', 'lanchonete.png', 9, 3, NULL),
(9, 'Barraca de Churros', 'barraca_churros.png', 23, 3, NULL),
(10, 'Escola', 'escola.png', 16, 23, NULL),
(11, 'Terreno Baldio', 'terreno_badio.png', 23, 13, NULL),
(12, 'Entrada', 'entrada_vila.png', 16, 3, NULL),
(14, 'Mercado', 'mercado.png', 23, 22, NULL);
