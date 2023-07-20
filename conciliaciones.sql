-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-07-2023 a las 22:24:28
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conciliaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `codigo`, `nombre`, `tipo`) VALUES
(3, 'q', 's', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `documento` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idtipo_cliente` int NOT NULL,
  `estado` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_clientes_tipos_idx` (`idtipo_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `documento`, `razon_social`, `telefono`, `direccion`, `idtipo_cliente`, `estado`) VALUES
(1, '1', 'ssdgafdsadf', '519805026033', 'adsfasdf', 2, '1'),
(2, '434343', 'sdsds', '43343434', '', 1, '1'),
(3, '43434354', 'asdfadsfa adsf adf ', '51980502603', 'afunn', 2, '1'),
(4, '2', 'Jose', '98832', 'Ayacucho', 1, '1'),
(5, '4433443', 'sdsd', '51980502603', 'sadf', 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_tipo`
--

DROP TABLE IF EXISTS `clientes_tipo`;
CREATE TABLE IF NOT EXISTS `clientes_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes_tipo`
--

INSERT INTO `clientes_tipo` (`id`, `nombre`) VALUES
(1, 'Natural'),
(2, 'Empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`) VALUES
(1, 'Piuras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

DROP TABLE IF EXISTS `distritos`;
CREATE TABLE IF NOT EXISTS `distritos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idprovincia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-provincia_idx` (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id`, `nombre`, `idprovincia`) VALUES
(1, 'Castillas', 1),
(10, 'asdfasdf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idtipo_materia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_materias_tipos_idx` (`idtipo_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `idtipo_materia`) VALUES
(5, 'sdfds adsf', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_tipo`
--

DROP TABLE IF EXISTS `materias_tipo`;
CREATE TABLE IF NOT EXISTS `materias_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias_tipo`
--

INSERT INTO `materias_tipo` (`id`, `nombre`) VALUES
(2, 'A'),
(3, 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iddepartamento` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_departamento_idx` (`iddepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`, `iddepartamento`) VALUES
(1, 'Piura', 1),
(2, 'da', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `n_expediente` int NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `idusuario` int NOT NULL,
  `estado` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `idcliente` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`idcliente`),
  KEY `id_idx1` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `n_expediente`, `fecha`, `url`, `idusuario`, `estado`, `idcliente`) VALUES
(1, 1, '2023-07-16 22:00:41', 'dist/docs/abogados/PRACTICAS_ELAR_MODULO_3.docx', 6, '2', 1),
(2, 1, '2023-07-18 22:11:44', 'dist/docs/abogados/Manual_Servicios_GRE.pdf', 6, '2', 4),
(3, 1, '2023-07-18 22:12:42', 'dist/docs/abogados/PRACTICAS_ELAR_MODULO_3.docx', 6, '1', 5),
(4, 1, '2023-07-18 22:44:23', NULL, 6, '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `documento` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idtipo_usuario` int NOT NULL,
  `idcargo` int NOT NULL DEFAULT '0',
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_idx` (`idtipo_usuario`),
  KEY `fk_usuarios_cargo_idx` (`idcargo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `documento`, `nombres`, `telefono`, `direccion`, `email`, `password`, `idtipo_usuario`, `idcargo`, `estado`) VALUES
(1, '1', 'Daniel', '51980502603', 't', 'elar@elar.com', '$2y$10$7fh69d3O31/XUoUUqFNMkeoxCAp1X8jacNH6356bx/KQd6r01sMvK', 1, 3, '1'),
(5, '34', 'asf', '51980502603', 'afunn', 'admin@admin.com', '$2y$10$7fh69d3O31/XUoUUqFNMkeoxCAp1X8jacNH6356bx/KQd6r01sMvK', 2, 3, '1'),
(6, '1', 'Elar Loepz', '51980502603', 'afunn', 'elar@gmail.com', '$2y$10$7fh69d3O31/XUoUUqFNMkeoxCAp1X8jacNH6356bx/KQd6r01sMvK', 3, 3, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tipo`
--

DROP TABLE IF EXISTS `usuarios_tipo`;
CREATE TABLE IF NOT EXISTS `usuarios_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios_tipo`
--

INSERT INTO `usuarios_tipo` (`id`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Secretaria'),
(3, 'Abogado');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_tipos` FOREIGN KEY (`idtipo_cliente`) REFERENCES `clientes_tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD CONSTRAINT `fk-provincia` FOREIGN KEY (`idprovincia`) REFERENCES `provincias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `fk_materias_tipos` FOREIGN KEY (`idtipo_materia`) REFERENCES `materias_tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `fk_departamento` FOREIGN KEY (`iddepartamento`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `fk_clientes` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_cargo` FOREIGN KEY (`idcargo`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_tipos` FOREIGN KEY (`idtipo_usuario`) REFERENCES `usuarios_tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
