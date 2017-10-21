@if($peticion != "limpio" && $peticion != "basico")
	<?php

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

	?>
		@include('inc.header',['no_main_header' => true, 'peticion' => $peticion])

	<style type="text/css">
		.fixed-header #main{
			margin: 0px;
		}
	</style>
@endif

	@yield('styles')

	<!-- ==========================CONTENT STARTS HERE ========================== -->
	<!-- MAIN PANEL -->
	<div id="principal" role="principal">

		@yield('content')
		
		<div id="container-loading"><i class="iconfont icon-loading_a"></i></div>
		
	</div>
	<!-- END MAIN PANEL -->
	<!-- END MAIN PANEL -->
	<!-- ==========================CONTENT ENDS HERE ========================== -->

@if($peticion != "limpio" && $peticion != "basico")

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
	            $(document).on('click','div#menu a',function(e){
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
	
@endif