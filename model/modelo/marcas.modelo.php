<?php

    require_once '../core/model.master.php';

    class MarcasModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function ListarxFamilia($idfamilia,$product){
            try{

                $comando = $this->pdo->prepare("call sp_marcasfamilia_listar(?,?)");
                $comando->execute(
                    array(
                        $idfamilia,$product
                    )
                );

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>