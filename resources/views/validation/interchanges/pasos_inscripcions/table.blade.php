<table class="table table-responsive" id="pasosInscripcions-table">
    <thead>
        <th>Inscripcion</th>
        <th>Fecha de creación</th>
        <th>Fecha de actualización</th>
        <th>Estado</th>
        <th>No. registros</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($pasosInscripcions as $pasosInscripcion)
        <tr>
            <td>{!! $pasosInscripcion->inscripcion_id !!}</td>
            <td>{!! $pasosInscripcion->inscripcion_created_at !!}</td>
            <td>{!! $pasosInscripcion->inscripcion_updated_at !!}</td>
            <td>{!! ($pasosInscripcion->inscripcion_estado == 1 ? 'ACTIVA' : 'INACTIVA') !!}</td>
            <td>{!! $pasosInscripcion->conteo_pasos !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('interchanges.validations_interchanges.show', [$pasosInscripcion->inscripcion_id]) !!}" class='btn btn-default btn-xs' title='Ver registro'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $pasosInscripcions->render() !!}