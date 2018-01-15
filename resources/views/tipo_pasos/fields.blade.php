<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Titulo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Titulo:') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Seccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seccion', 'Seccion:') !!}
    {!! Form::text('seccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Reglas Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('reglas', 'Reglas:') !!}
    {!! Form::textarea('reglas', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipoPasos.index') !!}" class="btn btn-default">Cancel</a>
</div>
