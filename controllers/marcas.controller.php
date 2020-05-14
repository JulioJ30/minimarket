<?php

    require_once '../model/modelo/marcas.modelo.php';

    $objMarcasM = new MarcasModelo();

    if(isset($_GET["operacion"])){

        if($_GET["operacion"] == "listarxfamilia"){

            $idfamilia = isset($_GET["idfamilia"]) ? $_GET["idfamilia"] : null;
            $product = isset($_GET["product"]) ? $_GET["product"] : null;


            $idfamilia      = $idfamilia != 0 ? $_GET["idfamilia"] : null;
            $product        = $product != "" ? $product : null;

            $datos = $objMarcasM->ListarxFamilia($idfamilia,$product);

            // echo json_encode($datos);
            foreach($datos as $fila){

                
                echo "<div class='input-checkbox'>";
                echo "  <input type='checkbox' id='marcas-{$fila->cod_marca}' class='marcasfiltro' data-id='{$fila->cod_marca}'>";
                echo "      <label for='marcas-{$fila->cod_marca}'>";
                echo "          <span></span>";
                echo "              {$fila->nombre_marca}";
                echo "          <small>({$fila->cantidad})</small>";
                echo "      </label>";
                echo "</div>";

            }

        }

    }


?>