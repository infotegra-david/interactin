@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Documentos Alianza
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($documentosAlianza, ['route' => ['documentosAlianzas.update', $documentosAlianza->id], 'method' => 'patch']) !!}

                        @include('documentos_alianzas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection