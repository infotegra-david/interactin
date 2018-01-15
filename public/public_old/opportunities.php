<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Oportunidades";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["InterActions"]["sub"]["Opportunities"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
		<!-- MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> 
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span> 
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li>Home</li><li>InterActions</li><li>Oportunidades</li>
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->
			
			

			<!-- MAIN CONTENT -->
			<div id="content">

				<!-- row -->
				<div class="row">

					<!-- col -->
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark">
							<!-- PAGE HEADER -->
							<i class="fa-fw fa fa-home"></i> InterActions <span>>
								Oportunidades </span>
						</h1>
					</div>
					<!-- end col -->

					<!-- right side of the page with the sparkline graphs -->
					<!-- col -->
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
						<!-- sparks -->
						<ul id="sparks">
							<li class="sparks-info">
								<h5> Oportunidades <span class="txt-color-blue"><i class="fa fa-map-marker" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;71</span></h5>
								<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
									1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
								</div>
							</li>
							<li class="sparks-info">
								<h5> Postulaciones <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
								<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
									110,150,300,130,400,240,220,310,220,300, 270, 210
								</div>
							</li>
							<li class="sparks-info">
								<h5> Viajando <span class="txt-color-greenDark"><i class="fa fa-users"></i>&nbsp;147</span></h5>
								<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
									110,150,300,130,400,240,220,310,220,300, 270, 210
								</div>
							</li>
						</ul>
						<!-- end sparks -->
					</div>
					<!-- end col -->

				</div>
				<!-- end row -->
				
				<div class="row">

					<div class="col-sm-9">

						<div class="well padding-10">


							<div class="row">
								<div class="col-md-4">
									<img src="img/oportunidades/alemania1.jpg" class="img-responsive" alt="img">
									<ul class="list-inline padding-10">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="javascript:void(0);"> Mayo 20, 2017 </a>
										</li>
										<li>
											<i class="fa fa-users"></i>
											<a href="javascript:void(0);"> 20 Postulaciones </a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 padding-left-0">
									<h3 class="margin-top-0"><a href="javascript:void(0);"> Estudiar en Alemania </a><br><small class="font-xs"><i>Published by <a href="javascript:void(0);">John Doe</a></i></small></h3>
									<p>
										El programa se ofrece en Alemania en colegios públicos, para estudiantes de 14 y no mayores de 18 años, que tengan un nivel intermedio alto en Alemán.
										<br><br>Los estudiantes de intercambio en Alemania deberán atender las reglas, ser responsables de asistir a clases y en obtener buenas notas. Las materias que verán depende del grado en el que estén pero las mas importantes son matemáticas, Alemán y otro idioma que puede ser español o Francés. Física, biología historia, geografía artes y deportes.
										<br><br>La estadía de los estudiantes será en familias cuidadosamente seleccionadas, que les proveerán 16 comidas por semana. La acomodación puede ser en habitación sencilla o doble compartiendo con otro estudiante internacional o con otro hijo de la familia que lo acoge.
										<br><br>
									</p>
									<a class="btn btn-primary" href="javascript:void(0);"> Conozca Más </a>
								</div>
							</div>
							<hr>

							<div class="row">
								<div class="col-md-4">
									<img src="img/oportunidades/usa1.jpg" class="img-responsive" alt="img">
									<ul class="list-inline padding-10">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="javascript:void(0);"> Mayo 12, 2017 </a>
										</li>
										<li>
											<i class="fa fa-users"></i>
											<a href="javascript:void(0);"> 38 Postulaciones </a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 padding-left-0">
									<h3 class="margin-top-0"><a href="javascript:void(0);"> ¿Por qué usar Cultural Care Au Pair? </a><br><small class="font-xs"><i>Published by <a href="javascript:void(0);">John Doe</a></i></small></h3>
									<p>
										Cultural Care Au Pair es una de las mejores compañías con reconocimiento en Estados Unidos, porque brinda un excelente apoyo a las personas que viajamos con este programa. 

										<br><br>De hecho en cada zona en la que te encuentres tienes una coordinadora que te colabora con todas tus inquietudes y cuando tienes dificultades ellos te dan apoyo. Otra de las razones es porque la mayoría de mis amigas han viajado con Cultural Care y para todas ellas ha sido una de las mejores experiencias que han tenido en sus vidas.
										<br><br>
									</p>
									<a class="btn btn-primary" href="javascript:void(0);"> Conozca Más </a>
								</div>
							</div>
							<hr>

							<div class="row">
								<div class="col-md-4">
									<img src="img/oportunidades/usa2.jpg" class="img-responsive" alt="img">
									<ul class="list-inline padding-10">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="javascript:void(0);"> Junio 1, 2017 </a>
										</li>
										<li>
											<i class="fa fa-users"></i>
											<a href="javascript:void(0);"> 15 Postulaciones </a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 padding-left-0">
									<h3 class="margin-top-0"><a href="javascript:void(0);"> Campamento Cine & Actuación en USA </a><br><small class="font-xs"><i>Published by <a href="javascript:void(0);">John Doe</a></i></small></h3>
									<p>
										En el Campamento de Actuación tendrás la oportunidad de sentir y vibrar al estilo de Hollywood, la casa de las estrellas, sentirte todo un maestro de actuación y conseguir tus sueños. Este programa de tres semanas te brindará lo ideal en clases de actuación por parte de profesionales maestros de la ciudad de Los Angeles. 

										<br><br>

										Estarás con estudiantes de diferentes partes del mundo, aprenderás tácticas básicas de actuación, entonación, calentamientos, análisis del personaje, improvisación, desarrollo del personaje como además puesta en escena de tu propio rol grabado en DVD al final del campamento de verano. 

										<br><br>

										Este programa incluye  workshops diarios para trabajar en la actuación y preparación de personajes, recorridos por el Theater District y un detrás de escena con 2 producciones en vivo. Tendrás la oportunidad de mejorar tu nivel de inglés con las clases de la mañana y con profesores altamente calificados.
										<br><br>
									</p>
									<a class="btn btn-primary" href="javascript:void(0);"> Conozca Más </a>
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-md-4">
									<img src="img/oportunidades/francia1.jpg" class="img-responsive" alt="img">
									<ul class="list-inline padding-10">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="javascript:void(0);"> Abril 25, 2017 </a>
										</li>
										<li>
											<i class="fa fa-users"></i>
											<a href="javascript:void(0);"> 40 Postulaciones </a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 padding-left-0">
									<h3 class="margin-top-0"><a href="javascript:void(0);"> ¿Por qué estudiar en Francia? </a><br><small class="font-xs"><i>Published by <a href="javascript:void(0);">John Doe</a></i></small></h3>
									<p>
										Numerosas Universidades e Instituciones educativas que ofrecen educación de clase mundial.
										<br><br>
										Según la UNESCO, Francia es el tercer país del mundo que mas acoge estudiantes extranjeros.
										<br><br>
										Los títulos conferidos a los estudiantes extranjeros en Francia son reconocidos en todo Europa.
										<br><br>
										Los estudiantes extranjeros tienen las mismas ventajas que estudiantes Franceses como: Seguridad Social, Subsidio de Vivienda, restaurantes universitarios con precios muy cómodos en las comidas, tarifas reducidas en transporte y en diferentes sitios de entretenimiento.
										<br><br>
										Posibilidad de trabajar hasta el 60% del tiempo legal.
										<br><br>
									</p>
									<a class="btn btn-primary" href="javascript:void(0);"> Conozca Más </a>
								</div>
							</div>	

						</div>

					</div>

					<div class="col-sm-3">
						<div class="well padding-10">
							<h5 class="margin-top-0"><i class="fa fa-search"></i> Busqueda de oportunidades...</h5>
							<div class="input-group">
								<input type="text" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button">
										<i class="fa fa-search"></i>
									</button> </span>
							</div>
							<!-- /input-group -->
						</div>

						<!-- /well -->
						<div class="well padding-10">
							<h5 class="margin-top-0"><i class="fa fa-video-camera"></i> Videos Populares:</h5>
							<div class="row">

								<div class="col-lg-12">

									<ul class="list-group no-margin">
										<li class="list-group-item">
											<a href=""> <span class="badge pull-right">15</span> Estudiar en Canada </a>
										</li>
										<li class="list-group-item">
											<a href=""> <span class="badge pull-right">30</span> ¿Como postularme? </a>
										</li>
										<li class="list-group-item">
											<a href=""> <span class="badge pull-right">9</span> Aprender ingles en USA </a>
										</li>
										<li class="list-group-item">
											<a href=""> <span class="badge pull-right">4</span> Estúdia por el mundo </a>
										</li>
									</ul>

								</div>

								<div class="col-lg-12">
									<div class="margin-top-10">
										<iframe allowfullscreen="" frameborder="0" height="210" mozallowfullscreen="" src="http://player.vimeo.com/video/46396741" webkitallowfullscreen="" width="100%"></iframe>
									</div>
								</div>
							</div>

						</div>
						<!-- /well -->
						<!-- /well -->
						<div class="well padding-10">
							<h5 class="margin-top-0"><i class="fa fa-thumbs-o-up"></i> Siguenos!</h5>
							<ul class="no-padding no-margin">
								<p class="no-margin">
									<a title="Facebook" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></span></a>
									<a title="Twitter" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></span></a>
									<a title="Google+" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x"></i></span></a>
									<a title="Linkedin" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x"></i></span></a>
									<a title="GitHub" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-github fa-stack-1x"></i></span></a>
									<a title="Bitbucket" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-bitbucket fa-stack-1x"></i></span></a>
								</p>
							</ul>
						</div>
						<!-- /well -->
						<!-- /well -->
						<div class="well padding-10">
							<h5 class="margin-top-0"><i class="fa fa-fire"></i> Oportunidades Populares:</h5>
							<ul class="no-padding list-unstyled">
								
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">Fulbright Colombia –Estados Unidos</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">EducationUSA – Estados Unidos</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">Srpach Institut – Alemania</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">Fondo Nacional del Ahorro – Crédito para estudios en el exterior</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">Comuna – Crédito para misiones académicas y estudios</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">Kaplan – Inmersión en segunda lengua, preparación de exámenes internacionales</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">EF Education First – Programa de Au Pair (estudie y trabaje)</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">Global Connection – Cursos de inglés en otros países, inmersiones, intercambios</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">MainPoint – Intercambios, idiomas en otros países</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">Consejería Británica – Idiomas en otros países</a>
								</li>
								<li>
									<i class="glyphicon glyphicon-menu-right"></i>
									<a href="javascript:void(0);" class="margin-top-5">TurIdiomas en el exterior</a>
								</li>

							</ul>
						</div>
						<!-- /well -->
						<!-- /well -->
						<div class="well padding-10">
							<h5 class="margin-top-0"><i class="fa fa-tags"></i> Popular Tags:</h5>
							<div class="row">
								<div class="col-lg-6">
									<ul class="list-unstyled">
										<li>
											<a href=""><span class="badge badge-info">Canada</span></a>
										</li>
										<li>
											<a href=""><span class="badge badge-info">USA</span></a>
										</li>
										<li>
											<a href=""><span class="badge badge-info">España</span></a>
										</li>
										<li>
											<a href=""><span class="badge badge-info">Australia</span></a>
										</li>
									</ul>
								</div>
								<div class="col-lg-6">
									<ul class="list-unstyled">
										<li>
											<a href=""><span class="badge badge-info">Becas</span></a>
										</li>
										<li>
											<a href=""><span class="badge badge-info">Crédito!</span></a>
										</li>
										<li>
											<a href=""><span class="badge badge-info">Educación</span></a>
										</li>
										<li>
											<a href=""><span class="badge badge-info">Patrocinio</span></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /well -->

					</div>

				</div>

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
	// include page footer
	include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>

	$(document).ready(function() {
		// PAGE RELATED SCRIPTS
	})

</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>