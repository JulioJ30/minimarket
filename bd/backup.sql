/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.1.35-MariaDB : Database - bd_market
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bd_market` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `bd_market`;

/*Table structure for table `banner_home` */

DROP TABLE IF EXISTS `banner_home`;

CREATE TABLE `banner_home` (
  `cod_banner` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_banner` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descrip_banner` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ruta_banner` varchar(90) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_banner` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cod_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `banner_home` */

insert  into `banner_home`(`cod_banner`,`nombre_banner`,`descrip_banner`,`ruta_banner`,`estado_banner`) values 
(1,'banner 1','0','public/carrusel/b1.jpg','0'),
(2,'banner 2','0','public/carrusel/b2.jpg','0'),
(3,'banner 3','0','public/carrusel/b3.jpg','0'),
(4,'banner 4','0','public/carrusel/b4.jpg','0'),
(5,'banner 5','0','public/carrusel/b5.jpg','0'),
(6,'banner 6','0','public/carrusel/b6.jpg','0');

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `cod_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `cod_familia` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `descrip_categoria` varchar(200) DEFAULT NULL,
  `estado_categoria` int(1) NOT NULL,
  PRIMARY KEY (`cod_categoria`),
  KEY `cod_familia` (`cod_familia`),
  CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`cod_familia`) REFERENCES `familia` (`cod_familia`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `categoria` */

insert  into `categoria`(`cod_categoria`,`cod_familia`,`nombre_categoria`,`descrip_categoria`,`estado_categoria`) values 
(1,1,'Yogurt','Lacteos',0),
(2,1,'Quesos, Vinos y Bebidas','Abarrotes Bebidas',0),
(3,1,'Mantequilla','Abarrotes Basicos',0),
(4,1,'Embutidos Personal','Perfumeria cuidado personal',0),
(5,2,'Agua Mineral','Agua Mineral',0),
(6,2,'Gaseosa','Abarrotes Gaseosa',0),
(7,2,'Energizante','Abarrotes Energizante',0),
(8,2,'Jugos','Jugos',0),
(9,6,'Sanwuches','Sanwuches',0),
(10,6,'Triples','Triples',0),
(11,6,'Combos Desayuno','combos Desayuno',0);

/*Table structure for table `comprobante` */

DROP TABLE IF EXISTS `comprobante`;

CREATE TABLE `comprobante` (
  `cod_comprobante` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de comprobante',
  `tipo_comprobante` varchar(50) NOT NULL COMMENT 'nombre de comprobante',
  `serie_comprobante` varchar(100) NOT NULL COMMENT 'serie de comprobante',
  `correlativo_comprobante` varchar(100) NOT NULL COMMENT 'serie de comprobante',
  `estado_comprobante` int(9) NOT NULL COMMENT 'estado de comprobante',
  PRIMARY KEY (`cod_comprobante`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Tabla de comprobante';

/*Data for the table `comprobante` */

insert  into `comprobante`(`cod_comprobante`,`tipo_comprobante`,`serie_comprobante`,`correlativo_comprobante`,`estado_comprobante`) values 
(1,'BOLETA','B01','001',1);

/*Table structure for table `detalle_categoria` */

DROP TABLE IF EXISTS `detalle_categoria`;

CREATE TABLE `detalle_categoria` (
  `cod_detalle_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `cod_categoria` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  PRIMARY KEY (`cod_detalle_categoria`),
  KEY `cod_categoria` (`cod_categoria`),
  KEY `cod_marca` (`cod_marca`),
  CONSTRAINT `detalle_categoria_ibfk_1` FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`cod_categoria`),
  CONSTRAINT `detalle_categoria_ibfk_2` FOREIGN KEY (`cod_marca`) REFERENCES `marca` (`cod_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COMMENT='Tabla detalle categoria';

/*Data for the table `detalle_categoria` */

insert  into `detalle_categoria`(`cod_detalle_categoria`,`cod_categoria`,`cod_marca`) values 
(1,1,2),
(2,1,9),
(3,2,9),
(4,2,7),
(5,5,4),
(6,5,6),
(7,6,1),
(8,6,3),
(9,9,10),
(10,10,10),
(11,11,10);

/*Table structure for table `detalle_venta_carrito` */

DROP TABLE IF EXISTS `detalle_venta_carrito`;

CREATE TABLE `detalle_venta_carrito` (
  `co_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `cod_venta_carrito` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `cantidad_detalle` decimal(9,6) NOT NULL,
  `importe_detalle` decimal(9,6) DEFAULT NULL,
  PRIMARY KEY (`co_detalle`),
  KEY `fk_cod_venta_carrito` (`cod_venta_carrito`),
  KEY `fk_cod_producto` (`cod_producto`),
  CONSTRAINT `fk_cod_producto` FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`cod_producto`),
  CONSTRAINT `fk_cod_venta_carrito` FOREIGN KEY (`cod_venta_carrito`) REFERENCES `venta_carrito` (`cod_venta_carrito`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `detalle_venta_carrito` */

insert  into `detalle_venta_carrito`(`co_detalle`,`cod_venta_carrito`,`cod_producto`,`cantidad_detalle`,`importe_detalle`) values 
(1,2,1,3.000000,23.970000),
(2,2,15,1.000000,0.990000),
(3,2,3,1.000000,7.990000),
(4,4,1,3.000000,23.970000),
(5,5,9,4.000000,3.960000);

/*Table structure for table `direcciones_usuarios` */

DROP TABLE IF EXISTS `direcciones_usuarios`;

CREATE TABLE `direcciones_usuarios` (
  `cod_direcc_usu` int(11) NOT NULL AUTO_INCREMENT,
  `cod_usu` int(11) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `referencia` varchar(300) NOT NULL,
  `latitud` varchar(300) DEFAULT NULL,
  `longitud` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`cod_direcc_usu`),
  KEY `cod_usu` (`cod_usu`),
  CONSTRAINT `direcciones_usuarios_ibfk_1` FOREIGN KEY (`cod_usu`) REFERENCES `usuario` (`cod_usu`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Tabla de direccion por usuario';

/*Data for the table `direcciones_usuarios` */

insert  into `direcciones_usuarios`(`cod_direcc_usu`,`cod_usu`,`direccion`,`referencia`,`latitud`,`longitud`) values 
(1,1,'calle 123','mi casa','2','3'),
(2,1,'calle 321','casa de mi mamá','5','6');

/*Table structure for table `empaque` */

DROP TABLE IF EXISTS `empaque`;

CREATE TABLE `empaque` (
  `cod_empaque` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de empaque',
  `nombre_empaque` varchar(100) NOT NULL COMMENT 'nombre empaque',
  `descri_empaque` varchar(200) NOT NULL COMMENT 'descripcion de empaque',
  PRIMARY KEY (`cod_empaque`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Tabla de empaque';

/*Data for the table `empaque` */

insert  into `empaque`(`cod_empaque`,`nombre_empaque`,`descri_empaque`) values 
(1,'Botella','Botella'),
(2,'Tetrapack','Tetrapack'),
(3,'Plato','Plato'),
(4,'Pote','Pote');

/*Table structure for table `familia` */

DROP TABLE IF EXISTS `familia`;

CREATE TABLE `familia` (
  `cod_familia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de familia',
  `nombre_familia` varchar(100) NOT NULL COMMENT 'nombre familia',
  `descri_familia` varchar(200) NOT NULL COMMENT 'descripcion de familia',
  `estado_familia` int(1) NOT NULL COMMENT 'estado de familia',
  PRIMARY KEY (`cod_familia`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Tabla de Familia';

/*Data for the table `familia` */

insert  into `familia`(`cod_familia`,`nombre_familia`,`descri_familia`,`estado_familia`) values 
(1,'Lacteos','Lacteos',0),
(2,'Cervezas, Vinos y Bebidas','Abarrotes Bebidas',0),
(3,'Basico','Abarrotes Basicos',0),
(4,'Cuidado Personal','Perfumeria cuidado personal',0),
(6,'Preparados','Preparados',0);

/*Table structure for table `imagenes_productos` */

DROP TABLE IF EXISTS `imagenes_productos`;

CREATE TABLE `imagenes_productos` (
  `cod_imagen_producto` int(11) NOT NULL AUTO_INCREMENT,
  `cod_producto` int(11) NOT NULL,
  `ruta_imagen` varchar(200) NOT NULL,
  `estado_imagen` int(1) NOT NULL,
  PRIMARY KEY (`cod_imagen_producto`),
  KEY `cod_producto` (`cod_producto`),
  CONSTRAINT `imagenes_productos_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `producto` (`cod_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Tabla de imagenes por producto';

/*Data for the table `imagenes_productos` */

insert  into `imagenes_productos`(`cod_imagen_producto`,`cod_producto`,`ruta_imagen`,`estado_imagen`) values 
(1,1,'https://vivanda.vteximg.com.br/arquivos/ids/181797-1000-1000/20190924.jpg?v=637147919209330000',0);

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `cod_marca` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de marcas',
  `nombre_marca` varchar(50) NOT NULL COMMENT 'nombre de marca',
  `descri_marca` varchar(100) NOT NULL COMMENT 'descripcion de marca',
  `estado_marca` int(9) NOT NULL COMMENT 'estado de familia',
  PRIMARY KEY (`cod_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='Tabla de Marcas';

/*Data for the table `marca` */

insert  into `marca`(`cod_marca`,`nombre_marca`,`descri_marca`,`estado_marca`) values 
(1,'Coca Cola','Coca Cola',0),
(2,'Gloria','Gloria',0),
(3,'Inca Cola','Inca Cola',0),
(4,'Cielo','Cielo',0),
(5,'Red Bull','Red Bull',0),
(6,'San Luis','San Luis',0),
(7,'San Fernando','San Fernando',0),
(8,'Redondos','Redondos',0),
(9,'Laive','Laive',0),
(10,'Don Desayuno','Don Desayuno',0);

/*Table structure for table `metodo_pago` */

DROP TABLE IF EXISTS `metodo_pago`;

CREATE TABLE `metodo_pago` (
  `cod_metodo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_metodo_pago` varchar(100) NOT NULL,
  `descripcion_metodo_pago` varchar(200) NOT NULL,
  `numero_cta1_metodo_pago` varchar(50) DEFAULT NULL,
  `numero_cta2_metodo_pago` varchar(20) DEFAULT NULL,
  `ruta_imagen_metodo_pago` varchar(300) NOT NULL COMMENT 'ruta de imagen de tipo de pago',
  PRIMARY KEY (`cod_metodo_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Tabla de medios de pago';

/*Data for the table `metodo_pago` */

insert  into `metodo_pago`(`cod_metodo_pago`,`nombre_metodo_pago`,`descripcion_metodo_pago`,`numero_cta1_metodo_pago`,`numero_cta2_metodo_pago`,`ruta_imagen_metodo_pago`) values 
(1,'Efectivo','Efectivo','0','0','public/img/metodo_pago/efectivo.jpg'),
(2,'Lukita','Lukita BBV','0','0','public/img/metodo_pago/lukita.jpg'),
(3,'Plin','Plin Interbanck','0','0','public/img/metodo_pago/plin.png'),
(4,'Yape','Yape Bcp','0','0','public/img/metodo_pago/yape.jpg');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `cod_producto` int(11) NOT NULL AUTO_INCREMENT,
  `cod_empaque` int(11) NOT NULL,
  `cod_Detalle_categoria` int(11) NOT NULL,
  `fecha_venc_producto` date DEFAULT NULL,
  `nombre_procucto` varchar(100) NOT NULL,
  `descripcion_producto` varchar(250) DEFAULT NULL,
  `precio_producto` decimal(9,6) NOT NULL,
  `stock_producto` decimal(9,6) NOT NULL,
  `tipo_stock_producto` char(2) NOT NULL,
  `obervacion_producto` varchar(200) DEFAULT NULL,
  `precio_especial_producto` decimal(9,6) DEFAULT NULL,
  `sku_producto` varchar(25) DEFAULT NULL,
  `estado_producto` int(1) DEFAULT NULL,
  `ruta_imagen_catalogo` varchar(300) DEFAULT NULL COMMENT 'Columna de ruta de imagen principal de producto',
  `cod_um` int(11) NOT NULL,
  `psugerido` char(1) DEFAULT '0',
  PRIMARY KEY (`cod_producto`),
  KEY `cod_empaque` (`cod_empaque`),
  KEY `cod_Detalle_categoria` (`cod_Detalle_categoria`),
  KEY `cod_um` (`cod_um`),
  CONSTRAINT `cod_um` FOREIGN KEY (`cod_um`) REFERENCES `unidad_medida` (`cod_um`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`cod_empaque`) REFERENCES `empaque` (`cod_empaque`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`cod_Detalle_categoria`) REFERENCES `detalle_categoria` (`cod_detalle_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='Tabla de productos de la venta';

/*Data for the table `producto` */

insert  into `producto`(`cod_producto`,`cod_empaque`,`cod_Detalle_categoria`,`fecha_venc_producto`,`nombre_procucto`,`descripcion_producto`,`precio_producto`,`stock_producto`,`tipo_stock_producto`,`obervacion_producto`,`precio_especial_producto`,`sku_producto`,`estado_producto`,`ruta_imagen_catalogo`,`cod_um`,`psugerido`) values 
(1,1,1,'2020-06-30','Yogurt de  2 litros','sabor a fresa',7.990000,14.000000,'C','Yogurt',7.990000,'1223222222',0,'https://plazavea.vteximg.com.br/arquivos/ids/169455-450-450/79036.jpg?v=635769971188800000',1,'0'),
(2,1,2,'2020-06-30','Yogurt de  2 litros','sabor a fresa',7.990000,20.000000,'C','Yogurt',7.990000,'1223222222',0,NULL,1,'0'),
(3,4,3,'2020-06-30','Queso Edam','sin sal',7.990000,19.000000,'C','Queso',7.990000,'1223254645442',0,'https://wongfood.vteximg.com.br/arquivos/ids/306461-750-750/467156-1.jpg?v=636982022545270000',3,'0'),
(4,4,4,'2020-06-30','Queso Edam','con sal',7.990000,20.000000,'C','Queso',7.990000,'122320000822',0,NULL,3,'0'),
(5,1,5,'2020-06-30','Agua Mineral de 5mm ml','Con gas',7.990000,20.000000,'C','Agua Mineral Con Gas',7.990000,'1223222222',0,NULL,1,'0'),
(6,3,6,'2020-06-30','Agua Mineral de 5mm ml','sin gas',7.990000,20.000000,'C','Agua mineral Sin Gas',7.990000,'1223254645442',0,NULL,1,'1'),
(7,3,7,'2020-06-30','Gaseosa 3 lt','Zero',10.990000,20.000000,'C','Zero',0.990000,'122320000822',0,NULL,1,'1'),
(8,3,8,'2020-06-30','Gaseosas 1.5 lt','ALto en Azucar',7.990000,20.000000,'C','Piña',7.990000,'122320000822',0,NULL,1,'1'),
(9,3,9,'2020-06-30','Sanguches dobles','pan grande',10.990000,16.000000,'C','pollo',0.990000,'122320000822',0,'public/img/productos/preparados/Sanwuches/9.jpg',1,'0'),
(10,3,10,'2020-06-30','Sanguches triple','pan grande',10.990000,20.000000,'C','pollo',0.990000,'122320000822',0,'public/img/productos/preparados/Triples/10.jpg',1,'0'),
(11,3,11,'2020-06-30','Sanguches simple','pan grande',10.990000,20.000000,'C','pollo',0.990000,'122320000822',0,'public/img/productos/preparados/CombosDesayuno/11.jpg',1,'0'),
(12,3,10,'2020-06-30','Sanguches simple','pan grande',10.990000,20.000000,'C','pollo',0.990000,'122320000822',0,'public/img/productos/preparados/Triples/12.jpg',1,'0'),
(13,3,11,'2020-06-30','Sanguches simple','pan grande',10.990000,20.000000,'C','pollo',0.990000,'122320000822',0,'public/img/productos/preparados/CombosDesayuno/13.jpg',1,'0'),
(14,3,11,'2020-06-30','Sanguches simple','pan grande',10.990000,20.000000,'C','pollo',0.990000,'122320000822',0,'public/img/productos/preparados/CombosDesayuno/14.jpg',1,'0'),
(15,3,11,'2020-06-30','Sanguches simple','pan grande',10.990000,19.000000,'C','pollo',0.990000,'122320000822',0,'public/img/productos/preparados/CombosDesayuno/15.jpg',1,'0');

/*Table structure for table `temp_detalle_venta_carrito` */

DROP TABLE IF EXISTS `temp_detalle_venta_carrito`;

CREATE TABLE `temp_detalle_venta_carrito` (
  `cod_tmp_venta_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `cod_producto` int(11) NOT NULL,
  `cod_usu` int(11) NOT NULL,
  `cantidad_detalle` decimal(9,6) NOT NULL,
  `sub_total_detalle` decimal(9,6) DEFAULT NULL,
  `total_detalle` decimal(9,6) DEFAULT NULL,
  PRIMARY KEY (`cod_tmp_venta_carrito`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `temp_detalle_venta_carrito` */

/*Table structure for table `unidad_medida` */

DROP TABLE IF EXISTS `unidad_medida`;

CREATE TABLE `unidad_medida` (
  `cod_um` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de unidad de medida',
  `nombre_um` varchar(100) NOT NULL COMMENT 'nombre de unidad   de medida',
  `descri_um` varchar(200) NOT NULL COMMENT 'descripcion de unidad de medida',
  PRIMARY KEY (`cod_um`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Tabla de unidad de medida';

/*Data for the table `unidad_medida` */

insert  into `unidad_medida`(`cod_um`,`nombre_um`,`descri_um`) values 
(1,'UN','Unidad'),
(2,'LT','Litro'),
(3,'KG','Kilogramo'),
(4,'PQ','Paquete'),
(5,'CJ','Caja');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `cod_usu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria de usuario',
  `apell_usu` varchar(100) NOT NULL COMMENT 'apellido de usuario',
  `nombr_usu` varchar(100) NOT NULL COMMENT 'nombre de usuario',
  `telef_usu` int(11) DEFAULT NULL COMMENT 'telefono 	',
  `nome_usu` varchar(50) NOT NULL COMMENT 'login usuario',
  `pass_usu` varchar(50) NOT NULL COMMENT 'pass de usuario',
  `tipo_usu` char(1) NOT NULL COMMENT 'tipo de usuario A/C',
  `estad_usu` int(1) NOT NULL COMMENT 'estado de usuario',
  PRIMARY KEY (`cod_usu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Tabla de usuario';

/*Data for the table `usuario` */

insert  into `usuario`(`cod_usu`,`apell_usu`,`nombr_usu`,`telef_usu`,`nome_usu`,`pass_usu`,`tipo_usu`,`estad_usu`) values 
(1,'Vasquez Tasayco','Wilmer',2147483647,'wvasquez','c2247d2019a778036f659526f545e09f75dcc8b8','C',0),
(2,'Torres Sandoval','Jaime',454545,'jaime','j122345','C',0),
(3,'Magallanes Vega','Juan Carlos',565757,'jmagallanes','carlos2','C',0);

/*Table structure for table `venta_carrito` */

DROP TABLE IF EXISTS `venta_carrito`;

CREATE TABLE `venta_carrito` (
  `cod_venta_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `cod_direcc_usu` int(11) NOT NULL,
  `cod_metodo_pago` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `cod_comprobante` int(11) NOT NULL,
  `monto_total_bruto_venta` decimal(9,6) NOT NULL,
  `monto_total_neto_venta` decimal(9,6) NOT NULL,
  `monto_igv_venta` decimal(9,6) NOT NULL,
  `estado_venta` char(3) NOT NULL,
  PRIMARY KEY (`cod_venta_carrito`),
  KEY `cod_direcc_usu` (`cod_direcc_usu`),
  KEY `cod_metodo_pago` (`cod_metodo_pago`),
  KEY `cod_comprobante` (`cod_comprobante`),
  CONSTRAINT `venta_carrito_ibfk_1` FOREIGN KEY (`cod_direcc_usu`) REFERENCES `direcciones_usuarios` (`cod_direcc_usu`),
  CONSTRAINT `venta_carrito_ibfk_2` FOREIGN KEY (`cod_metodo_pago`) REFERENCES `metodo_pago` (`cod_metodo_pago`),
  CONSTRAINT `venta_carrito_ibfk_3` FOREIGN KEY (`cod_comprobante`) REFERENCES `comprobante` (`cod_comprobante`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Tabla principal de ventas';

/*Data for the table `venta_carrito` */

insert  into `venta_carrito`(`cod_venta_carrito`,`cod_direcc_usu`,`cod_metodo_pago`,`fecha_creacion`,`fecha_entrega`,`cod_comprobante`,`monto_total_bruto_venta`,`monto_total_neto_venta`,`monto_igv_venta`,`estado_venta`) values 
(2,1,1,'2020-05-14',NULL,1,0.000000,0.000000,0.000000,'1'),
(4,2,4,'2020-05-14',NULL,1,0.000000,0.000000,0.000000,'1'),
(5,1,1,'2020-05-14',NULL,1,0.000000,0.000000,0.000000,'1');

/* Procedure structure for procedure `sp_carrito_elimimar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_carrito_elimimar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_carrito_elimimar`(
		in 	_idcarrito	int
	)
begin
		
		delete from temp_detalle_venta_carrito where cod_tmp_venta_carrito = _idcarrito;
	
	end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_carrito_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_carrito_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_carrito_listar`(
		in 	_idusuario	int
	)
begin
	
		SELECT 
			pro.`cod_producto`,
			pro.`nombre_procucto`,
			pro.`descripcion_producto`,
			IF(pro.precio_especial_producto > 0 AND pro.precio_especial_producto <  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio1,
			IF(pro.precio_especial_producto >  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio2,
			cat.`cod_categoria`,
			cat.`nombre_categoria`,
			pro.ruta_imagen_catalogo,
			tmp.cantidad_detalle,
			tmp.cod_tmp_venta_carrito
		FROM producto pro
		INNER JOIN detalle_categoria dtc ON
		dtc.cod_Detalle_categoria = pro.cod_Detalle_categoria
		INNER JOIN categoria cat ON
		cat.cod_categoria = dtc.cod_categoria
		INNER JOIN familia fa ON
		fa.`cod_familia` = cat.`cod_familia` 
		inner join temp_detalle_venta_carrito tmp on
		tmp.cod_producto = pro.cod_producto
		WHERE pro.`estado_producto` = 0 and tmp.cod_usu= _idusuario;
			
			
	end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_carrito_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_carrito_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_carrito_modificar`(
		-- in 	_idusuario	int,
		-- in 	_idproducto	int,
		in 	_idcarrito	int,
		in 	_cantidad	DECIMAL(9,6)
	)
begin
	
		-- select * from temp_detalle_venta_carrito
		update temp_detalle_venta_carrito set
		cantidad_detalle = _cantidad,
		total_detalle = cantidad_detalle * sub_total_detalle
		where cod_tmp_venta_carrito = _idcarrito;
		
	end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_carrito_vaciar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_carrito_vaciar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_carrito_vaciar`(
		in 	_idusuario	int
	)
begin
	
		delete from temp_detalle_venta_carrito where cod_usu = _idusuario;
	end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_direcciones_usuarios_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_direcciones_usuarios_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_direcciones_usuarios_listar`(
		in 	_idusuario	int
	)
begin
		SELECT * FROM direcciones_usuarios where  cod_usu = _idusuario;
	end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_get_banner` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_get_banner` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_banner`()
begin
		
		 SELECT bh.`nombre_banner`,bh.descrip_banner , bh.`ruta_banner` FROM banner_home bh WHERE bh.`estado_banner`=0;
	end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_get_imagenesproductos` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_get_imagenesproductos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_imagenesproductos`(
	in 	_idproducto		int
)
begin
	
	
	select ruta_imagen_catalogo img from producto where cod_producto = _idproducto
	union all 
	select ruta_imagen  img from imagenes_productos WHERE cod_producto = _idproducto;
end */$$
DELIMITER ;

/* Procedure structure for procedure `SP_LISTA_CATEGORIA` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_LISTA_CATEGORIA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTA_CATEGORIA`()
SELECT C1.nombre_categoria, C1.descrip_categoria FROM categoria C1 */$$
DELIMITER ;

/* Procedure structure for procedure `SP_LISTA_CATEGORIA_FAMILIA` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_LISTA_CATEGORIA_FAMILIA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTA_CATEGORIA_FAMILIA`(
	IN 	_idfamilia	INT
)
BEGIN

	select cod_categoria,nombre_categoria,descrip_categoria from categoria where cod_familia = _idfamilia and estado_categoria = 0;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_lista_familia` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_lista_familia` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lista_familia`()
begin
	select cod_familia,nombre_familia,descri_familia from familia where estado_familia = 0;
end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_metodopago_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_metodopago_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_metodopago_listar`()
begin
		SELECT * FROM metodo_pago;
	end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_usuarios_carrito` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_usuarios_carrito` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuarios_carrito`(	
			in 	_idusuario	 int
		)
begin
		
			select count(*) cantidad from temp_detalle_venta_carrito where cod_usu = _idusuario;
		end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_usuarios_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_usuarios_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuarios_login`(
			in 	_nome_usu	varchar(50),
			IN 	_pass_usu	VARCHAR(50)
		)
begin
			
			select cod_usu,apell_usu,nombr_usu,telef_usu,tipo_usu from usuario  where nome_usu = _nome_usu and pass_usu = _pass_usu and estad_usu = 0;
			
		end */$$
DELIMITER ;

/* Procedure structure for procedure `SP_LISTAPRODUCTOS_CATEGORIA` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_LISTAPRODUCTOS_CATEGORIA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAPRODUCTOS_CATEGORIA`(IN `P_CATEGORIA_PRODUCTO` VARCHAR(50))
SELECT T1.nombre_procucto, T1.descripcion_producto, T1.precio_producto, T1.obervacion_producto, T1.precio_especial_producto,
T4.nombre_categoria , T5.nombre_marca, T6.nombre_familia, T7.nombre_um
FROM producto T1
LEFT JOIN empaque T2 ON
T2.cod_empaque = T1.cod_empaque 
LEFT JOIN detalle_categoria T3 ON 
T3.cod_detalle_categoria = T1.cod_Detalle_categoria 
LEFT JOIN categoria T4 ON T4.cod_categoria = T3.cod_categoria 
LEFT JOIN marca T5 ON T5.cod_marca = T3.cod_marca
LEFT JOIN familia T6 ON T4.cod_familia = T6.cod_familia
LEFT JOIN unidad_medida T7 ON T7.cod_um = T1.cod_um
WHERE T4.nombre_categoria LIKE CONCAT('%', P_CATEGORIA_PRODUCTO , '%') */$$
DELIMITER ;

/* Procedure structure for procedure `SP_LISTAPRODUCTOS_NOMBRE` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_LISTAPRODUCTOS_NOMBRE` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAPRODUCTOS_NOMBRE`(IN `P_NOMRE_PRODUCTO` VARCHAR(50))
SELECT T1.nombre_procucto, T1.descripcion_producto, T1.precio_producto, T1.obervacion_producto, T1.precio_especial_producto,
T4.nombre_categoria , T5.nombre_marca, T6.nombre_familia, T7.nombre_um
FROM producto T1
LEFT JOIN empaque T2 ON
T2.cod_empaque = T1.cod_empaque 
LEFT JOIN detalle_categoria T3 ON 
T3.cod_detalle_categoria = T1.cod_Detalle_categoria 
LEFT JOIN categoria T4 ON T4.cod_categoria = T3.cod_categoria 
LEFT JOIN marca T5 ON T5.cod_marca = T3.cod_marca
LEFT JOIN familia T6 ON T4.cod_familia = T6.cod_familia
LEFT JOIN unidad_medida T7 ON T7.cod_um = T1.cod_um
WHERE T1.nombre_procucto LIKE CONCAT('%', P_NOMRE_PRODUCTO , '%') */$$
DELIMITER ;

/* Procedure structure for procedure `SP_LISTA_CATEGORIA_FAMILIA_CANT` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_LISTA_CATEGORIA_FAMILIA_CANT` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTA_CATEGORIA_FAMILIA_CANT`(
		IN 	_idfamilia	INT,
		IN 	_product	VARCHAR(50)
	)
BEGIN
			
		SET @sql = "
		SELECT 
			cat.`cod_categoria`,
			cat.`nombre_categoria`,
			cat.descrip_categoria,
			COUNT(*) cantidad
		FROM producto pro
		INNER JOIN detalle_categoria dtc ON
		dtc.cod_Detalle_categoria = pro.cod_Detalle_categoria
		INNER JOIN categoria cat ON
		cat.cod_categoria = dtc.cod_categoria
		INNER JOIN familia fa ON
		fa.`cod_familia` = cat.`cod_familia`
		WHERE cat.estado_categoria = 0 ";
		
		-- FILTROS
		
		-- ID FAMILIA
		IF _idfamilia IS NOT NULL THEN
			SET  @sql = CONCAT(@sql, " and fa.cod_familia = " ,_idfamilia);
		END IF;
		
		-- PRODUCTO
			IF _product IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and pro.nombre_procucto like '","%", _product ,"%","'");
			END IF;
		
		-- AGRUPAMOS
			SET @sql = CONCAT( @sql," GROUP BY cat.`cod_categoria`,cat.`nombre_categoria`, cat.descrip_categoria ");
		
		-- PREPARAMOS
		PREPARE stmt FROM @sql;
		
		-- EJECUTAMOS
		EXECUTE stmt;
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_marcasfamilia_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_marcasfamilia_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_marcasfamilia_listar`(
		IN 	_idfamilia	INT,
		IN 	_product	VARCHAR(50)
	)
BEGIN
		SET @sql = "
		SELECT 
			mar.`cod_marca`,
			mar.`nombre_marca`,
			mar.descri_marca,
			COUNT(*) cantidad
		FROM producto pro
		INNER JOIN detalle_categoria dtc ON
		dtc.cod_Detalle_categoria = pro.cod_Detalle_categoria
		INNER JOIN categoria cat ON
		cat.cod_categoria = dtc.cod_categoria
		INNER JOIN familia fa ON
		fa.`cod_familia` = cat.`cod_familia`
		INNER JOIN marca mar ON
		mar.cod_marca = dtc.cod_marca
		where mar.estado_marca = 0 ";
		
			-- FILTROS 
			IF _idfamilia IS NOT NULL THEN 
				SET @sql = CONCAT(@sql , " and fa.cod_familia = ", _idfamilia);
			END IF;
			
			-- PRODUCTO
			IF _product IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and pro.nombre_procucto like '","%", _product ,"%","'");
			END IF;
		
			-- AGRUPAMOS
			SET @sql = CONCAT(@sql, " GROUP BY mar.`cod_marca`,mar.`nombre_marca`,mar.descri_marca" );
		
		-- PREPARAMOS
			PREPARE stmt FROM @sql;
			
		-- EJECUTAMOS
		EXECUTE stmt;
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_productosfamilia_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_productosfamilia_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_productosfamilia_listar`(
		IN 	_idfamilia	INT,
		IN 	_idcategoria	INT,
		IN 	_idmarca	INT,	
		IN  	_precio1	DECIMAL(9,6),
		IN  	_precio2	DECIMAL(9,6),
		IN 	_product	VARCHAR(50)
	)
BEGIN

		SET @sql = "
		SELECT 
			pro.`cod_producto`,
			pro.`nombre_procucto`,
			pro.`descripcion_producto`,
			if(pro.precio_especial_producto > 0 and pro.precio_especial_producto <  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio1,
			IF(pro.precio_especial_producto >  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio2,
			cat.`cod_categoria`,
			cat.`nombre_categoria`,
			pro.ruta_imagen_catalogo
		FROM producto pro
		inner join detalle_categoria dtc on
		dtc.cod_Detalle_categoria = pro.cod_Detalle_categoria
		INNER JOIN categoria cat ON
		cat.cod_categoria = dtc.cod_categoria
		INNER JOIN familia fa ON
		fa.`cod_familia` = cat.`cod_familia` 
		where pro.`estado_producto` = 0";
		
		-- FILTROS
		
			-- FAMILIAS
			IF _idfamilia IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and fa.cod_familia = ", _idfamilia );
			END IF;
			
			-- PRODIUCTO
			IF _product IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and pro.nombre_procucto like '","%", _product ,"%","'");
			END IF;
			/*
			-- FAMILIAS
			IF _idfamilia IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and fa.cod_familia = ", _idfamilia );
			END IF;
			
			-- FAMILIAS
			IF _idfamilia IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and fa.cod_familia = ", _idfamilia );
			END IF;
			
			-- FAMILIAS
			IF _idfamilia IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and fa.cod_familia = ", _idfamilia );
			END IF;
			
			-- FAMILIAS
			IF _idfamilia IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and fa.cod_familia = ", _idfamilia );
			END IF;*/
			
			
			
		
		-- PREPARAMOS 
		PREPARE stmt FROM @sql;
		
		-- EJECUTAMOS
		EXECUTE stmt;
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_productosugerido_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_productosugerido_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_productosugerido_listar`()
BEGIN
		
		SELECT 
			pro.`cod_producto`,
			pro.`nombre_procucto`,
			pro.`descripcion_producto`,
			IF(pro.precio_especial_producto > 0 AND pro.precio_especial_producto <  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio1,
			IF(pro.precio_especial_producto >  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio2,
			cat.`cod_categoria`,
			cat.`nombre_categoria`,
			pro.ruta_imagen_catalogo
		FROM producto pro
		INNER JOIN detalle_categoria dtc ON
		dtc.cod_Detalle_categoria = pro.cod_Detalle_categoria
		INNER JOIN categoria cat ON
		cat.cod_categoria = dtc.cod_categoria
		INNER JOIN familia fa ON
		fa.`cod_familia` = cat.`cod_familia` 
		WHERE pro.`estado_producto` = 0 AND pro.psugerido = '0';
	
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_productos_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_productos_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_productos_obtener`(
		IN 	_idproducto	INT
	)
BEGIN
		
		SELECT 
			pro.`cod_producto`,
			pro.`nombre_procucto`,
			pro.`descripcion_producto`,
			IF(pro.precio_especial_producto > 0 AND pro.precio_especial_producto <  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio1,
			IF(pro.precio_especial_producto >  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio2,
			cat.`cod_categoria`,
			cat.`nombre_categoria`,
			pro.ruta_imagen_catalogo,
			fa.`cod_familia`
		FROM producto pro
		INNER JOIN detalle_categoria dtc ON
		dtc.cod_Detalle_categoria = pro.cod_Detalle_categoria
		INNER JOIN categoria cat ON
		cat.cod_categoria = dtc.cod_categoria
		INNER JOIN familia fa ON
		fa.`cod_familia` = cat.`cod_familia` 
		WHERE pro.`estado_producto` = 0	
		AND pro.cod_producto = _idproducto;
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_setinserta_temp_carrito` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_setinserta_temp_carrito` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_setinserta_temp_carrito`(
		IN v_cod_producto 	INT ,
		IN v_cod_usu	  	INT ,
		IN v_cantidad_detalle   DECIMAL(9,6),
		IN v_subtotal		DECIMAL(9,6)
	)
BEGIN
		
		DECLARE v_duplicado 	SMALLINT;
		
		-- VERIFICAMOS SI EXISTE
		SELECT COUNT(*) INTO v_duplicado FROM temp_detalle_venta_carrito WHERE cod_producto = v_cod_producto AND cod_usu = v_cod_usu;
		
		IF v_duplicado > 0 THEN 
			--  ACTUALIZAMOS SI YA EXISTE
			UPDATE temp_detalle_venta_carrito SET
			cantidad_detalle = cantidad_detalle + V_cantidad_detalle,
			total_detalle = (cantidad_detalle) * sub_total_detalle
			WHERE cod_producto = v_cod_producto AND cod_usu = v_cod_usu;
		ELSE
		
			-- REGISTRAMOS
			INSERT INTO temp_detalle_venta_carrito (cod_producto,cod_usu,cantidad_detalle,sub_total_detalle,total_detalle) VALUES
				(v_cod_producto,v_cod_usu,v_cantidad_detalle,v_subtotal,v_cantidad_detalle*v_subtotal);
		
		END IF;	
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_venta_carrito_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_venta_carrito_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_venta_carrito_registrar`(
		in 	_iddireccionusuario	int,
		in 	_idmetodopago		int
	)
begin
		declare v_idusuario int;
		declare v_idventa int;
		
		-- OBTENEMOS ID DE USURIO
		select cod_usu into v_idusuario from direcciones_usuarios  where cod_direcc_usu = _iddireccionusuario;
		
		-- REGISTRAMOS VENTA
		insert into venta_carrito (cod_direcc_usu,cod_metodo_pago,fecha_creacion,fecha_entrega,cod_comprobante,monto_total_bruto_venta,monto_total_neto_venta,monto_igv_venta,estado_venta) values
		(_iddireccionusuario,_idmetodopago,curdate(),null,1,0,0,0,1);
		
		-- OBTENEMOS ID	DE VENTA
		select last_insert_id() into v_idventa;
		
		-- DESCONTAMOS STOCK
		update producto pro
		inner join temp_detalle_venta_carrito tmp on tmp.cod_producto = pro.cod_producto 
		set 
			pro.stock_producto = pro.stock_producto - tmp.cantidad_detalle
			where 
			pro.tipo_stock_producto = 'C' and 
			tmp.cod_usu = v_idusuario;
		
		-- REGISTRAMOS DETALLE VENTA 
		
		insert into detalle_venta_carrito(cod_venta_carrito,cod_producto,cantidad_detalle,importe_detalle)
		select v_idventa,cod_producto,cantidad_detalle,total_detalle from temp_detalle_venta_carrito 
		where cod_usu = v_idusuario;
		
		-- ELIMINAMOS TEMPORAL
		delete from temp_detalle_venta_carrito where cod_usu = v_idusuario;
		
	end */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
