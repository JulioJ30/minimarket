<?php

    class DireccionesUsuarios{

        private $cod_direcc_usu;
        private $cod_usu;
        private $cod_distrito;
        private $direccion;
        private $nombre_direccion;
        private $referencia;
        private $latitud;
        private $longitud;


        public function __GET($campo){
            return $this->$campo;
        }

        public function __SET($campo,$valor){
            $this->$campo = $valor;
        }

    }

?>