@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Financiacion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($financiacion, ['route' => ['financiacions.update', $financiacion->id], 'method' => 'patch']) !!}

                        @include('financiacions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection