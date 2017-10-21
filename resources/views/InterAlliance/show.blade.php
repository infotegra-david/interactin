@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('requires')

	<?php

	//require_once(base_path()."/resources/views/inc/...");
	
	?>

@endsection

@section('styles')
	<style type="text/css">

		#bootstrap-wizard-1 > div.form-bootstrapWizard > ul > li{
			height: 80px;
		}

	</style>

@endsection

@section('head_vars')

	<?php
	/*---------------- PHP Custom Scripts ---------

	YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$pagetitle = "Vista de la Alianza";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	if( $peticion == "normal" ){
		$your_style = 'bootstrap-select.min.css,your_style.css';
	}elseif( $peticion == "limpio" ){
		$your_style = '';
	}

	$your_script = '/js/plugin/sparkline/jquery.sparkline.min.js';
	

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php

	$page_nav = 1;
	$menu="InterAlliance";
	$submenu1="Alliances";
	//$submenu2='';
	?>

@endsection

@section('content')

		<!-- MAIN CONTENT -->
		<div id="contenido">
			@if( $peticion == "normal" )
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterAlliance <span>&gt; Vista de la Alianza </span></h1>
				</div>

				<!-- right side of the page with the sparkline graphs -->
				<!-- col -->
				<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
					<!-- sparks -->
					<ul id="sparks">
						<li class="sparks-info">
							<h5> Mis alianzas <span class="txt-color-blue">171</span></h5>
							<div class="sparkline txt-color-blue hidden-mobile">
								1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
							</div>
						</li>
					</ul>
					<!-- end sparks -->
				</div>
				<!-- end col -->
			</div>
			@endif
			<!-- widget grid -->
			<section id="widget-grid" class="">
			
				<!-- row -->
				<div class="row">
					
				    <div class="hide content text-center" id="datos_alianza">
						<div class="col-sm-12">
							<div class="content-header content-center text-left">
						        <h1>
						            Datos de la Alianza #{{ $alianzaId }}
						        </h1>
					    	</div>
					    </div>
						
					    <div class="col-sm-12">
					        <div id="flash-msg">
					            @include('flash::message')  
					            @include('adminlte-templates::common.errors')
					        </div>
					    </div>
				        <div class="box box-primary">
				            <div class="box-body content-center text-left">
				                <div class="row" style="padding-left: 20px">
				                    @include('InterAlliance.show_fields')
				                    @if( $peticion == "normal" )
						                <div class="col-sm-12">
						                	<div class="col-sm-12">
						                    <a href="{!! route('interalliances.index') !!}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
							                @if( $editar == true )
							                    <a href="{!! route('interalliances.edit',$alianzaId) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
							                @endif
						                	</div>
						                </div>
				                    @endif
				                </div>
				            </div>
				        </div>
				    </div>

				</div>
			
				<!-- end row -->
			
			</section>
			<!-- end widget grid -->

		</div>
		<!-- END MAIN CONTENT -->

@endsection

@section('scripts')


	<!-- PAGE RELATED PLUGIN(S) -->
	<script type="text/javascript">

		$(document).ready(function() {

	        $('div#datos_alianza div:not(.no_tocar)').removeClass('form-group').removeClass('input-group').removeClass('form-control');
	        $('div#datos_alianza').removeClass('hide');

		});

	</script>
@endsection