<table class="table table-responsive" id="iniciativas-table">
    <thead>
        <th>Oportunidad Id</th>
        <th>Titulo</th>
        <th>Objetivo</th>
        <th>Integracion Agenda Origen</th>
        <th>Responsabilidades Origen</th>
        <th>Beneficios Origen</th>
        <th>Recursos Origen</th>
        <th>Presupuesto Costo Total</th>
        <th>Presupuesto Otros Actores</th>
        <th>Presupuesto Total Origen</th>
        <th>Presupuesto Financieros</th>
        <th>Presupuesto Personal</th>
        <th>Presupuesto Infraestructura</th>
        <th>Presupuesto Otro</th>
        <th>Instrumentos Monitoreo</th>
        <th>Firma Rectoria</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($iniciativas as $iniciativa)
        <tr>
            <td>{!! $iniciativa->oportunidad_id !!}</td>
            <td>{!! $iniciativa->titulo !!}</td>
            <td>{!! $iniciativa->objetivo !!}</td>
            <td>{!! $iniciativa->integracion_agenda_origen !!}</td>
            <td>{!! $iniciativa->responsabilidades_origen !!}</td>
            <td>{!! $iniciativa->beneficios_origen !!}</td>
            <td>{!! $iniciativa->recursos_origen !!}</td>
            <td>{!! $iniciativa->presupuesto_costo_total !!}</td>
            <td>{!! $iniciativa->presupuesto_otros_actores !!}</td>
            <td>{!! $iniciativa->presupuesto_total_origen !!}</td>
            <td>{!! $iniciativa->presupuesto_financieros !!}</td>
            <td>{!! $iniciativa->presupuesto_personal !!}</td>
            <td>{!! $iniciativa->presupuesto_infraestructura !!}</td>
            <td>{!! $iniciativa->presupuesto_otro !!}</td>
            <td>{!! $iniciativa->instrumentos_monitoreo !!}</td>
            <td>{!! $iniciativa->firma_rectoria !!}</td>
            <td>
                {!! Form::open(['route' => ['iniciativas.destroy', $iniciativa->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('iniciativas.show', [$iniciativa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('iniciativas.edit', [$iniciativa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>