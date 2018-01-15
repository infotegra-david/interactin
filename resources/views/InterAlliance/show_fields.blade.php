

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
                        <span> {!! $dataAlianza['created_at'] !!}</span>
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
                        <span> {!! $dataAlianza['updated_at'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="">
                <div class=" full">
                    <!-- Estado Field -->
                    <div class=" full">
                        {!! Form::label('estado', 'Estado:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataAlianza['estado_nombre'] !!}</span>
                    </div>
                </div>
            </div>
        </div>
        @if( !isset($omitir_collapse) )
        <div class="col-sm-6">
            <div class="">
                <div class=" full">
                    <!-- Estado Field -->
                    <div class=" full">
                        {!! Form::button('<i class="fa fa-info-circle"></i> Mas información', ['type' => 'button', 'class' => 'btn btn-md btn-info collapseAlianza collapseProceso hide', 'name' => 'collapseAlianza', 'id' => 'collapseAlianza', 'data-toggle' => 'collapse', 'data-target' => '#collapseDataAlianza', 'url' => '' ]) !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="row col-sm-12" id="collapseDataAlianza">
    <div class="{{ (!isset($enviar_email) ? 'col-md-12' : '') }} col-lg-6">
        <div class="col-sm-12">
            <hr>
        </div>
        <!-- <div class="col-sm-12"> -->
        <div class="col-sm-12">
            <h2>{{ $paso_titulo[1] }}</h2>
        </div>
        <br>
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Tipo Tramite Id Field -->
                    <div class=" full">
                        {!! Form::label('tipo_tramite_id', 'Tipo Tramite:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataAlianza['tipo_tramite_nombre'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Objetivo Field -->
                    <div class=" full">
                        {!! Form::label('facultades', 'Facultades:', ['class' => 'text-bold']) !!} <br>
                        <ul>
                            @foreach($dataAlianza['facultades'] as $key => $facultad)
                                <li> {!! $facultad['facultad_nombre'] !!}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Objetivo Field -->
                    <div class=" full">
                        {!! Form::label('programas', 'Programas:', ['class' => 'text-bold']) !!} <br>
                        <ul>
                            @foreach($dataAlianza['programas'] as $key => $programa)
                                <li> {!! $programa['programa_nombre'] !!}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>  

        @if(count($dataAlianza['aplicaciones']))
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Objetivo Field -->
                        <div class=" full">
                            {!! Form::label('tipo_alianza', 'Tipo de alianza:', ['class' => 'text-bold']) !!} 
                            <span> {!! $dataAlianza['aplicaciones'][0]['tipo_alianza_nombre'] !!}</span>
                        </div>
                    </div>
                </div>
            </div>  
        @endif
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Objetivo Field -->
                    <div class=" full">
                        {!! Form::label('aplicaciones', 'Aplicacion:', ['class' => 'text-bold']) !!} 
                        <?php $mostrarARL = false; ?>
                        @foreach($dataAlianza['aplicaciones'] as $key => $aplicaciones)
                            <?php if ($aplicaciones['aplicaciones_id'] == 3) {
                                $mostrarARL = true;
                            } ?>
                            <span> {!! $aplicaciones['aplicaciones_nombre'] !!}</span> <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>  
        <?php 
        if ($mostrarARL == true) {
        ?>
        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Responsable Arl Field -->
                    <div class=" full">
                        {!! Form::label('responsable_arl', 'Responsable Arl:', ['class' => 'text-bold']) !!}
                        <span> {!! ($dataAlianza['responsable_arl'] == 0 ? 'ORIGEN' : 'DESTINO') !!}</span>
                    </div>
                </div>
            </div>
        </div>  
        <?php 
        }
        ?>

        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Duracion Field -->
                    <div class=" full">
                        {!! Form::label('duracion', 'Duracion:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataAlianza['duracion'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  

        <div class="col-sm-12">
            <div class="">
                <div class=" full">
                    <!-- Objetivo Field -->
                    <div class=" full">
                        {!! Form::label('objetivo', 'Objetivo:', ['class' => 'text-bold']) !!}
                        <span> {!! $dataAlianza['objetivo'] !!}</span>
                    </div>
                </div>
            </div>
        </div>  
        <!-- </div>   -->
        <!-- <div class="col-sm-12"> -->
        <div class="col-sm-12">
            <h2>Coordinador solicitante</h2>
        </div>
        <br>
        
        @if ( isset($dataUsers[$keyCoordInterno]) )
            
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Objetivo Field -->
                        <div class=" full">
                            {!! Form::label('nombre', 'Nombre:', ['class' => 'text-bold']) !!}
                            <span> {!! $dataUsers[$keyCoordInterno]['coordinador_nombres'] !!} {!! $dataUsers[$keyCoordInterno]['coordinador_apellidos'] !!}</span>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Objetivo Field -->
                        <div class=" full">
                            {!! Form::label('cargo', 'Cargo:', ['class' => 'text-bold']) !!}
                            <span> {!! $dataUsers[$keyCoordInterno]['coordinador_cargo'] !!}</span>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Objetivo Field -->
                        <div class=" full">
                            {!! Form::label('telefono', 'Telefono:', ['class' => 'text-bold']) !!}
                            <span> {!! $dataUsers[$keyCoordInterno]['coordinador_telefono'] !!}</span>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-sm-12">
                <div class="">
                    <div class=" full">
                        <!-- Objetivo Field -->
                        <div class=" full">
                            {!! Form::label('email', 'E-mail:', ['class' => 'text-bold']) !!}
                            <span> {!! $dataUsers[$keyCoordInterno]['coordinador_email'] !!}</span>
                        </div>
                    </div>
                </div>
            </div>  
        @endif
        <!-- </div>   -->

        @if( isset($archivosAdjuntos) && $archivosAdjuntos != '' && count($archivosAdjuntos)  && !isset($omitir_adjuntos) )

            <div class="col-sm-12">
                <h2>Archivos adjuntos en el e-mail:</h2>
            </div>
            <br>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table-hover col-sm-12">
                        <tbody>
                            @foreach( $archivosAdjuntos as $archivoAdjunto )
                            <tr  class="" >
                                <td class="" >
                                    {{ $archivoAdjunto->nombre }}
                                </td>       
                                <td class="" >
                                    <a class="btn btn-xs btn-default pull-right" target="_blank"href="{{ Storage::url($archivoAdjunto->path) }}">Ver</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div> 
            </div> 
        @endif

        @if( isset($editar_origin) && $editar_origin == true )
            <div class="col-sm-12">
                <div class="">
                    <a href="{!! route('interalliances.origin.edit',[$alianzaId,1]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                </div>
            </div>
            <!-- <div class="col-sm-12">
                <hr>
            </div> -->
        @endif
    </div>
    <!--    --------------------------------------  -->
    <!--    --------------------------------------  -->

    @foreach($dataUsers as $key => $dataUser)
        @if ($dataUser['usuario_id'] == $CoordinadorExterno)
        <div class="col-md-12 col-lg-6">
            <div class="col-sm-12">
                <hr>
            </div>
            <!-- <div class="col-sm-12"> -->
                <div class="col-sm-12">
                    <h2>{{ $paso_titulo[2] }}</h2>
                </div>
                <br>
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('tipo_institucion_nombre', 'Tipo de institución:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['tipo_institucion_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('nombre', 'Nombre:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('campus_direccion', 'Dirección campus principal:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['campus_direccion'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('campus_telefono', 'Teléfono campus principal:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['campus_telefono'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('campus_codigo_postal', 'Código postal campus principal:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['campus_codigo_postal'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('pais_nombre', 'País:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['ciudad']['pais_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('departamento_nombre', 'Departamento/Estado:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['ciudad']['departamento_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('ciudad_nombre', 'Ciudad:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['ciudad']['ciudad_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div>  
            <div class="col-sm-12"> -->
                <div class="col-sm-12">
                    <h2>Coordinador externo</h2>
                </div>
                <br>
                        
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Objetivo Field -->
                            <div class=" full">
                                {!! Form::label('nombre', 'Nombre:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['coordinador_nombres'] !!} {!! $dataUser['coordinador_apellidos'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Objetivo Field -->
                            <div class=" full">
                                {!! Form::label('cargo', 'Cargo:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['coordinador_cargo'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Objetivo Field -->
                            <div class=" full">
                                {!! Form::label('telefono', 'Telefono:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['coordinador_telefono'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Objetivo Field -->
                            <div class=" full">
                                {!! Form::label('email', 'E-mail:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['coordinador_email'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
            @if( (isset($editar_destination) && $editar_destination == true) || (isset($editar_origin) && $editar_origin == true) )
                <div class="col-sm-12">
                    <div class="">
                        @php $route_edit = (isset($editar_destination) ? 'interalliances.destination.edit' : 'interalliances.origin.edit'); @endphp
                        <a href="{!! route($route_edit,[$alianzaId,(isset($editar_destination) ? 4 : 2)]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
            @endif
            <!-- </div> -->

            @if( !isset($omitir_collapse) )
                <div class="col-sm-12">
                    <hr>
                </div>
                <div class="col-sm-12">
                    <h2>{{ $paso_titulo[3] }}</h2>
                </div>
                <br>
                    
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Updated At Field -->
                            <div class=" full">
                                {!! Form::label('enviar_solicitud', 'Envío de la solicitud:', ['class' => 'text-bold']) !!}
                                <span> {{ ($dataAlianza['enviar_solicitud'][3] ?? 'No ha sido enviada') }}</span>
                            </div>
                        </div>
                    </div>
                </div>   

                @if( isset($editar_origin) && $editar_origin == true )
                    <div class="col-sm-12">
                        <div class="">
                            <a href="{!! route('interalliances.origin.edit',[$alianzaId,3]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12">
                        <hr>
                    </div> -->
                @endif
            @endif

            @php 
            //si no existen datos del representante entonces dejarlos vacios pero aun asi mostrarlos
            if( !isset($dataUser['institucion']['representante']) ){
                $dataUser['institucion']['representante']['usuario_activo'] = false;
                $dataUser['institucion']['representante']['repre_nombre'] = '';
                $dataUser['institucion']['representante']['cargo'] = '';
                $dataUser['institucion']['representante']['telefono'] = '';
                $dataUser['institucion']['representante']['repre_email'] = '';
                $dataUser['institucion']['representante']['pais_nombre'] = '';
                $dataUser['institucion']['representante']['tipo_documento_nombre'] = '';
                $dataUser['institucion']['representante']['numero_documento'] = '';
                $dataUser['institucion']['representante']['fecha_expedicion'] = '';
                $dataUser['institucion']['representante']['lugar_expedicion']['pais_nombre'] = '';
                $dataUser['institucion']['representante']['lugar_expedicion']['departamento_nombre'] = '';
                $dataUser['institucion']['representante']['lugar_expedicion']['ciudad_nombre'] = '';
            }
            @endphp

          @if( isset($dataUser['institucion']['representante']) )
            
                <div class="col-sm-12">
                    <hr>
                </div>
            <!-- <div class="col-sm-12"> -->
                <div class="col-sm-12">
                    <h2>{{ $paso_titulo[5] }}</h2>
                </div>
                <br>
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('repre_nombre', 'Nombre del representante:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['repre_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('cargo', 'Cargo:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['cargo'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('telefono', 'Teléfono:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['telefono'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('repre_email', 'E-mail:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['repre_email'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('pais_nombre', 'País de nacimiento:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['pais_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('tipo_documento_nombre', 'Tipo de documento:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['tipo_documento_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('numero_documento', 'Número de documento:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['numero_documento'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('fecha_expedicion', 'Fecha de expedición:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['fecha_expedicion'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('pais_nombre', 'País de expedición del documento:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['lugar_expedicion']['pais_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('departamento_nombre', 'Departamento/Estado de expedición del documento:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['lugar_expedicion']['departamento_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                {!! Form::label('ciudad_nombre', 'Ciudad de expedición del documento:', ['class' => 'text-bold']) !!}
                                <span> {!! $dataUser['institucion']['representante']['lugar_expedicion']['ciudad_nombre'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div>

            @if( isset($archivosDocumentoRepresentante)  && $archivosDocumentoRepresentante != '' && count($archivosDocumentoRepresentante) && !isset($omitir_adjuntos) )

                <div class="col-sm-12">
                    <h2>Archivo de soporte de representación legal externo:</h2>
                </div>
                <br>
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table-hover col-sm-12">
                            <tbody>
                                
                                @foreach( $archivosDocumentoRepresentante as $archivoAdjunto )
                                <tr  class="" >
                                    <td class="" >
                                        {{ $archivoAdjunto->nombre }}
                                    </td>       
                                    <td class="" >
                                        <a class="btn btn-xs btn-default pull-right" target="_blank"href="{{ Storage::url($archivoAdjunto->path) }}">Ver</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div> 
                </div>

                <div class="col-sm-12">
                    <br>
                </div>
            @endif
    
            @if( isset($editar_destination) && $editar_destination == true )
                <div class="col-sm-12">
                    <div class="">
                        <a href="{!! route('interalliances.destination.edit',[$alianzaId,5]) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    </div>
                </div>
            @endif
            <!-- </div> -->
          @endif 
          @if( isset($dataUser['observacion']) )
            
            <!-- <div class="col-sm-12"> -->
                <div class="col-sm-12">
                    <h2>Decisión del coordinador externo</h2>
                </div>
                <br>
                <div class="col-sm-12">
                    <div class="">
                        <div class=" full">
                            <!-- Tipo Tramite Id Field -->
                            <div class=" full">
                                <span> {!! $dataUser['observacion']['nombre'].': '.$dataUser['observacion']['observacion'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div>  
            <!-- </div> -->
          @endif 
        </div>
          @if( isset($editar_destination) && $editar_destination == true )
            <div class="col-sm-12">
                <br>
                {!! Form::open(['route' => ['interalliances.store'], 'method' => 'post', 'id' => 'Registro_paso6','files' => true, 'novalidate', 'class' => 'Registro_form', 'results' => 'Registro_results' ]) !!}
                    
                    {{ Form::hidden('paso', '6') }}
                    {{ Form::hidden('alianzaId', $dataAlianza['id']) }}
                    {{ Form::hidden('existeRepresentante', ( $dataUser['institucion']['representante']['usuario_activo'] !== false ? 1 :  0 ) ) }}
                    {{ Form::hidden('tipoRuta', $tipoRuta) }}

                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <h2> Aceptación de la petición de alianza</h2>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group no_tocar">
                            <div class="input-group no_tocar">
                                <span class="input-group-addon"><i class="fa fa-thumb-tack fa-lg fa-fw"></i></span>
                                <div class="inline-group form-control input-lg no_tocar">
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
                    <div class="col-sm-12">
                        <div class="form-group no_tocar">
                            <div class="input-group no_tocar {{ ($errors->has('observacion_aceptar_alianza') ? 'has-error' : '') }}">
                                <span class="input-group-addon"><i class="fa fa-paragraph fa-lg fa-fw"></i></span>
                                {{ Form::textarea('observacion_aceptar_alianza', old('observacion_aceptar_alianza'), ['class' => 'form-control input-lg no_tocar', 'rows' => '3', 'placeholder' => 'Observaciones']) }}
                            </div>
                        </div>
                    </div>  
                <!--guardar / enviar aceptar_alianza_enviar-->
                    <div class="col-sm-12 " id="aceptar_alianza_enviar">
                        <div class="form-group no_tocar">
                            <div class="input-group no_tocar">
                                {!! Form::button('<i class="fa fa-external-link"></i> Enviar respuesta', ['type' => 'button', 'class' => 'btn btn-lg btn-success', 'name' => 'enviar_aceptar', 'id' => 'enviar_aceptar', 'url' => route('interalliances.email') ]) !!}
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
                {!! Form::close() !!}
            </div>
          @endif
        @endif
    @endforeach
    <!-- <p>&nbsp;</p> -->
</div>


@if( isset($ruta) && $ruta == "destination" )
{{-- Html::script('/js/my_functions.js') --}}
<script type="text/javascript">
    $(document).ready(function() {

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
                        if ( $('#'+ thisForm ).find('input[name="tokenemail"]').size() > 0 ) {
                            //enviar_aceptar(route,thisForm);
                            stopInterval();
                        }
                    }, 100);
                };
            });

            //
        });

    })
</script>
@endif