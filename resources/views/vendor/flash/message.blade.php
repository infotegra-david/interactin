@foreach ((array) session('flash_notification') as $message)
@php $message = (array)$message[0]; @endphp
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
            @endif
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @php $conteo = 0; @endphp
            @if ( is_array($message['message'] ) )
                @foreach($message['message'] as $messageText)
                    @if ( $conteo > 0 ) 
                        {!! $messageText.'<br>' !!}                   
                    @else
                        {!! $messageText !!}
                    @endif
                    @php $conteo++; @endphp
                @endforeach
            @else
                {!! $message['message'] !!}
            @endif
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}