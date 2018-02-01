<table class="table table-responsive" id="equivalentes-table">
    <thead>
        <th>Asignatura Origen Id</th>
        <th>Asignatura Destino Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($equivalentes as $equivalentes)
        <tr>
            <td>{!! $equivalentes->asignatura_origen_id !!}</td>
            <td>{!! $equivalentes->asignatura_destino_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.equivalentes.destroy', $equivalentes->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.equivalentes.show', [$equivalentes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.equivalentes.edit', [$equivalentes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>