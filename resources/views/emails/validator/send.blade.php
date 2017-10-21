@component('mail::message')
# Cordial saludo

@component('mail::panel')

{!! $dataMail->content !!}

@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'green'])

Ir a InterActin

@endcomponent

Gracias,<br>
{{ config('app.name') }}
<br>
@endcomponent
