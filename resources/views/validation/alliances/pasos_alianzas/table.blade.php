<table class="table table-responsive" id="pasosAlianzas-table">
    <thead>
        <th>Alianza</th>
        <th>Fecha de creación</th>
        <th>Fecha de actualización</th>
        <th>Estado</th>
        <th>No. registros</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($pasosAlianzas as $pasosAlianza)
        <tr>
            <td>{!! $pasosAlianza->alianza_id !!}</td>
            <td>{!! $pasosAlianza->alianza_created_at !!}</td>
            <td>{!! $pasosAlianza->alianza_updated_at !!}</td>
            <td>{!! ($pasosAlianza->alianza_estado == 1 ? 'ACTIVA' : 'INACTIVA') !!}</td>
            <td>{!! $pasosAlianza->conteo_pasos !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('intervalidation.interalliances.validations.show', [$pasosAlianza->alianza_id]) !!}" class='btn btn-default btn-xs' title='Ver registro'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $pasosAlianzas->render() !!}