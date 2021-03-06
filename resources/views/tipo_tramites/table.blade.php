<table class="table table-responsive" id="tipoTramites-table">
    <thead>
        <th>Nombre</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tipoTramites as $tipoTramite)
        <tr>
            <td>{!! $tipoTramite->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['tipoTramites.destroy', $tipoTramite->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tipoTramites.show', [$tipoTramite->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tipoTramites.edit', [$tipoTramite->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>