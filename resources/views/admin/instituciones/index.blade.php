@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('requires')

    <?php

    //require_once(base_path()."/resources/views/inc/...");
    
    ?>

@endsection

@section('styles')
    <style type="text/css">


    </style>

@endsection

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Instituciones";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    $your_style = 'bootstrap-select.min.css,your_style.css';
    //$your_style = 'bootstrap-select.min.css';
    

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $page_nav_route[ "InterAdmin" ]["sub"][ 'InstitutionSettings' ]["sub"][ 'InstitutionsSettings' ]["active"] = true;
    //$submenu2='';
    ?>

@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Instituciones</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.institutions.create') !!}">Agregar nueva</a>
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

