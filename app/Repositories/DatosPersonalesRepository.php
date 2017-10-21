<?php

namespace App\Repositories;

use App\Models\DatosPersonales;
use InfyOm\Generator\Common\BaseRepository;

class DatosPersonalesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombres',
        'apellidos',
        'ciudad_residencia_id',
        'direccion',
        'email_personal',
        'telefono',
        'celular',
        'codigo_postal',
        'tipo_documento_id',
        'numero_documento',
        'fecha_expedicion',
        'fecha_vencimiento',
        'lugar_expedicion_id',
        'nacionalidad',
        'nro_pasaporte',
        'porcentaje_aprobado',
        'promedio_acumulado',
        'codigo_institucion',
        'cargo',
        'facultad_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DatosPersonales::class;
    }
}
