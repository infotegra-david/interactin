<?php

namespace App\Repositories;

use App\Models\Archivo;
use InfyOm\Generator\Common\BaseRepository;

class ArchivoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'path',
        'fecha_creacion',
        'usuario_id',
        'formato_id',
        'tipo_archivo_id',
        'permisos_archivo_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Archivo::class;
    }
}
