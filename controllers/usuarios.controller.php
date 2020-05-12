<?php


    // METODOS POST
    if(isset($_POST["operacion"])){
        
        //LOGIN 
        if($_POST["operacion"] == "login"){
            session_start();

            $usuario = $_POST["usuario"];
            $clave = $_POST["usuario"];


            $_SESSION["loginminimarket"]    = true;

            echo json_encode(array("success"=>true));
        }


    }


    // METODOS GET
    if(isset($_GET["operacion"])){

        // CERRAR SESION
        if($_GET["operacion"] == "logoff"){
            session_start();
            session_unset();
            session_destroy();

            header("location: ../index.php");
        }

    }


?>