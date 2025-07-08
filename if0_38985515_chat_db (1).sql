-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql211.infinityfree.com
-- Tiempo de generación: 08-07-2025 a las 16:00:19
-- Versión del servidor: 11.4.7-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_38985515_chat_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$WOZnBgN8sBY6ZqOtpDcW/uCYKIV.afSMjoxC91Wa37bwc2JsVtCjO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `user_id`, `sala_id`, `mensaje`, `created_at`, `imagen`) VALUES
(61, 10, 10, 'me arribo a unidad modelo', '2025-06-03 15:53:14', NULL),
(60, 10, 10, 'vente vicente', '2025-06-03 15:53:09', NULL),
(59, 10, 10, 'uff bebe', '2025-06-03 15:53:07', NULL),
(58, 14, 10, 'alguien pa cochar?, traigo villanos', '2025-06-03 15:53:00', NULL),
(57, 10, 10, 'k ongo perro', '2025-06-03 15:52:33', NULL),
(56, 13, 10, 'Algun travesaÃ±o disponible?', '2025-06-03 15:52:20', NULL),
(55, 10, 10, 'ponte a jalar walter', '2025-06-03 15:52:15', NULL),
(54, 10, 10, 'crusing en san bernabe', '2025-06-03 15:51:46', NULL),
(53, 13, 10, 'OK', '2025-06-03 15:51:45', NULL),
(52, 10, 10, 'sex', '2025-06-03 15:51:39', NULL),
(51, 13, 10, 'quihubo', '2025-06-03 15:48:02', NULL),
(50, 11, 10, 'sex', '2025-06-03 15:44:31', NULL),
(49, 12, 10, 'puto', '2025-06-03 15:44:31', NULL),
(47, 11, 10, 'te puedo hacer el amor', '2025-06-03 15:44:00', NULL),
(48, 12, 10, 'hola wuapo', '2025-06-03 15:44:25', NULL),
(101, 20, 10, 'asdasd', '2025-07-07 02:00:54', NULL),
(102, 20, 10, 'asd', '2025-07-07 02:00:56', NULL),
(103, 21, 21, 'asdsadsaddsdsasdasdsadsadasd', '2025-07-08 17:16:17', NULL),
(100, 20, 10, 'asdadsa', '2025-07-07 02:00:52', NULL),
(62, 14, 10, 'ando bien hot guffy', '2025-06-03 15:53:56', NULL),
(63, 13, 10, 'traigo milqui, quien disponible?', '2025-06-03 16:02:07', NULL),
(64, 13, 10, 'Ya ando en unidad modelo', '2025-06-03 16:02:39', NULL),
(65, 10, 10, 'asdsad', '2025-06-03 16:44:59', NULL),
(66, 10, 10, 'a', '2025-06-03 16:45:10', NULL),
(67, 10, 10, 'a', '2025-06-03 16:45:12', NULL),
(68, 13, 10, 'alguien dijo sexo?', '2025-06-03 16:46:24', NULL),
(69, 14, 10, 'fer consigueme una amiga', '2025-06-03 16:46:35', NULL),
(70, 13, 10, 'a mi tambien', '2025-06-03 16:46:53', NULL),
(71, 14, 10, 'saquen una perrita cachondita', '2025-06-03 16:47:04', NULL),
(72, 14, 10, 'ando bien cachondote', '2025-06-03 16:47:24', NULL),
(73, 13, 10, 'hoy es viernee', '2025-06-03 16:48:08', NULL),
(74, 13, 10, 'de sexooooo', '2025-06-03 16:48:14', NULL),
(75, 12, 10, 'hola', '2025-06-03 17:26:37', NULL),
(76, 13, 10, 'hola', '2025-06-03 17:26:57', NULL),
(77, 10, 11, 'asdsad', '2025-06-08 21:25:38', NULL),
(106, 21, 21, 'as', '2025-07-08 17:16:19', NULL),
(105, 21, 21, 'sd', '2025-07-08 17:16:19', NULL),
(94, 10, 11, 'asd', '2025-06-16 05:10:29', NULL),
(93, 10, 11, 'asdasd', '2025-06-16 05:10:28', NULL),
(114, 21, 21, 'd', '2025-07-08 17:16:21', NULL),
(113, 21, 21, 'dasd', '2025-07-08 17:16:21', NULL),
(112, 21, 21, 'd', '2025-07-08 17:16:21', NULL),
(111, 21, 21, 'das', '2025-07-08 17:16:21', NULL),
(110, 21, 21, 'd', '2025-07-08 17:16:20', NULL),
(109, 21, 21, 'das', '2025-07-08 17:16:20', NULL),
(108, 21, 21, 'sad', '2025-07-08 17:16:20', NULL),
(107, 21, 21, 'sa', '2025-07-08 17:16:19', NULL),
(104, 21, 21, 'asdasd', '2025-07-08 17:16:19', NULL),
(99, 18, 16, 'asdasd', '2025-07-07 01:33:21', NULL),
(115, 21, 21, 'd', '2025-07-08 17:16:21', NULL),
(116, 21, 21, 'd', '2025-07-08 17:16:22', NULL),
(117, 21, 21, 'd', '2025-07-08 17:16:22', NULL),
(118, 21, 21, 'asd', '2025-07-08 17:16:22', NULL),
(119, 21, 21, 'd', '2025-07-08 17:16:22', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `es_privada` tinyint(1) DEFAULT 0,
  `contrasena` varchar(255) DEFAULT NULL,
  `creador_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `nombre`, `es_privada`, `contrasena`, `creador_id`, `created_at`) VALUES
(10, 'noche de sexo', 0, NULL, 11, '2025-06-03 15:43:52'),
(11, 'asdas', 1, '$2y$10$9oyUdpRVMS9f8FSO1uAKY..h4V9E4ubjolQbDdd.E8YDj2W5jToE.', 10, '2025-06-08 21:25:30'),
(14, 'asdsda', 1, '$2y$10$D1o/zNRlLyEev3IQIYhNU.ZtfPEZ1bQ9sM.HigcMA/rH4EUo6YkHO', 10, '2025-06-16 05:09:15'),
(16, 'asdasd', 0, NULL, 18, '2025-07-07 01:33:19'),
(19, 'aa', 1, '$2y$10$GTHohpwWVXsSx.uXpHwVxeH8fpxcRsI4ZrW1ri0/wDjG464ip3Utm', 20, '2025-07-07 02:03:42'),
(18, 'aa', 0, NULL, 20, '2025-07-07 02:03:32'),
(20, 'aaa', 1, '$2y$10$PrbyCdkTVKeYVvSCkHBLauurHfncJpEbS3vaWW7CbrYlLQZNXg00.', 20, '2025-07-07 02:03:48'),
(21, 'adadsdsad', 0, NULL, 21, '2025-07-08 17:16:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto_perfil` varchar(255) DEFAULT NULL,
  `fondo_chat` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `created_at`, `foto_perfil`, `fondo_chat`) VALUES
(19, 'gus', '$2y$10$M9oEY7g25csWD2dCg6kTyepscrMDCr5RYwJUQInlpClDU54jL0bM6', '2025-07-07 01:48:18', NULL, NULL),
(21, 'asd', '$2y$10$VtbHfbOaUTmwDmfQfAHHauZloY0pfD06DKsnJGRn8NhT7QKktaW42', '2025-07-08 17:16:04', NULL, NULL),
(5, 'vicuwu666', '$2y$10$XOvadsixRw9BlrF8fnVhYeatoIyV5DhyoygcM40ArSsjHHYPeIeYm', '2025-05-24 19:45:30', NULL, NULL),
(6, 'Elbrayan 97', '$2y$10$FEdcxotnYYAiE7jb4J7p2.3jwydhnEAVi5oBC615tBY4p4m.XLXK.', '2025-05-24 20:07:34', NULL, NULL),
(15, 'AleMorgan', '$2y$10$Ljyzk5h1rxKwQCssSizdRe33ud7UXecSXFx7Xf6c1VwRWk3Luncgy', '2025-06-10 17:14:23', 'uploads/1749575732_mamame el bicho.jpg', 'fondos_usuarios/68486858e5bac.jpg'),
(20, 'piano', '$2y$10$wjWrZSdi6Rsp1dvojwCcSO2vhJWB8FCv7LVIftSOiX/x9f.C0r9na', '2025-07-07 01:59:16', NULL, NULL),
(9, 'admin', '$2y$10$iZ3A7wmY0irPWB9JUiye4.ZokPuzYY.dl4ySlwYdvNZkBTsKrJz6G', '2025-05-25 00:56:56', NULL, NULL),
(10, 'prueba', '$2y$10$2AFz91KqJjqKNVyQhkqzl.iAQlLU6jsaVhbewO6oSSGPYC4hpyZtG', '2025-05-25 03:36:05', 'uploads/1748145751_1000033169.jpg', 'fondos_usuarios/684fa773210bc.jpg'),
(17, 'prueba2', '$2y$10$/umacD.ZJl9kD4BkWRNBmOGnALz9IOSYx.u15QF6vsG/XOXgs75XG', '2025-06-16 05:11:55', NULL, NULL),
(16, 'borrego', '$2y$10$ozNQoI.bS5fuk3aIWmVJ7ODlCkTLK7/zRYq61tuaz5971DnhOHk8K', '2025-06-10 17:17:00', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sala_id` (`sala_id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
