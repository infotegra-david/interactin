@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inscripción
        </h1>
   </section>
   <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inscripcion, ['route' => ['interchanges.validations_interchanges.update', $inscripcion->id], 'method' => 'patch']) !!}

                        @include('validation.interchanges.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection