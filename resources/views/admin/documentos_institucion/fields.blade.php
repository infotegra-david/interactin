<!-- Institucion Id Field -->

<div class="col-sm-6">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-university fa-md fa-fw"></i></span>
    		{{ Form::select('institucion_id', ( $instituciones ?? array() ), old('instituciones'), ['class' => 'form-control input-md', 'target' => 'tipo_documento_id', 'url' => '', 'placeholder' => 'Seleccione la institución'  ]) }}
		</div>
	</div>
</div>

<!-- Tipo Documento Id Field -->

<div class="col-sm-6">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-id-card fa-md fa-fw"></i></span>
		    {!! Form::label('tipo_documento_id', 'Tipo Documento Id:') !!}
		    {{ Form::select('tipo_documento_id', ( $tipo_documento ?? array() ), old('tipo_documento'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de documento'  ]) }}
		</div>
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-file-pdf-o fa-md fa-fw"></i></span>
			{{ Form::file('archivo_documentos', ['class' => 'form-control input-md', 'placeholder' => 'Cargue el archivo', 'rel' => 'tooltip', 'data-original-title' => 'Cargue el archivo', 'data-placement' => 'top' ]) }}
		</div>
	</div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.documentosInstitucion.index') !!}" class="btn btn-default">Cancel</a>
</div>
