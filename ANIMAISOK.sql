-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 08:03 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calf_generator`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `id_inducao` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `id_inducao`, `numero`) VALUES
(1, NULL, 1),
(2, NULL, 2),
(3, NULL, 3),
(4, NULL, 4),
(5, NULL, 5),
(6, NULL, 6),
(7, NULL, 7),
(8, NULL, 8),
(9, NULL, 9),
(10, NULL, 10),
(11, NULL, 11),
(12, NULL, 12),
(13, NULL, 13),
(14, NULL, 14),
(15, NULL, 15),
(16, NULL, 16),
(17, NULL, 17),
(18, NULL, 18),
(19, NULL, 19),
(20, NULL, 20),
(21, NULL, 21),
(22, NULL, 22),
(23, NULL, 23),
(24, NULL, 24),
(25, NULL, 25),
(26, NULL, 26),
(27, NULL, 27),
(28, NULL, 28),
(29, NULL, 29),
(30, NULL, 30),
(31, NULL, 31),
(32, NULL, 32),
(33, NULL, 33),
(34, NULL, 34),
(35, NULL, 35),
(36, NULL, 36),
(37, NULL, 37),
(38, NULL, 38),
(39, NULL, 39),
(40, NULL, 40),
(41, NULL, 41),
(42, NULL, 42),
(43, NULL, 43),
(44, NULL, 44),
(45, NULL, 45),
(46, NULL, 46),
(47, NULL, 47),
(48, NULL, 48),
(49, NULL, 49),
(50, NULL, 50);

-- --------------------------------------------------------

--
-- Table structure for table `animal_classificacao`
--

CREATE TABLE `animal_classificacao` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `id_estacao` int(11) DEFAULT NULL,
  `dataDaMudanca` datetime NOT NULL,
  `id_classificacaoInicial` int(11) NOT NULL,
  `id_classificacaoFinal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `animal_classificacao`
--

INSERT INTO `animal_classificacao` (`id`, `id_animal`, `id_estacao`, `dataDaMudanca`, `id_classificacaoInicial`, `id_classificacaoFinal`) VALUES
(1, 1, NULL, '2018-06-11 19:48:57', 1, NULL),
(2, 2, NULL, '2018-06-11 19:49:00', 1, NULL),
(3, 3, NULL, '2018-06-11 19:49:04', 1, NULL),
(4, 4, NULL, '2018-06-11 19:49:07', 1, NULL),
(5, 5, NULL, '2018-06-11 19:49:10', 1, NULL),
(6, 6, NULL, '2018-06-11 19:49:14', 1, NULL),
(7, 7, NULL, '2018-06-11 19:49:17', 1, NULL),
(8, 8, NULL, '2018-06-11 19:49:21', 1, NULL),
(9, 9, NULL, '2018-06-11 19:49:24', 1, NULL),
(10, 10, NULL, '2018-06-11 19:49:27', 1, NULL),
(11, 11, NULL, '2018-06-11 19:49:31', 1, NULL),
(12, 12, NULL, '2018-06-11 19:49:37', 1, NULL),
(13, 13, NULL, '2018-06-11 19:49:41', 1, NULL),
(14, 14, NULL, '2018-06-11 19:49:43', 1, NULL),
(15, 15, NULL, '2018-06-11 19:49:47', 1, NULL),
(16, 16, NULL, '2018-06-11 19:49:50', 1, NULL),
(17, 17, NULL, '2018-06-11 19:50:01', 1, NULL),
(18, 18, NULL, '2018-06-11 19:50:06', 1, NULL),
(19, 19, NULL, '2018-06-11 19:50:13', 1, NULL),
(20, 20, NULL, '2018-06-11 19:50:17', 1, NULL),
(21, 21, NULL, '2018-06-11 19:53:10', 2, NULL),
(22, 22, NULL, '2018-06-11 19:53:38', 2, NULL),
(23, 23, NULL, '2018-06-11 19:53:52', 2, NULL),
(24, 24, NULL, '2018-06-11 19:54:45', 2, NULL),
(25, 25, NULL, '2018-06-11 19:54:58', 2, NULL),
(26, 26, NULL, '2018-06-11 19:55:30', 2, NULL),
(27, 27, NULL, '2018-06-11 19:55:40', 2, NULL),
(28, 28, NULL, '2018-06-11 19:56:11', 2, NULL),
(29, 29, NULL, '2018-06-11 19:56:21', 2, NULL),
(30, 30, NULL, '2018-06-11 19:56:32', 2, NULL),
(31, 31, NULL, '2018-06-11 19:58:30', 4, NULL),
(32, 32, NULL, '2018-06-11 19:58:42', 4, NULL),
(33, 33, NULL, '2018-06-11 19:58:52', 4, NULL),
(34, 34, NULL, '2018-06-11 19:59:12', 4, NULL),
(35, 35, NULL, '2018-06-11 19:59:35', 4, NULL),
(36, 36, NULL, '2018-06-11 20:00:13', 4, NULL),
(37, 37, NULL, '2018-06-11 20:00:19', 4, NULL),
(38, 38, NULL, '2018-06-11 20:00:53', 4, NULL),
(39, 39, NULL, '2018-06-11 20:01:00', 4, NULL),
(40, 40, NULL, '2018-06-11 20:01:08', 4, NULL),
(41, 41, NULL, '2018-06-11 20:01:47', 3, NULL),
(42, 42, NULL, '2018-06-11 20:01:53', 3, NULL),
(43, 43, NULL, '2018-06-11 20:01:58', 3, NULL),
(44, 44, NULL, '2018-06-11 20:02:02', 3, NULL),
(45, 45, NULL, '2018-06-11 20:02:07', 3, NULL),
(46, 46, NULL, '2018-06-11 20:02:32', 5, NULL),
(47, 47, NULL, '2018-06-11 20:02:37', 5, NULL),
(48, 48, NULL, '2018-06-11 20:02:41', 5, NULL),
(49, 49, NULL, '2018-06-11 20:02:47', 5, NULL),
(50, 50, NULL, '2018-06-11 20:02:51', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classificacao`
--

CREATE TABLE `classificacao` (
  `id` int(11) NOT NULL,
  `classificacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classificacao`
--

INSERT INTO `classificacao` (`id`, `classificacao`) VALUES
(1, 'Novilha'),
(2, 'Primípara Pós-Parto'),
(3, 'Primípara Gestante da Estação Anterior'),
(4, 'Multípara Pós-Parto'),
(5, 'Multípara Gestante da Estação Anterior');

-- --------------------------------------------------------

--
-- Table structure for table `cronologia`
--

CREATE TABLE `cronologia` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `id_ia` int(11) DEFAULT NULL,
  `id_estacao` int(11) DEFAULT NULL,
  `id_classificacao` int(11) NOT NULL,
  `dataDaMudanca` datetime NOT NULL,
  `id_estadoInicial` int(11) NOT NULL,
  `id_estadoFinal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cronologia`
--

INSERT INTO `cronologia` (`id`, `id_animal`, `id_ia`, `id_estacao`, `id_classificacao`, `dataDaMudanca`, `id_estadoInicial`, `id_estadoFinal`) VALUES
(1, 1, NULL, NULL, 1, '2018-06-11 19:48:57', 6, NULL),
(2, 2, NULL, NULL, 1, '2018-06-11 19:49:00', 6, NULL),
(3, 3, NULL, NULL, 1, '2018-06-11 19:49:04', 6, NULL),
(4, 4, NULL, NULL, 1, '2018-06-11 19:49:07', 6, NULL),
(5, 5, NULL, NULL, 1, '2018-06-11 19:49:10', 6, NULL),
(6, 6, NULL, NULL, 1, '2018-06-11 19:49:14', 6, NULL),
(7, 7, NULL, NULL, 1, '2018-06-11 19:49:17', 6, NULL),
(8, 8, NULL, NULL, 1, '2018-06-11 19:49:21', 6, NULL),
(9, 9, NULL, NULL, 1, '2018-06-11 19:49:24', 6, NULL),
(10, 10, NULL, NULL, 1, '2018-06-11 19:49:27', 6, NULL),
(11, 11, NULL, NULL, 1, '2018-06-11 19:49:31', 6, NULL),
(12, 12, NULL, NULL, 1, '2018-06-11 19:49:37', 6, NULL),
(13, 13, NULL, NULL, 1, '2018-06-11 19:49:41', 6, NULL),
(14, 14, NULL, NULL, 1, '2018-06-11 19:49:43', 6, NULL),
(15, 15, NULL, NULL, 1, '2018-06-11 19:49:47', 6, NULL),
(16, 16, NULL, NULL, 1, '2018-06-11 19:49:50', 6, NULL),
(17, 17, NULL, NULL, 1, '2018-06-11 19:50:01', 6, NULL),
(18, 18, NULL, NULL, 1, '2018-06-11 19:50:06', 6, NULL),
(19, 19, NULL, NULL, 1, '2018-06-11 19:50:13', 6, NULL),
(20, 20, NULL, NULL, 1, '2018-06-11 19:50:17', 6, NULL),
(21, 21, NULL, NULL, 2, '2018-06-11 19:53:10', 5, NULL),
(22, 22, NULL, NULL, 2, '2018-06-11 19:53:38', 5, NULL),
(23, 23, NULL, NULL, 2, '2018-06-11 19:53:52', 5, NULL),
(24, 24, NULL, NULL, 2, '2018-06-11 19:54:45', 5, NULL),
(25, 25, NULL, NULL, 2, '2018-06-11 19:54:58', 5, NULL),
(26, 26, NULL, NULL, 2, '2018-06-11 19:55:30', 5, NULL),
(27, 27, NULL, NULL, 2, '2018-06-11 19:55:40', 5, NULL),
(28, 28, NULL, NULL, 2, '2018-06-11 19:56:11', 5, NULL),
(29, 29, NULL, NULL, 2, '2018-06-11 19:56:21', 5, NULL),
(30, 30, NULL, NULL, 2, '2018-06-11 19:56:32', 5, NULL),
(31, 31, NULL, NULL, 4, '2018-06-11 19:58:30', 5, NULL),
(32, 32, NULL, NULL, 4, '2018-06-11 19:58:42', 5, NULL),
(33, 33, NULL, NULL, 4, '2018-06-11 19:58:52', 5, NULL),
(34, 34, NULL, NULL, 4, '2018-06-11 19:59:12', 5, NULL),
(35, 35, NULL, NULL, 4, '2018-06-11 19:59:35', 5, NULL),
(36, 36, NULL, NULL, 4, '2018-06-11 20:00:13', 5, NULL),
(37, 37, NULL, NULL, 4, '2018-06-11 20:00:19', 5, NULL),
(38, 38, NULL, NULL, 4, '2018-06-11 20:00:53', 5, NULL),
(39, 39, NULL, NULL, 4, '2018-06-11 20:01:00', 5, NULL),
(40, 40, NULL, NULL, 4, '2018-06-11 20:01:08', 5, NULL),
(41, 41, NULL, NULL, 3, '2018-06-11 20:01:47', 4, NULL),
(42, 42, NULL, NULL, 3, '2018-06-11 20:01:53', 4, NULL),
(43, 43, NULL, NULL, 3, '2018-06-11 20:01:58', 4, NULL),
(44, 44, NULL, NULL, 3, '2018-06-11 20:02:02', 4, NULL),
(45, 45, NULL, NULL, 3, '2018-06-11 20:02:07', 4, NULL),
(46, 46, NULL, NULL, 5, '2018-06-11 20:02:32', 4, NULL),
(47, 47, NULL, NULL, 5, '2018-06-11 20:02:37', 4, NULL),
(48, 48, NULL, NULL, 5, '2018-06-11 20:02:41', 4, NULL),
(49, 49, NULL, NULL, 5, '2018-06-11 20:02:47', 4, NULL),
(50, 50, NULL, NULL, 5, '2018-06-11 20:02:51', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `estacao`
--

CREATE TABLE `estacao` (
  `id` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'Apto'),
(2, 'Aguardando Diagnóstico 1'),
(3, 'Aguardando Diagnóstico 2'),
(4, 'Gestante'),
(5, 'Pós-Parto'),
(6, 'Aguardando Indução'),
(7, 'Pós-Indução');

-- --------------------------------------------------------

--
-- Table structure for table `ia`
--

CREATE TABLE `ia` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `id_estacao` int(11) DEFAULT NULL,
  `id_protocolo` int(11) DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `saiuProtocolo` tinyint(1) NOT NULL,
  `dataInseminacao` date NOT NULL,
  `dataRetornoAoCio` date NOT NULL,
  `dataDiagnostico1` date NOT NULL,
  `dataDiagnostico2` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inducao`
--

CREATE TABLE `inducao` (
  `id` int(11) NOT NULL,
  `id_estacao` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `observacao`
--

CREATE TABLE `observacao` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `dataDiagnostico` date NOT NULL,
  `observacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parto`
--

CREATE TABLE `parto` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `parto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parto`
--

INSERT INTO `parto` (`id`, `id_animal`, `parto`) VALUES
(1, 1, NULL),
(2, 2, NULL),
(3, 3, NULL),
(4, 4, NULL),
(5, 5, NULL),
(6, 6, NULL),
(7, 7, NULL),
(8, 8, NULL),
(9, 9, NULL),
(10, 10, NULL),
(11, 11, NULL),
(12, 12, NULL),
(13, 13, NULL),
(14, 14, NULL),
(15, 15, NULL),
(16, 16, NULL),
(17, 17, NULL),
(18, 18, NULL),
(19, 19, NULL),
(20, 20, NULL),
(21, 21, '2018-05-01'),
(22, 22, '2018-04-15'),
(23, 23, '2018-04-03'),
(24, 24, '2018-05-06'),
(25, 25, '2018-05-05'),
(26, 26, '2018-04-17'),
(27, 27, '2018-04-11'),
(28, 28, '2018-05-14'),
(29, 29, '2018-05-16'),
(30, 30, '2018-05-20'),
(31, 31, '2018-04-04'),
(32, 32, '2018-04-03'),
(33, 33, '2018-04-02'),
(34, 34, '2018-04-01'),
(35, 35, '2018-04-06'),
(36, 36, '2018-05-05'),
(37, 37, '2018-05-05'),
(38, 38, '2018-05-20'),
(39, 39, '2018-05-21'),
(40, 40, '2018-05-23'),
(41, 41, NULL),
(42, 42, NULL),
(43, 43, NULL),
(44, 44, NULL),
(45, 45, NULL),
(46, 46, NULL),
(47, 47, NULL),
(48, 48, NULL),
(49, 49, NULL),
(50, 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `protocolo`
--

CREATE TABLE `protocolo` (
  `id` int(11) NOT NULL,
  `id_estacao` int(11) DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `numero` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_uniq` (`numero`),
  ADD KEY `IDX_6D072629B408C367` (`id_inducao`);

--
-- Indexes for table `animal_classificacao`
--
ALTER TABLE `animal_classificacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E90B21434C9C96F2` (`id_animal`),
  ADD KEY `IDX_E90B21439F4C0C45` (`id_classificacaoInicial`),
  ADD KEY `IDX_E90B21436CE62FFC` (`id_classificacaoFinal`),
  ADD KEY `IDX_E90B2143737BEF1C` (`id_estacao`);

--
-- Indexes for table `classificacao`
--
ALTER TABLE `classificacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cronologia`
--
ALTER TABLE `cronologia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9F27263A4C9C96F2` (`id_animal`),
  ADD KEY `IDX_9F27263AF2E6AD8` (`id_ia`),
  ADD KEY `IDX_9F27263A737BEF1C` (`id_estacao`),
  ADD KEY `IDX_9F27263AD47CDAFD` (`id_classificacao`),
  ADD KEY `IDX_9F27263AA8F61545` (`id_estadoInicial`),
  ADD KEY `IDX_9F27263A930B1BA0` (`id_estadoFinal`);

--
-- Indexes for table `estacao`
--
ALTER TABLE `estacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ia`
--
ALTER TABLE `ia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_61B997B54C9C96F2` (`id_animal`),
  ADD KEY `IDX_61B997B5737BEF1C` (`id_estacao`),
  ADD KEY `IDX_61B997B5F098E264` (`id_protocolo`),
  ADD KEY `IDX_61B997B56A540E` (`id_estado`);

--
-- Indexes for table `inducao`
--
ALTER TABLE `inducao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A528538B737BEF1C` (`id_estacao`);

--
-- Indexes for table `observacao`
--
ALTER TABLE `observacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5D6712DD4C9C96F2` (`id_animal`);

--
-- Indexes for table `parto`
--
ALTER TABLE `parto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BC80D4B54C9C96F2` (`id_animal`);

--
-- Indexes for table `protocolo`
--
ALTER TABLE `protocolo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F25CDCE0737BEF1C` (`id_estacao`),
  ADD KEY `IDX_F25CDCE06A540E` (`id_estado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `animal_classificacao`
--
ALTER TABLE `animal_classificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `classificacao`
--
ALTER TABLE `classificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cronologia`
--
ALTER TABLE `cronologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `estacao`
--
ALTER TABLE `estacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ia`
--
ALTER TABLE `ia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inducao`
--
ALTER TABLE `inducao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `observacao`
--
ALTER TABLE `observacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parto`
--
ALTER TABLE `parto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `protocolo`
--
ALTER TABLE `protocolo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `FK_6D072629B408C367` FOREIGN KEY (`id_inducao`) REFERENCES `inducao` (`id`);

--
-- Constraints for table `animal_classificacao`
--
ALTER TABLE `animal_classificacao`
  ADD CONSTRAINT `FK_E90B21434C9C96F2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `FK_E90B21436CE62FFC` FOREIGN KEY (`id_classificacaoFinal`) REFERENCES `classificacao` (`id`),
  ADD CONSTRAINT `FK_E90B2143737BEF1C` FOREIGN KEY (`id_estacao`) REFERENCES `estacao` (`id`),
  ADD CONSTRAINT `FK_E90B21439F4C0C45` FOREIGN KEY (`id_classificacaoInicial`) REFERENCES `classificacao` (`id`);

--
-- Constraints for table `cronologia`
--
ALTER TABLE `cronologia`
  ADD CONSTRAINT `FK_9F27263A4C9C96F2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `FK_9F27263A737BEF1C` FOREIGN KEY (`id_estacao`) REFERENCES `estacao` (`id`),
  ADD CONSTRAINT `FK_9F27263A930B1BA0` FOREIGN KEY (`id_estadoFinal`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `FK_9F27263AA8F61545` FOREIGN KEY (`id_estadoInicial`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `FK_9F27263AD47CDAFD` FOREIGN KEY (`id_classificacao`) REFERENCES `classificacao` (`id`),
  ADD CONSTRAINT `FK_9F27263AF2E6AD8` FOREIGN KEY (`id_ia`) REFERENCES `ia` (`id`);

--
-- Constraints for table `ia`
--
ALTER TABLE `ia`
  ADD CONSTRAINT `FK_61B997B54C9C96F2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `FK_61B997B56A540E` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `FK_61B997B5737BEF1C` FOREIGN KEY (`id_estacao`) REFERENCES `estacao` (`id`),
  ADD CONSTRAINT `FK_61B997B5F098E264` FOREIGN KEY (`id_protocolo`) REFERENCES `protocolo` (`id`);

--
-- Constraints for table `inducao`
--
ALTER TABLE `inducao`
  ADD CONSTRAINT `FK_A528538B737BEF1C` FOREIGN KEY (`id_estacao`) REFERENCES `estacao` (`id`);

--
-- Constraints for table `observacao`
--
ALTER TABLE `observacao`
  ADD CONSTRAINT `FK_5D6712DD4C9C96F2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id`);

--
-- Constraints for table `parto`
--
ALTER TABLE `parto`
  ADD CONSTRAINT `FK_BC80D4B54C9C96F2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id`);

--
-- Constraints for table `protocolo`
--
ALTER TABLE `protocolo`
  ADD CONSTRAINT `FK_F25CDCE06A540E` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `FK_F25CDCE0737BEF1C` FOREIGN KEY (`id_estacao`) REFERENCES `estacao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
