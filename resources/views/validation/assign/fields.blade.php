
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('campus_id', 'Campus:') !!}
    {{ Form::select('campus_id', $campus->prepend('Seleccione el campus', ''), old('campus_id'), ['class' => 'form-control input-md', 'target' => '', 'url' => '' ]) }}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Validador:') !!}
    {{ Form::select('user_id', $user->prepend('Seleccione el validador', ''), old('user_id'), ['class' => 'form-control input-md', 'target' => '', 'url' => '' ]) }}
</div>

<!-- Tipo Paso Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_paso_id', 'Paso del proceso:') !!}
    {{ Form::select('tipo_paso_id', $tipo_paso->prepend('Seleccione el paso del proceso', ''), old('tipo_paso_id'), ['class' => 'form-control input-md', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el tipo de paso' ]) }}
</div>


<!-- orden Field -->
<div class="form-group col-sm-6">
    {!! Form::label('orden', 'orden:') !!}
    {!! Form::number('orden', null, ['class' => 'form-control input-md', 'min' => '1']) !!}
</div>

<!-- titulo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Título:') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control input-md']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route($route_split.'.index') !!}" class="btn btn-default">Cancelar</a>
</div>
