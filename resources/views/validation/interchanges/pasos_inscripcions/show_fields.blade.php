<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pasoInscripcion->id !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Fecha de creación:') !!}
    <p>{!! $pasoInscripcion->created_at !!}</p>
</div>

<!-- Tipo Paso Id Field -->
<div class="form-group">
    {!! Form::label('tipo_paso_id', 'Tipo de Paso:') !!}
    <p>{!! $pasoInscripcion->tipo_paso_titulo !!}</p>
</div>

<!-- Estado Id Field -->
<div class="form-group">
    {!! Form::label('estado_id', 'Estado:') !!}
    <p>{!! $pasoInscripcion->estado_nombre !!}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('validador_id', 'Usuario:') !!}
    <p>{!! $pasoInscripcion->user_email !!} - {!! str_replace("_", " ", $pasoInscripcion->role_name) !!} {{ ($pasoInscripcion->titulo != '' ? '('.$pasoInscripcion->titulo.')' : '') }} </p>
</div>

<!-- Observacion Field -->
<div class="form-group">
    {!! Form::label('observacion', 'Observacion:') !!}
    <p>{!! $pasoInscripcion->observacion !!}</p>
</div>

<!-- Inscripcion Id Field -->
<div class="form-group">
    {!! Form::label('inscripcion_id', 'Inscripcion Id:') !!}
    <p>{!! $pasoInscripcion->inscripcion_id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Fecha de actualización:') !!}
    <p>{!! $pasoInscripcion->updated_at !!}</p>
</div>

