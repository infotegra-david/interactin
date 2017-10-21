<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Clase Documento Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clase_documento_id', 'Clase Documento Id:') !!}
    {!! Form::number('clase_documento_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipoDocumentos.index') !!}" class="btn btn-default">Cancel</a>
</div>
