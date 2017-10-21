<table class="table table-responsive" id="modalidades-table">
    <thead>
        <th>Nombre</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($modalidades as $modalidades)
        <tr>
            <td>{!! $modalidades->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['modalidades.destroy', $modalidades->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('modalidades.show', [$modalidades->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('modalidades.edit', [$modalidades->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>