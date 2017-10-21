<table class="table table-responsive" id="pasosIniciativas-table">
    <thead>
        <th>Tipo Paso Id</th>
        <th>Estado Id</th>
        <th>User Id</th>
        <th>Observacion</th>
        <th>Iniciativa Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($pasosIniciativas as $pasosIniciativa)
        <tr>
            <td>{!! $pasosIniciativa->tipo_paso_id !!}</td>
            <td>{!! $pasosIniciativa->estado_id !!}</td>
            <td>{!! $pasosIniciativa->user_id !!}</td>
            <td>{!! $pasosIniciativa->observacion !!}</td>
            <td>{!! $pasosIniciativa->iniciativa_id !!}</td>
            <td>
                {!! Form::open(['route' => ['validation.pasosIniciativas.destroy', $pasosIniciativa->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('validation.pasosIniciativas.show', [$pasosIniciativa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('validation.pasosIniciativas.edit', [$pasosIniciativa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>