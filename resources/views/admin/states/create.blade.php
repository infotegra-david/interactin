@extends('layouts.app')

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Crear Departamento/Estado";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    //$your_style = 'bootstrap-select.min.css,your_style.css';
    $your_style = 'your_style.css';

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $page_nav_route[ "InterAdmin" ]["sub"][ "LocationSettings" ]["sub"][ "StatesSettings" ]["active"] = true;
    //$submenu2='';
    ?>

@endsection


@section('content')
<div id="departamento" class="contenido">

    <div class="contenedor">

        <div class="panel panel-default">

            <div class="panel-heading">
                Crear Nuevo Departamento
                <i id="buton_help" class="glyphicon glyphicon-info-sign" data-toggle="collapse" data-target="#collapseExample"></i>
            </div>
            <div class="panel-body">
                <div class="collapse" id="collapseExample">
                    <div class="help well">
                        <h5>¿Como crear un Departamento?</h5>
                       <ul>
                            <li>Seleccione el País al que pertenece el departamento desde el campo 'País'.</li>
                            <li>Diligencie el nombre del departamento en el campo 'Departamento'.</li>
                            <li>Diligencie el código de referencia con el cual reconocerá el departamento desde el campo 'Código Ref'.</li>
                            <li>De click en el botón “Guardar”.</li>
                            <a href="#">Para obetener una guia detallada de este formulario consulte el manual en este link</a>

                        </ul>     
                    </div>
                </div>

                @include('adminlte-templates::common.errors')

                <div class="row">
                    {!! Form::open(['route' => 'admin.states.store']) !!}

                        @include('admin.states.fields')

                    {!! Form::close() !!}
                </div>
                
             </div>
        </div>
    </div>

</div>

@endsection
