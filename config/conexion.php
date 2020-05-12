<?php

    class Conexion{

        private $host       =   "localhost";
        private $dbname     =   "bd_market";
        private $user       =   "root";
        private $pass       =   "root";
        private $charset    =   "utf8";

        public function Conectar(){
            try{
                $cn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";charset=".$this->charset,$this->user,$this->pass);
                return $cn;
            }catch(Exception $e){
                die($e->getMessage());
            }
            
        }

    }

?>