<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Clasificacion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clasificacion_id', 'Clasificacion Id:') !!}
    {!! Form::number('clasificacion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipoPlantillas.index') !!}" class="btn btn-default">Cancel</a>
</div>
