<div id="wizard_content" class="col-sm-12 fuelux" content="PreRegistro_content">
	<!--div class="form-bootstrapWizard"-->
	<div class="wizard menu" id="menuPreRegistro">
		<ul class="steps">
			
			<li data-target="#step1" class="active">
				<span class="badge badge-info">1</span>{{ $paso_titulo[1] }}<span class="chevron"></span>
			</li>
			<li data-target="#step2">
				<span class="badge">2</span>{{ $paso_titulo[2] }}<span class="chevron"></span>
			</li>
			<li data-target="#step3">
				<span class="badge">3</span>{{ $paso_titulo[3] }}<span class="chevron"></span>
			</li>
			<li data-target="#step4">
				<span class="badge">4</span>{{ $paso_titulo[4] }}<span class="chevron"></span>
			</li>

		</ul>
		<div class="actions hide">
			<button type="button" class="btn btn-sm btn-primary btn-prev">
				<i class="fa fa-arrow-left"></i>Anterior
			</button>
			<button type="button" class="btn btn-sm btn-success btn-next" data-last="Enviar">
				Siguiente<i class="fa fa-arrow-right"></i>
			</button>
		</div>
		<div class="clearfix"></div>
	</div>
	<!--div class="tab-content"-->
	<div class="step-content" id="PreRegistro_content">
		<div class="step-pane active" id="step1">
			{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso1', 'novalidate', 'class' => 'PreRegistro_form', 'results' => 'PreRegistro_results']) !!}
			<br>
				<h3><strong>Paso 1 </strong> - {{ $paso_titulo[1] }}</h3>

				{{ Form::hidden('paso', '1') }}
				@if( isset($interchangeId) )
					{{ Form::hidden('interchangeId', '$interchangeId') }}
					{{ Form::hidden('modificar', '1') }}
				@endif
				<div id="results" class="hide">
				</div>
				<div class="row">
				<!--datos del estudiante-->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
								{{ Form::text('estudiante_nombres', old('estudiante_nombres'), ['class' => 'form-control input-lg', 'placeholder' => 'Nombres del estudiante' ]) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
								{{ Form::text('estudiante_apellidos', old('estudiante_apellidos'), ['class' => 'form-control input-lg', 'placeholder' => 'Apellidos del estudiante' ]) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
								{{ Form::select('estudiante_tipo_documento', $estudiante_tipo_documento->prepend('Seleccione el tipo de documento', ''), old('estudiante_tipo_documento'), ['class' => 'form-control input-lg', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de documento' ]) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-id-card-o fa-lg fa-fw"></i></span>
								{{ Form::text('estudiante_numero_documento', old('estudiante_numero_documento'), ['class' => 'form-control input-lg', 'placeholder' => 'Número de documento' ]) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o fa-lg fa-fw"></i></span>
								{{ Form::text('estudiante_email_institucion', old('estudiante_email_institucion'), ['class' => 'form-control input-lg', 'placeholder' => 'email@correo_institucion.com', 'title' => 'Escriba el e-mail institucional']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
								{{ Form::text('estudiante_email_personal', old('estudiante_email_personal'), ['class' => 'form-control input-lg', 'placeholder' => 'email@correo_personal.com', 'title' => 'Escriba el e-mail personal']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-barcode fa-lg fa-fw"></i></span>
								{{ Form::text('estudiante_codigo_institucion', old('estudiante_codigo_institucion'), ['class' => 'form-control input-lg', 'placeholder' => 'Código institucional', 'title' => 'Código institucional','data-mask' => '99999999', 'data-mask-placeholder' => 'X']) }}
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
		<div class="step-pane" id="step2">
			{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso2', 'novalidate', 'class' => 'PreRegistro_form', 'results' => 'PreRegistro_results']) !!}
				<br>
				<h3><strong>Paso 2</strong> - {{ $paso_titulo[2] }}</h3>

				{{ Form::hidden('paso', '2') }}

				@if( isset($interchangeId) )
					{{ Form::hidden('interchangeId', '$interchangeId') }}
					{{ Form::hidden('modificar', '1') }}
				@endif
				<div id="results" class="hide">
				</div>
				<div class="row">
				<!--facultades  -->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
								{{ Form::select('estudiante_facultad', $estudiante_facultad, old('estudiante_facultad'), ['class' => 'form-control input-lg', 'placeholder' => 'Seleccione la facultad', 'target' => 'estudiante_programa', 'url' => route('admin.programs.listPrograms')]) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-graduation-cap fa-lg fa-fw"></i></span>
								{{ Form::select('estudiante_programa', $estudiante_programa, old('estudiante_programa'), ['class' => 'form-control input-lg', 'placeholder' => 'Seleccione el programa', 'target' => '', 'url' => '']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calculator fa-lg fa-fw"></i></span>
								{{ Form::text('estudiante_promedio', old('estudiante_promedio'), ['class' => 'form-control input-lg', 'placeholder' => 'Promedio académico acumulado', 'title' => 'Promedio académico acumulado','data-mask' => '9.9', 'data-mask-placeholder' => 'X']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-percent fa-lg fa-fw"></i></span>
								{{ Form::text('estudiante_porcentaje_creditos', old('estudiante_porcentaje_creditos'), ['class' => 'form-control input-lg', 'placeholder' => 'Porcentaje de creditos aprobados', 'title' => 'Porcentaje de creditos aprobados','data-mask' => '99.9', 'data-mask-placeholder' => 'X']) }}
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
		<div class="step-pane" id="step3">
			{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso3', 'novalidate', 'class' => 'PreRegistro_form', 'results' => 'PreRegistro_results']) !!}
				<br>
				<h3><strong>Paso 3</strong> - {{ $paso_titulo[3] }}</h3>

				{{ Form::hidden('paso', '3') }}

				@if( isset($interchangeId) )
					{{ Form::hidden('interchangeId', '$interchangeId') }}
					{{ Form::hidden('modificar', '1') }}
				@endif
				<div id="results" class="hide">
				</div>
				<div class="row">
				<!--facultades  -->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
								{{ Form::select('movilidad_periodo', $movilidad_periodo->prepend('Seleccione el periodo', ''), old('movilidad_periodo'), ['class' => 'form-control input-lg', 'placeholder' => 'Seleccione el periodo', 'target' => '', 'url' => '']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
								{{ Form::select('movilidad_modalidad', $movilidad_modalidad->prepend('Seleccione la modalidad', ''), old('movilidad_modalidad'), ['class' => 'form-control input-lg', 'placeholder' => 'Seleccione la modalidad', 'target' => 'movilidad_pais', 'url' => route('admin.countries.listCountriesModalidad')]) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-graduation-cap fa-lg fa-fw"></i></span>
								{{ Form::select('movilidad_pais', $movilidad_pais, old('movilidad_pais'), ['class' => 'form-control input-lg', 'placeholder' => 'Seleccione el país', 'target' => 'movilidad_institucion', 'url' => route('admin.institutions.listInstitutions')]) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-graduation-cap fa-lg fa-fw"></i></span>
								{{ Form::select('movilidad_institucion', $movilidad_institucion, old('movilidad_institucion'), ['class' => 'form-control input-lg', 'placeholder' => 'Seleccione la institución de destino', 'target' => '', 'url' => '']) }}
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
		<div class="step-pane" id="step4">
			{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso4', 'novalidate', 'class' => 'PreRegistro_form', 'results' => 'PreRegistro_results']) !!}
				<br>
				<h3><strong>Paso 4</strong> - {{ $paso_titulo[4] }}</h3>
				<br>

				<div class="para_ver_datos">
					{{ Form::hidden('paso', '4') }}
					{{ Form::hidden('ver', 'true') }}

				@if( isset($interchangeId) )
					{{ Form::hidden('interchangeId', '$interchangeId') }}
					{{ Form::hidden('modificar', '1') }}
				@endif
				
				</div>
				<div id="results" class="hide">
				</div>

				<h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Completado</strong></h1>
				<div class="text-center">
					<div class="form-group">
						<h3 class="text-center">Previsualización de la pre-inscripción.</h3>
						<h5 class="text-center">Revise la información ingresada y si todo esta correcto escoja la opción de <strong>Enviar la pre-inscripción</strong> para que pase a revisión.</h5>
						<hr>


	                    {!! Form::button('<i class="fa fa-list-alt"></i> Revisar la información', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'ver_pre_registro', 'id' => 'ver_pre_registro', 'url' => route('interchanges.mail') ]) !!}
	                    <br><br>
						<div id="ver_datos" class="ver_datos">
							
						</div>
						<hr>
					</div>
				</div>

				<br>
				<div class="col-sm-12 text-center hide" id="datos_email_enviar">
					<h4 class="text-center">Elija la opción <strong>Enviar la pre-inscripción</strong> para finalizar.</h4>
					<div class="form-group">
						 {!! Form::button('<i class="fa fa-external-link"></i> Enviar la pre-inscripción', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_pre_registro', 'id' => 'enviar_pre_registro', 'url' => route('interchanges.mail') ]) !!}
					</div>
				</div>
				<br>
				<br>

			{!! Form::close() !!}
		</div>
		<hr>
		<div class="form-actions">
			<div class="row">
				<div class="col-sm-12">
					<ul class="pager wizard no-margin">
						<!--<li class="Previous first disabled">
						<a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
						</li>-->
						<li class="Previous">
							<a href="javascript:void(0);" id="btnBack" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Modificar </a>
						</li>
						<!--<li class="next last">
						<a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
						</li>-->
						<li class="next">
							<a href="javascript:void(0);" id="btnNext" class="btn btn-lg txt-color-darken"> Continuar <i class="fa fa-arrow-right"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
</div>
		

<script type="text/javascript">
	$(document).ready(function() {


		//INICIO SELECT DINAMICO
		//INICIO SELECT DINAMICO


		// realiza la carga automatica y dinamica de los select 
		function mostrarContenido(thisElement){

			var valor = $(thisElement).val();
			var texto = $(thisElement).find(':selected').text();
			var destino = $(thisElement).attr('target');
			var thisName = $(thisElement).attr('name').replace('[]', '');
			var formId = $(thisElement).parents('form').attr('id');
			var exists999999 = -1;
			
			//console.log(texto);

			//mostrar el resto del formulario al seleccionar el tipo de tramite
			if ( thisName == 'tipo_tramite' && valor != '' ) {
				$('#'+ formId +' div.paso1').removeClass('hide');
			}else if ( thisName == 'tipo_tramite' && valor == '' ) {
				$('#'+ formId +' div.paso1').addClass('hide');
			};

			//mostrar el resto del formulario al seleccionar 'otra' institucion
			if ( thisName == 'institucion_destino' && valor == '999999' ) {
				$('#'+ formId +' div.paso2').removeClass('hide');
			}else if ( thisName == 'institucion_destino' && valor != '999999' ) {
				$('#'+ formId +' div.paso2').addClass('hide');
			};

			//mostrar el resto del formulario al seleccionar 'otra' institucion
			if ( $(thisElement).attr('multiple') != undefined ) {
				exists999999 = jQuery.inArray( "999999", valor );
			};
			
			//console.log(thisName);
			//console.log(valor);
			//mostrar campo de otro 
			if ( valor == '999999' || exists999999 >= 0 ) {
				$(thisElement).attr('otro', thisName +'_otro');
				$('#'+ formId +' div[contenido="'+ thisName +'_otro"]').removeClass('hide');
				$('#'+ formId +' [name="'+ thisName +'_otro"]').focus();
				//ocultar los programas
				/*
				if ( thisName == 'facultad_origen' ) {
					$('#'+ formId +' div[contenido="programa_origen"]').addClass('hide');
				}*/
			}else if ( $(thisElement).attr('otro') != undefined ) {
				$('#'+ formId +' div[contenido="'+ thisName +'_otro"]').addClass('hide');
				//mostrar los programas
				/*
				if ( thisName == 'facultad_origen' ) {
					$('#'+ formId +' div[contenido="programa_origen"]').removeClass('hide');
				}*/
			};

			//mostrar el campo para el responsable de la arl
			if ( texto.toLowerCase().indexOf("prácticas y pasantías") >= 0 ) {
				$(thisElement).attr('responsable_arl', 'responsable_arl');
				$('#'+ formId +' div.responsable_arl').removeClass('hide');
			}else if ( $(thisElement).attr('responsable_arl') != undefined ) {
				$('#'+ formId +' div.responsable_arl').addClass('hide');
			};

		}

		$('.PreRegistro_form select').each(function(){
			mostrarContenido($(this));
		});
		// realiza la carga automatica y dinamica de los select
		$(document).on('change','.PreRegistro_form select',function(){

			var valor = $(this).val();
			var texto = $(this).find(':selected').text();
			var destino = $(this).attr('target');
			var thisName = $(this).attr('name').replace('[]', '');
			var formId = $(this).parents('form').attr('id');
			var exists999999 = -1;
			
			//console.log(texto);

			mostrarContenido($(this));

			//console.log(valor+ ' - ' +destino);
			if ( valor != null && destino != '' ) {
				CambiarContenidoSelect( $(this) , destino);
				$('#'+ formId +' select[name="'+ destino +'"]').removeAttr('disabled');
			};

			
		});


		// realiza la carga automatica y dinamica de los select 
		function CambiarContenidoSelect(origen,destinoName){
			var origenVal = origen.val();
			var urlDestino = origen.attr('url');
			var origenParent =  origen.parents('form').attr('id');
			var placeholder = $('#'+ origenParent +' select[name="'+ destinoName +'"]').find('option[value=""]').text();
			
			if(!origenVal || origenVal == '' || origenVal == '999999'){
			console.log('#' +origenParent+ ' select[name="'+destinoName+'"]');
				var cloneDefault = $('#' +origenParent+ ' select[name="'+destinoName+'"]').find('option[value="999999"]');
				var sizecloneDefault = cloneDefault.size();
				cloneDefault = cloneDefault.clone();
				$('#' +origenParent+ ' select[name="'+destinoName+'"]').empty();
				if (sizecloneDefault > 0) {
					$('#' +origenParent+ ' select[name="'+destinoName+'"]').append('<option value="">' + placeholder + '</option>');
					$('#' +origenParent+ ' select[name="'+destinoName+'"]').append(cloneDefault);
					
				}
				return false;
			}
			//esta peticion tendra una respuesta y un estado

			//console.log('#' +origenParent+ ' select[name="'+destinoName+'"]');

			$('#' +origenParent+ ' select[name="'+destinoName+'"]').empty();

			var data = {_token: $("input[name=_token]").val(), id : origenVal};

			if ( destinoName == 'coordinador_destino') {
				data = {_token: $("input[name=_token]").val(), id : origenVal, rol : 'coordinador_destino'};
			}


			$.post(urlDestino, data, function(response, state){
				
				var multiple = false;
				
				//se puede ver que es lo que esta recibiendo
				//console.log(response);
				
				if ( $('#'+ origenParent +' select[name="'+ destinoName +'"]').attr('multiple') != undefined ) {
					multiple = true;
					$('#'+ origenParent +' select[name="'+ destinoName +'"]').parent().find('.multiselect-container').html('');
				};
				//alert(response);
				//se insertan los elementos recibidos con formato de option dentro del select
				$.each(response, function(i,item) {
					$('#'+ origenParent +' select[name="'+ destinoName +'"]').append("<option value=\""+ i +"\">" + item + "</option>");
					/*
					if (multiple) {
						var htmlList = '<li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="'+ i +'"> '+ item +'</label></a></li>';
						$('#'+ origenParent +' select[name="'+ destinoName +'"]').parent().find('.multiselect-container').append(htmlList);
					};
					*/
					
				});
				//$('#'+ origenParent +' select[name="'+ destinoName +'"]').multiselect({});
			});
			if (placeholder != '') {
				$('#'+ origenParent +' select[name="'+ destinoName +'"]').prepend('<option value="">' + placeholder + '</option>');
			}
		};


		//FIN SELECT DINAMICO
		//FIN SELECT DINAMICO


		/*
		$('select[multiple="multiple"]').each(function(){
			$(this).multiselect({

	        	nonSelectedText: $(this).attr('title')
	    	});		
	    });		
		*/
		function EnviarDatosAjax(route,token,inputData,results,accion){
			var retorno = true;
			var msjSuccess = $('<div id="msj-success" class="alert" role="alert"></div>');
			var msjError = $('<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert"></div>');
			
			$.ajax({
				url: route,
				type: 'POST',
				headers: {'X-CSRF-TOKEN': token},
				data: inputData,
				success: function(msj){

					if ( msj.status === 'success' ) {
						$(msjSuccess).append(msj.msg);
						$(results).html(msjSuccess);
		            }else{
		            	$(msjSuccess).append(msj);
		            	$(results).empty().append(msjSuccess);
		            }
		            
		            $( results ).attr('return','correcto');


		            var scrollPos =  $(results).offset().top;
		 			$(window).scrollTop(scrollPos);
				},
		        error:function(msj){
		        	var row = '';
					$(results).html('');
					/*
		            if ( msj.status === 422 ) {
						row = 'No se logro la '+ accion +' del registro. <br>';
		            }else if( msj.status === 500 ) {
		            	row = msj.responseText;
		            }else{
		            	row = msj.responseText;
		            }*/
		            row = msj.responseText;

		            if( msj.responseJSON != undefined ){
		            	row = '';
		            	$.each(msj.responseJSON, function( index, value ) {
		               		row = row + value + "<br>";
		            	});
			        }
			        $(msjError).append(row);
		            $(results).html(msjError);
		            var scrollPos =  $(results).offset().top;
		 			$(window).scrollTop(scrollPos);
		 			$( results ).attr('return','error');
		        }
			}).fail(function(jqXHR, textStatus, errorThrown) {
		        $( results ).attr('return','error');
		        //de este modo se redirecciona a la pagina correspondiente
		        if (jqXHR.getResponseHeader('Location') != null){ 
		            window.Location= jqXHR.getResponseHeader('Location');
		        };
		    });
		    return retorno;
		};

		$('#ver_pre_registro').on('click', function () {
			//console.log('entro #ver_pre_registro');
			var route = $(this).attr('url');
			var thisForm =  $(this).parents('form').attr('id');
			var token = $('#'+ thisForm).find('input[name="_token"]').val();
			
			$('#'+ thisForm ).find('> .dato_adicional').each(function(){
				var thisName = $(this).attr('name');
				$( '#'+ thisForm + ' .para_ver_datos [name="'+ thisName +'"]' ).remove();
				$( '#'+ thisForm + ' .para_ver_datos' ).append($(this));
				
			});
			var inputData =  $('#'+ thisForm + ' .para_ver_datos').find('input, textarea, select').serialize();
			var results = '#'+ thisForm +' div#ver_datos';
			var accion = 'vista';


			if ( EnviarDatosAjax(route,token,inputData,results,accion) ){
				$( document ).one('ajaxStop', function() {
					if( $(results).attr('return') == 'correcto' ){
						$('div#datos_email_enviar').removeClass('hide');
					};
	            });
			};
			
		});



		$('#enviar_pre_registro').on('click', function (e, data) {
			//console.log('entro #enviar_pre_registro');
			var proceso = 'enviados';
			var color = '#5f895f';
			var mensaje = 'Cuando el director de programa de una respuesta se enviará un mensaje a su correo electrónico.';
			var thisForm =  $(this).parents('form').attr('id');
			/*
			var route = $(this).attr('url');
			var token = $('#'+ thisForm).find('input[name="_token"]').val();

			var inputData = "paso="+$('#'+ thisForm ).find('input[name="paso"]').val();
			inputData = inputData+"&interchangeId="+$('#'+ thisForm ).find('input[name="interchangeId"]').val();
			inputData = inputData+"&aceptar_alianza="+$('#'+ thisForm ).find('input[name="aceptar_alianza"]').val();
			inputData = inputData+"&enviar="+$('#'+ thisForm ).find('input[name="enviar"]').val();
			inputData = inputData+"&tokenmail="+$('#'+ thisForm ).find('input[name="tokenmail"]').val();
			//var inputData =  $('#'+ thisForm ).find('input, textarea, select').serialize();
			//console.log(inputData);
			var results = '#'+ thisForm +' div#ver_datos';
			var accion = 'vista';
			*/

			var results = '#' + $('#'+ thisForm).attr('results') + ' #show-msg';


			//$('.article_registro').find('input, textarea, button, select').removeAttr('disabled');
			//$('.article_registro').removeClass('hide');  
			//$("#PreRegistro_wizard_form").submit();

			//if ( EnviarDatosAjax(route,token,inputData,results,accion) ){
			var counter = 0;
			var intervalCounter = setInterval(function() {
			    counter++;
			}, 1000);
    		
			$('#'+ thisForm).submit();
				//console.log("submitted!");
				$( document ).one('ajaxStop', function() {
					if( $(results).attr('return') == 'correcto' ){
						$('div#datos_email_enviar').addClass('hide');
						$.smallBox({
						  title: "Perfecto! Los datos fueron " + proceso + " correctamente",
						  content: "Hace <i class='fa fa-clock-o'></i> <i>"+counter+" segundos...</i> <br> " + mensaje,
						  color: color,
						  iconSmall: "fa fa-check bounce animated"
						});
						clearInterval(intervalCounter);
						/*
						setTimeout(function(){
						  location.reload();
						}, 2000);
						*/
					};
	            });
			//};

			//
		});

		$('#modificar_pre_registro').on('click', function (e, data) {
			var botonId = $(this).attr('id');
			var proceso = 'enviados';
			var color = '#5f895f';
			var mensaje = 'Cuando el director de programa de una respuesta se enviará un mensaje a su correo electrónico.';

			var route = $(this).attr('url');
			
			//alert('route: '+ route);

			//
		});

		  
	
		// fuelux wizard
		//var wizard = $('.wizard').wizard();
		var wizard = $('#menuPreRegistro').wizard();
		/*
		wizard.on('finished', function (e, data) {
			//$("#fuelux-wizard").submit();
			//console.log("submitted!");
			$.smallBox({
			  title: "Congratulations! Your form was submitted",
			  content: "<i class='fa fa-clock-o'></i> <i>1 seconds ago...</i>",
			  color: "#5F895F",
			  iconSmall: "fa fa-check bounce animated"
			});

		});
		*/

		
	})

</script>