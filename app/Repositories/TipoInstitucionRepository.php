<?php

namespace App\Repositories;

use App\Models\TipoInstitucion;
use InfyOm\Generator\Common\BaseRepository;

class TipoInstitucionRepository extends BaseRepository
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
        return TipoInstitucion::class;
    }
}
