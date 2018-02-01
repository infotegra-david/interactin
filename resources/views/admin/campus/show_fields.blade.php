<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{!! $campus->nombre !!}</p>
</div>

<!-- Institucion Id Field -->
<div class="form-group">
    {!! Form::label('institucion_id', 'Institucion:') !!}
    <p>{!! $institucion->nombre !!}</p>
</div>

<!-- Telefono Field -->
<div class="form-group">
    {!! Form::label('telefono', 'Telefono:') !!}
    <p>{!! $campus->telefono !!}</p>
</div>

<!-- Direccion Field -->
<div class="form-group">
    {!! Form::label('direccion', 'Direccion:') !!}
    <p>{!! $campus->direccion !!}</p>
</div>

<!-- Codigo Postal Field -->
<div class="form-group">
    {!! Form::label('codigo_postal', 'Codigo Postal:') !!}
    <p>{!! $campus->codigo_postal !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $campus->email !!}</p>
</div>

<!-- Ciudad Id Field -->
<div class="form-group">
    {!! Form::label('ciudad_id', 'Ciudad:') !!}
    <p>{!! $ciudad->nombre !!}</p>
</div>

<!-- Ciudad Id Field -->
<div class="form-group">
    {!! Form::label('principal', 'Sede principal:') !!}
    <p>{!! ($campus->principal==1 ? 'Si' : 'No') !!}</p>
</div>



