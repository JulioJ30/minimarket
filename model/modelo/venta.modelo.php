<?php

    require_once '../core/model.master.php';

    class VentasModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function Registrar($iddireccion,$idmetodopago,$idcodigohorario,$idcomprobante){
            try{

                $comando = $this->pdo->prepare("call sp_venta_carrito_registrar(?,?,?,?)");
                $comando->execute(
                    array(
                        $iddireccion,$idmetodopago,$idcodigohorario,$idcomprobante
                    )
                );

                // return $comando->fetch(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>