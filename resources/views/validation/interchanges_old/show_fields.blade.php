@include('InterChange.show_fields')
<hr>
<a class="btn btn-primary pull-right" href="{!! route('interchanges.validations_interchanges.create',$inscripcionId) !!}">Agregar validación</a>
@if(isset($GenerarDocumento) && $GenerarDocumento == true )
    <a class="btn btn-success pull-right" href="{!! route('interchanges.validations_interchanges.pdf',$inscripcionId) !!}">Generar Documento</a>
@endif
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
                <th class="">Creación</th>
                <th class="">Actualización</th>
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
                    <a href="{!! route('interchanges.validations_interchanges.edit', [$pasoInscripcion->inscripcion_id, $pasoInscripcion->id]) !!}" title="Editar" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </td>
              </tr>
        @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center">
        {!! $pasosInscripcion->links() !!}
    </div>  
</div>  


@endif