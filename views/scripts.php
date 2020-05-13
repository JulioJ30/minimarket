<script>

    $(document).ready(function(){



        ListarFamilias();
        ListarFamiliasCombo();

        //LISTAMOS CARRITO
        getCarrito();

        let frmLogin = document.getElementById("frmLogin");

        frmLogin.addEventListener('submit',(e)=>{
            Login();
            e.preventDefault();
        });



        //ABRE MODAL LOGIN
        $("#btnLoginModal").click(function(){
            $("#modalLogin").modal("show");
            $("#txtLoginUsuario").focus();
        });

        //ABRE MODAL REGISTRO
        $("#btnRegistroModal").click(function(){
            $("#modalRegistro").modal("show");
        });

        // CHECKOUT
        $("#contenidocarrito").on('click','#btnCheckout',function(){
            var sesion = $("#contenidocarrito").data("sesion");

            if(sesion == 1){
                location.href = 'checkout.php';
            }else{
                Swal.fire("Favor inicio sesion primero","Minimarket","info");
            }
        });

        //delete
        //ELIMINAR ITEM DEL CARRITO
        $("#contenidocarrito").on('click','.delete',function(){
            var id = $(this).data("id");

            var datos = {
                'operacion' : 'eliminaritem',
                'id'        : id
            }

            $.ajax({
                url:'controllers/carrito.controller.php',
                type:'GET',
                data:datos,
                success:function(e){
                    getCarrito();
                }
            });
           
        });


        // CLASE AGREGAR CARRITO
        $(document).on('click','.add-to-cart-btn',function(){

            var id = $(this).data("id");
            console.log(id);

            var datos = {
                'operacion'				: 'agregarcarrito',
                'idproducto'			: id,
                'cantidad'				: 1,
                'nombre_producto'		: $(this).data("nombre"),
                'descripcion_producto'	: $(this).data("descripcion"),
                'nombre_categoria'		: $(this).data("categoria"),
                'ruta_imagen_catalogo'	: $(this).data("imagen"),
                'precio1'				: $(this).data("precio")

            }


            $.ajax({
                url:'controllers/carrito.controller.php',
                type:'get',
                data:datos,
                success:function(e){
                    // console.log(e);
                    Swal.fire({
                        title: "Registrado Correctamente",
                        html: 'MiniMarket',
                        icon : "success",
                        timer: 1500,
                    });
                    //REFRESCAMOS
                    // $("#txtCantidadProducto").val(0);
                    getCarrito();
                }
            })


        });


    });


    //LISTA FAMILIAs
    function ListarFamilias(){
        $.ajax({
            url:'controllers/familias.controller.php?operacion=listar',
            type:'GET',
            success:function(e){
                $("#listafamilias").html(e);
                //REMOVEMOS ACTIVO
				$(".listafamilias").removeClass("active");
            }
		});
    }

    //LISTA FAMILIAs
    function ListarFamiliasCombo(){
        $.ajax({
            url:'controllers/familias.controller.php?operacion=listarcombo',
            type:'GET',
            success:function(e){
                $("#cboFamilias").html(e);
            }
		});
    }

    //LOGIN
    function Login(){
        var  datos = {
            'usuario'   : $("#txtLoginUsuario").val().trim(),
            'clave'     : $("#txtLoginClave").val().trim(),
            'operacion' : 'login'
        }

        $.ajax({
            url:'controllers/usuarios.controller.php',
            type:'post',
            data:datos,
            success:function(e){
                let js = JSON.parse(e);
                // console.log(js);
                if(js.success){
                    location.reload();      
                }else{
                    Swal.fire("Credenciales incorrectas","MiniMarket","warning");
                }
            }
        });
    }

    function getCarrito(){

        $.ajax({
            url:'controllers/carrito.controller.php?operacion=getcarrito',
            type:'get',
            // data:datos,
            success:function(e){
                // console.log(e);
                var js = JSON.parse(e);
                $("#contenidocarrito").html(js.contenido);
                $("#cantidadcarrito").html(js.cantidad);
            }
        });
    }




</script>