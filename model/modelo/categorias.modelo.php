<?php

    require_once '../core/model.master.php';

    class CategoriasModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function ListarCategoriasCant($idfamilia){
            try{

                $comando = $this->pdo->prepare("call SP_LISTA_CATEGORIA_FAMILIA_CANT (?)");
                $comando->execute(
                    array(
                        $idfamilia
                    )
                );

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>