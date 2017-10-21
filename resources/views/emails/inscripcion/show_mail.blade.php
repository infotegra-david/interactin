@extends( 'emails.layouts.ver' )

<?php
    $content = json_decode($dataMail[0]->content, true);
    //print_r($content);
?>

@section('msj_header')
    <tr>
        <td class="content-cell">
            {!! $content[0]['header'] !!}
        </td>
    </tr>
@endsection


@section('data')
    <table class="panel" width="570" cellpadding="0" cellspacing="0">
        <tr>
            <td class="panel-content">
                <table class="table" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <h2>{{ $paso_titulo[1] }}</h2>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                    <!-- institucion origen  -->
                            <td>
                                <strong>Tipo de tramite:</strong> {{ $dataAlianza['tipo_tramite_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>

                    <!-- facultad origen -->
                                <strong>Facultades beneficiadas:</strong> <br>
                                @foreach($dataAlianza['facultades'] as $key => $facultad)
                                    {{ $facultad['facultad_nombre'] }} <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                    <!-- programa origen -->
                                <strong>Programas beneficiados:</strong> <br>
                                @foreach($dataAlianza['programas'] as $key => $programa)
                                    {{ $programa['programa_nombre'] }} <br>
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <td>
                    <!-- tipo de alianza origen -->    
                                <strong>Tipo de alianza:</strong> <br>
                                {{ $dataAlianza['aplicaciones'][0]['tipo_alianza_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Aplicaciones:</strong> <br>
                            <!-- aplicaciones origen -->
                                <?php $mostrarARL = false; ?>
                                @foreach($dataAlianza['aplicaciones'] as $key => $aplicaciones)
                                    <?php if ($aplicaciones['aplicaciones_id'] == 3) {
                                        $mostrarARL = true;
                                    } ?>
                                    {{ $aplicaciones['aplicaciones_nombre'] }} <br>
                                @endforeach
                            </td>
                        </tr>
                    <!-- responsable_arl  buscar el id actual para el caso de Prácticas y Pasantías = 3-->
                        @if( $mostrarARL == true ) 
                        <tr>
                            <td>
                                <strong>Responsable arl:</strong> {{ ($dataAlianza['responsable_arl'] == 0 ? 'ORIGEN' : 'DESTINO') }}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td>
                                <strong>Duración:</strong> {{ $dataAlianza['duracion'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Objetivo:</strong> {{ $dataAlianza['objetivo'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                &nbsp;&nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Datos del Coordinador del Origen</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                            </td>
                        </tr>
                @foreach($dataUsers as $key => $dataUser)
                    @if ($dataUser['usuario_id'] == $CoordinadorInterno)

                    <?php $emailCoordinador = $dataUser['coordinador_email']; ?>
                        <tr>
                            <td>
                                <strong>Nombre:</strong> {{ $dataUser['coordinador_nombres'] }} {{ $dataUser['coordinador_apellidos'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Cargo:</strong> {{ $dataUser['coordinador_cargo'] }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Telefono:</strong> {{ $dataUser['coordinador_telefono'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>E-mail:</strong> {{ $dataUser['coordinador_email'] }}
                            </td>
                        </tr>

                    @endif
                @endforeach
                    </tbody>
                </table>

        @foreach($dataUsers as $key => $dataUser)
            @if ($dataUser['usuario_id'] == $CoordinadorExterno)
                <table class="table" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <h2>{{ $paso_titulo[2] }}</h2>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- institucion destino  -->
                        <tr>
                            <td>
                                <strong>Tipo de institucion:</strong> {{ $dataUser['institucion']['tipo_institucion_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Nombre:</strong> {{ $dataUser['institucion']['nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Direccion:</strong> {{ $dataUser['institucion']['campus_direccion'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Telefono:</strong> {{ $dataUser['institucion']['campus_telefono'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Código postal:</strong> {{ $dataUser['institucion']['campus_codigo_postal'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>País:</strong> {{ $dataUser['institucion']['ciudad']['pais_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Departamento/Estado:</strong> {{ $dataUser['institucion']['ciudad']['departamento_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Ciudad:</strong> {{ $dataUser['institucion']['ciudad']['ciudad_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <!-- coordinador destino -->

                                <strong>Datos del Coordinador del Destino</strong> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Nombre:</strong> {{ $dataUser['coordinador_nombres'] }} {{ $dataUser['coordinador_apellidos'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Cargo:</strong> {{ $dataUser['coordinador_cargo'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Teléfono:</strong> {{ $dataUser['coordinador_telefono'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>E-mail:</strong> {{ $dataUser['coordinador_email'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>

              @if( isset($dataUser['institucion']['representante']) )
                <table class="table" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <h2>{{ $paso_titulo[5] }}</h2>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- representante legal destino  -->
                        <tr>
                            <td>
                                <strong>Nombre del representante:</strong> {{ $dataUser['institucion']['representante']['repre_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Cargo:</strong> {{ $dataUser['institucion']['representante']['cargo'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Teléfono:</strong> {{ $dataUser['institucion']['representante']['telefono'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>E-mail:</strong> {{ $dataUser['institucion']['representante']['repre_email'] }}
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <strong>País de nacimiento:</strong> {{ $dataUser['institucion']['representante']['pais_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Tipo de documento:</strong> {{ $dataUser['institucion']['representante']['tipo_documento_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Número de documento:</strong> {{ $dataUser['institucion']['representante']['numero_documento'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Fecha de expedición:</strong> {{ $dataUser['institucion']['representante']['fecha_expedicion'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>País de expedición del documento:</strong> {{ $dataUser['institucion']['representante']['lugar_expedicion']['pais_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Departamento/Estado de expedición del documento:</strong> {{ $dataUser['institucion']['representante']['lugar_expedicion']['departamento_nombre'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Ciudad de expedición del documento:</strong> {{ $dataUser['institucion']['representante']['lugar_expedicion']['ciudad_nombre'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
              @endif

            @endif
        @endforeach
                
            </td>
        </tr>
    </table>
@endsection

@section('mail_content')
    {!! $content[0]['footer'] !!}
@endsection


@section('email_footer')
    <br>
    E-mail del coordinador: {{ $emailCoordinador }}
@endsection