<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Idioma Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_idioma_id', 'Tipo Idioma Id:') !!}
    {!! Form::number('tipo_idioma_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Certificado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('certificado', 'Certificado:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('certificado', false) !!}
        {!! Form::checkbox('certificado', '1', null) !!} 1
    </label>
</div>

<!-- Nombre Examen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_examen', 'Nombre Examen:') !!}
    {!! Form::text('nombre_examen', null, ['class' => 'form-control']) !!}
</div>

<!-- Nivel Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nivel_id', 'Nivel Id:') !!}
    {!! Form::number('nivel_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.UserIdiomas.index') !!}" class="btn btn-default">Cancel</a>
</div>
