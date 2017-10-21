@extends('layouts.app')

@section('content')
<div id="ciudad" class="contenido">

    <div class="contenedor index">

    	<div class="panel panel-default">
    		<div class="panel-heading">
                Ciudad
                <i id="buton_help" class="glyphicon glyphicon-info-sign" data-toggle="collapse" data-target="#collapseExample"></i>
            </div>

            <div class="panel-body">

                <div class="collapse" id="collapseExample">
                    <div class="help well">
                        <h5>¿Como consultar una Ciudad?</h5>
                        <ul>
                            <li>Diligencie los campos de texto con el nombre del País, Departamento y Ciudad.</li>
                            <li>De click en el botón “Filtrar”.</li>
                        </ul>     
                        <h5>Aquí usted puede:</h5>
                        <p><i class="fa fa-plus-square"></i> Crear una Ciudad</p>
                        <p><i class="fa fa-eye"></i> Visualizar una Ciudad</p>
                        <br>
                        <a href="#">Ingrese al manual de usuario Módulo Localización</a>
                    </div>
                </div>

                <div class="clearfix"></div>

        		@include('flash::message')

        		<div class="clearfix"></div>

        		<div class="icon_add">
            		<a class="fa fa-plus-square" href="{!! route('admin.cities.create') !!}"> Agregar nueva</a>
        		</div>
        		
        		@include('admin.cities.table')

        	 </div>
	     </div>
     </div>
</div>        
@endsection
