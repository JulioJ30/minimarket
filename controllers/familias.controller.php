<?php

    require_once '../model/modelo/familias.modelo.php';


    $objFamiliasM = new FamiliasModelo();


    if(isset($_GET["operacion"])){

        if($_GET["operacion"] == "listar"){

            $datos = $objFamiliasM->Listar();

            // var_dump($datos);

            // echo json_encode($datos);
            echo "<li class='active listafamilias' id='familiahome'><a href='index.php'>Home</a></li>";
        
            foreach($datos as $fila){
                echo "<li id='familia{$fila->cod_familia}' class='listafamilias'>";
                echo "  <a href='store.php?id={$fila->cod_familia}'> {$fila->nombre_familia}  </a>";
                echo "</li>";
            }

        }

        if($_GET["operacion"] == "listarcombo"){

            $datos = $objFamiliasM->Listar();

            // echo json_encode($datos);
            echo "<option value='0'>Todas</option>";
            
            foreach($datos as $fila){
                echo "<option value='{$fila->cod_familia}'> {$fila->nombre_familia}</option>";
            }

        }

    }

  

?>