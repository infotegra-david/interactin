@extends('layouts.index_base')

@section('requires')

	<?php

	require_once(base_path()."/resources/views/inc/init.php");
	
	?>

@endsection

@section('styles')

    <style type="text/css">
        
        #particles-js {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

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

	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
		<div class="well no-padding">

			<!-- acordion  -->
			<!-- MAIN CONTENT -->
			<div id="content">
				<section id="widget-grid" class="">
					
					<?php
						$ui = new SmartUI;
						$ui->start_track();
						$loggedin = false;
						if (Auth::check()){
							$loggedin = true;
						}
						
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
								
							</p>'
						);

						$accordion->content('panel2', 
							'<p class="form-group">
								Este modulo del sistema permite registrar y consolidar los convenios que se realicen permitiendo que la comunidad académica pueda verificar y hacer uso de los convenios, 
								organizándolos por diferentes categorías y generando reportes e indicadores de los mismos. 
							</p>

							<p class="form-group">
								
							</p>'
						);

						$accordion->content('panel3', 
							'<p class="form-group">
								Este modulo del sistema permite visualizar las oportunidades de movilidad y proponer iniciativas.
							</p>

							<p class="form-group">
								<!--a href="'. ($loggedin ? 'html/opportunities.php' : route('login') .'?page=InterActions').'" class="btn btn-sm btn-success">Ingresar</a-->
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
			
			</div><!-- /.content -->
		</div><!-- /div -->
	</div><!-- /.row -->

@endsection