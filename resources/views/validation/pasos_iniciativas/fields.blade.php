<!-- Tipo Paso Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_paso_id', 'Tipo Paso Id:') !!}
    {!! Form::number('tipo_paso_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Observacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observacion', 'Observacion:') !!}
    {!! Form::text('observacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Iniciativa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iniciativa_id', 'Iniciativa Id:') !!}
    {!! Form::number('iniciativa_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('validation.pasosIniciativas.index') !!}" class="btn btn-default">Cancel</a>
</div>
