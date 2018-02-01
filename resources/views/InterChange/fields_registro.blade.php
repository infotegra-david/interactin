
<div id="Registro_content" class="col-sm-12 fuelux wizard" >
	<div  id="menuRegistro" class="col-sm-12 wizard_content" content="Registro_content">
		<!--div class="form-bootstrapWizard"-->
		<div class="steps-container wizard">
			<ul class="steps">
				@if( $editar_paso === false || $editar_paso === 5 || ($pasoMinimo <= 5 && $pasoMaximo >= 5 && $pasoMaximo <= 13) )
				<li data-step="5" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">5</span>{{ $paso_titulo[5] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 6 || ($pasoMinimo <= 6 && $pasoMaximo >= 6 && $pasoMaximo <= 13) )
				<li data-step="6" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">6</span>{{ $paso_titulo[6] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 7 || ($pasoMinimo <= 7 && $pasoMaximo >= 7 && $pasoMaximo <= 13) )
				<li data-step="7" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">7</span>{{ $paso_titulo[7] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 8 || ($pasoMinimo <= 8 && $pasoMaximo >= 8 && $pasoMaximo <= 13) )
				<li data-step="8" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">8</span>{{ $paso_titulo[8] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 9 || ($pasoMinimo <= 9 && $pasoMaximo >= 9 && $pasoMaximo <= 13) )
				<li data-step="9" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">9</span>{{ $paso_titulo[9] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 10 || ($pasoMinimo <= 10 && $pasoMaximo >= 10 && $pasoMaximo <= 13) )
				<li data-step="10" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">10</span>{{ $paso_titulo[10] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 11 || ($pasoMinimo <= 11 && $pasoMaximo >= 11 && $pasoMaximo <= 13) )
				<li data-step="11" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">11</span>{{ $paso_titulo[11] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 12 || ($pasoMinimo <= 12 && $pasoMaximo >= 12 && $pasoMaximo <= 13) )
				<li data-step="12" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">12</span>{{ $paso_titulo[12] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso === 13 || ($pasoMinimo <= 13 && $pasoMaximo >= 13 && $pasoMaximo <= 13) )
				<li data-step="13" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">13</span>{{ $paso_titulo[13] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === 14 || $pasoMinimo >= 14 )
				<li data-step="14" class="{{ ( isset($inscripcionId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($inscripcionId) ? 'badge-success' : '' ) }}">14</span>{{ $paso_titulo[14] }}<span class="chevron"></span>
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
                <h5>¿Como realizar el registro para una movildad?</h5>
               	<ul>
                    <li>El proceso tiene una secuencia de pasos.</li>
                    <li>De click en el botón “Continuar” al terminar cada paso.</li>
                    <hr/>
                    <li>Ingrese / Compruebe la información de los datos personales.</li>
                    <li>Ingrese la información de los datos de contacto.</li>
                    <li>Ingrese / Compruebe la información académica.</li>
                    <li>Ingrese la información de la movilidad.</li>
                    <li>Ingrese los datos de contacto en caso de emergencia.</li>
                    <li>Ingrese las fuentes de financiacion.</li>
                    <li>Ingrese el presupuesto.</li>
                    <li>Ingrese los documentos de soporte.</li>
                    <li>Ingrese la foto.</li>

                    <li>Envíe la petición al director de programa para que revise la información y apruebe la inscripción para la movilidad.</li>
                    
                    <li>Se le solicitara que cargue todos los documentos legales necesarios.</li>
                    
                    <li>La inscripción entrara en un proceso de validación para finalmente estar activa.</li>
                </ul>
            </div>
        </div>



		<!--div class="tab-content"-->
		<div class="step-content" id="Registro_content" >
			@if( $editar_paso === false || $editar_paso === 5 || ($pasoMinimo <= 5 && $pasoMaximo >= 5 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( ($editar_paso === false || $editar_paso === 5 || ($pasoMinimo <= 5 && $pasoMaximo >= 5 && $pasoMaximo <= 13) ) ? 'active' : '' ) }}"  data-step="5">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso5', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 5 </strong> - {{ $paso_titulo[5] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '5') }}
						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--datos del estudiante-->
							<div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
										{!! Form::label('estudiante_nombres', 'Nombres del estudiante:', ['class' => 'text-bold']) !!}
                        				<span> {{ $interchange['estudiante_nombres'] ?? '' }}</span>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
                        				{!! Form::label('estudiante_apellidos', 'Apellidos del estudiante:', ['class' => 'text-bold']) !!}
										<span> {{ $interchange['estudiante_apellidos'] }}</span>
									</div>
								</div>								
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
										{!! Form::label('estudiante_tipo_documento', 'Tipo de documento:', ['class' => 'text-bold']) !!}
                        				<span> {{ $interchange['estudiante_tipo_documento'] ?? '' }}</span>

									</div>
								</div>								
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
										{!! Form::label('estudiante_numero_documento', 'Número de documento:', ['class' => 'text-bold']) !!}
                        				<span> {{ $interchange['estudiante_numero_documento'] ?? '' }}</span>

									</div>
								</div>								
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
										{!! Form::label('estudiante_email_institucion', 'Correo institución:', ['class' => 'text-bold']) !!}
                        				<span> {{ $interchange['estudiante_email_institucion'] ?? '' }}</span>

									</div>
								</div>								
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
										{!! Form::label('estudiante_email_personal', 'Correo personal:', ['class' => 'text-bold']) !!}
                        				<span> {{ $interchange['estudiante_email_personal'] ?? '' }}</span>

									</div>
								</div>								
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
										{!! Form::label('estudiante_codigo_institucion', 'Código institucional:', ['class' => 'text-bold']) !!}
                        				<span> {{ $interchange['estudiante_codigo_institucion'] ?? '' }}</span>

									</div>
								</div>								
							</div>

						</div>

						<br>
						<br>

						<div class="row">
						<!--datos del estudiante-->

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_genero') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('estudiante_genero', __('messages.options.genero'), old('estudiante_genero'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_nacionalidad') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('estudiante_nacionalidad', $estudiante_nacionalidad->prepend('Seleccione la nacionalidad',''), old('estudiante_nacionalidad'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_pasaporte') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_pasaporte', old('estudiante_pasaporte'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'No. de pasaporte', 'title' => 'No. de pasaporte']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_exp_pasaporte') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calendar fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_exp_pasaporte', old('estudiante_exp_pasaporte'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese la fecha de expedición del pasaporte', 'title' => 'Ingrese la fecha de expedición del pasaporte', 'onfocusssss' => '(this.type="date")', 'onblurrrrrr' => '(this.type="text")', 'id' => 'date' ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_vence_pasaporte') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calendar fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_vence_pasaporte', old('estudiante_vence_pasaporte'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese la fecha de vencimiento del pasaporte', 'title' => 'Ingrese la fecha de vencimiento del pasaporte', 'onfocusssss' => '(this.type="date")', 'onblurrrrrr' => '(this.type="text")', 'id' => 'date' ]) }}
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_telefono') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_telefono', old('estudiante_telefono'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese el Teléfono fijo']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_celular') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_celular', old('estudiante_celular'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese el No. de celular']) }}
									</div>
								</div>
							</div>


							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_departamento_residencia') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('estudiante_departamento_residencia', $estudiante_departamento_residencia->prepend('Seleccione el departamento de residencia',''), old('estudiante_departamento_residencia'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => 'estudiante_ciudad_residencia', 'url' => route('admin.cities.listCities')]) }}
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_ciudad_residencia') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('estudiante_ciudad_residencia', $estudiante_ciudad_residencia->prepend('Seleccione la ciudad de residencia',''), old('estudiante_ciudad_residencia'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_direccion') ? 'has-error' : '') }}">
										
										<span class="input-group-addon"><i class="fa fa-map-o fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_direccion', old('estudiante_direccion'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese la dirección de residencia' ]) }}
									
										<span class="input-group-addon" rel="popover-hover" data-content="Por favor incluya la dirección completa del domicilio." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('estudiante_codigo_postal') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-map-marker fa-md fa-fw"></i></span>
										{{ Form::text('estudiante_codigo_postal', old('estudiante_codigo_postal'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese el código postal del domicilio', 'data-mask' => '999999', 'data-mask-placeholder' => 'X' ]) }}
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 6 || ($pasoMinimo <= 6 && $pasoMaximo >= 6 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( $editar_paso == 6 ? 'active' : '' ) }}"  data-step="6">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso6', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 6</strong> - {{ $paso_titulo[6] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '6') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--informacion academica  -->

							<div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
				                        {!! Form::label('estudiante_facultad', 'Facultad:', ['class' => 'text-bold']) !!}
				                        <span> {{ $interchange['estudiante_facultad'] ?? '' }}</span>
				                    </div>
								</div>								
							</div>   
				            
					        <div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
				                        {!! Form::label('estudiante_programa', 'Programa:', ['class' => 'text-bold']) !!}
				                        <span> {{ $interchange['estudiante_programa'] ?? '' }}</span>
				                    </div>
								</div>								
							</div>   
				            
					        <div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
				                        {!! Form::label('estudiante_promedio', 'Promedio académico acumulado:', ['class' => 'text-bold']) !!}
				                        <span> {{ $interchange['estudiante_promedio'] ?? '' }}</span>
				                    </div>
								</div>								
							</div>   
				            
					        <div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
				                        {!! Form::label('estudiante_porcentaje_creditos', 'Porcentaje de creditos aprobados:', ['class' => 'text-bold']) !!}
				                        <span> {{ $interchange['estudiante_porcentaje_creditos'] ?? '' }}%</span>
				                    </div>
								</div>								
							</div>

						</div>
						<div class="row">

							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<br>
									<h4><strong>Idiomas </strong> - Especifique los idiomas que maneja.</h4>
									<br>
								</div>
							</div>

							<div class="col-sm-12 col-md-12">
								<div class="form form-group col-xs-12" id="jqgrid_form">

							        <div class="panel table_jqGrid div-error @if ($errors->has('idiomas')) has-error @endif">
							            <table id="jqGrid1"></table>
							            <div id="jqGrid1Pager"></div>
							        </div>
							    </div>
						    </div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 7 || ($pasoMinimo <= 7 && $pasoMaximo >= 7 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( $editar_paso == 7 ? 'active' : '' ) }}"  data-step="7">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso7', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 7</strong> - {{ $paso_titulo[7] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '7') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--facultades  -->
							
					        <div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
				                        {!! Form::label('periodo_nombre', 'Periodo:', ['class' => 'text-bold']) !!}
				                        <span> {{ $interchange['inscripcion_periodo'] ?? '' }}</span>
				            
				                    </div>
								</div>								
							</div>   
				            
					        <div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
				                        {!! Form::label('modalidad_nombre', 'Modalidad:', ['class' => 'text-bold']) !!}
				                        <span> {{ $interchange['inscripcion_modalidad'] ?? '' }}</span>
				            
				                    </div>
								</div>								
							</div>   
				            
					        <div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
				                        {!! Form::label('pais_nombre', 'País:', ['class' => 'text-bold']) !!}
				                        <span> {{ $interchange['inscripcion_pais'] ?? '' }}</span>
				            
				                    </div>
								</div>								
							</div>   
				            
					        <div class="col-sm-6 col-md-6">
								<div class="full">
									<div class="full">
				                        {!! Form::label('institucion_destino_nombre', 'Institución de destino:', ['class' => 'text-bold']) !!}
				                        <span> {{ $interchange['inscripcion_institucion_destino'] ?? '' }}</span>
				                    </div>
								</div>
							</div>
						</div>
						<div class="row">

						<!--campus  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_campus_destino') ? 'has-error' : '') }}" >
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('inscripcion_campus_destino', $inscripcion_campus_destino->prepend('Seleccione el campus',''), old('inscripcion_campus_destino'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => 'inscripcion_facultad_destino', 'url' => route('admin.faculties.listFaculties')]) }}
										<span class="input-group-addon"  rel="popover" data-content="En este campo debe especificar cuál campus es al que se dirige con su movilidad." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--inscripcion_campus_destino_otro-->
							<div class="col-sm-6 col-md-6 hide" contenido="inscripcion_campus_destino_otro">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_campus_destino_otro') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-plus fa-md fa-fw"></i></span>
										{{ Form::text('inscripcion_campus_destino_otro', old('inscripcion_campus_destino_otro'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese el otro campus']) }}

									</div>
								</div>
							</div>

						<!--facultades  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_facultad_destino') ? 'has-error' : '') }}" >
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('inscripcion_facultad_destino', $inscripcion_facultad_destino->prepend('Seleccione la facultad',''), old('inscripcion_facultad_destino'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => 'inscripcion_programa_destino', 'url' => route('admin.programs.listPrograms')]) }}
										<span class="input-group-addon"  rel="popover" data-content="En este campo debe especificar cuál facultad es a la que se dirige con su movilidad." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--inscripcion_facultad_destino_otro-->
							<div class="col-sm-6 col-md-6 hide" contenido="inscripcion_facultad_destino_otro">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_facultad_destino_otro') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-plus fa-md fa-fw"></i></span>
										{{ Form::text('inscripcion_facultad_destino_otro', old('inscripcion_facultad_destino_otro'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese la otra facultad']) }}

									</div>
								</div>
							</div>
						<!--inscripcion_programa_destino-->
							<div class="col-sm-6 col-md-6" contenido="inscripcion_programa_destino">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_programa_destino') ? 'has-error' : '') }}" >
										<span class="input-group-addon"><i class="fa fa-graduation-cap fa-md fa-fw"></i></span>
										{{ Form::select('inscripcion_programa_destino', $inscripcion_programa_destino->prepend('Seleccione el programa',''), old('inscripcion_programa_destino'), ['required' => 'required', 'class' => 'form-control input-md ', 'target' => '', 'url' => '']) }}
										<span class="input-group-addon" rel="popover" data-content="Seleccione el programa al que se dirige con su movilidad." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--inscripcion_programa_destino_otro-->
							<div class="col-sm-6 col-md-6 hide" contenido="inscripcion_programa_destino_otro">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('inscripcion_programa_destino_otro') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-plus fa-md fa-fw"></i></span>
										{{ Form::text('inscripcion_programa_destino_otro', old('inscripcion_programa_destino_otro'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese el otro programa']) }}

									</div>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<br>
									<h4><strong>Asignaturas </strong> - Especifique la equivalencia de las asignaturas a cursar en la institución de destino.</h4>
									<br>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form form-group col-xs-12" id="jqgrid_form">

							        <div class="panel table_jqGrid2 div-error @if ($errors->has('asignaturas')) has-error @endif">
							            <table id="jqGrid2"></table> 
							            <div id="jqGrid2Pager"></div>
							        </div>
							    </div>
						    </div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 8 || ($pasoMinimo <= 8 && $pasoMaximo >= 8 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( $editar_paso == 8 ? 'active' : '' ) }}"  data-step="8">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso8', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 8</strong> - {{ $paso_titulo[8] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '8') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--datos de contacto  -->
						
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_nombres') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user fa-md fa-fw"></i></span>
										{{ Form::text('contacto_nombres', old('contacto_nombres'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Nombres del contacto' ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_apellidos') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user fa-md fa-fw"></i></span>
										{{ Form::text('contacto_apellidos', old('contacto_apellidos'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Apellidos del contacto' ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_parentesco') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user fa-md fa-fw"></i></span>
										{{ Form::text('contacto_parentesco', old('contacto_parentesco'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Parentesco', 'title' => 'Parentesco']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_email_personal') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-envelope fa-md fa-fw"></i></span>
										{{ Form::text('contacto_email_personal', old('contacto_email_personal'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'email@correo_personal.com', 'title' => 'Escriba el e-mail personal']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_telefono') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('contacto_telefono', old('contacto_telefono'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese el Teléfono fijo']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_celular') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('contacto_celular', old('contacto_celular'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese el No. de celular']) }}
									</div>
								</div>
							</div>


							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_departamento_residencia') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('contacto_departamento_residencia', $contacto_departamento_residencia->prepend('Seleccione el departamento de residencia',''), old('contacto_departamento_residencia'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => 'contacto_ciudad_residencia', 'url' => route('admin.cities.listCities')]) }}
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_ciudad_residencia') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('contacto_ciudad_residencia', $contacto_ciudad_residencia->prepend('Seleccione la ciudad de residencia',''), old('contacto_ciudad_residencia'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_direccion') ? 'has-error' : '') }}">
										
										<span class="input-group-addon"><i class="fa fa-map-o fa-md fa-fw"></i></span>
										{{ Form::text('contacto_direccion', old('contacto_direccion'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese la dirección del contacto' ]) }}
									
										<span class="input-group-addon" rel="popover-hover" data-content="Por favor incluya la dirección completa del domicilio del contacto." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('contacto_codigo_postal') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-map-marker fa-md fa-fw"></i></span>
										{{ Form::text('contacto_codigo_postal', old('contacto_codigo_postal'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese el código postal del contacto', 'data-mask' => '999999', 'data-mask-placeholder' => 'X' ]) }}
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 9 || ($pasoMinimo <= 9 && $pasoMaximo >= 9 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( $editar_paso == 9 ? 'active' : '' ) }}"  data-step="9">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso9', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 9</strong> - {{ $paso_titulo[9] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '9') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--fuente nacional  -->
							<br>
							<h3> Financiación nacional </h3>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('fuente_financia_nacional') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('fuente_financia_nacional', $fuente_financia_nacional->prepend('Seleccione la fuente de financiación nacional',''), old('fuente_financia_nacional'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('monto_financia_nacional') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::number('monto_financia_nacional', old('monto_financia_nacional'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Monto de la financiación en pesos', 'title' => 'Monto de la financiación en pesos']) }}
									</div>
								</div>
							</div>
						</div>

						<!--usted es el coordinador??? -->
						<div class="row">
							<br>
							<h3> Financiación internacional </h3>
							<div class="col-sm-12">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('tipo_tramite') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-thumb-tack fa-md fa-fw"></i></span>
										<div class="inline-group form-control input-md">
											<span></span>&nbsp;¿La movilidad incluye fuentes de financiación internacional?&nbsp;
											<label class="radio-inline">
												{{ Form::radio('incluye_fuente_internacional', 'SI', old('incluye_fuente_internacional') ?? false, ['id' => 'incluye_fuente_internacional', 'class' => 'checkbox_show', 'accion' => 'mostrar']) }}
												<i></i>SI
											</label>
											<label class="radio-inline">
												{{ Form::radio('incluye_fuente_internacional', 'NO', old('incluye_fuente_internacional') ?? true, ['id' => 'incluye_fuente_internacional', 'class' => 'checkbox_show', 'accion' => 'ocultar']) }}
												<i></i>NO
											</label>
										</div>																
									</div>
								</div>
							</div>
						</div>
						<div class="row checkbox_show" id="incluye_fuente_internacional">
							
						<!--fuente internacional  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('fuente_financia_internacional') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('fuente_financia_internacional', $fuente_financia_internacional->prepend('Seleccione la fuente de financiación internacional',''), old('fuente_financia_internacional'), ['required' => 'required', 'class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 hide" contenido="fuente_financia_internacional_otro">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('fuente_financia_internacional_otro') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::text('fuente_financia_internacional_otro', old('fuente_financia_internacional_otro'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Escriba la otra fuente de financiación', 'title' => 'Monto de la financiación en pesos']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('monto_financia_internacional') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::number('monto_financia_internacional', old('monto_financia_internacional'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Monto de la financiación en pesos', 'title' => 'Monto de la financiación en pesos']) }}
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 10 || ($pasoMinimo <= 10 && $pasoMaximo >= 10 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( $editar_paso == 10 ? 'active' : '' ) }}"  data-step="10">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso10', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 10</strong> - {{ $paso_titulo[10] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '10') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div>
							<p>
								Elaborar un presupuesto se constituye en una acción muy importante para considerar su movilidad. Por ello, puede consultar los siguiente enlaces en los cuales podrá calcular el costo de vida del país y/o región deonde realizará su estancia académica:
							</p>
							<div class="list-group">
								<a href="https://www.numbeo.com/cost-of-living/"class="list-group-item"><strong>Numbeo</strong> https://www.numbeo.com/cost-of-living/</a>
								<a href="http://www.eardex.com/"class="list-group-item"><strong>Eardex</strong> http://www.eardex.com/</a>
								<a href="http://www.costedelavida.com/"class="list-group-item"><strong>Coste de la vida</strong> http://www.costedelavida.com/</a>
							</div>
						</div>
						<div class="row">
						<!--presupuesto  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('presupuesto_hospedaje') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::number('presupuesto_hospedaje', old('presupuesto_hospedaje'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Presupuesto de hospedaje', 'title' => 'Presupuesto de hospedaje']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('presupuesto_alimentacion') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::number('presupuesto_alimentacion', old('presupuesto_alimentacion'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Presupuesto de alimentacion', 'title' => 'Presupuesto de alimentacion']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('presupuesto_transporte') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::number('presupuesto_transporte', old('presupuesto_transporte'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Presupuesto de transporte', 'title' => 'Presupuesto de transporte']) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('presupuesto_otros') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calculator fa-md fa-fw"></i></span>
										{{ Form::number('presupuesto_otros', old('presupuesto_otros'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Presupuesto de otros', 'title' => 'Presupuesto de otros']) }}
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 11 || ($pasoMinimo <= 11 && $pasoMaximo >= 11 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( $editar_paso == 11 ? 'active' : '' ) }}"  data-step="11">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso11', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 11</strong> - {{ $paso_titulo[11] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '11') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
							<br>
							<h3> Por favor cargue los documentos aqui mencionados en un solo archivo:</h3>
							<div class="col col-sm-6 col-md-6 checkbox_show"  id="lista_documentos_soporte">
								<div class="form-group">
									<div class="input-group full">
										<ul class="full" id="">
										@foreach( $lista_documentos_soporte as $documento_soporte )
											<li>{{ $documento_soporte['nombre'] }}</li>
										@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
						<!--documentos previamente cargados -->
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('existe_documentos_soporte') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-file-archive-o fa-md fa-fw"></i></span>
										<span class="form-control input-md" >
											@if(isset($interchange['archivo_documentos_soporte']['nombre']))
												{{ $interchange['archivo_documentos_soporte']['nombre'] }}
												<a class="btn btn-xs btn-default pull-right" target="_blank" href="{{ \Storage::url($interchange['archivo_documentos_soporte']['path']) }}">Ver</a>
											@else
												No se ha cargado previamente el archivo
											@endif
										</span>
									</div>
								</div>
							</div>

						</div>
						<div class="row">
						<!--documentos  -->
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('archivo_documentos_soporte') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-file fa-md fa-fw"></i></span>
										<input class="form-control input-md" placeholder="Archivo con el/los Documento(s)" type="file" name="archivo_documentos_soporte" id="archivo_documentos_soporte" accept=".pdf,.zip,.rar">
									</div>
								</div>
							</div>

						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 12 || ($pasoMinimo <= 12 && $pasoMaximo >= 12 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( $editar_paso == 12 ? 'active' : '' ) }}"  data-step="12">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso12', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 12</strong> - {{ $paso_titulo[12] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '12') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--foto existente -->
							<div class="col-sm-12">
								<div class="form-group">
									<div class="input-group full">
										<span>Se recomienda cargar una fotografía tipo documento (3.5 x 4.5) en fondo blanco.</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('archivo_foto') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-file-image-o fa-md fa-fw"></i></span>
										<span class="form-control input-md" >
											@if(isset($interchange['archivo_foto']['nombre']))
												{{ $interchange['archivo_foto']['nombre'] }}
												<a class="btn btn-xs btn-default pull-right" target="_blank" href="{{ \Storage::url($interchange['archivo_foto']['path']) }}">Ver</a>
											@else
												No se ha cargado previamente la foto
											@endif
										</span>
									</div>
								</div>
							</div>

						</div>
						<div class="row">
						<!--foto  -->
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('archivo_foto') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-file fa-md fa-fw"></i></span>
										<input class="form-control input-md" placeholder="Archivo de la foto" type="file" name="archivo_foto" id="archivo_foto" accept=".png,.jpeg,.jpg,.bmp,.svg,.tif,.tiff">
									</div>
								</div>
							</div>

						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso === 13 || ($pasoMinimo <= 13 && $pasoMaximo >= 13 && $pasoMaximo <= 13) )
				<div class="step-pane {{ ( $editar_paso == 13 ? 'active' : '' ) }}"  data-step="13">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso13', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 13</strong> - {{ $paso_titulo[13] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>
						<br>

						<div class="para_ver_datos">
							{{ Form::hidden('paso', '13') }}
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

								{!! Form::button('<i class="fa fa-external-link"></i> Enviar solicitud', ['type' => 'submit', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_pre_registro', 'id' => 'enviar_pre_registro', 'url' => route('interchanges.email') ]) !!}
			                    <br><br>
			                    <br><br>
								<div id="ver_datos" class="ver_datos">
									
								</div>
								<hr>
							</div>
						</div>

						<br>

						<div class="text-center hide" id="datos_email_enviar" rel="popover-hover" data-original-title="Guardar/Enviar Pre-registro" data-content="Si los datos registrados son correctos y desea enviar la información del proceso de solicitud de movildad, elija la opción <b>Enviar solicitud</b>." data-placement="top" data-html="true">
							
								<br>
							<div class="form-group">
								<div class="">
									{!! Form::button('<i class="fa fa-external-link"></i> Enviar solicitud', ['type' => 'submit', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_pre_registro', 'id' => 'enviar_pre_registro', 'url' => route('interchanges.email') ]) !!}
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
			
			@if( $editar_paso === 14 || $pasoMinimo >= 14  )
				<div class="step-pane {{ ( $editar_paso == 14 ? 'active' : '' ) }}"  data-step="14">
					{!! Form::model($interchange, ['route' => $route, 'method' => $method, 'id' => 'Registro_paso14', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : '').' interchange', 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 14</strong> - {{ $paso_titulo[14] }}<span class="{{ !isset($inscripcionId) ? 'hide' : '' }} span-proceso-id">- Inscripción #<b>{{ $inscripcionId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '14') }}

						@if( isset($inscripcionId) )
							{{ Form::hidden('inscripcionId', $inscripcionId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
							<br>
							<h3> Por favor cargue los documentos finales aqui mencionados en un solo archivo:</h3>
							<div class="col col-sm-6 col-md-6 checkbox_show"  id="lista_documentos_finales">
								<div class="form-group">
									<div class="input-group full">
										<ul class="full" id="">
										@foreach( $lista_documentos_finales as $documento_finales )
											<li>{{ $documento_finales['nombre'] }}</li>
										@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
						<!--documentos  -->
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('existe_documentos_soporte') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-file-archive-o fa-md fa-fw"></i></span>
										<span class="form-control input-md" >
											@if(isset($interchange['archivo_documentos_finales']['nombre']))
												{{ $interchange['archivo_documentos_finales']['nombre'] }}
												<a class="btn btn-xs btn-default pull-right" target="_blank" href="{{ \Storage::url($interchange['archivo_documentos_finales']['path']) }}">Ver</a>
											@else
												No se ha cargado previamente el archivo
											@endif
										</span>
									</div>
								</div>
							</div>

						</div>
						<div class="row">
						<!--documentos  -->
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('archivo_documentos_finales') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-file fa-md fa-fw"></i></span>
										<input class="form-control input-md" placeholder="Archivo con el/los Documento(s)" type="file" name="archivo_documentos_finales" id="archivo_documentos_finales" accept=".pdf,.zip,.rar">
									</div>
								</div>
							</div>

						</div>
					{!! Form::close() !!}
				</div>
			@endif

			<div class="form-actions button-content" id="Registro_button_content">
				<div class="row">
					<div class="col-sm-12">
						<ul class="pager wizard no-margin">
							<!--<li class="Previous first disabled">
							<a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
							</li>-->
							<?php var_dump($editar_paso); ?>
							@if( $editar_paso === false )
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
		
<?php
	//para la lista de idiomas (paso 6)
    // $campus = $campus->toArray();
    $idiomas = json_encode($idiomas);
    $idiomas = '{"0":"Seleccione un idioma",'. substr($idiomas, 1);

    $niveles = json_encode($niveles);
    $niveles = '{"0":"Seleccione un nivel",'. substr($niveles, 1);

    //para la lista de asignaturas (paso 7)

    $programa_origen_id = $interchange['inscripcion_programa_origen'];
    
    // print_r($programas_origen);

    if (count($programas_origen)) {
	    $programas_origen_json = json_encode($programas_origen);
	    $programas_origen_json = '{"0":"Seleccione un programa de origen",'. substr($programas_origen_json, 1);
    }else{
    	$programas_origen_json = '{"0":"Registre primero un programa de origen"}';
    }

    $programa_destino_id = $interchange['inscripcion_programa_destino'];


    if (count($programas_destino)) {
	    $programas_destino_json = json_encode($programas_destino);
	    $programas_destino_json = '{"0":"Seleccione un programa de destino",'. substr($programas_destino_json, 1);
    }else{
    	$programas_destino_json = '{"0":"Seleccione primero un programa de destino arriba"}';
    }
    
    if (count($asignaturas_origen)) {
	    $asignaturas_origen_json = json_encode($asignaturas_origen);
	    $asignaturas_origen_json = '{"0":"Seleccione una asignatura de origen",'. substr($asignaturas_origen_json, 1);
    }else{
    	$asignaturas_origen_json = '{"0":"Seleccione primero un programa de origen"}';
    }

	if (count($asignaturas_destino)) {
	    $asignaturas_destino_json = json_encode($asignaturas_destino);
	    $asignaturas_destino_json = '{"0":"Seleccione una asignatura de destino",'. substr($asignaturas_destino_json, 1);
    }else{
    	$asignaturas_destino_json = '{"0":"Seleccione primero una asignatura de origen"}';
	}

    // $route = $route_split.'.storeupdate';
    // $routeLists = $route_split;

    // $tipo_paso_default = 1;

    // if(!isset($omitir_tipo_paso)){
    //     // $orden = '{"0":"Seleccione primero un paso del proceso"}';
    // }else{
    // }
?>


{{ Html::script('js/plugin/jqgrid/jquery.jqGrid.js') }}
{{ Html::script('js/plugin/jqgrid/locale/grid.locale-es.js') }}

{{ Html::script('/js/plugin/select2/select2.min.js') }}

<script type="text/javascript">
	$(document).ready(function() {



		$('.select2').select2();
	
		// fuelux wizard
		//var wizard = $('.wizard').wizard();
		var wizard = '';
		$('#menuRegistro').wizard();
		$('#menuRegistro').wizard('selectedItem', {
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

        // $.jgrid.defaults.styleUI = 'Bootstrap';

        // var jqgrid_data = [
        //     @ foreach($userPasos AS $userPaso)
        //     {
        //         "id" : "{ !! $userPaso->id !!}",
        //         "campus_id" : "{ !! $userPaso->campus_id !!}",
        //         "campus" : "{ !! $userPaso->campus !!}",
        //         "user_id" : "{ !! $userPaso->user_id !!}",
        //         "user" : "{ !! $userPaso->user !!}",
        //         "tipo_paso_idd" : "{ !! $userPaso->tipo_paso_id !!}",
        //         "tipo_paso" : "{ !! $userPaso->tipo_paso !!}",
        //         "orden" : "{ !! $userPaso->orden !!}",
        //         "titulo" : "{ !! $userPaso->titulo !!}",
        //         "accion" : "<a href='{ !! route($route_split.'.show', [$userPaso->id]) !!}' class='btn btn-default btn-xs'><i class='glyphicon glyphicon-eye-open'></i> Ver</a>"
        //     },
        //     @ endforeach
        // ];

        function validate_rules(value, colname, length){
            
			return [true,''];
        }

    @if( $editar_paso === false || $editar_paso === 6 || ($pasoMinimo <= 6 && $pasoMaximo >= 6 && $pasoMaximo <= 13) )

    //INICIO TABLA PARA ASIGNACION DE IDIOMAS
    //INICIO TABLA PARA ASIGNACION DE IDIOMAS
    //INICIO TABLA PARA ASIGNACION DE IDIOMAS
    //INICIO TABLA PARA ASIGNACION DE IDIOMAS

        $("#jqGrid1").jqGrid({
            // data : jqgrid_data,
            url: '{{ route('admin.users.listUserIdiomas',$user_id) }}',
            mtype: "POST",
            editurl: '{{ route('admin.users.editUserIdiomas',$user_id) }}',
            datatype: "json",
            caption : "",
            autowidth : true,
            loadonce : true,
            // onSelectRow: editRow, // the javascript function to call on row click. will ues to to put the row in edit mode
            viewrecords: true,

            height: 250,
            rowNum: 20,
            rownumbers: false, // show row numbers
            // multiselect : true,
            rownumWidth: 35, // the width of the row numbers columns
            pager: "#jqGrid1Pager",
            // multiselect: true,
            page: 1,
            loadComplete: function () {
                cambiarEstilosJqgrid();
            },

            //LO NOMBRES DE LAS COLUMNAS SON USADOS POR UNA FUNCION EXTERNA PARA REALIZAR VALIDACIONES
            colModel: [
                { label: 'ID', name: 'id', index:'id', key: true, width: 75, hidden:true, editable: true, editrules: { edithidden: false } },
                { label: 'user_id', name: 'user_id', index:'user_id', hidden:true, editable: true, editrules: { edithidden: false }, editoptions: { defaultValue: '{{ $user_id }}'} },
                {
                    label: 'Idioma',
                    name: 'tipo_idioma_id',
                    editable: true,
                    edittype:'select',
                    editoptions: {
                        value: {!! $idiomas !!},
                    },
                    editrules: {
                        number: true,
                        minValue: 1,
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
                // { label: 'user_id', name: 'user_id', index:'user_id', hidden:true, editable: false, editrules: { edithidden: true } },
                {
                    label: 'Nombre del examen',
                    name: 'nombre_examen',
                    editable: true,
                    editrules: {
                        // number: true,
                        // minValue: 1,
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
                {
                    label: 'Nivel alcanzado',
                    name: 'nivel_id',
                    editable: true,
                    edittype:'select',
                    editoptions: {
                        value: {!! $niveles !!},
                        dataInit: function (elem) {
                        },
                    },
                    editrules: {
                        number: true,
                        minValue: 1,
                        required: true
                    }
                },
                {
                    label: '¿Cuenta con certificado?',
                    name: 'certificado',
                    editable: true,
                    edittype:"checkbox",
                    editoptions: {
                    	value:"SI:NO",
                    },
                    // formatter: "checkbox", 
                    // formatoptions: {disabled : false},
                    editrules: {
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
            ],

        });


        $('#jqGrid1').jqGrid('navGrid','#jqGrid1Pager',
            // the buttons to appear on the toolbar of the grid
                { edit: true, add: true, del: true, search: true, refresh: true, view: false, position: "left", cloneToTop: false },
                // options for the Edit Dialog
                {
                    editCaption: "Editar idioma",
                    recreateForm: true,
                    closeAfterEdit: true,
                    afterSubmit : function( data, postdata, oper) {
                        var response = data.responseJSON;
                        if (response != undefined && response.hasOwnProperty("error")) {
                            if(response.error.length) {
                                return [false,response.error ];
                            }
                        }
                        // if(response.status == 200){ 
                        //       alert(response);
                        // } else {
                        //       return [false,'error message'];
                        // }
                        refresh_jqGrid();
                        
                        return [true,"",""];
                    },
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    },
                    afterShowForm: function (formid) {
                        // $('#FrmGrid_jqGrid1 [name="campus_id"]').change();
                        // Here I want to center the form
                    }
                },
                // options for the Add Dialog
                {
                    addCaption: "Agregar idioma",
                    recreateForm: true,
                    closeAfterAdd: true,
                    afterSubmit : function( data, postdata, oper) {
                        var response = data.responseJSON;
                        if (response.hasOwnProperty("error")) {
                            if(response.error.length) {
                                return [false,response.error ];
                            }
                        }
                        // if(response.status == 200){ 
                        //       alert(response);
                        // } else {
                        //       return [false,'error message'];
                        // }
                        refresh_jqGrid();

                        return [true,"",""];
                    },
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    }
                },
                // options for the Delete Dailog
                {
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    }
                }
        );




        function createCertificadoElement(value, editOptions) {

            var div =$("<div class='jqgrid_radio_div'></div>");
            
            var label1 = $("<label class='radio-inline'></label>");
            var radio1 = $("<input>", { type: "radio", value: "SI", name: "certificado", id: "SI", checked: value == 0 });
			// label1.append(radio1).append("<span>SI</span>");
			label1.append(radio1).append("SI");

            var label2 = $("<label class='radio-inline'></label>");
            var radio2 = $("<input>", { type: "radio", value: "NO", name: "certificado", id: "NO", checked: value == 1 });
			// label2.append(radio2).append("<span>NO</span>");
			label2.append(radio2).append("NO");

            div.append(label1).append(label2);

            return div;
        }

        // The javascript executed specified by JQGridColumn.EditTypeCustomGetValue when EditType = EditType.Custom
        // One parameter passed - the custom element created in JQGridColumn.EditTypeCustomCreateElement
        function getCertificadoValue(elem, oper, value) {
            if (oper === "set") {

                var radioButton = $(elem).find("input:radio[value='" + value + "']");
                if (radioButton.length > 0) {
                    radioButton.prop("checked", true);
                }
                
            }

            if (oper === "get") {
                return $(elem).find("input:radio:checked").val();
            }
        }

    //FIN TABLA PARA ASIGNACION DE IDIOMAS
    //FIN TABLA PARA ASIGNACION DE IDIOMAS
    //FIN TABLA PARA ASIGNACION DE IDIOMAS
    //FIN TABLA PARA ASIGNACION DE IDIOMAS

    @endif


    //INICIO TABLA PARA ASIGNACION DE ASIGNATURAS
    //INICIO TABLA PARA ASIGNACION DE ASIGNATURAS
    //INICIO TABLA PARA ASIGNACION DE ASIGNATURAS
    //INICIO TABLA PARA ASIGNACION DE ASIGNATURAS

    @if( $editar_paso === false || $editar_paso === 7 || ($pasoMinimo <= 7 && $pasoMaximo >= 7 && $pasoMaximo <= 13) )

        $("#jqGrid2").jqGrid({
            // data : jqgrid_data,
            url: '{{ $routeListAsignaturas }}',
            mtype: "POST",
            editurl: '{{ $routeEditAsignaturas }}',
            datatype: "json",
            caption : "",
            autowidth : true,
            loadonce : true,
            // onSelectRow: editRow, // the javascript function to call on row click. will ues to to put the row in edit mode
            viewrecords: true,

            height: 250,
            rowNum: 20,
            rownumbers: false, // show row numbers
            // multiselect : true,
            rownumWidth: 35, // the width of the row numbers columns
            pager: "#jqGrid2Pager",
            // multiselect: true,
            page: 1,
            loadComplete: function () {
                cambiarEstilosJqgrid();
            },

            //LO NOMBRES DE LAS COLUMNAS SON USADOS POR UNA FUNCION EXTERNA PARA REALIZAR VALIDACIONES
            colModel: [
                { label: 'ID', name: 'id', index:'id', key: true, width: 75, hidden:true, editable: true, editrules: { edithidden: false } },
                {
                    label: 'Programa origen',
                    name: 'programa_origen_id',
                    // hidden: {{ (count($asignaturas_origen) ? 'true' : 'false') }},
                    // editable: {{ (count($asignaturas_origen) ? 'false' : 'true') }},
                    editable: true,
                    edittype:'select',
                    editoptions: {
                        value: {!! $programas_origen_json !!},
                        dataInit: function (elem) {
                             $(elem).attr('target','asignatura_origen_id');
                             $(elem).attr('url','{{ route('admin.subjects.listSubjects') }}');
                             $(elem).attr('extra_value_field','nro_creditos_origen');
                        },
                        defaultValue: '{{ $programa_origen_id }}',
                    },
                    editrules: {
                        number: true,
                        minValue: 1,
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },/*
                {
                    label: 'Otro programa',
                    name: 'programa_origen_id_otro',
                    hidden: true,
                    editable: true,
                    editoptions: {
                        dataInit: function (elem) {
                             // $(elem).attr('class','hide');
                            // $(elem).attr("readonly", "readonly"); 
                        },
                    },
                    editrules: {
                        // number: true,
                        // minValue: 1,
                        edithidden:true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },*/
                {
                    label: 'Asignatura de origen',
                    name: 'asignatura_origen_id',
                    editable: true,
                    edittype:'select',
                    editoptions: {
                        value: {!! $asignaturas_origen_json !!},
                        dataInit: function (elem) {
                             // $(elem).attr('class','hide');
                             $(elem).attr('readonly_field','nro_creditos_origen');
                             $(elem).attr('set_value_field','nro_creditos_origen');
                        },
                    },
                    editrules: {
                        number: true,
                        minValue: 1,
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
                {
                    label: 'Otra asignatura',
                    name: 'asignatura_origen_id_otro',
                    hidden: true,
                    editable: true,
                    editoptions: {
                        dataInit: function (elem) {
                             // $(elem).attr('class','hide');
                        },
                    },
                    editrules: {
                        // number: true,
                        // minValue: 1,
                        edithidden:true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
                {
                    label: 'Nro de creditos',
                    name: 'nro_creditos_origen',
                    editable: true,
                    editoptions: {
                        dataInit: function (elem) {
                            $(elem).attr("readonly", "readonly"); 
                        },
                    },
                    editrules: {
                        // number: true,
                        // minValue: 1,
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
                {
                    label: 'Programa destino',
                    name: 'programa_destino_id',
                    // hidden: {{ (count($asignaturas_destino) ? 'true' : 'false') }},
                    // editable: {{ (count($asignaturas_destino) ? 'false' : 'true') }},
                    editable: true,
                    edittype:'select',
                    editoptions: {
                        value: {!! $programas_destino_json !!},
                        dataInit: function (elem) {
                             $(elem).attr('target','asignatura_destino_id');
                             $(elem).attr('url','{{ route('admin.subjects.listSubjects') }}');
                             $(elem).attr('extra_value_field','nro_creditos_destino');
                        },
                        defaultValue: '{{ $programa_destino_id }}',
                    },
                    editrules: {
                        number: true,
                        minValue: 1,
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },/*
                {
                    label: 'Otro programa',
                    name: 'programa_destino_id_otro',
                    hidden: true,
                    editable: true,
                    editoptions: {
                        dataInit: function (elem) {
                             // $(elem).attr('class','hide');
                        },
                    },
                    editrules: {
                        // number: true,
                        // minValue: 1,
                        edithidden:true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },*/
                {
                    label: 'Asignatura de destino',
                    name: 'asignatura_destino_id',
                    editable: true,
                    edittype:'select',
                    editoptions: {
                        value: {!! $asignaturas_destino_json !!},
                        dataInit: function (elem) {
                             // $(elem).attr('class','hide');
                             $(elem).attr('readonly_field','nro_creditos_destino');
                             $(elem).attr('set_value_field','nro_creditos_destino');
                        },
                    },
                    editrules: {
                        number: true,
                        minValue: 1,
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
                {
                    label: 'Otra asignatura',
                    name: 'asignatura_destino_id_otro',
                    hidden: true,
                    editable: true,
                    editoptions: {
                        dataInit: function (elem) {
                             // $(elem).attr('class','hide');
                        },
                    },
                    editrules: {
                        // number: true,
                        // minValue: 1,
                        edithidden:true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
                {
                    label: 'Nro de creditos',
                    name: 'nro_creditos_destino',
                    editable: true,
                    editoptions: {
                        dataInit: function (elem) {
                            $(elem).attr("readonly", "readonly"); 
                        },
                    },
                    editrules: {
                        // number: true,
                        // minValue: 1,
                        required: true,
                        custom:true,
                        custom_func:validate_rules
                    }
                },
            ],

        });

        $('#jqGrid2').jqGrid('navGrid','#jqGrid2Pager',
            // the buttons to appear on the toolbar of the grid
                { edit: true, add: true, del: true, search: true, refresh: true, view: false, position: "left", cloneToTop: false },
                // options for the Edit Dialog
                {
                    editCaption: "Editar asignatura",
                    recreateForm: true,
                    closeAfterEdit: true,
                    afterSubmit : function( data, postdata, oper) {
                        var response = data.responseJSON;
                        if (response != undefined && response.hasOwnProperty("error")) {
                            if(response.error.length) {
                                return [false,response.error ];
                            }
                        }
                        // if(response.status == 200){ 
                        //       alert(response);
                        // } else {
                        //       return [false,'error message'];
                        // }
                        refresh_jqGrid();
                        
                        return [true,"",""];
                    },
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    },
                    afterShowForm: function (formid) {
                        // $('#FrmGrid_jqGrid1 [name="campus_id"]').change();

                        //oculta los campos que son usados para registrar un nuevo registro de cada tipo en el caso que se escoja la opcion 'Otro'
                        // $('#FrmGrid_jqGrid2 [name="programa_origen_id_otro"]').parents('.FormData').addClass('hide').attr('contenido','programa_origen_id_otro');
                        $('#FrmGrid_jqGrid2 [name="asignatura_origen_id_otro"]').parents('.FormData').addClass('hide').attr('contenido','asignatura_origen_id_otro');
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id_otro"]').parents('.FormData').addClass('hide').attr('contenido','programa_destino_id_otro');
                        $('#FrmGrid_jqGrid2 [name="asignatura_destino_id_otro"]').parents('.FormData').addClass('hide').attr('contenido','asignatura_destino_id_otro');

                        //va a clonar el select con el nombre 'inscripcion_programa_destino' de la seccion superior del formulario para que en el caso que seleccionen otro programa se carguen los datos correspondientes a las asignaturas
                        var formId = $('.table_jqGrid2').parents('form').attr('id');

                        var cloneSelect = $('#' +formId+ ' select[name="inscripcion_programa_destino"] option').clone();
                        var clonePlaceholder = $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').find('option[value="0"]').clone();
                        // var cloneOtro999999 = $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').find('option[value="999999"]').clone();
						
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').empty();
                        //copia las opciones clonadas
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').prepend(cloneSelect);
                        //elimina las opciones que no se necesitan
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').find('option[value=""]').remove();
                        // $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').find('option[value="999999"]').remove();
                        //agrega las opciones que faltan (placeholder y 'Otro')
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').prepend(clonePlaceholder);
                        // $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').append(cloneOtro999999);
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').prop("selectedIndex", 0);


                        
                        // Here I want to center the form
                    }
                },
                // options for the Add Dialog
                {
                    addCaption: "Agregar asignatura",
                    recreateForm: true,
                    closeAfterAdd: true,
                    afterSubmit : function( data, postdata, oper) {
                        var response = data.responseJSON;
                        if (response.hasOwnProperty("error")) {
                            if(response.error.length) {
                                return [false,response.error ];
                            }
                        }
                        // if(response.status == 200){ 
                        //       alert(response);
                        // } else {
                        //       return [false,'error message'];
                        // }
                        refresh_jqGrid();

                        return [true,"",""];
                    },
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    },
                    afterShowForm: function (formid) {
                        // $('#FrmGrid_jqGrid1 [name="campus_id"]').change();
                        // $('#FrmGrid_jqGrid2 [name="programa_origen_id_otro"]').parents('.FormData').addClass('hide').attr('contenido','programa_origen_id_otro');
                        $('#FrmGrid_jqGrid2 [name="asignatura_origen_id_otro"]').parents('.FormData').addClass('hide').attr('contenido','asignatura_origen_id_otro');
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id_otro"]').parents('.FormData').addClass('hide').attr('contenido','programa_destino_id_otro');
                        $('#FrmGrid_jqGrid2 [name="asignatura_destino_id_otro"]').parents('.FormData').addClass('hide').attr('contenido','asignatura_destino_id_otro');


                        //va a clonar el select con el nombre 'inscripcion_programa_destino' de la seccion superior del formulario para que en el caso que seleccionen otro programa se carguen los datos correspondientes a las asignaturas
                        var formId = $('.table_jqGrid2').parents('form').attr('id');

                        var cloneSelect = $('#' +formId+ ' select[name="inscripcion_programa_destino"] option').clone();
                        var clonePlaceholder = $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').find('option[value="0"]').clone();
                        // var cloneOtro999999 = $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').find('option[value="999999"]').clone();
						
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').empty();
                        //copia las opciones clonadas
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').prepend(cloneSelect);
                        //elimina las opciones que no se necesitan
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').find('option[value=""]').remove();
                        // $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').find('option[value="999999"]').remove();
                        //agrega las opciones que faltan (placeholder y 'Otro')
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').prepend(clonePlaceholder);
                        // $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').append(cloneOtro999999);
                        $('#FrmGrid_jqGrid2 [name="programa_destino_id"]').prop("selectedIndex", 0);

                        // Here I want to center the form
                    }
                },
                // options for the Delete Dailog
                {
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    }
                }
        );

    @endif

//FIN TABLA PARA ASIGNACION DE ASIGNATURAS
//FIN TABLA PARA ASIGNACION DE ASIGNATURAS
//FIN TABLA PARA ASIGNACION DE ASIGNATURAS
//FIN TABLA PARA ASIGNACION DE ASIGNATURAS


        function refresh_jqGrid(){
            $('#jqGrid1, #jqGrid2').jqGrid('setGridParam',{datatype:'json'}).trigger('reloadGrid');
        }


        jQuery("#refresh_jqGrid1, #refresh_jqGrid2").click(function(){
            refresh_jqGrid();
        });


        function cambiarEstilosJqgrid(){
            // /* Add tooltips */
            $('.navtable .ui-pg-button').tooltip({
                container : 'body'
            });

            // remove classes
            $(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
            $(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
            $(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
            $(".ui-jqgrid-pager").removeClass("ui-state-default");
            $(".ui-jqgrid").removeClass("ui-widget-content");
            
            // add classes
            $(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
            $(".ui-jqgrid-btable").addClass("table table-bordered table-striped");
           
           
            $(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
            $(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
            $(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
            $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");
            $(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
            $(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
            $(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
            $(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");
            
            $( ".ui-icon.ui-icon-seek-prev" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
            $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");
            
            $( ".ui-icon.ui-icon-seek-first" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
            $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");         

            $( ".ui-icon.ui-icon-seek-next" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
            $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");
            
            $( ".ui-icon.ui-icon-seek-end" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
            $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

            
            $(".ui-pager-table").addClass("full");
        }

        cambiarEstilosJqgrid();

        $(window).on('resize.jqGrid', function () {
            $("#jqGrid1").jqGrid( 'setGridWidth', $(".table_jqGrid").width() );
            $("#jqGrid2").jqGrid( 'setGridWidth', $(".table_jqGrid2").width() );
        })



    });


</script>