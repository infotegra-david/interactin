<table class="table table-responsive" id="documentosInscripcion-table">
    <thead>
        <th>Inscripcion Id</th>
        <th>Archivo Id</th>
        <th>Tipo Documento Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($documentosInscripcion as $documentosInscripcion)
        <tr>
            <td>{!! $documentosInscripcion->inscripcion_id !!}</td>
            <td>{!! $documentosInscripcion->archivo_id !!}</td>
            <td>{!! $documentosInscripcion->tipo_documento_id !!}</td>
            <td>
                {!! Form::open(['route' => ['documentosInscripcion.destroy', $documentosInscripcion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('documentosInscripcion.show', [$documentosInscripcion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('documentosInscripcion.edit', [$documentosInscripcion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>