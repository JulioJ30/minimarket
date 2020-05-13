
-- CONSULTA LA TABLA USUSARIO --
SELECT * FROM `usuario`;

-- CONSULTA TABLA TEMPORAL DETALLE VENTA CARRITO --
SELECT * FROM `temp_detalle_venta_carrito`;

SELECT * FROM categoria

DELETE FROM temp_detalle_venta_carrito

-- Insertar registros tabla Usuario
INSERT INTO `usuario` (`apell_usu`, `nombr_usu`,`telef_usu`,`nome_usu`,`pass_usu`,tipo_usu,estad_usu) VALUES ('Vasquez Tasayco','Wilmer',12345678980,'wvasquez','w122345','C',0);
INSERT INTO `usuario` (`apell_usu`, `nombr_usu`,`telef_usu`,`nome_usu`,`pass_usu`,tipo_usu,estad_usu) VALUES ('Torres Sandoval','Jaime',454545,'jaime','j122345','C',0);
INSERT INTO `usuario` (`apell_usu`, `nombr_usu`,`telef_usu`,`nome_usu`,`pass_usu`,tipo_usu,estad_usu) VALUES ('Magallanes Vega','Juan Carlos',565757,'jmagallanes','carlos2','C',0);

-- INSERTAMOS DATOS EN LA TABLA TEMPORAL --
INSERT INTO `temp_detalle_venta_carrito` (`cod_producto`,`cod_usu`,`cantidad_detalle`,`sub_total_detalle`,`total_detalle` ) VALUE (1,1,3,300.06,350.50);
INSERT INTO `temp_detalle_venta_carrito` (`cod_producto`,`cod_usu`,`cantidad_detalle`,`sub_total_detalle`,`total_detalle` ) VALUE (2,1,3,300.06,350.50);
INSERT INTO `temp_detalle_venta_carrito` (`cod_producto`,`cod_usu`,`cantidad_detalle`,`sub_total_detalle`,`total_detalle` ) VALUE (3,1,3,300.06,350.50);
INSERT INTO `temp_detalle_venta_carrito` (`cod_producto`,`cod_usu`,`cantidad_detalle`,`sub_total_detalle`,`total_detalle` ) VALUE (4,1,3,300.06,350.50);
INSERT INTO `temp_detalle_venta_carrito` (`cod_producto`,`cod_usu`,`cantidad_detalle`,`sub_total_detalle`,`total_detalle` ) VALUE (5,1,3,300.06,350.50);

SELECT * FROM temp_detalle_venta_carrito
SELECT * FROM usuario;

-- CONSULTA PARA DETALLE DE TEMPORAL DE CARRITO --
SELECT  T2.nombre_procucto,    T2.descripcion_producto, T2.obervacion_producto, T4.nombre_categoria, T5.nombre_familia,
	T6.nombre_marca,  T1.cantidad_detalle,   T2.precio_producto,      
	(T1.cantidad_detalle * T2.precio_producto) AS importe,
	T1.sub_total_detalle , T1.total_detalle 
FROM temp_detalle_venta_carrito T1
LEFT JOIN producto T2 ON T2.cod_producto = T1.cod_producto
LEFT JOIN detalle_categoria T3 ON T3.cod_detalle_categoria = T2.cod_Detalle_categoria
LEFT JOIN categoria T4 ON T4.cod_categoria = T3.cod_categoria
LEFT JOIN familia T5 ON T5.cod_familia = T4.cod_familia	
LEFT JOIN marca T6 ON T6.cod_marca = T3.cod_marca
WHERE T1.`cod_usu` = 1
;