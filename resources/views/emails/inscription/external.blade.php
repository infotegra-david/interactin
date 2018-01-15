@component('mail::message')

@component('mail::button', ['url' => $url, 'color' => 'green', 'class' => 'right', 'style' => 'right: 2%; position: absolute;'])

Ir a InterActin

@endcomponent

# Cordial saludo

{!! $content[0]['header'] !!}



@include('InterAlliance.show_fields',['omitir_collapse' => true, 'omitir_adjuntos' => true, 'enviar_email' => true])

<div class="col-sm-12">
    <hr>
</div>


@component('mail::panel')

<strong>{!! $content[0]['footer'] !!}</strong>

@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'green'])

Ir a InterActin

@endcomponent
<p>
Gracias,<br>
{{ config('app.name') }}
<br>
E-mail del coordinador: {{ $dataUsers[$keyCoordInterno]['coordinador_email'] }}
<br>
</p>
@endcomponent
