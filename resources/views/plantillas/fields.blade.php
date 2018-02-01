


{!! Form::model($plantilla, ['route' => $ruta_guardar, 'method' => 'POST', 'id' => 'EditarPlantilla', 'novalidate', 'class' => 'skip_style', 'results' => 'EditarPlantilla_results', 'files' => true]) !!}
    

    @if(isset($editar['tipo_plantilla']))
        <div class="col-sm-12">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text fa-md fa-fw"></i> <strong>Tipo de plantilla:</strong></span>
                    {{ Form::select('tipo_plantilla_id', $tipo_plantilla, old('tipo_plantilla_id'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione el tipo de plantilla']) }}
                </div>
            </div>
        </div>
    @else
        {{ Form::hidden('tipo_plantilla', $plantilla['tipo_plantilla']) }}
    @endif

    @if(isset($editar['descripcion']))
        <div class="col-sm-12">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-paragraph fa-md fa-fw"></i><strong>Descripción de la plantilla:</strong></span>
                    {{ Form::textarea('descripcion', old('descripcion'), ['class' => 'form-control input-md', 'rows' => '3', 'placeholder' => 'Ingrese la descripción de la plantilla']) }}
                </div>
            </div>
        </div>
    @else
        {{ Form::hidden('descripcion', $plantilla['descripcion']) }}
    @endif
    
    
    @if(isset($editar['asunto']))
        <div class="col-sm-12">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-paragraph fa-md fa-fw"></i><strong>Asunto del email:</strong></span>
                    {{ Form::text('asunto', old('asunto'), ['class' => 'form-control input-md', 'placeholder' => 'Ingrese el asunto de la plantilla']) }}
                </div>
            </div>
        </div>
    @else
        {{ Form::hidden('asunto', $plantilla['asunto']) }}
    @endif
    
    {{ Form::hidden('plantilla_contenido', '') }}
    
    <div class="col-sm-12 editor_plantilla">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-word-o fa-md fa-fw"></i> <strong>Contenido de la plantilla:</strong></span>
            </div>
        </div>
    </div>

    {{ Form::hidden('plantilla_id', $plantilla['id']) }}

    <div class="col-sm-12 text-left">
        <div class="form-group">
            <footer>
                
                {!! Form::button('<i class="fa fa-arrow-left"></i> <strong>Atras</strong>', ['type' => 'button', 'class' => 'btn btn-md btn-default text-black', 'name' => 'btn-back', 'id' => 'btn-back', 'url' => '{{ $route_back }}' ]) !!}

                {!! Form::button('<i class="fa fa-external-link"></i> <strong>Guardar</strong>', ['type' => 'button', 'class' => 'btn btn-md btn-success text-black', 'name' => 'guardar_plantilla', 'id' => 'guardar_plantilla', 'form_target' => '#EditarPlantilla' ]) !!}
            </footer>
        </div>
    </div>
{!! Form::close() !!}

<script type="text/javascript">

    $(document).ready(function() {
        // With Callback
        $("#btn-back").click(function(e) {
            $.SmartMessageBox({
                title : "Advertencia!",
                content : "Si no guarda los cambios se perderan, seguro que quiere salir del editor?",
                buttons : '[No][Si]'
            }, function(ButtonPressed) {
                if (ButtonPressed === "Si") {
                    window.location.href = $(this).attr('url');
                    
                }
                if (ButtonPressed === "No") {
                    
                }

            });
            e.preventDefault();
        })
        
    });
    
</script>

