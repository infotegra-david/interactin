@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Aplicaciones
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($aplicaciones, ['route' => ['aplicaciones.update', $aplicaciones->id], 'method' => 'patch']) !!}

                        @include('aplicaciones.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection