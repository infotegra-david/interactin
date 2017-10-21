<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Campus Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('campus_id', 'Campus Id:') !!}
    {!! Form::number('campus_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Facultad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_facultad_id', 'Tipo Facultad Id:') !!}
    {!! Form::number('tipo_facultad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.faculties.index') !!}" class="btn btn-default">Cancel</a>
</div>
