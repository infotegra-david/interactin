<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
</div>

<!-- Nro Creditos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nro_creditos', 'Nro Creditos:') !!}
    {!! Form::number('nro_creditos', null, ['class' => 'form-control']) !!}
</div>

<!-- Programa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programa_id', 'Programa Id:') !!}
    {!! Form::number('programa_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.subjects.index') !!}" class="btn btn-default">Cancel</a>
</div>
