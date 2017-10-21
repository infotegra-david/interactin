<table class="table table-responsive" id="alianzaInstitucions-table">
    <thead>
        <th>Alianza Id</th>
        <th>Institucion Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($alianzaInstitucions as $alianzaInstitucion)
        <tr>
            <td>{!! $alianzaInstitucion->alianza_id !!}</td>
            <td>{!! $alianzaInstitucion->institucion_id !!}</td>
            <td>
                {!! Form::open(['route' => ['alianzaInstitucions.destroy', $alianzaInstitucion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('alianzaInstitucions.show', [$alianzaInstitucion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('alianzaInstitucions.edit', [$alianzaInstitucion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>