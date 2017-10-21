@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Campus
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($campus, ['route' => ['admin.campus.update', $campus->id], 'method' => 'patch']) !!}

                        @include('admin.campus.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection