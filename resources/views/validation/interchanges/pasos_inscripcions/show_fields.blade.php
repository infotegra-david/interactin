<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pasosInscripcion->id !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Fecha de creación:') !!}
    <p>{!! $pasosInscripcion->created_at !!}</p>
</div>

<!-- Tipo Paso Id Field -->
<div class="form-group">
    {!! Form::label('tipo_paso_id', 'Tipo de Paso:') !!}
    <p>{!! $pasosInscripcion->tipo_paso_titulo !!}</p>
</div>

<!-- Estado Id Field -->
<div class="form-group">
    {!! Form::label('estado_id', 'Estado:') !!}
    <p>{!! $pasosInscripcion->estado_nombre !!}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('validador_id', 'Usuario:') !!}
    <p>{!! $pasosInscripcion->user_email !!} - {!! str_replace("_", " ", $pasosInscripcion->role_name) !!} {{ ($pasosInscripcion->titulo != '' ? '('.$pasosInscripcion->titulo.')' : '') }} </p>
</div>

<!-- Observacion Field -->
<div class="form-group">
    {!! Form::label('observacion', 'Observacion:') !!}
    <p>{!! $pasosInscripcion->observacion !!}</p>
</div>

<!-- Inscripcion Id Field -->
<div class="form-group">
    {!! Form::label('inscripcion_id', 'Inscripcion Id:') !!}
    <p>{!! $pasosInscripcion->inscripcion_id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Fecha de actualización:') !!}
    <p>{!! $pasosInscripcion->updated_at !!}</p>
</div>

