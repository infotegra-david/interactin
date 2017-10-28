
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
			<i id="buton_help" class="fa fa-info-circle text-info" data-toggle="collapse" data-target="#collapseExample"></i>
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
                    <li>Ingrese la información de los datos internos.</li>
                    <li>Seleccione quien sera el coordinador interno.</li>
                    <li>Ingrese la información de los datos de la institución contraparte.</li>
                    <li>Seleccione quien sera el coordinador externo.</li>
                    <li>Revise los datos que ha ingresado.</li>
                    <li>Envíe la petición al coordinador externo para que revise la información y apruebe la solicitud de alianza.</li>
                    <li>La subscripcion entrara en un prceso de validación para finalmente estar activa.</li>
                </ul>     
            </div>
        </div>
		<div class="step-content" id="PreRegistro_content">
			@if( $editar_paso === false || $editar_paso == 1 )
				<div class="step-pane {{ ( ($editar_paso === false || $editar_paso == 1 ) ? 'active' : '' ) }}"  data-step="1">
					{!! Form::model($alliance, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso1', 'novalidate', 'class' => 'PreRegistro_form'.($editar_paso > 0 ? '_solo' : ''), 'results' => 'PreRegistro_results']) !!}
					<br>
						<h3><strong>Paso 1 </strong> - {{ $paso_titulo[1] }}</h3>

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
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-check-square-o fa-md fa-fw"></i></span>
										{{ Form::select('tipo_tramite', $tipo_tramite->prepend('Seleccione el tipo de trámite', ''), old('tipo_tramite'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de trámite']) }}
									</div>
								</div>
							</div>
						</div>
						<div class="row paso1 hide">
						<!--facultades  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group" >
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('facultad_origen[]', $facultad_origen, old('facultad_origen[]'), ['class' => 'form-control input-md select2', 'data-placeholder' => 'Seleccione las facultades beneficiadas', 'target' => 'programa_origen[]', 'url' => route('admin.programs.listPrograms'), 'multiple']) }}
										<span class="input-group-addon"  rel="popover" data-content="En este campo debe especificar cuáles facultades serán beneficiadas por la alianza a suscribir. Defina de igual manera, los programas que serán contemplados." data-placement="top"><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--facultad_origen_otro-->
							<div class="col-sm-6 col-md-6 hide" contenido="facultad_origen_otro">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-plus fa-md fa-fw"></i></span>
										{{ Form::text('facultad_origen_otro', old('facultad_origen_otro'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese la otra facultad']) }}

									</div>
								</div>
							</div>
						<!--programa_origen-->
							<div class="col-sm-6 col-md-6" contenido="programa_origen">
								<div class="form-group">
									<div class="input-group" >
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
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-check fa-md fa-fw"></i></span>
										{{ Form::select('tipo_alianza', $tipo_alianza->prepend('Seleccione el tipo de alianza', ''), old('tipo_alianza'), ['class' => 'form-control input-md', 'target' => 'aplicaciones', 'url' => route('aplicaciones.listAplicaciones'), 'placeholder' => 'Seleccione el tipo de alianza']) }}
										<span class="input-group-addon" rel="popover" data-original-title="Seleccione el tipo de alianza" data-content="<div class='checkbox'>De acuerdo a sus propósitos, defina si la alianza que desea suscribir es:</div><div class='checkbox'>- <b>Marco:</b> que conlleva al cumplimiento de compromisos interinstitucionales de manera general, y en la mayoría de los casos requieren de alianzas específicas para la ejecución en el momento que sea necesario.</div><div class='checkbox'>- <b>Específico:</b> son los que llevan al cumplimiento de compromisos y obligaciones determinadas, precisas y ejecutables.</div>" data-placement="top" data-html="true" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>

						<!-- aplicaciones-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group" >
										<span class="input-group-addon"><i class="fa fa-check-square fa-md fa-fw"></i></span>
										{{ Form::select('aplicaciones', $aplicaciones, old('aplicaciones'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione las aplicaciones (modalidades)', 'target' => '', 'url' => '']) }}
										<span class="input-group-addon" rel="popover" data-original-title="Seleccione las aplicaciones (modalidades)" data-content="En este campo debe especificarse cuál será el objeto de la alianza o la modalidad de la misma dentro de la lista.<br>Seleccione una opción luego de revisar detalladamente qué tipos de colaboración son contempladas en cada categoría.<br><b>- Cooperación Interinstitucional:</b><br>Apoyos Educativos,	Cooperación Interinstitucional,	Becas Utopía, Créditos Educativos, Descuentos Programas Académicos, Beneficio Educativo, Subsidios económicos a estudiantes de limitados recursos, Proyectos, Acompañamiento a IES en procesos de Internacionalización, Profesionalización, Colaboración Académica<br><b>- Actividades Científicas y de Cooperación Académica Investigativa:</b><br> Actividades Científicas, Cooperación Investigativa, Cooperación Técnica, Cooperación Cultural, Proyectos de Investigación, Cooperación en Tecnología<br><b>- Prácticas y Pasantías:</b><br>Pasantías Nacionales, Pasantías Internacionales, Prácticas Nacionales, Prácticas Internacionales, Prácticas de Investigación<br><b>- Movilidad Académica Estudiantil:</b><br>Intercambio estudiantil para proyectos, Movilidad Nacional de estudiantes, Movilidad Internacional de estudiantes, Intercambio estudiantil (Idiomas)<br><b>- Doble Titulación:</b><br>Programas de Doble TItulación, Programas de Triple Titulación, Educación Continua<br><b>- Docencia-Servicio:</b><br>Docencia-Servicio, Docente Asistencial<br><b>- Inmersión Universitaria:</b><br>Inmersión Académica Estudiante No Regular, Inmersión Universitaria, Inmersión Colegio<br><b>- Movilidad Académica de Profesores, Investigadores o Administrativos:</b><br>Movilidad Docentes, Movilidad Investigadores, Movilidad Personal Administrativo" data-placement="bottom" data-html="true" ><i class="fa fa-commenting fa-md fa-fw" title="click para ver ayuda" ></i></span>
									</div>
								</div>
							</div>

						<!--Responsable de la ARL-->
							<div class="col-sm-6 col-md-6 hide responsable_arl">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-ambulance fa-md fa-fw"></i></span>
										{{ Form::select('responsable_arl', config('options.ARL'), old('responsable_arl'), ['class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
									</div>
								</div>
							</div>
							
						<!--duración-->
							<div class="col-sm-6 col-md-6"> 
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar-check-o fa-md fa-fw"></i></span>
										<div class="col-sm-6 nopadding">
											{{ Form::select('duracion_cant', config('options.duracion_cant'), old('duracion_cant'), ['class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
										</div>
										<div class="col-sm-6 nopadding">
											{{ Form::select('duracion_unid', config('options.duracion_unid'), old('duracion_unid'), ['class' => 'form-control input-md', 'target' => '', 'url' => '']) }}
										</div>
										<span class="input-group-addon" rel="popover" data-content="Seleccione el período en el que la alianza tendrá vigencia una vez esté formalizado." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--explique el objetivo-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
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
									<div class="input-group">
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
						<div class="row paso1 hide" id="">

							<br>
							<h3> Coordinador interno</h3>
						<!-- lista profesores y coordinadores-->
							<div class="col-sm-6 col-md-6 hide">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-o fa-md fa-fw"></i></span>
										{{ Form::hidden('coordinador_origen', $alliance['coordinador_origen']) }}

										{{-- Form::select('coordinador_origen', $coordinador_origen->prepend('Seleccione al coordinador', ''), old('coordinador_origen'), ['class' => 'form-control input-md', 'target' => 'nombre_coordinador_origen,cargo_coordinador_origen,telefono_coordinador_origen,email_coordinador_origen', 'url' => route('interalliances.list'), 'placeholder' => 'Seleccione al Coordinador']) --}}
										<span class="input-group-addon" rel="popover" data-content="Por favor incluya los datos de contacto de la persona designada en la Facultad para realizar seguimiento a la suscripción y ejecución de la alianza en la institucion." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						</div>
						<!--datos del coordinador -->
						<div class="row paso1 hide" id="" contenido="">
						<!--datos del coordinador  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user fa-md fa-fw"></i></span>
										{{ Form::text('nombre_coordinador_origen', old('nombre_coordinador_origen'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Nombre del Coordinador', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 0 ? 'disabled' :'' ) ]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-briefcase fa-md fa-fw"></i></span>
										{{ Form::text('cargo_coordinador_origen', old('cargo_coordinador_origen'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Cargo del Coordinador', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						<!--telefono  -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('telefono_coordinador_origen', old('telefono_coordinador_origen'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Teléfono y Extensión del Coordinador', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						<!--email -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope fa-md fa-fw"></i></span>
										{{ Form::text('email_coordinador_origen', old('email_coordinador_origen'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Email del Coordinador', (isset($alliance['coordinador_origen_activo']) && $alliance['coordinador_origen_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
						</div>

						<div class="row paso1 hide">
							<br>
							<h3> Escoja los documentos que desea enviar:</h3>
							<div class="col col-sm-6 col-md-6 checkbox_show"  id="enviar_documentos">
								<div class="form-group">
									<span class="input-group-addon" rel="popover" data-original-title="Escoja los documentos que desea enviar" data-content="Incluya al menos dos de los documentos a continuación enunciados (remitiéndolos junto a la carta del Decano solicitando la suscripción de la alianza):<br><b>- Representación Legal:</b><br>Este certificado de existencia de representación legal, cumple funciones como la de informar sobre aspectos relevantes de una sociedad, tal como la antigüedad, objeto social, domicilio, número y nombre de socios, monto del capital y nombre y facultades del representante legal.<br><b>- Acta de Nombramiento:</b><br>Documento formal en el cual se designa al Representante Legal para la toma de decisiones de acuerdo a los estatutos y la leyes que correspondan de acuerdo a la naturaleza jurídica de la institución. (Entidades Públicas)<br><b>- Acta de posesión:</b><br>Es el documento por el cual se firma constancia del movimiento personal y presencial para asumir o entregar el cargo de representante legal. (Entidades Públicas)<br><b>- Cédula o Documento de Identificación:</b><br>Es el documento de identificación del Representante Legal, válido a nivel Nacional. En caso de que sea extranjero y el domicilio de la empresa sea en Colombia, debe presentarse la Cédula de Extranjería.<br><b>- Cámara de Comercio:</b><br>Es el archivo público donde se encuentran matriculados todos los empresarios y organizaciones legalmente constituidas (Entidades Privadas). <br><b>- Resolución/Decreto:</b><br>Acto administrativo en el que se establecen deberes y derechos dentro de la organización con grado de flexibilidad, oportunidad e información. <br><b>- Personería Jurídica:</b><br>Documentos que sustenten la personería jurídica de dicha institución, por ejemplo, Registro Único Tributario R.U.T o Registro de Información Tributaria R.I.T." data-placement="top" data-html="true"><i class="fa fa-commenting fa-md fa-fw" title="click para ver ayuda" ></i></span>
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
					{!! Form::model($alliance, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso2', 'novalidate', 'class' => 'PreRegistro_form'.($editar_paso > 0 ? '_solo' : ''), 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 2</strong> - {{ $paso_titulo[2] }}</h3>

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
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::select('institucion_destino', $institucion_destino->prepend('Seleccione la institucion', ''), old('institucion_destino[]'), ['class' => 'form-control input-md', 'target' => 'coordinador_destino,tipo_institucion_destino,nombre_institucion_destino,direccion_institucion_destino,telefono_institucion_destino,codigo_postal_institucion_destino,pais_institucion_destino,departamento_institucion_destino,ciudad_institucion_destino', 'url' => route('interalliances.list'), 'placeholder' => 'Seleccione la institucion']) }}
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
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-sitemap fa-md fa-fw"></i></span>
										{{ Form::select('tipo_institucion_destino', $tipo_institucion_destino->prepend('Seleccione el tipo de institucion', ''), old('tipo_institucion_destino'), ['class' => 'form-control input-md no_vaciar', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de institucion']) }}
										<span class="input-group-addon" rel="popover" data-content="Caracterice la naturaleza de la institución contraparte de acuerdo a su constitución jurídica." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
										{{ Form::text('nombre_institucion_destino', old('institucion'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Nombre de la Institución']) }}
									</div>
								</div>
							</div>
						<!--direccion  -->

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-map-o fa-md fa-fw"></i></span>
										{{ Form::text('direccion_institucion_destino', old('direccion_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese la Dirección del campus principal']) }}
										<span class="input-group-addon" rel="popover" data-content="Por favor incluya la dirección completa de domicilio para la institución contraparte." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--telefono -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('telefono_institucion_destino', old('telefono_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Teléfono del campus principal']) }}
									</div>
								</div>
							</div>
						<!--codigo postal -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-map-marker fa-md fa-fw"></i></span>
										{{ Form::text('codigo_postal_institucion_destino', old('codigo_postal_institucion_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Código postal del campus principal', 'data-mask' => '999999', 'data-mask-placeholder' => 'X']) }}
									</div>
								</div>
							</div>
						<!--pais y ciudad -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-flag fa-md fa-fw"></i></span>
										{{ Form::select('pais_institucion_destino', $pais_institucion_destino->prepend('Seleccione el país', ''), null, ['class' => 'form-control input-md no_vaciar', 'target' => 'departamento_institucion_destino', 'url' => route('admin.cities.listStates'), 'placeholder' => 'Seleccione el país']) }}
										<span class="input-group-addon" rel="popover" data-content="Precise el país y la ciudad de establecimiento de la institución contraparte." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('departamento_institucion_destino', $departamento_institucion_destino, old('departamento_institucion_destino'), ['class' => 'form-control input-md', 'target' => 'ciudad_institucion_destino', 'url' => route('admin.cities.listCities'), 'placeholder' => 'Seleccione el departamento']) }}
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-flag-o fa-md fa-fw"></i></span>
										{{ Form::select('ciudad_institucion_destino', $ciudad_institucion_destino, old('ciudad_institucion_destino'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione la ciudad']) }}
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
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-circle fa-md fa-fw"></i></span>
										{{ Form::select('coordinador_destino', $coordinador_destino->prepend('Seleccione al coordinador', ''), old('coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione al coordinador', 'target' => 'nombre_coordinador_destino,cargo_coordinador_destino,telefono_coordinador_destino,email_coordinador_destino', 'url' => route('interalliances.list')]) }}
										<span class="input-group-addon" rel="popover" data-content="Esta información corresponde al par académico o la persona designada para realizar seguimiento a la suscripción y ejecución de la alianza en la institución contraparte." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="row " contenido="">
						<!--nombre y cargo -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-circle-o fa-md fa-fw"></i></span>
										{{ Form::text('nombre_coordinador_destino', old('nombre_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Nombre del Coordinador Externo', (isset($alliance['coordinador_destino_activo']) && $alliance['coordinador_destino_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-briefcase fa-md fa-fw"></i></span>
										{{ Form::text('cargo_coordinador_destino', old('cargo_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Cargo del Coordinador Externo', (isset($alliance['coordinador_destino_activo']) && $alliance['coordinador_destino_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						<!--email y telefonos coordinador externo -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group"> 
									<div class="input-group"> 
										<span class="input-group-addon"><i class="fa fa-phone fa-md fa-fw"></i></span>
										{{ Form::text('telefono_coordinador_destino', old('telefono_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Teléfono del Coordinador Externo', (isset($alliance['coordinador_destino_activo']) && $alliance['coordinador_destino_activo'] == 0 ? 'disabled' :'' )]) }}
										<span class="input-group-addon" rel="popover" data-content="Escriba el número telefónico general de la institución contraparte (con indicativo de país y ciudad si corresponde)." data-placement="top" ><i class="fa fa-commenting fa-md fa-fw"></i></span>
									</div>
								</div>
							</div>
						<!--email -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope fa-md fa-fw"></i></span>
										{{ Form::text('email_coordinador_destino', old('email_coordinador_destino'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el Email del Coordinador Externo', 'title' => 'Ingrese el Email del Coordinador Externo', (isset($alliance['coordinador_destino_activo']) && $alliance['coordinador_destino_activo'] == 0 ? 'disabled' :'' )]) }}
									</div>
								</div>
							</div>
							
						</div>

					{!! Form::close() !!}
				</div>
			@endif
			@if( $editar_paso === false || $editar_paso == 3 )
				<div class="step-pane {{ ( $editar_paso == 3 ? 'active' : '' ) }}"  data-step="3">
					{!! Form::model($alliance, ['route' => $route, 'method' => $method, 'id' => 'PreRegistro_paso3', 'novalidate', 'class' => 'PreRegistro_form'.($editar_paso > 0 ? '_solo' : ''), 'results' => 'PreRegistro_results']) !!}
						<br>
						<h3><strong>Paso 3</strong> - {{ $paso_titulo[3] }}</h3>
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
						<div id="results" class="hide">
						</div>

						<h1 class="text-center text-success"><strong><i class="fa fa-check fa-md"></i> Completado</strong></h1>
						<div class="text-center">
							<div class="form-group">
								<h3 class="text-center">Previsualización del e-mail.</h3>
								<div class="form-group">
									<p>Revise los datos que ha ingresado para poder enviar el pre-registro, elija la opción <b>Ver los datos</b> </p>
								</div>
								<hr>


			                    {!! Form::button('<i class="fa fa-list-alt"></i> Ver los datos', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'ver_pre_registro', 'id' => 'ver_pre_registro', 'url' => route('interalliances.mail') ]) !!}
			                    <br><br>
								<div id="ver_datos" class="ver_datos">
									
								</div>
								<hr>
							</div>
						</div>

						<br>
						<div class="text-center hide" id="datos_email_enviar" rel="popover" data-original-title="Guardar/Enviar Pre-registro" data-content="En caso de que desee modificar alguna informacion de la solicitud de trámite de la alianza más adelante, elija la opción <b>Modificar</b>. Por el otro lado, si el formulario ya está debidamente diligenciado y desea dar inicio al proceso de solicitud de trámite de la alianza, elija la opción <b>Guardar/Enviar</b>." data-placement="top" data-html="true">
							<div class="form-group">
								<div class="">
									<h4 class="text-center">Elija la opción <strong>Enviar solicitud</strong> para finalizar.</h4>
								</div>
							</div>
								<br>
							<div class="form-group">
								<div class="">
									 {!! Form::button('<i class="fa fa-pencil-square-o"></i> Modificar', ['type' => 'button', 'class' => 'btn btn-lg btn-info', 'name' => 'modificar_pre_registro', 'id' => 'modificar_pre_registro', 'url' => route('interalliances.mail') ]) !!}
									&nbsp;&nbsp;&nbsp;
									 {!! Form::button('<i class="fa fa-external-link"></i> Enviar solicitud', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_pre_registro', 'id' => 'enviar_pre_registro', 'url' => route('interalliances.mail') ]) !!}
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

		$('.select2').select2();
		

		//se enviaron las funciones de mostrarContenido, CambiarContenidoSelect, formEnviar y EnviarDatosAjax al script my_functions.js

		/*
		$('select[multiple="multiple"]').each(function(){
			$(this).multiselect({

	        	nonSelectedText: $(this).attr('title')
	    	});		
	    });		
		*/
		

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
			var mensaje = 'Cuando la institución destino de una respuesta se enviará un mensaje a su correo electrónico.';
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
    		//console.log(thisForm);
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
			var mensaje = 'Cuando la institución destino de una respuesta se enviará un mensaje a su correo electrónico.';

			var route = $(this).attr('url');
			
			//alert('route: '+ route);

			//
		});

		  
	
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