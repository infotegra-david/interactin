<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $interChange->id !!}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    <p>{!! $interChange->usuario_id !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! $interChange->fecha !!}</p>
</div>

<!-- Periodo Id Field -->
<div class="form-group">
    {!! Form::label('periodo_id', 'Periodo Id:') !!}
    <p>{!! $interChange->periodo_id !!}</p>
</div>

<!-- Programa Origen Id Field -->
<div class="form-group">
    {!! Form::label('programa_origen_id', 'Programa Origen Id:') !!}
    <p>{!! $interChange->programa_origen_id !!}</p>
</div>

<!-- Programa Destino Id Field -->
<div class="form-group">
    {!! Form::label('programa_destino_id', 'Programa Destino Id:') !!}
    <p>{!! $interChange->programa_destino_id !!}</p>
</div>

<!-- Fecha Inicio Field -->
<div class="form-group">
    {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
    <p>{!! $interChange->fecha_inicio !!}</p>
</div>

<!-- Fecha Fin Field -->
<div class="form-group">
    {!! Form::label('fecha_fin', 'Fecha Fin:') !!}
    <p>{!! $interChange->fecha_fin !!}</p>
</div>

<!-- Presupuesto Hospedaje Field -->
<div class="form-group">
    {!! Form::label('presupuesto_hospedaje', 'Presupuesto Hospedaje:') !!}
    <p>{!! $interChange->presupuesto_hospedaje !!}</p>
</div>

<!-- Presupuesto Alimentacion Field -->
<div class="form-group">
    {!! Form::label('presupuesto_alimentacion', 'Presupuesto Alimentacion:') !!}
    <p>{!! $interChange->presupuesto_alimentacion !!}</p>
</div>

<!-- Presupuesto Transporte Field -->
<div class="form-group">
    {!! Form::label('presupuesto_transporte', 'Presupuesto Transporte:') !!}
    <p>{!! $interChange->presupuesto_transporte !!}</p>
</div>

<!-- Presupuesto Otros Field -->
<div class="form-group">
    {!! Form::label('presupuesto_otros', 'Presupuesto Otros:') !!}
    <p>{!! $interChange->presupuesto_otros !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $interChange->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $interChange->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $interChange->deleted_at !!}</p>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('intervalidation.interchanges.validations.index') !!}" class="btn btn-default">Cancel</a>
</div>
