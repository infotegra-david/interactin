@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Parentesco
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($parentesco, ['route' => ['parentescos.update', $parentesco->id], 'method' => 'patch']) !!}

                        @include('parentescos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection