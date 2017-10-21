<!-- Nombre Field -->
<div class="form-group col-sm-6 textbox">
    {!! Form::label('país', 'País') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control text-uppercase']) !!}
</div>

<!-- Codigo Ref Field -->
<div class="form-group col-sm-6 textbox">
    {!! Form::label('codigo_ref', 'Codigo Ref') !!}
    {!! Form::text('codigo_ref', null, ['class' => 'form-control text-uppercase']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-6button" id="save">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>

<div class="form-group col-sm-6button">
    <a href="{!! route('admin.countries.index') !!}" class="btn btn-default">Cancelar</a>
</div>
