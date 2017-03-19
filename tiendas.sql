-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2017 a las 01:56:06
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `hora_conexion` datetime NOT NULL,
  `hora_desconexion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `hora_conexion`, `hora_desconexion`) VALUES
(6, 2, '2017-01-26 23:25:47', '2017-01-27 00:04:05'),
(7, 2, '2017-01-27 00:04:10', '2017-01-27 00:04:26'),
(8, 2, '2017-01-27 19:39:51', '2017-01-27 20:00:59'),
(9, 2, '2017-01-27 21:09:21', '2017-01-27 21:47:56'),
(10, 2, '2017-01-27 21:48:00', '2017-01-27 21:54:16'),
(11, 2, '2017-01-27 21:54:21', '2017-01-27 22:05:49'),
(12, 2, '2017-01-27 22:05:55', '2017-01-27 23:46:33'),
(13, 2, '2017-01-28 13:48:04', '2017-01-28 22:02:30'),
(14, 4, '2017-01-28 22:02:34', '2017-01-28 23:17:02'),
(15, 2, '2017-01-28 23:17:06', '2017-01-28 23:18:51'),
(16, 4, '2017-01-28 23:18:56', '2017-01-28 23:29:34'),
(17, 2, '2017-01-29 06:53:11', '2017-01-29 07:12:41'),
(18, 2, '2017-01-29 13:09:08', '2017-01-29 13:20:18'),
(19, 4, '2017-01-29 13:20:27', '2017-01-29 13:57:16'),
(20, 2, '2017-01-29 13:57:28', '2017-01-29 14:12:37'),
(21, 2, '2017-01-29 22:12:50', '2017-01-29 22:16:11'),
(22, 2, '2017-01-29 22:16:14', '2017-01-29 22:27:44'),
(23, 2, '2017-01-29 22:31:27', '2017-01-29 23:55:27'),
(24, 2, '2017-01-30 10:56:40', '2017-01-30 10:56:45'),
(25, 2, '2017-01-30 11:56:32', '2017-01-30 12:01:23'),
(26, 2, '2017-01-30 20:51:18', '2017-01-30 21:15:49'),
(27, 2, '2017-01-31 19:40:28', '2017-01-31 19:40:35'),
(28, 2, '2017-01-31 19:55:10', '2017-01-31 22:46:34'),
(29, 2, '2017-02-03 09:43:11', '2017-02-03 10:41:50'),
(30, 2, '2017-02-03 19:04:30', '2017-02-03 20:00:18'),
(31, 2, '2017-02-04 23:45:12', '2017-02-04 23:47:54'),
(32, 2, '2017-02-04 23:49:39', '2017-02-04 23:56:30'),
(33, 2, '2017-02-04 23:56:53', '2017-02-05 00:36:50'),
(34, 2, '2017-02-05 00:36:58', '2017-02-05 00:37:12'),
(35, 2, '2017-02-07 18:45:30', '2017-02-07 18:55:47'),
(36, 2, '2017-02-07 18:55:49', '2017-02-07 19:11:07'),
(37, 2, '2017-02-07 19:34:49', '2017-02-07 20:07:29'),
(38, 2, '2017-02-27 16:53:37', '2017-02-27 16:54:59'),
(39, 2, '2017-02-28 15:44:43', '2017-02-28 16:24:24'),
(40, 2, '2017-03-18 11:03:13', '2017-03-18 12:20:45'),
(41, 2, '2017-03-18 19:39:34', '2017-03-18 20:47:20'),
(42, 2, '2017-03-18 20:47:44', '2017-03-18 20:55:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `monto_entrante` int(11) NOT NULL,
  `monto_salida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `articulo`, `cantidad`, `monto_entrante`, `monto_salida`) VALUES
(1, 9, 1, 4550, 0),
(2, 9, 2, 9100, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

CREATE TABLE `caja_chica` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja_chica`
--

INSERT INTO `caja_chica` (`id`, `nombre`, `monto`) VALUES
(1, 'Caja chica del cafe', 6000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica_operaciones`
--

CREATE TABLE `caja_chica_operaciones` (
  `id` int(11) NOT NULL,
  `id_caja_chica` int(11) NOT NULL,
  `descripcion` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `monto_entrante` int(11) NOT NULL,
  `monto_salida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_compra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `id_venta`, `nombre`, `cedula`, `telefono`, `direccion`, `fecha_compra`) VALUES
(1, 1, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 'ciudad jardin', '2017-01-29'),
(2, 2, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 'ciudad jardin', '2017-01-29'),
(3, 3, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 'ciudad jardin', '2017-02-01'),
(4, 4, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 'ciudad jardin', '2017-02-01'),
(5, 5, 'Domingo Antonio Guedez Crespo', 3886100, '04144636869', 'Ciudad Jardín', '2017-02-03'),
(6, 6, '4825451', 4825451, '04161080980', 'Ciudad Jardin', '2017-02-08'),
(7, 7, '4825451', 4825451, '04161080980', 'Ciudad Jardin', '2017-02-08'),
(8, 8, 'carmen electra', 42551, '04144636869', 'prados', '2017-02-08'),
(9, 9, 'Enrique Gil', 323423, '0414567435', 'Corinsa', '2017-02-08'),
(10, 10, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 'ciudad jardin', '2017-02-08'),
(11, 11, 'Domingo Antonio Guedez Crespo', 3886100, '04144636869', 'Ciudad Jardín', '2017-02-08'),
(12, 12, 'Domingo Antonio Guedez Crespo', 3886100, '04144636869', 'Ciudad Jardín', '2017-02-08'),
(13, 13, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 'ciudad jardin', '2017-02-08'),
(14, 14, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 'ciudad jardin', '2017-03-18'),
(15, 15, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 'ciudad jardin', '2017-03-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `codigo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_compra` date NOT NULL,
  `tipo` int(11) NOT NULL,
  `monto_pagado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `codigo`, `fecha_compra`, `tipo`, `monto_pagado`) VALUES
(1, 'fac-9387211', '2017-01-26', 0, 15120),
(2, 'fac-6386064', '2017-01-25', 0, 13680),
(3, 'fac-5106522', '2017-01-29', 0, 191520),
(4, 'fac-9064048', '2017-01-29', 0, 171000),
(5, 'fac-6433929', '2017-01-30', 0, 34220),
(6, 'fac-3794359', '2017-02-01', 0, 10260),
(7, 'fac-5385783', '2017-03-19', 0, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_detalle`
--

CREATE TABLE `compras_detalle` (
  `id_compra` int(11) NOT NULL,
  `nombre_articulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `proveedor` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras_detalle`
--

INSERT INTO `compras_detalle` (`id_compra`, `nombre_articulo`, `marca`, `costo`, `proveedor`, `cantidad`, `total`, `sub_total`, `iva`) VALUES
(1, 'Sweeter nike Sb', 'Nike', '2000.00', 'Distribuidora los machaqueros de Ciudad Jardín', 3, '6000.00', '6000.00', '0.00'),
(1, 'Air max 95', 'Nike', '4000.00', 'Distribuidora los machaqueros de Ciudad Jardín', 2, '9120.00', '8000.00', '1120.00'),
(2, 'Air max 95', 'Nike', '4000.00', 'Distribuidora los machaqueros de Ciudad Jardín', 3, '13680.00', '12000.00', '1680.00'),
(3, 'Air max 95', 'Nike', '4000.00', 'Distribuidora los machaqueros de Ciudad Jardín', 42, '191520.00', '168000.00', '23520.00'),
(4, 'Gorras planas nike sb', 'NIke', '1500.00', 'Distribuidora los machaqueros de Ciudad Jardín', 100, '171000.00', '150000.00', '21000.00'),
(5, 'Air max 95', 'Nike', '4000.00', 'Distribuidora los machaqueros de Ciudad Jardín', 2, '9120.00', '8000.00', '1120.00'),
(5, 'Sweeter nike Sb', 'Nike', '2000.00', 'Distribuidora los machaqueros de Ciudad Jardín', 4, '8000.00', '8000.00', '0.00'),
(5, 'Gorras planas nike sb', 'NIke', '1500.00', 'Distribuidora los machaqueros de Ciudad Jardín', 10, '17100.00', '15000.00', '2100.00'),
(6, 'zapatos adidas', 'adidas', '3000.00', 'Adidas Inc.', 3, '10260.00', '9000.00', '1260.00'),
(7, 'Sweeter nike Sb', 'Nike', '2000.00', 'Distribuidora los machaqueros de Ciudad Jardín', 1, '2280.00', '2000.00', '280.00'),
(7, 'Air max 95', 'Nike', '4000.00', 'Distribuidora los machaqueros de Ciudad Jardín', 3, '13680.00', '12000.00', '1680.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_empresa`
--

CREATE TABLE `configuracion_empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fax` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion_empresa`
--

INSERT INTO `configuracion_empresa` (`id`, `nombre`, `direccion`, `telefono`, `email`, `rif`, `fax`, `logo`) VALUES
(6, 'Tienda de ropa "Los Pingüinos de Cagua" para que te evites el frio!', 'C.C el paseo frente a la calle freilan correa cruce con la iglesia de Cagua', '0244765489', 'alvarovisiont@gmail.com', '21312312', 'fax_nuevo', 'homero.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_moneda`
--

CREATE TABLE `configuracion_moneda` (
  `id` int(11) NOT NULL,
  `siglas` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `iva` int(11) NOT NULL,
  `retencion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion_moneda`
--

INSERT INTO `configuracion_moneda` (`id`, `siglas`, `iva`, `retencion`) VALUES
(2, 'BSF', 14, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `nombre`, `tipo`, `status`) VALUES
(1, 'Descuento para juguetes de niños y artículos de cocina ', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `sueldo` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `cedula`, `telefono`, `sueldo`) VALUES
(6, 'Alvaro Guedez', 21202500, '04124362753', '94000.00'),
(8, 'Domingo Guedez', 3886100, '04144636869', '150000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--

CREATE TABLE `encargado` (
  `id_encargado` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre_encargado` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono_encargado` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `correo_encargado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `encargado`
--

INSERT INTO `encargado` (`id_encargado`, `id_empresa`, `cedula`, `nombre_encargado`, `telefono_encargado`, `correo_encargado`) VALUES
(1, 1, 24420507, 'Alvaro Antonio Guedez Crespo', '04124362753', 'alvarovisiont@g');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `grupo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `precio_proveedor` decimal(12,2) NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `fecha_agregado` date NOT NULL,
  `observacion` varchar(1000) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_proveedor`, `nombre`, `marca`, `grupo`, `cantidad`, `precio`, `precio_proveedor`, `iva`, `fecha_agregado`, `observacion`) VALUES
(9, 1, 'Air max 95', 'Nike', 'zapatos', 771, '4500.00', '4000.00', 14, '2017-01-02', ''),
(10, 1, 'Sweeter nike Sb', 'Nike', 'sweter', 778171, '2500.10', '2000.00', 14, '2017-01-03', ''),
(11, 1, 'Gorras planas nike sb', 'NIke', 'gorras', 892, '1900.00', '1500.00', 14, '2017-01-03', ''),
(12, 2, 'zapatos adidas', 'adidas', 'zapatos', 93, '5000.00', '3000.00', 14, '2017-01-31', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pagina_web` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fax` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `telefono`, `email`, `direccion`, `rif`, `pagina_web`, `fax`) VALUES
(1, 'Distribuidora los machaqueros de Ciudad Jardín', '0414569874', 'la_panaderia@gmail.com', 'urbanización el huete, calle 5 conexión con la carpiera ', '', '', ''),
(2, 'Adidas Inc.', '04124362753', '', 'Pdvsa cruzando la esquina sucursal cualquiera', '9123187qwe', '', 'iaydgsiuagsduasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `nivel`) VALUES
(2, 'admin', 'admin123', 1),
(4, 'argenis', '123', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `factura` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_venta` date NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `vuelto` decimal(10,2) NOT NULL,
  `tipo_venta` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `factura`, `fecha_venta`, `monto_pagado`, `vuelto`, `tipo_venta`) VALUES
(1, 'fac-10452071', '2017-01-29', '24000.00', '6240.00', 'debito'),
(2, 'fac-38345399', '2017-01-29', '21000.00', '610.00', 'credito'),
(3, 'fac-95898848', '2017-02-01', '21000.00', '944.00', 'efectivo'),
(4, 'fac-53096122', '2017-02-01', '9800.00', '4.00', 'credito'),
(5, 'fac-63480215', '2017-02-03', '5800.00', '100.00', 'efectivo'),
(6, 'fac-68008571', '2017-02-08', '27500.00', '140.00', 'efectivo'),
(7, 'fac-60392145', '2017-02-08', '12000.00', '66.00', 'debito'),
(8, 'fac-81511249', '2017-02-08', '27000.00', '187.00', 'debito'),
(9, 'fac-12340920', '2017-02-08', '17000.00', '577.00', 'credito'),
(10, 'fac-1895797', '2017-02-08', '13000.00', '574.00', 'efectivo'),
(11, 'fac-48518943', '2017-02-08', '6000.00', '300.00', 'efectivo'),
(12, 'fac-91635969', '2017-02-08', '11000.00', '945.00', 'debito'),
(13, 'fac-96216199', '2017-02-08', '5800.00', '100.00', 'efectivo'),
(14, 'fac-39044182', '2017-03-18', '19000.00', '189.66', 'efectivo'),
(15, 'fac-36627432', '2017-03-19', '11000.00', '740.00', 'efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id_venta` int(11) NOT NULL,
  `nombre_articulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id_venta`, `nombre_articulo`, `marca`, `precio`, `cantidad`, `sub_total`, `iva`, `total`) VALUES
(1, 'Air max 95', 'Nike', 4500, 2, 9000, 1260, 10260),
(1, 'Sweeter nike Sb', 'Nike', 2500, 3, 7500, 0, 7500),
(2, 'Air max 95', 'Nike', 4500, 3, 13500, 1890, 15390),
(2, 'Sweeter nike Sb', 'Nike', 2500, 2, 5000, 0, 5000),
(3, 'Air max 95', 'Nike', 4500, 3, 13500, 1890, 15390),
(3, 'Gorras planas nike sb', 'NIke', 1900, 1, 1900, 266, 2166),
(3, 'Sweeter nike Sb', 'Nike', 2500, 1, 2500, 0, 2500),
(4, 'Air max 95', 'Nike', 4500, 1, 4500, 630, 5130),
(4, 'Sweeter nike Sb', 'Nike', 2500, 1, 2500, 0, 2500),
(4, 'Gorras planas nike sb', 'NIke', 1900, 1, 1900, 266, 2166),
(5, 'zapatos adidas', 'adidas', 5000, 1, 5000, 700, 5700),
(6, 'Air max 95', 'Nike', 4500, 2, 9000, 1260, 10260),
(6, 'zapatos adidas', 'adidas', 5000, 3, 15000, 2100, 17100),
(7, 'zapatos adidas', 'adidas', 5000, 1, 5000, 700, 5700),
(7, 'Sweeter nike Sb', 'Nike', 2500, 3, 7500, 0, 7500),
(8, 'Air max 95', 'Nike', 4500, 2, 9000, 1260, 10260),
(8, 'zapatos adidas', 'adidas', 5000, 3, 15000, 2100, 17100),
(9, 'Air max 95', 'Nike', 4500, 2, 9000, 1260, 10260),
(9, 'Gorras planas nike sb', 'NIke', 1900, 3, 5700, 798, 6498),
(10, 'Air max 95', 'Nike', 4500, 2, 9000, 1260, 10260),
(10, 'Gorras planas nike sb', 'NIke', 1900, 1, 1900, 266, 2166),
(11, 'zapatos adidas', 'adidas', 5000, 1, 5000, 700, 5700),
(12, 'Air max 95', 'Nike', 4500, 2, 9000, 1260, 10260),
(13, 'zapatos adidas', 'adidas', 5000, 1, 5000, 700, 5700),
(14, 'Air max 95', 'Nike', 4500, 2, 9000, 1260, 10260),
(14, 'Sweeter nike Sb', 'Nike', 2500, 3, 7500, 1050, 8550),
(15, 'Air max 95', 'Nike', 4500, 2, 9000, 1260, 10260);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_chica_operaciones`
--
ALTER TABLE `caja_chica_operaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion_empresa`
--
ALTER TABLE `configuracion_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion_moneda`
--
ALTER TABLE `configuracion_moneda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD PRIMARY KEY (`id_encargado`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `caja_chica_operaciones`
--
ALTER TABLE `caja_chica_operaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `configuracion_empresa`
--
ALTER TABLE `configuracion_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `configuracion_moneda`
--
ALTER TABLE `configuracion_moneda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `encargado`
--
ALTER TABLE `encargado`
  MODIFY `id_encargado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
