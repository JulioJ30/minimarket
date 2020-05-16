<?php

    require_once '../model/modelo/venta.modelo.php';

    $objVentaM = new VentasModelo();
    session_start();

    if(isset($_GET["operacion"]) && isset($_SESSION["cod_usuminimarket"])){

        if($_GET["operacion"] == "registrar"){

            $objVentaM->Registrar($_GET["iddireccion"],$_GET["idmetodopago"],$_GET["idcodigohorario"],$_GET["idcomprobante"],$_GET["subtotal"],$_GET["total"],$_GET["igv"]);
            
        }

    }

?>