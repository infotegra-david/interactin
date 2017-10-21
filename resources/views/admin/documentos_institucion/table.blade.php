<table class="table table-responsive" id="documentosInstitucions-table">
    <thead>
        <th>Institucion Id</th>
        <th>Archivo Id</th>
        <th>Tipo Documento Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($documentosInstitucions as $documentosInstitucion)
        <tr>
            <td>{!! $documentosInstitucion->institucion_id !!}</td>
            <td>{!! $documentosInstitucion->archivo_id !!}</td>
            <td>{!! $documentosInstitucion->tipo_documento_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.documentosInstitucion.destroy', $documentosInstitucion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.documentosInstitucion.show', [$documentosInstitucion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.documentosInstitucion.edit', [$documentosInstitucion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>