USE bd_market;

#############
# PRODUCTOS #
#############
	CALL sp_productosfamilia_listar(NULL,NULL,NULL,NULL,NULL,NULL)
	-- LISTAR PRODUCTOS POR FAMILIA
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_productosfamilia_listar
	(
		IN 	_idfamilia	INT,
		IN 	_idcategoria	INT,
		IN 	_idmarca	INT,	
		IN  	_precio1	DECIMAL(9,6),
		IN  	_precio2	DECIMAL(9,6),
		IN 	_product	VARCHAR(50)
	)BEGIN

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
			
			-- CATEGORIAs
			
		
		-- PREPARAMOS 
		PREPARE stmt FROM @sql;
		
		-- EJECUTAMOS
		EXECUTE stmt;
		
	END $$

	-- OBTENER POR ID DE PRODUCTOS
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_productos_obtener
	(
		IN 	_idproducto	INT
	)BEGIN
		
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
		
	END $$

	SELECT * FROM categoria

	-- PRODUCTOS SUGERIDOS
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_productosugerido_listar()
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
	
	END $$
	


	-- OBTNER IMAGENES DE LOS PRODUCTOS
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_get_imagenesproductos
	(
		IN 	_idproducto		INT
	)BEGIN
		
		
		SELECT ruta_imagen_catalogo img FROM producto WHERE cod_producto = _idproducto
		UNION ALL 
		SELECT ruta_imagen  img FROM imagenes_productos WHERE cod_producto = _idproducto;
	END $$


##############
# CATEGORIAS #
##############

	-- LISTA CATEGORIAS POR FAMILIA
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE SP_LISTA_CATEGORIA_FAMILIA
	(
		IN 	_idfamilia	INT
	)BEGIN

		SELECT cod_categoria,nombre_categoria,descrip_categoria FROM categoria WHERE cod_familia = _idfamilia AND estado_categoria = 0;
	END $$

	-- LISTA CATEGORIAS POR FAMILIA Y MUESTRA CANTIDAD
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE SP_LISTA_CATEGORIA_FAMILIA_CANT
	(
		IN 	_idfamilia	INT
	)BEGIN
			
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
			
		IF _idfamilia IS NOT NULL THEN
			SET  @sql = CONCAT(@sql, " and fa.cod_familia = " ,_idfamilia);
		END IF;
		
		-- AGRUPAMOS
			SET @sql = CONCAT( @sql," GROUP BY cat.`cod_categoria`,cat.`nombre_categoria`, cat.descrip_categoria ");
		
		-- PREPARAMOS
		PREPARE stmt FROM @sql;
		
		-- EJECUTAMOS
		EXECUTE stmt;
		
	END $$

##########
# MARCAS #
##########

	-- LISTAR MARCAS POR FAMILIA
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_marcasfamilia_listar
	(
		IN 	_idfamilia	INT
	)BEGIN
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
		
			-- AGRUPAMOS
			SET @sql = CONCAT(@sql, " GROUP BY mar.`cod_marca`,mar.`nombre_marca`,mar.descri_marca" );
		
		-- PREPARAMOS
			PREPARE stmt FROM @sql;
			
		-- EJECUTAMOS
		EXECUTE stmt;
		
	END $$

##########
# BANNER #
##########
	
	-- LISTAR BANNER 
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_get_banner()
	BEGIN
		
		 SELECT bh.`nombre_banner`,bh.descrip_banner , bh.`ruta_banner` FROM banner_home bh WHERE bh.`estado_banner`=0;
	END $$


############
# USUARIOS #
############

	-- REGISTRAR USUARIO
	
		DELIMITER $$
		CREATE OR REPLACE PROCEDURE sp_usuarios_registrar
		(
			
		)
		
		
	-- LOGIN USUARIOS
		DELIMITER $$
		CREATE OR REPLACE PROCEDURE sp_usuarios_login
		(
			IN 	_nome_usu	VARCHAR(50),
			IN 	_pass_usu	VARCHAR(50)
		)BEGIN
			
			SELECT cod_usu,apell_usu,nombr_usu,telef_usu,tipo_usu FROM usuario  WHERE nome_usu = _nome_usu AND pass_usu = _pass_usu AND estad_usu = 0;
			
		END $$
	
		
		
###########
# CARRITO #
###########
	
	-- REGISTRA EN EL CARRITO
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_setinserta_temp_carrito
	(
		IN v_cod_producto 	INT ,
		IN v_cod_usu	  	INT ,
		IN v_cantidad_detalle   DECIMAL(9,6),
		IN v_subtotal		DECIMAL(9,6)
	)BEGIN
		
		DECLARE v_duplicado 	SMALLINT;
		
		-- VERIFICAMOS SI EXISTE
		SELECT COUNT(*) INTO v_duplicado FROM temp_detalle_venta_carrito WHERE cod_producto = v_cod_producto AND cod_usu = v_cod_usu;
		
		IF v_duplicado > 0 THEN 
			--  ACTUALIZAMOS SI YA EXISTE
			UPDATE temp_detalle_venta_carrito SET
			cantidad_detalle = cantidad_detalle + V_cantidad_detalle
			WHERE cod_producto = v_cod_producto AND cod_usu = v_cod_usu;
		ELSE
		
			-- REGISTRAMOS
			INSERT INTO temp_detalle_venta_carrito (cod_producto,cod_usu,cantidad_detalle,sub_total_detalle,total_detalle) VALUES
				(v_cod_producto,v_cod_usu,v_cantidad_detalle,v_subtotal,NULL);
		
		END IF;	
		
	END$$
	
	
	-- LISTAR PRODUCTOS DEL CARRITO
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_carrito_listar
	(
		IN 	_idusuario	INT
	)BEGIN
	
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
		INNER JOIN temp_detalle_venta_carrito tmp ON
		tmp.cod_producto = pro.cod_producto
		WHERE pro.`estado_producto` = 0 AND tmp.cod_usu= _idusuario;
			
			
	END $$
	
	-- ELIMINAR
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_carrito_elimimar
	(
		IN 	_idcarrito	INT
	)BEGIN
		
		DELETE FROM temp_detalle_venta_carrito WHERE cod_tmp_venta_carrito = _idcarrito;
	
	END $$
	
	
	SELECT * FROM  temp_detalle_venta_carrito
	
	SELECT * FROM usuario