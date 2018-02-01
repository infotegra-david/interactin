<table class="table table-responsive" id="tipoPlantillas-table">
    <thead>
        <th>Nombre</th>
        <th>Clasificacion Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tipoPlantillas as $tipoPlantilla)
        <tr>
            <td>{!! $tipoPlantilla->nombre !!}</td>
            <td>{!! $tipoPlantilla->clasificacion_id !!}</td>
            <td>
                {!! Form::open(['route' => ['tipoPlantillas.destroy', $tipoPlantilla->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tipoPlantillas.show', [$tipoPlantilla->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tipoPlantillas.edit', [$tipoPlantilla->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>