<?php

    require_once '../core/model.master.php';

    class CarritoModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }


        // REGISTRAMOS EN LA TABLA TEMPORAL

        function RegistrarTMP($idproducto,$idusuario,$cantidad,$precio){


            $comando = $this->pdo->prepare("call sp_setinserta_temp_carrito (?,?,?,?)");
            $comando->execute(
                array(
                    $idproducto,$idusuario,$cantidad,$precio
                )
            );
        }

        //LISTAR TABLA TEMPORAL
        function getCarrito($idusuario){


            $comando = $this->pdo->prepare("call sp_carrito_listar (?)");
            $comando->execute(
                array(
                    $idusuario
                )
            );

            return $comando->fetchAll(PDO::FETCH_OBJ);
        }

        //ELIMINAR TEMPORAL
        function Eliminar($idcarrito){


            $comando = $this->pdo->prepare("call sp_carrito_elimimar (?)");
            $comando->execute(
                array(
                    $idcarrito
                )
            );

        }

        
        


        //REGISTRAMOS EN LA SESSION
        


    }


?>