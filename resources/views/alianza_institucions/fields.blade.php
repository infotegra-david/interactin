<!-- Alianza Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alianza_id', 'Alianza Id:') !!}
    {!! Form::number('alianza_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Institucion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('institucion_id', 'Institucion Id:') !!}
    {!! Form::number('institucion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('alianzaInstitucions.index') !!}" class="btn btn-default">Cancel</a>
</div>
