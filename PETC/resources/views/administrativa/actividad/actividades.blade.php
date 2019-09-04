<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="colorlib">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>ACTIVIDAD RECIENTE PETC</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700|Roboto:400,500" rel="stylesheet">
	<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">
			<link rel="stylesheet" href="css/main.css">
		</head>

		<body>

			<!-- Start Header Area -->
			<header class="default-header">
				<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container">
						<a class="navbar-brand" href="/">
							<img src="img/logopetc.png" width="95px" height="45px" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="fa fa-bars"></span>
					</button>

					<div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
						<ul class="navbar-nav">
							<li><a href="/">Inicio</a></li>
							<li><a class="active" href="about">Nosotros</a></li>
							<li><a href="services">Servicios</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
									Áreas
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="projects.html">Nomina y Sistemas</a>
									<a class="dropdown-item" href="projects.html">Academicos</a>
									<a class="dropdown-item" href="projects.html">Materiales</a>
									<a class="dropdown-item" href="projects.html">Alimentación</a>
								</div>
							</li>
							<li><a href="contact">Contacto</a></li>
							<li><a href="contact.html">Registro</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<!-- End Header Area -->

		<!-- Start top-section Area -->
		<section class="banner-area relative">
			<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row justify-content-between align-items-center text-center banner-content">
					<div class="col-lg-12">
						<h1 class="text-white">ACTIVIDAD RECIENTE PETC</h1>
						<p></p>
					</div>
				</div>
			</div>
		</section>
		<!-- End top-section Area -->

		@foreach($actividad  as $actividad)


		<!-- Start About Area -->
		<section class="about-area section-gap-bottom">
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<div class="col-lg-7 col-md-12 about-left">						
						<a target="_blank" href="{{asset('img/administrativa/actividad/'.$actividad->archivo)}}"><img  class="img-fluid" src="{{asset('img/administrativa/actividad/'.$actividad->archivo)}}"  title="$actividad->nombre_actividad" ></a>
					</div>
					<div class="col-lg-5 col-md-12 about-right">
						<div class="section-title text-left">

							<h2>{{$actividad->nombre_actividad}}<br />
								</h2>
							</div>
							<div align="justify">
								<p>
									<b> LUGAR:<b/> {{$actividad->lugar}} <br/>
									<b> FECHA:<b/> {{$actividad->fecha}} <br/>
									<b> ÁREA:<b/> {{$actividad->area}} <br/>
									<b> MOTIVO:<b/> {{$actividad->motivo}} <br/>
									<b> DESCRIPCIÓN:<b/> {{$actividad->descripcion}} <br/>
									<b> CICLO ESCOLAR:<b/> {{$actividad->ciclo}} <br/>
								</p>
							</div>

						</div>
					</div>
				</div>
			</section>
			<!-- End About Area -->

	@endforeach




			<!-- start footer Area -->
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-6 single-footer-widget">
							<h4>PETC</h4>
							<ul>
								<li><a href="#">Busca Tu Escuela</a></li>
								<li><a href="#">Quejas y Denuncias</a></li>
								<li><a href="#">Historico del Programa</a></li>
								<li><a href="#">Ayuda</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-6 single-footer-widget">
							<h4>Propuesta Pedagógica</h4>
							<ul>
								<li><a href="#">Ficheros Didacticos</a></li>
								<li><a href="#">Herramientas</a></li>
								<li><a href="#">Guias</a></li>
								<li><a href="#">Lineas de Trabajo</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-6 single-footer-widget">
							<h4>Areas</h4>
							<ul>
								<li><a href="#">Alimentación</a></li>
								<li><a href="#">Nomina</a></li>
								<li><a href="#">Materiales</a></li>
								<li><a href="#">Academica</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-6 single-footer-widget">
							<h4>Recursos</h4>
							<ul>
								<li><a href="#">Avisos</a></li>
								<li><a href="#">Documentos</a></li>
								<li><a href="#">Circulares</a></li>
								<li><a href="#">Comunicados</a></li>
							</ul>
						</div>
						<div class="col-lg-4 col-md-6 single-footer-widget">
							<h4>Subscribete</h4>
							<p>A todos los Eventos del PETC</p>
							<div class="form-wrap" id="mc_embed_signup">
								<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
								method="get" class="form-inline">
								<input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address'"
								required="" type="email" />
								<button class="click-btn btn btn-default">
									<span>subscribe</span>
								</button>
								<div style="position: absolute; left: -5000px;">
									<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text" />
								</div>

								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="row footer-bottom d-flex justify-content-between">
					<p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Sitio Elaborado por  <a href="https://colorlib.com" target="_blank">ISC Luis Viramontes, ISC Daniel Pacheco</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
					<div class="col-lg-4 col-sm-12 footer-social">
						<a href="#"><i class="fa fa-facebook-f"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
			</div>
		</footer>
		<!-- End footer Area -->

		<script src="js/vendor/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
		crossorigin="anonymous"></script>
		<script src="js/vendor/bootstrap.min.js"></script>
		<script src="js/jquery.ajaxchimp.min.js"></script>
		<script src="js/parallax.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/isotope.pkgd.min.js"></script>
		<script src="js/jquery.nice-select.min.js"></script>
		<script src="js/jquery.magnific-popup.min.js"></script>
		<script src="js/jquery.sticky.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
