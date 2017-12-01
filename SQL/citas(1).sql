-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-12-2017 a las 22:33:41
-- Versión del servidor: 5.5.57-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `citas`
--
CREATE DATABASE IF NOT EXISTS `citas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `citas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE `citas` (
  `id_usuario` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_horario`,`fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

DROP TABLE IF EXISTS `horarios`;
CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '00:00' COMMENT 'Hora inicio cita',
  `hora_fin` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '00:00',
  `profesor` int(11) NOT NULL,
  `dia` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Día de la semana en numerico [1-7]',
  PRIMARY KEY (`id_horario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `hora_inicio`, `hora_fin`, `profesor`, `dia`) VALUES
(1, '', '00:00', 0, 1),
(2, '', '00:00', 0, 1),
(3, '', '00:00', 0, 1),
(4, '', '00:00', 0, 1),
(5, '', '00:00', 0, 1),
(6, '', '00:00', 0, 1),
(7, '', '00:00', 0, 1),
(8, '', '00:00', 0, 1),
(9, '', '00:00', 0, 1),
(10, '', '00:00', 0, 1),
(11, '', '00:00', 0, 1),
(12, '', '00:00', 0, 1),
(13, '', '00:00', 0, 1),
(14, '', '00:00', 0, 1),
(15, '', '00:00', 0, 1),
(16, '', '00:00', 0, 1),
(17, '', '00:00', 0, 1),
(18, '', '00:00', 0, 1),
(19, '', '00:00', 0, 1),
(20, '', '00:00', 0, 1),
(21, '', '00:00', 0, 1),
(22, '', '00:00', 0, 1),
(23, '', '00:00', 0, 1),
(24, '', '00:00', 0, 1),
(25, '', '00:00', 0, 1),
(26, '', '00:00', 0, 1),
(27, '', '00:00', 0, 1),
(28, '', '00:00', 0, 1),
(29, '', '00:00', 0, 1),
(30, '', '00:00', 0, 1),
(31, '', '00:00', 0, 1),
(32, '', '00:00', 0, 1),
(33, '', '00:00', 0, 1),
(34, '', '00:00', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL COMMENT 'Nombre el módulo',
  `descripcion` text,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores_modulos`
--

DROP TABLE IF EXISTS `profesores_modulos`;
CREATE TABLE `profesores_modulos` (
  `id_profesor` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  PRIMARY KEY (`id_profesor`,`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'admin'),
(2, 'profesor'),
(3, 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_usuario` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'nombre de usuario',
  `password` varchar(30) COLLATE utf8_bin NOT NULL,
  `rol` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_bin NOT NULL,
  `apellido` varchar(30) COLLATE utf8_bin NOT NULL,
  `apellido2` varchar(30) COLLATE utf8_bin NOT NULL,
  `correo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date NOT NULL,
  `dni` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `sexo` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `n_usuario` (`n_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `n_usuario`, `password`, `rol`, `nombre`, `apellido`, `apellido2`, `correo`, `direccion`, `fecha`, `dni`, `sexo`, `telefono`) VALUES
(1, 'root', 'root', 1, 'Admin', 'Admin', 'Admin', 'admin@gmail.com', 'C/ Cervantes, 3, Ecija, Sevilla', '1991-03-03', '123456789G', 'Masculino', '666777888');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_modulos`
--

DROP TABLE IF EXISTS `usuarios_modulos`;
CREATE TABLE `usuarios_modulos` (
  `id_usuario` int(11) NOT NULL,
  `id_modulos` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_modulos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
