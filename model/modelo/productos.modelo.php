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

        // GET PRODUCTOS
        function getProducto($idproducto){
            try{

                $comando = $this->pdo->prepare("call sp_productos_obtener(?)");
                $comando->execute(
                    array(
                        $idproducto
                    )
                );

                return $comando->fetch(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        //LISTAR IMAGENES DE LOS PRODUCTOS
        function getProductoImagenes($idproducto){
            try{

                $comando = $this->pdo->prepare("call sp_get_imagenesproductos(?)");
                $comando->execute(
                    array(
                        $idproducto
                    )
                );

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        //LISTAR PRODUCTO SUGERIDOS
        function getProductoSugeridos(){
            try{

                $comando = $this->pdo->prepare("call sp_productosugerido_listar");
                $comando->execute(
                    
                );

                return $comando->fetchAll(PDO::FETCH_OBJ);

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        

    }


?>