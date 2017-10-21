
<?php

//initilize the page
require_once(base_path()."/resources/views/inc/init.php");


//require UI configuration (nav, ribbon, etc.)
//require_once(base_path()."/resources/views/inc/config.ui.php");

?>

@yield('requires')

<?php
/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = (isset($pagetitle)? $pagetitle :"Inicio");

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");


?>
@include('inc.header')


<style type="text/css">

    html, #extr-page{
        background: none;
    }
    body {
        /*background: url(img/fondo.jpg) rgb(255, 255, 255) !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
        background-position: bottom !important;
        background-size: 100% !important;*/
    }


    body div, #extr-page #main{
        background: none;
    }

    #extr-page #main .container{
        /*background: #fff;*/
    }

</style>

@yield('styles')


<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
    <!--<span id="logo"></span>-->

    <div id="logo-groups" class="logo_inicio">
        <span id="logo"> 
            <a href="{{ route('index') }}">
                <img src="{{URL::asset('img/logo.png')}}" alt="InterActin"> 
            </a>
        </span>
        <!-- END AJAX-DROPDOWN -->
    </div>

    

    <span id="extr-page-header-space"> 
        <!-- si no esta logueado -->
        @if (Auth::guest())
            @if ( !Request::is('login*') )
                <a class="btn btn-success" href="{{ url('/login') }}">Iniciar sesión</a>
            @endif
            @if ( !Request::is('register*') )
                <a class="btn btn-primary" href="{{ url('/register') }}">Registrarse</a>
            @endif
        @else
        <!-- cuando si esta logueado -->
            <a class="btn btn-primary" href="{{ url('/home') }}">Ir al Home</a>
            <a class="btn btn-danger" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar sesión</a>
        @endif
        
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

<div id="main" role="main">

	<!-- MAIN CONTENT -->
	<div id="content" class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 hidden-xs hidden-sm">
                <h1 class="txt-color-red login-header-big">&nbsp;</h1>
                <div class="hero">

                    <div class="pull-left login-desc-box-l">
                        <h4 class="paragraph-header">El lugar donde tus expectativas se convierten en realidad!</h4>
                    </div>
                    
                    <img src="{{URL::asset('img/demo/estudiantes.png')}}" class="pull-right display-image" alt="" style="width:280px">

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

            <!--  --------------------------------------------------- -->


			@yield('content')

			
            <!--  --------------------------------------------------- -->

            
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 pull-right">
                
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

            <!-- ==========================CONTENT ENDS HERE ========================== -->


		</div>
		<!-- END row PANEL -->
	</div>
	<!-- END content PANEL -->
</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->


<!-- include required scripts -->
@include('inc.scripts')


<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	runAllForms();

</script>



@yield('scripts')



<?php

//include footer
include(base_path()."/resources/views/inc/google-analytics.php"); 
?>
