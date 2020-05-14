<?php

    require_once '../core/model.master.php';

    class MetodosPagosModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function getMetodos(){
            try{

                $comando = $this->pdo->prepare("call sp_metodopago_listar ");
                $comando->execute();

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>