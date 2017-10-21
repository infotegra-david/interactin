<table class="table table-responsive" id="programas-table">
    <thead>
        <th>Nombre</th>
        <th>Facultad Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($programas as $programa)
        <tr>
            <td>{!! $programa->nombre !!}</td>
            <td>{!! $programa->facultad_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.programs.destroy', $programa->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.programs.show', [$programa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.programs.edit', [$programa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>