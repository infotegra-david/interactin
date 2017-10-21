@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inscripcion {{ $pasoInscripcion->inscripcion_id }}, vista del paso 
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('validation.intechanges.pasos_inscripcions.show_fields')
                    <a href="{!! route('intervalidation.intechanges.validations.show',[$pasoInscripcion->inscripcion_id]) !!}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <a href="{!! route('intervalidation.intechanges.validations.edit',[$pasoInscripcion->inscripcion_id, $pasoInscripcion->id]) !!}" class='btn btn-success'><i class="glyphicon glyphicon-edit"></i> Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
