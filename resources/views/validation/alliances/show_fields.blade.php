<div class="{{ ( $peticion == 'normal' ? 'hide' : '') }}" id="datos_validacion_alianza">
    @include('InterAlliance.show_fields')
</div>
@if(isset($GenerarDocumento) && $GenerarDocumento == true )
<hr>
<div class="row col-sm-12">
    <h4>Es necesario que primero imprima alguna pre-forma para ser firmada por las personas correspondientes.</h4>
    <br>
    <div class="btn-group ">
        <button class="btn dropdown-toggle btn-success " data-toggle="dropdown">
            Imprimir pre-forma <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            @foreach( $pre_formas as $pre_forma )
                <li>
                    <a href="{!! route('intervalidation.interalliances.validations.print',$alianzaId) !!}?pre_forma={{ $pre_forma['id'] }}">{{ $pre_forma['nombre'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="row col-sm-12">
   {!! Form::open(['route' => ['intervalidation.interalliances.validations.store',$alianzaId], 'files' => true]) !!}

        @include('validation.alliances.pasos_alianzas.fields')

   {!! Form::close() !!}
</div>
<hr>

@if(isset($pasosAlianza))
<div class="row col-sm-12">
    <h3>Registros/Validación de los pasos</h3>
    <br>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
              <tr>
                <th class="">Paso</th>
                <th class="">Estado</th>
                <th class="">Usuario</th>
                <th class="">Observación</th>
                <th class="">Creación</th>
                <th class="">Actualización</th>
                <th class="">Acciones</th>
              </tr>
            </thead>
            <tbody>
        @foreach($pasosAlianza as $key => $pasoAlianza)
              <tr>
                <td class="">{!! $pasoAlianza->tipo_paso_titulo !!}</td>
                <td class="">{!! $pasoAlianza->estado_nombre !!}</td>
                <td class="">{!! $pasoAlianza->user_email !!} - {!! str_replace("_", " ", $pasoAlianza->role_name) !!} {{ ($pasoAlianza->titulo != '' ? '('.$pasoAlianza->titulo.')' : '') }}</td>
                <td class="">{!! $pasoAlianza->observacion !!}</td>
                <td class="">{!! $pasoAlianza->created_at !!}</td>
                <td class="">{!! $pasoAlianza->updated_at !!}</td>
                <td class="">
                    <a href="{!! route('intervalidation.interalliances.validations.show', [$pasoAlianza->alianza_id, $pasoAlianza->id]) !!}" title="Ver" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('intervalidation.interalliances.validations.edit', [$pasoAlianza->alianza_id, $pasoAlianza->id]) !!}" title="Editar" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </td>
              </tr>
        @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        {!! $pasosAlianza->links() !!}
    </div>
</div>  
@endif