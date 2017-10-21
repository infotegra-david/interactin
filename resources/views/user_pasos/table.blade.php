<table class="table table-responsive" id="userPasos-table">
    <thead>
        <th>Tipo Paso Id</th>
        <th>User Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userPasos as $userPaso)
        <tr>
            <td>{!! $userPaso->tipo_paso_id !!}</td>
            <td>{!! $userPaso->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['userPasos.destroy', $userPaso->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userPasos.show', [$userPaso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userPasos.edit', [$userPaso->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>