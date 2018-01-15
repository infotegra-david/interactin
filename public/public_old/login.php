<?php

@session_start();

unset($_SESSION['error_password']);

function redirigir(){
	$pagina = 'dashboard.php';

	if ( isset($_POST['page']) || isset($_GET['page']) ) {
		$page = isset($_POST['page'])? $_POST['page'] : $_GET['page'];
		switch ( $page ) {
			case 'InterChange':
				$pagina = 'interout.php';
				break;
			case 'InterAliance':
				$pagina = 'interalliance-map.php';
				break;
			case 'InterActions':
				$pagina = 'opportunities.php';
				break;
		}		
	}

	header("Location: ".$pagina); /* Redirect browser */
	exit();

}

if ( isset( $_POST['email'] ) && isset( $_POST['password'] ) ) {
	$emailsValidos = ['interactin@usta.edu.co','interactin@ausjal.edu.co'];
	if ( in_array( $_POST['email'] , $emailsValidos) &&  $_POST['password'] == 'inter2017actin' ) {
		$_SESSION["username"] = "Juan Bernal";
		$GLOBALS["username"] = "Juan Bernal";
		//echo '<script type="text/javascript">alert("-'.$_SESSION["username"].'- \n -'.session_status.'-");</script>';
		
		redirigir();
		
	}else{
		$_SESSION['error_password'] = true;

	}
}

if( isset( $_SESSION["username"] ) ){
	redirigir();
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

	<div id="logo-groups">
		<span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="SmartAdmin"> </span>

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
					<form action="<?php echo APP_URL; ?>/login.php" id="login-form" class="smart-form client-form" method="post">
						<header>
							Ingreso
						</header>

						<fieldset>
							
							<?php	
								if ( isset( $_SESSION['error_password'] ) ) {
								
							?>

							<div class="alert alert-danger fade in">
								<button class="close txt-color-danger" data-dismiss="alert">
									×
								</button>
								<strong>Error!</strong> El E-mail o el Password no son correctos.
							</div>
							
							<?php

								}
								
							?>

							<section>
								<label class="label">E-mail</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="email" name="email">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Por favor, ingrese un email valido</b></label>
							</section>

							<section>
								<label class="label">Password</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Ingrese su password</b> </label>
								<div class="note">
									<a href="#">Olvido su password?</a>
									<!--a href="<?php echo APP_URL; ?>/forgotpassword.php">Olvido su password?</a-->
								</div>
							</section>

							<section>
								<label class="checkbox">
									<input type="checkbox" name="remember" checked="">
									<i></i>Manter la sesión</label>
							</section>
						</fieldset>
						<footer>
							<?php 
								if ( isset($_GET['page']) ) {


									echo '<input type="hidden" name="page" value="'. $_GET['page'] .'">';
								}

							?>
							<button type="submit" class="btn btn-primary">
								Ingresar
							</button>
						</footer>
					</form>

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

	$(function() {
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				email : {
					required : true,
					email : true
				},
				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				}
			},

			// Messages for form validation
			messages : {
				email : {
					required : 'Por favor, ingrese su email',
					email : 'Por favor, ingrese una cuenta valida'
				},
				password : {
					required : 'Por favor ingrese su password'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});
</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>