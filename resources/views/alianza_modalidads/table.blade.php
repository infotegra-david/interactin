<table class="table table-responsive" id="alianzaModalidads-table">
    <thead>
        <th>Alianza Id</th>
        <th>Modalidad Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($alianzaModalidads as $alianzaModalidad)
        <tr>
            <td>{!! $alianzaModalidad->alianza_id !!}</td>
            <td>{!! $alianzaModalidad->modalidad_id !!}</td>
            <td>
                {!! Form::open(['route' => ['alianzaModalidads.destroy', $alianzaModalidad->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('alianzaModalidads.show', [$alianzaModalidad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('alianzaModalidads.edit', [$alianzaModalidad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>