@extends('layouts.app')

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Crear usuario";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    //$your_style = 'bootstrap-select.min.css,your_style.css';
    $your_style = 'your_style.css';

    $your_script = 'js/my_functions.js';
    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $page_nav_route[ "InterAdmin" ]["sub"][ "Users" ]["sub"][ "Crear" ]["active"] = true;
    //$submenu2='';
    ?>

@endsection


@section('content')
    
    @if ($ruta == 'admin')
        @php 
            $route = 'admin.users.store'; 
            $routeBack = 'admin.users.index'; 
            $include = 'admin.user._form';
        @endphp
    @else
        @php 
            $route = 'user.store';
            $routeBack = 'user.index'; 
            $include = 'admin.user.fields';
        @endphp
    @endif
    <div class="clearfix"></div>

        @include('flash::message')

    <div class="clearfix"></div>
    
    <div class="row">
        <div class="col-md-5">
            <h3>Create</h3>
        </div>
        <div class="col-md-7 page-action text-right">

            <a href="{{ route($routeBack) }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => [$route], 'id' => 'Form_create_user' ]) !!}
                @include($include)
                <!-- Submit Form Button -->
                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection