<?php

namespace App\Repositories;

use App\Models\AlianzaInstitucion;
use InfyOm\Generator\Common\BaseRepository;

class AlianzaInstitucionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'alianza_id',
        'institucion_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AlianzaInstitucion::class;
    }
}
