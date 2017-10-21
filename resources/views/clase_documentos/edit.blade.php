@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Clase Documento
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($claseDocumento, ['route' => ['claseDocumentos.update', $claseDocumento->id], 'method' => 'patch']) !!}

                        @include('clase_documentos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection