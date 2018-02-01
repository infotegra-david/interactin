
<?php 
    $numero_paso = [];
    foreach ($paso_titulo as $key => $value) {
        $numero_paso[$key] = $key;
    }
    // $numero_paso = array_keys($paso_titulo->toArray());
    if( $pasoMaximo >= 5 ){
        $numero_paso[1] = 5;
        $numero_paso[2] = 6;
        $numero_paso[3] = 7;
    }

    $generos = config('options.genero'); 

    // print_r($numero_paso);
    // print_r($dataUsers);
    // print_r($dataInscripcion);
?>


<div class="col-sm-12">
    <div class="col-sm-12">
        <div id="Registro_results">
            <div id="show-msg" return="">
                @include( 'layouts.alerts' )
            </div>
        </div>
    </div>
</div>
<div class="row col-sm-12">
    <div class="col-sm-12">
        <hr>
    </div>
    <div class="col-sm-12">

        <div class="col-sm-6">
            <div class="">
                <div class=" full">
                    <!-- Created At Field -->
                    <div class=" full">
                        {!! Form::label('created_at', 'Fecha de creación:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataInscripcion['created_at'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('updated_at', 'Fecha de actualización:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataInscripcion['updated_at'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('estado_nombre', 'Estado:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataInscripcion['estado_nombre'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  

    @if( !isset($omitir_collapse) && $peticion != "limpio" )

        <div class="col-sm-6">
            <div class="">
                <div class=" full">
                    <!-- Estado Field -->
                    <div class=" full">
                        {!! Form::button('<i class="fa fa-info-circle"></i> Mas información', ['type' => 'button', 'class' => 'btn btn-md btn-info collapseProceso collapseInscripcion hide', 'name' => 'collapseProceso', 'id' => 'collapseProceso', 'data-toggle' => 'collapse', 'data-target' => '#collapseDataInscripcion', 'url' => '' ]) !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>  
</div>
<div class="row col-sm-12" id="collapseDataInscripcion">
    <div class="{{ (!isset($enviar_email) ? 'col-md-12' : '') }} col-lg-6">
        <div class="col-sm-12">
            <hr>
        </div>
        @if( $dataInscripcion['estado_nombre'] == 'ACTIVA' )
                        
            <div class="col-sm-12">
                <div class=" full">
                    <div class="text-center">
                        <img src="http://interactin.com/img/logo.png" alt="InterActin">
                        <!-- <img src="http://localhost:8000/storage/inscripcion/17/77cf18a51ddba6ae566155fb5e266e2d.jpg" alt="{{ $dataInscripcion['archivo_foto']['nombre'] }}"> -->

                        { { Html::image( \Storage::url($dataInscripcion['archivo_foto']['path']), $dataInscripcion['archivo_foto']['nombre'], array('class' => 'foto carnet')) }}
                        
                    </div>
                </div>
            </div>

        @endif
        <div class="col-sm-12">
            <h2>{{ $paso_titulo[$numero_paso[1]] }}</h2>
        </div>
        <br>
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('nombres', 'Nombres del estudiante:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['nombres'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('apellidos', 'Apellidos del estudiante:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['apellidos'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('tipo_documento_nombre', 'Tipo de documento:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['tipoDocumento']['tipo_documento_nombre'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('numero_documento', 'Número de documento:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['numero_documento'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('usuario_email', 'Correo institución:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['usuario_email'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>  
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('email_personal', 'Correo personal:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['email_personal'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>    
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('codigo_institucion', 'Código institucional:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['codigo_institucion'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
        @if( $pasoMaximo >= 5 )
            
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_genero', 'Género:', ['class' => 'text-bold']) !!}
                            
                            <span> {{ $generos[$dataUsers[$keyEstudianteId]['genero']] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_nacionalidad', 'Nacionalidad:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['nacionalidad']['nacionalidad_nombre'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_pasaporte', 'No. de pasaporte:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['nro_pasaporte'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_exp_pasaporte', 'Fecha de expedición del pasaporte:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['fecha_expedicion_pasaporte'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_vence_pasaporte', 'Fecha de vencimiento del pasaporte:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['fecha_vencimiento_pasaporte'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_telefono', 'Teléfono fijo:', ['class' => 'text-bold']) !!}
                            
                            <span> {{ $dataUsers[$keyEstudianteId]['telefono'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_celular', 'Celular:', ['class' => 'text-bold']) !!}
                            
                            <span> {{ $dataUsers[$keyEstudianteId]['celular'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_ciudad_residencia', 'Ciudad de residencia:', ['class' => 'text-bold']) !!}
                            
                            <span> {{ $dataUsers[$keyEstudianteId]['ciudad_residencia']['ciudad_nombre'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_direccion', 'Dirección:', ['class' => 'text-bold']) !!}
                            
                            <span> {{ $dataUsers[$keyEstudianteId]['direccion'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('estudiante_codigo_postal', 'Código postal:', ['class' => 'text-bold']) !!}
                            
                            <span> {{ $dataUsers[$keyEstudianteId]['codigo_postal'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
        @endif

        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
            <div class="col-sm-12">
                <div class="">
                    <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[1]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                </div>
            </div>
            <!-- <div class="col-sm-12">
                <hr>
            </div> -->
        @endif

        <div class="col-sm-12">
            <hr>
        </div>
        <div class="col-sm-12">
            <h2>{{ $paso_titulo[$numero_paso[2]] }}</h2>
        </div>
        <br>
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('facultad_nombre', 'Facultad:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['programa'][$keyProgramaOrigen]['facultad_nombre'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('programa_nombre', 'Programa:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['programa'][$keyProgramaOrigen]['programa_nombre'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('promedio_acumulado', 'Promedio académico acumulado:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['promedio_acumulado'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('porcentaje_aprobado', 'Porcentaje de creditos aprobados:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['porcentaje_aprobado'] ?? '' }}%</span>
                    </div>
                </div>
            </div>
        </div> 
            
        @if( $pasoMaximo >= 5 )
            <div class="col-sm-12">
                <h2>Idiomas</h2>
            </div>
            <br>
            
            @if( isset($dataUsers[$keyEstudianteId]['idiomas']) )
                @foreach( $dataUsers[$keyEstudianteId]['idiomas'] as $idioma )
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    {!! Form::label('tipo_idioma_nombre', 'Idioma:', ['class' => 'text-bold']) !!}
                                    <span> {{ $idioma['tipo_idioma_nombre'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    {!! Form::label('nombre_examen', 'Nombre del examen:', ['class' => 'text-bold']) !!}
                                    <span> {{ $idioma['nombre_examen'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    {!! Form::label('nivel_nombre', 'Nivel alcanzado:', ['class' => 'text-bold']) !!}
                                    <span> {{ $idioma['nivel_nombre'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    {!! Form::label('certificado', 'Certificado:', ['class' => 'text-bold']) !!}
                                    <span> {{ $idioma['certificado'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <hr>
                    </div>
                @endforeach
            @else
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    <span> No hay idiomas registrados</span>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
        @endif

        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
            <div class="col-sm-12">
                <div class="">
                    <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[2]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                </div>
            </div>
            <!-- <div class="col-sm-12">
                <hr>
            </div> -->
        @endif
@if( $pasoMaximo <= 4 )
    </div>  
    <div class="col-md-12 col-lg-6">
        <div class="col-sm-12">
            <hr>
        </div>
@endif
        <div class="col-sm-12">
            <h2>{{ $paso_titulo[$numero_paso[3]] }}</h2>
        </div>
        <br>
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('periodo_nombre', 'Periodo:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataInscripcion['periodo'][0]['periodo_nombre'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('modalidad_nombre', 'Modalidad:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataInscripcion['modalidad'][0]['modalidad_nombre'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('pais_nombre', 'País:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataInscripcion['paises'][0]['pais_nombre'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        {!! Form::label('institucion_destino_nombre', 'Institución de destino:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataInscripcion['institucion_destino'][0]['institucion_nombre'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>  
        @if( $pasoMaximo >= 5 )
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('campus_destino_nombre', 'Campus de destino:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataInscripcion['programa_destino'][0]['facultad_destino'][0]['campus_destino'][0]['campus_nombre'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('facultad_destino_nombre', 'Facultad de destino:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataInscripcion['programa_destino'][0]['facultad_destino'][0]['facultad_nombre'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>  
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('programa_destino_nombre', 'Programa de destino:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataInscripcion['programa_destino'][0]['programa_nombre'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>   
        @endif

        @if( $pasoMaximo >= 5 )
            <div class="col-sm-12">
                <h2>Asignaturas</h2>
            </div>
            <br>
            
            @if( count($dataInscripcion['asignaturas']) >= 1 ) 
                @foreach( $dataInscripcion['asignaturas'] as $asignatura )
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    {!! Form::label('asignatura_origen_id', 'Asignatura de origen:', ['class' => 'text-bold']) !!}
                                    <span> {{ $asignatura['asignatura_origen_id'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    {!! Form::label('nro_creditos_origen', 'Nro. de creditos:', ['class' => 'text-bold']) !!}
                                    <span> {{ $asignatura['nro_creditos_origen'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    {!! Form::label('asignatura_destino_id', 'Asignatura de destino:', ['class' => 'text-bold']) !!}
                                    <span> {{ $asignatura['asignatura_destino_id'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    {!! Form::label('nro_creditos_destino', 'Nro. de creditos:', ['class' => 'text-bold']) !!}
                                    <span> {{ $asignatura['nro_creditos_destino'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <hr>
                    </div>
                @endforeach
            @else
                    <div class="col-sm-12">
                        <div class="">
                            <div class=" full">
                                <!-- Updated At Field -->
                                <div class=" full">
                                    <span> No hay asignaturas registradas</span>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
        @endif

        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Updated At Field -->
                    <div class=" full">
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
            <div class="col-sm-12">
                <div class="">
                    <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[3]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                </div>
            </div>
            <!-- <div class="col-sm-12">
                <hr>
            </div> -->
        @endif

        @if( $peticion != "limpio" )
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>{{ $paso_titulo[$numero_paso[4]] }}</h2>
            </div>
            <br>
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('enviar_solicitud', 'Envío de la solicitud:', ['class' => 'text-bold']) !!}
                            <span> {{ ($dataInscripcion['enviar_solicitud'][4] ?? 'No ha sido enviada') }}</span>
                        </div>
                    </div>
                </div>
            </div>   


            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        
            @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[4]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <hr>
                </div> -->
            @endif
        @endif

        
        <!-- paso 8 -->
        @if( $pasoMaximo >= 5 )
        </div>  
        <div class="col-md-12 col-lg-6">
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>{{ $paso_titulo[$numero_paso[8]] }}</h2>
            </div>
            <br>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_nombres', 'Nombres del contacto:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['contacto_nombres'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_apellidos', 'Apellidos del contacto:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['contacto_apellidos'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_parentesco', 'Parentesco:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['parentesco']['nombre'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_email_personal', 'Email:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['contacto_email'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_telefono', 'Teléfono fijo:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['contacto_telefono'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_celular', 'No. de celular:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['contacto_celular'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_departamento_residencia', 'Departamento de residencia:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['ciudad_residencia']['departamento']['departamento_nombre'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_ciudad_residencia', 'Ciudad de residencia:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['ciudad_residencia']['ciudad_nombre'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_direccion', 'Dirección del contacto:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['contacto_direccion'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('contacto_codigo_postal', 'Código postal del contacto:', ['class' => 'text-bold']) !!}
                            <span> {{ $dataUsers[$keyEstudianteId]['contacto']['contacto_codigo_postal'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        
            @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[8]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <hr>
                </div> -->
            @endif
        @endif

        @if( $pasoMaximo >= 5 )
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>{{ $paso_titulo[$numero_paso[9]] }}</h2>
            </div>
            <br>
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('fuente_financia_nacional', 'Nacional:', ['class' => 'text-bold']) !!}
                            <span> {{ ($dataInscripcion['financiacion']['nacional']['fuente_financiacion_nombre'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            </div>  
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('monto_financia_nacional', 'Monto:', ['class' => 'text-bold']) !!}
                            <span> ${{ ($dataInscripcion['financiacion']['nacional']['financiacion_monto'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if( isset($dataInscripcion['financiacion']['internacional']['fuente_financiacion_nombre']) )

            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('fuente_financia_internacional', 'Interacional:', ['class' => 'text-bold']) !!}
                            <span> {{ ($dataInscripcion['financiacion']['internacional']['fuente_financiacion_nombre'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            </div>  
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('monto_financia_internacional', 'Monto:', ['class' => 'text-bold']) !!}
                            <span> ${{ ($dataInscripcion['financiacion']['internacional']['financiacion_monto'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @endif

            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        
            @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[9]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <hr>
                </div> -->
            @endif
        @endif

        @if( $pasoMaximo >= 5 )
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>{{ $paso_titulo[$numero_paso[10]] }}</h2>
            </div>
            <br>
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('presupuesto_hospedaje', 'Hospedaje:', ['class' => 'text-bold']) !!}
                            <span> ${{ ($dataInscripcion['presupuesto_hospedaje'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            </div>  
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('presupuesto_alimentacion', 'Alimentación:', ['class' => 'text-bold']) !!}
                            <span> ${{ ($dataInscripcion['presupuesto_alimentacion'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            </div>  
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('presupuesto_transporte', 'Transporte:', ['class' => 'text-bold']) !!}
                            <span> ${{ ($dataInscripcion['presupuesto_transporte'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            </div>  
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('presupuesto_otros', 'Otros:', ['class' => 'text-bold']) !!}
                            <span> ${{ ($dataInscripcion['presupuesto_otros'] ?? '') }}</span>
                        </div>
                    </div>
                </div>
            </div>  


            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        
            @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[10]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <hr>
                </div> -->
            @endif
        @endif

        @if( $pasoMaximo >= 5 )
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>{{ $paso_titulo[$numero_paso[11]] }}</h2>
            </div>
            <br>
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('archivo_documentos_soporte', 'Archivo:', ['class' => 'text-bold']) !!}
                            @if(isset($dataInscripcion['archivo_documentos_soporte']['nombre']))
                                {{ $dataInscripcion['archivo_documentos_soporte']['nombre'] }}
                                <a class="btn btn-xs btn-default pull-right" target="_blank" href="{{ \Storage::url($dataInscripcion['archivo_documentos_soporte']['path']) }}">Ver</a>
                            @else
                                <span>No se ha cargado previamente el archivo</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>   


            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        
            @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[11]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <hr>
                </div> -->
            @endif
        @endif

        @if( $pasoMaximo >= 5 && $dataInscripcion['estado_nombre'] != 'ACTIVA' )

            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>{{ $paso_titulo[$numero_paso[12]] }}</h2>
            </div>
            <br>
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('archivo_foto', 'Archivo:', ['class' => 'text-bold']) !!}
                            @if(isset($dataInscripcion['archivo_foto']['nombre']))
                                {{ $dataInscripcion['archivo_foto']['nombre'] }}
                                <a class="btn btn-xs btn-default pull-right" target="_blank" href="{{ \Storage::url($dataInscripcion['archivo_foto']['path']) }}">Ver</a>
                            @else
                                <span>No se ha cargado previamente el archivo</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>   


            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        
            @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[12]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <hr>
                </div> -->
            @endif
        @endif

        @if( $pasoMaximo >= 5 && $peticion != "limpio" )
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>{{ $paso_titulo[$numero_paso[13]] }}</h2>
            </div>
            <br>
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('enviar_solicitud', 'Envío de la solicitud:', ['class' => 'text-bold']) !!}
                            <span> {{ ($dataInscripcion['enviar_solicitud'][13] ?? 'No ha sido enviada') }}</span>
                        </div>
                    </div>
                </div>
            </div>   


            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        
            @if( isset($editar) && $editar == true && $pasoMaximo <= 13 )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[13]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <hr>
                </div> -->
            @endif
        @endif

        @if( $pasoMaximo >= 14 )
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>{{ $paso_titulo[$numero_paso[14]] }}</h2>
            </div>
            <br>
                
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            {!! Form::label('archivo_documentos_finales', 'Archivo:', ['class' => 'text-bold']) !!}
                            @if(isset($dataInscripcion['archivo_documentos_finales']['nombre']))
                                {{ $dataInscripcion['archivo_documentos_finales']['nombre'] }}
                                <a class="btn btn-xs btn-default pull-right" target="_blank" href="{{ \Storage::url($dataInscripcion['archivo_documentos_finales']['path']) }}">Ver</a>
                            @else
                                <span>No se ha cargado previamente el archivo</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>   


            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Updated At Field -->
                        <div class=" full">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        
            @if( isset($editar) && $editar == true && $pasoMaximo >= 14 )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.editStep',[$inscripcionId,$numero_paso[14]]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <hr>
                </div> -->
            @endif
        @endif
    </div>   
    <!--    --------------------------------------  -->

    @if( isset($archivosAdjuntos) )
        @if( count($archivosAdjuntos) && $archivosAdjuntos != '' )
          <div class="col-sm-12">
              <div class="col-sm-12">

                <div class="table-responsive">
                    <table class="table-hover" width="570">
                        <thead>
                            <tr>
                                <th class="content-cell" >
                                    <h3>Archivos adjuntos:</h3>
                                </th>
                                <th class="" >
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $archivosAdjuntos as $archivoAdjunto )
                            <tr  class="" >
                                <td class="" >
                                    {{ $archivoAdjunto->nombre }}
                                </td>       
                                <td class="" >
                                    {{-- <a class="btn btn-xs btn-default pull-right" target="_blank"href="{ { asset('/').Storage::url($archivoAdjunto->path) }}">Ver</a>--}}
                                    <a class="btn btn-xs btn-default pull-right" target="_blank"href="{{ Storage::url($archivoAdjunto->path) }}">Ver</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div> 
            </div> 
          </div> 
        @endif
    @endif
 
    <p>&nbsp;</p>
</div>