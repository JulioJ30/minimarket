<?php

    require_once '../core/model.master.php';

    class DireccionesUsuariosModelo extends ModelMaster{

        private $pdo;

        function __construct()
        {
            $this->pdo = parent::getConexion();
        }

        //OBTENER LAS DIRECCIONES SEGUN USUARIO
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


        // REGISTRAR DIRECCIONES
        function RegistrarDirecciones(DireccionesUsuarios $direcciones){
            try{

                $comando = $this->pdo->prepare("call sp_direcciones_usuarios_registrar (?,?,?,?,?,?,?) ");
                $comando->execute(
                    array(
                        $direcciones->__GET("cod_usu"),
                        $direcciones->__GET("cod_distrito"),
                        $direcciones->__GET("direccion"),
                        $direcciones->__GET("nombre_direccion"),
                        $direcciones->__GET("referencia"),
                        $direcciones->__GET("latitud"),
                        $direcciones->__GET("longitud")
                    )
                );

                // return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }


    }


?>