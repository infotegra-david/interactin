<table class="table table-responsive" id="campuses-table">
    <thead>
        <th>Nombre</th>
        <th>Institucion Id</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Codigo Postal</th>
        <th>Email</th>
        <th>Ciudad Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($campuses as $campus)
        <tr>
            <td>{!! $campus->nombre !!}</td>
            <td>{!! $campus->institucion_id !!}</td>
            <td>{!! $campus->telefono !!}</td>
            <td>{!! $campus->direccion !!}</td>
            <td>{!! $campus->codigo_postal !!}</td>
            <td>{!! $campus->email !!}</td>
            <td>{!! $campus->ciudad_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.campus.destroy', $campus->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.campus.show', [$campus->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.campus.edit', [$campus->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>