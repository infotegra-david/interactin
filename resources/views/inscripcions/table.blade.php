<table class="table table-responsive" id="inscripcions-table">
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
    @foreach($inscripcions as $inscripcion)
        <tr>
            <td>{!! $inscripcion->usuario_id !!}</td>
            <td>{!! $inscripcion->fecha !!}</td>
            <td>{!! $inscripcion->periodo_id !!}</td>
            <td>{!! $inscripcion->programa_origen_id !!}</td>
            <td>{!! $inscripcion->programa_destino_id !!}</td>
            <td>{!! $inscripcion->fecha_inicio !!}</td>
            <td>{!! $inscripcion->fecha_fin !!}</td>
            <td>{!! $inscripcion->presupuesto_hospedaje !!}</td>
            <td>{!! $inscripcion->presupuesto_alimentacion !!}</td>
            <td>{!! $inscripcion->presupuesto_transporte !!}</td>
            <td>{!! $inscripcion->presupuesto_otros !!}</td>
            <td>
                {!! Form::open(['route' => ['inscripcions.destroy', $inscripcion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('inscripcions.show', [$inscripcion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('inscripcions.edit', [$inscripcion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>