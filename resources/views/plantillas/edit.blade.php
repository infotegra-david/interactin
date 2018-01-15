@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Plantillas
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($plantillas, ['route' => ['plantillas.update', $plantillas->id], 'method' => 'patch']) !!}

                        @include('plantillas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection