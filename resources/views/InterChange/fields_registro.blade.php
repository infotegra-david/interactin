
<div id="wizard_content" class="col-sm-12 fuelux" content="Registro_content">
	<!--div class="form-bootstrapWizard"-->
	<div class="wizard menu" id="menuRegistro">
		<ul class="steps">
			<li data-target="#step4" class="active">
				<span class="badge badge-info">4</span>{{ $paso_titulo[4] }}<span class="chevron"></span>
			</li>
			<li data-target="#step5">
				<span class="badge">5</span>{{ $paso_titulo[5] }}<span class="chevron"></span>
			</li>
			<li data-target="#step6">
				<span class="badge">6</span>{{ $paso_titulo[6] }}<span class="chevron"></span>
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
	<div class="step-content" id="Registro_content" >
		<div class="step-pane active" id="step4">
			{!! Form::model($alliance, ['route' => ['interalliances.store'], 'method' => 'post', 'id' => 'Registro_paso4', 'novalidate', 'class' => 'Registro_form', 'results' => 'Registro_results']) !!}
				<br>
				<h3><strong>Paso 4</strong> - {{ $paso_titulo[4] }}</h3>
					{{ Form::hidden('paso', '4') }}
					{{ Form::hidden('atoken', $atoken) }}
					{{ Form::hidden('alianzaId', $alianzaId) }}
					{{ Form::hidden('existeRepresentante', $existeRepresentante) }}
				<div class="row">
					<br>
					<h3> Aceptación de la petición de alianza</h3>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-thumb-tack fa-lg fa-fw"></i></span>
								<div class="inline-group form-control input-lg">
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
					</div>
				<!--observaciones-->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-paragraph fa-lg fa-fw"></i></span>
								{{ Form::textarea('observacion_aceptar_alianza', old('observacion_aceptar_alianza'), ['class' => 'form-control input-lg', 'rows' => '3', 'placeholder' => 'Observaciones']) }}
							</div>
						</div>
					</div>	
				<!--guardar / enviar aceptar_alianza_enviar-->
					<div class="col-sm-12 hide" id="aceptar_alianza_enviar">
						<div class="form-group">
							<div class="input-group">
								{!! Form::button('<i class="fa fa-external-link"></i> Guardar/Enviar', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_aceptar', 'id' => 'enviar_aceptar', 'url' => route('interalliances.mail') ]) !!}
							</div>
						</div>
					</div>
				<!--guardar / enviar aceptar_alianza_enviar-->
					<div class="col-sm-12 hide" id="aceptar_alianza_enviar">
						<div class="form-group">
							<div class="input-group ver_datos" id="ver_datos">
							</div>
						</div>
					</div>	
				</div>
				<!--institucion y tipo de institucion -->
				<div class="row disabledContent checkbox_show" id="aceptar_alianza">

					<br>
					<h3> {{ ($existeRepresentante == true ? 'D' : 'Modificar d') }}atos de su institución</h3>


					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
							@if($existeRepresentante == true)
								<div class="form-control full">
		                            {!! Form::label('tipo_institucion_destino', 'Tipo de institución:', ['class' => 'text-bold']) !!}
		                            <span> {!! $alliance['tipo_institucion_destino'] !!}</span>
		                        </div>
							@else
								<span class="input-group-addon"><i class="fa fa-sitemap fa-lg fa-fw"></i></span>
								{{ Form::select('tipo_institucion_destino', $tipo_institucion_destino->prepend('Seleccione el tipo de institucion', ''), old('tipo_institucion_destino'), ['class' => 'form-control input-lg', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de institucion' ]) }}
							@endif
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
							@if($existeRepresentante == true)
								<div class="form-control full">
		                            {!! Form::label('nombre_institucion_destino', 'Nombre de la Institución:', ['class' => 'text-bold']) !!}
		                            <span> {!! $alliance['nombre_institucion_destino'] !!}</span>
		                        </div>
							@else
								<span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span>
								{{ Form::text('nombre_institucion_destino', old('nombre_institucion_destino'), ['class' => 'form-control input-lg', 'placeholder' => 'Nombre de la Institución' ]) }}
							@endif
							</div>
						</div>
					</div>
				<!--direccion y codigo postal -->

					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
							@if($existeRepresentante == true)
								<div class="form-control full">
		                            {!! Form::label('direccion_institucion_destino', 'Dirección del campus principal:', ['class' => 'text-bold']) !!}
		                            <span> {!! $alliance['direccion_institucion_destino'] !!}</span>
		                        </div>
							@else
								<span class="input-group-addon"><i class="fa fa-map-o fa-lg fa-fw"></i></span>
								{{ Form::text('direccion_institucion_destino', old('direccion_institucion_destino'), ['class' => 'form-control input-lg', 'placeholder' => 'Dirección del campus principal' ]) }}
							@endif

							</div>
						</div>
					</div>
				<!--telefono -->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
							@if($existeRepresentante == true)
								<div class="form-control full">
		                            {!! Form::label('telefono_institucion_destino', 'Teléfono del campus principal:', ['class' => 'text-bold']) !!}
		                            <span> {!! $alliance['telefono_institucion_destino'] !!}</span>
		                        </div>
							@else
								<span class="input-group-addon"><i class="fa fa-phone fa-lg fa-fw"></i></span>
								{{ Form::text('telefono_institucion_destino', old('telefono_institucion_destino'), ['class' => 'form-control input-lg', 'placeholder' => 'Teléfono del campus principal' ]) }}
							@endif
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
							@if($existeRepresentante == true)
								<div class="form-control full">
		                            {!! Form::label('codigo_postal_institucion_destino', 'Código postal del campus principal:', ['class' => 'text-bold']) !!}
		                            <span> {!! $alliance['codigo_postal_institucion_destino'] !!}</span>
		                        </div>
							@else
								<span class="input-group-addon"><i class="fa fa-map-marker fa-lg fa-fw"></i></span>
								{{ Form::text('codigo_postal_institucion_destino', old('codigo_postal_institucion_destino'), ['class' => 'form-control input-lg', 'placeholder' => 'Código postal del campus principal', 'data-mask' => '999999', 'data-mask-placeholder' => 'X' ]) }}
							@endif
							</div>
						</div>
					</div>
				<!--pais y ciudad -->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
							@if($existeRepresentante == true)
								<div class="form-control full">
		                            {!! Form::label('pais_institucion_destino', 'País:', ['class' => 'text-bold']) !!}
		                            <span> {!! $alliance['pais_institucion_destino'] !!}</span>
		                        </div>
							@else
								<span class="input-group-addon"><i class="fa fa-flag fa-lg fa-fw"></i></span>
								{{ Form::select('pais_institucion_destino', $pais_institucion_destino->prepend('Seleccione el país', ''), null, ['class' => 'form-control input-lg', 'target' => 'departamento_institucion_destino', 'url' => route('admin.cities.listStates'), 'placeholder' => 'Seleccione el país' ]) }}
							@endif
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
							@if($existeRepresentante == true)
								<div class="form-control full">
		                            {!! Form::label('departamento_institucion_destino', 'Departamento/estado:', ['class' => 'text-bold']) !!}
		                            <span> {!! $alliance['departamento_institucion_destino'] !!}</span>
		                        </div>
							@else
								<span class="input-group-addon"><i class="fa fa-flag-o fa-lg fa-fw"></i></span>
								{{ Form::select('departamento_institucion_destino', $departamento_institucion_destino, old('departamento_institucion_destino'), ['class' => 'form-control input-lg', 'target' => 'ciudad_institucion_destino', 'url' => route('admin.cities.listCities'), 'placeholder' => 'Seleccione el departamento/estado' ]) }}
							@endif
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
							@if($existeRepresentante == true)
								<div class="form-control full">
		                            {!! Form::label('ciudad_institucion_destino', 'Ciudad:', ['class' => 'text-bold']) !!}
		                            <span> {!! $alliance['ciudad_institucion_destino'] !!}</span>
		                        </div>
							@else
								<span class="input-group-addon"><i class="fa fa-flag-o fa-lg fa-fw"></i></span>
								{{ Form::select('ciudad_institucion_destino', $ciudad_institucion_destino, old('ciudad_institucion_destino'), ['class' => 'form-control input-lg', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione la ciudad' ]) }}
							@endif
							</div>
						</div>
					</div>
				</div>


				<!--datos del coordinador -->
				<div class="row disabledContent checkbox_show" id="aceptar_alianza">
					<br>
					<h3> Datos del Coordinador del Destino</h3>
				<!-- lista profesores y coordinadores-->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user-circle fa-lg fa-fw"></i></span>
								{{ Form::select('coordinador_destino', $coordinador_destino->prepend('Seleccione al coordinador', ''), old('coordinador_destino'), ['class' => 'form-control input-lg', 'target' => '', 'url' => '']) }}
							</div>
						</div>
					</div>
				</div>
				<div class="row disabledContent checkbox_show" contenido="coordinador_destino_otro" id="aceptar_alianza">
				<!--nombre y cargo -->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user-circle fa-lg fa-fw"></i></span>
								{{ Form::text('nombre_coordinador_destino', old('nombre_coordinador_destino'), ['class' => 'form-control input-lg', 'placeholder' => 'Nombre Coordinador Externo']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-briefcase fa-lg fa-fw"></i></span>
								{{ Form::text('cargo_coordinador_destino', old('cargo_coordinador_destino'), ['class' => 'form-control input-lg', 'placeholder' => 'Cargo Coordinador Externo']) }}
							</div>
						</div>
					</div>
					
				<!--email y telefonos coordinador externo -->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone fa-lg fa-fw"></i></span>
								{{ Form::text('telefono_coordinador_destino', old('telefono_coordinador_destino'), ['class' => 'form-control input-lg', 'placeholder' => 'Teléfono Coordinador Externo']) }}
							</div>
						</div>
					</div>
				<!--email -->
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
								{{ Form::text('email_coordinador_destino', old('email_coordinador_destino'), ['class' => 'form-control input-lg', 'placeholder' => 'email_coordinador@destino.com', 'title' => 'Escriba el e-mail del destino']) }}
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
		<div class="step-pane" id="step5">
			{!! Form::model($alliance, ['route' => ['interalliances.store'], 'method' => 'post', 'id' => 'Registro_paso5','files' => true, 'novalidate', 'class' => 'Registro_form', 'results' => 'Registro_results' ]) !!}
				<br>
				<h3><strong>Paso 5</strong> - {{ $paso_titulo[5] }}</h3>
				{{ Form::hidden('paso', '5') }}
				{{ Form::hidden('atoken', $atoken) }}
				{{ Form::hidden('existeRepresentante', $existeRepresentante) }}
				<!--Contacto para la alianza y cargo -->
				<div class="row disabledContent checkbox_show" id="aceptar_alianza">

					<div class="row">
					<!--Nombre del Representante Legal y Lugar de Nacimiento del Representante Legal  -->
						<div class="col-sm-6">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_nombre', 'Nombre del Representante:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_nombre'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-user-circle fa-lg fa-fw"></i></span>
										{{ Form::text('repre_nombre', old('repre_nombre'), ['class' => 'form-control input-lg', 'placeholder' => 'Nombre del Representante Autorizado para Subscribir' ]) }}
								@endif
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_cargo', 'Cargo:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_cargo'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-briefcase fa-lg fa-fw"></i></span>
										{{ Form::text('repre_cargo', old('repre_cargo'), ['class' => 'form-control input-lg', 'placeholder' => 'Cargo' ]) }}
								@endif
								</div>
							</div>
						</div>
						
					<!--telefono -->
						<div class="col-sm-6">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_telefono', 'Teléfono y Extensión:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_telefono'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-phone fa-lg fa-fw"></i></span>
										{{ Form::text('repre_telefono', old('repre_telefono'), ['class' => 'form-control input-lg', 'placeholder' => 'Teléfono y Extensión' ]) }}
								@endif
								</div>
							</div>
						</div>
						
					<!--email -->
						<div class="col-sm-6">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_email', 'E-mail del representante:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_email'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-envelope fa-lg fa-fw"></i></span>
										{{ Form::text('repre_email', old('repre_email'), ['class' => 'form-control input-lg', 'placeholder' => 'email_representante@destino.com', 'title' => 'Escriba el e-mail del representante' ]) }}
								@endif
								</div>
							</div>
						</div>



					<!--pais  -->
						<div class="col-sm-6">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_pais_nacimiento', 'País de nacimiento:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_pais_nacimiento'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-flag fa-lg fa-fw"></i></span>
										{{ Form::select('repre_pais_nacimiento', $repre_pais_nacimiento->prepend('Seleccione el país de nacimiento', ''), null, ['class' => 'form-control input-lg', 'target' => 'repre_departamento_nacimiento', 'url' => route('admin.cities.listStates'), 'placeholder' => 'Seleccione el país de nacimiento'  ]) }}
								@endif
								</div>
							</div>
						</div>
					</div>
					<div class="row">
					<!--tipo de Documento y Número de Documento  -->
						<div class="col-sm-4">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_tipo_documento', 'Tipo de documento:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_tipo_documento'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-id-card fa-lg fa-fw"></i></span>
										{{ Form::select('repre_tipo_documento', $repre_tipo_documento->prepend('Seleccione el tipo de documento', ''), old('repre_tipo_documento'), ['class' => 'form-control input-lg', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de documento' ]) }}
								@endif
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_numero_documento', 'Número de documento:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_numero_documento'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-hashtag fa-lg fa-fw"></i></span>
										{{ Form::text('repre_numero_documento', old('repre_numero_documento'), ['class' => 'form-control input-lg', 'placeholder' => 'Número de documento' ]) }}
								@endif
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_fecha_exped_documento', 'Fecha de expedición del documento:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_fecha_exped_documento'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-calendar fa-lg fa-fw"></i></span>
										{{ Form::date('repre_fecha_exped_documento', old('repre_fecha_exped_documento'), ['class' => 'form-control input-lg', 'title' => 'Fecha de expedición del documento', 'placeholder' => 'Fecha de expedición del documento', 'rel' => 'tooltip', 'data-original-title' => 'Fecha de expedición del documento', 'data-placement' => 'top' ]) }}
								@endif
								</div>
							</div>
						</div>

					<!--pais y ciudad -->
						<div class="col-sm-4">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_pais_exped_documento', 'País de expedición del documento:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_pais_exped_documento'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-flag fa-lg fa-fw"></i></span>
										{{ Form::select('repre_pais_exped_documento', $repre_pais_exped_documento->prepend('Seleccione el país de expedición del documento', ''), old('repre_pais_exped_documento'), ['class' => 'form-control input-lg', 'target' => 'repre_departamento_exped_documento', 'url' => route('admin.cities.listStates'), 'placeholder' => 'Seleccione el país de expedición del documento'  ]) }}
								@endif
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_departamento_exped_documento', 'Departamento/estado de expedición del documento:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_departamento_exped_documento'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-flag-o fa-lg fa-fw"></i></span>
										{{ Form::select('repre_departamento_exped_documento', ( $repre_departamento_exped_documento ?? array() ), old('repre_departamento_exped_documento'), ['class' => 'form-control input-lg', 'target' => 'repre_ciudad_exped_documento', 'url' => route('admin.cities.listCities'), 'placeholder' => 'Seleccione el departamento/estado de expedición del documento'  ]) }}
								@endif
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<div class="input-group {{ ($existeRepresentante == true ? 'full' : '') }}">
								@if($existeRepresentante == true)
									<div class="form-control full">
			                            {!! Form::label('repre_ciudad_exped_documento', 'Ciudad de expedición del documento:', ['class' => 'text-bold']) !!}
			                            <span> {!! $alliance['repre_ciudad_exped_documento'] !!}</span>
			                        </div>
								@else
										<span class="input-group-addon"><i class="fa fa-flag-o fa-lg fa-fw"></i></span>
										{{ Form::select('repre_ciudad_exped_documento', ( $repre_ciudad_exped_documento ?? array() ), old('repre_ciudad_exped_documento'), ['class' => 'form-control input-lg', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione la ciudad de expedición del documento'  ]) }}
								@endif
								</div>
							</div>
						</div>
					</div>

				</div>
				<br>
				@if($existeRepresentante == false)

					<h3>Adjunte documento - soporte de representación legal</h3>

					<div class="row disabledContent checkbox_show" id="aceptar_alianza">
						<div class="col-sm-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-pdf-o fa-lg fa-fw"></i></span>
									{{ Form::file('archivo_documentos', ['class' => 'form-control input-lg', 'placeholder' => 'Archivo de soporte del representante autorizado', 'rel' => 'tooltip', 'data-original-title' => 'Archivo de soporte del representante autorizado', 'data-placement' => 'top' ]) }}
								</div>
							</div>
						</div>
					</div>
				
				@endif
			{!! Form::close() !!}
		</div>
		<div class="step-pane" id="step6">
			{!! Form::model($alliance, ['route' => ['interalliances.store'], 'method' => 'post', 'id' => 'Registro_paso6', 'novalidate', 'class' => 'Registro_form', 'results' => 'Registro_results']) !!}
				<br>
				<h3><strong>Paso 6</strong> - {{ $paso_titulo[6] }}</h3>
				<br>
				<div class="para_ver_datos">
					{{ Form::hidden('paso', '6') }}
					{{ Form::hidden('ver', 'true') }}
				</div>

				<br>
				<h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Completado</strong></h1>
				<br>
				<div class="text-center">
					<div class="form-group">
						<h3 class="text-center">Previsualización del e-mail.</h3>
						<hr>


	                    {!! Form::button('<i class="fa fa-list-alt"></i> Ver los datos', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'ver_registro', 'id' => 'ver_registro', 'url' => route('interalliances.mail') ]) !!}
	                    <br><br>
						<div id="ver_datos" class="ver_datos">
							
						</div>
						<hr>
					</div>
				</div>

				<br>
				<div class="col-sm-12 text-center hide" id="datos_email_enviar">
					<h4 class="text-center">Elija la opción <strong>Guardar/Enviar</strong> para finalizar.</h4>
					<br>
					<div class="form-group">
						{!! Form::button('<i class="fa fa-pencil-square-o"></i> Modificar', ['type' => 'button', 'class' => 'btn btn-lg btn-info', 'name' => 'modificar_registro', 'id' => 'modificar_registro', 'url' => route('interalliances.mail') ]) !!}
						&nbsp;&nbsp;&nbsp;
						 {!! Form::button('<i class="fa fa-external-link"></i> Guardar/Enviar', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_registro', 'id' => 'enviar_registro', 'url' => route('interalliances.mail') ]) !!}
					</div>
				</div>
				<br>
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
		$(document).on('change','.Registro_form select',function(){

			var valor = $(this).val();
			var texto = $(this).find(':selected').text();
			var destino = $(this).attr('target');
			var thisName = $(this).attr('name').replace('[]', '');
			var formId = $(this).parents('form').attr('id');
			
			//console.log(texto);

			
			//console.log(thisName);
			//mostrar campo de otro 
			if ( valor == '999999' ) {
				$(this).attr('otro', thisName +'_otro');
				$('#'+ formId +' div[contenido="'+ thisName +'_otro"]').removeClass('hide');
				$('#'+ formId +' [name="'+ thisName +'_otro"]').focus();
			}else if ( $(this).attr('otro') != undefined ) {
				$('#'+ formId +' div[contenido="'+ thisName +'_otro"]').addClass('hide');
			};

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
			var mensaje = 'Perfecto! los datos fueron enviados a la institucion solicitante, seran validados y dará inicio la nueva alianza.';
			var thisForm =  $(this).parents('form').attr('id');
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
			var mensaje = 'Perfecto!! los datos seran validados y procederemos a comunicarnos con ustedes.';

			var route = $(this).attr('url');
			
			alert('route: '+ route);

			//
		});

			  
		
		// fuelux wizard
		  //var wizard = $('.wizard').wizard();
		  var wizard = $('#menuRegistro').wizard();
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