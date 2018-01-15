<table class="table table-responsive" id="tipoPasos-table">
    <thead>
        <th>Nombre</th>
        <th>Titulo</th>
        <th>Seccion</th>
        <th>Reglas</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tipoPasos as $tipoPaso)
        <tr>
            <td>{!! $tipoPaso->nombre !!}</td>
            <td>{!! $tipoPaso->titulo !!}</td>
            <td>{!! $tipoPaso->seccion !!}</td>
            <td>{!! $tipoPaso->reglas !!}</td>
            <td>
                {!! Form::open(['route' => ['tipoPasos.destroy', $tipoPaso->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tipoPasos.show', [$tipoPaso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tipoPasos.edit', [$tipoPaso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>