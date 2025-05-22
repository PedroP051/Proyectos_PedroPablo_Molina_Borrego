-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2025 a las 12:44:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto3_entidades`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `ano_publicacion` int(11) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id_libro`, `titulo`, `autor`, `ano_publicacion`, `genero`, `stock`) VALUES
(1, 'El Quijote', 'Miguel de Cervantes', 1605, 'Novela', 40),
(3, 'Harry Potter y la piedra filosofal', 'J.K. Rowling', 1997, 'Fantasía', 58),
(4, 'Los juegos del hambre', 'Suzanne Collins', 2008, 'Ciencia Ficción', 40),
(5, 'El código Da Vinci', 'Dan Brown', 2003, 'Misterio', 60),
(6, 'It', 'Stephen King', 1986, 'Terror', 31),
(7, 'Drácula', 'Bram Stoker', 1897, 'Terror', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `fecha_prestamo` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_usuario`, `id_libro`, `fecha_prestamo`, `fecha_devolucion`) VALUES
(202, 18, 1, '2025-02-06', '2025-02-06'),
(203, 18, 1, '2025-02-06', '2025-02-06'),
(204, 18, 3, '2025-02-06', '2025-02-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `fecha_reserva` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` enum('cliente','bibliotecario') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `correo`, `telefono`, `fecha_registro`, `password`, `tipo_usuario`) VALUES
(1, 'Juan Pérez', 'juan.perez@example.com', '123456789', NULL, '', 'cliente'),
(2, 'Ana Gómez', 'ana.gomez@example.com', '987654321', NULL, '', 'cliente'),
(3, 'Pedrio Pablo', 'pedrop@gmail.com', '', '2025-01-27', '$2y$10$eiufHjtAUodgyGEDA0pVReJ9wRSqZNriM.PCYQ/BIlJTTf8XpCn4.', 'cliente'),
(4, 'Pedro', 'pedroppppp@gmail.com', '', '2025-01-28', '$2y$10$UsllIu7v8hDzJOdifphAxORgAhrVUkwurkTIHvx2nqg07JBcoHxmq', 'cliente'),
(5, 'Piedad', 'piedad@gmail.com', '', '2025-01-28', '$2y$10$cJYT.knetkm9kxy/FkvVbeR.s4vwgBrPfjvqtpngTJsP7f1/g/VYq', 'cliente'),
(6, 'Pedro Pablo', 'pedropablo@gmail.com', '', '2025-02-02', '$2y$10$PyWqgzoPqlTAqjJYWAthWe31xFcAI715AWvvyI7GQT6L7t2SKZVPG', 'cliente'),
(7, 'pedrillo', 'pedrillo@gmail.com', '654778123', '2025-02-02', '$2y$10$tm9uEcJklNkwJgjEeD1r5uHFNbvK0Se8cPSIfPutynbX6G.dcrBwW', 'cliente'),
(10, 'pedri', 'pedropp@gmail.com', '', '2025-02-02', '$2y$10$uB1Mqt6kEOAIE6GHi8I3mO4482iF9tacFfIFJMUbD.PREZpHPTMcS', 'cliente'),
(12, 'Cristina', 'Cristina@gmail.com', '', '2025-02-02', '$2y$10$.Zxnbq/b9tE7ScGVFqc2/ekaTW25CnXmQvGb2jldg5NogpZOq6KMG', 'cliente'),
(14, 'PedroP', 'PedroPablo1234@gmail.com', '689001234', '2025-02-03', '$2y$10$i66jhzORTxaXxFnl93aCDuowqdZoBa652c.13iW6C8B7Hmyv49zPu', 'cliente'),
(15, 'PabloPedro', 'pablopedro@gmail.com', '650997132', '2025-02-03', '$2y$10$7/NVmksraaUwzxDOQJ4/E.WLhvQewgXEI9lAjJgpYNvOsNsBYz1KW', 'bibliotecario'),
(16, 'PedroP', 'pedroppp@gmail.com', '', '2025-02-04', '$2y$10$ZjkAwKtJGK3pKWqu7XBsR.xHONvX33w5nOHk7Kp3ZDn.2ITf8slge', 'bibliotecario'),
(17, 'ADMIN', 'admin@gmail.com', '', '2025-02-04', '$2y$10$jn.0D1K5m0xk3YSSoPdfYed3EbNL9RE6r0qTtNvF7Cb25XYR404Xy', 'bibliotecario'),
(18, 'admin1', 'admin1@gmail.com', '', '2025-02-04', '$2y$10$zzO335IF3ZsASvyDlcgq5.g0Lwk9DISGtpK.m5Ne5o3v2BzX.6o9m', 'bibliotecario'),
(19, 'Piedad', 'piedad@piedad.com', '', '2025-02-05', '$2y$10$Ae9LSoaySgOrYfPFXAdhf.AnIrHMNDNKdunsGNC1/vCq07hhRdBaG', 'cliente'),
(20, 'Piedad', '887@doc.com', 'gyjfyjygfj', '2025-02-05', '$2y$10$GFS8fj.AA1tjagKFe55/b.0chKA2p3y6OXBAg/bZd0DqUfhGO3SSi', 'cliente'),
(21, 'Pedrio Pablo', 'pp@pp.com', '484653453', '2025-02-05', '$2y$10$11qGOhKGKjkDWEOVU0Y4deiP1VnQrvPp7R/mJpsU5cq8i.CapGgN6', 'cliente'),
(22, '789', '78@gt.com', '789645454444444', '2025-02-05', '$2y$10$4FIjILpA24BbsSGs.cWzGObQugCYwUMgaoEXsKLoh21TC.Pi0BzV.', 'bibliotecario'),
(23, 'demo', 'demo@ejemplo.com', '', '2025-02-05', '$2y$10$zaIRfMKDyLnI3PT9qPIOKe.IBNjEopt0zBs5kiFBIedCNEg93mO5m', 'cliente'),
(24, 'adminej', 'admin@ejemplo.com', '', '2025-02-05', '$2y$10$TPViqT.I5oTClQpTIeynUO70dlVS5Eimlm5IBGt8ptVrcOkc12Q1W', 'cliente'),
(25, 'admineje', 'admin1@ejemplo.com', '', '2025-02-05', '$2y$10$1DFvam49Of0DNJJ.y01W6utj2M3ymcHLSMNuGGsxLRjkjRlDbDqmO', 'cliente'),
(26, 'admin12', 'admin2@gmail.com', '', '2025-02-05', '$2y$10$E13eQmaHnfOPXeG44mu.M.N1fRZzGsucriPTI/dtgJ.FwrlXAQwaK', 'bibliotecario'),
(27, 'no', 'no@gmail.com', '', '2025-02-09', '$2y$10$e22Y2bJXybDN.y3oRyKptO3zapj3xIfzQx8q/iRhnDbBjPNETIAdC', 'bibliotecario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `fk_usuario` (`id_usuario`),
  ADD KEY `fk_libro` (`id_libro`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `fk_libro` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
