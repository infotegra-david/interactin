<!-- Usuario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    {!! Form::number('usuario_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Programa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programa_id', 'Programa Id:') !!}
    {!! Form::number('programa_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('matriculas.index') !!}" class="btn btn-default">Cancel</a>
</div>
