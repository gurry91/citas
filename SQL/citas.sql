-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-12-2017 a las 11:59:57
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` ( 
  `id_horario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_horario`,`fecha`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_usuario`, `id_horario`, `fecha`) VALUES
(2, 36, '2017-12-13'),
(2, 37, '2017-12-13'),
(2, 37, '2017-12-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '00:00' COMMENT 'Hora inicio cita',
  `hora_fin` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '00:00',
  `profesor` int(11) NOT NULL,
  `dia` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Día de la semana en numerico [1-7]',
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `id_usuario` (`id_usuario`))
  ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `hora_inicio`, `hora_fin`, `profesor`, `dia`, `id_usuario`) VALUES
(2, '09:00', '09:20', 4, 2, 0),
(3, '09:20', '09:40', 4, 2, 0),
(4, '10:00', '10:20', 4, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
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

CREATE TABLE IF NOT EXISTS `usuarios` (
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
  UNIQUE KEY `n_usuario` (`n_usuario`),
  KEY `rol` (`rol`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `n_usuario`, `password`, `rol`, `nombre`, `apellido`, `apellido2`, `correo`, `direccion`, `fecha`, `dni`, `sexo`, `telefono`) VALUES
(1, 'root', 'hola', 1, 'Admin', 'Admin', 'Admin', 'admin@gmail.com', 'C/ Cervantes, 3, Ecija, Sevilla', '1991-03-03', '123456789G', 'Masculino', '666777888'),
(2, 'Salvory', 'entrar', 3, 'Salvador', 'Reyes', 'Morales', 's@hotmail.com', 'Almeria 9', '1992-01-07', '15456392R', 'Hombre', ''),
(4, 'Juan', 'entrar', 2, 'Juan', 'Farfan', 'noseque', 'juan@iesluisvelez.', 'Ecija 4', '2017-12-13', '1545321587', 'hombre', '648751874'),
(5, 'ivan', 'entrar', 3, 'Ivan', 'Ivan', 'Ivan', 'imp3@gmail.com', NULL, '0000-00-00', NULL, NULL, NULL),
(7, 'Fran', 'entrar', 3, 'Fran', 'Santiago', 'Lopez', 'asdfasf@gmail', 'asdfafd', '2017-12-14', '16461891', 'Mujer', '664818487');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
