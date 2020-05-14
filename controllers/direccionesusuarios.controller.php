<?php


    require_once '../model/modelo/direccionesusuarios.modelo.php';

    $objDireccionesUsuarios = new DireccionesUsuariosModelo();


    if(isset($_GET["operacion"])){


        if($_GET["operacion"] == "getdirecciones"){

            session_start();
            $cod = isset($_SESSION["cod_usuminimarket"]) ? $_SESSION["cod_usuminimarket"] : 0;
            $data =$objDireccionesUsuarios->getDirecciones($cod);

            foreach($data as $fila){
                echo "<option value='{$fila->cod_direcc_usu}'>{$fila->referencia}</option>";
            }


        }

    }

?>