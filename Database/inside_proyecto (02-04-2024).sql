-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2024 a las 11:21:11
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
-- Estructura de tabla para la tabla `tdetalle_venta`
--

CREATE TABLE `tdetalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad_producto` int(11) DEFAULT NULL,
  `precio_unitario` double DEFAULT NULL,
  `total_x_producto` double GENERATED ALWAYS AS (`cantidad_producto` * `precio_unitario`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Estructura de tabla para la tabla `tofertas`
--

CREATE TABLE `tofertas` (
  `id_oferta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `Inicio_oferta` date DEFAULT NULL,
  `fin_oferta` date DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `precio_descuento` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tofertas`
--

INSERT INTO `tofertas` (`id_oferta`, `id_producto`, `Inicio_oferta`, `fin_oferta`, `descuento`, `precio_descuento`) VALUES
(9, 6, '2024-03-29', '2024-03-31', 0.2, 12000),
(10, 7, '2024-03-30', '2024-03-31', 0.1, 9000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpqrs`
--

CREATE TABLE `tpqrs` (
  `id_pqrs` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `detalle` text NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tpqrs`
--

INSERT INTO `tpqrs` (`id_pqrs`, `email`, `nombre`, `asunto`, `detalle`, `fecha_registro`) VALUES
(2, 'prueba2@gmail.com', 'prueba2', 'Quejas', 'Prueba2', '2024-04-02 04:57:31'),
(3, 'marth-1474@hotmail.com', 'Moises', 'reclamos', 'prueba 3', '2024-04-02 05:50:00'),
(4, 'marth-1474@hotmail.com', 'Moises', 'quejas', 'Lo que sea', '2024-04-02 07:59:45');

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
  `talla` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) NOT NULL,
  `ruta_img` varchar(255) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `Ingreso_producto` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_mod` timestamp NULL DEFAULT NULL,
  `oferta` tinyint(1) DEFAULT NULL,
  `descuento` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tprodu`
--

INSERT INTO `tprodu` (`id_producto`, `nombre_producto`, `precio_producto`, `cantidad`, `descripcion`, `talla`, `categoria`, `ruta_img`, `estado`, `color`, `Ingreso_producto`, `fecha_mod`, `oferta`, `descuento`) VALUES
(2, 'Blusa Mara', 70000, 5, 'La Blusa Mara Blanca es una camisa elegante hecha de seda princesa, con cuello y mangas amplias. El puño delantero se adorna con botones forrados, lo que la hace ideal para anudar y crear un estilo de vanguardia. Disfruta de la calidad y comodidad que sólo la Blusa Mara Blanca te puede ofrecer.', 'S', 'Ropa', 'uploads/imagen_1711613609_8873.webp', 'activo', 'Negro', '2024-03-14 08:20:11', '2024-03-28 14:13:29', 1, 0.2),
(4, 'Blusa Mara Verde Jade', 70000, 6, 'La Blusa Mara es una camisa elegante hecha de seda princesa, con cuello y mangas amplias. El puño delantero se adorna con botones forrados, lo que la hace ideal para anudar y crear un estilo de vanguardia. Disfruta de la calidad y comodidad que sólo la Blusa Mara Blanca te puede ofrecer.', 'S', 'Ropa', 'uploads/imagen_1711614865_1819.webp', 'activo', 'Verde', '2024-03-14 08:20:11', '2024-03-28 14:34:25', 0, NULL),
(5, 'Blusa Mara Morada', 70000, 7, 'La Blusa Mara es una camisa elegante hecha de seda princesa, con cuello y mangas amplias. El puño delantero se adorna con botones forrados, lo que la hace ideal para anudar y crear un estilo de vanguardia. Disfruta de la calidad y comodidad que sólo la Blusa Mara Blanca te puede ofrecer.', 'S', 'Ropa', 'uploads/imagen_1711614941_5278.webp', 'activo', 'Morado', '2024-03-14 08:20:11', '2024-03-28 14:35:41', 0, 0.2),
(6, 'Blusa verde Formal', 15000, 3, 'Es una blusa para ocasiones formales', 'M', 'Blusa', 'uploads/blusa_verde.jpeg', 'activo', 'Verde', '2024-03-14 08:20:11', NULL, 0, 0.2),
(7, 'Blusa ', 10000, 3, 'Una blusa verde para ocasiones especiales', 'M', 'Blusa', 'uploads/imagen_1709885609_3478.png', 'activo', 'Verde', '2024-03-14 08:20:11', NULL, 1, 0.2),
(13, 'Blusa verde', 3000, 3, 'asdas', 'M', 'Jean', 'uploads/imagen_1709964883_3702.png', 'activo', 'Verde', '2024-03-14 08:20:11', NULL, 0, 0.2),
(15, 'Bolso Versace', 30000, 10, 'Bolso azul versace', 'Sin_talla', 'Bolso', 'uploads/imagen_1710233784_6351.jpg', 'activo', 'Azul', '2024-03-14 08:20:11', NULL, 0, 0.2),
(17, 'Bolso', 20000, 5, 'Bolso azul versace', 'Sin_talla', 'Bolso', 'uploads/imagen_1710404599_4484.jpg', 'activo', 'Azul', '2024-03-14 14:23:19', NULL, 0, 0.2),
(18, 'Zapato Paris', 120000, 6, 'Puntera abierta clásica y colores modernos. Altura del tacón: 4.5 pulgadas (aproximadamente, puede variar según el tamaño).', '36', 'Zapato', 'uploads/imagen_1711612289_5858.webp', 'activo', 'Azul', '2024-03-28 13:51:29', NULL, 0, 0.2),
(19, 'Tacones Bautista', 200000, 6, 'Los zapatos de esta colección, hechos de material sintético, se ven coloridos y atrevidos, y están en tendencia, pero también tienen algo más en común: su comodidad.', '37', 'Zapato', 'uploads/imagen_1711612388_6194.webp', 'activo', 'Azul', '2024-03-28 13:53:08', NULL, 0, 0.2),
(20, 'Zapato', 20000, 6, 'Zapatos naranja', '', 'Zapato', 'uploads/imagen_1712049236_2372.webp', 'activo', 'Naranja', '2024-04-02 16:13:56', NULL, NULL, NULL);

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
  `Telefono` varchar(255) NOT NULL,
  `reset_token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`id`, `email`, `password`, `nombre`, `apellido`, `cedula`, `direccion`, `nombre_barrio`, `id_ciudad`, `id_rol`, `Fecha_registro`, `id_gen`, `Telefono`, `reset_token`) VALUES
(8, 'prueba@asdsa.cao', '123', 'asdsa', 'asdas', '12323', 'calletal', '', 1, 1, '2024-02-16 10:00:29', 1, '123232', ''),
(9, 'Kevin@gmail.com', '12345', 'kevin', 'salazar', '123231231', 'vivo en talado', '', 1, 1, '2024-02-16 10:04:33', 1, '3238127372', ''),
(10, 'Kevin@gmail.com', '12345', 'kevin', 'salazar', '123231231', 'vivo en talado', '', 1, 1, '2024-02-16 10:08:46', 1, '3238127372', ''),
(11, 'admin@admin.com', '12345', 'asdasdsad', 'asdadsas', '12323132', 'sdasdsda', '', 2, 1, '2024-02-17 07:36:10', 3, '123232323', ''),
(12, 'admin1@example.com', '2001', 'asdaskjh', 'qwe', '231212', 'loiewsa', '', 4, 1, '2024-02-17 09:15:39', 2, '20000', ''),
(13, 'admin@adminsss.com', '', 'asdasdas', 'asdads', '1234221', 'caaca', '', 2, 1, '2024-02-17 09:20:13', 1, '12321', ''),
(14, 'admin@adminswss.com', '', 'asdasdas', 'asdads', '1234221', 'caaca', '', 2, 1, '2024-02-17 09:20:34', 1, '12321', ''),
(15, 'admin@admn.com', '', 'asdasdas', 'adasdas', '123123123', 'asdasda', '', 2, 1, '2024-02-17 09:21:48', 2, '12321', ''),
(16, 'admin@ad222min.com', '$2y$10$Slk7IC6EgNf79LcVASCmKeXKZBmFyWh6/yeOLueNzVFl/nz5jtN7e', 'asdasd', 'dasdasda', '1231212', 'cassda', '', 1, 1, '2024-02-17 09:23:51', 2, '12323', ''),
(17, 'prueba@1.com', '$2y$10$GU2QJHLbdvLZ.w7CtQQRpO6FsTST2DswmH60tCbb0TZ4DFshU1xeS', 'tal', 'talcual', '12345', 'dadad', '', 1, 1, '2024-02-17 10:03:50', 2, '12312', ''),
(18, 'Gjdiaz@gmial.com', '$2y$10$pxqmBv5UBZs.6J/TI.nrdeazDsq9pGcKZjpuM4qKqqm8fdea2tzai', 'Gilberto', 'Diaz', '120392', 'calle tal', '', 1, 1, '2024-02-24 06:56:22', 1, '30122', ''),
(19, 'loquesea@asdad.com', '$2y$10$/HEyeQKKLyPkHPB3tqyMt.ttauOPJzkmb.Ky90mEsKkC8AOs1agAy', 'Otraprueba', 'tal', '123123111', 'dadas', 'Prueba', 3, 1, '2024-02-24 06:59:46', 3, '1231231', ''),
(22, '123@123', '$2y$10$zAbldcz0EgiP2jb1kRSW7Oy9PbAiRPOBfSlXQ50hAwYy9OTwBz5xa', 'asd', 'asd', '123123111', 'asd', 'asd', 2, 1, '2024-02-24 08:13:09', 1, '123', ''),
(23, '123@12343', '$2y$10$C7/275KAb4Bb/s4SHjjJYuzqbqaCpaxJ9Rclh0BQVrz.34zR3K4yq', 'asdasdas', 'adasda', '123123111', 'asds', 'adas', 2, 1, '2024-02-24 08:24:18', 1, '123', ''),
(24, 'prueba2@jomail.com', '$2y$10$f/6nKXkKoKJENja0FcY99un96HPh0m56bnFpxCo40mm/Gao2bVgpG', 'modperfil2', 'siefecito       ', '12332', 'calle talsss', 'sssss', 2, 1, '2024-02-29 03:57:32', 2, '222222222322222', ''),
(34, 'novoasarabialuismanuel0@gmail.com', '$2y$10$lzCYxNdnFynf./YmtM62.ufpZYLFoHDl8GSHP.2w12RHO6L5ilzky', 'Luis Manuel', 'Novoa', '31222212', 'caa', 'carive', 1, 1, '2024-02-29 05:54:34', 1, '3123123132', ''),
(37, 'gjdiaz10@soy.sena.edu.co', '$2y$10$xgShB4XevBK8wWLK6uDSU.5xCf9jEco06uxeMISshJbqPWyr2nzTi', 'Gilberto', 'Diaz', '31231', 'Calle tal', 'asd', 1, 1, '2024-02-29 06:23:18', 1, '1312', ''),
(38, 'marth-1474@hotmail.com', '$2y$10$jsctPypAF4OMIKblcsviseKGAopprmCRWo315/3gxLSnQGAPCTsMS', 'Moises', 'Martinez', '1029272', 'calle tal', 'simon', 1, 1, '2024-03-12 05:13:35', 1, '301293728', ''),
(39, 'admin@insidestore.com', '$2a$12$z99Zeu/WtPXcMgdRXxbSyunbYP5SqTz83343vPGerlVcQ7PBP4Odq', 'Administrador', 'Administrador', '99999999999', 'aaaaaaaaa', 'aaaaaaaaaaaaa', 1, 2, '2024-03-12 08:16:57', 1, '30111111', ''),
(40, 'gjdiaz.2020@gmail.com', '$2y$10$48sdCKIc99wCrkS8sc3w1.95GoWDHQ7nslzzjzuSWo6TUx8VYhfBW', 'Gilberto', 'Diaz ', '1220327237', 'calle 51#11a', 'fontivon', 3, 1, '2024-04-02 11:05:56', 1, '3002029', 'ae92522820d6460833141556484646c27216ee65aff1be107492bbb96dd76723');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tventas`
--

CREATE TABLE `tventas` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_venta` double NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tciudades`
--
ALTER TABLE `tciudades`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `tdetalle_venta`
--
ALTER TABLE `tdetalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `tgeneros`
--
ALTER TABLE `tgeneros`
  ADD PRIMARY KEY (`id_genero`),
  ADD UNIQUE KEY `fk_id_gene` (`id_genero`) USING BTREE;

--
-- Indices de la tabla `tofertas`
--
ALTER TABLE `tofertas`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `fk_id_producto_oferta` (`id_producto`);

--
-- Indices de la tabla `tpqrs`
--
ALTER TABLE `tpqrs`
  ADD PRIMARY KEY (`id_pqrs`);

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
-- Indices de la tabla `tventas`
--
ALTER TABLE `tventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tciudades`
--
ALTER TABLE `tciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tdetalle_venta`
--
ALTER TABLE `tdetalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tgeneros`
--
ALTER TABLE `tgeneros`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tofertas`
--
ALTER TABLE `tofertas`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tpqrs`
--
ALTER TABLE `tpqrs`
  MODIFY `id_pqrs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tprodu`
--
ALTER TABLE `tprodu`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `troles`
--
ALTER TABLE `troles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `tventas`
--
ALTER TABLE `tventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tdetalle_venta`
--
ALTER TABLE `tdetalle_venta`
  ADD CONSTRAINT `tdetalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `tventas` (`id_venta`),
  ADD CONSTRAINT `tdetalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tprodu` (`id_producto`);

--
-- Filtros para la tabla `tofertas`
--
ALTER TABLE `tofertas`
  ADD CONSTRAINT `fk_id_oferta` FOREIGN KEY (`id_producto`) REFERENCES `tprodu` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_producto_oferta` FOREIGN KEY (`id_producto`) REFERENCES `tprodu` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD CONSTRAINT `fk_id_genero` FOREIGN KEY (`id_gen`) REFERENCES `tgeneros` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_ciudad` FOREIGN KEY (`id_ciudad`) REFERENCES `tciudades` (`id_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_rol` FOREIGN KEY (`id_rol`) REFERENCES `troles` (`id_roles`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tventas`
--
ALTER TABLE `tventas`
  ADD CONSTRAINT `tventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tusuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
