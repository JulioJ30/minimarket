<?php

    require_once '../core/model.master.php';

    class UsuariosModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        //LOGIN
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

        //CANTIDAD CARRITO POR USUARIO
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

        //REGISTRAR USUARIO
        function Registrar(Usuarios $usuarios){
            try{

                $comando = $this->pdo->prepare("call sp_usuarios_registrar(?,?,?,?,?)");
                $comando->execute(
                    array(
                       $usuarios->__GET('apell_usu'),
                       $usuarios->__GET('nombr_usu'),
                       $usuarios->__GET('telef_usu'),
                       $usuarios->__GET('correo_usu'),
                       $usuarios->__GET('pass_usu')
                    )
                );

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }


?>