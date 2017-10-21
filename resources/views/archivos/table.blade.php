<table class="table table-responsive" id="archivos-table">
    <thead>
        <th>Path</th>
        <th>Fecha Creacion</th>
        <th>Usuario Id</th>
        <th>Formato Id</th>
        <th>Tipo Archivo Id</th>
        <th>Permisos Archivo Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($archivos as $archivo)
        <tr>
            <td>{!! $archivo->path !!}</td>
            <td>{!! $archivo->user_id !!}</td>
            <td>{!! $archivo->formato_id !!}</td>
            <td>{!! $archivo->tipo_archivo_id !!}</td>
            <td>{!! $archivo->permisos_archivo_id !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('archivos.show', [$archivo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('archivos.edit', [$archivo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>