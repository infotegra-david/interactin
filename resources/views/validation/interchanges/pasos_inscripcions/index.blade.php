@extends('layouts.app')
@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Lista de inscripciones";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    if( $peticion == "normal" ){
        $your_style = 'bootstrap-select.min.css,your_style.css';
    }elseif( $peticion == "limpio" ){
        $your_style = '';
    }

    //$your_style = 'bootstrap-select.min.css';
    

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $page_nav_route[ "InterChange" ]["active"] = true;

    // $menu="InterValidations";
    // $submenu1="InterChanges";
    // $submenu2='Create';
    ?>

@endsection
@section('content')
    <section class="content-header">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Lista de inscripciones</h1>
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

