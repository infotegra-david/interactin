@component('mail::message')
# Introduction

Your order has been shipped!


The body of your message.

@component('mail::panel')
This is the panel content.
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'green'])

View Order

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
