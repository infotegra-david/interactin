<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Nativo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nativo', 'Nativo:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('nativo', false) !!}
        {!! Form::checkbox('nativo', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipoArchivos.index') !!}" class="btn btn-default">Cancel</a>
</div>
