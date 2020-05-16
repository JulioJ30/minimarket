<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
			require_once 'views/head.php';
		?>
		<style>
			.add-to-cart{
  /* background:rgba(0,0,0,0.7) !important; */
  background:white !important;

}
		</style>
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
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2" >

						<div id="product-main-img">
							

						</div>

					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->

					<div class="col-md-2  col-md-pull-5" >

						<div id="product-imgs">
							
							

						</div>

					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name" id="nombreproducto"></h2>
							
							<div>
								<h3 class="product-price" id="precio1"></h3>
								<span class="product-available" id="tipostockproducto" >En Stock</span>
							</div>
							<p id="descripcionproducto"></p>

						

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" value="1" min="1"id="txtCantidadProducto">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn" id="btnAgregarCarrito"><i class="fa fa-shopping-cart"></i> Agregar al carrito</button>
							</div>


							

							<ul class="product-links">
								<li>Categoria:</li>
								<li><a href="#" id="nombrecategoria"></a></li>
								<!-- <li><a href="#">Accessories</a></li> -->
							</ul>

							<div class="form-group" style="margin-top: 20px">
								<button class="btn btn-danger" id="btnAtras"> <i class="fas fa-arrow-left"></i> Seguir Comprando</button>
							</div>


						</div>
					</div>
					<!-- /Product details -->

					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		

		<?php
			//MODAL
			require_once 'views/modal.view.php';
			//FOOTER
            require_once 'views/footer.view.php';
        ?>

		<?php
			//SCRIPTS
			require_once 'views/scriptstodos.php';
		?>



		<!-- SCRIPTS GLOBALES -->
		<?php
			require_once 'views/scripts.php';
		?>

		<!-- SCRIPT PROPIOS -->

		<script>


			var idproducto = '<?php $idproducto = isset($_GET["id"]) ? $_GET["id"] : 0 ; echo $idproducto;?>';
			var  producto = {};

			$(document).ready(function(){
				getProducto();
				getProductoImagenes();
				//CARGA
				$(".loader").fadeOut("slow");


				//ATRAS
				$("#btnAtras").click(function(){
					location.href = "store.php?id="+producto.cod_familia;
				});


				//AGREGAMOS AL CARRITO
				$("#btnAgregarCarrito").click(function(){
					var cantidad = $("#txtCantidadProducto").val();

					//console.log(cantidad,idproducto);

					if(cantidad > 0){

						var datos = {
						'operacion'				: 'agregarcarrito',
						'idproducto'			: producto.cod_producto,
						'cantidad'				: cantidad,
						'nombre_producto'		: producto.nombre_procucto,
						'descripcion_producto'	: producto.descripcion_producto,
						'nombre_categoria'		: producto.nombre_categoria,
						'ruta_imagen_catalogo'	: producto.ruta_imagen_catalogo,
						'precio1'				: producto.precio1

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
								$("#txtCantidadProducto").val(0);
								getCarrito();
							}
						})


					}else{
						Swal.fire("Seleccione una cantidad mayor a 0","MiniMarket","info");
					}

					

				});


			});

			function getProducto(){

				var datos = {
					'operacion'	 : 'getproducto',
					'idproducto' : idproducto
				}

				$.ajax({
					url :'controllers/productos.controller.php',
					type:'get',
					data:datos,
					success:function(e){
						var js = JSON.parse(e);
						//GUARDAMOS PRODUCTO EN VARIABLE
						producto = js;
						// console.log(js);

						$("#nombreproducto").text(js.nombre_procucto);
						$("#descripcionproducto").text(js.descripcion_producto);
						$("#nombrecategoria").text(js.nombre_categoria);

						if(js.precio1 != js.precio2){
							$("#precio1").html(`S/. ${js.precio1} <del class='product-old-price'>S/. ${js.precio2}</del>`);
						}else{
							$("#precio1").text(`S/. ${js.precio1}`);
						}

						// TIPO DE PRODUCTO
						// $("#tipostockproducto").val();
						if(producto.tipo_stock_producto == "C"){
							$("#tipostockproducto").html("En Stock " + producto.stock_producto);
							$("#txtCantidadProducto").attr("max",producto.stock_producto);
						}else{
							$("#tipostockproducto").html("En Stock");
						}


					}
				});
			}

			function getProductoImagenes(){

				var datos = {
					'operacion'	 : 'getproductoimagenes',
					'idproducto' : idproducto
				}

				$.ajax({
					url :'controllers/productos.controller.php',
					type:'get',
					data:datos,
					success:function(e){
						$("#product-main-img").html(e);
						$("#product-imgs").html(e);
						Main();
					}
				});
			}


		</script>



	</body>
</html>
