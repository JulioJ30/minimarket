<?php

    require_once '../core/model.master.php';

    class ProductosModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function ListarporFamilia($idfamilia,$idcategoria,$idmarca,$precio1,$precio2,$product){
            try{

                $comando = $this->pdo->prepare("call sp_productosfamilia_listar(?,?,?,?,?,?)");
                $comando->execute(
                    array(
                        $idfamilia,$idcategoria,$idmarca,$precio1,$precio2,$product
                    )
                );

                return $comando->fetchAll(PDO::FETCH_OBJ);

            


            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>