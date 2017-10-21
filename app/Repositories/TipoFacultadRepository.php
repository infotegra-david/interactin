<?php

namespace App\Repositories;

use App\Models\TipoFacultad;
use InfyOm\Generator\Common\BaseRepository;

class TipoFacultadRepository extends BaseRepository
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
        return TipoFacultad::class;
    }
}
