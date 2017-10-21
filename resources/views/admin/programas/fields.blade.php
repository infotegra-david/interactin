<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Facultad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facultad_id', 'Facultad Id:') !!}
    {!! Form::number('facultad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.programs.index') !!}" class="btn btn-default">Cancel</a>
</div>
