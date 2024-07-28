-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2024 a las 01:40:02
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
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(10) NOT NULL,
  `nomcategoria` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nomcategoria`) VALUES
(1, 'Papeleria'),
(2, 'Libros'),
(3, 'Lapices'),
(4, 'Oficina'),
(5, 'Arte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(10) NOT NULL,
  `nomcliente` varchar(128) NOT NULL,
  `ruccliente` varchar(11) NOT NULL,
  `dircliente` varchar(128) NOT NULL,
  `telcliente` varchar(9) NOT NULL,
  `emailcliente` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `nomcliente`, `ruccliente`, `dircliente`, `telcliente`, `emailcliente`) VALUES
(1, 'Ana Carmen', '123456000', 'Los Girasoles', '941263184', 'ale_4546@gmail.com'),
(2, 'Alexandra', '12045445455', 'Malecon', '974858478', 'ale454@gmail.com'),
(3, 'Richar', '14654646464', 'Av . Los Incas', '974858478', 'r454@gmail.com'),
(4, 'Liliana', '1152545478', 'Av. Miguel Grau', '984715123', 'lilil@gmail.com'),
(5, 'Karen Miluska', '21545454545', 'Av. Buenos Aires', '978415126', 'kma@gmail.com'),
(6, 'Roy Wilson', '12326346464', 'Av. Estados Unidos', '961548478', 'roy@gmail.com'),
(7, 'Alex Alberto', '10246464642', 'Av. Tupac Amaru', '961548789', 'alex@gmail.com'),
(8, 'Daniel', '10634546464', 'Av. Jesús', '964879475', 'd446@gmail.com'),
(9, 'Jhon Elvis', '11234646466', 'Av. Estados Unidos  478', '947868478', 'j464@gmail.com'),
(10, 'Abraham Adriano', '12106464078', 'Av. Buenos Aires 779', '901203689', 'ab464g@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condicionventa`
--

CREATE TABLE `condicionventa` (
  `idcondicion` int(10) NOT NULL,
  `nomcondicion` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `condicionventa`
--

INSERT INTO `condicionventa` (`idcondicion`, `nomcondicion`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta de crédito'),
(3, 'Transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `iddetalle` int(10) NOT NULL,
  `idfactura` int(10) NOT NULL,
  `idproducto` int(10) NOT NULL,
  `cant` int(11) NOT NULL,
  `cosuni` decimal(10,4) NOT NULL,
  `preuni` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`iddetalle`, `idfactura`, `idproducto`, `cant`, `cosuni`, `preuni`) VALUES
(77, 107, 8, 2, 3.5000, 3.9800),
(78, 107, 10, 1, 5.5000, 6.0000),
(79, 108, 6, 3, 1.5000, 2.0000),
(80, 109, 9, 1, 10.0000, 12.1000),
(81, 110, 10, 2, 5.5000, 6.0000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idfactura` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `idcliente` int(10) NOT NULL,
  `idusuario` int(10) NOT NULL,
  `fechareg` datetime NOT NULL,
  `idcondicion` int(10) NOT NULL,
  `valorventa` decimal(10,4) NOT NULL,
  `igv` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idfactura`, `fecha`, `idcliente`, `idusuario`, `fechareg`, `idcondicion`, `valorventa`, `igv`) VALUES
(107, '2024-07-29', 3, 3, '2024-07-29 00:00:00', 1, 14.7500, 2.2500),
(108, '2024-07-29', 2, 1, '2024-07-30 00:00:00', 1, 5.3100, 0.8100),
(109, '2024-07-30', 4, 1, '2024-07-31 00:00:00', 1, 11.8000, 1.8000),
(110, '2024-07-29', 8, 1, '2024-07-29 00:00:00', 1, 12.9800, 1.9800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(10) NOT NULL,
  `idproveedor` int(10) NOT NULL,
  `nomproducto` varchar(128) NOT NULL,
  `unimed` varchar(15) NOT NULL,
  `stock` int(10) NOT NULL,
  `cosuni` decimal(10,4) NOT NULL,
  `preuni` decimal(10,4) NOT NULL,
  `idcategoria` int(10) NOT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `idproveedor`, `nomproducto`, `unimed`, `stock`, `cosuni`, `preuni`, `idcategoria`, `estado`) VALUES
(6, 1, 'Cartulina Canson', 'unidad', 44, 1.5000, 2.0000, 1, 'A'),
(7, 1, 'Acuarelas', 'unidad', 20, 10.0000, 15.0000, 5, 'A'),
(8, 1, 'Temperas', 'unidad', 16, 3.5000, 3.9800, 5, 'A'),
(9, 3, 'Mezcladores', 'unidad', 18, 10.0000, 12.1000, 5, 'A'),
(10, 5, 'Marcadores Acrilicos', 'unidad', 14, 5.5000, 6.0000, 3, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedor` int(10) NOT NULL,
  `nomproveedor` varchar(128) NOT NULL,
  `rucproveedor` varchar(11) NOT NULL,
  `dirproveedor` varchar(128) NOT NULL,
  `telproveedor` varchar(9) NOT NULL,
  `emailproveedor` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedor`, `nomproveedor`, `rucproveedor`, `dirproveedor`, `telproveedor`, `emailproveedor`) VALUES
(1, 'Navarrete', '10244566787', 'Av. Nicolas de Piérola 1463', '942747589', 'navarrete@nav.pe.com'),
(2, 'Editoriales SAC', '10364646423', 'Av. Lima 45', '947856158', 'edit@edit.com.pe'),
(3, 'OfficeLibreria SL', '103646468', 'Av. La Unión 87', '961450125', 'office@sl.edu.pe'),
(4, 'Papeleria ABC', '12662323230', 'Av. Los Girasoles 789', '901568478', 'papel@abc.edu.pe'),
(5, 'MundoEscolar', '14644664632', 'Av. Jupiter 125', '901547896', 'esc@mundo.edu.pe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(10) NOT NULL,
  `nomusuario` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `apellidos` varchar(64) NOT NULL,
  `nombres` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nomusuario`, `password`, `apellidos`, `nombres`, `email`, `estado`) VALUES
(1, 'Admi', '6cd00776a079723548b5fe2980449e5262e40641', 'Apaza Flores', 'Marivel', 'mapaza415@gmail.com', 'A'),
(3, 'Jorge ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Chavez Ortiz', 'Jorge Luis', 'jluis@gmail.com', 'A'),
(4, 'Yanisa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Miranda Tejada', 'Yanisa ', 'yju@gmail.com', 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `condicionventa`
--
ALTER TABLE `condicionventa`
  ADD PRIMARY KEY (`idcondicion`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `idfactura` (`idfactura`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idfactura`),
  ADD KEY `idcondicion` (`idcondicion`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idcliente` (`idcliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idproveedor` (`idproveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `condicionventa`
--
ALTER TABLE `condicionventa`
  MODIFY `idcondicion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `iddetalle` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idfactura` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`idfactura`) REFERENCES `facturas` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`idcondicion`) REFERENCES `condicionventa` (`idcondicion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
