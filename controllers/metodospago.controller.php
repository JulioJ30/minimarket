<?php


    require_once '../model/modelo/metodospagos.modelo.php';

    $objMetodosPago = new MetodosPagosModelo();


    if(isset($_GET["operacion"])){


        if($_GET["operacion"] == "getmetodos"){


            $data =$objMetodosPago->getMetodos();

            foreach($data as $fila){
                echo "<option value='{$fila->cod_metodo_pago}'>{$fila->nombre_metodo_pago}</option>";
            }


        }

    }

?>