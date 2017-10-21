<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $periodo->id !!}</p>
</div>

<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{!! $periodo->nombre !!}</p>
</div>

<!-- Fecha Desde Field -->
<div class="form-group">
    {!! Form::label('fecha_desde', 'Fecha Desde:') !!}
    <p>{!! $periodo->fecha_desde !!}</p>
</div>

<!-- Fecha Hasta Field -->
<div class="form-group">
    {!! Form::label('fecha_hasta', 'Fecha Hasta:') !!}
    <p>{!! $periodo->fecha_hasta !!}</p>
</div>

<!-- Vigente Field -->
<div class="form-group">
    {!! Form::label('vigente', 'Vigente:') !!}
    <p>{!! $periodo->vigente !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $periodo->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $periodo->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $periodo->deleted_at !!}</p>
</div>

