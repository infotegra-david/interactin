<table class="table table-responsive" id="plantillas-table">
    <thead>
        <th>Tipo Plantilla Id</th>
        <th>Descripcion</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($plantillas as $plantillas)
        <tr>
            <td>{!! $plantillas->tipo_plantilla_id !!}</td>
            <td>{!! $plantillas->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['plantillas.destroy', $plantillas->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('plantillas.show', [$plantillas->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('plantillas.edit', [$plantillas->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>