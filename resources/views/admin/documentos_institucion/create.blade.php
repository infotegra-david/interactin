@extends('layouts.app')

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Crear Documento Institución";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    //$your_style = 'bootstrap-select.min.css,your_style.css';
    $your_style = 'your_style.css';

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $page_nav_route[ "InterAdmin" ]["sub"][ "InstitutionSettings" ]["sub"][ "InstitutionsSettings" ]["active"] = true;
    //$submenu2='';
    ?>

@endsection

@section('content')
    <section class="content-header">
        <h1>
            Documentos Institución
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.documentosInstitucion.store']) !!}

                        @include('admin.documentos_institucion.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
