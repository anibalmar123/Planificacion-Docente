-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2017 at 09:34 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ojaohvvv_pl00000`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id_administrador` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_administrador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`id_administrador`, `usuario`, `clave`) VALUES
(1, 'anibal', '123');

-- --------------------------------------------------------

--
-- Table structure for table `almacenamiento_recurso`
--

CREATE TABLE IF NOT EXISTS `almacenamiento_recurso` (
  `id_almacenamiento` int(11) NOT NULL,
  `lugar_guardado` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_almacenamiento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `area_recurso`
--

CREATE TABLE IF NOT EXISTS `area_recurso` (
  `id_area_recurso` int(11) NOT NULL,
  `nombre_area` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_area_recurso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `area_recurso`
--

INSERT INTO `area_recurso` (`id_area_recurso`, `nombre_area`) VALUES
(1, 'Lenguaje'),
(2, 'Matematicas'),
(3, 'Ciencias'),
(4, 'Ingles'),
(5, 'Historia'),
(6, 'Fisica');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_clase`
--

CREATE TABLE IF NOT EXISTS `comentarios_clase` (
  `id_comentario` int(11) NOT NULL,
  `comentario` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id_configuracion` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `tramo` int(11) NOT NULL,
  PRIMARY KEY (`id_configuracion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `hora_inicio`, `hora_fin`, `tramo`) VALUES
(1, '08:00:00', '17:00:00', 45);

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `anio` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nivel` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `letra` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `anio`, `nivel`, `letra`) VALUES
(1, '2017', ' Kinder ', 'A'),
(2, '2017', ' Primero Básico ', 'A'),
(3, '2017', ' Segundo Básico ', 'A'),
(4, '2017', ' Tercero Básico ', 'A'),
(5, '2017', ' Cuarto Básico ', 'A'),
(6, '2017', ' Quinto Básico ', 'A'),
(7, '2017', ' Sexto Básico ', 'A'),
(8, '2017', ' Séptimo Básico ', 'A'),
(9, '2017', ' Octavo Básico ', 'A'),
(10, '2017', ' Primero Medio ', 'A'),
(11, '2017', ' Segundo Medio ', 'A'),
(12, '2017', ' Tercero Medio ', 'A'),
(13, '2017', ' Cuarto Medio ', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `lugar_recurso`
--

CREATE TABLE IF NOT EXISTS `lugar_recurso` (
  `id_lugar` int(11) NOT NULL,
  `lugar_uso` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_lugar`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planificar`
--

CREATE TABLE IF NOT EXISTS `planificar` (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `dia` date NOT NULL,
  `hora_solicitud` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidad_solicitada` int(11) NOT NULL,
  `minuto_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_recurso` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  PRIMARY KEY (`id_plan`),
  KEY `FK_profesor` (`id_profesor`),
  KEY `FK_curso` (`id_curso`),
  KEY `FK_recurso` (`id_recurso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `planificar`
--

INSERT INTO `planificar` (`id_plan`, `dia`, `hora_solicitud`, `descripcion`, `cantidad_solicitada`, `minuto_registro`, `id_recurso`, `id_curso`, `id_profesor`) VALUES
(41, '2017-05-05', '02:00', 'adssadsad', 10, '2017-05-04 18:59:37', 30, 9, 5),
(42, '2017-05-05', '14:20', '----', 10, '2017-05-04 19:09:09', 30, 6, 5),
(43, '2017-05-05', '15:03', '---', 10, '2017-05-04 19:12:19', 30, 10, 5),
(44, '2017-05-05', '02:03', 'ss', 2, '2017-05-04 19:35:27', 30, 11, 5),
(45, '2017-05-05', '14:01', 'ss', 1, '2017-05-04 19:45:40', 30, 10, 5),
(46, '2017-05-06', '03:03', 'ee', 3, '2017-05-05 13:44:29', 30, 11, 5),
(47, '2017-05-05', '03:03', 'd', 4, '2017-05-05 14:51:23', 30, 10, 5),
(53, '2017-05-06', '03:03', 'dd', 3, '2017-05-05 17:21:56', 30, 12, 5),
(54, '2017-05-05', '03:03', 'ee', 3, '2017-05-05 17:22:35', 30, 11, 5),
(55, '2017-05-08', '02:02', 'ss', 4, '2017-05-05 17:36:55', 30, 10, 5),
(56, '2017-05-05', '04:04', 'ee', 4, '2017-05-05 17:42:24', 30, 8, 5),
(57, '2017-05-10', '16:00', 'ee', 5, '2017-05-09 17:08:52', 31, 10, 2),
(58, '2017-05-18', '04:04', 'dd', 5, '2017-05-17 18:13:47', 31, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `planificar_comentarios`
--

CREATE TABLE IF NOT EXISTS `planificar_comentarios` (
  `PLANIFICAR_id_recurso` int(11) NOT NULL,
  `PLANIFICAR_id_curso` int(11) NOT NULL,
  `PLANIFICAR_id_profesor` int(11) NOT NULL,
  `COMEN_CLASE_id_comentario` int(11) NOT NULL,
  PRIMARY KEY (`PLANIFICAR_id_recurso`,`PLANIFICAR_id_curso`,`PLANIFICAR_id_profesor`,`COMEN_CLASE_id_comentario`),
  KEY `PLAN_COM_CLASE_FK` (`COMEN_CLASE_id_comentario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

CREATE TABLE IF NOT EXISTS `profesor` (
  `id_profesor` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave_prof` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_profesor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `profesor`
--

INSERT INTO `profesor` (`id_profesor`, `nombre`, `apellido_paterno`, `apellido_materno`, `email`, `clave_prof`) VALUES
(5, 'sergio', 'hernandez', 'gonzalez', 'ser1234@gmail.com', '111'),
(2, 'ramon', 'valdes', 'valdes', 'ra777@gmail.com', '3245');

-- --------------------------------------------------------

--
-- Table structure for table `recurso`
--

CREATE TABLE IF NOT EXISTS `recurso` (
  `id_recurso` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre_recurso` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidad_total` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `LUGAR_RECURSO_id_lugar` int(11) NOT NULL,
  PRIMARY KEY (`id_recurso`),
  KEY `RECURSO_LUGAR_RECURSO_FK` (`LUGAR_RECURSO_id_lugar`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `recurso`
--

INSERT INTO `recurso` (`id_recurso`, `codigo`, `nombre_recurso`, `cantidad_total`, `descripcion`, `LUGAR_RECURSO_id_lugar`) VALUES
(30, 'SI111P', 'Dicccionario', 20, 'Diccionario', 0),
(31, 'QW999L', 'Imágenes', 50, 'Imagenes ciencias naturales', 0),
(33, 'LQ342209X', 'Abaco', 30, 'Calculo', 0),
(34, 'U983330P', 'Lengua Castellana', 70, 'Lenguaje y Comunicación', 0),
(35, 'U983330P', 'Cuento y Posesía', 35, 'Literatura', 0),
(36, 'G44455LK', 'Fisica conceptual 2° medio', 40, 'Curso de física para la enseñanza de nivel medio', 0),
(37, 'L499000M', 'Laboratorio tématico', 60, 'MATERIAL EDUCATIVO DIGITAL EFECTO EDUCATIVO - UNIDAD', 0);

--
-- Triggers `recurso`
--
DROP TRIGGER IF EXISTS `actualizarStock`;
DELIMITER //
CREATE TRIGGER `actualizarStock` AFTER INSERT ON `recurso`
 FOR EACH ROW insert into stock(cantidad_disponible, RECURSO_id_recurso) values (NEW.cantidad_total, NEW.id_recurso)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `recurso_almacenamiento`
--

CREATE TABLE IF NOT EXISTS `recurso_almacenamiento` (
  `RECURSO_id_recurso` int(11) NOT NULL,
  `ALMAC_RECURSO_id_almac` int(11) NOT NULL,
  PRIMARY KEY (`RECURSO_id_recurso`,`ALMAC_RECURSO_id_almac`),
  KEY `RECURSO_ALMA_ALMA_REC_FK` (`ALMAC_RECURSO_id_almac`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recurso_area_recurso`
--

CREATE TABLE IF NOT EXISTS `recurso_area_recurso` (
  `RECURSO_id_recurso` int(11) NOT NULL AUTO_INCREMENT,
  `AREA_RECURSO_id_area_recurso` int(11) NOT NULL,
  PRIMARY KEY (`RECURSO_id_recurso`,`AREA_RECURSO_id_area_recurso`),
  KEY `FK_ASS_7` (`AREA_RECURSO_id_area_recurso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `recurso_area_recurso`
--

INSERT INTO `recurso_area_recurso` (`RECURSO_id_recurso`, `AREA_RECURSO_id_area_recurso`) VALUES
(30, 1),
(31, 3),
(33, 2),
(34, 1),
(35, 1),
(36, 6),
(37, 2);

-- --------------------------------------------------------

--
-- Table structure for table `recurso_curso`
--

CREATE TABLE IF NOT EXISTS `recurso_curso` (
  `CURSO_id_curso` int(11) NOT NULL,
  `RECURSO_id_recurso` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`CURSO_id_curso`,`RECURSO_id_recurso`),
  KEY `FK_ASS_3` (`RECURSO_id_recurso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `recurso_curso`
--

INSERT INTO `recurso_curso` (`CURSO_id_curso`, `RECURSO_id_recurso`) VALUES
(1, 37),
(2, 31),
(2, 37),
(3, 31),
(3, 37),
(9, 34),
(10, 30),
(10, 35),
(11, 30),
(11, 36),
(12, 33),
(13, 33);

-- --------------------------------------------------------

--
-- Table structure for table `recurso_tipo_recurso`
--

CREATE TABLE IF NOT EXISTS `recurso_tipo_recurso` (
  `TIPO_RECURSO_id_tipo_recurso` int(11) NOT NULL,
  `RECURSO_id_recurso` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`TIPO_RECURSO_id_tipo_recurso`,`RECURSO_id_recurso`),
  KEY `FK_ASS_5` (`RECURSO_id_recurso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `recurso_tipo_recurso`
--

INSERT INTO `recurso_tipo_recurso` (`TIPO_RECURSO_id_tipo_recurso`, `RECURSO_id_recurso`) VALUES
(1, 30),
(1, 36),
(2, 31),
(2, 35),
(2, 36),
(3, 33),
(3, 34),
(4, 37);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_disponible` int(11) NOT NULL,
  `RECURSO_id_recurso` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`),
  KEY `STOCK_RECURSO_FK` (`RECURSO_id_recurso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `cantidad_disponible`, `RECURSO_id_recurso`) VALUES
(5, 20, 30),
(6, 40, 31),
(9, 70, 34),
(8, 30, 33),
(10, 35, 35),
(11, 40, 36),
(12, 60, 37);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_recurso`
--

CREATE TABLE IF NOT EXISTS `tipo_recurso` (
  `id_tipo_recurso` int(11) NOT NULL,
  `nombre_tipo` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_tipo_recurso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `tipo_recurso`
--

INSERT INTO `tipo_recurso` (`id_tipo_recurso`, `nombre_tipo`) VALUES
(1, 'Libros'),
(2, 'CD'),
(3, 'Tablets'),
(4, 'Digital');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
