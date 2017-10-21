<table class="table table-responsive" id="claseDocumentos-table">
    <thead>
        <th>Nombre</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($claseDocumentos as $claseDocumento)
        <tr>
            <td>{!! $claseDocumento->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['claseDocumentos.destroy', $claseDocumento->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('claseDocumentos.show', [$claseDocumento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('claseDocumentos.edit', [$claseDocumento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>