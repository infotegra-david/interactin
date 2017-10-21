<!-- Ajuste Field -->
<div class="form-group col-sm-6 select" id="crear">
	{!! Form::label('País', 'País') !!}
    {!! Form::select('pais_id', $countries, null, ['class' => 'form-control ', 'placeholder' => 'Seleccione  el país']) !!}
</div>
<div class="clearfix"></div>
<!-- Nombre Field -->
<div class="form-group col-sm-6 textbox" id="crear">
    {!! Form::label('nombre', 'Departamento') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control text-uppercase']) !!}
</div>

<!-- Codigo Ref Field -->
<div class="form-group col-sm-6 textbox" id="crear">
    {!! Form::label('codigo_ref', 'Codigo Ref') !!}
    {!! Form::text('codigo_ref', null, ['class' => 'form-control text-uppercase']) !!}
</div>

<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-6button" id="save">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>

<div class="form-group col-sm-6button">
	<a href="{!! route('admin.states.index') !!}" class="btn btn-default">Cancelar</a>
</div>
