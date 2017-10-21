@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Matricula
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($matricula, ['route' => ['matriculas.update', $matricula->id], 'method' => 'patch']) !!}

                        @include('matriculas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection