<?php

    require_once '../model/modelo/categorias.modelo.php';

    $objCategoriasM = new CategoriasModelo();

    if(isset($_GET["operacion"])){

        if($_GET["operacion"] == "listarcategoriascant"){

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



            $datos = $objCategoriasM->ListarCategoriasCant($idfamilia,$idcategoria,$idmarca,$precio1,$precio2,$product);

            //echo json_encode($datos);
            foreach($datos as $fila){

                
                echo "<div class='input-checkbox'>";
                echo "  <input type='checkbox' id='category-{$fila->cod_categoria}'  class='categoriasfiltro' data-id='{$fila->cod_categoria}'>";
                echo "      <label for='category-{$fila->cod_categoria}'>";
                echo "          <span></span>";
                echo "              {$fila->nombre_categoria}";
                echo "          <small>({$fila->cantidad})</small>";
                echo "      </label>";
                echo "</div>";

            }

            

        }

    }

?>