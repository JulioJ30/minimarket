<?php

    require_once '../core/model.master.php';
    

    class ComprobantesModelo extends ModelMaster{
        
        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function Listar(){
            try{

                $comando = $this->pdo->prepare("call sp_comprobantes_listar");
                $comando->execute(
                    
                );

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>