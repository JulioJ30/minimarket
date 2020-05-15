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

            foreach($data as $fila){
                // echo "<option value='{$fila->cod_direcc_usu}'>{$fila->referencia}</option>";
                echo "<input type='radio' class='direcregistrar' name='direc' data-id='{$fila->cod_direcc_usu}'> {$fila->nombre_direccion} <br>";


                // echo "<div class='input-group'>";
                // echo "<div class='input-group-prepend'>";
                // echo "<div class='input-group-text'>";
                // echo "<input type='radio' name='direc' data-id='{$fila->cod_direcc_usu}'>";
                // echo "                        </div>";
                // echo "</div>";
                //     // <input type="text" class="form-control" aria-label="Text input with radio button">
                //     echo "<label for=''>{$fila->nombre_direccion}</label>";
                //     echo "</div>";
            }

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