<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Institucion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_institucion_id', 'Tipo Institucion:') !!}
    {!! Form::select('tipo_institucion_id', $tipo_institucion, old('tipo_institucion_id'), ['class' => 'form-control', 'placeholder' => 'Seleccione un tipo de institución']) !!}

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.institutions.index') !!}" class="btn btn-default">Cancel</a>
</div>
