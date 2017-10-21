@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Institucion
        </h1>
    </section>
    <div class="content">
        <div id="flash-msg">
            @include('flash::message')
            @include('adminlte-templates::common.errors')
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.instituciones.show_fields')
                    <a href="{!! route('admin.institutions.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
