@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Institucions</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.institutions.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        
        <div id="flash-msg">
            @include('flash::message')
            @include('adminlte-templates::common.errors')
        </div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.instituciones.table')
            </div>
        </div>
    </div>
@endsection

