@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pasos Iniciativa
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pasosIniciativa, ['route' => ['validation.pasosIniciativas.update', $pasosIniciativa->id], 'method' => 'patch']) !!}

                        @include('validation.pasos_iniciativas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection