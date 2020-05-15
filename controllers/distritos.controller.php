<?php

    require_once '../model/modelo/distritos.modelo.php';

    $objDistritoM = new DistritosModelo();

    if(isset($_GET["operacion"])){

        if($_GET["operacion"] == "listar"){

            $datos = $objDistritoM->Listar();

            // echo json_encode($datos);
            echo "<option value='0' > [SELECCIONE] </option>";

            foreach($datos as $fila){
                echo "<option value='{$fila->cod_distrito}' >{$fila->nombre_distrito} </option>";
            }

        }

    }


?>