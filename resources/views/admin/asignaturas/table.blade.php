<table class="table table-responsive" id="asignaturas-table">
    <thead>
        <th>Nombre</th>
        <th>Codigo</th>
        <th>Nro Creditos</th>
        <th>Programa Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($asignaturas as $asignatura)
        <tr>
            <td>{!! $asignatura->nombre !!}</td>
            <td>{!! $asignatura->codigo !!}</td>
            <td>{!! $asignatura->nro_creditos !!}</td>
            <td>{!! $asignatura->programa_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.subjects.destroy', $asignatura->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.subjects.show', [$asignatura->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.subjects.edit', [$asignatura->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>