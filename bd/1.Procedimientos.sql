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
		IN 	_idcategoria	VARCHAR(255),
		IN 	_idmarca	VARCHAR(255),	
		IN  	_precio1	DECIMAL(9,6),
		IN  	_precio2	DECIMAL(9,6),
		IN 	_product	VARCHAR(50)
	)BEGIN

		SET @sql = "select * from v_productos where estado_producto = 0";
		
		-- FILTROS
		
			-- FAMILIAS
			IF _idfamilia IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and cod_familia = ", _idfamilia );
			END IF;
			
			-- PRODIUCTO
			IF _product IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and nombre_procucto like '","%", _product ,"%","'");
			END IF;
		
			-- MARCAS
			IF _idmarca IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and cod_marca in(", _idmarca,")" );
			END IF;
			
			-- CATEGORIAS
			IF _idcategoria IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and cod_categoria  in(", _idcategoria,")" );
			END IF;
			
			-- PRECIO MINIMO
			IF _precio1 IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and precio1 >= ", _precio1);
			END IF;
			
			-- PRECIO MAXIMO
			IF _precio2 IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and precio1 <= ", _precio2);
			END IF;
		
			 
		
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
		IN 	_idfamilia	INT,
		IN 	_idcategoria	VARCHAR(255),
		IN 	_idmarca	VARCHAR(255),	
		IN  	_precio1	DECIMAL(9,6),
		IN  	_precio2	DECIMAL(9,6),
		IN 	_product	VARCHAR(50)
	)BEGIN
			
		SET @sql = "SELECT cod_categoria,nombre_categoria,COUNT(*)cantidad FROM v_productos where estado_categoria = 0 ";
		
		-- FILTROS
		
		-- ID FAMILIA
		IF _idfamilia IS NOT NULL THEN
			SET  @sql = CONCAT(@sql, " and cod_familia = " ,_idfamilia);
		END IF;
		
		-- PRODIUCTO
		IF _product IS NOT NULL THEN
			SET @sql = CONCAT(@sql, " and nombre_procucto like '","%", _product ,"%","'");
		END IF;
	
		-- MARCAS
		IF _idmarca IS NOT NULL THEN
			SET @sql = CONCAT(@sql, " and cod_marca in(", _idmarca,")" );
		END IF;
		
		-- CATEGORIAS
		IF _idcategoria IS NOT NULL THEN
			SET @sql = CONCAT(@sql, " and cod_categoria  in(", _idcategoria,")" );
		END IF;
		
		-- PRECIO MINIMO
		IF _precio1 IS NOT NULL THEN
			SET @sql = CONCAT(@sql, " and precio1 >= ", _precio1);
		END IF;
		
		-- PRECIO MAXIMO
		IF _precio2 IS NOT NULL THEN
			SET @sql = CONCAT(@sql, " and precio1 <= ", _precio2);
		END IF;	
		
		-- AGRUPAMOS
			SET @sql = CONCAT( @sql," GROUP BY `cod_categoria`,`nombre_categoria` ");
		
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
		IN 	_idfamilia	INT,
		IN 	_idcategoria	VARCHAR(255),
		IN 	_idmarca	VARCHAR(255),	
		IN  	_precio1	DECIMAL(9,6),
		IN  	_precio2	DECIMAL(9,6),
		IN 	_product	VARCHAR(50)
	)BEGIN
		
		
		SET @sql = "SELECT cod_marca,nombre_marca,COUNT(*)cantidad FROM v_productos where estado_marca = 0 ";
		
			-- FAMILIAS
			IF _idfamilia IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and cod_familia = ", _idfamilia );
			END IF;
			
			-- PRODIUCTO
			IF _product IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and nombre_procucto like '","%", _product ,"%","'");
			END IF;
		
			-- MARCAS
			IF _idmarca IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and cod_marca in(", _idmarca,")" );
			END IF;
			
			-- CATEGORIAS
			IF _idcategoria IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and cod_categoria  in(", _idcategoria,")" );
			END IF;
			
			-- PRECIO MINIMO
			IF _precio1 IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and precio1 >= ", _precio1);
			END IF;
			
			-- PRECIO MAXIMO
			IF _precio2 IS NOT NULL THEN
				SET @sql = CONCAT(@sql, " and precio1 <= ", _precio2);
			END IF;
		
		
			-- AGRUPAMOS
			SET @sql = CONCAT(@sql, " GROUP BY cod_marca,nombre_marca" );
		
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
			IN 	_apellidos 	VARCHAR(100),
			IN 	_nombres	VARCHAR(100),
			IN 	_telefono 	INT,
			IN 	_correo		VARCHAR(50),
			IN 	_clave		VARCHAR(50)
		)BEGIN
		
			INSERT INTO usuario (apell_usu,nombr_usu,telef_usu,correo_usu,pass_usu,tipo_usu,estad_usu) VALUES
				(_apellidos,_nombres,_telefono,_correo,_clave,'U','1');
		END $$
		
		
	-- LOGIN USUARIOS
		DELIMITER $$
		CREATE OR REPLACE PROCEDURE sp_usuarios_login
		(
			IN 	_nome_usu	VARCHAR(50),
			IN 	_pass_usu	VARCHAR(50)
		)BEGIN
			
			SELECT cod_usu,apell_usu,nombr_usu,telef_usu,tipo_usu,ruc,razonsocial,direccionfiscal FROM usuario  WHERE correo_usu = _nome_usu AND pass_usu = _pass_usu AND estad_usu = 1;
			
		END $$
	
	-- VERIFICAR CARRITO
		DELIMITER $$
		CREATE OR REPLACE PROCEDURE sp_usuarios_carrito
		(	
			IN 	_idusuario	 INT
		)BEGIN
		
			SELECT COUNT(*) cantidad FROM temp_detalle_venta_carrito WHERE cod_usu = _idusuario;
		END $$
	
	-- MODIFICAR RUC - RAZON SOCIAL - DIRECCION FISCAL
		DELIMITER $$
		CREATE OR REPLACE PROCEDURE sp_usuarios_modificarruc
		(
			IN 	_idusuario		INT,
			IN 	_ruc			VARCHAR(11),
			IN 	_razonsocial		VARCHAR(255),
			IN 	_direccionfiscal	VARCHAR(255)
		)BEGIN
		
			UPDATE usuario SET
			ruc = _ruc,
			razonsocial = _razonsocial,
			direccionfiscal = _direccionfiscal
			WHERE cod_usu = _idusuario;
		
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
			cantidad_detalle = cantidad_detalle + V_cantidad_detalle,
			total_detalle = (cantidad_detalle) * sub_total_detalle
			WHERE cod_producto = v_cod_producto AND cod_usu = v_cod_usu;
		ELSE
		
			-- REGISTRAMOS
			INSERT INTO temp_detalle_venta_carrito (cod_producto,cod_usu,cantidad_detalle,sub_total_detalle,total_detalle) VALUES
				(v_cod_producto,v_cod_usu,v_cantidad_detalle,v_subtotal,v_cantidad_detalle*v_subtotal);
		
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
	
	-- LIMPIAR CARRITO
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_carrito_vaciar
	(
		IN 	_idusuario	INT
	)BEGIN
	
		DELETE FROM temp_detalle_venta_carrito WHERE cod_usu = _idusuario;
	END $$

	-- MODIFICAR CANTDAD
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_carrito_modificar
	(
		-- in 	_idusuario	int,
		-- in 	_idproducto	int,
		IN 	_idcarrito	INT,
		IN 	_cantidad	DECIMAL(9,6)
	)BEGIN
	
		-- select * from temp_detalle_venta_carrito
		UPDATE temp_detalle_venta_carrito SET
		cantidad_detalle = _cantidad,
		total_detalle = cantidad_detalle * sub_total_detalle
		WHERE cod_tmp_venta_carrito = _idcarrito;
		
	END $$

########################
# DIRECCIONES USUARIOS #
########################
	
	-- LISTAR DIRECCIONES DE USUARIOS
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_direcciones_usuarios_listar
	(
		IN 	_idusuario	INT
	)BEGIN
		SELECT * FROM direcciones_usuarios WHERE  cod_usu = _idusuario;
	END $$
		CALL sp_direcciones_usuarios_listar(7)
	-- REGISTRAR DIRECCIONES DE USUARIOS
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_direcciones_usuarios_registrar
	(
		IN 	_idusuario		INT,
		IN 	_iddistrito		INT,
		IN 	_direccion		VARCHAR(250),
		IN 	_nombredireccion	VARCHAR(250),
		IN 	_referencia		VARCHAR(300),
		IN 	_latitud		VARCHAR(300),
		IN 	_longitud		VARCHAR(300)
	)BEGIN
	
		INSERT INTO direcciones_usuarios (cod_usu,cod_distrito,direccion,nombre_direccion,referencia,latitud,longitud) VALUES
			(_idusuario,_iddistrito,_direccion,_nombredireccion,_referencia,_latitud,_longitud);
	END $$
	
#############
# DISTRITOS #
#############
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_distritos_listar()
	BEGIN
		SELECT cod_distrito,nombre_distrito FROM distrito;
	END $$
	
################
# METODOS PAGO #
################
	
	-- LISTA METODOS DE PAGO
	
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_metodopago_listar()
	BEGIN
		SELECT * FROM metodo_pago;
	END $$	
	

#################
# VENTA CARRITO #
#################

	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_venta_carrito_registrar
	(
		IN 	_iddireccionusuario	INT,
		IN 	_idmetodopago		INT,
		IN 	_idcodigohoraio		INT,
		IN 	_idcomprobante		INT
	)BEGIN
		DECLARE v_idusuario INT;
		DECLARE v_idventa INT;
		
		-- OBTENEMOS ID DE USURIO
		SELECT cod_usu INTO v_idusuario FROM direcciones_usuarios  WHERE cod_direcc_usu = _iddireccionusuario;
		
		-- REGISTRAMOS VENTA
		INSERT INTO venta_carrito (cod_direcc_usu,cod_metodo_pago,fecha_creacion,fecha_entrega,cod_comprobante,monto_total_bruto_venta,monto_total_neto_venta,monto_igv_venta,estado_venta,cod_horario) VALUES
		(_iddireccionusuario,_idmetodopago,CURDATE(),NULL,_idcomprobante,0,0,0,1,_idcodigohoraio);
		
		-- OBTENEMOS ID	DE VENTA
		SELECT LAST_INSERT_ID() INTO v_idventa;
		
		-- DESCONTAMOS STOCK
		UPDATE producto pro
		INNER JOIN temp_detalle_venta_carrito tmp ON tmp.cod_producto = pro.cod_producto 
		SET 
			pro.stock_producto = pro.stock_producto - tmp.cantidad_detalle
			WHERE 
			pro.tipo_stock_producto = 'C' AND 
			tmp.cod_usu = v_idusuario;
		
		-- REGISTRAMOS DETALLE VENTA 
		
		INSERT INTO detalle_venta_carrito(cod_venta_carrito,cod_producto,cantidad_detalle,importe_detalle)
		SELECT v_idventa,cod_producto,cantidad_detalle,total_detalle FROM temp_detalle_venta_carrito 
		WHERE cod_usu = v_idusuario;
		
		-- ELIMINAMOS TEMPORAL
		DELETE FROM temp_detalle_venta_carrito WHERE cod_usu = v_idusuario;
		
	END $$

	
	SELECT * FROM venta_carrito
	SELECT * FROM metodo_pago
	
		
############
# HORARIOS #
############

	-- LISTAR
	DELIMITER $$
	CREATE OR REPLACE PROCEDURE sp_horarios_listar
	(
		IN 	_idempresa 	INT
	)BEGIN
	
		SELECT cod_horario,cod_tienda,nombre_horario,hora_ini,hora_fin FROM horario WHERE estado_horario = '1' AND cod_tienda = _idempresa;
	END $$
	
################
# COMPROBANTES #
################

	-- LISTAR
	DELIMITER $$ 
	CREATE OR REPLACE PROCEDURE sp_comprobantes_listar()	
	BEGIN
		SELECT cod_comprobante,tipo_comprobante,req_ruc	 FROM comprobante WHERE  estado_comprobante = '1' ORDER BY 1 ASC;
	END $$
	
	
	CALL sp_comprobantes_listar


	DESCRIBE temp_detalle_venta_carrito
	SELECT * FROM temp_detalle_venta_carrito
	SELECT * FROM usuario
	SELECT * FROM venta_carrito
	DESCRIBE producto
	ALTER TABLE producto MODIFY precio_producto DECIMAL(6,2)
	

