<div class="{{ ( $peticion == 'normal' ? 'hide' : '') }}" id="datos_validacion_inscripcion">
    @include('InterChange.show_fields')
</div>
@if(isset($GenerarDocumento) && $GenerarDocumento == true && $editar_validacion == true)
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
                    <a href="{!! route('interchanges.validations_interchanges.print',$inscripcionId) !!}?pre_forma={{ $pre_forma['id'] }}">{{ $pre_forma['nombre'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="row col-sm-12">
    @if ( $editar_validacion == true )
        {!! Form::open(['route' => ['interchanges.validations_interchanges.store',$inscripcionId], 'files' => true]) !!}

            @include('validation.interchanges.pasos_inscripcions.fields')

        {!! Form::close() !!}
    @endIF
</div>
<hr>

@if(isset($pasosInscripcion))
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
                <th class="">Fecha de creación</th>
                <th class="">Fecha de actualización</th>
                <th class="">Acciones</th>
              </tr>
            </thead>
            <tbody>
        @foreach($pasosInscripcion as $key => $pasoInscripcion)
              <tr>
                <td class="">{!! $pasoInscripcion->tipo_paso_titulo !!}</td>
                <td class="">{!! $pasoInscripcion->estado_nombre !!}</td>
                <td class="">{!! $pasoInscripcion->user_email !!} - {!! str_replace("_", " ", $pasoInscripcion->role_name) !!} {{ ($pasoInscripcion->titulo != '' ? '('.$pasoInscripcion->titulo.')' : '') }}</td>
                <td class="">{!! $pasoInscripcion->observacion !!}</td>
                <td class="">{!! $pasoInscripcion->created_at !!}</td>
                <td class="">{!! $pasoInscripcion->updated_at !!}</td>
                <td class="">
                    <a href="{!! route('interchanges.validations_interchanges.show', [$pasoInscripcion->inscripcion_id, $pasoInscripcion->id]) !!}" title="Ver" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @if($user_actual == $pasoInscripcion->user_id && $editar_validacion == true)
                    <a href="{!! route('interchanges.validations_interchanges.edit', [$pasoInscripcion->inscripcion_id, $pasoInscripcion->id]) !!}" title="Editar" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    @endif
                </td>
              </tr>
        @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        {{-- $pasosInscripcion->links() --}}
    </div>
</div>  
@endif