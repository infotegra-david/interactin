@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Alianza Modalidad
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($alianzaModalidad, ['route' => ['alianzaModalidads.update', $alianzaModalidad->id], 'method' => 'patch']) !!}

                        @include('alianza_modalidads.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection