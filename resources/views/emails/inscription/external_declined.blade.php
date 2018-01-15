@component('mail::message')
# Cordial saludo

{!! $content[0]['header'] !!}

Registro las siguientes observaciones:

@component('mail::panel')

{{ $dataEmail[0]->paso_observacion }}

@endcomponent

{!! $content[0]['footer'] !!}

Gracias,<br>
{{ config('app.name') }}
<br>
E-mail del coordinador: {{ $coordinadorDestinoEmail }}
<br>
@endcomponent
