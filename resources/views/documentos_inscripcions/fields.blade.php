<!-- Inscripcion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inscripcion_id', 'Inscripcion Id:') !!}
    {!! Form::number('inscripcion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Archivo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('archivo_id', 'Archivo Id:') !!}
    {!! Form::number('archivo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Documento Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_documento_id', 'Tipo Documento Id:') !!}
    {!! Form::number('tipo_documento_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('documentosInscripcion.index') !!}" class="btn btn-default">Cancel</a>
</div>
