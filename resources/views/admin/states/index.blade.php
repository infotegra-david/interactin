@extends('layouts.app')

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Departamentos/Estados";

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

    <div class="contenedor index">

    	<div class="panel panel-default">
    		<div class="panel-heading">
                Departamentos
                <i id="buton_help" class="glyphicon glyphicon-info-sign" data-toggle="collapse" data-target="#collapseExample"></i>
            </div>

            <div class="panel-body">

                <div class="collapse" id="collapseExample">
                    <div class="help well">
                        <h5>¿Como consultar un Departamento?</h5>
                        <ul>
                            <li>Diligencie los campos de texto con el nombre del País y Departamento.</li>
                            <li>De click en el botón “Filtrar”.</li>
                        </ul>     
                        <h5>Aquí usted puede:</h5>
                        <p><i class="fa fa-plus-square"></i> Crear un Departamento</p>
                        <p><i class="fa fa-eye"></i> Visualizar un Departamento</p>
                        <br>
                        <a href="#">Ingrese al manual de usuario Módulo Localización</a>
                    </div>
                </div>

                <div class="clearfix"></div>

                @include('flash::message')

                <div class="clearfix"></div>

                <div class="icon_add">
            		<a class="fa fa-plus-square" href="{!! route('admin.states.create') !!}"> Agregar nueva</a>
        		</div>

		        @include('admin.states.table')

		    </div>
	     </div>
     </div>
</div>          
@endsection
