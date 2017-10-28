@extends('layouts.app')

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Vista de validaciónes de la alianza";

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
    $menu="InterValidations";
    $submenu1="InterAlliances";
    $submenu2='Show';
    ?>

@endsection
@section('content')
    <section class="content-header">
        <h1>
            Validación - Alianza #{{ $pasoAlianza->alianza_id }}, vista del registro 
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('validation.alliances.pasos_alianzas.show_fields')
                    <a href="{!! route('intervalidation.interalliances.validations.show',[$pasoAlianza->alianza_id]) !!}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    @if($editar == true)
                        <a href="{!! route('intervalidation.interalliances.validations.edit',[$pasoAlianza->alianza_id, $pasoAlianza->id]) !!}" class='btn btn-success'><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
