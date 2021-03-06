<?php
session_start();
require_once("php/clases/Producto.php");
require_once("php/daos/ProductoDaoImpl.php");
require_once("php/clases/Usuario.php");
if(isset($_SESSION['usuario'])){
$usuarioActual=unserialize($_SESSION['usuario']);
    }
$gestorProductos=new ProductoDaoImpl();
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
        
    </head>
	<body <?php if(isset($_GET['compra'])){ echo "onload=\"$('#compraRealizada').modal({show:true});\""; } ?>>
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
									<img src="./img/logo.png" alt="">
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
										<div id="carritocant" class="qty"><?php 
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
						<li ><a href="index.php">Principal</a></li>
						<li><a href="">Productos</a>
						    <ul>
								<li><a href="product.php?categoria=1">Laptops</a></li>
								<li><a href="product.php?categoria=2">Smartphones</a></li>
								<li><a href="product.php?categoria=3">Cámaras</a></li>
								<li><a href="product.php?categoria=4">Accesorios</a></li>
							</ul>
						</li>
						
						<li class="active"><a href="checkout.php">Pedido</a></li>
						
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Dirección de Envio</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="Nombre" 
                                        <?php 
                                           if(isset($_SESSION['usuario'])){
                                            echo " value=\"".$usuarioActual->get_nombre()."\""; 
                                           }
                                        ?>
                                           >
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Apellidos" 
                                        <?php 
                                           if(isset($_SESSION['usuario'])){
                                            echo " value=\"".$usuarioActual->get_apellido()."\""; 
                                           }
                                        ?>
                                           >
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" 
                                        <?php 
                                           if(isset($_SESSION['usuario'])){
                                            echo " value=\"".$usuarioActual->get_email()."\""; 
                                           }
                                        ?>
                                           >
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Dirección"
                                        <?php 
                                           if(isset($_SESSION['usuario'])){
                                            echo " value=\"".$usuarioActual->get_direccion()."\""; 
                                           }
                                        ?>
                                           >
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="Ciudad"
                                        <?php 
                                           if(isset($_SESSION['usuario'])){
                                            echo " value=\"".$usuarioActual->get_ciudad()."\""; 
                                           }
                                        ?>
                                           >
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="País" 
                                        <?php 
                                           if(isset($_SESSION['usuario'])){
                                            echo " value=\"".$usuarioActual->get_pais()."\""; 
                                           }
                                        ?>
                                           >
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="Código Postal" 
                                        <?php 
                                           if(isset($_SESSION['usuario'])){
                                            echo " value=\"".$usuarioActual->get_codigoPostal()."\""; 
                                           }
                                        ?>
                                           >
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Teléfono"
                                        <?php 
                                           if(isset($_SESSION['usuario'])){
                                            echo " value=\"".$usuarioActual->get_telefono()."\""; 
                                           }
                                        ?>
                                           >
							</div>
						</div>
						<!-- /Billing Details -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Su pedido</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCTO</strong></div>
								<div><strong>TOTAL</strong></div>
								<div><Strong>QUITAR</Strong></div>
							</div>
							<?php 
                            if(isset($_SESSION['usuario'])){

                                echo $gestorProductos->findFilaPedido($usuarioActual->get_idUsuario()); 

                            }
                            ?>
							<div class="order-col">
								<div>Gastos de envío</div>
								<div><strong>SIN CARGO</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">€<?php
                                    if(isset($_SESSION['usuario'])){
                                    echo $gestorProductos->calcularTotal($usuarioActual->get_idUsuario()); 
                                    }
                                        ?></strong></div>
							</div>
						</div>
						<div class="modal" id="quitarpedido" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Eliminar este pedido</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>¿Estás seguro de que quieres eliminar este pedido?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="confirmarquitar();" data-dismiss="modal">Si</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                              </div>
                            </div>
                          </div>
                        </div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								Acepto los terminos y condiciones
							</label>
						</div>
						<?php if(isset($_SESSION['usuario'])){ ?>
						<a href="#" class="primary-btn order-submit" <?php 
                                            if(isset($_SESSION['usuario'])){
                                            $num = $gestorProductos->calcularCarrito($usuarioActual->get_idUsuario());
                                                if($num!=0){
                                                     echo 'onclick="comprar('.$gestorProductos->obtenerPedido($usuarioActual->get_idUsuario()).','.$usuarioActual->get_idUsuario().');"';
                                                }
                                            }
                                           
                        ?>
                        >Comprar</a>
						<?php } ?>
						<div class="modal fade" id="compraRealizada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Compra efectuada</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Su pedido llegará a su domicilio en un periodo inferior a 7 días
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
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
								<h3 class="footer-title">Sobre Nosotros</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>Paseo de la Habana 234</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+900 12 12 12 </a></li>
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
									<li><a href="#">Politica de privacidad</a></li>
									<li><a href="#">Pedidos y devoluciones</a></li>
									<li><a href="#">Términos y condiciones</a></li>
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
									<li><a href="#">Localizar pedido</a></li>
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
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> Electro S.A. Todos los derechos reservados <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
