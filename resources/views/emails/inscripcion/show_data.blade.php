@extends( 'emails.layouts.ver_data' )

@section('msj_header')
    
    <table class="center_table">
        <tr>
            <td class="panel-content">
                <h2>A continuacion se muestra la información que usted ha registrado:</h2>
            </td>
        </tr>
    </table>
@endsection
@section('data')

    <table class="center_table">
        <thead class="panel-content text-left">
            <tr>
                <th>
                    <h2>{{ $paso_titulo[1] }}</h2>
                </th>
            </tr>
        </thead>
        <tbody class="panel-content text-left">
            <tr>
                <td>
                    <strong>Nombres del estudiante:</strong> {{ $dataUsers[$keyEstudianteId]['nombres'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Apellidos del estudiante:</strong> {{ $dataUsers[$keyEstudianteId]['apellidos'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Tipo de documento:</strong> {{ $dataUsers[$keyEstudianteId]['tipoDocumento']['tipo_documento_nombre'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Número de documento:</strong> {{ $dataUsers[$keyEstudianteId]['numero_documento'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Correo institución:</strong> {{ $dataUsers[$keyEstudianteId]['usuario_email'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Correo personal:</strong> {{ $dataUsers[$keyEstudianteId]['email_personal'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Código institucional:</strong> {{ $dataUsers[$keyEstudianteId]['codigo_institucion'] }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="center_table">
        <thead class="panel-content text-left">
            <tr>
                <th>
                    <h2>{{ $paso_titulo[2] }}</h2>
                </th>
            </tr>
        </thead>
        <tbody class="panel-content text-left">
            <tr>
                <td>
                    <strong>Facultad:</strong> {{ $dataUsers[$keyEstudianteId]['programa']['facultad_nombre'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Programa:</strong> {{ $dataUsers[$keyEstudianteId]['programa']['programa_nombre'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Promedio académico acumulado:</strong> {{ $dataUsers[$keyEstudianteId]['promedio_acumulado'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Porcentaje de creditos aprobados:</strong> {{ $dataUsers[$keyEstudianteId]['porcentaje_aprobado'] }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="center_table">
        <thead class="panel-content text-left">
            <tr>
                <th>
                    <h2>{{ $paso_titulo[3] }}</h2>
                </th>
            </tr>
        </thead>
        <tbody class="panel-content text-left">
            <tr>
                <td>
                    <strong>Periodo:</strong> {{ $dataInscripcion['periodo']['periodo_nombre'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Modalidad:</strong> {{ $dataInscripcion['modalidades']['modalidades_nombre'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>País:</strong> {{ $dataInscripcion['paises']['pais_nombre'] }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Institución de destino:</strong> {{ $dataInscripcion['institucion']['institucion_nombre'] }}
                </td>
            </tr>
        </tbody>
    </table>
@endsection

