<?php

    class Carrito{

        public $cod_tmp_venta_carrito;
        public $cod_producto;
        public $cod_usu;
        public $cantidad_detalle;
        public $total_detalle;


        //FOREGINS
        public $nombre_producto;
        public $descripcion_producto;
        public $observacion_producto;
        public $nombre_categoria;
        public $nombre_familia;
        public $nombre_marca;
        public $precio_producto;
        public $importe;
        public $sub_total_detalle;
        public $ruta_imagen_catalogo;
        public $precio1;



        public function __GET($campo){
            return $this->$campo;
        }

        public function __SET($campo,$valor){
            $this->$campo = $valor;
        }






    }



?>