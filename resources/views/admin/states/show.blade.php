@extends('layouts.app')

@section('content')
<div id="departamento" class="contenido">

	<div class="contenedor show">

		<div class="panel panel-default">	
	     	<div class="panel-heading">
                <i id="buton_help" class="glyphicon glyphicon-info-sign" data-toggle="collapse" data-target="#collapseExample"></i>
            </div>
            <div class="panel-body">

            	<div class="collapse" id="collapseExample">
                    <div class="help well">
                        <h5>¿Como eliminar un Departamento?</h5>
                        <ul>
                            <li>De click en el botón “Eliminar”.</li>
                            <li>En el mensaje de confirmación de click en “Aceptar”.</li>
                        </ul>     
                        <h5>Aquí usted puede:</h5>
                        <p><i class="glyphicon glyphicon-edit"></i> Editar un Departamento</p>
                        <p><i class="glyphicon glyphicon-chevron-left"></i> Retroceder</p>
                        <br>
                        <a href="#">Ingrese al manual de usuario Módulo Localización</a>
                    </div>
                </div>

				@include('flash::message')
	
    			@include('admin.states.show_fields')

			    <div class="field button">
			           <a href="{!! route('admin.states.index') !!}" class="btn btn-default glyphicon glyphicon-chevron-left">Atrás</a>
			    </div>
			
			 </div>
		</div>
	</div>

</div>
@endsection
