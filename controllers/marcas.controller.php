<?php

    require_once '../model/modelo/marcas.modelo.php';

    $objMarcasM = new MarcasModelo();

    if(isset($_GET["operacion"])){

        if($_GET["operacion"] == "listarxfamilia"){

            $idfamilia = isset($_GET["idfamilia"]) ? $_GET["idfamilia"] : null ;
            $idcategoria = isset($_GET["idcategoria"]) ? $_GET["idcategoria"] : null;
            $idmarca = isset($_GET["idmarca"]) ? $_GET["idmarca"] : null;
            $precio1 = isset($_GET["precio1"]) ? $_GET["precio1"] : null;
            $precio2 = isset($_GET["precio2"]) ? $_GET["precio2"] : null;
            $product = isset($_GET["product"]) ? $_GET["product"] : null;


            $idfamilia      = $idfamilia == 0 ? null : $idfamilia;
            $idcategoria    = $idcategoria != "" ? $idcategoria : null;
            $idmarca        = $idmarca != "" ? $idmarca : null;
            $precio1        = $precio1 != "" ? $precio1 : null;
            $precio2        = $precio2 != "" ? $precio2 : null;
            $product        = $product != "" ? $product : null;

            $datos = $objMarcasM->ListarxFamilia($idfamilia,$idcategoria,$idmarca,$precio1,$precio2,$product);

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