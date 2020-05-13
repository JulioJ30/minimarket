<?php

    require_once '../core/model.master.php';

    class BannerModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function getBanner(){
            try{

                $comando = $this->pdo->prepare("call sp_get_banner ");
                $comando->execute();

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>