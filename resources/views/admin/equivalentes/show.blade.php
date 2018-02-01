@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Equivalentes
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.equivalentes.show_fields')
                    <a href="{!! route('admin.equivalentes.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
