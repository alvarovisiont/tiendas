-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: tiendas
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `monto_entrante` int(11) NOT NULL,
  `monto_salida` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
INSERT INTO `caja` VALUES (1,9,1,4550,0),(2,9,2,9100,0);
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja_chica`
--

DROP TABLE IF EXISTS `caja_chica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caja_chica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `monto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja_chica`
--

LOCK TABLES `caja_chica` WRITE;
/*!40000 ALTER TABLE `caja_chica` DISABLE KEYS */;
INSERT INTO `caja_chica` VALUES (1,'Caja chica del cafe',6000);
/*!40000 ALTER TABLE `caja_chica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja_chica_operaciones`
--

DROP TABLE IF EXISTS `caja_chica_operaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caja_chica_operaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_caja_chica` int(11) NOT NULL,
  `descripcion` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `monto_entrante` int(11) NOT NULL,
  `monto_salida` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja_chica_operaciones`
--

LOCK TABLES `caja_chica_operaciones` WRITE;
/*!40000 ALTER TABLE `caja_chica_operaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja_chica_operaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_compra` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (2,0,'Alvaro',21202500,'04124362753','Ciudad Jardín calle 3-9','2017-01-01'),(3,0,'Argenis',24420507,'04262350800','','2017-02-15'),(4,1,'Domingo Guedez',3886100,'04144636869','ciudad jardin','2017-01-12'),(5,3,'Domingo Guedez',3886100,'04144636869','ciudad jardin','2017-01-12'),(6,4,'Norma Crespo',4825451,'04262350800','ciudad jardin','2017-01-12'),(7,5,'Domingo Guedez',3886100,'04144636869','ciudad jardin','2017-01-12'),(8,6,'Norma Crespo',4825451,'04262350800','ciudad jardin','2017-01-12'),(9,7,'Domingo Guedez',3886100,'04144636869','ciudad jardin','2017-01-12'),(10,8,'Petra Maria del Carmen Socorro',1487965,'0146859732','Segundera','2017-01-12'),(11,9,'Domingo Guedez',3886100,'04144636869','ciudad jardin','2017-01-12'),(12,10,'Leonardo Monsalves',22339658,'01426589741','Prados Sector Lirios','2017-01-12'),(13,11,'Alvaro',21202500,'04124362753','Ciudad Jardín calle 3-9','2017-01-12'),(14,12,'Cristina Alejandra del Castillo Aular',15874963,'0412658974','Prados ','2017-01-12');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_compra` date NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,'fac-8221691','2017-01-08',0),(2,'fac-8221690','2017-01-08',0),(5,'fac-7644875','2017-01-08',0),(6,'fac-9070145','2017-01-08',0),(7,'fac-8469550','2017-01-09',0),(8,'fac-4030024','2017-01-09',0),(9,'fac-463037','2017-01-09',0),(14,'fac-5309871','2017-01-09',0),(16,'fac-541999','2017-01-09',0),(17,'fac-9903052','2017-01-09',0),(18,'fac-4929697','2017-01-09',0),(19,'fac-5399503','2017-01-09',0),(20,'fac-7126595','2017-01-09',0),(21,'fac-5393100','2017-01-09',0),(22,'fac-8174435','2017-01-10',0),(23,'fac-5211397','2017-01-10',0),(24,'fac-4960489','2017-01-11',0);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras_detalle`
--

DROP TABLE IF EXISTS `compras_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras_detalle` (
  `id_compra` int(11) NOT NULL,
  `nombre_articulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(11) NOT NULL,
  `proveedor` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `iva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras_detalle`
--

LOCK TABLES `compras_detalle` WRITE;
/*!40000 ALTER TABLE `compras_detalle` DISABLE KEYS */;
INSERT INTO `compras_detalle` VALUES (1,'Gorras planas nike sb','NIke',1500,'Distribuidora los machaqueros de Prados',45,67500,0,0),(2,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',25,100000,0,0),(5,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',234,936000,0,0),(5,'Sweeter nike Sb','Nike',2000,'Distribuidora los machaqueros de Prados',234,468000,0,0),(5,'Gorras planas nike sb','NIke',1500,'Distribuidora los machaqueros de Prados',234,351000,0,0),(6,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',546,2184000,0,0),(7,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',123,492000,0,0),(7,'Sweeter nike Sb','Nike',2000,'Distribuidora los machaqueros de Prados',100,200000,0,0),(8,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',100,400000,0,0),(8,'Sweeter nike Sb','Nike',2000,'Distribuidora los machaqueros de Prados',100,200000,0,0),(9,'Sweeter nike Sb','Nike',2000,'Distribuidora los machaqueros de Prados',100,200000,0,0),(9,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',100,400000,0,0),(14,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',100,400000,0,0),(14,'Sweeter nike Sb','Nike',2000,'Distribuidora los machaqueros de Prados',100,200000,0,0),(16,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',100,400000,0,0),(16,'Sweeter nike Sb','Nike',2000,'Distribuidora los machaqueros de Prados',100,200000,0,0),(17,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',125,560000,500000,60000),(18,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',200,896000,800000,96000),(18,'Sweeter nike Sb','Nike',2000,'Distribuidora los machaqueros de Prados',200,448000,400000,48000),(19,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',123,551040,492000,59040),(20,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',213,954240,852000,102240),(21,'Gorras planas nike sb','NIke',1500,'Distribuidora los machaqueros de Prados',500,840000,750000,90000),(22,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',1,4480,4000,480),(23,'Air max 95','Nike',4000,'Distribuidora los machaqueros de Prados',12,53760,48000,5760),(24,'Sweeter nike Sb','Nike',2000,'Distribuidora los machaqueros de Prados',200,448000,400000,48000);
/*!40000 ALTER TABLE `compras_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion_empresa`
--

DROP TABLE IF EXISTS `configuracion_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fax` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_empresa`
--

LOCK TABLES `configuracion_empresa` WRITE;
/*!40000 ALTER TABLE `configuracion_empresa` DISABLE KEYS */;
INSERT INTO `configuracion_empresa` VALUES (1,'Tiendas de ropa \"Tu estilo es lo que importa\" C.A','C.C el paseo frente a la calle freilan correa cruce con la iglesia de Cagua','04144636869','tuestilo_importa@gmail.com','lashd123123','');
/*!40000 ALTER TABLE `configuracion_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuentos`
--

DROP TABLE IF EXISTS `descuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descuentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos`
--

LOCK TABLES `descuentos` WRITE;
/*!40000 ALTER TABLE `descuentos` DISABLE KEYS */;
INSERT INTO `descuentos` VALUES (1,'Descuento para juguetes de niños y artículos de cocina ',2,1);
/*!40000 ALTER TABLE `descuentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encargado`
--

DROP TABLE IF EXISTS `encargado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encargado` (
  `id_encargado` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre_encargado` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono_encargado` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `correo_encargado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_encargado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encargado`
--

LOCK TABLES `encargado` WRITE;
/*!40000 ALTER TABLE `encargado` DISABLE KEYS */;
INSERT INTO `encargado` VALUES (1,1,24420507,'Alvaro Antonio Guedez Crespo','04124362753','alvarovisiont@g');
/*!40000 ALTER TABLE `encargado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `grupo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `precio_proveedor` int(11) NOT NULL,
  `fecha_agregado` date NOT NULL,
  `observacion` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` VALUES (9,1,'Air max 95','Nike','zapatos',753,4500,4000,'2017-01-02',''),(10,1,'Sweeter nike Sb','Nike','sweter',424,2500,2000,'2017-01-03',''),(11,1,'Gorras planas nike sb','NIke','gorras',795,1900,1500,'2017-01-03','');
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pagina_web` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fax` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Distribuidora los machaqueros de Prados','0414569874','la_panaderia@gmail.com','urbanización el huete, calle 5 conexión con la carpiera ','','','');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'admin','admin123','carlos_123@gmail.com',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factura` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_venta` date NOT NULL,
  `monto_pagado` int(11) NOT NULL,
  `vuelto` int(11) NOT NULL,
  `tipo_venta` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,'fac-3596193','2017-01-12',24000,0,'efectivo'),(3,'fac-2529146','2017-01-12',785000,0,'efectivo'),(4,'fac-741079','2017-01-12',784000,0,'credito'),(5,'fac-2927307','2017-02-12',150000,0,'efectivo'),(6,'fac-7852492','2017-01-12',26320,0,'debito'),(7,'fac-824919','2017-01-12',35427,0,'credito'),(8,'fac-2195922','2017-01-12',15500,0,'efectivo'),(9,'fac-4464464','2017-01-12',35000,0,'efectivo'),(10,'fac-1284968','2017-01-12',5050,0,'efectivo'),(11,'fac-6943672','2017-01-12',29120,0,'efectivo'),(12,'fac-3787956','2017-01-12',21000,840,'efectivo');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_detalle`
--

DROP TABLE IF EXISTS `ventas_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_detalle`
--

LOCK TABLES `ventas_detalle` WRITE;
/*!40000 ALTER TABLE `ventas_detalle` DISABLE KEYS */;
INSERT INTO `ventas_detalle` VALUES (1,'Air max 95','Nike',4500,3,13500,1620,15120),(1,'Sweeter nike Sb','Nike',2500,3,7500,900,8400),(4,'Air max 95','Nike',4500,100,450000,54000,504000),(4,'Sweeter nike Sb','Nike',2500,100,250000,30000,280000),(5,'Air max 95','Nike',4500,3,13500,1620,15120),(5,'Sweeter nike Sb','Nike',2500,45,112500,13500,126000),(6,'Air max 95','Nike',4500,3,13500,1620,15120),(6,'Sweeter nike Sb','Nike',2500,4,10000,1200,11200),(7,'Gorras planas nike sb','NIke',1900,3,5700,684,6384),(7,'Sweeter nike Sb','Nike',2500,10,25000,3000,28000),(8,'Sweeter nike Sb','Nike',2500,4,10000,1200,11200),(8,'Gorras planas nike sb','NIke',1900,2,3800,456,4256),(9,'Sweeter nike Sb','Nike',2500,5,12500,1500,14000),(9,'Air max 95','Nike',4500,4,18000,2160,20160),(10,'Air max 95','Nike',4500,1,4500,540,5040),(11,'Air max 95','Nike',4500,3,13500,1620,15120),(11,'Sweeter nike Sb','Nike',2500,5,12500,1500,14000),(12,'Air max 95','Nike',4500,4,18000,2160,20160);
/*!40000 ALTER TABLE `ventas_detalle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-14 16:47:59
