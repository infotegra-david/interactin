<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Desde Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_desde', 'Fecha Desde:') !!}
    {!! Form::date('fecha_desde', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Hasta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_hasta', 'Fecha Hasta:') !!}
    {!! Form::date('fecha_hasta', null, ['class' => 'form-control']) !!}
</div>

<!-- Vigente Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vigente', 'Vigente:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('vigente', false) !!}
        {!! Form::checkbox('vigente', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('periodos.index') !!}" class="btn btn-default">Cancel</a>
</div>
