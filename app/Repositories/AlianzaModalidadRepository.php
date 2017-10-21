<?php

namespace App\Repositories;

use App\Models\AlianzaModalidad;
use InfyOm\Generator\Common\BaseRepository;

class AlianzaModalidadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'alianza_id',
        'modalidad_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AlianzaModalidad::class;
    }
}
