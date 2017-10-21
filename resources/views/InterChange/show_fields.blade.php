<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Id Field -->
                    <div class="form-control full">
                        {!! Form::label('id', 'Id:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataInscripcion['id'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Created At Field -->
                    <div class="form-control full">
                        {!! Form::label('created_at', 'Fecha de creación:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataInscripcion['created_at'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Fecha de actualización:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataInscripcion['updated_at'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  
    </div>  
   
    <div class="col-sm-12">
        <div class="col-sm-12">
            <h2>{{ $paso_titulo[1] }}</h2>
        </div>
        <br>
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Nombres del estudiante:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['nombres'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Apellidos del estudiante:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['apellidos'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Tipo de documento:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['tipoDocumento']['tipo_documento_nombre'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Número de documento:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['numero_documento'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Correo institución:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['usuario_email'] }}</span>
                    </div>
                </div>
            </div>
        </div>  
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Correo personal:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['email_personal'] }}</span>
                    </div>
                </div>
            </div>
        </div>    
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Código institucional:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['codigo_institucion'] }}</span>
                    </div>
                </div>
            </div>
        </div>   

    </div>  
    <div class="col-sm-12">
        <div class="col-sm-12">
            <h2>{{ $paso_titulo[2] }}</h2>
        </div>
        <br>
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Facultad:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['programa']['facultad_nombre'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Programa:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['programa']['programa_nombre'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Promedio académico acumulado:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['promedio_acumulado'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Porcentaje de creditos aprobados:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataUsers[$keyEstudianteId]['porcentaje_aprobado'] }}</span>
                    </div>
                </div>
            </div>
        </div>   

    </div>  
    <div class="col-sm-12">
        <div class="col-sm-12">
            <h2>{{ $paso_titulo[3] }}</h2>
        </div>
        <br>
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Periodo:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataInscripcion['periodo']['periodo_nombre'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Modalidad:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataInscripcion['modalidades']['modalidades_nombre'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'País:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataInscripcion['paises']['pais_nombre'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
            
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group full">
                    <!-- Updated At Field -->
                    <div class="form-control full">
                        {!! Form::label('updated_at', 'Institución de destino:', ['class' => 'text-bold']) !!}
                        <span> {{ $dataInscripcion['institucion']['institucion_nombre'] }}</span>
                    </div>
                </div>
            </div>
        </div>   
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