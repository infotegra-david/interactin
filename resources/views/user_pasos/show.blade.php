@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Paso
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('user_pasos.show_fields')
                    <a href="{!! route('userPasos.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
