@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Archivo
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('archivos.show_fields')
                    <a href="{!! route('archivos.index') !!}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    {!! Form::open(['route' => ['archivos.destroy', $archivo->id], 'method' => 'delete']) !!}
                
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
