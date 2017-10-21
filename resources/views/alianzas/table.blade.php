<table class="table table-responsive" id="alianzas-table">
    <thead>
        <th>Usuario Id</th>
        <th>Objetivo</th>
        <th>Tipo Tramite Id</th>
        <th>Duracion</th>
        <th>Responsable Arl</th>
        <th>Estado</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($alianzas as $alianza)
        <tr>
            <td>{!! $alianza->usuario_id !!}</td>
            <td>{!! $alianza->objetivo !!}</td>
            <td>{!! $alianza->tipo_tramite_id !!}</td>
            <td>{!! $alianza->duracion !!}</td>
            <td>{!! $alianza->responsable_arl !!}</td>
            <td>{!! $alianza->estado !!}</td>
            <td>
                {!! Form::open(['route' => ['interalliances.destroy', $alianza->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('interalliances.show', [$alianza->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('interalliances.edit', [$alianza->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>