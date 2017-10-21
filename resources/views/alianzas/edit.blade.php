@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Alianza
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($alianza, ['route' => ['alianzas.update', $alianza->id], 'method' => 'patch']) !!}

                        @include('alianzas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection