<table class="table table-responsive" id="clasificacion-table">
    <thead>
        <th>Nombre</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($clasificaciones as $clasificacion)
        <tr>
            <td>{!! $clasificacion->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['clasificacion.destroy', $clasificacion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('clasificacion.show', [$clasificacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('clasificacion.edit', [$clasificacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>