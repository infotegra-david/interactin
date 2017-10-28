
<?php


@session_start();
$_SESSION["username"] = (isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email );

//initilize the page
require_once(base_path()."/resources/views/inc/init.php");


//require UI configuration (nav, ribbon, etc.)
require_once(base_path()."/resources/views/inc/config.ui.php");

?>

@yield('requires')

@yield('head_vars')

<?php
	/*---------------- PHP Custom Scripts ---------

	YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$page_title = (isset($pagetitle)? $pagetitle :"Inicio");

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css = ( isset($your_style)? explode(",", $your_style) : array("your_style.css") );
	$page_script = ( isset($your_script)? explode(",", $your_script) : array() );

?>
	@include('inc.header')

<?php

	if ( $page_nav != 0 ) {
	    if ( isset($page_nav_route) ) {
	        // $page_nav += $page_nav_route;
	        $page_nav = array_merge_recursive($page_nav, $page_nav_route);
	    }elseif ( isset($submenu2) ) {
	        $page_nav[ $menu ]["sub"][ $submenu1 ]["sub"][ $submenu2 ]["active"] = true;
	    }else{
	        $page_nav[ $menu ?? "dashboard"]["sub"][ $submenu1 ?? "Administrador"]["active"] = true;
	        
	    }
?>
	    
	    @include("inc.nav")

<?php

	}

?>


@yield('styles')

<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//incluir ruta de archivos en local storage

		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$menu = (isset($menu) ? $menu : 'vacio');
		$urlBreadcrumbs = (isset($page_nav[$menu]["raiz"]) ? $page_nav[$menu]["raiz"] : '' );
		$nameBreadcrumbs = (isset($page_nav[$menu]["title"]) ? $page_nav[$menu]["title"] : 'Forms' );
		$breadcrumbs[$nameBreadcrumbs] = $urlBreadcrumbs;
		
	?>
	@include("inc.ribbon")

	<div id="content">
		@yield('content')
	</div>	
	
	<div id="container-loading"><i class="iconfont icon-loading_a"></i></div>
	
</div>
<!-- END MAIN PANEL -->
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
@include('inc.footer')
<!-- END PAGE FOOTER -->

<!-- include required scripts -->
@include('inc.scripts')

@yield('scripts')


    <script>
    	
        (function() {
            //esta funcion permite, al momento de enviar una peticion ajax, la ejecucion de la pantalla que muestra un gif con tres puntos
            $(document).on({
                ajaxStart: function() { $('#container-loading').addClass("show"); },
                ajaxStop: function() { $('#container-loading').removeClass("show"); }    
            });

            //se encarga mostrar la pantalla que muestra un gif con tres puntos cuando se da click en un link que recargue la pagina
            $(document).on('click','nav a',function(e){
                $('#container-loading').addClass("show");
            });


			$(document).on('submit','form',function(){
				$('#container-loading').addClass("show");
			});

        })();
    </script>

<?php

	//include footer
	include(base_path()."/resources/views/inc/google-analytics.php"); 
?>

	</body>

</html>