<?php

    require_once '../model/modelo/horarios.modelo.php';

    $objHorariosM = new HorariosModelo();

    if(isset($_GET["operacion"])){

        if($_GET["operacion"] == "getHorarios"){

            $datos = $objHorariosM->Listar(1);

            foreach($datos as $fila){
                echo "<input type='radio' class='horarioregistrar' name='horario' data-id='{$fila->cod_horario}'>{$fila->nombre_horario} de {$fila->hora_ini} hasta {$fila->hora_fin} <br>";
            }

        }

    }


?>