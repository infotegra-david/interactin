@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Paso
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userPaso, ['route' => ['userPasos.update', $userPaso->id], 'method' => 'patch']) !!}

                        @include('user_pasos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection