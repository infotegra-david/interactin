<table class="table table-responsive" id="aplicaciones-table">
    <thead>
        <th>Nombre</th>
        <th>Tipo Alianza Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($aplicaciones as $aplicaciones)
        <tr>
            <td>{!! $aplicaciones->nombre !!}</td>
            <td>{!! $aplicaciones->tipo_alianza_id !!}</td>
            <td>
                {!! Form::open(['route' => ['aplicaciones.destroy', $aplicaciones->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('aplicaciones.show', [$aplicaciones->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('aplicaciones.edit', [$aplicaciones->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>