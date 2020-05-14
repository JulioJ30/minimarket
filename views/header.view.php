<header>
<!-- MAIN HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-3">
                <div class="header-logo">
                    <a href="index.php" class="logo" >
                        <img src="public/img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <!-- /LOGO -->

            <!-- SEARCH BAR -->
            <div class="col-md-6">
                <div class="header-search">
                    <form action="store.php" method="get">
                        <select class="input-select" id="cboFamilias" name="id" style="width: 150px">
                            <!-- <option value="0">All Categories</option>
                            <option value="1">Category 01</option>
                            <option value="1">Category 02</option> -->
                        </select>
                        <input class="input" placeholder="Producto" name="prod">
                        <button class="search-btn">Buscar</button>
                    </form>
                </div>
            </div>
            <!-- /SEARCH BAR -->

            <!-- ACCOUNT -->
            <div class="col-md-3 clearfix">
                <div class="header-ctn">
                    <!-- Wishlist -->
                    <?php

                        $data = 0;

                        if(!isset($_SESSION["loginminimarket"])){
                            $data = 0;
                            echo "
                                <div>
                                    <a href='#' id='btnLoginModal'>
                                        <i class='fas fa-user'></i>
                                        <span>Login</span>
                                    </a>
                                </div>
                                <div>
                                    <a href='#' id='btnRegistroModal'>
                                        <i class='fas fa-user'></i>
                                        <span>Registrar</span>
                                    </a>
                                </div>
                            ";
                        }else{
                            $data = 1;

                            echo "
                                <div>
                                    <a href='#' id='btnMicuenta'>
                                        <i class='fas fa-user'></i>
                                        <span>Perfil</span>
                                    </a>
                                </div>
                                <div>
                                    <a href='controllers/usuarios.controller.php?operacion=logoff' id='btnLogoff'>
                                        <i class='fas fa-sign-out-alt'></i>
                                        <span>Log Off</span>
                                    </a>
                                </div>
                            ";

                        }

                            // CARRITO
                            // $cantidadcar = isset($_SESSION['cantidadcarrito']) ? $_SESSION['cantidadcarrito'] : 0;
                            echo "
                                <div class='dropdown'>
                                    <a class='dropdown-toggle' data-toggle='dropdown' aria-expanded='true' href='#'>
                                        <i class='fa fa-shopping-cart'></i>
                                        <span>Carrito</span>
                                        <div class='qty' id='cantidadcarrito'></div>
                                    </a>
                                    <div class='cart-dropdown' id='contenidocarrito' data-sesion='{$data}'>
                                        

                                    </div>
                                </div>
                            ";


                    ?>

                    <!-- /Wishlist -->

                    <!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->

                   
                </div>
            </div>
            <!-- /ACCOUNT -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</div>
<!-- /MAIN HEADER -->
</header>