
<div id="wizard_content" class="col-sm-12 fuelux wizard" >
	<div  id="menuPreRegistro" class="col-sm-12 wizard_content" content="PreRegistro_content">
		<!--div class="form-bootstrapWizard"-->
		<div class="steps-container wizard">
			<ul class="steps">
				@if( $editar_paso === false || $editar_paso === 1 || ($pasoMinimo <= 1 && $pasoMaximo >= 1) )
				<li data-step="1" class="active">
					<span class="badge badge-info">1</span>{{ $paso_titulo[1] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 2 || ($pasoMinimo <= 2 && $pasoMaximo >= 2) )
				<li data-step="2" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">2</span>{{ $paso_titulo[2] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 3 || ($pasoMinimo <= 3 && $pasoMaximo >= 3) )
				<li data-step="3" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">3</span>{{ $paso_titulo[3] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 4 || ($pasoMinimo <= 4 && $pasoMaximo >= 4) )
				<li data-step="4" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">4</span>{{ $paso_titulo[4] }}<span class="chevron"></span>
				</li>
				@endif

			</ul>
			<div class="div_buton_help">
				<i id="buton_help" class="fa fa-info-circle text-info" data-toggle="collapse" data-target="#collapseExample"></i>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="actions menu hide">
			<button type="button" class="btn btn-sm btn-primary btn-prev">
				<i class="fa fa-arrow-left"></i>Anterior
			</button>
			<button type="button" class="btn btn-sm btn-success btn-next" data-last="Enviar">
				Siguiente<i class="fa fa-arrow-right"></i>
			</button>
		</div>
		<!--div class="tab-content"-->
		<div class="collapse" id="collapseExample" >
            <div class="help well">
                <h5>¿Como realizar el pre-registro para una movilidad?</h5>
               	<ul>
                    <li>El proceso tiene una secuencia de pasos.</li>
                    <li>De click en el botón “Continuar” al terminar cada paso.</li>
                    <hr/>
                    <li>Ingrese / Compruebe la información de los datos personales.</li>
                    <li>Ingrese / Compruebe la información académica.</li>
                    <li>Ingrese la información de la movilidad.</li>
                    <li>Envíe la petición al director de programa para que revise la información y apruebe la pre-inscripción para la movilidad.</li>
                    <li>Se habilitara el acceso para realizar la inscripción completa de la movilidad.</li>
                    
                    <li>La inscripción entrara en un proceso de validación para finalmente estar activa.</li>
                </ul>
            </div>
        </div>

		<div class="step-content" id="PreRegistro_content">
			@if( $editar_paso === false || $editar_paso === 1 || ($pasoMinimo <= 1 && $pasoMaximo >= 1) )
				<div class="step-pane {{ ( ($editar_paso === false || $editar_paso === 1 || ($pasoMinimo <= 1 && $pasoMaximo >= 1) ) ? 'active' : '' ) }}"  data-step="1">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso1', 'novalidate', 'class' => 'PreRegistro_form'.(!in_array($editar_paso,[true,false]) ? '_solo' : '').' interchange', 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 1 </strong> - {{ $paso_titulo[1] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '1') }}
						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--datos del estudiante-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_nombres') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_nombres', old('estudiante_nombres'), ['class' => 'form-control input-md', 'placeholder' => 'Nombres del estudiante' ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_apellidos') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_apellidos', old('estudiante_apellidos'), ['class' => 'form-control input-md', 'placeholder' => 'Apellidos del estudiante' ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_tipo_documento') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-id-card fa-md fa-fw"></i></span>
										{{ Form::select('estudiante_tipo_documento', $estudiante_tipo_documento->prepend('Seleccione el tipo de documento', ''), old('estudiante_tipo_documento'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de documento' ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_numero_documento') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-id-card-o fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_numero_documento', old('estudiante_numero_documento'), ['class' => 'form-control input-md', 'placeholder' => 'Número de documento' ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_email_institucion') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-envelope-o fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_email_institucion', old('estudiante_email_institucion'), ['class' => 'form-control input-md', 'placeholder' => 'email@correo_institucion.com', 'title' => 'Escriba el e-mail institucional']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_email_personal') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-envelope fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_email_personal', old('estudiante_email_personal'), ['class' => 'form-control input-md', 'placeholder' => 'email@correo_personal.com', 'title' => 'Escriba el e-mail personal']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_codigo_institucion') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-barcode fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_codigo_institucion', old('estudiante_codigo_institucion'), ['class' => 'form-control input-md', 'placeholder' => 'Código institucional', 'title' => 'Código institucional','data-mask' => '99999999', 'data-mask-placeholder' => 'X']) }}
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 2 || ($pasoMinimo <= 2 && $pasoMaximo >= 2) )
				<div class="step-pane {{ ( $editar_paso == 2 ? 'active' : '' ) }}"  data-step="2">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso2', 'novalidate', 'class' => 'PreRegistro_form'.(!in_array($editar_paso,[true,false]) ? '_solo' : '').' interchange', 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 2</strong> - {{ $paso_titulo[2] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '2') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--facultades  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_facultad') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('estudiante_facultad', $estudiante_facultad->prepend('Seleccione la facultad', ''), old('estudiante_facultad'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione la facultad', 'target' => 'estudiante_programa', 'url' => route('admin.programs.listPrograms')]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_programa') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-graduation-cap fa-md fa-fw"></i></span>
										{{ Form::select('estudiante_programa', $estudiante_programa, old('estudiante_programa'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione el programa', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_promedio') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_promedio', old('estudiante_promedio'), ['class' => 'form-control input-md', 'placeholder' => 'Promedio académico acumulado', 'title' => 'Promedio académico acumulado','data-mask' => '9.9', 'data-mask-placeholder' => 'X']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_porcentaje_creditos') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-percent fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_porcentaje_creditos', old('estudiante_porcentaje_creditos'), ['class' => 'form-control input-md', 'placeholder' => 'Porcentaje de creditos aprobados', 'title' => 'Porcentaje de creditos aprobados','data-mask' => '99.9', 'data-mask-placeholder' => 'X']) }}
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 3 || ($pasoMinimo <= 3 && $pasoMaximo >= 3) )
				<div class="step-pane {{ ( $editar_paso == 3 ? 'active' : '' ) }}"  data-step="3">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso3', 'novalidate', 'class' => 'PreRegistro_form'.(!in_array($editar_paso,[true,false]) ? '_solo' : '').' interchange', 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 3</strong> - {{ $paso_titulo[3] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '3') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--facultades  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_periodo') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('inscripcion_periodo', $inscripcion_periodo->prepend('Seleccione el periodo', ''), old('inscripcion_periodo'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione el periodo', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_modalidad') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('inscripcion_modalidad', $inscripcion_modalidad->prepend('Seleccione la modalidad', ''), old('inscripcion_modalidad'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione la modalidad', 'target' => 'inscripcion_pais', 'url' => route('admin.countries.listCountriesModalidad')]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_pais') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-graduation-cap fa-md fa-fw"></i></span>
										{{ Form::select('inscripcion_pais', $inscripcion_pais, old('inscripcion_pais'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione el país', 'target' => 'inscripcion_institucion_destino', 'val_extra' => 'inscripcion_modalidad', 'url' => route('admin.institutions.listInstitutions')]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-graduation-cap fa-md fa-fw"></i></span>
										{{ Form::select('inscripcion_institucion_destino', $inscripcion_institucion_destino, old('inscripcion_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione la institución de destino', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 4 || ($pasoMinimo <= 4 && $pasoMaximo >= 4) )
				<div class="step-pane {{ ( $editar_paso == 4 ? 'active' : '' ) }}"  data-step="4">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso4', 'novalidate', 'class' => 'PreRegistro_form'.(!in_array($editar_paso,[true,false]) ? '_solo' : '').' interchange', 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 4</strong> - {{ $paso_titulo[4] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>
						<br>

						<div class="para_ver_datos">
							{{ Form::hidden('paso', '4') }}
							{{ Form::hidden('ver', 'true') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						
						</div>
						{{ Form::hidden('enviar', true) }}
						<div id="results" class="hide">
						</div>

						<h1 class="text-center text-success"><strong><i class="fa fa-check fa-md"></i> Enviar la solicitud.</strong></h1>
						<div class="text-center">
							<div class="form-group">
								<div class="form-group">
									<p class="h3">Revise los datos que ha ingresado escogiendo la opción <b>Revizar los datos</b> ó elija la opción <strong>Enviar solicitud</strong> para finalizar.</p >
								</div>
								<hr>


			                    {!! Form::button('<i class="fa fa-list-alt"></i> Revizar los datos', ['type' => 'button', 'class' => 'btn btn-lg btn-info', 'name' => 'ver_pre_registro', 'id' => 'ver_pre_registro', 'url' => route('interchanges.email') ]) !!}

								{!! Form::button('<i class="fa fa-external-link"></i> Enviar solicitud', ['type' => 'submit', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_pre_registro', 'id' => 'enviar_pre_registro', 'url' => '' ]) !!}
			                    <br><br>
			                    <br><br>
								<div id="ver_datos" class="ver_datos">
									
								</div>
								<hr>
							</div>
						</div>

						<br>

						<div class="text-center hide" id="datos_email_enviar" rel="popover-hover" data-original-title="Guardar/Enviar Pre-registro" data-content="Si los datos registrados son correctos y desea dar inicio al proceso de solicitud de movildad, elija la opción <b>Enviar solicitud</b>." data-placement="top" data-html="true">
							
								<br>
							<div class="form-group">
								<div class="">
									{!! Form::button('<i class="fa fa-external-link"></i> Enviar solicitud', ['type' => 'submit', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_pre_registro', 'id' => 'enviar_pre_registro', 'url' => '' ]) !!}
								</div>
							</div>
							<div class="text-center">
								<div class="form-group">
									<hr>
								</div>
							</div>
						</div>

					{!! Form::close() !!}
				</div>
			@endif
			

			<div class="form-actions button-content" id="PreRegistro_button_content">
				<div class="row">
					<div class="col-sm-12">
						<ul class="pager wizard no-margin">
							<!--<li class="Previous first disabled">
							<a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
							</li>-->
							@if( $editar_paso === false || $editar_paso === true )
								<li class="Previous">
									<a href="javascript:void(0);" id="btnBack" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Atras </a>
								</li>
								<!--<li class="next last">
								<a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
								</li>-->
								<li class="next">
									<a href="javascript:void(0);" id="btnNext" class="btn btn-lg txt-color-darken"> Guardar y continuar <i class="fa fa-arrow-right"></i></a>
								</li>
							@else
								@php  $routeBack = route($route_split.'.show',$inscripcionId); @endphp
								<li class="Previous">
									<a href="{{ $routeBack }}" id="btnBack" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Atras </a>
								</li>
								<li class="save">
									<a href="javascript:void(0);" id="btnNext" class="btn btn-lg txt-color-darken"> Guardar <i class="fa fa-floppy-o"></i></a>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
		

<script type="text/javascript">
	$(document).ready(function() {



		  
	
		// fuelux wizard
		//var wizard = $('.wizard').wizard();
		var wizard = '';
		$('#menuPreRegistro').wizard();
		$('#menuPreRegistro').wizard('selectedItem', {
				step: 1
		  });
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