<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $aplicaciones->id !!}</p>
</div>

<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{!! $aplicaciones->nombre !!}</p>
</div>

<!-- Tipo Alianza Id Field -->
<div class="form-group">
    {!! Form::label('tipo_alianza_id', 'Tipo Alianza Id:') !!}
    <p>{!! $aplicaciones->tipo_alianza_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $aplicaciones->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $aplicaciones->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $aplicaciones->deleted_at !!}</p>
</div>

