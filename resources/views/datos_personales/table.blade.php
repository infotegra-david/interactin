<table class="table table-responsive" id="datosPersonales-table">
    <thead>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Ciudad Residencia Id</th>
        <th>Direccion</th>
        <th>Email Personal</th>
        <th>Telefono</th>
        <th>Celular</th>
        <th>Codigo Postal</th>
        <th>Tipo Documento Id</th>
        <th>Numero Documento</th>
        <th>Fecha Expedicion</th>
        <th>Fecha Vencimiento</th>
        <th>Lugar Expedicion Id</th>
        <th>Nacionalidad</th>
        <th>Nro Pasaporte</th>
        <th>Porcentaje Aprobado</th>
        <th>Promedio Acumulado</th>
        <th>Codigo Institucion</th>
        <th>Cargo</th>
        <th>facultad Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($datosPersonales as $datosPersonales)
        <tr>
            <td>{!! $datosPersonales->nombres !!}</td>
            <td>{!! $datosPersonales->apellidos !!}</td>
            <td>{!! $datosPersonales->ciudad_residencia_id !!}</td>
            <td>{!! $datosPersonales->direccion !!}</td>
            <td>{!! $datosPersonales->email_personal !!}</td>
            <td>{!! $datosPersonales->telefono !!}</td>
            <td>{!! $datosPersonales->celular !!}</td>
            <td>{!! $datosPersonales->codigo_postal !!}</td>
            <td>{!! $datosPersonales->tipo_documento_id !!}</td>
            <td>{!! $datosPersonales->numero_documento !!}</td>
            <td>{!! $datosPersonales->fecha_expedicion !!}</td>
            <td>{!! $datosPersonales->fecha_vencimiento !!}</td>
            <td>{!! $datosPersonales->lugar_expedicion_id !!}</td>
            <td>{!! $datosPersonales->nacionalidad !!}</td>
            <td>{!! $datosPersonales->nro_pasaporte !!}</td>
            <td>{!! $datosPersonales->porcentaje_aprobado !!}</td>
            <td>{!! $datosPersonales->promedio_acumulado !!}</td>
            <td>{!! $datosPersonales->codigo_institucion !!}</td>
            <td>{!! $datosPersonales->cargo !!}</td>
            <td>{!! $datosPersonales->facultad_id !!}</td>
            <td>
                {!! Form::open(['route' => ['datosPersonales.destroy', $datosPersonales->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('datosPersonales.show', [$datosPersonales->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('datosPersonales.edit', [$datosPersonales->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>