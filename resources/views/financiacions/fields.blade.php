<!-- Inscripcion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inscripcion_id', 'Inscripcion Id:') !!}
    {!! Form::number('inscripcion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fuente Financiacion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fuente_financiacion_id', 'Fuente Financiacion Id:') !!}
    {!! Form::number('fuente_financiacion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('financiacions.index') !!}" class="btn btn-default">Cancel</a>
</div>
