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

	$pagetitle = "Subscribir Alianza";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	$your_style = 'bootstrap-select.min.css,your_style.css';
	//$your_style = 'bootstrap-select.min.css';
	$your_script = 'js/my_functions.js';

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php

	$page_nav = 1;
	$menu="InterAlliance";
	$submenu1="SubscribeAlliance";
	//$submenu2='';
	?>

@endsection

@section('content')

		<!-- MAIN CONTENT -->
		<div id="contenido">
			@if( $peticion == "normal" )
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterAlliance <span>&gt; Subscribir Alianza </span></h1>
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
					

				@if( $paso == 1)
					<!-- pre-Registro de una nueva alianza -->
					<!-- NEW WIDGET START -->
					<article class="col-sm-12 col-md-12 col-lg-12">

						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
							<!-- widget options:
							usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

							data-widget-colorbutton="false"
							data-widget-editbutton="false"
							data-widget-togglebutton="false"
							data-widget-deletebutton="false"
							data-widget-fullscreenbutton="false"
							data-widget-custombutton="false"
							data-widget-collapsed="true"
							data-widget-sortable="false"

							-->
							<header>
								<span class="widget-icon"> <i class="fa fa-check"></i> </span>
								<h2 title="Pre-Registro de una Nueva Alianza">Pre-Registro de una Nueva Alianza</h2>

							</header>

							<!-- widget div-->
							<div>

								<!-- widget edit box -->
								<div class="jarviswidget-editbox">
									<!-- This area used as dropdown edit box -->

								</div>
								<!-- end widget edit box -->

								<!-- widget content -->
								<div class="widget-body">

									<div class="row">

					                	<div id="flash-msg">
								            @include('flash::message')
								            @include('adminlte-templates::common.errors')

								        </div>
								        
					                    
						                <div id="PreRegistro_results">
						                	<div id="show-msg" return="">
	                							@include( 'layouts.alerts' )
									        </div>
									    </div>
									    	<?php 
										    	$route = ['interalliances.update', $alliance['alianzaId']];
										    	$method = 'patch';
										    	//para editar cada paso por separado
										    	if( !isset($editar_paso) ){ $editar_paso = false; }
										    	
										    	/*
										    	echo '|'.$editar_paso === false.'|';
										    	echo '|'.$paso.'|';
										    	echo '|'.$editar_paso >= $paso.'|';
										    	*/

									    	 ?>

									    	@if( $editar_paso == false || $editar_paso >= $paso )
						                		@include('InterAlliance.fields_preregistro')
						                	@else
						                		@include('errors.404')
						                	@endif

									</div>

								</div>
								<!-- end widget content -->

							</div>
							<!-- end widget div -->

						</div>
						<!-- end widget -->

					</article>
					<!-- WIDGET END -->
				@endif
				@if( $paso == 4)
					<!-- Registro de una nueva alianza -->
					<!-- NEW WIDGET START -->
					<article class="col-sm-12 col-md-12 col-lg-12">

						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
							<!-- widget options:
							usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

							data-widget-colorbutton="false"
							data-widget-editbutton="false"
							data-widget-togglebutton="false"
							data-widget-deletebutton="false"
							data-widget-fullscreenbutton="false"
							data-widget-custombutton="false"
							data-widget-collapsed="true"
							data-widget-sortable="false"

							-->
							<header>
								<span class="widget-icon"> <i class="fa fa-check"></i> </span>
								<h2 title="Registro de una Nueva Alianza">Registro de una Nueva Alianza</h2>

							</header>

							<!-- widget div-->
							<div>

								<!-- widget edit box -->
								<div class="jarviswidget-editbox">
									<!-- This area used as dropdown edit box -->

								</div>
								<!-- end widget edit box -->

								<!-- widget content -->
								<div class="widget-body">

									<div class="row">
									
					                	<div id="flash-msg">
								            @include('flash::message')
								            @include('adminlte-templates::common.errors')
								        </div>

						                <div id="Registro_results">
						                	<div id="show-msg" return="">
	                							@include( 'layouts.alerts' )
									        </div>
									    </div>

								    	<?php 
									    	$route = ['interalliances.update', $alliance['alianzaId']];
									    	$method = 'patch';
									    	//para editar cada paso por separado
									    	if( !isset($editar_paso) ){ $editar_paso = 0; }
								    	 ?>
								    	@if( $editar_paso !== 0 || $editar_paso >= $paso )
					                		@include('InterAlliance.fields_registro')
					                	@else
					                		@include('errors.404')
					                	@endif

									</div>

								</div>
								<!-- end widget content -->

							</div>
							<!-- end widget div -->

						</div>
						<!-- end widget -->

					</article>
					<!-- WIDGET END -->
				@endif

				</div>
			
				<!-- end row -->
			
			</section>
			<!-- end widget grid -->

		</div>
		<!-- END MAIN CONTENT -->

@endsection

@section('scripts')

	
	{{ Html::script('/js/smartwidgets/jarvis.widget.min.js') }}
	{{ Html::script('/js/plugin/fuelux/wizard/wizard_solo.js') }}
		<!-- JQUERY SELECT2 INPUT -->
	{{ Html::script('/js/plugin/select2/select2.min.js') }}

	
	{{-- Html::script('/js/plugin/fuelux/wizard/wizard_externo.min.js') --}}
	{{-- Html::script('/js/plugin/fuelux/wizard/jquery-wizard.js') --}}
	<!-- { { Html::script('/js/bootstrap/bootstrap-multiselect.js') }} -->
	<!-- { { Html::script('/js/bootstrap/bootstrap-select.min.js') }} -->

	<!-- PAGE RELATED PLUGIN(S) -->
	<script type="text/javascript">

		$(document).ready(function() {
			var formEnviarRetorno = false;


			function mostrarCheckbox_show(thisId,accion){
				if (accion == 'mostrar') {
					if ( $('div.checkbox_show#'+ thisId ).hasClass('disabledContent') ) {
						$('div.checkbox_show#'+ thisId ).removeClass('disabledContent').addClass('enabledContent');
					}
					if ( $('div.checkbox_show#'+ thisId ).hasClass('hide') ) {
						$('div.checkbox_show#'+ thisId ).removeClass('hide');
					}
					$('div.checkbox_show#'+ thisId ).show('fast');

				}else if(accion == 'ocultar'){
					if ( $('div.checkbox_show#'+ thisId ).hasClass('enabledContent') ) {
						$('div.checkbox_show#'+ thisId ).addClass('disabledContent').removeClass('enabledContent');
					}else{
						$('div.checkbox_show#'+ thisId ).hide('fast');
					}
				}

			}
			
			$('input.checkbox_show').each(function(){
				var thisId = $(this).attr('id');
				var thisForm = $(this).parents('form').attr('id');
				var accion = $(this).attr('accion');
				
				//console.log(thisId + ' - ' + $(this).val() + ' - ' + accion);
				
				//tipo radio button
				if ( $(this).is(':radio') && $(this).val() == 'SI' && $(this).is(':checked') ) {
					accion = accion || 'ocultar';
					mostrarCheckbox_show(thisId,accion);
					//especifico para la aceptacion o rechazo de la solicitud de alianza
					if ( thisId == 'aceptar_alianza' ) {
						$(this).parents('form').find('div#aceptar_alianza_enviar').addClass('hide');
						$(this).parents('form').find('div#aceptar_alianza').removeClass('hide');
						$(this).parents('#Registro_content').find('#btnNext').removeClass('disabled');
					}
				}else if ( $(this).is(':radio') && $(this).val() == 'NO' && $(this).is(':checked') )  {
					accion = accion || 'mostrar';
					mostrarCheckbox_show(thisId,accion);
					//especifico para la aceptacion o rechazo de la solicitud de alianza
					if ( thisId == 'aceptar_alianza' ) {
						$(this).parents('form').find('div#aceptar_alianza_enviar').removeClass('hide');
						$(this).parents('form').find('div#aceptar_alianza').addClass('hide');
						$(this).parents('#Registro_content').find('#btnNext').addClass('disabled');
					}
				}

				//tipo checkbox
				if ( $(this).is(':checkbox') && $(this).is(':checked') ) {
					accion = accion || 'ocultar';
					mostrarCheckbox_show(thisId,accion);
				}	
				
			});
			// para que se vea animado el progreso de los pasos
			$('input.checkbox_show').on('change', function(){
				var thisId = $(this).attr('id');
				var thisForm = $(this).parents('form').attr('id');
				var accion = $(this).attr('accion');
				//console.log(thisId + ' - ' + $(this).val() + ' - ' + accion);
				
				//tipo radio button
				if ( $(this).is(':radio') && $(this).val() == 'SI' ) {

					accion = accion || 'ocultar';
					mostrarCheckbox_show(thisId,accion);

					//especifico para la aceptacion o rechazo de la solicitud de alianza
					if ( thisId == 'aceptar_alianza' ) {
						//$('#' + thisForm +' div#aceptar_alianza_enviar').addClass('hide');
						$(this).parents('form').find('div#aceptar_alianza_enviar').addClass('hide');
						$(this).parents('form').find('div#aceptar_alianza').removeClass('hide');
						$(this).parents('#Registro_content').find('#btnNext').removeClass('disabled');
					}
				}else if ( $(this).is(':radio') && $(this).val() == 'NO' )  {
					accion = accion || 'mostrar';
					mostrarCheckbox_show(thisId,accion);

					//especifico para la aceptacion o rechazo de la solicitud de alianza
					if ( thisId == 'aceptar_alianza' ) {
						//$('#' + thisForm +' div#aceptar_alianza_enviar').addClass('hide');
						$(this).parents('form').find('div#aceptar_alianza_enviar').removeClass('hide');
						$(this).parents('form').find('div#aceptar_alianza').addClass('hide');
						$(this).parents('#Registro_content').find('#btnNext').addClass('disabled');
					}
				}

				//tipo checkbox
				if ( $(this).is(':checkbox') && $(this).is(':checked') ) {
					accion = accion || 'ocultar';
					mostrarCheckbox_show(thisId,accion);
				}else if ( $(this).is(':checkbox') && !$(this).is(':checked') )  {
					accion = accion || 'mostrar';
					mostrarCheckbox_show(thisId,accion);
				}	
				
			});

			/*el formulario (form) es el que se valida*/
			//var $validator = $("#wizard-1").validate({

			/*
			var $validator_PreRegistro = $(".PreRegistro_form").validate({
				    
			    rules: {
			      facultad_origen: {
			        required: true
			      },
			      facultad_origen_otra: {
			        required: true
			      },
			      programa_origen: {
			        required: true
			      },
			      nombre_coordinador_origen: {
			        required: true
			      },
			      cargo_coordinador_origen: {
			        required: true
			      },
			      telefono_coordinador_origen: {
			        required: true
			      },
			      email_coordinador_origen: {
			        required: true,
			        email: "El e-mail del coordinador debe tener el formato nombre@dominio.com"
			      },
			      tipo_alianza: {
			        required: true
			      },
			      aplicaciones: {
			        required: true
			      },
			      arl_responsable: {
			        required: true
			      },
			      duracion: {
			        required: true
			      },
			      duracion_unid: {
			        required: true
			      },
			      tipo_tramite: {
			        required: true
			      },
			      facultad: {
			        required: true
			      },
			      objetivo_alianza: {
			        required: true
			      },
			      institucion: {
			        required: true
			      },
			      tipo_institucion: {
			        required: true
			      },
			      direccion: {
			        required: true
			      },
			      codigo_postal: {
			        required: true
			      },
			      pais: {
			        required: true
			      },
			      ciudad: {
			        required: true
			      },
			      email_destino: {
			        required: true,
			        email: "El e-mail del destino debe tener el formato nombre@dominio.com"
			      }
			    },
			    
			    messages: {

			      facultad_origen: "Por favor, ingrese la facultad / Oficina / Departamento",
			      facultad_origen_otra: "Por favor, ingrese la otra facultad / Oficina / Departamento",
			      programa_origen: "Por favor, ingrese los programas",
			      nombre_coordinador_origen: "Por favor, ingrese el nombre del coordinador",
			      cargo_coordinador_origen: "Por favor, ingrese el cargo coordinador",
			      telefono_coordinador_origen: "Por favor, ingrese el telefono del coordinador",
			      email_coordinador_origen: {
			      	required: "Por favor, ingrese el email del coordinador",
			      	email: "El email debe tener el formato usuario@dominio.com"
			      },
			      tipo_alianza: "Por favor, ingrese el tipo de alianza",
			      aplicaciones: "Por favor, ingrese las aplicaciones",
			      arl_responsable: "Por favor, ingrese quien es el responsable de la ARL",
			      duracion: "Por favor, ingrese la duracion",
			      duracion_unid: "Por favor, ingrese la duracion",
			      tipo_tramite: "Por favor, ingrese el tipo de tramite",
			      facultad: "Por favor, ingrese las facultades",
			      objetivo_alianza: "Por favor, ingrese el objetivo de la alianza",
			      institucion: "Por favor, ingrese el nombre de la institucion",
			      tipo_institucion: "Por favor, ingrese el tipo de institucion",
			      direccion: "Por favor, ingrese la direccion",
			      codigo_postal: "Por favor, ingrese el codigo postal",
			      pais: "Por favor, ingrese el pais",
			      ciudad: "Por favor, ingrese la ciudad",
			      email_destino: {
			      	required: "Por favor, ingrese el email de destino",
			      	email: "El email debe tener el formato usuario@dominio.com"
			      },
			      
			    },
			    
			    highlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			    },
			    unhighlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			    },
			    errorElement: 'span',
			    errorClass: 'help-block',
			    errorPlacement: function (error, element) {
			      if (element.parent('.input-group').length) {
			        error.insertAfter( element.parent() );
			      } else if ( element.parent().parent('.input-group').length ) {
			        error.insertAfter( element.parent().parent() );
			      } else {
			        error.insertAfter(element);
			      }
			    }
			  });
			*/

			//INICIO ENVIAR AJAX POST
			//INICIO ENVIAR AJAX POST

			//ahora se carga desde el script js/my_functions.js

			//FIN ENVIAR AJAX POST
			//FIN ENVIAR AJAX POST

			/*se usan botones situados en otro lugar para ejecutar las funciones de los botones originales*/

			$('#PreRegistro_content #btnNext, #Registro_content #btnNext').on('click', function() {
				/*var $valid = $(".PreRegistro_form").valid();
				if (!$valid) {
					$validator_PreRegistro.focusInvalid();
					return false;
				} else {
					//$('.PreRegistro_form').wizard('next');
			    	$('#menuPreRegistro .actions .btn-next').click();
				}*/
				var FormContent = $(this).parents('.step-content').attr('id');
				$( "#" + FormContent + " .step-pane.active form" ).submit();
			});

			$('#PreRegistro_content #btnBack, #Registro_content #btnBack').on('click', function() {
				var menu = '#' + $(this).parents('.wizard_content').find('.wizard.menu').attr('id');
				var botones = '#' + $(this).parents('.wizard_content').find('.button-content').attr('id');
				
			    $(menu + ' .actions .btn-prev').click();
			    $(botones + ' #btnNext').removeClass('disabled');
			});

			/*			
				$('.Registro_form #btnBack').on('click', function() {
				    $('#menuRegistro .actions .btn-prev').click();
				});
			*/

			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
			/* ------------------------------------------------- */
	
			/*el formulario (form) es el que se valida*/
			  //var $validator = $("#wizard-1").validate({
			  /*
			  var $validator_Registro = $(".Registro_form").validate({
			    
			    rules: {
			      repre_nombre: {
			        required: true
			      },
			      repre_nacimiento: {
			        required: true
			      },
			      repre_tipo_documento: {
			        required: true
			      },
			      repre_numero_documento: {
			        required: true
			      },
			      repre_lugar_exped_documento: {
			        required: true
			      },
			      repre_cargo: {
			        required: true
			      },
			      repre_telefono: {
			        required: true
			      },
			      repre_email: {
			        required: true,
			        email: "El e-mail del representante debe tener el formato nombre@dominio.com"
			      },
			      tipos_documentos: {
			        required: true
			      },
			      otros_documentos: {
			        required: true
			      },
			      archivo_documentos: {
			        required: true
			      },
			      nombre_coordinador_destino: {
			        required: true
			      },
			      cargo_coordinador_destino: {
			        required: true
			      },
			      telefono_coordinador_destino: {
			        required: true
			      },
			      email_coordinador_destino: {
			        required: true,
			        email: "El e-mail del coordinador debe tener el formato nombre@dominio.com"
			      }
			    },
			    
			    messages: {
			      repre_nombre: "Por favor, ingrese el nombre del representante",
			      repre_nacimiento: "Por favor, ingrese el lugar de nacimiento del representante",
			      repre_tipo_documento: "Por favor, ingrese el tipo de documento del representante",
			      repre_numero_documento: "Por favor, ingrese el numero de documento del representante",
			      repre_lugar_exped_documento: "Por favor, ingrese el lugar_expedición del documento del representante",
			      repre_cargo: "Por favor, ingrese el cargo del representante",
			      repre_telefono: "Por favor, ingrese el telefono del representante",
			      repre_email: "Por favor, ingrese el email del representante",
			      tipos_documentos: "Por favor, ingrese los tipos de documentos",
			      otros_documentos: "Por favor, ingrese el otros tipo de documentos",
			      archivo_documentos: "Por favor, ingrese el archivo con los documentos",
			      nombre_coordinador_destino: "Por favor, ingrese el nombre del coordinador en el destino",
			      cargo_coordinador_destino: "Por favor, ingrese el cargo del coordinador en el destino",
			      telefono_coordinador_destino: "Por favor, ingrese el telefono del coordinador en el destino",
			      email_coordinador_destino: "Por favor, ingrese el email del coordinador en el destino",
			    },
			    
			    highlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			    },
			    unhighlight: function (element) {
			      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			    },
			    errorElement: 'span',
			    errorClass: 'help-block',
			    errorPlacement: function (error, element) {
			      if (element.parent('.input-group').length) {
			        error.insertAfter( element.parent() );
			      } else if ( element.parent().parent('.input-group').length ) {
			        error.insertAfter( element.parent().parent() );
			      } else {
			        error.insertAfter(element);
			      }
			    }
			  });
			*/

				/*se usan botones situados en otro lugar para ejecutar las funciones de los botones originales*/



		});

	</script>
@endsection