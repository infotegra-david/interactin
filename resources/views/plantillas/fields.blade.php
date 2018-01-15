<!-- Tipo Plantilla Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_plantilla_id', 'Tipo Plantilla Id:') !!}
    {!! Form::number('tipo_plantilla_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-6">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Campus Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('campus_id', 'Campus Id:') !!}
    {!! Form::number('campus_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('plantillas.index') !!}" class="btn btn-default">Cancel</a>
</div>
