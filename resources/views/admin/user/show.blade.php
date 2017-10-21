@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.user.show_fields')
                    @if ($ruta == 'admin')
                        @php $routeBack = 'admin.users.index'; @endphp
                    @else
                        @php $routeBack = 'user.index'; @endphp
                    @endif
                    <a href="{!! route($routeBack) !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
