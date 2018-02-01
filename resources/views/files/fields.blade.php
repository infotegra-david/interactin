{!! Form::model($documento, ['route' => $ruta_guardar, 'method' => 'POST', 'id' => 'EditarDocumento', 'novalidate', 'class' => 'skip_style', 'results' => 'EditarDocumento_results', 'files' => true]) !!}
	
	@if(isset($editar['nombre']))
		<div class="col-sm-12">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-paragraph fa-md fa-fw"></i><strong>Nombre del documento:</strong></span>
					{{ Form::text('nombre', old('nombre'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el nombre del documento']) }}
				</div>
			</div>
		</div>
	@else
		{{ Form::hidden('nombre', $documento['nombre']) }}
	@endif

	@if(isset($editar['tipo_documento']))
		<div class="col-sm-12">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-file-text fa-md fa-fw"></i> <strong>Tipo de documento:</strong></span>
					{{ Form::select('tipo_documento', $tipo_documento, old('tipo_documento'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione el tipo de documento']) }}
				</div>
			</div>
		</div>
	@else
		{{ Form::hidden('tipo_documento', $documento['tipo_documento']) }}
	@endif
	
	@if( !in_array($documento['formato'], ['html','htm']) )
		<div class="col-sm-12 archivo_input">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-upload fa-md fa-fw"></i> <strong>Archivo:</strong></span>
					{{ Form::file('archivo_input', ['class' => 'form-control input-md', 'placeholder' => 'Cargue el archivo', 'accept' => '.pdf, .jpg, .jpeg, .png']) }}
				</div>
			</div>
		</div>
	@endif
	
	{{ Form::hidden('archivo_contenido', '') }}
	
	<div class="col-sm-12 editor_documento hide">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-file-word-o fa-md fa-fw"></i> <strong>Contenido del documento:</strong></span>
			</div>
		</div>
	</div>

	{{ Form::hidden('archivo_id', $documento['id']) }}

	<div class="col-sm-12 text-left">
		<div class="form-group">
			<footer>
				
				{!! Form::button('<i class="fa fa-arrow-left"></i> <strong>Atras</strong>', ['type' => 'button', 'class' => 'btn btn-md btn-default text-black', 'name' => 'btn-back', 'id' => 'btn-back', 'url' => $route_back ]) !!}

				{!! Form::button('<i class="fa fa-external-link"></i> <strong>Guardar</strong>', ['type' => 'button', 'class' => 'btn btn-md btn-success text-black', 'name' => 'guardar_documento', 'id' => 'guardar_documento', 'form_target' => '#EditarDocumento' ]) !!}
			</footer>
		</div>
	</div>
{!! Form::close() !!}

<script type="text/javascript">

	$(document).ready(function() {
		// With Callback
		$("#btn-back").click(function(e) {
			var thisUrl = $(this).attr('url');
			$.SmartMessageBox({
				title : "Advertencia!",
				content : "Si no guarda los cambios se perderan, seguro que quiere salir del editor?",
				buttons : '[No][Si]'
			}, function(ButtonPressed) {
				if (ButtonPressed === "Si") {
					window.location.href = thisUrl;
					
				}
				if (ButtonPressed === "No") {
					
				}

			});
			e.preventDefault();
		})
		
	});
	
</script>
