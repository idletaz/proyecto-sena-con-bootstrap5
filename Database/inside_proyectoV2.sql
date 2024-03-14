-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2024 a las 10:11:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inside_proyecto`
--
CREATE DATABASE IF NOT EXISTS `inside_proyecto` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `inside_proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tciudades`
--

CREATE TABLE `tciudades` (
  `id_ciudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tciudades`
--

INSERT INTO `tciudades` (`id_ciudad`, `nombre_ciudad`) VALUES
(1, 'Barranquilla'),
(2, 'Medellin'),
(3, 'Bogota'),
(4, 'Valledupar'),
(5, 'Monteria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgeneros`
--

CREATE TABLE `tgeneros` (
  `id_genero` int(11) NOT NULL,
  `Nombre_genero` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tgeneros`
--

INSERT INTO `tgeneros` (`id_genero`, `Nombre_genero`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tprodu`
--

CREATE TABLE `tprodu` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `precio_producto` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `talla` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `ruta_img` varchar(255) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `Ingreso_producto` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_mod` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tprodu`
--

INSERT INTO `tprodu` (`id_producto`, `nombre_producto`, `precio_producto`, `cantidad`, `descripcion`, `talla`, `categoria`, `ruta_img`, `estado`, `color`, `Ingreso_producto`, `fecha_mod`) VALUES
(2, 'Bolso Versace', 6000, 5, 'Es un bolso azul de la marca Versaceeeee', 'Sin_talla', 'Bolso', 'uploads/imagen_1710404823_9982.jpg', 'activo', 'Azul', '2024-03-14 08:20:11', '2024-03-14 14:27:03'),
(4, 'Blusa Negra', 30000, 6, 'Es una blusa de color negra', 'S', 'Blusa', 'uploads/blusa_negra.jpeg', 'activo', 'Negro', '2024-03-14 08:20:11', NULL),
(5, 'Blusa Verde', 30000, 10, 'Es una blusa verde ', 'M', 'Blusa', 'uploads/blusa_verde.jpeg', 'activo', 'Verde', '2024-03-14 08:20:11', NULL),
(6, 'Blusa verde Formal', 15000, 3, 'Es una blusa para ocasiones formales', 'M', 'Blusa', 'uploads/blusa_verde.jpeg', 'activo', 'Verde', '2024-03-14 08:20:11', NULL),
(7, 'Blusa ', 10000, 3, 'Una blusa verde para ocasiones especiales', 'M', 'Blusa', 'uploads/imagen_1709885609_3478.png', 'activo', 'Verde', '2024-03-14 08:20:11', NULL),
(12, 'Bolso DGC', 10000, 2, 'Bolso Dolce y gabbanee', 'Sin_talla', 'Bolso', 'uploads/imagen_1709889991_7096.jpg', 'activo', 'Rojo', '2024-03-14 08:20:11', NULL),
(13, 'Blusa verde', 3000, 3, 'asdas', 'M', 'Jean', 'uploads/imagen_1709964883_3702.png', 'activo', 'Verde', '2024-03-14 08:20:11', NULL),
(14, 'Bolsonegro Versace', 122222, 33, 'asdasd', 'Sin_talla', 'Blusa', 'uploads/imagen_1709964910_6515.jpg', 'activo', 'Negro', '2024-03-14 08:20:11', NULL),
(15, 'Bolso Versace', 30000, 10, 'Bolso azul versace', 'Sin_talla', 'Bolso', 'uploads/imagen_1710233784_6351.jpg', 'activo', 'Azul', '2024-03-14 08:20:11', NULL),
(17, 'Bolso', 20000, 5, 'Bolso azul versace', 'Sin_talla', 'Bolso', 'uploads/imagen_1710404599_4484.jpg', 'activo', 'Azul', '2024-03-14 14:23:19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `troles`
--

CREATE TABLE `troles` (
  `id_roles` int(11) NOT NULL,
  `Nombre_rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `troles`
--

INSERT INTO `troles` (`id_roles`, `Nombre_rol`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE `tusuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `nombre_barrio` varchar(255) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `Fecha_registro` datetime NOT NULL,
  `id_gen` int(11) NOT NULL,
  `Telefono` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`id`, `email`, `password`, `nombre`, `apellido`, `cedula`, `direccion`, `nombre_barrio`, `id_ciudad`, `id_rol`, `Fecha_registro`, `id_gen`, `Telefono`) VALUES
(8, 'prueba@asdsa.cao', '123', 'asdsa', 'asdas', '12323', 'calletal', '', 1, 1, '2024-02-16 10:00:29', 1, '123232'),
(9, 'Kevin@gmail.com', '12345', 'kevin', 'salazar', '123231231', 'vivo en talado', '', 1, 1, '2024-02-16 10:04:33', 1, '3238127372'),
(10, 'Kevin@gmail.com', '12345', 'kevin', 'salazar', '123231231', 'vivo en talado', '', 1, 1, '2024-02-16 10:08:46', 1, '3238127372'),
(11, 'admin@admin.com', '12345', 'asdasdsad', 'asdadsas', '12323132', 'sdasdsda', '', 2, 1, '2024-02-17 07:36:10', 3, '123232323'),
(12, 'admin1@example.com', '2001', 'asdaskjh', 'qwe', '231212', 'loiewsa', '', 4, 1, '2024-02-17 09:15:39', 2, '20000'),
(13, 'admin@adminsss.com', '', 'asdasdas', 'asdads', '1234221', 'caaca', '', 2, 1, '2024-02-17 09:20:13', 1, '12321'),
(14, 'admin@adminswss.com', '', 'asdasdas', 'asdads', '1234221', 'caaca', '', 2, 1, '2024-02-17 09:20:34', 1, '12321'),
(15, 'admin@admn.com', '', 'asdasdas', 'adasdas', '123123123', 'asdasda', '', 2, 1, '2024-02-17 09:21:48', 2, '12321'),
(16, 'admin@ad222min.com', '$2y$10$Slk7IC6EgNf79LcVASCmKeXKZBmFyWh6/yeOLueNzVFl/nz5jtN7e', 'asdasd', 'dasdasda', '1231212', 'cassda', '', 1, 1, '2024-02-17 09:23:51', 2, '12323'),
(17, 'prueba@1.com', '$2y$10$GU2QJHLbdvLZ.w7CtQQRpO6FsTST2DswmH60tCbb0TZ4DFshU1xeS', 'tal', 'talcual', '12345', 'dadad', '', 1, 1, '2024-02-17 10:03:50', 2, '12312'),
(18, 'Gjdiaz@gmial.com', '$2y$10$pxqmBv5UBZs.6J/TI.nrdeazDsq9pGcKZjpuM4qKqqm8fdea2tzai', 'Gilberto', 'Diaz', '120392', 'calle tal', '', 1, 1, '2024-02-24 06:56:22', 1, '30122'),
(19, 'loquesea@asdad.com', '$2y$10$/HEyeQKKLyPkHPB3tqyMt.ttauOPJzkmb.Ky90mEsKkC8AOs1agAy', 'Otraprueba', 'tal', '123123111', 'dadas', 'Prueba', 3, 1, '2024-02-24 06:59:46', 3, '1231231'),
(22, '123@123', '$2y$10$zAbldcz0EgiP2jb1kRSW7Oy9PbAiRPOBfSlXQ50hAwYy9OTwBz5xa', 'asd', 'asd', '123123111', 'asd', 'asd', 2, 1, '2024-02-24 08:13:09', 1, '123'),
(23, '123@12343', '$2y$10$C7/275KAb4Bb/s4SHjjJYuzqbqaCpaxJ9Rclh0BQVrz.34zR3K4yq', 'asdasdas', 'adasda', '123123111', 'asds', 'adas', 2, 1, '2024-02-24 08:24:18', 1, '123'),
(24, 'prueba2@jomail.com', '$2y$10$f/6nKXkKoKJENja0FcY99un96HPh0m56bnFpxCo40mm/Gao2bVgpG', 'Prueba', 'numero dos', '12332', 'adas', 'sdads', 3, 1, '2024-02-29 03:57:32', 3, '12312'),
(34, 'novoasarabialuismanuel0@gmail.com', '$2y$10$lzCYxNdnFynf./YmtM62.ufpZYLFoHDl8GSHP.2w12RHO6L5ilzky', 'Luis Manuel', 'Novoa', '31222212', 'caa', 'carive', 1, 1, '2024-02-29 05:54:34', 1, '3123123132'),
(36, 'gjdiaz.2020@gmail.com', '$2y$10$pwqfMq1YwiXH6tHEzIXAzeoYjRRm983z9gh.mv.5X.IXc9SaXHRla', 'Gilberto', 'Diaz', '12312', 'asd', 'adas', 1, 1, '2024-02-29 06:17:36', 1, '1231231'),
(37, 'gjdiaz10@soy.sena.edu.co', '$2y$10$xgShB4XevBK8wWLK6uDSU.5xCf9jEco06uxeMISshJbqPWyr2nzTi', 'Gilberto', 'Diaz', '31231', 'Calle tal', 'asd', 1, 1, '2024-02-29 06:23:18', 1, '1312'),
(38, 'marth-1474@hotmail.com', '$2y$10$jsctPypAF4OMIKblcsviseKGAopprmCRWo315/3gxLSnQGAPCTsMS', 'Moises', 'Martinez', '1029272', 'calle tal', 'simon', 1, 1, '2024-03-12 05:13:35', 1, '301293728'),
(39, 'admin@insidestore.com', '$2a$12$z99Zeu/WtPXcMgdRXxbSyunbYP5SqTz83343vPGerlVcQ7PBP4Odq', 'Administrador', 'Administrador', '99999999999', 'aaaaaaaaa', 'aaaaaaaaaaaaa', 1, 2, '2024-03-12 08:16:57', 1, '30111111');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tciudades`
--
ALTER TABLE `tciudades`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `tgeneros`
--
ALTER TABLE `tgeneros`
  ADD PRIMARY KEY (`id_genero`),
  ADD UNIQUE KEY `fk_id_gene` (`id_genero`) USING BTREE;

--
-- Indices de la tabla `tprodu`
--
ALTER TABLE `tprodu`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `troles`
--
ALTER TABLE `troles`
  ADD PRIMARY KEY (`id_roles`),
  ADD UNIQUE KEY `fk_id_user` (`id_roles`);

--
-- Indices de la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD PRIMARY KEY (`id`,`cedula`),
  ADD KEY `id_ciudad` (`id_ciudad`),
  ADD KEY `fk_id_genero` (`id_gen`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tciudades`
--
ALTER TABLE `tciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tgeneros`
--
ALTER TABLE `tgeneros`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tprodu`
--
ALTER TABLE `tprodu`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `troles`
--
ALTER TABLE `troles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD CONSTRAINT `fk_id_genero` FOREIGN KEY (`id_gen`) REFERENCES `tgeneros` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_ciudad` FOREIGN KEY (`id_ciudad`) REFERENCES `tciudades` (`id_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_rol` FOREIGN KEY (`id_rol`) REFERENCES `troles` (`id_roles`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
