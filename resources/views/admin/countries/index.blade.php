@extends('layouts.app')

@section('content')
<div id="pais" class="contenido">

    <div class="contenedor index">

    	<div class="panel panel-default">
    		<div class="panel-heading">
                Países
                <i id="buton_help" class="glyphicon glyphicon-info-sign" data-toggle="collapse" data-target="#collapseExample"></i>
            </div>

            <div class="panel-body">

                <div class="collapse" id="collapseExample">
                    <div class="help well">
                        <h5>¿Como consultar un País?</h5>
                       <ul>
                            <li>Diligencie el campo de texto con el nombre del País.</li>
                            <li>De click en el botón “Filtrar”.</li>
                        </ul>     
                        <h5>Aquí usted puede:</h5>
                        <p><i class="fa fa-plus-square"></i> Crear un País</p>
                        <p><i class="fa fa-eye"></i> Visualizar un País</p>
                        <br>
                        <a href="#">Ingrese al manual de usuario Módulo Localización</a>
                    </div>
                </div>

             	<div class="clearfix"></div>

	        	@include('flash::message')

		        <div class="clearfix"></div>

		        <div class="icon_add">
            		<a class="fa fa-plus-square" href="{!! route('admin.countries.create') !!}"> Agregar nuevo</a>
        		</div>

		        @include('admin.countries.table')

	        </div>
	     </div>
     </div>
</div>        
@endsection
