<table class="table table-responsive" id="interChanges-table">
    <thead>
        <th>Usuario Id</th>
        <th>Fecha</th>
        <th>Periodo Id</th>
        <th>Programa Origen Id</th>
        <th>Programa Destino Id</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Presupuesto Hospedaje</th>
        <th>Presupuesto Alimentacion</th>
        <th>Presupuesto Transporte</th>
        <th>Presupuesto Otros</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($interChanges as $interChange)
        <tr>
            <td>{!! $interChange->user_id !!}</td>
            <td>{!! $interChange->fecha !!}</td>
            <td>{!! $interChange->periodo_id !!}</td>
            <td>{!! $interChange->programa_origen_id !!}</td>
            <td>{!! $interChange->programa_destino_id !!}</td>
            <td>{!! $interChange->fecha_inicio !!}</td>
            <td>{!! $interChange->fecha_fin !!}</td>
            <td>{!! $interChange->presupuesto_hospedaje !!}</td>
            <td>{!! $interChange->presupuesto_alimentacion !!}</td>
            <td>{!! $interChange->presupuesto_transporte !!}</td>
            <td>{!! $interChange->presupuesto_otros !!}</td>
            <td>
                {!! Form::open(['route' => ['interChanges.destroy', $interChange->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('interChanges.show', [$interChange->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('interChanges.edit', [$interChange->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>