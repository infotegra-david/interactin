@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Alianza
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoAlianza, ['route' => ['tipoAlianzas.update', $tipoAlianza->id], 'method' => 'patch']) !!}

                        @include('tipo_alianzas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection