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
								<span class="product-available">In Stock</span>
							</div>
							<p id="descripcionproducto"></p>

						

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" value="0">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>

							

							<ul class="product-links">
								<li>Categoria:</li>
								<li><a href="#" id="nombrecategoria"></a></li>
								<!-- <li><a href="#">Accessories</a></li> -->
							</ul>


						</div>
					</div>
					<!-- /Product details -->

					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>

					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="public/img/product01.png" alt="">
								
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<!-- <div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div> -->
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product -->

					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="public/img/product02.png" alt="">
							
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<!-- <div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div> -->
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product -->

					<div class="clearfix visible-sm visible-xs"></div>

					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="public/img/product03.png" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<!-- <div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div> -->
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product -->

					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="public/img/product04.png" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<!-- <div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div> -->
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

		<?php
			//MODAL
			require_once 'views/modal.view.php';
			//FOOTER
            require_once 'views/footer.view.php';
        ?>

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

		<!-- SCRIPT PROPIOS -->

		<script>
			var idproducto = '<?php $idproducto = isset($_GET["id"]) ? $_GET["id"] : 0 ; echo $idproducto;?>';


			$(document).ready(function(){
				getProducto();
				getProductoImagenes();


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
						console.log(js);

						$("#nombreproducto").text(js.nombre_procucto);
						$("#descripcionproducto").text(js.descripcion_producto);
						$("#nombrecategoria").text(js.nombre_categoria);

						if(js.precio1 != js.precio2){
							$("#precio1").html(`S/. ${js.precio1} <del class='product-old-price'>S/. ${js.precio2}</del>`);
						}else{
							$("#precio1").text(`S/. ${js.precio1}`);
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
						ArmarZoom();
					}
				});
			}


		</script>



	</body>
</html>
