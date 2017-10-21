@component('mail::message')
# Cordial saludo

{!! $content[0]['header'] !!}

Registro las siguientes observaciones:

{{ $dataMail[0]->paso_observacion }}


@component('mail::panel')

{!! $content[0]['footer'] !!}

@endcomponent

Gracias,<br>
{{ config('app.name') }}
<br>
E-mail del coordinador: {{ $coordinadorDestinoEmail }}
<br>
@endcomponent
