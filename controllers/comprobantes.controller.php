<?php

    require_once '../model/modelo/comprobantes.modelo.php';

    $objComprobantesM = new ComprobantesModelo();

    if(isset($_GET["operacion"])){

        if($_GET["operacion"] == "getComprobantes"){

            $datos = $objComprobantesM->Listar();

            foreach($datos as $fila){
                if($fila->tipo_comprobante == "BOLETA"){
                    echo "<input type='radio' class='comprobantesregistrar' name='comprobantes' data-tipo='{$fila->tipo_comprobante}' data-req='{$fila->req_ruc}' data-id='{$fila->cod_comprobante}' checked>{$fila->tipo_comprobante}<br>";
                }else{
                    echo "<input type='radio' class='comprobantesregistrar' name='comprobantes' data-tipo='{$fila->tipo_comprobante}'  data-req='{$fila->req_ruc}' data-id='{$fila->cod_comprobante}'>{$fila->tipo_comprobante}<br>";
                }
            }

        }

    }


?>