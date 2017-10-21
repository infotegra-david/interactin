<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $archivo->id !!}</p>
</div>

<!-- Path Field -->
<div class="form-group">
    {!! Form::label('path', 'Path:') !!}
    <p>{!! $archivo->path !!}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Usuario Id:') !!}
    <p>{!! $archivo->user_id !!}</p>
</div>

<!-- Formato Id Field -->
<div class="form-group">
    {!! Form::label('formato_id', 'Formato Id:') !!}
    <p>{!! $archivo->formato_id !!}</p>
</div>

<!-- Tipo Archivo Id Field -->
<div class="form-group">
    {!! Form::label('tipo_archivo_id', 'Tipo Archivo Id:') !!}
    <p>{!! $archivo->tipo_archivo_id !!}</p>
</div>

<!-- Permisos Archivo Id Field -->
<div class="form-group">
    {!! Form::label('permisos_archivo_id', 'Permisos Archivo Id:') !!}
    <p>{!! $archivo->permisos_archivo_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $archivo->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $archivo->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $archivo->deleted_at !!}</p>
</div>

