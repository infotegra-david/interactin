@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Paso
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoPaso, ['route' => ['tipoPasos.update', $tipoPaso->id], 'method' => 'patch']) !!}

                        @include('tipo_pasos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection