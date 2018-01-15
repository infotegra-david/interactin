<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('campus_nombre', 'Campus:', ['class' => 'text-bold']) !!}
    <span>{!! $userPaso->campus_nombre !!}</span>
</div>


<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Validador:', ['class' => 'text-bold']) !!}
    <span>{!! $userPaso->user !!}</span>
</div>

<!-- Tipo Paso Id Field -->
<div class="form-group">
    {!! Form::label('tipo_paso_id', 'Paso del proceso:', ['class' => 'text-bold']) !!}
    <span>{!! $userPaso->tipo_paso !!}</span>
</div>

<!-- orden Field -->
<div class="form-group">
    {!! Form::label('orden', 'Orden:', ['class' => 'text-bold']) !!}
    <span>{!! $userPaso->orden !!}</span>
</div>

<!-- titulo Field -->
<div class="form-group">
    {!! Form::label('titulo', 'Título:', ['class' => 'text-bold']) !!}
    <span>{!! $userPaso->titulo !!}</span>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado:', ['class' => 'text-bold']) !!}
    <span>{!! $userPaso->created_at !!}</span>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado:', ['class' => 'text-bold']) !!}
    <span>{!! $userPaso->updated_at !!}</span>
</div>

