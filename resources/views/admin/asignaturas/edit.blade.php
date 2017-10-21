@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Asignatura
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($asignatura, ['route' => ['admin.subjects.update', $asignatura->id], 'method' => 'patch']) !!}

                        @include('admin.asignaturas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection