@if(isset($tipo_paso_id) && isset($estado_id) && isset($user_id) )

    <hr>
    
    <h4>Para registrar o editar su validación escoja el estado y redacte sus observaciones.</h4>
    <br>
    <!-- Tipo Paso Id Field -->
    @if(count($tipo_paso_id) > 1)
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list-ol fa-md fa-fw"></i></span>
                    {{ Form::select('tipo_paso_id', $tipo_paso_id, old('tipo_paso_id'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione el paso a validar']) }}
                </div>
            </div>
        </div>
    @else
        {{ Form::hidden('tipo_paso_id', key($tipo_paso_id->toArray()) ) }}
    @endif

    <!-- Estado Id Field -->

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-gavel fa-md fa-fw"></i></span>
                {{ Form::select('estado_id', $estado_id->prepend('Seleccione el estado de la validación', ''), old('estado_id'), ['class' => 'form-control input-md']) }}
            </div>
        </div>
    </div>


    <!-- Validador Id Field -->
    @if(count($tipo_paso_id) > 1)
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-circle fa-md fa-fw"></i></span>
                    {{ Form::select('user_id', $user_id, old('user_id'), ['class' => 'form-control input-md', 'placeholder' => 'Seleccione al validador']) }}
                </div>
            </div>
        </div>
    @else
        {{ Form::hidden('user_id', key($user_id) ) }}
    @endif

    <!-- Observacion Field -->

    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-paragraph fa-md fa-fw"></i></span>
                {{ Form::textarea('observacion', old('observacion'), ['class' => 'form-control input-md', 'rows' => '3', 'placeholder' => 'Redacte su observación de la validación']) }}
            </div>
        </div>
    </div>
    <!-- Alianza Id Field -->
    {!! Form::hidden('alianza_id', ($alianza_id ?? $pasoAlianza->alianza_id) ) !!}
    {!! Form::hidden('paso_alianza_id', ($paso_alianza_id ?? 0) ) !!}

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        <a href="{!! route('interalliances.index') !!}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
    </div>


@endif