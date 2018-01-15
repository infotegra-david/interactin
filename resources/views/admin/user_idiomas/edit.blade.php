@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Idiomas del usuario
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($UserIdiomas, ['route' => ['admin.UserIdiomas.update', $UserIdiomas->id], 'method' => 'patch']) !!}

                        @include('admin.user_idiomas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection