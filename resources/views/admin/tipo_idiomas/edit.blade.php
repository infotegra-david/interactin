@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Idioma
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoIdioma, ['route' => ['admin.tipoIdiomas.update', $tipoIdioma->id], 'method' => 'patch']) !!}

                        @include('admin.tipo_idiomas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection