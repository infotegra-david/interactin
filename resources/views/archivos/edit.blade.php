@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Archivo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($archivo, ['route' => ['archivos.update', $archivo->id], 'method' => 'patch']) !!}

                        @include('archivos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection