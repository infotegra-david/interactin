@extends('layouts.app')

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Editar Programa";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    //$your_style = 'bootstrap-select.min.css,your_style.css';
    $your_style = 'your_style.css';

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $page_nav_route[ "InterAdmin" ]["sub"][ "InstitutionSettings" ]["sub"][ "ProgramsSettings" ]["active"] = true;
    //$submenu2='';
    ?>

@endsection


@section('content')
    <section class="content-header">
        <h1>
            Programa
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($programa, ['route' => ['admin.programs.update', $programa->id], 'method' => 'patch']) !!}

                        @include('admin.programas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection