@component('mail::message')# Cordial saludo

<a href="{{ $url }}" class="button button-{{ 'green' }} right" target="_blank">Ir a InterActin</a>
{!! $content[0]['header'] !!} 

@component('mail::table')
| <h2>{{ $paso_titulo[1] }}</h2>                                                                |                                                                                                   |
| ------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------- |
| <strong>Tipo de tramite:</strong> {{ $dataAlianza['tipo_tramite_nombre'] }}						| 	|
|<strong>Facultades beneficiadas:</strong> <br> @foreach($dataAlianza['facultades'] as $key => $facultad) - {{ $facultad['facultad_nombre'] }} <br> @endforeach	| <strong>Programas beneficiados:</strong> <br> @foreach($dataAlianza['programas'] as $key => $programa) - {{ $programa['programa_nombre'] }} <br> @endforeach	|
| <strong>Tipo de alianza:</strong> <br> {{ $dataAlianza['aplicaciones'][0]['tipo_alianza_nombre'] }} |  <strong>Aplicaciones:</strong> <br> <?php $mostrarARL = false; ?> @foreach($dataAlianza['aplicaciones'] as $key => $aplicaciones) @if($aplicaciones['aplicaciones_id'] == 3) <?php $mostrarARL = true; ?> @endif - {{ $aplicaciones['aplicaciones_nombre'] }} <br> @endforeach	 |
| | @if( $mostrarARL == true ) <strong>Responsable arl:</strong> {{ ($dataAlianza['responsable_arl'] == 0 )? 'ORIGEN' : 'DESTINO' }} @endif |
| <strong>Duración:</strong> {{ $dataAlianza['duracion'] }} | <strong>Objetivo:</strong> {{ $dataAlianza['objetivo'] }} |
| <strong>Datos del Coordinador del Origen</strong> |  |
| <strong>Nombre:</strong> {{ $dataUsers[$keyCoordInterno]['coordinador_nombres'] }} {{ $dataUsers[$keyCoordInterno]['coordinador_apellidos'] }} | <strong>Cargo:</strong> {{ $dataUsers[$keyCoordInterno]['coordinador_cargo'] }} |
| <strong>Telefono:</strong> {{ $dataUsers[$keyCoordInterno]['coordinador_telefono'] }} | <strong>E-mail:</strong> {{ $dataUsers[$keyCoordInterno]['coordinador_email'] }} |
@endcomponent

@component('mail::table')
| <h2>{{ $paso_titulo[2] }}</h2>                                                               |                                                                                                   |
| ------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------- |
| <strong>Tipo de institucion:</strong> {{ $dataUsers[$keyCoordExterno]['institucion']['tipo_institucion_nombre'] }} | <strong>Nombre:</strong> {{ $dataUsers[$keyCoordExterno]['institucion']['nombre'] }} |
| <strong>Direccion:</strong> {{ $dataUsers[$keyCoordExterno]['institucion']['campus_direccion'] }} | <strong>Telefono:</strong> {{ $dataUsers[$keyCoordExterno]['institucion']['campus_telefono'] }} |
| <strong>Código postal:</strong> {{ $dataUsers[$keyCoordExterno]['institucion']['campus_codigo_postal'] }} | <strong>País:</strong> {{ $dataUsers[$keyCoordExterno]['institucion']['ciudad']['pais_nombre'] }} |
| <strong>Departamento/Estado:</strong> {{ $dataUsers[$keyCoordExterno]['institucion']['ciudad']['departamento_nombre'] }} | <strong>Ciudad:</strong> {{ $dataUsers[$keyCoordExterno]['institucion']['ciudad']['ciudad_nombre'] }} |
| <strong>Datos del Coordinador del Destino</strong>  |  |
| <strong>Nombre:</strong> {{ $dataUsers[$keyCoordExterno]['coordinador_nombres'] }} {{ $dataUsers[$keyCoordExterno]['coordinador_apellidos'] }} | <strong>Cargo:</strong> {{ $dataUsers[$keyCoordExterno]['coordinador_cargo'] }} |
| <strong>Teléfono:</strong> {{ $dataUsers[$keyCoordExterno]['coordinador_telefono'] }} | <strong>E-mail:</strong> {{ $dataUsers[$keyCoordExterno]['coordinador_email'] }} |
@endcomponent


@component('mail::panel')

{!! $content[0]['footer'] !!}

@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'green'])

Ir a InterActin

@endcomponent

Gracias,<br>
{{ config('app.name') }}
<br>
E-mail del coordinador: {{ $dataUsers[$keyCoordInterno]['coordinador_email'] }}
<br>
@endcomponent
