@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Institucion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoInstitucion, ['route' => ['tipoInstitucions.update', $tipoInstitucion->id], 'method' => 'patch']) !!}

                        @include('tipo_institucions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection