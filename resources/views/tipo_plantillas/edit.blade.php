@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Plantilla
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoPlantilla, ['route' => ['tipoPlantillas.update', $tipoPlantilla->id], 'method' => 'patch']) !!}

                        @include('tipo_plantillas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection