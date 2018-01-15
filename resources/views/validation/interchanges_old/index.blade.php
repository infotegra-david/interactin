@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Validación de las inscripciones</h1>
            </div>
        </div>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group text-center full">
                        <a class="btn btn-primary form-control" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('interchanges.interout.index') !!}"><b>InterOut:</b> Lista de movilidad saliente</a>
                        <!-- @ include('validation.interchanges.table') -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group text-center full">
                        <a class="btn btn-primary form-control" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('interchanges.interin.index') !!}"><b>InterIn:</b> Lista de movilidad entrante</a>
                        <!-- @ include('validation.interchanges.table') -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

