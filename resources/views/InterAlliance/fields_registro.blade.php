
<div id="Registro_content" class="col-sm-12 fuelux wizard" >
	<div  id="menuRegistro" class="col-sm-12 wizard_content" content="Registro_content">
		<!--div class="form-bootstrapWizard"-->
		<div class="steps-container wizard">
			<ul class="steps">
				@if( $editar_paso === false || $editar_paso == 4 )
				<li data-step="4" class="active">
					<span class="badge badge-info">4</span>{{ $paso_titulo[4] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso == 5 )
				<li data-step="5" class="{{ ( isset($alianzaId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($alianzaId) ? 'badge-success' : '' ) }}">5</span>{{ $paso_titulo[5] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso == 6 )
				<li data-step="6" class="{{ ( isset($alianzaId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($alianzaId) ? 'badge-success' : '' ) }}">6</span>{{ $paso_titulo[6] }}<span class="chevron"></span>
				</li>
				@endif

			</ul>
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
		<div class="step-content" id="Registro_content" >
			@if( $editar_paso === false || $editar_paso == 4 )
				<div class="step-pane {{ ( ($editar_paso === false || $editar_paso == 4 ) ? 'active' : '' ) }}" tipo=" {{ ( ($editar_paso === false || $editar_paso == 4 ) ? 'active' : '' ) }}"data-step="4">
					{!! Form::model($alliance, ['route' => ['interalliances.store'], 'method' => 'post', 'id' => 'Registro_paso4', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : ''), 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 4</strong> - {{ $paso_titulo[4] }}</h3>
							{{ Form::hidden('paso', '4') }}
							{{ Form::hidden('atoken', $atoken) }}
							{{ Form::hidden('alianzaId', $alianzaId) }}
							
							{{ Form::hidden('tipoRuta', $tipoRuta) }}
							{{ Form::hidden('modificar', '1') }}
						<h4>Por favor verificar o corregir los siguientes datos de su institución para subscribir la presente alianza</h4>
						<br>
						<!--institucion y tipo de institucion -->
						<div class="row checkbox_show" id="aceptar_alianza">

							<br>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group" >
									
										<span class="input-group-addon"><i class="fa fa-sitemap fa-md fa-fw"></i></span>
										{{ Form::select('tipo_institucion_destino', $tipo_institucion_destino->prepend('Seleccione el tipo de institucion', ''), old('tipo_institucion_destino'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de institucion' ]) }}
										<span class="input-group-addon" rel="popover-hover" data-content="Caracterice la naturaleza de la institución contraparte de acuerdo a su constitución jurídica." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
									
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::text('nombre_institucion_destino', old('nombre_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el nombre de la Institución' ]) }}
									
									</div>
								</div>
							</div>
						<!--direccion y codigo postal -->

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group" >
									
										<span class="input-group-addon"><i class="fa fa-map-o fa-md fa-fw"></i></span>
										{{ Form::text('direccion_institucion_destino', old('direccion_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese la dirección del campus principal' ]) }}
									
										<span class="input-group-addon" rel="popover-hover" data-content="Por favor incluya la dirección completa de domicilio para la institución contraparte." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--telefono -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
									
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('telefono_institucion_destino', old('telefono_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el teléfono del campus principal' ]) }}
									
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
									
										<span class="input-group-addon"><i class="fa fa-map-marker fa-md fa-fw"></i></span>
										{{ Form::text('codigo_postal_institucion_destino', old('codigo_postal_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el código postal del campus principal', 'data-mask' => '999999', 'data-mask-placeholder' => 'X' ]) }}
									
									</div>
								</div>
							</div>
						<!--pais y ciudad -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group" >
									
										<span class="input-group-addon"><i class="fa fa-flag fa-md fa-fw"></i></span>
										{{ Form::select('pais_institucion_destino', $pais_institucion_destino->prepend('Seleccione el país', ''), null, ['class' => 'form-control input-md', 'target' => 'departamento_institucion_destino', 'url' => route('admin.cities.listStates'), 'placeholder' => 'Seleccione el país' ]) }}
										<span class="input-group-addon" rel="popover-hover" data-content="Precise el país y la ciudad de establecimiento de la institución contraparte." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
									
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('departamento_institucion_destino', $departamento_institucion_destino, old('departamento_institucion_destino'), ['class' => 'form-control input-md', 'target' => 'ciudad_institucion_destino', 'url' => route('admin.cities.listCities'), 'placeholder' => 'Seleccione el departamento/estado' ]) }}
									
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
									
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('ciudad_institucion_destino', $ciudad_institucion_destino, old('ciudad_institucion_destino'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione la ciudad' ]) }}
									
									</div>
								</div>
							</div>
						</div>


						<!--datos del coordinador -->
						<div class="row checkbox_show" id="aceptar_alianza">
							<br>
							<h3> Coordinador externo</h3>
						<!-- lista profesores y coordinadores-->
							<div class="col-sm-6 col-md-6 hide">
								<div class="form-group">
									<div class="input-group" >
										<span class="input-group-addon"><i class="fa fa-user-circle fa-md fa-fw"></i></span>
										{{ Form::hidden('coordinador_destino', $alliance['coordinador_destino']) }}

										{{-- Form::select('coordinador_destino', $coordinador_destino->prepend('Seleccione al coordinador', ''), old('coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione al coordinador', 'target' => 'nombre_coordinador_destino,cargo_coordinador_destino,telefono_coordinador_destino,email_coordinador_destino', 'url' => route('interalliances.list')]) --}}
										<span class="input-group-addon" rel="popover-hover" data-content="Esta información corresponde al par académico o la persona designada para realizar seguimiento a la suscripción y ejecución de la alianza en la institución contraparte." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row checkbox_show" contenido="" id="aceptar_alianza">
						<!--nombre y cargo -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-circle fa-md fa-fw"></i></span>
										{{ Form::text('nombre_coordinador_destino', old('nombre_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el nombre del Coordinador Externo', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-briefcase fa-md fa-fw"></i></span>
										{{ Form::text('cargo_coordinador_destino', old('cargo_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el cargo del Coordinador Externo', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						<!--email y telefonos coordinador externo -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group" >
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('telefono_coordinador_destino', old('telefono_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el teléfono del Coordinador Externo', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 0 ? 'disabled' :'' )]) }}
										<span class="input-group-addon" rel="popover-hover" data-content="Escriba el número telefónico general de la institución contraparte (con indicativo de país y ciudad si corresponde)." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--email -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope fa-md fa-fw"></i></span>
										{{ Form::text('email_coordinador_destino', old('email_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el email del Coordinador Externo', 'title' => 'Ingrese el email del Coordinador Externo', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
						</div>
						
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso == 5 )
				<div class="step-pane {{ ( $editar_paso == 5 ? 'active' : '' ) }}" data-step="5">
					{!! Form::model($alliance, ['route' => ['interalliances.store'], 'method' => 'post', 'id' => 'Registro_paso5','files' => true, 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : ''), 'results' => 'Registro_results' ]) !!}
						<br>
						<h3><strong>Paso 5</strong> - {{ $paso_titulo[5] }}</h3>
						{{ Form::hidden('paso', '5') }}
						{{ Form::hidden('atoken', $atoken) }}
						{{ Form::hidden('alianzaId', $alianzaId) }}
						
						{{ Form::hidden('tipoRuta', $tipoRuta) }}
						{{ Form::hidden('modificar', '1') }}

						<h4>Por favor verificar o corregir los siguientes datos del representante legal de su institución para subscribir la presente alianza</h4>
						<br>
						<!--Contacto para la alianza y cargo -->
						<div class="row checkbox_show" id="aceptar_alianza">

							<div class="row">
							<!--Nombre del Representante Legal y Lugar de Nacimiento del Representante Legal  -->
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-user-circle fa-md fa-fw"></i></span>
												{{ Form::text('repre_nombre', old('repre_nombre'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el nombre del Representante Legal', 'title' => 'Ingrese el nombre del Representante Autorizado para Subscribir la Alianza' ]) }}
										
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-briefcase fa-md fa-fw"></i></span>
												{{ Form::text('repre_cargo', old('repre_cargo'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el cargo' ]) }}
										
										</div>
									</div>
								</div>
								
							<!--telefono -->
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
												{{ Form::text('repre_telefono', old('repre_telefono'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el teléfono y extensión' ]) }}
										
										</div>
									</div>
								</div>
								
							<!--email -->
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-envelope fa-md fa-fw"></i></span>
												{{ Form::text('repre_email', old('repre_email'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el email Del Representante', 'title' => 'Ingrese el email Del Representante' ]) }}
										
										</div>
									</div>
								</div>



							<!--pais  -->
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-flag fa-md fa-fw"></i></span>
												{{ Form::select('repre_pais_nacimiento', $repre_pais_nacimiento->prepend('Seleccione el país de nacimiento del Representante', ''), null, ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el país de nacimiento del Representante'  ]) }}
										
										</div>
									</div>
								</div>
							</div>
							<div class="row">
							<!--tipo de Documento y Número de Documento  -->
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-id-card fa-md fa-fw"></i></span>
												{{ Form::select('repre_tipo_documento', $repre_tipo_documento->prepend('Seleccione el tipo de documento del Representante', ''), old('repre_tipo_documento'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de documento del Representante' ]) }}
										
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-hashtag fa-md fa-fw"></i></span>
												{{ Form::text('repre_numero_documento', old('repre_numero_documento'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el número de documento del Representante' ]) }}
										
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-calendar fa-md fa-fw"></i></span>
												{{ Form::text('repre_fecha_exped_documento', old('repre_fecha_exped_documento'), ['class' => 'form-control input-md', 'title' => 'Ingrese la fecha de expedición del documento del Representante', 'placeholder' => 'Ingrese la fecha de expedición del documento del Representante', 'onfocus' => '(this.type="date")', 'onblur' => '(this.type="text")', 'id' => 'date' ]) }}
												<span class="input-group-addon" rel="tooltip" data-original-title="Ingrese la fecha de expedición del documento del Representante." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
										
										</div>
									</div>
								</div>

							<!--pais y ciudad -->
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-flag fa-md fa-fw"></i></span>
												{{ Form::select('repre_pais_exped_documento', $repre_pais_exped_documento->prepend('Seleccione el país de expedición del documento', ''), old('repre_pais_exped_documento'), ['class' => 'form-control input-md', 'target' => 'repre_departamento_exped_documento', 'url' => route('admin.cities.listStates'), 'placeholder' => 'Seleccione el país de expedición del documento'  ]) }}
										
										</div>
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
												{{ Form::select('repre_departamento_exped_documento', ( $repre_departamento_exped_documento ?? array() ), old('repre_departamento_exped_documento'), ['class' => 'form-control input-md', 'target' => 'repre_ciudad_exped_documento', 'url' => route('admin.cities.listCities'), 'placeholder' => 'Seleccione el departamento/estado de expedición del documento'  ]) }}
										
										</div>
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<div class="input-group">
										
												<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
												{{ Form::select('repre_ciudad_exped_documento', ( $repre_ciudad_exped_documento ?? array() ), old('repre_ciudad_exped_documento'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione la cudad de expedición del documento'  ]) }}
										
										</div>
									</div>
								</div>
							</div>

						</div>
						<br>
						

						<h3>Adjunte el documento de soporte de representación legal externo</h3>

						<div class="row checkbox_show" id="aceptar_alianza">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-file-pdf-o fa-md fa-fw"></i></span>
										{{ Form::file('archivo_input', ['class' => 'form-control input-md', 'placeholder' => 'Cargue el archivo de soporte del representante autorizado' ]) }}
										<span class="input-group-addon" rel="tooltip" data-original-title="Cargue el archivo de soporte del representante autorizado." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						</div>
						
						
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso == 6 )
				<div class="step-pane {{ ( $editar_paso == 6 ? 'active' : '' ) }}" data-step="6">
					{!! Form::model($alliance, ['route' => ['interalliances.store'], 'method' => 'post', 'id' => 'Registro_paso6', 'novalidate', 'class' => 'Registro_form'.($editar_paso > 0 ? '_solo' : ''), 'results' => 'Registro_results']) !!}
						<br>
						<h3><strong>Paso 6</strong> - {{ $paso_titulo[6] }}</h3>
						<br>
						<div class="para_ver_datos">
							{{ Form::hidden('paso', '6') }}
							{{ Form::hidden('ver', 'true') }}
							{{ Form::hidden('alianzaId', $alianzaId) }}
							
							{{ Form::hidden('tipoRuta', $tipoRuta) }}
							{{ Form::hidden('modificar', '1') }}
						</div>

						<br>
						<h1 class="text-center text-success"><strong><i class="fa fa-check fa-md"></i> Completado</strong></h1>
						<br>
						<div class="text-center">
							<div class="form-group">
								<h3 class="text-center">Previsualización del e-mail.</h3>
								<div class="form-group">
									<p>Revise los datos que ha ingresado para poder enviar el registro, elija la opción <b>Ver los datos</b> </p>
								</div>
								<hr>


			                    {!! Form::button('<i class="fa fa-list-alt"></i> Ver los datos', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'ver_registro', 'id' => 'ver_registro', 'url' => route('interalliances.mail') ]) !!}
			                    <br><br>
								<div id="ver_datos" class="ver_datos">
									
								</div>
								<hr>
							</div>
						</div>

						<br>
						<div class="text-center">
							<div class="form-group">
				                <h3> Aceptación de la petición de alianza</h3>
				                <div class="form-group">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="fa fa-thumb-tack fa-md fa-fw"></i></span>
				                        <div class="inline-group form-control input-md">
				                            <span></span>&nbsp;¿Acepta la petición de alianza?&nbsp;
				                            <label class="radio-inline">
				                                {{ Form::radio('aceptar_alianza', 'SI', old('aceptar_alianza') ?? true, ['id' => 'aceptar_alianza', 'class' => 'checkbox_show', 'accion' => 'mostrar']) }}
				                                <i></i>SI
				                            </label>
				                            <label class="radio-inline">
				                                {{ Form::radio('aceptar_alianza', 'NO', old('aceptar_alianza') ?? false, ['id' => 'aceptar_alianza', 'class' => 'checkbox_show', 'accion' => 'ocultar']) }}
				                                <i></i>NO
				                            </label>
				                        </div>                                                              
				                    </div>
				                </div>
					        <!--observaciones-->
				                <div class="form-group">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="fa fa-paragraph fa-md fa-fw"></i></span>
				                        {{ Form::textarea('observacion_aceptar_alianza', old('observacion_aceptar_alianza'), ['class' => 'form-control input-md', 'rows' => '3', 'placeholder' => 'Observaciones']) }}
				                    </div>
				                </div>
					        <!--guardar / enviar aceptar_alianza_enviar-->
					            <div class="hide" id="aceptar_alianza_enviarrrr">
					                <div class="form-group">
					                    <div class="input-group ver_datossssss" id="ver_datossssss">
					                    </div>
					                </div>
					            </div>
								<br>
								<div class="text-center hide" id="datos_email_enviar" >

									<div class="form-group">
										<div class="">
											<h4 class="text-center">Elija la opción <strong>Enviar solicitud</strong> para finalizar.</h4>
										</div>
									</div>
									<br>
									<div class="form-group">
										<div class="full">
										{!! Form::button('<i class="fa fa-pencil-square-o"></i> Modificar', ['type' => 'button', 'class' => 'btn btn-lg btn-info', 'name' => 'modificar_registro', 'id' => 'modificar_registro', 'url' => route('interalliances.mail') ]) !!}
										&nbsp;&nbsp;&nbsp;
										 {!! Form::button('<i class="fa fa-external-link"></i> Enviar solicitud', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_registro', 'id' => 'enviar_registro', 'url' => route('interalliances.mail') ]) !!}
										</div>
										<span class="input-group-addon" rel="popover-hover" data-original-title="Enviar el pre-registro" data-content="En caso de que desee modificar alguna informacion de la solicitud de trámite de la alianza más adelante, elija la opción <b>Modificar</b>. Por el otro lado, si el formulario ya está debidamente diligenciado y desea dar inicio al proceso de solicitud de trámite de la alianza, elija la opción <b>Enviar solicitud</b>." data-placement="top" data-html="true"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
									<div class="text-center">
										<div class="form-group">
											<hr>
										</div>
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
							@if( $editar_paso === false )
								<li class="Previous">
									<a href="javascript:void(0);" id="btnBack" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Atras </a>
								</li>
								<!--<li class="next last">
								<a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
								</li>-->
								
								<li class="next">
									<a href="javascript:void(0);" id="btnNext" class="btn btn-lg txt-color-darken"> Continuar <i class="fa fa-arrow-right"></i></a>
								</li>
							@else
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

	
		//se enviaron las funciones de mostrarContenido, CambiarContenidoSelect, formEnviar y EnviarDatosAjax al script my_functions.js

		

		$('#ver_registro').on('click', function () {
			//console.log('entro #ver_registro');
			var route = $(this).attr('url');
			var thisForm =  $(this).parents('form').attr('id');
			var token = $('#'+ thisForm).find('input[name="_token"]').val();
			
			$('#'+ thisForm ).find('> .dato_adicional').each(function(){
				var thisName = $(this).attr('name');
				$( '#'+ thisForm + ' .para_ver_datos [name="'+ thisName +'"]' ).remove();
				$( '#'+ thisForm + ' .para_ver_datos' ).append($(this));
				
			});
			var inputData =  $('#'+ thisForm +' .para_ver_datos').find('input, textarea, select').serialize();
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

		$('#enviar_registro').on('click', function (e, data) {
			//console.log('entro #enviar_registro');
			var proceso = 'enviados';
			var color = '#5f895f';
			var mensaje = 'Los datos fueron enviados a la institucion solicitante, seran validados y dará inicio la nueva alianza.';
			var thisForm =  $(this).parents('form').attr('id');
			alert(thisForm);
			return 1;
			exit;
			/*
			var route = $(this).attr('url');
			var token = $('#'+ thisForm).find('input[name="_token"]').val();

			var inputData = "paso="+$('#'+ thisForm ).find('input[name="paso"]').val();
			inputData = inputData+"&alianzaId="+$('#'+ thisForm ).find('input[name="alianzaId"]').val();
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

		function enviar_aceptar(route,thisForm){
			var proceso = 'enviados';
			var color = '#5f895f';
			var mensaje = 'Los datos fueron enviados a la institucion solicitante.';

			var token = $('#'+ thisForm).find('input[name="_token"]').val();

			var inputData = "paso="+$('#'+ thisForm ).find('input[name="paso"]').val();
			inputData = inputData+"&alianzaId="+$('#'+ thisForm ).find('input[name="alianzaId"]').val();
			inputData = inputData+"&enviar=1";
			inputData = inputData+"&tokenmail="+$('#'+ thisForm ).find('input[name="tokenmail"]').val();
			inputData = inputData+"&aceptar_alianza="+$('#'+ thisForm +' input[name="aceptar_alianza"]:checked').val();
			inputData = inputData+"&coordinador_destino="+$('#'+ thisForm ).find('input[name="coordinador_destino"]').val();
			//var inputData =  $('#'+ thisForm ).find('input, textarea, select').serialize();
			//console.log($('#'+ thisForm ).find('input, textarea, select').serialize());
			var results = '#'+ thisForm +' div#ver_datos';
			var accion = 'vista';
			
			var counter = 0;
			var intervalCounter = setInterval(function() {
			    counter++;
			}, 1000);
			if ( EnviarDatosAjax(route,token,inputData,results,accion) ){
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
			};
		}

		var nInterval;
		function stopInterval() {
	      clearInterval(nInterval);
	    }

		$('#enviar_aceptar').on('click', function (e, data) {
			//console.log('entro #enviar_registro');

			var route = $(this).attr('url');
			var thisForm =  $(this).parents('form').attr('id');



			//$('.article_registro').find('input, textarea, button, select').removeAttr('disabled');
			//$('.article_registro').removeClass('hide');  
			//$("#PreRegistro_wizard_form").submit();
			//guarda los datos del rechazo
			var resultsForm = '#' + $('#'+ thisForm).attr('results') + ' #show-msg';
			$('#'+ thisForm).submit();
			$( document ).one('ajaxStop', function() {
				if( $(resultsForm).attr('return') == 'correcto' ){
				//envia los datos del rechazo por e-mail
					
 					nInterval = setInterval(function(){
 						if ( $('#'+ thisForm ).find('input[name="tokenmail"]').size() > 0 ) {
 							//enviar_aceptar(route,thisForm);
 							stopInterval();
 						}
 					}, 100);

				};
            });

			//
		});


		$('#modificar_registro').on('click', function (e, data) {
			var botonId = $(this).attr('id');
			var proceso = 'enviados';
			var color = '#5f895f';
			//var mensaje = 'Perfecto!! los datos seran validados y procederemos a comunicarnos con ustedes.';

			var route = $(this).attr('url');
			
			//alert('route: '+ route);

			//
		});

			  
		
		// fuelux wizard
		  //var wizard = $('.wizard').wizard();
		  var wizard = $('#menuRegistro').wizard();

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
	})

</script>