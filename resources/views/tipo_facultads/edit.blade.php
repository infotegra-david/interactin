@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Facultad
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoFacultad, ['route' => ['tipoFacultads.update', $tipoFacultad->id], 'method' => 'patch']) !!}

                        @include('tipo_facultads.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection