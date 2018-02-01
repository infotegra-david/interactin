<!-- Asignatura Origen Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('asignatura_origen_id', 'Asignatura Origen Id:') !!}
    {!! Form::number('asignatura_origen_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Asignatura Destino Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('asignatura_destino_id', 'Asignatura Destino Id:') !!}
    {!! Form::number('asignatura_destino_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.equivalentes.index') !!}" class="btn btn-default">Cancel</a>
</div>
