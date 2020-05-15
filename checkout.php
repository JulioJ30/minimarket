<?php
	session_start();
	// if(!isset($_SESSION["loginminimarket"])){
	// 	header("location: index.php");
	// }

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

	

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-8" style="margin-top: 20px">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Detalle de la Compra</h3>
							</div>
							
							<div class="form-group">
								<a class="btn btn-primary" href='store.php?id=1'><i class="fas fa-arrow-left"></i> Seguir comprado </a>
								<button class="btn btn-warning" id="btnActualizarCarrito"><i class="fas fa-sync-alt"></i> Actualizar carrito </button>
								<button class="btn btn-danger" id="btnLimpiarCarrito"> <i class="fas fa-trash"></i> Limpiar carrito </button>

							</div>


							<div class="form-group">
								<table class="table">
									<thead>
										<tr>
											<th>Producto</th>
											<th>Precio</th>
											<th>Cantidad</th>
											<th>SubTotal</th>
										</tr>
									</thead>
									<tbody id="cuerpotabla">
										
									</tbody>
								</table>
							</div>


						</div>
						<!-- /Billing Details -->

						
						
					</div>

					<!-- Order Details -->
					<div class="col-md-4 order-details" style="margin-top: 20px" >
						<div class="section-title text-center">
							<h3 class="title">Total del Carrito</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<!-- <div><strong>Su</strong></div> -->
								<!-- <div><strong>TOTAL</strong></div> -->
							</div>
							<div class="order-products">
								<div class="order-col">
									<div>SUBTOTAL</div>
									<div id="subtotalcarrito">0</div>
								</div>
								<div class="order-col">
									<div>IGV</div>
									<div id="igvcarrito">0</div>
								</div>
								<div class="order-col">
									<div>ENVIO</div>
									<div id="enviocarrito">0</div>
								</div>
							</div>
							<!-- <div class="order-col">
								<div>TOTAL</div>
								<div><strong>FREE</strong></div>
							</div> -->
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total" id="totalcarrito"></strong></div>
							</div>
						</div>
						<div class="payment-method">
							<!-- METODOS PAGO -->
							<label class="font-weight-bold">Metodo de pago</label>
							<div id="cboMetodosPago" style="text-align: center" class="mb-5">
							</div>
							<!-- DIRECCIONS -->
							<!-- <label for=""  style="width: 100%;margin-top:10px ">
								<a data-toggle="collapse" href="#cboDirecciones" class='font-weight-bold'  href="">Mis Direcciones</a>
								<a href="direccion.php" style="float: right"> <i class="fas fa-plus"></i> </a>
							</label>
							<div id="cboDireccionesPrincipal">

							</div>
							<div class="collapse" id="cboDirecciones" style="padding: 2px" ></div> -->

							<!-- HORARIOS -->
							<div class="panel panel-default mt-5">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" href="#cboDirecciones2" >
											Enviar a:
										</a>
										
										<a href="direccion.php" style="float: right"> <i class="fas fa-plus"></i> </a>
									</h4>
									<!-- asdasdasdsadsad -->
									<!-- <br> -->
									<h6 id="nombredireccioncompleta"></h6>
								</div>
								<div id="" class="panel-collapse  " role="tabpanel" >

									<div class="panel-body" >
										<div id="cboDireccionesPrincipal">

										</div>
										<div id="cboDirecciones2" class="collapse">

										</div>
									</div>
								</div>
							</div>

							<!-- HORARIOS -->
							<div class="panel panel-default mt-5">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" href="#contenidohorarios" >
											Horarios
										</a>
									</h4>
								</div>
								<div id="contenidohorarios" class="panel-collapse collapse " role="tabpanel" >
									<div class="panel-body" id="contenidohorarios2">
									</div>
								</div>
							</div>

							<!-- COMPROBANTE -->
							<div class="panel panel-default mt-5">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" href="#contenidocomprobantes" >
											Comprobantes
										</a>
									</h4>
								</div>
								<div id="contenidocomprobantes" class="panel-collapse collapse " role="tabpanel" >
									<div class="panel-body" id="contenidocomprobantes2">
									</div>
								</div>
							</div>
							<div class="collapse" id="contenidoruc">

								<!-- <a href="direccion.php"  class="font-weight-bold" style="float:right">Actualizar</a> -->

								<div class="card">
									<div class="card-body">
										<div class="form-group">
											<label for="">RUC</label>
											<input type="text" name="" id="txtruc" class="form-control" value='<?php echo isset($_SESSION["ruc_usuminimarket"]) ? $_SESSION["ruc_usuminimarket"] : ""; ?>' >
										</div>

										<div class="form-group">
											<label for="">Razon Social</label>
											<input type="text" name="" id="txtrazonsocial" class="form-control" value='<?php echo isset($_SESSION["razonsocial_usuminimarket"]) ? $_SESSION["razonsocial_usuminimarket"] : ""; ?>' >
										</div>

										<div class="form-group">
											<label for="">Dirección Fiscal</label>
											<input type="text" name="" id="txtdireccionfiscal" class="form-control" value='<?php echo isset($_SESSION["direccionfiscal_usuminimarket"]) ? $_SESSION["direccionfiscal_usuminimarket"] : ""; ?>' >
										</div>
									</div>
								</div>

								
								
							</div>
							
							

							
						</div>
				
						<button class="primary-btn order-submit btn-block" id="btnComprar" data-sesion="<?php echo isset($_SESSION["cod_usuminimarket"]) ? 1 : 0 ;?>" >Generar Compra</button>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->



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

		<!-- PROPIOS -->

		<script>
			var REQUERIDO = false;
			window.addEventListener('load',async ()=>{
				//CARRITO
				var carrito = await getCarritoCompleto();
				$("#cuerpotabla").html(carrito.resultado);
				$("#totalcarrito").html(carrito.total);
				$("#enviocarrito").html(carrito.envio);
				$("#subtotalcarrito").html(carrito.subtotal);
				$("#igvcarrito").html(carrito.igv);

				//HORARIOS
				var horario = await getHorarios();
				$("#contenidohorarios2").html(horario);

				//COMPROBANTES
				var comprobantes = await getComprobantes();
				$("#contenidocomprobantes2").html(comprobantes);


				//METODOS DE PAGO
				var metodos = await getMetodosPago();
				$("#cboMetodosPago").html(metodos);
				//DIRECCIONES
				var direcciones = await getDirecciones();
				$("#cboDirecciones2").html(direcciones.normal);
				$("#cboDireccionesPrincipal").html(direcciones.principal);
				$("#nombredireccioncompleta").text(direcciones.nombredireccioncompleta);

				$(".loader").fadeOut("slow");



				// EVENTOS
				
					//ACTUALIZAR CARRITO
					$("#btnActualizarCarrito").click(async function(){
						getCarrito();

						carrito = await getCarritoCompleto();
						$("#cuerpotabla").html(carrito.resultado);
						$("#totalcarrito").html(carrito.total);
						$("#enviocarrito").html(carrito.envio);
						$("#subtotalcarrito").html(carrito.subtotal);
						$("#igvcarrito").html(carrito.igv);
					});

					//LIMPIAR CARRITO
					$("#btnLimpiarCarrito").click(async function(){
						var data = await LimpiarCarrito();
						getCarrito();
						carrito = await getCarritoCompleto();
						$("#cuerpotabla").html(carrito.resultado);
						$("#totalcarrito").html(carrito.total);
						$("#enviocarrito").html(carrito.envio);
						$("#subtotalcarrito").html(carrito.subtotal);
						$("#igvcarrito").html(carrito.igv);
					});


					//CAMBIAR CANTIDAD
					$("#cuerpotabla").on('change','.cantidadcarrito', async function(){
						// $(this).attr("disabled");
						var id = $(this).data("id");
						var cantidad = $(this).val();

						var data = ModificarCantidad(id,cantidad);
						console.log(data);
						// $(".loader").show("slow");
						carrito = await getCarritoCompleto();
						$("#cuerpotabla").html(carrito.resultado);
						$("#totalcarrito").html(carrito.total);
						$("#enviocarrito").html(carrito.envio);
						$("#subtotalcarrito").html(carrito.subtotal);
						$("#igvcarrito").html(carrito.igv);
						// $(".loader").fadeOut("slow");


					});

					//ELIMINAR ITEM CARRITO
					$("#cuerpotabla").on('click','.eliminarcarrito', async function(){
						// $(this).attr("disabled");
						var id = $(this).data("id");
						// console.log(id);
						// var cantidad = $(this).val();

						var data = EliminarItemCarrito(id);
						
						//ACTUALIZAMOS EN EL HEADER
						getCarrito();
						
						var car = await getCarritoCompleto();
						$("#cuerpotabla").html(car.resultado);
						$("#totalcarrito").html(car.total);
						$("#enviocarrito").html(car.envio);
						$("#subtotalcarrito").html(car.subtotal);
						$("#igvcarrito").html(carrito.igv);
						// // $(".loader").fadeOut("slow");


					});

					//COMPRAR
					$("#btnComprar").click(async function(){
						var sesion = $(this).data("sesion");
						if(sesion == 1){

							// console.log($("#totalcarrito").text());
							if(carrito.total > 0){
								
								var direcciones = $(".direcregistrar");
								var iddireccion = 0;

								var horarios =  $(".horarioregistrar");
								var idhorario = 0;

								var comprobantes = $(".comprobantesregistrar");
								var idcomprobante = 0;

								var metodospago = $(".radiometodos");
								var idmetodopago = 0;

								// console.log(metodospago);
									
								//OBTENEMOS LA DIRECCION
								for(var i =0; i < direcciones.length; i++){
									if(direcciones[i].checked){
										iddireccion = direcciones[i].dataset.id;
									}
								}

								//OBTENEMOS EL METODO DE PAGO
								for(var i =0; i < metodospago.length; i++){
									if(metodospago[i].checked){
										idmetodopago = metodospago[i].dataset.id;
									}
								}


								//OBTENEMOS EL HORARIOS
								for(var i =0; i < horarios.length; i++){
									if(horarios[i].checked){
										idhorario = horarios[i].dataset.id;
									}
								}

								//OBTENEMOS EL COMPROBANTE
								for(var i =0; i < comprobantes.length; i++){
									if(comprobantes[i].checked){
										idcomprobante = comprobantes[i].dataset.id;
									}
								}

								if(iddireccion != 0 && idhorario != 0){

									if(REQUERIDO && $("#txtruc").val().trim() != "" && $("#txtrazonsocial").val().trim()  != "" && $("#txtdireccionfiscal").val().trim()  != ""){
										
										var compra = await Comprar(iddireccion,idmetodopago,idhorario,idcomprobante);

										carrito = await getCarritoCompleto();
										$("#cuerpotabla").html(carrito.resultado);
										$("#totalcarrito").html(carrito.total);
										$("#enviocarrito").html(carrito.envio);
										$("#subtotalcarrito").html(carrito.subtotal);
										$("#igvcarrito").html(carrito.igv);
										getCarrito();
										//ACTUALIZAMOS DATOS
										ActualizarRuc();

										Swal.fire("Compra realizada","MiniMarket","success");


									}else{
										Swal.fire("Este Tipo de comprobante necesita datos de empresa, por favor actualize sus datos","MiniMarket","info");

									}


									

								}else{
									Swal.fire("Por favor seleccione una dirección y un horario","MiniMarket","warning");
								}


							}else{
								// console.log(carrito.total);
								Swal.fire("Por favor agregue productos al carrito primero","MiniMarket","info");
							}

						}else{
							Swal.fire("Por favor registrese o inicie sesión para poder realizar compra","MiniMarket","info");
						}
					});

					// MOSTRAR RUC
					$("#contenidocomprobantes").on('change','.comprobantesregistrar',function(){
						// console.log($(this));
						if($(this)[0].checked){
							
							var req = $(this)[0].dataset.req;
							if(req == "SI"){
								REQUERIDO = true;
								$("#contenidoruc").collapse("show");
							}else{
								REQUERIDO = false;
								$("#contenidoruc").collapse("hide");
							}

						}
							// console.log($(this).data("req"));
					});

					$(".direcregistrar").click(function(){
						$("#nombredireccioncompleta").text($(this).data("direc"));
							// console.log($(this).data("direc"));
					});

			});

		
			//OBTNER CARRITO
			async function getCarritoCompleto(){
				let rpt;
				try{	
					rpt = await $.ajax({
						url:'controllers/carrito.controller.php?operacion=getcarritocompleto',
						type:'get'
					});

					return JSON.parse(rpt);

				}catch(e){
					console.log(e);
				}
			}

			//LISTAR METODOS DE PAGO
			async function getMetodosPago(){
				let rpt;
				try{	
					rpt = await $.ajax({
						url:'controllers/metodospago.controller.php?operacion=getmetodos',
						type:'get'
					});

					return rpt;

				}catch(e){
					console.log(e);
				}
			}

			//LISTAR DIRECCIONES DE USUARIOS
			async function getDirecciones(){
				let rpt;
				try{	
					rpt = await $.ajax({
						url:'controllers/direccionesusuarios.controller.php?operacion=getdirecciones',
						type:'get'
					});

					return JSON.parse(rpt);

				}catch(e){
					console.log(e);
				}
			}

			//LIMPIAR CARRITO
			async function LimpiarCarrito(){
				let rpt;
				rpt = await $.ajax({
					url:'controllers/carrito.controller.php?operacion=limpiarcarrito',
					type:'get'
				});

				return rpt;
			}

			//MODIFICAR CANTIDAD
			async function ModificarCantidad(id,cantidad){
				var datos = {
					'operacion' : 'modificarcantidad',
					'idcarrito'	: id,
					'cantidad'  : cantidad
				}
				var rpt;
				rpt = await $.ajax({
					url:'controllers/carrito.controller.php',
					type:'get',
					data:datos
				});
					
				return rpt;
				
			}

			//ELIMINAR ITEM CARRITO
			async function EliminarItemCarrito(id){
				var datos = {
					'operacion' : 'eliminaritem',
					'id'	: id
				}
				var rpt;
				rpt = await $.ajax({
					url:'controllers/carrito.controller.php',
					type:'get',
					data:datos
				});
					
				return rpt;
				
			}

			//COMPRAR
			async function Comprar(iddireccion,idmetodopago,idcodigohorario,idcomprobante){


				var rpt;

				var datos = {
					'operacion' 			: 	'registrar',
					'iddireccion'			:	iddireccion,
					'idmetodopago'			:	idmetodopago,
					'idcodigohorario'		:	idcodigohorario,
					'idcomprobante'			:	idcomprobante
				}
				// var rpt;
				rpt = await $.ajax({
					url:'controllers/venta.controller.php',
					type:'get',
					data:datos
				});	
					
				return rpt;
			}

			//GET HORARIOS
			async function getHorarios(){

				var rpt;

				rpt = await $.ajax({
					url:'controllers/horarios.controller.php',
					type:'get',
					data:'operacion=getHorarios'
				});

				return rpt;
			}

			//GET COMPROBANTES
			async function getComprobantes(){

				var rpt;

				rpt = await $.ajax({
					url:'controllers/comprobantes.controller.php',
					type:'get',
					data:'operacion=getComprobantes'
				});

				return rpt;
			}

			//ACTUALIZAR RUC
			function ActualizarRuc(){
				var datos = {
					'operacion' 		: 'modificarruc',
					'ruc' 				: $("#txtruc").val().trim(),
					'razonsocial' 		: $("#txtrazonsocial").val().trim(),
					'direccionfiscal' 	: $("#txtdireccionfiscal").val().trim()
				}


				$.ajax({
					url:'controllers/usuarios.controller.php',
					data: datos,
					type:'POST',
					success:function(e){
						// alert("registrado");
						// Swal.fire("Datos modificados","MiniMarket","success");
						// frmActualizarDatos.reset();
					}
				});
			}

		</script>

	</body>
</html>
