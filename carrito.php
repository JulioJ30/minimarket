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

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Carrito</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
                            <li class="active">Carrito</li>
                            <li class="">Total: $10.00</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    <div class="col-md-4 text-center col-12">
                        <img src="public/img/product01.png" alt="" style="width: 50%">
                    </div>
                    <div class="col-md-4 col-6">
                        <h5 for="">Producto:  </h5> 
                        <h5 for="">Categoria:</h5>   
                        <h5 for="">Cantidad:</h5>
                        <h5>Total:</h5>
                    </div>
                    <div class="col-md-4 col-6">
                        <h5>Nombre producto</h5>
                        <h5>Categoria producto</h5>
                        <input type="text" class="form-control">
                        <h5>$10:00</h5>
                    </div>
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

	</body>
</html>
