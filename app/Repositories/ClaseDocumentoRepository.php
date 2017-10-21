<?php

namespace App\Repositories;

use App\Models\ClaseDocumento;
use InfyOm\Generator\Common\BaseRepository;

class ClaseDocumentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ClaseDocumento::class;
    }
}
