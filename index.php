<?php
session_start();
require_once("php/daos/ProductoDaoImpl.php");
require_once("php/clases/Producto.php");
require_once("php/daos/CategoriaDaoImpl.php");
require_once("php/clases/Usuario.php");
require_once("php/clases/Categoria.php");
if(isset($_SESSION['usuario'])){
$usuarioActual=unserialize($_SESSION['usuario']);
    }
$gestorProductos=new ProductoDaoImpl();
$gestorCategorias=new CategoriaDaoImpl();

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		
		<link type="text/css" rel="stylesheet" href="css/submenu.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    
        <link rel="icon" href=img/logo.ico>
        
        <script>
function vibrar() {
  
  navigator.vibrate([500]);
}
</script>
<script src="js/script1.js"></script>
   
   
   
   
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
					    
						<li><a href="#"><i class="fa fa-phone"></i> 900 12 12 12</a></li>
						<li><a href="mailto:info@electro.com"><i class="fa fa-envelope-o"></i>info@electro.com</a></li>
						<li><a href="https://www.google.es/maps/place/Paseo+de+la+Habana,+132,+28036+Madrid/@40.4568672,-3.6830803,17z/data=!3m1!4b1!4m5!3m4!1s0xd422921b32f9eff:0xb29220196c68c3dc!8m2!3d40.4568672!4d-3.6808916" target="_blank"><i class="fa fa-map-marker"></i>Paseo de la Habana 132, Madrid</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-euro"></i>Euro</a></li>
						<?php 
                        if(!isset($usuarioActual)){
                            
                       
                        ?>
						<li><a href="registro.php"><i class="fa fa-user-o"></i>Mi cuenta</a></li>
                       <?php  } ?>
                        <li><a href="#"><?php
                            if(isset($usuarioActual)){
                                echo $usuarioActual->get_nombre();
                                echo "&nbsp";
                                echo "&nbsp";
                                echo "&nbsp";
                                echo "&nbsp";
                                echo "<a href='Gestor.php?logout'>Cerrar sesión</a>";
                            }?></a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="electro">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select" onchange="location= this.value" >
									    <option value="">------------</option>
										<option value="index.php">Todas las categorias</option>
										<option value="product.php?categoria=1">Laptops</option>
										<option value="product.php?categoria=2">Smartphones</option>
										<option value="product.php?categoria=3">Cámaras</option>
										<option value="product.php?categoria=4">Accesorios</option>
									</select>
									
									<button class="search-btn" disabled>Buscar</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a href="checkout.php">
										<i class="fa fa-shopping-cart"></i>
										<span>Tu carrito</span>
										<div id="carritocant" class="qty">
                                           <?php 
                                            if(isset($_SESSION['usuario'])){
                                            echo $gestorProductos->calcularCarrito($usuarioActual->get_idUsuario()); 
                                            }else{
                                                echo 0;
                                            }
                                            ?></div>
									</a>
									
								</div>
								<!-- /Cart -->

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
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Principal</a></li>
						<li><a href="">Productos</a>
						    <ul>
								<li><a href="product.php?categoria=1">Laptops</a></li>
								<li><a href="product.php?categoria=2">Smartphones</a></li>
								<li><a href="product.php?categoria=3">Cámaras</a></li>
								<li><a href="product.php?categoria=4">Accesorios</a></li>
							</ul>
						</li>
						
						<li><a href="checkout.php">Pedido</a></li>
						
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
				
					<?php $categorias=$gestorCategorias->findAll();
                        foreach ($categorias as $c){
                            
                        ?>      
                        
					<div class="col-md-3 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/<?=$c->get_foto()?>" alt="">
							</div>
							<div class="shop-body">
								<h3><?=$c->get_Nombre()?><br>Colección</h3>
								<a href="product.php?categoria=<?=$c->get_idCategoria()?>" class="cta-btn">Comprar <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					
					<?php
					}?>
				</div>
				
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Nuestros productos</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
								    <?php 
                                    $categorias=$gestorCategorias->findAll();
                                    $clase="active";
                                    foreach($categorias as $c){
                                        
                                        ?>
<!--                                        <li><a class=<?=$clase?> data-toggle="tab" href="#tab1"><?=$c->get_Nombre()?></a></li>-->
                                        <?php
                                            $clase="";
                                    }
                                    ?>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										<?php
										
										$productos=$gestorProductos->findAll();
										
										foreach($productos as $p){
										
										$nombreCategoria=$gestorCategorias->findById($p->get_IdCategoria())->get_nombre();
										$precioRebajado=$p->get_precioRebajado();
                                        $precioNormal=$p->get_precioNormal();
                                        $descuento=(1-($precioRebajado/$precioNormal))*100;
										?>
										<div class="product">
											<div class="product-img">
												<img src="./img/<?=$p->get_foto()?>" alt="">
												<div class="product-label">
													<span class="sale">-<?=number_format($descuento,0)?>%</span>
													
												</div>
											</div>
											<div class="product-body">
												<p class="product-Category"><?=$nombreCategoria?></p>
												<h3 class="product-name"><a href="#"><?=$p->get_nombre()?></a></h3>
												<h4 class="product-price"><?=$p->get_precioRebajado()?>&nbsp;<del class="product-old-price"><?=$p->get_precioNormal()?></del></h4>
												
												
											</div>
											
										</div>
										<?php
										}
										?>
										<!-- /product -->

									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3 id="dias">02</h3>
										<span>Días</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="horas">10</h3>
										<span>Horas</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="minutos">34</h3>
										<span>Minutos</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="segundos">60</h3>
										<span>Segundos</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">super oferta de la semana</h2>
							<p>hasta un 50% de descuento</p>
							
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					
					<!-- /section title -->

					<!-- Products tab & slick -->
					
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Inscríbete <strong>NEWSLETTER</strong></p>
                                
								<input class="input" type="email" placeholder="Email" id="mailnewsletter">
								<button class="newsletter-btn" onclick="suscribirse()"><i class="fa fa-envelope"></i> Suscribirse</button>
                           
							<div class="modal fade" id="newslettermod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Newsletter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Te has suscrito correctamente
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
							<ul class="newsletter-follow">
								<li>
									<a href="http://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="http://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="https://www.pinterest.es/" target="_blank"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Sobre nosotros</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>Paseo de la Habana 234</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>900 12 12 12</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>info@electro.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categorías</h3>
								<ul class="footer-links">
									<li><a href="#">Ofertas</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cámaras</a></li>
									<li><a href="#">Accesorios</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Información</h3>
								<ul class="footer-links">
									<li><a href="#">Sobre nosotros</a></li>
									<li><a href="#">Contacto</a></li>
									<li><a href="#">Política de privacidad</a></li>
									<li><a href="#">Envíos y devoluciones</a></li>
									<li><a href="#">Terminos y condiciones</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Servicio</h3>
								<ul class="footer-links">
									<li><a href="#">Mi cuenta</a></li>
									<li><a href="#">Ver carrito</a></li>
									<li><a href="#">Lista de deseos</a></li>
									<li><a href="#">Localizar envío</a></li>
									<li><a href="#">Ayuda</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> Electro S.L. Todos los derechos reservados<a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
