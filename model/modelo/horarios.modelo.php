<?php

    require_once '../core/model.master.php';
    

    class HorariosModelo extends ModelMaster{
        
        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function Listar($idempresa){
            try{

                $comando = $this->pdo->prepare("call sp_horarios_listar(?)");
                $comando->execute(
                    array(
                        $idempresa
                    )
                );

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>