-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 08:35 PM
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
-- Table structure for table `Animal`
--

CREATE TABLE `Animal` (
  `id` int(11) NOT NULL,
  `id_Inducao` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Animal`
--

INSERT INTO `Animal` (`id`, `id_Inducao`, `numero`) VALUES
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
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
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
-- Table structure for table `Animal_Classificacao`
--

CREATE TABLE `Animal_Classificacao` (
  `id` int(11) NOT NULL,
  `id_Animal` int(11) NOT NULL,
  `id_Estacao` int(11) DEFAULT NULL,
  `dataDaMudanca` datetime NOT NULL,
  `id_ClassificacaoInicial` int(11) NOT NULL,
  `id_ClassificacaoFinal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Animal_Classificacao`
--

INSERT INTO `Animal_Classificacao` (`id`, `id_Animal`, `id_Estacao`, `dataDaMudanca`, `id_ClassificacaoInicial`, `id_ClassificacaoFinal`) VALUES
(1, 1, NULL, '2018-06-11 19:48:57', 1, 1),
(2, 2, NULL, '2018-06-11 19:49:00', 1, 1),
(3, 3, NULL, '2018-06-11 19:49:04', 1, 1),
(4, 4, NULL, '2018-06-11 19:49:07', 1, 1),
(5, 5, NULL, '2018-06-11 19:49:10', 1, 1),
(6, 6, NULL, '2018-06-11 19:49:14', 1, 1),
(7, 7, NULL, '2018-06-11 19:49:17', 1, 1),
(8, 8, NULL, '2018-06-11 19:49:21', 1, 1),
(9, 9, NULL, '2018-06-11 19:49:24', 1, 1),
(10, 10, NULL, '2018-06-11 19:49:27', 1, 1),
(11, 11, NULL, '2018-06-11 19:49:31', 1, 1),
(12, 12, NULL, '2018-06-11 19:49:37', 1, 1),
(13, 13, NULL, '2018-06-11 19:49:41', 1, 1),
(14, 14, NULL, '2018-06-11 19:49:43', 1, 1),
(15, 15, NULL, '2018-06-11 19:49:47', 1, 1),
(16, 16, NULL, '2018-06-11 19:49:50', 1, 1),
(17, 17, NULL, '2018-06-11 19:50:01', 1, 1),
(18, 18, NULL, '2018-06-11 19:50:06', 1, 1),
(19, 19, NULL, '2018-06-11 19:50:13', 1, 1),
(20, 20, NULL, '2018-06-11 19:50:17', 1, 1),
(21, 21, NULL, '2018-06-11 19:53:10', 2, 2),
(22, 22, NULL, '2018-06-11 19:53:38', 2, 2),
(23, 23, NULL, '2018-06-11 19:53:52', 2, 2),
(24, 24, NULL, '2018-06-11 19:54:45', 2, 2),
(25, 25, NULL, '2018-06-11 19:54:58', 2, 2),
(26, 26, NULL, '2018-06-11 19:55:30', 2, 2),
(27, 27, NULL, '2018-06-11 19:55:40', 2, 2),
(28, 28, NULL, '2018-06-11 19:56:11', 2, 2),
(29, 29, NULL, '2018-06-11 19:56:21', 2, 2),
(30, 30, NULL, '2018-06-11 19:56:32', 2, 2),
(31, 31, NULL, '2018-06-11 19:58:30', 4, 4),
(32, 32, NULL, '2018-06-11 19:58:42', 4, 4),
(33, 33, NULL, '2018-06-11 19:58:52', 4, 4),
(34, 34, NULL, '2018-06-11 19:59:12', 4, 4),
(35, 35, NULL, '2018-06-11 19:59:35', 4, 4),
(36, 36, NULL, '2018-06-11 20:00:13', 4, 4),
(37, 37, NULL, '2018-06-11 20:00:19', 4, 4),
(38, 38, NULL, '2018-06-11 20:00:53', 4, 4),
(39, 39, NULL, '2018-06-11 20:01:00', 4, 4),
(40, 40, NULL, '2018-06-11 20:01:08', 4, 4),
(41, 41, NULL, '2018-06-11 20:01:47', 3, NULL),
(42, 42, NULL, '2018-06-11 20:01:53', 3, NULL),
(43, 43, NULL, '2018-06-11 20:01:58', 3, NULL),
(44, 44, NULL, '2018-06-11 20:02:02', 3, NULL),
(45, 45, NULL, '2018-06-11 20:02:07', 3, NULL),
(46, 46, NULL, '2018-06-11 20:02:32', 5, NULL),
(47, 47, NULL, '2018-06-11 20:02:37', 5, NULL),
(48, 48, NULL, '2018-06-11 20:02:41', 5, NULL),
(49, 49, NULL, '2018-06-11 20:02:47', 5, NULL),
(50, 50, NULL, '2018-06-11 20:02:51', 5, NULL),
(51, 1, 1, '2018-06-11 20:21:59', 1, NULL),
(52, 2, 1, '2018-06-11 20:21:59', 1, NULL),
(53, 3, 1, '2018-06-11 20:21:59', 1, NULL),
(54, 4, 1, '2018-06-11 20:21:59', 1, NULL),
(55, 5, 1, '2018-06-11 20:21:59', 1, NULL),
(56, 6, 1, '2018-06-11 20:21:59', 1, NULL),
(57, 7, 1, '2018-06-11 20:21:59', 1, NULL),
(58, 8, 1, '2018-06-11 20:21:59', 1, NULL),
(59, 9, 1, '2018-06-11 20:21:59', 1, NULL),
(60, 10, 1, '2018-06-11 20:21:59', 1, NULL),
(61, 11, 1, '2018-06-11 20:21:59', 1, NULL),
(62, 12, 1, '2018-06-11 20:21:59', 1, NULL),
(63, 13, 1, '2018-06-11 20:21:59', 1, NULL),
(64, 14, 1, '2018-06-11 20:21:59', 1, NULL),
(65, 15, 1, '2018-06-11 20:21:59', 1, NULL),
(66, 16, 1, '2018-06-11 20:21:59', 1, NULL),
(67, 17, 1, '2018-06-11 20:21:59', 1, NULL),
(68, 18, 1, '2018-06-11 20:21:59', 1, NULL),
(69, 19, 1, '2018-06-11 20:21:59', 1, NULL),
(70, 20, 1, '2018-06-11 20:21:59', 1, NULL),
(71, 21, 1, '2018-06-11 20:21:59', 2, NULL),
(72, 22, 1, '2018-06-11 20:21:59', 2, NULL),
(73, 23, 1, '2018-06-11 20:21:59', 2, NULL),
(74, 24, 1, '2018-06-11 20:21:59', 2, NULL),
(75, 25, 1, '2018-06-11 20:21:59', 2, NULL),
(76, 26, 1, '2018-06-11 20:21:59', 2, NULL),
(77, 27, 1, '2018-06-11 20:21:59', 2, NULL),
(78, 28, 1, '2018-06-11 20:21:59', 2, NULL),
(79, 29, 1, '2018-06-11 20:21:59', 2, NULL),
(80, 30, 1, '2018-06-11 20:21:59', 2, NULL),
(81, 31, 1, '2018-06-11 20:21:59', 4, NULL),
(82, 32, 1, '2018-06-11 20:21:59', 4, NULL),
(83, 33, 1, '2018-06-11 20:21:59', 4, NULL),
(84, 34, 1, '2018-06-11 20:21:59', 4, NULL),
(85, 35, 1, '2018-06-11 20:21:59', 4, NULL),
(86, 36, 1, '2018-06-11 20:21:59', 4, NULL),
(87, 37, 1, '2018-06-11 20:21:59', 4, NULL),
(88, 38, 1, '2018-06-11 20:21:59', 4, NULL),
(89, 39, 1, '2018-06-11 20:21:59', 4, NULL),
(90, 40, 1, '2018-06-11 20:21:59', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Classificacao`
--

CREATE TABLE `Classificacao` (
  `id` int(11) NOT NULL,
  `Classificacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Classificacao`
--

INSERT INTO `Classificacao` (`id`, `Classificacao`) VALUES
(1, 'Novilha'),
(2, 'Primípara Pós-Parto'),
(3, 'Primípara Gestante da Estação Anterior'),
(4, 'Multípara Pós-Parto'),
(5, 'Multípara Gestante da Estação Anterior');

-- --------------------------------------------------------

--
-- Table structure for table `Cronologia`
--

CREATE TABLE `Cronologia` (
  `id` int(11) NOT NULL,
  `id_Animal` int(11) NOT NULL,
  `id_ia` int(11) DEFAULT NULL,
  `id_Estacao` int(11) DEFAULT NULL,
  `id_Classificacao` int(11) NOT NULL,
  `dataDaMudanca` datetime NOT NULL,
  `id_EstadoInicial` int(11) NOT NULL,
  `id_EstadoFinal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Cronologia`
--

INSERT INTO `Cronologia` (`id`, `id_Animal`, `id_ia`, `id_Estacao`, `id_Classificacao`, `dataDaMudanca`, `id_EstadoInicial`, `id_EstadoFinal`) VALUES
(1, 1, NULL, NULL, 1, '2018-06-11 19:48:57', 6, 6),
(2, 2, NULL, NULL, 1, '2018-06-11 19:49:00', 6, 6),
(3, 3, NULL, NULL, 1, '2018-06-11 19:49:04', 6, 6),
(4, 4, NULL, NULL, 1, '2018-06-11 19:49:07', 6, 6),
(5, 5, NULL, NULL, 1, '2018-06-11 19:49:10', 6, 6),
(6, 6, NULL, NULL, 1, '2018-06-11 19:49:14', 6, 6),
(7, 7, NULL, NULL, 1, '2018-06-11 19:49:17', 6, 6),
(8, 8, NULL, NULL, 1, '2018-06-11 19:49:21', 6, 6),
(9, 9, NULL, NULL, 1, '2018-06-11 19:49:24', 6, 6),
(10, 10, NULL, NULL, 1, '2018-06-11 19:49:27', 6, 6),
(11, 11, NULL, NULL, 1, '2018-06-11 19:49:31', 6, 6),
(12, 12, NULL, NULL, 1, '2018-06-11 19:49:37', 6, 6),
(13, 13, NULL, NULL, 1, '2018-06-11 19:49:41', 6, 6),
(14, 14, NULL, NULL, 1, '2018-06-11 19:49:43', 6, 6),
(15, 15, NULL, NULL, 1, '2018-06-11 19:49:47', 6, 6),
(16, 16, NULL, NULL, 1, '2018-06-11 19:49:50', 6, 6),
(17, 17, NULL, NULL, 1, '2018-06-11 19:50:01', 6, 6),
(18, 18, NULL, NULL, 1, '2018-06-11 19:50:06', 6, 6),
(19, 19, NULL, NULL, 1, '2018-06-11 19:50:13', 6, 6),
(20, 20, NULL, NULL, 1, '2018-06-11 19:50:17', 6, 6),
(21, 21, NULL, NULL, 2, '2018-06-11 19:53:10', 5, 5),
(22, 22, NULL, NULL, 2, '2018-06-11 19:53:38', 5, 5),
(23, 23, NULL, NULL, 2, '2018-06-11 19:53:52', 5, 5),
(24, 24, NULL, NULL, 2, '2018-06-11 19:54:45', 5, 5),
(25, 25, NULL, NULL, 2, '2018-06-11 19:54:58', 5, 5),
(26, 26, NULL, NULL, 2, '2018-06-11 19:55:30', 5, 5),
(27, 27, NULL, NULL, 2, '2018-06-11 19:55:40', 5, 5),
(28, 28, NULL, NULL, 2, '2018-06-11 19:56:11', 5, 5),
(29, 29, NULL, NULL, 2, '2018-06-11 19:56:21', 5, 5),
(30, 30, NULL, NULL, 2, '2018-06-11 19:56:32', 5, 5),
(31, 31, NULL, NULL, 4, '2018-06-11 19:58:30', 5, 5),
(32, 32, NULL, NULL, 4, '2018-06-11 19:58:42', 5, 5),
(33, 33, NULL, NULL, 4, '2018-06-11 19:58:52', 5, 5),
(34, 34, NULL, NULL, 4, '2018-06-11 19:59:12', 5, 5),
(35, 35, NULL, NULL, 4, '2018-06-11 19:59:35', 5, 5),
(36, 36, NULL, NULL, 4, '2018-06-11 20:00:13', 5, 5),
(37, 37, NULL, NULL, 4, '2018-06-11 20:00:19', 5, 5),
(38, 38, NULL, NULL, 4, '2018-06-11 20:00:53', 5, 5),
(39, 39, NULL, NULL, 4, '2018-06-11 20:01:00', 5, 5),
(40, 40, NULL, NULL, 4, '2018-06-11 20:01:08', 5, 5),
(41, 41, NULL, NULL, 3, '2018-06-11 20:01:47', 4, NULL),
(42, 42, NULL, NULL, 3, '2018-06-11 20:01:53', 4, NULL),
(43, 43, NULL, NULL, 3, '2018-06-11 20:01:58', 4, NULL),
(44, 44, NULL, NULL, 3, '2018-06-11 20:02:02', 4, NULL),
(45, 45, NULL, NULL, 3, '2018-06-11 20:02:07', 4, NULL),
(46, 46, NULL, NULL, 5, '2018-06-11 20:02:32', 4, NULL),
(47, 47, NULL, NULL, 5, '2018-06-11 20:02:37', 4, NULL),
(48, 48, NULL, NULL, 5, '2018-06-11 20:02:41', 4, NULL),
(49, 49, NULL, NULL, 5, '2018-06-11 20:02:47', 4, NULL),
(50, 50, NULL, NULL, 5, '2018-06-11 20:02:51', 4, NULL),
(51, 1, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(52, 2, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(53, 3, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(54, 4, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(55, 5, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(56, 6, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(57, 7, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(58, 8, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(59, 9, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(60, 10, NULL, 1, 1, '2018-06-11 20:21:59', 6, 2),
(61, 11, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(62, 12, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(63, 13, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(64, 14, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(65, 15, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(66, 16, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(67, 17, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(68, 18, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(69, 19, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(70, 20, NULL, 1, 1, '2018-06-11 20:21:59', 6, 7),
(71, 21, NULL, 1, 2, '2018-06-11 20:21:59', 5, 2),
(72, 22, NULL, 1, 2, '2018-06-11 20:21:59', 5, 2),
(73, 23, NULL, 1, 2, '2018-06-11 20:21:59', 5, 2),
(74, 24, NULL, 1, 2, '2018-06-11 20:21:59', 5, 2),
(75, 25, NULL, 1, 2, '2018-06-11 20:21:59', 5, 2),
(76, 26, NULL, 1, 2, '2018-06-11 20:21:59', 5, 2),
(77, 27, NULL, 1, 2, '2018-06-11 20:21:59', 5, 2),
(78, 28, NULL, 1, 2, '2018-06-11 20:21:59', 5, NULL),
(79, 29, NULL, 1, 2, '2018-06-11 20:21:59', 5, NULL),
(80, 30, NULL, 1, 2, '2018-06-11 20:21:59', 5, NULL),
(81, 31, NULL, 1, 4, '2018-06-11 20:21:59', 5, 2),
(82, 32, NULL, 1, 4, '2018-06-11 20:21:59', 5, 2),
(83, 33, NULL, 1, 4, '2018-06-11 20:21:59', 5, 2),
(84, 34, NULL, 1, 4, '2018-06-11 20:21:59', 5, 2),
(85, 35, NULL, 1, 4, '2018-06-11 20:21:59', 5, 2),
(86, 36, NULL, 1, 4, '2018-06-11 20:21:59', 5, 2),
(87, 37, NULL, 1, 4, '2018-06-11 20:21:59', 5, 2),
(88, 38, NULL, 1, 4, '2018-06-11 20:21:59', 5, NULL),
(89, 39, NULL, 1, 4, '2018-06-11 20:21:59', 5, NULL),
(90, 40, NULL, 1, 4, '2018-06-11 20:21:59', 5, NULL),
(91, 12, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(92, 13, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(93, 14, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(94, 15, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(95, 16, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(96, 17, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(97, 18, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(98, 19, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(99, 20, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(100, 11, NULL, 1, 1, '2018-06-11 20:22:35', 7, 2),
(101, 21, 1, 1, 2, '2018-06-11 20:23:43', 2, 1),
(102, 26, 2, 1, 2, '2018-06-11 20:23:43', 2, 3),
(103, 22, 3, 1, 2, '2018-06-11 20:23:43', 2, 1),
(104, 1, 4, 1, 1, '2018-06-11 20:23:43', 2, 3),
(105, 2, 5, 1, 1, '2018-06-11 20:23:43', 2, 3),
(106, 3, 6, 1, 1, '2018-06-11 20:23:43', 2, 3),
(107, 4, 7, 1, 1, '2018-06-11 20:23:43', 2, 3),
(108, 5, 8, 1, 1, '2018-06-11 20:23:43', 2, 3),
(109, 6, 9, 1, 1, '2018-06-11 20:23:43', 2, 3),
(110, 7, 10, 1, 1, '2018-06-11 20:23:43', 2, 1),
(111, 8, 11, 1, 1, '2018-06-11 20:23:43', 2, 1),
(112, 9, 12, 1, 1, '2018-06-11 20:23:43', 2, 1),
(113, 10, 13, 1, 1, '2018-06-11 20:23:43', 2, 1),
(114, 35, 14, 1, 4, '2018-06-11 20:23:43', 2, 3),
(115, 31, 15, 1, 4, '2018-06-11 20:23:43', 2, 3),
(116, 23, 16, 1, 2, '2018-06-11 20:23:43', 2, 3),
(117, 27, 17, 1, 2, '2018-06-11 20:29:40', 2, 1),
(118, 32, 18, 1, 4, '2018-06-11 20:29:40', 2, 3),
(119, 33, 19, 1, 4, '2018-06-11 20:29:40', 2, 3),
(120, 34, 20, 1, 4, '2018-06-11 20:29:40', 2, 3),
(121, 11, 21, 1, 1, '2018-06-11 20:29:40', 2, 3),
(122, 12, 22, 1, 1, '2018-06-11 20:29:40', 2, 3),
(123, 13, 23, 1, 1, '2018-06-11 20:29:40', 2, 3),
(124, 14, 24, 1, 1, '2018-06-11 20:29:40', 2, 3),
(125, 15, 25, 1, 1, '2018-06-11 20:29:40', 2, 3),
(126, 16, 26, 1, 1, '2018-06-11 20:29:40', 2, 3),
(127, 17, 27, 1, 1, '2018-06-11 20:29:40', 2, 3),
(128, 18, 28, 1, 1, '2018-06-11 20:29:40', 2, 1),
(129, 19, 29, 1, 1, '2018-06-11 20:29:40', 2, 1),
(130, 20, 30, 1, 1, '2018-06-11 20:29:40', 2, 1),
(131, 36, 31, 1, 4, '2018-06-11 20:29:40', 2, 1),
(132, 37, 32, 1, 4, '2018-06-11 20:29:40', 2, 1),
(133, 25, 33, 1, 2, '2018-06-11 20:29:40', 2, 3),
(134, 24, 34, 1, 2, '2018-06-11 20:29:40', 2, 3),
(135, 35, 14, 1, 4, '2018-06-11 20:30:44', 3, NULL),
(136, 31, 15, 1, 4, '2018-06-11 20:30:44', 3, NULL),
(137, 26, 2, 1, 2, '2018-06-11 20:30:44', 3, NULL),
(138, 23, 16, 1, 2, '2018-06-11 20:30:44', 3, NULL),
(139, 22, 3, 1, 2, '2018-06-11 20:30:44', 3, NULL),
(140, 21, 1, 1, 2, '2018-06-11 20:30:44', 3, NULL),
(141, 10, 13, 1, 1, '2018-06-11 20:30:44', 3, NULL),
(142, 6, 9, 1, 1, '2018-06-11 20:30:44', 3, NULL),
(143, 5, 8, 1, 1, '2018-06-11 20:30:44', 3, NULL),
(144, 4, 7, 1, 1, '2018-06-11 20:30:44', 3, NULL),
(145, 3, 6, 1, 1, '2018-06-11 20:30:44', 3, NULL),
(146, 2, 5, 1, 1, '2018-06-11 20:30:44', 3, 2),
(147, 1, 4, 1, 1, '2018-06-11 20:30:44', 3, 2),
(148, 10, 13, 1, 1, '2018-06-11 20:30:44', 1, NULL),
(149, 9, 12, 1, 1, '2018-06-11 20:30:44', 1, NULL),
(150, 8, 11, 1, 1, '2018-06-11 20:30:44', 1, NULL),
(151, 7, 10, 1, 1, '2018-06-11 20:30:44', 1, NULL),
(152, 21, 1, 1, 2, '2018-06-11 20:30:44', 1, NULL),
(153, 22, 3, 1, 2, '2018-06-11 20:30:44', 1, NULL),
(154, 37, 32, 1, 4, '2018-06-11 20:32:07', 3, NULL),
(155, 36, 31, 1, 4, '2018-06-11 20:32:07', 3, NULL),
(156, 34, 20, 1, 4, '2018-06-11 20:32:07', 3, NULL),
(157, 33, 19, 1, 4, '2018-06-11 20:32:07', 3, NULL),
(158, 32, 18, 1, 4, '2018-06-11 20:32:07', 3, NULL),
(159, 27, 17, 1, 2, '2018-06-11 20:32:07', 3, NULL),
(160, 25, 33, 1, 2, '2018-06-11 20:32:07', 3, NULL),
(161, 24, 34, 1, 2, '2018-06-11 20:32:07', 3, NULL),
(162, 20, 30, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(163, 19, 29, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(164, 18, 28, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(165, 17, 27, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(166, 16, 26, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(167, 15, 25, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(168, 14, 24, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(169, 13, 23, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(170, 12, 22, 1, 1, '2018-06-11 20:32:07', 3, NULL),
(171, 11, 21, 1, 1, '2018-06-11 20:32:07', 3, 2),
(172, 20, 30, 1, 1, '2018-06-11 20:32:07', 1, NULL),
(173, 19, 29, 1, 1, '2018-06-11 20:32:07', 1, NULL),
(174, 18, 28, 1, 1, '2018-06-11 20:32:07', 1, NULL),
(175, 37, 32, 1, 4, '2018-06-11 20:32:07', 1, NULL),
(176, 36, 31, 1, 4, '2018-06-11 20:32:07', 1, NULL),
(177, 27, 17, 1, 2, '2018-06-11 20:32:07', 1, NULL),
(178, 1, 35, 1, 1, '2018-06-11 20:34:01', 2, NULL),
(179, 2, 36, 1, 1, '2018-06-11 20:34:09', 2, NULL),
(180, 11, 37, 1, 1, '2018-06-11 20:35:43', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Estacao`
--

CREATE TABLE `Estacao` (
  `id` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Estacao`
--

INSERT INTO `Estacao` (`id`, `dataInicio`, `dataFinal`) VALUES
(1, '2018-01-01', '2018-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `Estado`
--

CREATE TABLE `Estado` (
  `id` int(11) NOT NULL,
  `Estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Estado`
--

INSERT INTO `Estado` (`id`, `Estado`) VALUES
(1, 'Apto'),
(2, 'Aguardando Diagnóstico 1'),
(3, 'Aguardando Diagnóstico 2'),
(4, 'Gestante'),
(5, 'Pós-Parto'),
(6, 'Aguardando Indução'),
(7, 'Pós-Indução');

-- --------------------------------------------------------

--
-- Table structure for table `IA`
--

CREATE TABLE `IA` (
  `id` int(11) NOT NULL,
  `id_Animal` int(11) NOT NULL,
  `id_Estacao` int(11) DEFAULT NULL,
  `id_Protocolo` int(11) DEFAULT NULL,
  `id_Estado` int(11) NOT NULL,
  `saiuProtocolo` tinyint(1) NOT NULL,
  `dataInseminacao` date NOT NULL,
  `dataRetornoAoCio` date NOT NULL,
  `dataDiagnostico1` date NOT NULL,
  `dataDiagnostico2` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `IA`
--

INSERT INTO `IA` (`id`, `id_Animal`, `id_Estacao`, `id_Protocolo`, `id_Estado`, `saiuProtocolo`, `dataInseminacao`, `dataRetornoAoCio`, `dataDiagnostico1`, `dataDiagnostico2`) VALUES
(1, 21, 1, 1, 2, 1, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(2, 26, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(3, 22, 1, 1, 2, 1, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(4, 1, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(5, 2, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(6, 3, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(7, 4, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(8, 5, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(9, 6, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(10, 7, 1, 1, 2, 1, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(11, 8, 1, 1, 2, 1, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(12, 9, 1, 1, 2, 1, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(13, 10, 1, 1, 2, 1, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(14, 35, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(15, 31, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(16, 23, 1, 1, 2, 0, '2018-01-01', '2018-01-21', '2018-01-28', '2018-03-29'),
(17, 27, 1, 2, 2, 1, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(18, 32, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(19, 33, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(20, 34, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(21, 11, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(22, 12, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(23, 13, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(24, 14, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(25, 15, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(26, 16, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(27, 17, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(28, 18, 1, 2, 2, 1, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(29, 19, 1, 2, 2, 1, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(30, 20, 1, 2, 2, 1, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(31, 36, 1, 2, 2, 1, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(32, 37, 1, 2, 2, 1, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(33, 25, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(34, 24, 1, 2, 2, 0, '2018-01-13', '2018-02-02', '2018-02-09', '2018-04-10'),
(35, 1, 1, 1, 2, 1, '2018-02-10', '2018-03-02', '2018-03-09', '2018-05-08'),
(36, 2, 1, 1, 2, 1, '2018-02-10', '2018-03-02', '2018-03-09', '2018-05-08'),
(37, 11, 1, 2, 2, 1, '2018-02-10', '2018-03-02', '2018-03-09', '2018-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `Inducao`
--

CREATE TABLE `Inducao` (
  `id` int(11) NOT NULL,
  `id_Estacao` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Inducao`
--

INSERT INTO `Inducao` (`id`, `id_Estacao`, `dataInicio`, `dataFinal`) VALUES
(1, 1, '2018-01-01', '2018-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `Observacao`
--

CREATE TABLE `Observacao` (
  `id` int(11) NOT NULL,
  `id_Animal` int(11) NOT NULL,
  `dataDiagnostico` date NOT NULL,
  `Observacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Parto`
--

CREATE TABLE `Parto` (
  `id` int(11) NOT NULL,
  `id_Animal` int(11) NOT NULL,
  `Parto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Parto`
--

INSERT INTO `Parto` (`id`, `id_Animal`, `Parto`) VALUES
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
-- Table structure for table `Protocolo`
--

CREATE TABLE `Protocolo` (
  `id` int(11) NOT NULL,
  `id_Estacao` int(11) DEFAULT NULL,
  `id_Estado` int(11) NOT NULL,
  `numero` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Protocolo`
--

INSERT INTO `Protocolo` (`id`, `id_Estacao`, `id_Estado`, `numero`) VALUES
(1, 1, 3, 1),
(2, 1, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Animal`
--
ALTER TABLE `Animal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_uniq` (`numero`),
  ADD KEY `IDX_6D072629B408C367` (`id_Inducao`);

--
-- Indexes for table `Animal_Classificacao`
--
ALTER TABLE `Animal_Classificacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E90B21434C9C96F2` (`id_Animal`),
  ADD KEY `IDX_E90B21439F4C0C45` (`id_ClassificacaoInicial`),
  ADD KEY `IDX_E90B21436CE62FFC` (`id_ClassificacaoFinal`),
  ADD KEY `IDX_E90B2143737BEF1C` (`id_Estacao`);

--
-- Indexes for table `Classificacao`
--
ALTER TABLE `Classificacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Cronologia`
--
ALTER TABLE `Cronologia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9F27263A4C9C96F2` (`id_Animal`),
  ADD KEY `IDX_9F27263AF2E6AD8` (`id_ia`),
  ADD KEY `IDX_9F27263A737BEF1C` (`id_Estacao`),
  ADD KEY `IDX_9F27263AD47CDAFD` (`id_Classificacao`),
  ADD KEY `IDX_9F27263AA8F61545` (`id_EstadoInicial`),
  ADD KEY `IDX_9F27263A930B1BA0` (`id_EstadoFinal`);

--
-- Indexes for table `Estacao`
--
ALTER TABLE `Estacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Estado`
--
ALTER TABLE `Estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `IA`
--
ALTER TABLE `IA`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_61B997B54C9C96F2` (`id_Animal`),
  ADD KEY `IDX_61B997B5737BEF1C` (`id_Estacao`),
  ADD KEY `IDX_61B997B5F098E264` (`id_Protocolo`),
  ADD KEY `IDX_61B997B56A540E` (`id_Estado`);

--
-- Indexes for table `Inducao`
--
ALTER TABLE `Inducao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A528538B737BEF1C` (`id_Estacao`);

--
-- Indexes for table `Observacao`
--
ALTER TABLE `Observacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5D6712DD4C9C96F2` (`id_Animal`);

--
-- Indexes for table `Parto`
--
ALTER TABLE `Parto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BC80D4B54C9C96F2` (`id_Animal`);

--
-- Indexes for table `Protocolo`
--
ALTER TABLE `Protocolo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F25CDCE0737BEF1C` (`id_Estacao`),
  ADD KEY `IDX_F25CDCE06A540E` (`id_Estado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Animal`
--
ALTER TABLE `Animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `Animal_Classificacao`
--
ALTER TABLE `Animal_Classificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `Classificacao`
--
ALTER TABLE `Classificacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Cronologia`
--
ALTER TABLE `Cronologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `Estacao`
--
ALTER TABLE `Estacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Estado`
--
ALTER TABLE `Estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `IA`
--
ALTER TABLE `IA`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `Inducao`
--
ALTER TABLE `Inducao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Observacao`
--
ALTER TABLE `Observacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Parto`
--
ALTER TABLE `Parto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `Protocolo`
--
ALTER TABLE `Protocolo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Animal`
--
ALTER TABLE `Animal`
  ADD CONSTRAINT `FK_6D072629B408C367` FOREIGN KEY (`id_Inducao`) REFERENCES `Inducao` (`id`);

--
-- Constraints for table `Animal_Classificacao`
--
ALTER TABLE `Animal_Classificacao`
  ADD CONSTRAINT `FK_E90B21434C9C96F2` FOREIGN KEY (`id_Animal`) REFERENCES `Animal` (`id`),
  ADD CONSTRAINT `FK_E90B21436CE62FFC` FOREIGN KEY (`id_ClassificacaoFinal`) REFERENCES `Classificacao` (`id`),
  ADD CONSTRAINT `FK_E90B2143737BEF1C` FOREIGN KEY (`id_Estacao`) REFERENCES `Estacao` (`id`),
  ADD CONSTRAINT `FK_E90B21439F4C0C45` FOREIGN KEY (`id_ClassificacaoInicial`) REFERENCES `Classificacao` (`id`);

--
-- Constraints for table `Cronologia`
--
ALTER TABLE `Cronologia`
  ADD CONSTRAINT `FK_9F27263A4C9C96F2` FOREIGN KEY (`id_Animal`) REFERENCES `Animal` (`id`),
  ADD CONSTRAINT `FK_9F27263A737BEF1C` FOREIGN KEY (`id_Estacao`) REFERENCES `Estacao` (`id`),
  ADD CONSTRAINT `FK_9F27263A930B1BA0` FOREIGN KEY (`id_EstadoFinal`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_9F27263AA8F61545` FOREIGN KEY (`id_EstadoInicial`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_9F27263AD47CDAFD` FOREIGN KEY (`id_Classificacao`) REFERENCES `Classificacao` (`id`),
  ADD CONSTRAINT `FK_9F27263AF2E6AD8` FOREIGN KEY (`id_ia`) REFERENCES `IA` (`id`);

--
-- Constraints for table `IA`
--
ALTER TABLE `IA`
  ADD CONSTRAINT `FK_61B997B54C9C96F2` FOREIGN KEY (`id_Animal`) REFERENCES `Animal` (`id`),
  ADD CONSTRAINT `FK_61B997B56A540E` FOREIGN KEY (`id_Estado`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_61B997B5737BEF1C` FOREIGN KEY (`id_Estacao`) REFERENCES `Estacao` (`id`),
  ADD CONSTRAINT `FK_61B997B5F098E264` FOREIGN KEY (`id_Protocolo`) REFERENCES `Protocolo` (`id`);

--
-- Constraints for table `Inducao`
--
ALTER TABLE `Inducao`
  ADD CONSTRAINT `FK_A528538B737BEF1C` FOREIGN KEY (`id_Estacao`) REFERENCES `Estacao` (`id`);

--
-- Constraints for table `Observacao`
--
ALTER TABLE `Observacao`
  ADD CONSTRAINT `FK_5D6712DD4C9C96F2` FOREIGN KEY (`id_Animal`) REFERENCES `Animal` (`id`);

--
-- Constraints for table `Parto`
--
ALTER TABLE `Parto`
  ADD CONSTRAINT `FK_BC80D4B54C9C96F2` FOREIGN KEY (`id_Animal`) REFERENCES `Animal` (`id`);

--
-- Constraints for table `Protocolo`
--
ALTER TABLE `Protocolo`
  ADD CONSTRAINT `FK_F25CDCE06A540E` FOREIGN KEY (`id_Estado`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_F25CDCE0737BEF1C` FOREIGN KEY (`id_Estacao`) REFERENCES `Estacao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
