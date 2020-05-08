<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="libs/css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="libs/css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="libs/css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="libs/css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="libs/css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="libs/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

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
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						<li><a href="product.php">Productos</a></li>
						<!-- <li><a href="#">Categories</a></li>
						<li><a href="#">Laptops</a></li>
						<li><a href="#">Smartphones</a></li>
						<li><a href="#">Cameras</a></li>
						<li><a href="#">Accessories</a></li> -->
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
        <?php require_once 'views/footer.view.php'; ?>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="libs/js/jquery.min.js"></script>
		<script src="libs/js/bootstrap.min.js"></script>
		<script src="libs/js/slick.min.js"></script>
		<script src="libs/js/nouislider.min.js"></script>
		<script src="libs/js/jquery.zoom.min.js"></script>
		<script src="libs/js/main.js"></script>

	</body>
</html>
