<?php
/*
if ( isset($_POST['email']) && isset($_POST['password']) ) {
	if ( $_POST['email'] == 'bienvenido@interactin.com' &&  $_POST['password'] == 'interactin2017' ) {
		$_SESSION['username'] = 'Juan Bernal';
		header("Location: dashboard.php"); 
		exit();
		
	}else{
		$_SESSION['error_password'] = true;

	}
}
*/

if ( isset( $_GET['logout'] ) ) {
	@session_destroy();
	@session_destroy();
}

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Ingreso";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include("inc/header.php");


?>
<style type="text/css">

	html, #extr-page{
		background: none;
	}
	body {
	    /*
	    background: url(img/fondo.jpg) rgb(255, 255, 255) !important;
	    background-repeat: no-repeat !important;
	    background-attachment: fixed !important;
	    background-position: bottom !important;
	    background-size: 100% !important;
	    */
	}


	body div, #extr-page #main{
		background: none;
	}

	#extr-page #main .container{
		/*background: #fff;*/
	}

</style>

<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
	<!--<span id="logo"></span>-->

	<div id="logo-groups" class="logo_inicio">
		<span id="logo"> 
			<a href="<?php echo ASSETS_URL; ?>">
				<img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="InterActin"> 
			</a>
		</span>
		<!-- END AJAX-DROPDOWN -->
	</div>

	<span id="extr-page-header-space"> 
		<span class="hidden-mobile hiddex-xs">Necesita una cuenta?</span> 
		<a href="#" class="btn btn-danger">Crear una cuenta</a> 
		<!--a href="<?php echo APP_URL; ?>/register.php" class="btn btn-danger">Crear una cuenta</a--> 
	</span>

</header>

 <div id="particles-js"></div>


<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
    particlesJS.load('particles-js', 'js/particlesjs-config.json', function() {
        console.log('callback - particles.js config loaded');
    });
</script>

<div id="main" role="main" class="login">

	<!-- MAIN CONTENT -->
	<div id="content" class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
				<h1 class="txt-color-red login-header-big">Interactin</h1>
				<div class="hero">

					<div class="pull-left login-desc-box-l">
						<h4 class="paragraph-header">El lugar donde tus expectativas se convierten en realidad!</h4>
					</div>
					
					<img src="<?php echo ASSETS_URL; ?>/img/demo/estudiantes.png" class="pull-right display-image" alt="" style="width:280px">

				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h5 class="about-heading">Nuevas oportunidades para globalización</h5>
						<p>
							Después de haber creado 12 alianzas nuevas en paises Europeos se ha incrementado la movilidad un 25%.
						</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h5 class="about-heading">Animate a conocer el mundo</h5>
						<p>
							Tenemos 45 propuestas para que complementes tus estudios en el exterior
						</p>
					</div>
				</div>

			</div>
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
				<div class="well no-padding">


					<!-- acordion  -->
					<!-- MAIN CONTENT -->
					<div id="content">
						<section id="widget-grid" class="">
							
							<?php
								$ui = new SmartUI;
								$ui->start_track();
								
								// smartui code
								$panels = array(
									'panel1' => '<i class="fa fa-lg fa-fw fa-exchange txt-color-black" style="display: initial;" ></i> InterChange',
									'panel2' => '<i class="fa fa-lg fa-fw fa-handshake-o txt-color-black" style="display: initial;" ></i> InterAliance',
									'panel3' => '<i class="fa fa-lg fa-fw fa-map-signs txt-color-black" style="display: initial;" ></i> InterActions'
								);
								$accordion = $ui->create_accordion($panels);

								$accordion->content('panel1', 
									'<p class="form-group">
										Este modulo del sistema permite que los estudiantes y profesores se registren, para diligenciar una solicitud formal con fines de movilidad académica local, 
										nacional o internacional a través de un sistema de validación, trazabilidad y registro en línea.
									</p>

									<p class="form-group">
										<a href="'. APP_URL .'/login.php?page=InterChange" class="btn btn-sm btn-success">Ingresar</a>
									</p>'
								);

								$accordion->content('panel2', 
									'<p class="form-group">
										Este modulo del sistema permite registrar y consolidar los convenios que se realicen permitiendo que la comunidad académica pueda verificar y hacer uso de los convenios, 
										organizándolos por diferentes categorías y generando reportes e indicadores de los mismos. 
									</p>

									<p class="form-group">
										<a href="'. APP_URL .'/login.php?page=InterAliance" class="btn btn-sm btn-success">Ingresar</a>
									</p>'
								);

								$accordion->content('panel3', 
									'<p class="form-group">
										Este modulo del sistema permite visualizar las oportunidades de movilidad y proponer iniciativas.
									</p>

									<p class="form-group">
										<a href="'. APP_URL .'/login.php?page=InterActions" class="btn btn-sm btn-success">Ingresar</a>
									</p>'
								);

								$accordion->options('global_icons', array('fa fa-fw fa-plus-square txt-color-green pull-right', 'fa-fw fa-minus-square txt-color-red pull-right'));

								$accordion_html = $accordion->print_html(true);
								$body = $accordion_html;
								echo $body;
								/*
								$ui->create_widget()->body('content', $body)
									->options('editbutton', false)
									->print_html();
								    //->header('title', '<h2>SmartUI::Accordion</h2>')->print_html();
								*/

								 /*
								// print html output
								$run_time = $ui->run_time(false);
								$hb = new HTMLIndent();
								$html_snippet = SmartUtil::clean_html_string($hb->indent($body), false);
								
								$contents = array(
									"body" => '<pre class="prettyprint linenums">'.$html_snippet.'</pre>',
									"header" => array(
										"icon" => 'fa fa-code',
										"title" => '<h2>HTML Output (Run Time: '.$run_time.')</h2>'
									)
								);
								$options = array(
									"editbutton" => false,
									"colorbutton" => false,
									"collapsed" => true
								);

								$ui->create_widget($options, $contents)->color('pink')->print_html();
								*/
	

							?>
							
						</section>
					</div>

				</div>
				
				<h5 class="text-center"> - Siguenos en -</h5>
													
								<ul class="list-inline text-center">
									<li>
										<a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
									</li>
									<li>
										<a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
									</li>
								</ul>
				
			</div>
		</div>
	</div>

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	runAllForms();

</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>