@extends('layouts.app')
@section('head_vars')

    <?php

    $nameMenu = ['interalliances' => 'InterAlliance','interchanges' => 'InterChange','interactions' => 'InterAction'];

    $route_sp = substr($route_split, 0,strpos($route_split, "."));

    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = $nameMenu[$route_sp]. " - Asignar validador";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    //$your_style = 'bootstrap-select.min.css,your_style.css';
    $your_style = 'your_style.css';

    $your_script = 'js/my_functions.js';
    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    
    $page_nav_route[ $nameMenu[$route_sp] ]["sub"][ "Assignments" ]["active"] = true;
    //$submenu2='';
    
    ?>

@endsection
@section('content')
    <section class="content-header">
        <h1>
            Asignar validador
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => $route_split.'.store']) !!}

                        @include('validation.assign.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
