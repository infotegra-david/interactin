@component('mail::message')# Cordial saludo

{!! $content[0]['header'] !!}



@include('InterAlliance.show_fields',['omitir_collapse' => true, 'omitir_adjuntos' => true])

<div class="col-sm-12">
    <hr>
</div>


@component('mail::panel')

{!! $content[0]['footer'] !!}

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
