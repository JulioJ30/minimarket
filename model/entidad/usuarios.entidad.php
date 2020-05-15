<?php

    class Usuarios{

        private $cod_usu;
        private $apell_usu;
        private $nombr_usu;
        private $telef_usu;
        private $correo_usu;
        private $pass_usu;
        private $tipo_usu;
        private $estad_usu;


        public function __GET($campo){
            return $this->$campo;
        }

        public function __SET($campo,$valor){
            $this->$campo = $valor;
        }

    }

?>