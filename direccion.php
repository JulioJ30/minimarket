<?php
	session_start();
	if(!isset($_SESSION["loginminimarket"])){
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
			require_once 'views/head.php';
		?>

    </head>
	<body>
		<!-- HEADER -->
		<?php require_once 'views/header.view.php'; ?>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav" id="listafamilias">
		
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

	

		<div class="container " style="margin-top: 20px;margin-bottom:20px" >

				<div class="row">
					<div class="col-lg-6">

						<h3>Actualizar Datos</h3>
						<hr>
						<form id="frmActualizarDatos" class="row">

							<div class="form-group col-lg-12">
								<label for="">Ruc</label>
								<input type="text" class="form-control" id="txtRucModificar" required autofocus value='<?php echo isset($_SESSION["ruc_usuminimarket"]) ? $_SESSION["ruc_usuminimarket"] : ""; ?>'>
							</div>
							<div class="form-group col-lg-12">
								<label for="">Razón Social</label>
								<input type="text" class="form-control" id="txtRazonSocialModificar" required  value='<?php echo isset($_SESSION["razonsocial_usuminimarket"]) ? $_SESSION["razonsocial_usuminimarket"] : ""; ?>'>
							</div>
							<div class="form-group col-lg-6">
								<label for="">Dirección Fiscal</label>
								<input type="text" class="form-control" id="txtDireccionFiscalModificar" required value='<?php echo isset($_SESSION["direccionfiscal_usuminimarket"]) ? $_SESSION["direccionfiscal_usuminimarket"] : ""; ?>' >
							</div>
							<div class="form-group col-lg-6">
								<label for="">&nbsp;</label>
								<!-- <input type="text" class="form-control" id="txtNombreDireccion" required autofocus> -->
								<button class="btn btn-block btn-danger" type="submit" id="btnActualizar">Actualizar</button>	
							</div>
						</form>


						<h3>Registro de Direcciones</h3>
						<hr>
						<form class="row" id="fmrRegistroDirecciones">

							<div class="form-group col-lg-12">
								<label for="">Nombre Dirección</label>
								<input type="text" class="form-control" id="txtNombreDireccion" required autofocus>
							</div>

							<div class="form-group col-lg-12">
								<label for="">Dirección</label>
								<input type="text" class="form-control"  id="txtDireccion" required>
							</div>

							<div class="form-group col-lg-12">
								<label for="">Distrito</label>
								<select name="" id="cboDistritos" class="form-control" ></select>
							</div>

							
							
							<div class="form-group col-lg-12">
								<label for="">Referencia</label>
								<input type="text" class="form-control" id="txtReferencia" >
							</div>

							<div class="form-group col-lg-12">
								<!-- <label for="">Referencia</label> -->
								<button class="btn btn-block btn-danger" id="btnRegistrarDireccion" type="submit" >Registrar</button>
							</div>

						</form>
						
						


					</div>
					<div class="col-lg-6">
						<!-- <h3>Mis Direcciones</h3> -->
						<!-- <hr> -->

					</div>
				</div>


		</div>




		<!-- FOOTER -->
		<?php 
			//MODAL
			require_once 'views/modal.view.php';
			//FOOTER
            require_once 'views/footer.view.php';
		?>
		<!-- /FOOTER -->

		<?php
			//SCRIPTS
			require_once 'views/scriptstodos.php';
		?>
		
		<!-- SCRIPTS GLOBALES -->
		<?php
			require_once 'views/scripts.php';
		?>

		<!-- PRPIOS -->
		<script>

			let fmrRegistroDirecciones 	= document.getElementById("fmrRegistroDirecciones");
			let frmActualizarDatos 		= document.getElementById("frmActualizarDatos");

			window.addEventListener('load',async ()=>{


				fmrRegistroDirecciones.addEventListener('submit',(e)=>{
					RegistrarDireccion();
					e.preventDefault();
				});

				frmActualizarDatos.addEventListener('submit',(e)=>{
					ActualizarRuc();
					e.preventDefault();
				});

				await ListarDirecciones();

				$(".loader").fadeOut("slow");

			});




			//LISTAR DIRECCIONES

			async function ListarDirecciones(){

				let rpt;

				rpt = await $.ajax({
					url:'controllers/distritos.controller.php',
					type:'GET',
					data:'operacion=listar'
				});

				$("#cboDistritos").html(rpt);
				// console.log(rpt);

			}

			//REGISTRA DIRECCION
			function RegistrarDireccion(){
				var datos = {
					'operacion' 		: 'registrar',
					'iddireccion' 		: $("#cboDistritos").val(),
					'direccion' 		: $("#txtDireccion").val().trim(),
					'nombre_direccion' 	: $("#txtNombreDireccion").val().trim(),
					'referencia' 		: $("#txtReferencia").val().trim()
				}

				if(datos.direccion != 0){

					$.ajax({
						url:'controllers/direccionesusuarios.controller.php',
						data: datos,
						type:'GET',
						success:function(e){
							// alert("registrado");
							Swal.fire("Dirección registrada","MiniMarket","success");
							fmrRegistroDirecciones.reset();
						}
					});

				}else{
					return;
				}

				
			}

			//ACTUALIZAR RUC
			function ActualizarRuc(){
				var datos = {
					'operacion' 		: 'modificarruc',
					'ruc' 				: $("#txtRucModificar").val().trim(),
					'razonsocial' 		: $("#txtRazonSocialModificar").val().trim(),
					'direccionfiscal' 	: $("#txtDireccionFiscalModificar").val().trim()
				}


				$.ajax({
					url:'controllers/usuarios.controller.php',
					data: datos,
					type:'POST',
					success:function(e){
						// alert("registrado");
						Swal.fire("Datos modificados","MiniMarket","success");
						// frmActualizarDatos.reset();
					}
				});
			}

		</script>

	</body>
</html>
