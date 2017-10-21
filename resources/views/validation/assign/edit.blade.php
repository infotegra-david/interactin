@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Asignar validador
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userPaso, ['route' => ['intervalidation.assignments.update', $userPaso->id], 'method' => 'patch']) !!}

                        @include('validation.assign.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection