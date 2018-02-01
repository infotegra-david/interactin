
<div id="wizard_content" class="col-sm-12 fuelux wizard" >
	<div  id="menuPreRegistro" class="col-sm-12 wizard_content" content="PreRegistro_content">
		<!--div class="form-bootstrapWizard"-->
		<div class="steps-container wizard">
			<ul class="steps">
				@if( $editar_paso === false || $editar_paso == 1 )
				<li data-step="1" class="active">
					<span class="badge badge-info">1</span>{{ $paso_titulo[1] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso == 2 )
				<li data-step="2" class="{{ ( isset($alianzaId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($alianzaId) ? 'badge-success' : '' ) }}">2</span>{{ $paso_titulo[2] }}<span class="chevron"></span>
				</li>
				@endif
				@if( $editar_paso === false || $editar_paso == 3 )
				<li data-step="3" class="{{ ( isset($alianzaId) ? 'complete' : '' ) }}">
					<span class="badge {{ ( isset($alianzaId) ? 'badge-success' : '' ) }}">3</span>{{ $paso_titulo[3] }}<span class="chevron"></span>
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
                <h5>¿Como subscribir una Alianza?</h5>
               <ul>
                    <li>El proceso tiene una secuencia de pasos.</li>
                    <li>De click en el botón “Continuar” al terminar cada paso.</li>
                    <hr/>
                    <li>Ingrese la información de los datos del solicitante.</li>
                    <li>Seleccione quien sera el coordinador del solicitante.</li>
                    <li>Ingrese la información de los datos de la institución contraparte.</li>
                    <li>Seleccione quien sera el coordinador externo.</li>
                    <li>Revise los datos que ha ingresado.</li>
                    <li>Envíe la petición al coordinador externo para que revise la información y apruebe la solicitud de alianza.</li>
                    <li>La subscripcion entrara en un proceso de validación para finalmente estar activa.</li>
                </ul>     
            </div>
        </div>
		<div class="step-content" id="PreRegistro_content">
			@if( $editar_paso === false || $editar_paso == 1 )
				<div class="step-pane {{ ( ($editar_paso === false || $editar_paso == 1 ) ? 'active' : '' ) }}"  data-step="1">
					{!! Form::model($alliance, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso1', 'novalidate', 'class' => 'PreRegistro_form'.($editar_paso > 0 ? '_solo' : '').' interalliance', 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 1 </strong> - {{ $paso_titulo[1] }} <span class="{{ !isset($alianzaId) ? 'hide' : '' }} span-proceso-id">- Alianza #<b>{{ $alianzaId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '1') }}
						{{ Form::hidden('tipoRuta', $tipoRuta) }}
						@if( isset($alianzaId) )
							{{ Form::hidden('alianzaId', $alianzaId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--tipo de trámite-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('tipo_tramite') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-check-square-o fa-md fa-fw"></i></span>
										{{ Form::select('tipo_tramite', $tipo_tramite->prepend('Seleccione el tipo de trámite',''), old('tipo_tramite'), ['class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
						</div>
						<div class="row paso1 hide">
						<!--facultades  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('facultad_origen') ? 'has-error' : '') }}" >
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('facultad_origen[]', $facultad_origen, old('facultad_origen[]'), ['class' => 'form-control input-md select2', 'data-placeholder' => 'Seleccione las facultades beneficiadas', 'target' => 'programa_origen[]', 'url' => route('admin.programs.listPrograms'), 'multiple']) }}
										<span class="input-group-addon"  rel="popover" data-content="En este campo debe especificar cuáles facultades serán beneficiadas por la alianza a suscribir. Defina de igual manera, los programas que serán contemplados." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--facultad_origen_otro-->
							<div class="col-sm-6 col-md-6 hide" contenido="facultad_origen_otro">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('facultad_origen_otro') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-plus fa-md fa-fw"></i></span>
										{{ Form::text('facultad_origen_otro', old('facultad_origen_otro'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese la otra facultad']) }}

									</div>
								</div>
							</div>
						<!--programa_origen-->
							<div class="col-sm-6 col-md-6" contenido="programa_origen">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('programa_origen') ? 'has-error' : '') }}" >
										<span class="input-group-addon"><i class="fa fa-graduation-cap fa-md fa-fw"></i></span>
										{{ Form::select('programa_origen[]', $programa_origen, old('programa_origen[]'), ['class' => 'form-control input-md select2 ', 'data-placeholder' => 'Seleccione los programas beneficiados', 'target' => '', 'url' => '', 'multiple']) }}
										<span class="input-group-addon" rel="popover" data-content="Seleccione los programas beneficiados" data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						</div>

						<!--TIPO de alianza -->
						<div class="row paso1 hide">

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('tipo_alianza') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-check fa-md fa-fw"></i></span>
										{{ Form::select('tipo_alianza', $tipo_alianza->prepend('Seleccione el tipo de alianza',''), old('tipo_alianza'), ['class' => 'form-control input-md', 'target' => 'aplicaciones', 'url' => route('aplicaciones.listAplicaciones')]) }}
										<span class="input-group-addon" rel="popover" data-original-title="Seleccione el tipo de alianza" data-content="<div class='checkbox'>De acuerdo a sus propósitos, defina si la alianza que desea suscribir es:</div><div class='checkbox'>- <b>Marco:</b> que conlleva al cumplimiento de compromisos interinstitucionales de manera general, y en la mayoría de los casos requieren de alianzas específicas para la ejecución en el momento que sea necesario.</div><div class='checkbox'>- <b>Específico:</b> son los que llevan al cumplimiento de compromisos y obligaciones determinadas, precisas y ejecutables.</div>" data-placement="top" data-html="true" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>

						<!-- aplicaciones-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('aplicaciones') ? 'has-error' : '') }}" >
										<span class="input-group-addon"><i class="fa fa-check-square fa-md fa-fw"></i></span>
										{{ Form::select('aplicaciones', $aplicaciones->prepend('Seleccione las aplicaciones',''), old('aplicaciones'), ['class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
										<span class="input-group-addon" rel="popover" data-original-title="Seleccione las aplicaciones (modalidades)" data-content="En este campo debe especificarse cuál será el objeto de la alianza o la modalidad de la misma dentro de la lista.<br>Seleccione una opción luego de conocer qué tipos de colaboración son contempladas en cada categoría." data-placement="bottom" data-html="true" ><i class="fa fa-commenting fa-md fa-fw" title="click para ver ayuda" ></i></span>
									</div>
								</div>
							</div>

						<!--Responsable de la ARL-->
							<div class="col-sm-6 col-md-6 hide responsable_arl">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('responsable_arl') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-ambulance fa-md fa-fw"></i></span>
										{{ Form::select('responsable_arl', __('messages.options.arl'), old('responsable_arl'), ['class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							
						<!--fecha de inicio  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('fecha_inicio') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-clock-o fa-md fa-fw"></i></span>

										{{ Form::text('fecha_inicio', old('fecha_inicio'), ['required' => 'required', 'class' => 'form-control input-md', 'placeholder' => 'Ingrese la fecha de inicio de la alianza', 'title' => 'Ingrese la fecha de inicio de la alianza', 'onfocussss' => '(this.type="date")', 'onblurrrrrr' => '(this.type="text")', 'id' => 'date' ]) }}
									</div>
								</div>
							</div>

						<!--duración-->
							<div class="col-sm-6 col-md-6"> 
								<div class="form-group">
									<div class="input-group {{ ($errors->has('duracion_cant') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-calendar-check-o fa-md fa-fw"></i></span>
										<div class="col-sm-6 nopadding">
											{{ Form::select('duracion_cant', __('messages.options.duracion_cant'), old('duracion_cant') ?? '1', ['class' => 'form-control input-md', 'title' => 'Seleccione el tiempo de duración', 'target' => '', 'url' => '']) }}
										</div>
										<div class="col-sm-6 nopadding">
											{{ Form::select('duracion_unid', __('messages.options.duracion_unid'), old('duracion_unid') ?? 'MESES', ['class' => 'form-control input-md', 'title' => 'Seleccione el tiempo de duración', 'target' => '', 'url' => '']) }}
										</div>
										<span class="input-group-addon" rel="popover" data-content="Seleccione el período en el que la alianza tendrá vigencia una vez esté formalizado." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>

						<!--explique el objetivo-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('objetivo_alianza') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-paragraph fa-md fa-fw"></i></span>
										{{ Form::textarea('objetivo_alianza', old('objetivo_alianza'), ['class' => 'form-control input-md', 'rows' => '3', 'placeholder' => 'Explique brevemente el objetivo de la alianza']) }}
									</div>
								</div>
							</div>	
						</div>	
						<!--datos del coordinador -->
						<!--usted es el coordinador??? -->
						<!-- <div class="row hide">
							<br>
							<h3> Coordinador interno</h3>
							<div class="col-sm-12">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('tipo_tramite') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-thumb-tack fa-md fa-fw"></i></span>
										<div class="inline-group form-control input-md">
											<span></span>&nbsp;¿Usted será el coordinador de la alianza?&nbsp;
											<label class="radio-inline">
												{{ Form::radio('sera_coordinador_origen', 'SI', old('sera_coordinador_origen') ?? true, ['id' => 'sera_coordinador_origen', 'class' => 'checkbox_show', 'accion' => 'ocultar']) }}
												<i></i>SI
											</label>
											<label class="radio-inline">
												{{ Form::radio('sera_coordinador_origen', 'NO', old('sera_coordinador_origen') ?? false, ['id' => 'sera_coordinador_origen', 'class' => 'checkbox_show', 'accion' => 'mostrar']) }}
												<i></i>NO
											</label>
										</div>																
									</div>
								</div>
							</div>
						</div> -->
						<div class="row paso1___________________________________ hide" id="">

							<br>
							<h3> Coordinador solicitante</h3>
						<!-- lista profesores y coordinadores-->
							<div class="col-sm-6 col-md-6 hide">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('coordinador_origen') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user-o fa-md fa-fw"></i></span>
										{{ Form::hidden('coordinador_origen', $alliance['coordinador_origen']) }}

										{{-- Form::select('coordinador_origen', $coordinador_origen->prepend('Seleccione al Coordinador',''), old('coordinador_origen'), ['class' => 'form-control input-md', 'target' => 'nombre_coordinador_origen,cargo_coordinador_origen,telefono_coordinador_origen,email_coordinador_origen', 'url' => route('interalliances.list')]) --}}
										<span class="input-group-addon" rel="popover" data-content="Por favor incluya los datos de contacto de la persona designada en la Facultad para realizar seguimiento a la suscripción y ejecución de la alianza en la institucion." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						</div>
						<!--datos del coordinador -->
						<div class="row paso1___________________________________ hide" id="" contenido="">
						<!--datos del coordinador  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('nombre_coordinador_origen') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user fa-md fa-fw"></i></span>
										{{ Form::text('nombre_coordinador_origen', old('nombre_coordinador_origen'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Nombre del Coordinador', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 1 ? 'disabled' :'' ) ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('cargo_coordinador_origen') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-briefcase fa-md fa-fw"></i></span>
										{{ Form::text('cargo_coordinador_origen', old('cargo_coordinador_origen'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Cargo del Coordinador', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 1 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						<!--telefono  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('telefono_coordinador_origen') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('telefono_coordinador_origen', old('telefono_coordinador_origen'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Teléfono y Extensión del Coordinador', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 1 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						<!--email -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('email_coordinador_origen') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-envelope fa-md fa-fw"></i></span>
										{{ Form::text('email_coordinador_origen', old('email_coordinador_origen'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Email del Coordinador', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 1 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
						</div>

						<div class="row paso1 hide">
							<br>
							<h3> Escoja los documentos que desea enviar:</h3>
							<div class="col col-sm-6 col-md-6 checkbox_show"  id="enviar_documentos">
								<div class="form-group">
									<span class="input-group-addon text-left">
										<label class="no-margin ">
											<input type="checkbox" name="seleccionar_todos" id="seleccionar_todos" value="1" class="checkbox style-0" checked="checked">
											<span></span>&nbsp;&nbsp;&nbsp;Seleccionar todos

										</label>
									</span>
									<span class="input-group-addon" rel="popover" data-original-title="Escoja los documentos que desea enviar" data-content="Incluya al menos dos de los documentos a continuación enunciados (remitiéndolos junto a la carta del Decano solicitando la suscripción de la alianza):<ul><li><b>Representación Legal:</b> Este certificado de existencia de representación legal.</li><li><b>Acta de Nombramiento:</b> Documento formal en el cual se designa al Representante Legal para la toma de decisiones.</li><li><b>Acta de posesión:</b> Documento por el cual se firma constancia del movimiento para asumir o entregar el cargo de representante legal.</li><li><b>Cédula o Documento de Identificación:</b> Es el documento de identificación del Representante Legal, válido a nivel Nacional.</li><li><b>Cámara de Comercio:</b> Es el archivo público donde se encuentran matriculados todos los empresarios y organizaciones legalmente constituidas. </li><li><b>Resolución/Decreto:</b> Acto administrativo en el que se establecen deberes y derechos dentro de la organización. </li><li><b>Personería Jurídica:</b> Documentos que sustenten la personería jurídica de dicha institución.</li></ul>" data-placement="top" data-html="true"><i class="fa fa-commenting fa-md fa-fw" title="click para ver ayuda" ></i></span>
									<div class="input-group full">

										<table class="table table-hover full">
										@foreach( $enviar_documentos as $enviar_documento )
											<tr>
												<td class="padding_side">
													<span class="checkbox">
														<label class="full">
														  @if( isset($documentos_seleccionados) )
															<input type="checkbox" name="enviar_documentos[]" value="{{ $enviar_documento['id'] }}" class="checkbox style-0" {{ ( array_search($enviar_documento['id'], $documentos_seleccionados) === false ) ? '' : 'checked="checked"' }} >
														  @else
														  	<input type="checkbox" name="enviar_documentos[]" value="{{ $enviar_documento['id'] }}" class="checkbox style-0" checked="checked">
														  @endif
															<span></span> {{ $enviar_documento['nombre'] }}
															<a class="btn btn-xs btn-default pull-right" target="_blank" href="{{ \Storage::url($enviar_documento['path']) }}">Ver</a>
														</label>
													</span>
												</td>
											</tr>
										@endforeach
											
										</table>
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso == 2 )
				<div class="step-pane {{ ( $editar_paso == 2 ? 'active' : '' ) }}"  data-step="2">
					{!! Form::model($alliance, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso2', 'novalidate', 'class' => 'PreRegistro_form'.($editar_paso > 0 ? '_solo' : '').' interalliance', 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 2</strong> - {{ $paso_titulo[2] }} <span class="{{ !isset($alianzaId) ? 'hide' : '' }} span-proceso-id">- Alianza #<b>{{ $alianzaId ?? '' }}</b></span></h3>

						{{ Form::hidden('paso', '2') }}
						{{ Form::hidden('tipoRuta', $tipoRuta) }}

						@if( isset($alianzaId) )
							{{ Form::hidden('alianzaId', $alianzaId) }}
							{{ Form::hidden('modificar', '1') }}
						@endif
						<div id="results" class="hide">
						</div>
						<div class="row">
						<!--facultades  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('institucion_destino', $institucion_destino->prepend('Seleccione la institucion',''), old('institucion_destino[]'), ['class' => 'form-control input-md', 'target' => 'coordinador_destino,tipo_institucion_destino,nombre_institucion_destino,direccion_institucion_destino,telefono_institucion_destino,codigo_postal_institucion_destino,pais_institucion_destino,departamento_institucion_destino,ciudad_institucion_destino', 'url' => route('interalliances.list')]) }}
										<span class="input-group-addon" rel="popover" data-content="Seleccione la Institución Contraparte." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						</div>
						<!--institucion y tipo de institucion -->
						<!--div class="row" contenido="institucion_destino_otro"-->
						<div class="row" contenido="">

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('tipo_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-sitemap fa-md fa-fw"></i></span>
										{{ Form::select('tipo_institucion_destino', $tipo_institucion_destino->prepend('Seleccione el tipo de institución',''), old('tipo_institucion_destino'), ['class' => 'form-control input-md no_vaciar', 'target' => '', 'url' => '']) }}
										<span class="input-group-addon" rel="popover" data-content="Caracterice la naturaleza de la institución contraparte de acuerdo a su constitución jurídica." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('nombre_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::text('nombre_institucion_destino', old('institucion'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Nombre de la Institución']) }}
									</div>
								</div>
							</div>
						<!--direccion  -->

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('direccion_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-map-o fa-md fa-fw"></i></span>
										{{ Form::text('direccion_institucion_destino', old('direccion_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese la Dirección del campus principal']) }}
										<span class="input-group-addon" rel="popover" data-content="Por favor incluya la dirección completa de domicilio para la institución contraparte." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--telefono -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('telefono_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('telefono_institucion_destino', old('telefono_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Teléfono del campus principal']) }}
									</div>
								</div>
							</div>
						<!--codigo postal -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('codigo_postal_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-map-marker fa-md fa-fw"></i></span>
										{{ Form::text('codigo_postal_institucion_destino', old('codigo_postal_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Código postal del campus principal', 'data-mask' => '999999', 'data-mask-placeholder' => 'X']) }}
									</div>
								</div>
							</div>
						<!--pais y ciudad -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('pais_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-flag fa-md fa-fw"></i></span>
										{{ Form::select('pais_institucion_destino', $pais_institucion_destino->prepend('Seleccione el país',''), null, ['class' => 'form-control input-md no_vaciar', 'target' => 'departamento_institucion_destino', 'url' => route('admin.cities.listStates')]) }}
										<span class="input-group-addon" rel="popover" data-content="Precise el país y la ciudad de establecimiento de la institución contraparte." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('departamento_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('departamento_institucion_destino', $departamento_institucion_destino->prepend('Seleccione el departamento',''), old('departamento_institucion_destino'), ['class' => 'form-control input-md', 'target' => 'ciudad_institucion_destino', 'url' => route('admin.cities.listCities')]) }}
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('ciudad_institucion_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('ciudad_institucion_destino', $ciudad_institucion_destino->prepend('Seleccione la ciudad',''), old('ciudad_institucion_destino'), ['class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
						</div>


						<!--datos del coordinador -->
						<div class="row checkbox_show">
							<br>
							<h3> Coordinador externo</h3>

						<!-- lista profesores y coordinadores-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('coordinador_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user-circle fa-md fa-fw"></i></span>
										{{ Form::select('coordinador_destino', $coordinador_destino->prepend('Seleccione al coordinador',''), old('coordinador_destino'), ['class' => 'form-control input-md', 'target' => 'nombre_coordinador_destino,cargo_coordinador_destino,telefono_coordinador_destino,email_coordinador_destino', 'url' => route('interalliances.list')]) }}
										<span class="input-group-addon" rel="popover" data-content="Esta información corresponde al par académico o la persona designada para realizar seguimiento a la suscripción y ejecución de la alianza en la institución contraparte." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row " contenido="">
						<!--nombre y cargo -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('nombre_coordinador_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-user-circle-o fa-md fa-fw"></i></span>
										{{ Form::text('nombre_coordinador_destino', old('nombre_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Nombre del Coordinador Externo', (isset($alliance['coordinador_destino_activo']) && $alliance['coordinador_destino_activo'] == 1 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('cargo_coordinador_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-briefcase fa-md fa-fw"></i></span>
										{{ Form::text('cargo_coordinador_destino', old('cargo_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Cargo del Coordinador Externo', (isset($alliance['coordinador_destino_activo']) && $alliance['coordinador_destino_activo'] == 1 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						<!--email y telefonos coordinador externo -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group"> 
									<div class="input-group {{ ($errors->has('telefono_coordinador_destino') ? 'has-error' : '') }}"> 
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('telefono_coordinador_destino', old('telefono_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Teléfono del Coordinador Externo', (isset($alliance['coordinador_destino_activo']) && $alliance['coordinador_destino_activo'] == 1 ? 'disabled' :'' )]) }}
										<span class="input-group-addon" rel="popover" data-content="Escriba el número telefónico general de la institución contraparte (con indicativo de país y ciudad si corresponde)." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--email -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group {{ ($errors->has('email_coordinador_destino') ? 'has-error' : '') }}">
										<span class="input-group-addon"><i class="fa fa-envelope fa-md fa-fw"></i></span>
										{{ Form::text('email_coordinador_destino', old('email_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Email del Coordinador Externo', 'title' => 'Ingrese el Email del Coordinador Externo', (isset($alliance['coordinador_destino_activo']) && $alliance['coordinador_destino_activo'] == 1 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						</div>

					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso == 3 )
				<div class="step-pane {{ ( $editar_paso == 3 ? 'active' : '' ) }}"  data-step="3">
					{!! Form::model($alliance, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso3', 'novalidate', 'class' => 'PreRegistro _form'.($editar_paso > 0 ? '_solo' : '').' interalliance', 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 3</strong> - {{ $paso_titulo[3] }} <span class="{{ !isset($alianzaId) ? 'hide' : '' }} span-proceso-id">- Alianza #<b>{{ $alianzaId ?? '' }}</b></span></h3>
						<br>

						<div class="para_ver_datos">
							{{ Form::hidden('paso', '3') }}
							{{ Form::hidden('ver', 'true') }}
							{{ Form::hidden('tipoRuta', $tipoRuta) }}

							@if( isset($alianzaId) )
								{{ Form::hidden('alianzaId', $alianzaId) }}
								{{ Form::hidden('modificar', '1') }}
							@endif
						
						</div>
						{{ Form::hidden('enviar', true) }}
						<div id="results" class="hide">
						</div>

						<h1 class="text-center text-success"><strong><i class="fa fa-envelope-o fa-md"></i> Enviar la solicitud.</strong></h1>
						<div class="text-center">
							<div class="form-group">
								<div class="form-group">
									<p class="h3">Revise los datos que ha ingresado escogiendo la opción <b>Revizar los datos</b> ó elija la opción <strong>Enviar solicitud</strong> para finalizar.</p >
								</div>
								<hr>


			                    {!! Form::button('<i class="fa fa-list-alt"></i> Revizar los datos', ['type' => 'button', 'class' => 'btn btn-lg btn-info', 'name' => 'ver_pre_registro', 'id' => 'ver_pre_registro', 'url' => route('interalliances.email') ]) !!}

								{!! Form::button('<i class="fa fa-external-link"></i> Enviar solicitud', ['type' => 'submit', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_pre_registro', 'id' => 'enviar_pre_registro', 'url' => route('interalliances.email') ]) !!}
			                    <br><br>
								<div id="ver_datos" class="ver_datos">
									
								</div>
								<hr>
							</div>
						</div>

						<br>
						<div class="text-center hide" id="datos_email_enviar" rel="popover-hover" data-original-title="Guardar/Enviar Pre-registro" data-content="Si los datos registrados son correctos y desea dar inicio al proceso de solicitud de trámite de la alianza, elija la opción <b>Enviar solicitud</b>." data-placement="top" data-html="true">
							
								<br>
							<div class="form-group">
								<div class="">
									{!! Form::button('<i class="fa fa-external-link"></i> Enviar solicitud', ['type' => 'submit', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_pre_registro', 'id' => 'enviar_pre_registro', 'url' => route('interalliances.email') ]) !!}
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
								@if( strpos($tipoRuta, 'destination') !== false )
									@php  $routeBack = route('interalliances.destination',$alianzaId); @endphp
								@elseif( strpos($tipoRuta, 'origin') !== false )
									@php  $routeBack = route('interalliances.show',$alianzaId); @endphp
								@endif
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

		$('.select2').select2();
		

		//se enviaron las funciones de mostrarContenido, CambiarContenidoSelect, formEnviar y EnviarDatosAjax al script my_functions.js

		/*
		$('select[multiple="multiple"]').each(function(){
			$(this).multiselect({

	        	nonSelectedText: $(this).attr('title')
	    	});		
	    });		
		*/
		




		  
	
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