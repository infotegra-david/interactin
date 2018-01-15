<!-- Oportunidad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('oportunidad_id', 'Oportunidad Id:') !!}
    {!! Form::number('oportunidad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Titulo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Titulo:') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Objetivo Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('objetivo', 'Objetivo:') !!}
    {!! Form::textarea('objetivo', null, ['class' => 'form-control']) !!}
</div>

<!-- Integracion Agenda Origen Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('integracion_agenda_origen', 'Integracion Agenda Origen:') !!}
    {!! Form::textarea('integracion_agenda_origen', null, ['class' => 'form-control']) !!}
</div>

<!-- Responsabilidades Origen Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('responsabilidades_origen', 'Responsabilidades Origen:') !!}
    {!! Form::textarea('responsabilidades_origen', null, ['class' => 'form-control']) !!}
</div>

<!-- Beneficios Origen Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('beneficios_origen', 'Beneficios Origen:') !!}
    {!! Form::textarea('beneficios_origen', null, ['class' => 'form-control']) !!}
</div>

<!-- Recursos Origen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recursos_origen', 'Recursos Origen:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('recursos_origen', false) !!}
        {!! Form::checkbox('recursos_origen', '1', null) !!} 1
    </label>
</div>

<!-- Presupuesto Costo Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_costo_total', 'Presupuesto Costo Total:') !!}
    {!! Form::number('presupuesto_costo_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Otros Actores Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_otros_actores', 'Presupuesto Otros Actores:') !!}
    {!! Form::number('presupuesto_otros_actores', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Total Origen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_total_origen', 'Presupuesto Total Origen:') !!}
    {!! Form::number('presupuesto_total_origen', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Financieros Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_financieros', 'Presupuesto Financieros:') !!}
    {!! Form::number('presupuesto_financieros', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Personal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_personal', 'Presupuesto Personal:') !!}
    {!! Form::number('presupuesto_personal', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Infraestructura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_infraestructura', 'Presupuesto Infraestructura:') !!}
    {!! Form::number('presupuesto_infraestructura', null, ['class' => 'form-control']) !!}
</div>

<!-- Presupuesto Otro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presupuesto_otro', 'Presupuesto Otro:') !!}
    {!! Form::number('presupuesto_otro', null, ['class' => 'form-control']) !!}
</div>

<!-- Instrumentos Monitoreo Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('instrumentos_monitoreo', 'Instrumentos Monitoreo:') !!}
    {!! Form::textarea('instrumentos_monitoreo', null, ['class' => 'form-control']) !!}
</div>

<!-- Firma Rectoria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('firma_rectoria', 'Firma Rectoria:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('firma_rectoria', false) !!}
        {!! Form::checkbox('firma_rectoria', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('iniciativas.index') !!}" class="btn btn-default">Cancel</a>
</div>
