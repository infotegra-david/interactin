<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pasoAlianza->id !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Fecha de creación:') !!}
    <p>{!! $pasoAlianza->created_at !!}</p>
</div>

<!-- Tipo Paso Id Field -->
<div class="form-group">
    {!! Form::label('tipo_paso_id', 'Tipo de Paso:') !!}
    <p>{!! $pasoAlianza->tipo_paso_titulo !!}</p>
</div>

<!-- Estado Id Field -->
<div class="form-group">
    {!! Form::label('estado_id', 'Estado:') !!}
    <p>{!! $pasoAlianza->estado_nombre !!}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('validador_id', 'Usuario:') !!}
    <p>{!! $pasoAlianza->user_email !!} - {!! str_replace("_", " ", $pasoAlianza->role_name) !!} {{ ($pasoAlianza->titulo != '' ? '('.$pasoAlianza->titulo.')' : '') }} </p>
</div>

<!-- Observacion Field -->
<div class="form-group">
    {!! Form::label('observacion', 'Observacion:') !!}
    <p>{!! $pasoAlianza->observacion !!}</p>
</div>

<!-- Alianza Id Field -->
<div class="form-group">
    {!! Form::label('alianza_id', 'Alianza Id:') !!}
    <p>{!! $pasoAlianza->alianza_id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Fecha de actualización:') !!}
    <p>{!! $pasoAlianza->updated_at !!}</p>
</div>

