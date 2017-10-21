<!-- Path Field -->
<div class="form-group col-sm-6">
    {!! Form::label('path', 'Path:') !!}
    {!! Form::text('path', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Usuario Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Formato Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('formato_id', 'Formato Id:') !!}
    {!! Form::number('formato_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Archivo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_archivo_id', 'Tipo Archivo Id:') !!}
    {!! Form::number('tipo_archivo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Permisos Archivo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permisos_archivo_id', 'Permisos Archivo Id:') !!}
    {!! Form::number('permisos_archivo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('archivos.index') !!}" class="btn btn-default">Cancel</a>
</div>
