<?php
    require_once '../model/entidad/carrito.entidad.php';
    require_once '../model/entidad/usuarios.entidad.php';
    require_once '../model/modelo/usuarios.modelo.php';
    require_once '../model/modelo/carrito.modelo.php';

    $objUsuariosM = new UsuariosModelo();
    $objCarritoM = new CarritoModelo();
    $objUsuariosE = new Usuarios();

    // METODOS POST
    if(isset($_POST["operacion"])){
        
        //LOGIN 
        if($_POST["operacion"] == "login"){


            $usuario = $_POST["usuario"];
            //METODO DE ENCRIPTACION
            $clave   = sha1("##2".$_POST["clave"]."##3");

            $data = $objUsuariosM->Login($usuario,$clave);

            if($data != false){

                $data = json_encode($data);

                session_start();

                // VARIABLES DE SESION
                $_SESSION["loginminimarket"]                = true;
                $_SESSION["cod_usuminimarket"]              = json_decode($data)->{"cod_usu"};
                $_SESSION["nombre_usuminimarket"]           = json_decode($data)->{"nombr_usu"};
                $_SESSION["ruc_usuminimarket"]              = json_decode($data)->{"ruc"};
                $_SESSION["razonsocial_usuminimarket"]      = json_decode($data)->{"razonsocial"};
                $_SESSION["direccionfiscal_usuminimarket"]  = json_decode($data)->{"direccionfiscal"};



                $cantidad = $objUsuariosM->CantidadCarrito($_SESSION["cod_usuminimarket"]);

                


                //SI ANTES TENIAMOS UN REGISTRO EN EL TEMPORAL LO PASAMOS A NUESTRA CUENTA
                if(isset($_SESSION["tmpcarrito"])){

                    // var_dump($_SESSION["tmpcarrito"]);

                    // RECORREMOS Y REGISTRAMOS
                    foreach($_SESSION["tmpcarrito"] as $fila){
                        $objCarritoM->RegistrarTMP($fila->cod_producto,$_SESSION["cod_usuminimarket"],$fila->cantidad_detalle,$fila->precio1);
                    }

                }


                echo json_encode(array("success"=>true,"cantidad"=>$cantidad->{"cantidad"}));

            }else{
                echo json_encode(array("success"=>false));
            }
            
        }

        //REGISTRAR 
        if($_POST["operacion"] == "registrar"){

            $objUsuariosE->__SET("apell_usu"    ,$_POST["apellidos"]);
            $objUsuariosE->__SET("nombr_usu"    ,$_POST["nombres"]);
            $objUsuariosE->__SET("telef_usu"    ,$_POST["telefono"]);
            $objUsuariosE->__SET("correo_usu"   ,$_POST["correo"]);
            $objUsuariosE->__SET("pass_usu"     ,sha1("##2".$_POST["clave"]."##3"));

            $objUsuariosM->Registrar($objUsuariosE);


        }

        //MODIFICAR RUC
        if($_POST["operacion"] == "modificarruc"){

            session_start();

            // ACTUALIZAMOS
            $_SESSION["ruc_usuminimarket"]              = $_POST["ruc"];
            $_SESSION["razonsocial_usuminimarket"]      = $_POST["razonsocial"];
            $_SESSION["direccionfiscal_usuminimarket"]  = $_POST["direccionfiscal"];


            $objUsuariosE->__SET("cod_usu"          ,$_SESSION["cod_usuminimarket"]);
            $objUsuariosE->__SET("ruc"              ,$_POST["ruc"]);
            $objUsuariosE->__SET("razonsocial"      ,$_POST["razonsocial"]);
            $objUsuariosE->__SET("direccionfiscal"  ,$_POST["direccionfiscal"]);

            

            $objUsuariosM->ModificarRuc($objUsuariosE);
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