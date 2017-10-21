<!-- Alianza Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alianza_id', 'Alianza Id:') !!}
    {!! Form::number('alianza_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Modalidad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('modalidad_id', 'Modalidad Id:') !!}
    {!! Form::number('modalidad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('alianzaModalidads.index') !!}" class="btn btn-default">Cancel</a>
</div>
