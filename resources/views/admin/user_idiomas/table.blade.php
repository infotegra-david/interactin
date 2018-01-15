<table class="table table-responsive" id="UserIdiomas-table">
    <thead>
        <th>User Id</th>
        <th>Tipo Idioma Id</th>
        <th>Certificado</th>
        <th>Nombre Examen</th>
        <th>Nivel Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($UserIdiomas as $UserIdiomas)
        <tr>
            <td>{!! $UserIdiomas->user_id !!}</td>
            <td>{!! $UserIdiomas->tipo_idioma_id !!}</td>
            <td>{!! $UserIdiomas->certificado !!}</td>
            <td>{!! $UserIdiomas->nombre_examen !!}</td>
            <td>{!! $UserIdiomas->nivel_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.UserIdiomas.destroy', $UserIdiomas->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.UserIdiomas.show', [$UserIdiomas->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.UserIdiomas.edit', [$UserIdiomas->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>