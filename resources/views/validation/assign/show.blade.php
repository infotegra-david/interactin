@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Validador asignado
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('validation.assign.show_fields')
                    <a href="{!! route('intervalidation.assignments.index') !!}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    {!! Form::open(['route' => ['intervalidation.assignments.destroy', $userPaso->id], 'method' => 'delete']) !!}
                
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Esta seguro que desea eliminar el registro?')"]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
