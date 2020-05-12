<script>

    $(document).ready(function(){
        
        ListarFamilias();
        ListarFamiliasCombo();
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
                if(js.success){
                    location.reload();      
                }
            }
        });
    }




</script>