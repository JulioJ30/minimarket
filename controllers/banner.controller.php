<?php

    require_once '../model/modelo/banner.modelo.php';

    $objBannerM = new BannerModelo();

    if(isset($_GET["operacion"])){

        if($_GET["operacion"] == "getbanner"){

            $datos = $objBannerM->getBanner();


            // echo json_encode($datos);
            $rpt1 = "";
            $rpt2 = "";
            $cont = 0;

            foreach($datos as $fila){

                if($cont == 0){
                    $rpt2 .= "<div class='item active'>";
					$rpt1 .= "<li data-target='#myCarousel' data-slide-to='{$cont}' class='active'></li>";

                }else{
                    $rpt2 .= "<div class='item'>";
					$rpt1 .= "<li data-target='#myCarousel' data-slide-to='{$cont}' ></li>";
                }

                $rpt2 .= "   <img src='{$fila->ruta_banner}' alt='' style='width:100%;'>";
                $rpt2 .= "   <div class='carousel-caption'>";
                $rpt2 .= "       <h3 style='color:white'>{$fila->nombre_banner}</h3>";
                // $rp1 .= "<p>LA is always so much fun!</p>";
                $rpt2 .= "   </div>";
                $rpt2 .= "</div>";
                $cont++;

            }

            echo json_encode(array("li"=>$rpt1,"contenido"=>$rpt2));

            

        }

    }

?>