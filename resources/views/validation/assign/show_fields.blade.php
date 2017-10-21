
<!-- Tipo Paso Id Field -->
<div class="form-group">
    {!! Form::label('tipo_paso_id', 'Tipo de paso:') !!}
    <p>{!! $userPaso->tipo_paso !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Validador:') !!}
    <p>{!! $userPaso->user !!}</p>
</div>

<!-- orden Field -->
<div class="form-group">
    {!! Form::label('orden', 'Orden:') !!}
    <p>{!! $userPaso->orden !!}</p>
</div>

<!-- titulo Field -->
<div class="form-group">
    {!! Form::label('titulo', 'Título:') !!}
    <p>{!! $userPaso->titulo !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{!! $userPaso->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{!! $userPaso->updated_at !!}</p>
</div>

