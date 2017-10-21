<!-- Nombres Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombres', 'Nombres:') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control']) !!}
</div>

<!-- Apellidos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('apellidos', 'Apellidos:') !!}
    {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
</div>

<!-- Ciudad Residencia Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ciudad_residencia_id', 'Ciudad Residencia Id:') !!}
    {!! Form::number('ciudad_residencia_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Personal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_personal', 'Email Personal:') !!}
    {!! Form::text('email_personal', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div>

<!-- Celular Field -->
<div class="form-group col-sm-6">
    {!! Form::label('celular', 'Celular:') !!}
    {!! Form::text('celular', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Postal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo_postal', 'Codigo Postal:') !!}
    {!! Form::text('codigo_postal', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Identificacion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_documento_id', 'Tipo Documento Id:') !!}
    {!! Form::number('tipo_documento_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Numero Identificacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_documento', 'Numero documento:') !!}
    {!! Form::text('numero_documento', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Expedicion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_expedicion', 'Fecha Expedicion:') !!}
    {!! Form::date('fecha_expedicion', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Vencimiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vencimiento', 'Fecha Vencimiento:') !!}
    {!! Form::date('fecha_vencimiento', null, ['class' => 'form-control']) !!}
</div>

<!-- Lugar Expedicion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lugar_expedicion_id', 'Lugar Expedicion Id:') !!}
    {!! Form::number('lugar_expedicion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Nacionalidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nacionalidad', 'Nacionalidad:') !!}
    {!! Form::number('nacionalidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Nro Pasaporte Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nro_pasaporte', 'Nro Pasaporte:') !!}
    {!! Form::text('nro_pasaporte', null, ['class' => 'form-control']) !!}
</div>

<!-- Porcentaje Aprobado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('porcentaje_aprobado', 'Porcentaje Aprobado:') !!}
    {!! Form::number('porcentaje_aprobado', null, ['class' => 'form-control']) !!}
</div>

<!-- Promedio Acumulado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('promedio_acumulado', 'Promedio Acumulado:') !!}
    {!! Form::number('promedio_acumulado', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Institucion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo_institucion', 'Codigo Institucion:') !!}
    {!! Form::text('codigo_institucion', null, ['class' => 'form-control']) !!}
</div>

<!-- Cargo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cargo', 'Cargo:') !!}
    {!! Form::text('cargo', null, ['class' => 'form-control']) !!}
</div>

<!-- facultad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facultad_id', 'Facultad Id:') !!}
    {!! Form::number('facultad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('datosPersonales.index') !!}" class="btn btn-default">Cancel</a>
</div>
