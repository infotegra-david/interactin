<!-- Usuario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    {!! Form::number('usuario_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', null, ['class' => 'form-control']) !!}
</div>

<!-- Periodo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('periodo_id', 'Periodo Id:') !!}
    {!! Form::number('periodo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Programa Origen Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programa_origen_id', 'Programa Origen Id:') !!}
    {!! Form::number('programa_origen_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Programa Destino Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programa_destino_id', 'Programa Destino Id:') !!}
    {!! Form::number('programa_destino_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Inicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
    {!! Form::date('fecha_inicio', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Fin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_fin', 'Fecha Fin:') !!}
    {!! Form::date('fecha_fin', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Hospedaje Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_hospedaje', 'Presupuesto Hospedaje:') !!}
    {!! Form::number('presupuesto_hospedaje', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Alimentacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_alimentacion', 'Presupuesto Alimentacion:') !!}
    {!! Form::number('presupuesto_alimentacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Transporte Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_transporte', 'Presupuesto Transporte:') !!}
    {!! Form::number('presupuesto_transporte', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Otros Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_otros', 'Presupuesto Otros:') !!}
    {!! Form::number('presupuesto_otros', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inscripcions.index') !!}" class="btn btn-default">Cancel</a>
</div>
