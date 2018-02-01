@extends('layouts.app')
@section('head_vars')

    <?php

    $nameMenu = ['interalliances' => 'InterAlliance','interchanges' => 'InterChange','interactions' => 'InterAction'];

    $route_sp = substr($route_split, 0,strpos($route_split, "."));

    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = $nameMenu[$route_sp]. " - Emails";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    //$your_style = 'bootstrap-select.min.css,your_style.css';
    $your_style = 'your_style.css';

    $your_script = 'js/my_functions.js';
    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    
    $page_nav_route[ $nameMenu[$route_sp] ]["sub"][ "Emails" ]["active"] = true;
    //$submenu2='';
    
    ?>

@endsection


@section('content')
    <section class="content-header">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Administración de emails</h1>
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
                        <a class="btn btn-primary form-control" style="margin-top: -10px;margin-bottom: 5px" href="{!! route($route_plantillas) !!}"><b>Plantillas:</b> Lista de formatos predefinidos</a>
                        <!-- @ include('validation.interchanges.table') -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group text-center full">
                        <a class="btn btn-primary form-control" style="margin-top: -10px;margin-bottom: 5px" href="{!! route($route_registros) !!}"><b>Registros:</b> Lista de emails creados</a>
                        <!-- @ include('validation.interchanges.table') -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

