<?php

namespace App\Repositories;

use App\Models\TipoTramite;
use InfyOm\Generator\Common\BaseRepository;

class TipoTramiteRepository extends BaseRepository
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
        return TipoTramite::class;
    }
}
