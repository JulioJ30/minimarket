<?php


    require_once '../model/modelo/metodospagos.modelo.php';

    $objMetodosPago = new MetodosPagosModelo();


    if(isset($_GET["operacion"])){


        if($_GET["operacion"] == "getmetodos"){


            $data =$objMetodosPago->getMetodos();

            foreach($data as $fila){
                // echo "<option value='{$fila->cod_metodo_pago}'>{$fila->nombre_metodo_pago}</option>";

                echo "<label>";
                if($fila->cod_metodo_pago == 1){
                    echo "<input type='radio' name='test' value='small' data-id='{$fila->cod_metodo_pago}' class='radiometodos' checked>";
                }else{
                    echo "<input type='radio' name='test' value='small' data-id='{$fila->cod_metodo_pago}' class='radiometodos'>";
                }
                echo "<img src='{$fila->ruta_imagen_metodo_pago}' style='width:50px;margin-left:10px;margin-right:10px;'>";
                echo "</label>";

            }


        }

    }

?>