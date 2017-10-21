<table class="table table-responsive" id="tipoDocumentos-table">
    <thead>
        <th>Nombre</th>
        <th>Clase Documento Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tipoDocumentos as $tipoDocumento)
        <tr>
            <td>{!! $tipoDocumento->nombre !!}</td>
            <td>{!! $tipoDocumento->clase_documento_id !!}</td>
            <td>
                {!! Form::open(['route' => ['tipoDocumentos.destroy', $tipoDocumento->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tipoDocumentos.show', [$tipoDocumento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tipoDocumentos.edit', [$tipoDocumento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>