@extends('layouts.app')

@section('content')

<div id="ciudad" class="contenido">

    <div class="contenedor show">

    	<div class="panel panel-default">	
	     	<div class="panel-heading">
                <i id="buton_help" class="glyphicon glyphicon-info-sign" data-toggle="collapse" data-target="#collapseExample"></i>
            </div>
          	<div class="panel-body">

			 	<div class="collapse" id="collapseExample">
                    <div class="help well">
                        <h5>¿Como eliminar una Ciudad?</h5>
                        <ul>
                            <li>De click en el botón “Eliminar”.</li>
                            <li>En el mensaje de confirmación de click en “Aceptar”.</li>
                        </ul>     
                        <h5>Aquí usted puede:</h5>
                        <p><i class="glyphicon glyphicon-edit"></i> Editar una Ciudad</p>
                        <p><i class="glyphicon glyphicon-chevron-left"></i> Retroceder</p>
                        <br>
                        <a href="#">Ingrese al manual de usuario Módulo Localización</a>
                    </div>
                </div>

				@include('flash::message')

    			@include('admin.cities.show_fields')

			    <div class="field button">
			           <a href="{!! route('admin.cities.index') !!}" class="btn btn-default glyphicon glyphicon-chevron-left">Atrás</a>
			    </div>

			</div>
		</div>
	</div>

</div>
@endsection
