-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2018 a las 00:57:03
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id7556335_ejercicios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimoLogin` datetime NOT NULL,
  `perfil` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `operaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `usuario`, `clave`, `fechaRegistro`, `ultimoLogin`, `perfil`, `estado`, `operaciones`) VALUES
(1, 'Pablo', 'pablo', '123456', '2018-11-19 15:42:46', '2018-11-19 20:59:50', 'socio', 'H', 37),
(2, 'Juan', 'juancito', 'juan123', '2018-11-19 16:39:55', '0000-00-00 00:00:00', 'mozo', 'H', 0),
(3, 'Carlos', 'carlitos', 'carlitos123', '2018-11-19 16:42:37', '2018-11-19 13:42:55', 'mozo', 'B', 0),
(4, 'Jose', 'joselito', '123456', '2018-11-19 17:03:40', '2018-11-20 16:28:03', 'mozo', 'H', 139),
(5, 'Julian', 'julian', '123456', '2018-11-19 19:39:49', '0000-00-00 00:00:00', 'bartender', 'H', 0),
(6, 'Gerardo', 'gerardo', '123456', '2018-11-19 19:40:15', '0000-00-00 00:00:00', 'cervecero', 'S', 0),
(7, 'Eduardo', 'edu', '123456', '2018-11-19 19:40:29', '2018-11-19 19:49:35', 'cocinero', 'H', 24),
(8, 'Lucas', 'lukita', '123456', '2018-11-19 19:40:52', '0000-00-00 00:00:00', 'cocinero', 'H', 0),
(9, 'Matias', 'matias', '123456', '2018-11-19 19:41:08', '0000-00-00 00:00:00', 'bartender', 'H', 0),
(10, 'Mauro', 'mauro', '123456', '2018-11-19 19:41:21', '0000-00-00 00:00:00', 'cervecero', 'H', 0),
(11, 'Ailen', 'ailen', 'malencuyen', '2018-11-19 19:43:05', '0000-00-00 00:00:00', 'socio', 'H', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `puntuacion_mesa` int(11) NOT NULL,
  `codigoMesa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `puntuacion_restaurante` int(11) NOT NULL,
  `puntuacion_mozo` int(11) NOT NULL,
  `puntuacion_cocinero` int(11) NOT NULL,
  `comentario` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `importe` float NOT NULL,
  `codigoMesa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `codigo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`codigo`, `estado`, `foto`) VALUES
('mesa01', 'Cerrada', ''),
('mesa02', 'Cerrada', ''),
('mesa03', 'Cerrada', ''),
('mesa04', 'Cerrada', ''),
('mesa05', 'Cerrada', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora_pedido` time NOT NULL,
  `hora_entrega_estimada` time NOT NULL,
  `hora_entrega` time NOT NULL,
  `id_mesa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pedido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `importe` float NOT NULL,
  `mozo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_cliente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estadoPedido` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sector` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `encargado_pedido` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
