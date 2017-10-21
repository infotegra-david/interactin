<table class="table table-responsive" id="userPasos-table">
    <thead>
        <th>Tipo de paso</th>
        <th>Validador</th>
        <th>Orden</th>
        <th>Título</th>
        <th colspan="3">Acción</th>
    </thead>
    <tbody>
    @foreach($userPasos as $userPaso)
        <tr>
            <td>{!! $userPaso->tipo_paso !!}</td>
            <td>{!! $userPaso->user !!}</td>
            <td>{!! $userPaso->orden !!}</td>
            <td>{!! $userPaso->titulo !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('intervalidation.assignments.show', [$userPaso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('intervalidation.assignments.edit', [$userPaso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>