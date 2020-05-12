<?php

    require_once '../config/conexion.php';

    class ModelMaster{

        public function getConexion(){

            try{

                $objConexion = new Conexion();
                $pdo = $objConexion->Conectar();
    
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return $pdo;

            }catch(Exception $e){
                die($e->getMessage());
            }

        }

    }



?>