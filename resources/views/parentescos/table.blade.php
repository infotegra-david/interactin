<table class="table table-responsive" id="parentescos-table">
    <thead>
        <th>Nombre</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($parentescos as $parentesco)
        <tr>
            <td>{!! $parentesco->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['parentescos.destroy', $parentesco->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('parentescos.show', [$parentesco->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('parentescos.edit', [$parentesco->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>