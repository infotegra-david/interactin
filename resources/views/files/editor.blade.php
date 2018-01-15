@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('head_vars')

	<?php
	/*---------------- PHP Custom Scripts ---------

	YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$pagetitle = "Editar Documento - ".$documento['nombre'];

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	$your_style = 'bootstrap-select.min.css,your_style.css';
	//$your_style = 'bootstrap-select.min.css';
	

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php

	$page_nav = 1;
	$menu=($menuApp ?? "dashboard");
	$submenu1=($submenu1App ?? "Editar Documento");
	//$submenu2='';
	?>

@endsection


@section('content')
	<div class="row">
		<div id="flash-msg">
	        @include('flash::message')
	        @include('adminlte-templates::common.errors')

	    </div>
	</div>
	<!-- MAIN CONTENT -->
	<div id="content_editor" class="container">
		<div id="content_columns" class="text-left">

			<div class="columns">
				
				<h2><label for="editor1">Editor de documentos</label></h2>	

				<p>
					<h3>A continuacion se muestra el contenido correspondiente a <strong>{{$documento['nombre']}}</strong></h3>
					<br>
					
					@if(isset($editar))
						<h4>Cuando termine de realizar las modificaciones en el documento escoja la opción <strong>'Guardar'</strong></h4>
						<br/>
						@include('files.fields')
					@endif
					<br/>
				</p>

				<div class="col-sm-12">
					<div class="document_editor editor">
						{!! ($documento_contenido ?? '') !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')


	<script type="text/javascript">

		// DO NOT REMOVE : GLOBAL FUNCTIONS!

		$(document).ready(function() {

			'use strict';

			$('button#guardar_documento').on('click', function(){
				var form_target = $(this).attr('form_target');
				$('form'+ form_target).submit();
			});

		})

	</script>

@endsection