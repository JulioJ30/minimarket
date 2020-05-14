<?php

    require_once '../model/modelo/productos.modelo.php';

    $objProductosModelo = new ProductosModelo();

    if(isset($_GET["operacion"])){

        //LISTAR POR IDE DE FAMILIA
        if($_GET["operacion"] == 'listarxfamilia'){


            //PARAMETROS
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


            $data = $objProductosModelo->ListarporFamilia($idfamilia,$idcategoria,$idmarca,$precio1,$precio2,$product);

            // echo json_encode($data);
            foreach($data as $fila){

                $imagen = $fila->ruta_imagen_catalogo != null ? $fila->ruta_imagen_catalogo : 'public/vacio.png';

                echo "<div class='col-md-3 col-xs-6'>";
                echo "  <div class='product'>";
                echo "      <a href='product.php?id={$fila->cod_producto}'>     ";                       
                echo "          <div class='product-img'>";
                echo "              <img src='{$imagen}' alt=''>";
                echo "          </div>";
                echo "          <div class='product-body'>";
                echo "              <p class='product-category'>{$fila->nombre_categoria}</p>";
                echo "              <h3 class='product-name'><a href='#'>{$fila->nombre_procucto}</a></h3>";
                echo "              <h5 class='product-category'><a href='#'>{$fila->descripcion_producto}</a></h5>";
                echo "              <h4 class='product-price'> S/.{$fila->precio1} <del class='product-old-price'> S/.{$fila->precio2}</del></h4>";
                echo "          </div>";
                echo "          <div class='add-to-cart'>";
                echo "              <button class='add-to-cart-btn' data-id='{$fila->cod_producto}' data-nombre='{$fila->nombre_procucto}' data-descripcion='{$fila->descripcion_producto}'  data-categoria='{$fila->nombre_categoria}' data-imagen='{$imagen}' data-precio='{$fila->precio1}'  ><i class='fa fa-shopping-cart'></i> agregar al carrito</button>";
                echo "          </div>";
                echo "      </a>";
                echo "  </div>";
                echo "</div>";
            }


        }


        //GET PRODUCTO
        if($_GET["operacion"] == "getproducto"){


            $data = $objProductosModelo->getProducto($_GET["idproducto"]);

            echo json_encode($data);

        }


        //GET PRODUCTO IMAGENES
        if($_GET["operacion"] == "getproductoimagenes"){


            $data = $objProductosModelo->getProductoImagenes($_GET["idproducto"]);


           
            foreach($data as $fila){

                $img = $fila->img == null ? "public/vacio.png" : $fila->img;

                echo "<div class='product-preview'>";
                echo "    <img src='{$img}' alt=''>";
                echo "</div>";
            }
            
        
        }
        // LISTAR PRODUCTO SUGERIDOS
        if($_GET["operacion"] == 'listarsugeridos'){


            $data = $objProductosModelo->getProductoSugeridos();

            // echo json_encode($data);
            foreach($data as $fila){

                $imagen = $fila->ruta_imagen_catalogo != null ? $fila->ruta_imagen_catalogo : 'public/vacio.png';

             
                echo "  <div class='product'>";
                echo "      <a href='product.php?id={$fila->cod_producto}'>     ";                       
                echo "          <div class='product-img'>";
                echo "              <img src='{$imagen}' alt=''>";
                echo "          </div>";
                echo "          <div class='product-body'>";
                echo "              <p class='product-category'>{$fila->nombre_categoria}</p>";
                echo "              <h3 class='product-name'><a href='#'>{$fila->nombre_procucto}</a></h3>";
                echo "              <h5 class='product-category'><a href='#'>{$fila->descripcion_producto}</a></h5>";
                echo "              <h4 class='product-price'> S/.{$fila->precio1} <del class='product-old-price'> S/.{$fila->precio2}</del></h4>";
                echo "          </div>";
                echo "          <div class='add-to-cart'>";
                echo "              <button  class='add-to-cart-btn' data-id='{$fila->cod_producto}' data-nombre='{$fila->nombre_procucto}' data-descripcion='{$fila->descripcion_producto}'  data-categoria='{$fila->nombre_categoria}' data-imagen='{$imagen}' data-precio='{$fila->precio1}'  ><i class='fa fa-shopping-cart'></i> agregar al carrito</button>";
                echo "          </div>";
                echo "      </a>";
                echo "  </div>";
             
            }

        }

    }


?>