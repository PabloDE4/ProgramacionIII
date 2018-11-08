-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2018 a las 20:23:59
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
-- Base de datos: `usuarioventa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `articulo` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `precio` float NOT NULL,
  `usuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `articulo`, `fecha`, `precio`, `usuario`) VALUES
(1, 'bicicleta', '2018-11-08 17:17:37', 152, 'pablo'),
(2, 'pc gamer', '2018-11-08 17:18:52', 5523.3, 'pablo'),
(3, 'microondas', '2018-11-08 17:34:36', 1582.6, 'juan'),
(4, 'escritorio', '2018-11-08 19:08:13', 500, 'pablo'),
(5, 'escritorio', '2018-11-08 19:09:24', 500, 'pablo'),
(6, 'escritorio', '2018-11-08 19:10:09', 500, 'pablo'),
(7, 'escritorio', '2018-11-08 19:10:40', 500, 'pablo'),
(8, 'escritorio', '2018-11-08 19:13:49', 500, 'pablo'),
(9, 'mesa', '2018-11-08 19:15:59', 125, 'pablo'),
(10, 'mesa', '2018-11-08 19:21:17', 125, 'pablo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `usuario` text,
  `metodo` varchar(50) NOT NULL,
  `ruta` varchar(350) NOT NULL,
  `hora` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `usuario`, `metodo`, `ruta`, `hora`) VALUES
(2, 'pablo', 'GET', 'http://localhost/modelos/SP/Usuario-venta/compra', '15:12'),
(3, NULL, 'POST', 'http://localhost/modelos/SP/Usuario-venta/login', '16:08'),
(4, NULL, 'POST', 'http://localhost/modelos/SP/Usuario-venta/login', '16:09'),
(5, 'pablo', 'POST', 'http://localhost/modelos/SP/Usuario-venta/compra', '16:21'),
(6, NULL, 'POST', 'http://localhost/modelos/SP/Usuario-venta/usuario', '16:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `clave` text NOT NULL,
  `sexo` text NOT NULL,
  `perfil` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `clave`, `sexo`, `perfil`) VALUES
(3, 'pablo', '123456', 'masculino', 'user'),
(4, 'admin', 'admin', 'femenino', 'admin'),
(5, 'juan', 'perez', 'masculino', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
