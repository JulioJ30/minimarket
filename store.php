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
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter" id="contenedorcategorias">

								<!-- <div class="input-checkbox">
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Laptops
										<small>(120)</small>
									</label>
								</div> -->
<!-- 
								<div class="input-checkbox">
									<input type="checkbox" id="category-2">
									<label for="category-2">
										<span></span>
										Smartphones
										<small>(740)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-3">
									<label for="category-3">
										<span></span>
										Cameras
										<small>(1450)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-4">
									<label for="category-4">
										<span></span>
										Accessories
										<small>(578)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-5">
									<label for="category-5">
										<span></span>
										Laptops
										<small>(120)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-6">
									<label for="category-6">
										<span></span>
										Smartphones
										<small>(740)</small>
									</label>
								</div> -->
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Marcas</h3>
							<div class="checkbox-filter" id="contenedormarcas">
								
							</div>
						</div>
						<!-- /aside Widget -->

						
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<!-- <label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label> -->
							</div>
							
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row" id="contenedorproductos">
							

						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
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

		<!-- jQuery Plugins -->
		<script src="libs/js/jquery.min.js"></script>
		<script src="libs/js/bootstrap.min.js"></script>
		<script src="libs/js/slick.min.js"></script>
		<script src="libs/js/nouislider.min.js"></script>
		<script src="libs/js/jquery.zoom.min.js"></script>
		<script src="libs/js/main.js"></script>

		<!-- SCRIPTS GLOBALES -->
		<?php
			require_once 'views/scripts.php';
		?>

		<!-- SCRIPTS PROPIOS -->
		<script>
			//LISTAR POR FAMILIA
			var idfamilia = "<?php echo isset($_GET["id"]) ? $_GET["id"] : 0;  ?>";

			$(document).ready(function(){

				ListarProductosxFamilia();
				ListarCategoriasFamilia();
				ListarMarcasFamilia();

				setTimeout(()=>{

					if(idfamilia != 0){
					$("#familia"+idfamilia).addClass("active");
				}else{
					$("#familiahome").addClass("active");
				}

				},1000);

				

			});

			//LISTA PRODUCTOS POR FAMILIA
			function ListarProductosxFamilia(){

				var datos = {
					'operacion' : 'listarxfamilia',
					'idfamilia'	: idfamilia
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
			function ListarCategoriasFamilia(){
				//contenedorcategorias
				
				var datos = {
					'operacion' : 'listarcategoriascant',
					'idfamilia'	: idfamilia
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
			function ListarMarcasFamilia(){
				//contenedorcategorias
				
				var datos = {
					'operacion' : 'listarxfamilia',
					'idfamilia'	: idfamilia
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



	</body>
</html>
