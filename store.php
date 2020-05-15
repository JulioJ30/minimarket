<?php
	session_start();
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
        <?php require_once 'views/header.view.php';  ?>
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
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">

						<!-- FILTRO -->
						<div class="aside">
							<h3 class="aside-title">Busqueda</h3>
							<div class="form-group">
								<button class="btn btn-block btn-danger" id="btnBusquedaProducto"><i class="fas fa-search"></i></button>
							</div>
						</div>
						<!-- /CATEGORIAS -->

						<!-- CATEGORIAS -->
						<div class="aside">
							<h3 class="aside-title">Categorias</h3>
							<div class="checkbox-filter" id="contenedorcategorias">
							</div>
						</div>
						<!-- /CATEGORIAS -->

						<!-- PRECIOS -->
						<div class="aside">
							<h3 class="aside-title">Precios</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number" readonly>
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number" readonly>
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /PRECIOS -->

						<!-- MARCAS -->
						<div class="aside">
							<h3 class="aside-title">Marcas</h3>
							<div class="checkbox-filter" id="contenedormarcas">
								
							</div>
						</div>
						<!-- /MARCAS -->

						
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
	
							</div>
							
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row" id="contenedorproductos">
							

						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<!-- <div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div> -->
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
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

		<!-- FOOTER -->
        <?php
			//SCRIPTS
			require_once 'views/scriptstodos.php';
		?>

		<!-- SCRIPTS PROPIOS -->
		<script>
			//LISTAR POR FAMILIA
			var idfamilia = "<?php echo isset($_GET["id"]) ? $_GET["id"] : 0;  ?>";
			var producto = "<?php echo isset($_GET["prod"]) ? $_GET["prod"] : "";  ?>";

			$(document).ready(function(){

				ListarProductosxFamilia("","","","");
				ListarCategoriasFamilia("","","","");
				ListarMarcasFamilia("","","","");

				setTimeout(()=>{

				if(idfamilia != 0){
					$("#familia"+idfamilia).addClass("active");
				}else{
					$("#familiahome").addClass("active");
				}

				//CARGA
				$(".loader").fadeOut("slow");

				//Main
				Main();

				},1000);

				//BUSQUEDA
				$("#btnBusquedaProducto").click(function(){
					// console.log($(".categor"));
					var categorias 	= $(".categoriasfiltro");
					var marcas 		= $(".marcasfiltro");

					var acategorias = [];
					var amarcas = [];


					//CATEGORIAS
					for(var i = 0; i < categorias.length; i++){

						if(categorias[i].checked){
							acategorias.push(categorias[i].dataset.id);
						}

					}

					//MARCAS
					for(var i = 0; i < marcas.length; i++){

						if(marcas[i].checked){
							amarcas.push(marcas[i].dataset.id);
						}
					}
					// location.href =window.location.href + "&pruebita=123";
					// console.log(acategorias.toString() ,amarcas.toString());


					ListarProductosxFamilia(acategorias.toString() ,amarcas.toString(),$("#price-min").val().trim(),$("#price-max").val().trim());
					ListarCategoriasFamilia(acategorias.toString() ,amarcas.toString(),$("#price-min").val().trim(),$("#price-max").val().trim());
					ListarMarcasFamilia(acategorias.toString() ,amarcas.toString(),$("#price-min").val().trim(),$("#price-max").val().trim());
				});

				

				

			});

			//LISTA PRODUCTOS POR FAMILIA
			function ListarProductosxFamilia(categorias,marcas,precio1,precio2){

				var datos = {
					'operacion' 	: 'listarxfamilia',
					'idfamilia'		: idfamilia,
					'product'		: producto,
					'idcategoria'	: categorias,
					'idmarca'		: marcas,
					'precio1' 		: precio1,
					'precio2' 		: precio2,
				}


				$.ajax({
					url: 	'controllers/productos.controller.php',
					type:	'get',
					data: datos,
					success:function(e){
						//console.log(e);
						$("#contenedorproductos").html(e);
					}
				})

			}

			//LISTA CATEGORIAS POR FAMILIA
			function ListarCategoriasFamilia(categorias,marcas,precio1,precio2){
				//contenedorcategorias
				
				var datos = {
					'operacion' : 'listarcategoriascant',
					'idfamilia'		: idfamilia,
					'product'		: producto,
					'idcategoria'	: categorias,
					'idmarca'		: marcas,
					'precio1' 		: precio1,
					'precio2' 		: precio2,
				}


				$.ajax({
					url: 	'controllers/categorias.controller.php',
					type:	'get',
					data: datos,
					success:function(e){
						// console.log(e);
						$("#contenedorcategorias").html(e);
					}
				})
			}


			//LISTA MARCAS POR FAMILIA
			function ListarMarcasFamilia(categorias,marcas,precio1,precio2){
				//contenedorcategorias
				
				var datos = {
					'operacion' : 'listarxfamilia',
					'idfamilia'		: idfamilia,
					'product'		: producto,
					'idcategoria'	: categorias,
					'idmarca'		: marcas,
					'precio1' 		: precio1,
					'precio2' 		: precio2,
					
				}


				$.ajax({
					url: 	'controllers/marcas.controller.php',
					type:	'get',
					data: datos,
					success:function(e){
						// console.log(e);
						$("#contenedormarcas").html(e);
					}
				})
			}

		</script>

		<!-- SCRIPTS GLOBALES -->
		<?php
			require_once 'views/scripts.php';
		?>


	</body>
</html>
