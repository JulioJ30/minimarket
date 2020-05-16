USE bd_market;

-- VISTA PRODUCTOS
CREATE OR REPLACE VIEW v_productos
AS
SELECT 
			pro.`cod_producto`,
			pro.`nombre_procucto`,
			pro.`descripcion_producto`,
			IF(pro.precio_especial_producto > 0 AND pro.precio_especial_producto <  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio1,
			IF(pro.precio_especial_producto >  pro.precio_producto ,pro.precio_especial_producto,pro.precio_producto)precio2,
			cat.`cod_categoria`,
			cat.`nombre_categoria`,
			pro.ruta_imagen_catalogo,
			pro.`estado_producto`,
			fa.cod_familia,
			mar.cod_marca,
			mar.nombre_marca,
			cat.estado_categoria,
			mar.estado_marca,
			IF(pro.tipo_stock_producto = 'C',pro.stock_producto,1) stock
			
		FROM producto pro
		INNER JOIN detalle_categoria dtc ON
		dtc.cod_Detalle_categoria = pro.cod_Detalle_categoria
		INNER JOIN categoria cat ON
		cat.cod_categoria = dtc.cod_categoria
		INNER JOIN familia fa ON
		fa.`cod_familia` = cat.`cod_familia`
		INNER JOIN marca mar ON
		mar.`cod_marca` = dtc.`cod_marca`;
		
		SELECT * FROM v_productos;
		SELECT * FROM producto
		

		