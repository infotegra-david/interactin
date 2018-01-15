<table class="table table-responsive" id="fuenteFinanciacions-table">
    <thead>
        <th>Nombre</th>
        <th>Tipo</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($fuenteFinanciacions as $fuenteFinanciacion)
        <tr>
            <td>{!! $fuenteFinanciacion->nombre !!}</td>
            <td>{!! $fuenteFinanciacion->tipo !!}</td>
            <td>
                {!! Form::open(['route' => ['fuenteFinanciacions.destroy', $fuenteFinanciacion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('fuenteFinanciacions.show', [$fuenteFinanciacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('fuenteFinanciacions.edit', [$fuenteFinanciacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>