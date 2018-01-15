<table class="table table-responsive" id="inscripciones-table">
    <thead>
        <th>Usuario Id</th>
        <th>Objetivo</th>
        <th>Tipo Tramite Id</th>
        <th>Duracion</th>
        <th>Responsable Arl</th>
        <th>Estado</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($inscripciones as $inscripcion)
        <tr>
            <td>{!! $inscripcion->usuario_id !!}</td>
            <td>{!! $inscripcion->objetivo !!}</td>
            <td>{!! $inscripcion->tipo_tramite_id !!}</td>
            <td>{!! $inscripcion->duracion !!}</td>
            <td>{!! $inscripcion->responsable_arl !!}</td>
            <td>{!! $inscripcion->estado !!}</td>
            <td>
                {!! Form::open(['route' => ['interchanges.validations_interchanges.destroy', $inscripcion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('interchanges.validations_interchanges.show', [$inscripcion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('interchanges.validations_interchanges.edit', [$inscripcion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>