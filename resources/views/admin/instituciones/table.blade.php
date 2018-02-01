<table class="table table-responsive" id="institucions-table">
    <thead>
        <th>Nombre</th>
        <th>Email</th>
        <th>Tipo Institucion Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($instituciones as $institucion)
        <tr>
            <td>{!! $institucion['nombre'] !!}</td>
            <td>{!! $institucion['email'] !!}</td>
            <td>{!! $institucion['tipo_institucion']['nombre'] !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.institutions.destroy', $institucion['id']], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.institutions.show', $institucion['id']) !!}" title='Ver' class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                    <a href="{!! route('admin.institutions.edit', $institucion['id']) !!}" title='Editar' class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    <a href="{!! route('admin.institutions.documents', $institucion['id']) !!}" title='Lista de documentos' class='btn btn-default btn-xs'><i class="glyphicon glyphicon-list-alt"></i> Documentos</a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>