<table class="table table-responsive" id="facultads-table">
    <thead>
        <th>Nombre</th>
        <th>Campus Id</th>
        <th>Tipo Facultad Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($facultads as $facultad)
        <tr>
            <td>{!! $facultad->nombre !!}</td>
            <td>{!! $facultad->campus_id !!}</td>
            <td>{!! $facultad->tipo_facultad_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.faculties.destroy', $facultad->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.faculties.show', [$facultad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.faculties.edit', [$facultad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>