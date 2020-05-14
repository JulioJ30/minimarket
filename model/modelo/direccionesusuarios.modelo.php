<?php

    require_once '../core/model.master.php';

    class DireccionesUsuariosModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function getDirecciones($idusuario){
            try{

                $comando = $this->pdo->prepare("call sp_direcciones_usuarios_listar (?) ");
                $comando->execute(
                    array(
                        $idusuario
                    )
                );

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>