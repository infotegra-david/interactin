@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Tramite
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoTramite, ['route' => ['tipoTramites.update', $tipoTramite->id], 'method' => 'patch']) !!}

                        @include('tipo_tramites.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection