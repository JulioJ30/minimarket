<?php
    require_once '../model/entidad/carrito.entidad.php';
    require_once '../model/modelo/carrito.modelo.php';

    $objCarritoM = new CarritoModelo();
    $objCarritoE = new Carrito();

    if(isset($_GET["operacion"])){

        //INICIAOMOS SESION
        session_start();

            if(!isset($_SESSION["loginminimarket"])){

                #region TEMPORAL DE SESION

                    //AGREGAR
                    if($_GET["operacion"] == "agregarcarrito"){

                        
                        //$_SESSION["cantidadcarrito"] = count($_SESSION["tmpcarrito"]);

                        $indice = -1;
                        $cantanterior = 0;
                        $indice2 = 0;
                        //BUSCAMOS INDICE REPETIDO
                        foreach($_SESSION["tmpcarrito"] as $fila){
                            // echo $fila->cod_producto;
                            
                            if($fila->cod_producto ==  $_GET["idproducto"]){  
                                // $indice = key($_SESSION["tmpcarrito"]);
                                $indice = $indice2;

                                break;
                            }
                            $indice2++;
                        }

                        

                        if($indice >=0){
                            
                            //OBTENEMOS LA CANTIDAD ANTERIOR DEL PRODCUCTO
                            $cantanterior = $_SESSION["tmpcarrito"][$indice]->cantidad_detalle;
                            //REMOVEMOS ANTERIOR
                            array_splice($_SESSION["tmpcarrito"],$indice,1);
                            
                        }
                        

                        // //AGREGAMOS NUEVO

                        //AGREGAMOS
                        $objCarritoE->__SET("cod_producto",         $_GET["idproducto"]);
                        $objCarritoE->__SET("cantidad_detalle",     $_GET["cantidad"] + $cantanterior);
                        $objCarritoE->__SET("nombre_producto",      $_GET["nombre_producto"]);
                        $objCarritoE->__SET("descripcion_producto", $_GET["descripcion_producto"]);
                        $objCarritoE->__SET("nombre_categoria",     $_GET["nombre_categoria"]);
                        $objCarritoE->__SET("precio1",              $_GET["precio1"]);
                        $objCarritoE->__SET("ruta_imagen_catalogo", $_GET["ruta_imagen_catalogo"]);
                        
                    
                        $_SESSION["tmpcarrito"][] = $objCarritoE;



                        // var_dump($_SESSION["tmpcarrito"]);
                    }

                    //ELIMINAR
                    if($_GET["operacion"] == "eliminaritem"){
                        array_splice($_SESSION["tmpcarrito"],$_GET["id"],1);
                    }

                    //MOSTAR CARRITO EN TODAS LAS VISTAS
                    if($_GET["operacion"] == "getcarrito"){
                       
                        $cart_list = "";
                        $cont = 0;

                        if(isset($_SESSION["tmpcarrito"])){

                            $cart_list .= "<div class='cart-list'>";
                            // $cont = 0;
                            $subttotal = 0;
                            foreach($_SESSION["tmpcarrito"] as $fila){
                                
                                //PRECIO POR CANTIDA
                                $preciocant =$fila->cantidad_detalle * $fila->precio1;

                                $cart_list .= "<div class='product-widget'>";
                                $cart_list .= " <div class='product-img'>";
                                $cart_list .= "     <img src='{$fila->ruta_imagen_catalogo}' alt=''>";
                                $cart_list .= " </div>";
                                $cart_list .= " <div class='product-body'>";
                                $cart_list .= "     <h3 class='product-name'><a href='#'>{$fila->nombre_producto}</a></h3>";
                                $cart_list .= "     <h4 class='product-price'><span class='qty'>{$fila->cantidad_detalle} x</span>S/. {$fila->precio1}</h4>";
                                $cart_list .= " </div>";
                                $cart_list .= " <a class='delete' href='#' data-id='{$cont}'><i class='fas fa-trash'></i></a>";
                                $cart_list .= "</div> ";

                                $subttotal += $preciocant;
                                $cont++;


                            }
                            //CERRAMOS
                            $cart_list .= "</div> ";


                            //INFORMACION
                            $cart_list .= "<div class='cart-summary'>";
                            $cart_list .= "  <small>{$cont} Item(s)</small>";
                            $cart_list .= "  <h5>SUBTOTAL: S/. {$subttotal}</h5>";
                            $cart_list .= "</div>";
                            $cart_list .= "<div class='cart-btns'>";
                            $cart_list .= "  <a href='carrito.php'>Ver Carrito</a>";
                            $cart_list .= "  <a href='#' id='btnCheckout'>Comprar<i class='fa fa-arrow-circle-right'></i></a>";
                            $cart_list .= "</div>";

                        }

                        echo json_encode(array("contenido"=>$cart_list,"cantidad"=>$cont));
                    }




                #endregion

            }else{


                #region TEMPORAL FISICO

                    //AGREGAR
                    if($_GET["operacion"] == "agregarcarrito"){
                        $objCarritoM->RegistrarTMP($_GET["idproducto"],$_SESSION["cod_usuminimarket"],$_GET["cantidad"],$_GET["precio1"]);
                    }

                    //ELIMINAR
                    if($_GET["operacion"] == "eliminaritem"){
                        $objCarritoM->Eliminar($_GET["id"]);
                    }

                    //MOSTRAR CARRITO
                    if($_GET["operacion"] == "getcarrito"){
                       
                        $cart_list = "";
                        // $cont = 0;
                        
                        $data = $objCarritoM->getCarrito($_SESSION["cod_usuminimarket"]);
                        
                        // var_dump($data);
                            $cart_list .= "<div class='cart-list'>";
                            $cont = 0;
                            $subttotal = 0;
                            foreach($data as $fila){
                                
                                //PRECIO POR CANTIDA
                                $preciocant =$fila->cantidad_detalle * $fila->precio1;

                                $cart_list .= "<div class='product-widget'>";
                                $cart_list .= " <div class='product-img'>";
                                $cart_list .= "     <img src='{$fila->ruta_imagen_catalogo}' alt=''>";
                                $cart_list .= " </div>";
                                $cart_list .= " <div class='product-body'>";
                                $cart_list .= "     <h3 class='product-name'><a href='#'>{$fila->nombre_procucto}</a></h3>";
                                $cart_list .= "     <h4 class='product-price'><span class='qty'>{$fila->cantidad_detalle} x</span>S/. {$fila->precio1}</h4>";
                                $cart_list .= " </div>";
                                $cart_list .= " <a class='delete' href='#' data-id='{$fila->cod_tmp_venta_carrito}'><i class='fas fa-trash'></i></a>";
                                $cart_list .= "</div> ";

                                $subttotal += $preciocant;
                              
                                $cont++;

                            }
                            //CERRAMOS
                            $cart_list .= "</div> ";


                            //INFORMACION
                            $cart_list .= "<div class='cart-summary'>";
                            $cart_list .= "  <small>{$cont} Item(s)</small>";
                            $cart_list .= "  <h5>SUBTOTAL: S/. {$subttotal}</h5>";
                            $cart_list .= "</div>";
                            $cart_list .= "<div class='cart-btns'>";
                            $cart_list .= "  <a href='carrito.php'>Ver Carrito</a>";
                            $cart_list .= "  <a href='#' id='btnCheckout'>Comprar<i class='fa fa-arrow-circle-right'></i></a>";
                            $cart_list .= "</div>";

                        

                        echo json_encode(array("contenido"=>$cart_list,"cantidad"=>$cont));
                    }

                #endregion


            }

            


           


    }



?>