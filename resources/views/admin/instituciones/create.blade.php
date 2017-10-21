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
                <div class="row">
                    {!! Form::open(['route' => 'admin.institutions.store']) !!}

                        @include('admin.instituciones.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
