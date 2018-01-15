@extends('layouts.index_base')

@section('requires')

	<?php

	require_once(base_path()."/resources/views/inc/init.php");
	
	?>

@endsection

@section('styles')

    <style type="text/css">
        

        html, body {
            /*background-color: #fff;*/
            /*color: #636b6f;*/
            height: 100vh;
            margin: 0;
        }

        #extr-page #main {
            z-index: 555;
        }

        #extr-page #header {
            border-bottom: none !important;
            background-color: #fbfbfb !important;
        }

        #extr-page .hero {
            background: none;
        }

        #content, #content a, #content a i {
            color: black;
        }


    </style>

@endsection


@section('content')

	<?php

	//require_once(base_path()."/resources/views/inc/init.php");

	/*---------------- PHP Custom Scripts ---------

	YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$pagetitle = "Inicio";
	$smart_style = "0";

	?>

					
	<div id="myCarousel" class="carousel slide home" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="{{URL::asset('img/home/1.jpg')}}" alt="InterActin">
          <div class="carousel-caption">
            <h2><i class="fa fa-lg fa-fw fa-cubes txt-color-black" style="display: initial;" ></i> InterActin</h2>
            <p class="h3">El lugar donde tus expectativas se convierten en realidad!</p>                    
          </div>
        </div>



        <div class="item ">
          <img src="{{URL::asset('img/home/interalliance.jpg')}}" alt="InterAlliances">
          <div class="carousel-caption">
            <h2><i class="fa fa-lg fa-fw fa-handshake-o txt-color-black" style="display: initial;" ></i> InterAliance</h2>
            <p class="h3">Este modulo del sistema permite que los estudiantes y profesores se registren, para diligenciar una solicitud formal con fines de movilidad académica local, nacional o internacional a través de un sistema de validación, trazabilidad y registro en línea.</p>
          </div>
        </div>

        <div class="item">
          <img src="{{URL::asset('img/home/interactions.jpg')}}" alt="InterActions">
          <div class="carousel-caption">
            <h2><i class="fa fa-lg fa-fw fa-globe txt-color-black" style="display: initial;" ></i> InterActions</h2>
            <p class="h3">Este modulo del sistema permite registrar y consolidar los convenios que se realicen permitiendo que la comunidad académica pueda verificar y hacer uso de los convenios, organizándolos por diferentes categorías y generando reportes e indicadores de los mismos. </p>
          </div>
        </div>

        <div class="item">
          <img src="{{URL::asset('img/home/interchange.jpg')}}" alt="InterChange">
          <div class="carousel-caption">
            <h2><i class="fa fa-lg fa-fw fa-exchange txt-color-black" style="display: initial;" ></i> InterChange</h2>
            <p class="h3">Este modulo del sistema permite visualizar las oportunidades de movilidad y proponer iniciativas.</p>
          </div>
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
					
@endsection