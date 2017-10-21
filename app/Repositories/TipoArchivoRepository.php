<?php

namespace App\Repositories;

use App\Models\TipoArchivo;
use InfyOm\Generator\Common\BaseRepository;

class TipoArchivoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'nativo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoArchivo::class;
    }
}
