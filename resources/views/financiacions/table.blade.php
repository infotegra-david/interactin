<table class="table table-responsive" id="financiacions-table">
    <thead>
        <th>Inscripcion Id</th>
        <th>Fuente Financiacion Id</th>
        <th>Monto</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($financiacions as $financiacion)
        <tr>
            <td>{!! $financiacion->inscripcion_id !!}</td>
            <td>{!! $financiacion->fuente_financiacion_id !!}</td>
            <td>{!! $financiacion->monto !!}</td>
            <td>
                {!! Form::open(['route' => ['financiacions.destroy', $financiacion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('financiacions.show', [$financiacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('financiacions.edit', [$financiacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>