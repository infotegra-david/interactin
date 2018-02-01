
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Institucion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('institucion_id', 'Institucion:') !!}

    {!! Form::select('institucion_id', $institucion, old('institucion_id'), ['class' => 'form-control', 'placeholder' => 'Seleccione una institucion']) !!}
</div>

<!-- Telefono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Postal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo_postal', 'Codigo Postal:') !!}
    {!! Form::text('codigo_postal', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Ciudad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ciudad_id', 'Ciudad:') !!}
    {!! Form::select('ciudad_id', $ciudad, old('ciudad_id'), ['class' => 'form-control', 'placeholder' => 'Seleccione una institucion']) !!}
</div>

<!-- Principal Field -->
<div class="form-group col-sm-6"> 
    <div class="input-group full">
        {!! Form::label('principal', 'Sede principal:') !!}          
        <div class="form-control">
            <label class="checkbox-inline full">
                {!! Form::checkbox('principal', 1, null) !!} Si
            </label>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.campus.index') !!}" class="btn btn-default">Cancel</a>
</div>
