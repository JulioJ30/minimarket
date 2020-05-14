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

					<div class="col-md-8">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Carrito</h3>
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
					<div class="col-md-4 order-details" >
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
							<label for="">Mis direcciones</label>
							<select name="" id="cboDirecciones" class="form-control">

							</select>
							<label for="">Metodo de pago</label>
							<select name="" id="cboMetodosPago" class="form-control">

							</select>
						</div>
				
						<button class="primary-btn order-submit btn-block" id="btnComprar" data-sesion="<?php echo isset($_SESSION["cod_usuminimarket"]) ? 1 : 0 ;?>" >Comprar</button>
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

			window.addEventListener('load',async ()=>{
				//CARRITO
				var carrito = await getCarritoCompleto();
				$("#cuerpotabla").html(carrito.resultado);
				$("#totalcarrito").html(carrito.total);
				$("#enviocarrito").html(carrito.envio);
				$("#subtotalcarrito").html(carrito.subtotal);

				//METODOS DE PAGO
				var metodos = await getMetodosPago();
				$("#cboMetodosPago").html(metodos);
				//DIRECCIONES
				var direcciones = await getDirecciones();
				$("#cboDirecciones").html(direcciones);

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
						// // $(".loader").fadeOut("slow");


					});

					//COMPRAR
					$("#btnComprar").click(async function(){
						var sesion = $(this).data("sesion");
						if(sesion == 1){

							// console.log($("#totalcarrito").text());
							if(carrito.total > 0){
								
								var compra = await Comprar();

								

								carrito = await getCarritoCompleto();
								$("#cuerpotabla").html(carrito.resultado);
								$("#totalcarrito").html(carrito.total);
								$("#enviocarrito").html(carrito.envio);
								$("#subtotalcarrito").html(carrito.subtotal);
								getCarrito();

								Swal.fire("Compra realizada","MiniMarket","success");

							}else{
								console.log(carrito.total);
								Swal.fire("Por favor agregue productos al carrito primero","MiniMarket","info");
							}

						}else{
							Swal.fire("Por favor registrese o inicie sesión para poder realizar compra","MiniMarket","info");
						}
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

					return rpt;

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

			async function Comprar(){
				var datos = {
					'operacion' : 'registrar',
					'iddireccion'	: $("#cboDirecciones").val(),
					'idmetodopago'		: $("#cboMetodosPago").val()
				}
				var rpt;
				rpt = await $.ajax({
					url:'controllers/venta.controller.php',
					type:'get',
					data:datos
				});
					
				return rpt;
			}



		</script>

	</body>
</html>
