-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2018 a las 01:20:44
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `segundoparcial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprasusuario`
--

CREATE TABLE `comprasusuario` (
  `id` int(11) NOT NULL,
  `marca` text NOT NULL,
  `modelo` text NOT NULL,
  `precio` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` text NOT NULL,
  `foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comprasusuario`
--

INSERT INTO `comprasusuario` (`id`, `marca`, `modelo`, `precio`, `fecha`, `email`, `foto`) VALUES
(1, 'Xiaomi', 'A5', 5500, '2018-11-12 22:28:38', 'pablo@gmail.com', NULL),
(2, 'Samsung', 'J2', 7000, '2018-11-12 22:29:40', 'pablo@gmail.com', NULL),
(3, 'Samsung', 'J2', 7000, '2018-11-12 22:38:15', 'pablo@gmail.com', NULL),
(4, 'Samsung', 'J2', 7000, '2018-11-12 23:57:48', 'admin@admin.com', NULL),
(5, 'Samsung', 'J5', 8000, '2018-11-12 23:03:22', 'admin@admin.com', NULL),
(6, 'Iphone', 'X', 80000, '2018-11-13 00:06:36', 'mario@gmail.com', '.jpg'),
(7, 'Iphone', 'X', 80000, '2018-11-13 00:08:05', 'mario@gmail.com', 'Iphone_X.jpg'),
(8, 'Iphone', 'X', 80000, '2018-11-13 00:08:30', 'mario@gmail.com', 'Iphone_X.jpg'),
(9, 'Iphone', 'X', 80000, '2018-11-13 00:11:29', 'mario@gmail.com', '_X_Iphone.jpg'),
(10, 'Iphone', 'X', 80000, '2018-11-13 00:11:57', 'mario@gmail.com', 'X_Iphone.jpg'),
(11, 'Iphone', 'X', 80000, '2018-11-13 00:12:08', 'mario@gmail.com', 'X_Iphone.jpg'),
(12, 'Iphone', 'X', 80000, '2018-11-13 00:12:25', 'mario@gmail.com', 'Iphone_X.jpg'),
(13, 'Iphone', 'X', 80000, '2018-11-13 00:13:10', 'mario@gmail.com', 'mario@gmail.com_X.jpg'),
(14, 'Iphone', 'X', 80000, '2018-11-13 00:13:30', 'mario@gmail.com', 'mario@gmail.com_IphoneX.jpg'),
(15, 'Iphone', 'XX', 80000, '2018-11-13 00:17:42', 'mario@gmail.com', 'mario@gmail.com_IphoneXX.jpg'),
(16, 'Iphone', 'XX', 80000, '2018-11-13 00:17:56', 'mario@gmail.com', 'mario@gmail.com_IphoneXX.jpg'),
(17, 'Iphone', 'XX', 80000, '2018-11-13 00:18:09', 'mario@gmail.com', 'mario@gmail.com_IphoneXX.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `email` text,
  `metodo` varchar(50) NOT NULL,
  `ruta` varchar(350) NOT NULL,
  `hora` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `email`, `metodo`, `ruta`, `hora`) VALUES
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:38'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:39'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:40'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:41'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/usuario', '20:41'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/', '20:42'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/', '20:43'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/', '20:44'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/', '20:45'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/Xiaomi', '20:45'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/Xiaomi', '20:46'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/Samsung', '20:47'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:47'),
(0, 'pablo@gmail.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '20:47'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/Samsung', '20:48'),
(0, 'pablo@gmail.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/Samsung', '20:48'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:48'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/Samsung', '20:48'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra/Samsung', '20:49'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:50'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '20:50'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '20:54'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:54'),
(0, 'pablo@gmail.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '20:54'),
(0, 'pablo@gmail.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '20:57'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '20:58'),
(0, 'admin@admin.com', 'GET', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '20:58'),
(0, NULL, 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/login', '21:05'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:06'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:08'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:08'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:11'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:11'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:12'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:12'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:13'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:13'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:17'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:17'),
(0, 'mario@gmail.com', 'POST', 'http://localhost:8080/SP.DiazEcheveste.Pablo/compra', '21:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `clave` text NOT NULL,
  `perfil` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `clave`, `perfil`) VALUES
(1, 'pablo@gmail.com', '123456', 'user'),
(2, 'admin@admin.com', 'admin', 'admin'),
(4, 'mario@gmail.com', '123', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comprasusuario`
--
ALTER TABLE `comprasusuario`
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
-- AUTO_INCREMENT de la tabla `comprasusuario`
--
ALTER TABLE `comprasusuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
