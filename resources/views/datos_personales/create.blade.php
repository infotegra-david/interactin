@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Datos Personales
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'datosPersonales.store']) !!}

                        @include('datos_personales.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
