<!-- Usuario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    {!! Form::number('usuario_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Objetivo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('objetivo', 'Objetivo:') !!}
    {!! Form::text('objetivo', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Tramite Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_tramite_id', 'Tipo Tramite Id:') !!}
    {!! Form::number('tipo_tramite_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Duracion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duracion', 'Duracion:') !!}
    {!! Form::text('duracion', null, ['class' => 'form-control']) !!}
</div>

<!-- Responsable Arl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsable_arl', 'Responsable Arl:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('responsable_arl', false) !!}
        {!! Form::checkbox('responsable_arl', '1', null) !!} 1
    </label>
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('estado', false) !!}
        {!! Form::checkbox('estado', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('alianzas.index') !!}" class="btn btn-default">Cancel</a>
</div>
