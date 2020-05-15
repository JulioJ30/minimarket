<?php

    require_once '../model/entidad/direccionesusuarios.entidad.php';
    require_once '../model/modelo/direccionesusuarios.modelo.php';

    $objDireccionesUsuariosM = new DireccionesUsuariosModelo();
    $objDireccionesUsuariosE = new DireccionesUsuarios();


    if(isset($_GET["operacion"])){

        session_start();


        if($_GET["operacion"] == "getdirecciones"){

            $cod = isset($_SESSION["cod_usuminimarket"]) ? $_SESSION["cod_usuminimarket"] : 0;
            $data =$objDireccionesUsuariosM->getDirecciones($cod);

            $direccion = "";
            $direccionprincipal = "";
            $cont = 0;
            $nombredireccioncompleta = "";

            foreach($data as $fila){
                
                if($cont == 0){
                    $direccionprincipal = "<input type='radio' class='direcregistrar' name='direc' data-id='{$fila->cod_direcc_usu}' data-direc='{$fila->direccion}' checked>  {$fila->nombre_direccion}    <br>";
                    $nombredireccioncompleta = $fila->direccion;
                }else{
                    $direccion .= "<input type='radio' class='direcregistrar' name='direc' data-id='{$fila->cod_direcc_usu}' data-direc='{$fila->direccion}' > {$fila->nombre_direccion} <br>";
                }

                $cont++;
            }

            echo json_encode(array("principal"=>$direccionprincipal,"normal"=>$direccion,"nombredireccioncompleta"=>$nombredireccioncompleta));

        }

        if($_GET["operacion"] == "registrar"){


                $objDireccionesUsuariosE->__SET("cod_usu",          $_SESSION["cod_usuminimarket"]);
                $objDireccionesUsuariosE->__SET("cod_distrito",     $_GET["iddireccion"]);
                $objDireccionesUsuariosE->__SET("direccion",        $_GET["direccion"]);
                $objDireccionesUsuariosE->__SET("nombre_direccion", $_GET["nombre_direccion"]);
                $objDireccionesUsuariosE->__SET("referencia",       $_GET["referencia"]);
                $objDireccionesUsuariosE->__SET("latitud",          null);
                $objDireccionesUsuariosE->__SET("longitud",         null);

                $objDireccionesUsuariosM->RegistrarDirecciones($objDireccionesUsuariosE);

        }

    }

?>