<?php

    require_once '../core/model.master.php';

    class UsuariosModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        function Login($usuario,$clave){
            try{

                $comando = $this->pdo->prepare("call sp_usuarios_login(?,?)");
                $comando->execute(
                    array(
                        $usuario,$clave
                    )
                );

                return $comando->fetch(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        function CantidadCarrito($idusuario){
            try{

                $comando = $this->pdo->prepare("call sp_usuarios_carrito(?)");
                $comando->execute(
                    array(
                        $idusuario
                    )
                );

                return $comando->fetch(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>