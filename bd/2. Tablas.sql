
USE bd_market;

# BANNER 

CREATE TABLE `banner_home` (
`cod_banner` 		INT (11) AUTO_INCREMENT NOT NULL,
`nombre_banner` 	VARCHAR (50),
`descrip_banner` 	VARCHAR (300),
`ruta_banner` 		VARCHAR (90),
`estado_banner` 	CHAR(1),
CONSTRAINT 	pk_cod_banner_bh	PRIMARY KEY(cod_banner)
)ENGINE =INNODB; 

# TEMPORAL
CREATE TABLE temp_detalle_venta_carrito
(
	cod_tmp_venta_carrito 	INT AUTO_INCREMENT NOT NULL,
	cod_producto		INT NOT NULL,
	cod_usu			INT NOT NULL,
	cantidad_detalle	DECIMAL(9,6) NOT NULL ,
	sub_total_detalle	DECIMAL(9,6) NULL , 
	total_detalle		DECIMAL(9,6) NULL , 
	CONSTRAINT 		pk_cod_tmp_venta_carrito  PRIMARY KEY(cod_tmp_venta_carrito)
)ENGINE = INNODB;

INSERT INTO `banner_home` (`descrip_banner`, `nombre_banner`, `ruta_banner`, `estado_banner`) VALUES
('0', 'banner 1','public/carrusel/b1.jpg','0'),
('0','banner 2','public/carrusel/b2.jpg','0'),
('0','banner 3','public/carrusel/b3.jpg','0'),
('0','banner 4','public/carrusel/b4.jpg','0'),
('0','banner 5','public/carrusel/b5.jpg','0'),
('0','banner 6','public/carrusel/b6.jpg','0');


 
 
 
 