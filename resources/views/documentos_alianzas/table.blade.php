<table class="table table-responsive" id="documentosAlianzas-table">
    <thead>
        <th>Alianza Id</th>
        <th>Archivo Id</th>
        <th>Tipo Documento Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($documentosAlianzas as $documentosAlianza)
        <tr>
            <td>{!! $documentosAlianza->alianza_id !!}</td>
            <td>{!! $documentosAlianza->archivo_id !!}</td>
            <td>{!! $documentosAlianza->tipo_documento_id !!}</td>
            <td>
                {!! Form::open(['route' => ['documentosAlianzas.destroy', $documentosAlianza->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('documentosAlianzas.show', [$documentosAlianza->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('documentosAlianzas.edit', [$documentosAlianza->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>